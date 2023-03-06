<?php

new STM_LMS_User_Manager_Course_User();

class STM_LMS_User_Manager_Course_User {

	public function __construct() {
		add_action( 'wp_ajax_stm_lms_dashboard_reset_student_progress', array( $this, 'reset_student_progress' ) );
		add_action( 'wp_ajax_stm_lms_dashboard_get_student_progress', array( $this, 'student_progress' ) );
		add_action( 'wp_ajax_stm_lms_dashboard_set_student_item_progress', array( $this, 'set_student_progress' ) );
	}

	public function reset_student_progress() {
		check_ajax_referer( 'stm_lms_dashboard_reset_student_progress', 'nonce' );

		if ( ! STM_LMS_User_Manager_Interface::isInstructor() ) {
			die;
		}

		$request_body = file_get_contents( 'php://input' );

		$data = json_decode( $request_body, true );

		if ( empty( $data['user_id'] ) || empty( $data['course_id'] ) ) {
			die;
		}

		$course_id  = intval( $data['course_id'] );
		$student_id = intval( $data['user_id'] );

		$curriculum = get_post_meta( $course_id, 'curriculum', true );

		if ( empty( $curriculum ) ) {
			die;
		}

		$curriculum = explode( ',', $curriculum );

		foreach ( $curriculum as $item_id ) {

			$item_type = get_post_type( $item_id );

			if ( 'stm-lessons' === $item_type ) {
				self::reset_lesson( $student_id, $course_id, $item_id );
			} elseif ( 'stm-assignments' === $item_type ) {
				self::reset_assignment( $student_id, $course_id, $item_id );
			} elseif ( 'stm-quizzes' === $item_type ) {
				self::reset_quiz( $student_id, $course_id, $item_id );
			}
		}

		stm_lms_reset_user_answers( $course_id, $student_id );

		STM_LMS_Course::update_course_progress( $student_id, $course_id );

		wp_send_json( self::_student_progress( $course_id, $student_id ) );

	}

	// phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
	public static function _student_progress( $course_id, $student_id ) {
		$curriculum = get_post_meta( $course_id, 'curriculum', true );

		$curriculum    = explode( ',', $curriculum );
		$sections_data = STM_LMS_Lesson::create_sections( $curriculum );

		$sections = array();
		foreach ( $sections_data as $sections_datum ) {
			$sections[] = $sections_datum;
		}

		foreach ( $sections as $index => &$section_info ) {

			$curriculum = ( ! empty( $section_info['items'] ) ) ? $section_info['items'] : array();

			foreach ( $curriculum as $curriculum_index => $curriculum_item ) {

				$item_data = self::course_item_data( intval( $curriculum_item ), $student_id, $course_id );

				$section_info['section_items'][] = $item_data;

				if ( ! isset( $user_id ) ) {
					$user_id = 0;
				}
			}
		}

		$user_stats = STM_LMS_Helpers::simplify_db_array(
			stm_lms_get_user_course(
				$student_id,
				$course_id,
				array(
					'current_lesson_id',
					'progress_percent',
				)
			)
		);
		if ( empty( $user_stats['current_lesson_id'] ) ) {
			$user_stats['current_lesson_id'] = STM_LMS_Lesson::get_first_lesson( $course_id );
		}

		$lesson_type = get_post_meta( $user_stats['current_lesson_id'], 'type', true );
		if ( empty( $lesson_type ) ) {
			$lesson_type = 'text';
		}

		$user_stats['lesson_type'] = $lesson_type;

		$data = array_merge( $user_stats, array( 'sections' => $sections ) );

		$data['user']         = STM_LMS_User::get_current_user( $student_id );
		$data['course_title'] = get_the_title( $course_id );

		return $data;
	}

	public function student_progress() {
		check_ajax_referer( 'stm_lms_dashboard_get_student_progress', 'nonce' );

		if ( ! STM_LMS_User_Manager_Interface::isInstructor() ) {
			die;
		}

		$request_body = file_get_contents( 'php://input' );

		$data = json_decode( $request_body, true );

		if ( empty( $data['user_id'] ) || empty( $data['course_id'] ) ) {
			die;
		}

		$course_id  = intval( $data['course_id'] );
		$student_id = intval( $data['user_id'] );

		$data = self::_student_progress( $course_id, $student_id );

		wp_send_json( $data );
	}

