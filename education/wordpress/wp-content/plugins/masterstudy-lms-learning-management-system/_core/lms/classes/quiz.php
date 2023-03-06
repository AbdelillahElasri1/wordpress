<?php

STM_LMS_Quiz::init();

class STM_LMS_Quiz {

	public static function init() {
		add_action( 'wp_ajax_stm_lms_start_quiz', 'STM_LMS_Quiz::start_quiz' );
		add_action( 'wp_ajax_stm_lms_user_answers', 'STM_LMS_Quiz::user_answers' );
		add_action( 'wp_ajax_nopriv_stm_lms_user_answers', 'STM_LMS_Quiz::user_answers' );
		add_action( 'wp_ajax_stm_lms_add_h5p_result', 'STM_LMS_Quiz::h5p_results' );
		add_action( 'wp_ajax_nopriv_stm_lms_add_h5p_result', 'STM_LMS_Quiz::h5p_results' );
	}

	public static function get_quiz_end_time( $quiz_id ) {
		$user = STM_LMS_User::get_current_user();
		if ( empty( $user['id'] ) ) {
			die;
		}

		$already_started = STM_LMS_Helpers::simplify_db_array( stm_lms_get_user_quizzes_time( $user['id'], $quiz_id, array( 'end_time' ) ) );

		return $already_started;
	}

	public static function is_quiz_failed( $item_id, $course_id ) {
		$duration = self::get_quiz_duration( $item_id );

		if ( ! empty( $duration ) ) {
			$already_started = self::get_quiz_end_time( $item_id );
			if ( ! empty( $already_started['end_time'] ) ) {
				$end_time = $already_started['end_time'];
				/*Quiz failed*/
				if ( time() > $end_time ) {
					self::quiz_failed( $item_id, $course_id );
				}
			}
		}
	}

	public static function quiz_failed( $quiz_id, $course_id ) {
		$user = STM_LMS_User::get_current_user();
		if ( empty( $user['id'] ) ) {
			die;
		}
		$user_id = $user['id'];

		$progress = 0;
		$status   = 'failed';

		$user_quiz = compact( 'user_id', 'course_id', 'quiz_id', 'progress', 'status' );
		stm_lms_add_user_quiz( $user_quiz );

		/*REMOVE TIMER*/
		stm_lms_get_delete_user_quiz_time( $user_id, $quiz_id );
	}

	public static function start_quiz() {

		check_ajax_referer( 'start_quiz', 'nonce' );

		if ( empty( $_GET['quiz_id'] ) ) {
			die;
		}
		$quiz_id = intval( $_GET['quiz_id'] );
		$source  = ( ! empty( $_GET['source'] ) ) ? intval( $_GET['source'] ) : '';

		$user = apply_filters( 'user_answers__user_id', STM_LMS_User::get_current_user(), $source );
		if ( empty( $user['id'] ) ) {
			die;
		}
		$user_id = $user['id'];

		$duration        = self::get_quiz_duration( $quiz_id );
		$already_started = STM_LMS_Helpers::simplify_db_array( stm_lms_get_user_quizzes_time( $user['id'], $quiz_id, array( 'end_time' ) ) );

		$count_to = ( ! empty( $duration ) ) ? time() + $duration : 0;

		if ( empty( $already_started ) ) {
			stm_lms_add_user_quiz_time(
				array(
					'user_id'    => $user_id,
					'quiz_id'    => $quiz_id,
					'start_time' => time(),
					'end_time'   => $count_to,
				)
			);
		} else {
			$count_to = $already_started['end_time'];
		}

		if ( time() - $count_to > 0 ) {
			/*REMOVE TIMER*/
			stm_lms_get_delete_user_quiz_time( $user_id, $quiz_id );
			/*Set NEW*/
			$count_to = time() + $duration;
			stm_lms_add_user_quiz_time(
				array(
					'user_id'    => $user_id,
					'quiz_id'    => $quiz_id,
					'start_time' => time(),
					'end_time'   => $count_to,
				)
			);
		}
		wp_send_json( $count_to );
	}

	public static function user_answers() {

		check_ajax_referer( 'user_answers', 'nonce' );

		$source   = ( ! empty( $_POST['source'] ) ) ? intval( $_POST['source'] ) : '';
		$sequency = ! empty( $_POST['questions_sequency'] ) ? $_POST['questions_sequency'] : array();
		$sequency = json_encode( $sequency );
		$user     = apply_filters( 'user_answers__user_id', STM_LMS_User::get_current_user(), $source );
		/*Checking Current User*/
		if ( ! $user['id'] ) {
			die;
		}
		$user_id   = $user['id'];
		$course_id = ( ! empty( $_POST['course_id'] ) ) ? intval( $_POST['course_id'] ) : '';
		$course_id = apply_filters( 'user_answers__course_id', $course_id, $source );

		if ( empty( $course_id ) || empty( $_POST['quiz_id'] ) ) {
			die;
		}
		$quiz_id = intval( $_POST['quiz_id'] );
		$progress        = 0;
		$quiz_info       = STM_LMS_Helpers::parse_meta_field( $quiz_id );
		$total_questions = count( explode( ',', $quiz_info['questions'] ) );

		$questions = explode( ',', $quiz_info['questions'] );

		foreach ( $questions as $question ) {
			$type = get_post_meta( $question, 'type', true );

			if ( 'question_bank' !== $type ) {
				continue;
			}

			$answers = get_post_meta( $question, 'answers', true );

			if ( ! empty( $answers[0] ) && ! empty( $answers[0]['categories'] ) && ! empty( $answers[0]['number'] ) ) {
				$number     = $answers[0]['number'];
				$categories = wp_list_pluck( $answers[0]['categories'], 'slug' );

				$questions = get_post_meta( $quiz_id, 'questions', true );
				$questions = ( ! empty( $questions ) ) ? explode( ',', $questions ) : array();

				$args = array(
					'post_type'      => 'stm-questions',
					'posts_per_page' => $number,
					'post__not_in'   => $questions,
					'tax_query'      => array(
						array(
							'taxonomy' => 'stm_lms_question_taxonomy',
							'field'    => 'slug',
							'terms'    => $categories,
						),
					),
				);

				$q = new WP_Query( $args );

				if ( $q->have_posts() ) {

					$total_in_bank = $q->found_posts - 1;
					if ( $total_in_bank > $number ) {
						$total_in_bank = $number - 1;
					}
					$total_questions += $total_in_bank;
					wp_reset_postdata();
				}
			}
		}
		$single_question_score_percent = 100 / $total_questions;
		$cutting_rate                  = ( ! empty( $quiz_info['re_take_cut'] ) ) ? ( 100 - $quiz_info['re_take_cut'] ) / 100 : 1;
		$passing_grade                 = ( ! empty( $quiz_info['passing_grade'] ) ) ? intval( $quiz_info['passing_grade'] ) : 0;

		$user_quizzes   = stm_lms_get_user_quizzes( $user_id, $quiz_id, array( 'user_quiz_id', 'progress' ) );
		$attempt_number = count( $user_quizzes ) + 1;
		$prev_answers   = ( 1 !== $attempt_number ) ? stm_lms_get_user_answers( $user_id, $quiz_id, $attempt_number - 1, true, array( 'question_id' ) ) : array();

		foreach ( $_POST as $question_id => $value ) {
			if ( is_numeric( $question_id ) ) {
				$question_id = intval( $question_id );

				if ( is_array( $value ) ) {
					$answer = self::sanitize_answers( $value );
				} else {
					$answer = sanitize_text_field( $value );
				}

				$user_answer = ( is_array( $answer ) ) ? implode( ',', $answer ) : $answer;

				$correct_answer = self::check_answer( $question_id, $answer );

				if ( $correct_answer ) {
					if ( 1 === $attempt_number || STM_LMS_Helpers::in_array_r( $question_id, $prev_answers ) ) {
						$single_question_score = $single_question_score_percent;
					} else {
						$single_question_score = $single_question_score_percent * $cutting_rate;
					}

					$progress += $single_question_score;
				}

				$add_answer = compact( 'user_id', 'course_id', 'quiz_id', 'question_id', 'attempt_number', 'user_answer', 'correct_answer' );
				stm_lms_add_user_answer( $add_answer );
			}
		}

		/*Add user quiz*/
		$progress  = round( $progress );
		$status    = ( $progress < $passing_grade ) ? 'failed' : 'passed';
		$user_quiz = compact( 'user_id', 'course_id', 'quiz_id', 'progress', 'status', 'sequency' );

		stm_lms_add_user_quiz( $user_quiz );

		/*REMOVE TIMER*/
		stm_lms_get_delete_user_quiz_time( $user_id, $quiz_id );

		if ( 'passed' === $status ) {
			STM_LMS_Course::update_course_progress( $user_id, $course_id );
			$user_login   = $user['login'];
			$course_title = get_the_title( $course_id );
			$quiz_name    = get_the_title( $quiz_id );
			$message      = sprintf(
			/* translators: %1$s Course Title, %2$s User Login */
				esc_html__( '%1$s completed the %2$s on the course %3$s with a Passing grade of %4$s%%', 'masterstudy-lms-learning-management-system' ),
				$user_login,
				$quiz_name,
				$course_title,
				$passing_grade,
			);

			STM_LMS_Mails::send_email( 'Quiz Completed', $message, $user['email'], array(), 'stm_lms_course_quiz_completed_for_user', compact( 'user_login', 'course_title', 'quiz_name', 'passing_grade' ) );

		}
		$user_quiz['passed']   = $progress >= $passing_grade;
		$user_quiz['progress'] = round( $user_quiz['progress'] );
		$user_quiz['url']      = '<a class="btn btn-default btn-close-quiz-modal-results" href="' . apply_filters( 'stm_lms_item_url_quiz_ended', STM_LMS_Course::item_url( $course_id, $quiz_id ) ) . '">' . esc_html__( 'Close', 'masterstudy-lms-learning-management-system' ) . '</a>';
		$user_quiz['url']      = apply_filters( 'user_answers__course_url', $user_quiz['url'], $source );

		do_action( 'stm_lms_quiz_' . $status, $user_id, $quiz_id, $user_quiz['progress'] );

		wp_send_json( $user_quiz );
	}