	public function set_student_progress() {
		check_ajax_referer( 'stm_lms_dashboard_set_student_item_progress', 'nonce' );

		if ( ! STM_LMS_User_Manager_Interface::isInstructor() ) {
			die;
		}

		$request_body = file_get_contents( 'php://input' );

		$data = json_decode( $request_body, true );

		if ( empty( $data['user_id'] ) || empty( $data['course_id'] ) || empty( $data['item_id'] ) ) {
			die;
		}

		$course_id  = intval( $data['course_id'] );
		$student_id = intval( $data['user_id'] );
		$item_id    = intval( $data['item_id'] );
		$completed  = boolval( $data['completed'] );

		/*For various item types*/
		/*Check item in curriculum*/
		$curriculum = get_post_meta( $course_id, 'curriculum', true );

		if ( empty( $curriculum ) ) {
			die;
		}

		$curriculum = explode( ',', $curriculum );
		// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
		if ( ! in_array( $item_id, $curriculum ) ) {
			die;
		}

		$item_type = get_post_type( $item_id );

		if ( 'stm-lessons' === $item_type ) {
			self::complete_lesson( $student_id, $course_id, $item_id );
		} elseif ( 'stm-assignments' === $item_type ) {
			self::complete_assignment( $student_id, $course_id, $item_id, $completed );
		} elseif ( 'stm-quizzes' === $item_type ) {
			self::complete_quiz( $student_id, $course_id, $item_id, $completed );
		}

		STM_LMS_Course::update_course_progress( $student_id, $course_id );

		wp_send_json( self::_student_progress( $course_id, $student_id ) );
	}

	public static function complete_lesson( $user_id, $course_id, $lesson_id ) {
		$user_lesson = stm_lms_get_user_lesson( $user_id, $course_id, $lesson_id );

		if ( ! empty( $user_lesson ) ) {
			stm_lms_delete_user_lesson( $user_id, $course_id, $lesson_id );
		} else {
			$end_time   = time();
			$start_time = get_user_meta( $user_id, "stm_lms_course_started_{$course_id}_{$lesson_id}", true );
			if ( empty( $start_time ) ) {
				$start_time = time();
			}
			stm_lms_add_user_lesson( compact( 'user_id', 'course_id', 'lesson_id', 'start_time', 'end_time' ) );
		}
	}

	public static function complete_assignment( $user_id, $course_id, $lesson_id, $completed ) {
		$user = STM_LMS_User::get_current_user( $user_id );

		$assignment_name = get_the_title( $lesson_id );

		$assignment_try = STM_LMS_Assignments::number_of_assignments( $lesson_id ) + 1;

		$new_assignment = array(
			'post_type'   => 'stm-user-assignment',
			'post_status' => 'publish',
			'post_title'  => "{$user['login']} on \"{$assignment_name}\"",
		);

		$assignment_id = wp_insert_post( $new_assignment );

		update_post_meta( $assignment_id, 'try_num', $assignment_try );
		update_post_meta( $assignment_id, 'start_time', time() * 1000 );
		update_post_meta( $assignment_id, 'status', '' );
		update_post_meta( $assignment_id, 'assignment_id', $lesson_id );
		update_post_meta( $assignment_id, 'student_id', $user_id );
		update_post_meta( $assignment_id, 'course_id', $course_id );
		$status         = $completed ? 'passed' : 'not_passed';
		$editor_comment = ( $completed ) ? esc_html__( 'Approved by admin', 'masterstudy-lms-learning-management-system' ) : esc_html__( 'Declined by admin', 'masterstudy-lms-learning-management-system' );

		update_post_meta( $assignment_id, 'status', $status );
		update_post_meta( $assignment_id, 'editor_comment', $editor_comment );
	}