	public static function h5p_results() {

		check_ajax_referer( 'stm_lms_add_h5p_result', 'nonce' );

		$res = array(
			'completed' => false,
		);

		$course_id = intval( $_POST['sources']['post_id'] );
		$quiz_id   = intval( $_POST['sources']['item_id'] );
		$user_id   = get_current_user_id();

		$last_quiz = STM_LMS_Helpers::simplify_db_array(
			stm_lms_get_user_last_quiz(
				$user_id,
				$quiz_id,
				array(
					'progress',
					'status',
				)
			)
		);

		if ( ! empty( $last_quiz ) && ! empty( $last_quiz['status'] ) && 'passed' === $last_quiz['status'] ) {
			wp_send_json( $res );
		}

		$status = ( ! empty( $_POST['success'] ) ) ? sanitize_text_field( $_POST['success'] ) : 'failed';

		$status = ( ! empty( $status ) && 'true' === $status ) ? 'passed' : 'failed';

		stm_lms_get_delete_user_quiz_time( $user_id, $quiz_id );

		$progress = ( isset( $_POST['score']['scaled'] ) ) ? intval( $_POST['score']['scaled'] * 100 ) : 0;

		/*We have no success, but we have progress now!*/
		if ( ! isset( $_POST['success'] ) ) {
			if ( 100 === $progress ) {
				$status = 'passed';
			}
		}

		$sequency = '';

		$res['completed'] = ( 'passed' === $status );
		$res['progress']  = $progress;
		$res['status']    = $status;

		$user_quiz = compact( 'user_id', 'course_id', 'quiz_id', 'progress', 'status', 'sequency' );
		stm_lms_add_user_quiz( $user_quiz );

		if ( 'passed' === $status ) {
			STM_LMS_Course::update_course_progress( $user_id, $course_id );
		}

		wp_send_json( $res );

	}

	public static function deslash( $content ) {
		$content = preg_replace( "/\\\+'/", "'", $content );

		/*
		 * Replace one or more backslashes followed by a double quote with
		 * a double quote.
		 */
		$content = preg_replace( '/\\\+"/', '"', $content );

		// Replace one or more backslashes with one backslash.
		$content = preg_replace( '/\\\+/', '\\', $content );

		return $content;
	}

	public static function sanitize_answers( $answers ) {

		$new_answers = array();
		foreach ( $answers as $answer ) {

			$new_answers[] = sanitize_text_field( self::deslash( $answer ) );

		}

		return $new_answers;
	}

	public static function check_answer( $question_id, $answer, $answers = array() ) {
		$correct = false;
		$answers = ! empty( $answers ) ? $answers : get_post_meta( $question_id, 'answers', true );

		if ( empty( $answers ) ) {
			return false;
		}

		$type             = get_post_meta( $question_id, 'type', true );
		$has_wrong_answer = false;

		foreach ( $answers as $stored_answer ) {

			switch ( $type ) {

				case 'single_choice':
					$answer      = wp_unslash( $answer );
					$full_answer = $stored_answer['text'];

					if ( ! empty( $stored_answer['text_image']['url'] ) ) {
						$full_answer .= '|' . esc_url( $stored_answer['text_image']['url'] );
					}

					if ( $answer == $full_answer && $stored_answer['isTrue'] ) {
						$correct = true;
					}

					break;

				case 'multi_choice':
					$answer      = wp_unslash( $answer );
					$full_answer = $stored_answer['text'];

					if ( ! empty( $stored_answer['text_image']['url'] ) ) {
						$full_answer .= '|' . esc_url( $stored_answer['text_image']['url'] );
					}

					if ( in_array( $full_answer, $answer ) && $stored_answer['isTrue'] ) {
						$correct = true;
					} else if ( ! in_array( $full_answer, $answer ) && $stored_answer['isTrue'] ) {
						$correct          = false;
						$has_wrong_answer = true;
					} else if ( in_array( $full_answer, $answer ) && ! $stored_answer['isTrue'] ) {
						$correct          = false;
						$has_wrong_answer = true;
					}
					$correct = $has_wrong_answer ? false : $correct;
					break;

				case 'item_match':
					$answer = explode( '[stm_lms_sep]', str_replace( '[stm_lms_item_match]', '', $answer ) );

					foreach ( $answers as $i => $correct_answer ) {
						$correct = true;
						if ( strtolower( $correct_answer['text'] ) !== strtolower( $answer[ $i ] ) ) {
							$correct = false;
							break;
						};
					}

					return $correct;

				case 'image_match':
					$answer = explode( '[stm_lms_sep]', str_replace( '[stm_lms_image_match]', '', $answer ) );

					foreach ( $answers as $i => $correct_answer ) {
						$correct     = true;
						$correct_url = ( ! empty( $correct_answer['text_image']['url'] ) ) ? '|' . esc_url( $correct_answer['text_image']['url'] ) : '';
						if ( strtolower( $correct_answer['text'] . $correct_url ) !== strtolower( $answer[ $i ] ) ) {
							$correct = false;
							break;
						};
					}

					return $correct;

				case 'keywords':
					$answer = explode( '[stm_lms_sep]', str_replace( '[stm_lms_keywords]', '', $answer ) );

					foreach ( $answers as $i => $correct_answer ) {
						$correct = true;
						if ( strtolower( $correct_answer['text'] ) !== strtolower( $answer[ $i ] ) ) {
							$correct = false;
							break;
						};
					}

					return $correct;

				case 'fill_the_gap':
					if ( ! empty( $answers[0] ) && ! empty( $answers[0]['text'] ) ) {
						$text    = $answers[0]['text'];
						$matches = stm_lms_get_string_between( $text, '|', '|' );

						foreach ( $matches as $i => $correct_answer ) {
							$correct = true;
							if ( ! isset( $answer[ $i ] ) || ! isset( $correct_answer['answer'] ) ) {
								$correct = false;
								break;
							};

							if ( strtolower( $correct_answer['answer'] ) !== strtolower( $answer[ $i ] ) ) {
								$correct = false;
								break;
							};
						}

						return $correct;
					}

					break;

				default:
					$answer = wp_unslash( $answer );

					if ( $answer == $stored_answer['text'] && $stored_answer['isTrue'] ) {
						$correct = true;
					}
			}
		}

		return $correct;
	}