	public static function complete_quiz( $user_id, $course_id, $quiz_id, $completed ) {
		if ( ! $completed ) {
			$progress = 0;
			$status   = 'failed';
		} else {
			$progress = 100;
			$status   = 'passed';
		}

		stm_lms_add_user_quiz( compact( 'user_id', 'course_id', 'quiz_id', 'progress', 'status' ) );
	}

	public static function course_item_data( $curriculum_item, $student_id, $course_id ) {
		$item_id = intval( $curriculum_item );

		$title        = get_the_title( $curriculum_item );
		$content_type = get_post_type( $curriculum_item );
		$quiz_info    = array();

		$previous_completed = ( isset( $completed ) ) ? $completed : 'first';
		$has_preview        = STM_LMS_Lesson::lesson_has_preview( $curriculum_item );

		$user    = STM_LMS_User::get_current_user( $student_id );
		$user_id = $user['id'];

		$duration  = '';
		$questions = '';
		$attempts  = 0;

		if ( 'stm-quizzes' === $content_type ) {
			$type      = 'quiz';
			$quiz_info = STM_LMS_Helpers::simplify_db_array( stm_lms_get_user_quizzes( $user_id, $curriculum_item, array( 'progress' ) ) );
			$completed = STM_LMS_Quiz::quiz_passed( $curriculum_item, $user_id );

			$q = get_post_meta( $curriculum_item, 'questions', true );
			if ( ! empty( $q ) ) :
				/* translators: %s: Post Type Label */
				$questions = sprintf(
					/* translators: %s: Count of Questions */
					_n(
						'%s question',
						'%s questions',
						count(
							explode(
								',',
								$q
							)
						),
						'masterstudy-lms-learning-management-system'
					),
					count(
						explode(
							',',
							$q
						)
					)
				);
			endif;

		} elseif ( 'stm-assignments' === $content_type ) {
			$type      = 'assignment';
			$completed = class_exists( 'STM_LMS_Assignments' ) ? STM_LMS_Assignments::has_passed_assignment( $curriculum_item, $student_id ) : false;
			$completed = ( ! empty( $completed ) );
		} else {
			$completed = STM_LMS_Lesson::is_lesson_completed( $user_id, $course_id, $curriculum_item );

			$type     = get_post_meta( $curriculum_item, 'type', true );
			$duration = get_post_meta( $curriculum_item, 'duration', true );
		}

		if ( empty( $type ) ) {
			$type = 'lesson';
		}

		if ( empty( $duration ) ) {
			$duration = '';
		}

		$locked = str_replace(
			'prev-status-',
			'',
			apply_filters( 'stm_lms_prev_status', "{$previous_completed}", $course_id, $curriculum_item, $user_id )
		);

		$locked = ( empty( $locked ) );

		$item_data = compact( 'item_id', 'title', 'type', 'quiz_info', 'locked', 'completed', 'has_preview', 'duration', 'questions' );

		return $item_data;
	}


	/*RESET ITEMS*/
	public static function reset_lesson( $user_id, $course_id, $lesson_id ) {
		stm_lms_delete_user_lesson( $user_id, $course_id, $lesson_id );
	}

	public static function reset_quiz( $user_id, $course_id, $quiz_id ) {
		stm_lms_delete_user_quiz( $user_id, $course_id, $quiz_id );
	}

	public static function reset_assignment( $user_id, $course_id, $assignment_id ) {
		$args = array(
			'posts_per_page' => - 1,
			'post_type'      => 'stm-user-assignment',
			'post_status'    => array(
				'pending',
				'publish',
				'draft',
			),
			'meta_query'     => array(
				'relation' => 'AND',
				array(
					'key'     => 'course_id',
					'value'   => $course_id,
					'compare' => '=',
				),
				array(
					'key'     => 'assignment_id',
					'value'   => $assignment_id,
					'compare' => '=',
				),
				array(
					'key'     => 'student_id',
					'value'   => $user_id,
					'compare' => '=',
				),
			),
		);

		$q = new WP_Query( $args );

		if ( $q->have_posts() ) {
			while ( $q->have_posts() ) {
				$q->the_post();

				wp_delete_post( get_the_ID() );

			}
		}
	}
}