	public static function passing_grade( $meta ) {
		return ( ! empty( $meta['passing_grade'] ) ) ? $meta['passing_grade'] : 0;
	}

	public static function quiz_passed( $quiz_id, $user_id = '' ) {
		$source = STM_LMS_Helpers::current_screen();
		if ( empty( $user_id ) ) {

			$user = apply_filters( 'user_answers__user_id', STM_LMS_User::get_current_user(), $source );
			if ( empty( $user['id'] ) ) {
				return false;
			}

			$user_id = $user['id'];
		}

		$last_quiz = stm_lms_get_user_last_quiz( $user_id, $quiz_id, array( 'progress' ) );
		if ( empty( $last_quiz ) ) {
			return false;
		}
		$last_quiz     = STM_LMS_Helpers::simplify_db_array( $last_quiz );
		$passing_grade = self::passing_grade( STM_LMS_Helpers::parse_meta_field( $quiz_id ) );

		return $last_quiz['progress'] >= $passing_grade;
	}

	public static function can_watch_answers( $quiz_id ) {
		$show_answers = get_post_meta( $quiz_id, 'correct_answer', true );
		if ( ! empty( $show_answers ) && 'on' === $show_answers ) {
			return true;
		}

		return self::quiz_passed( $quiz_id );
	}

	public static function answers_url() {
		$current_url = add_query_arg( 'show_answers', '1', STM_LMS_Helpers::get_current_url() );

		return $current_url;
	}

	public static function show_answers( $quiz_id ) {
		if ( ! self::can_watch_answers( $quiz_id ) ) {
			return false;
		}
		if ( self::quiz_passed( $quiz_id ) ) {
			return true;
		}

		return ( ! empty( $_GET['show_answers'] ) && $_GET['show_answers'] ) ? true : false;
	}

	public static function get_quiz_duration( $quiz_id ) {
		$duration = get_post_meta( $quiz_id, 'duration', true );
		if ( empty( $duration ) ) {
			return 0;
		}
		$duration_measure = get_post_meta( $quiz_id, 'duration_measure', true );
		switch ( $duration_measure ) {
			case 'hours':
				$multiple = 60 * 60;
				break;
			case 'days':
				$multiple = 24 * 60 * 60;
				break;
			default:
				$multiple = 60;
		}

		return $duration * $multiple;
	}

	public static function get_style( $quiz_id ) {

		$quiz_style = get_post_meta( $quiz_id, 'quiz_style', true );

		if ( ! empty( $quiz_style ) && 'global' !== $quiz_style ) {
			return $quiz_style;
		}

		$quiz_global_style = STM_LMS_Options::get_option( 'quiz_style', 'default' );

		return $quiz_global_style;

	}

}
