<?php
STM_LMS_Mails::init();

class STM_LMS_Mails {

	public static function init() {
		add_action( 'order_created', 'STM_LMS_Mails::order_created', 10, 3 );
		add_action( 'add_user_course', 'STM_LMS_Mails::add_user_course', 10, 2 );
	}

	public static function wp_mail_text_html() {
		add_filter( 'wp_mail_content_type', 'STM_LMS_Mails::wp_mail_html' );
	}

	public static function remove_wp_mail_text_html() {
		remove_filter( 'wp_mail_content_type', 'STM_LMS_Mails::wp_mail_html' );
	}

	public static function wp_mail_html() {
		return 'text/html';
	}

	public static function order_created( $user, $cart_items, $payment_code ) {
		self::wp_mail_text_html();

		$user = STM_LMS_User::get_current_user( $user );

		$user_login = $user['login'];
		$message    = sprintf(
			/* translators: %s User Login */
			esc_html__( 'New Order from the user %s.', 'masterstudy-lms-learning-management-system' ),
			$user_login
		);

		self::send_email( 'New Order', $message, '', array(), 'stm_lms_new_order', compact( 'user_login' ) );

		$message = esc_html__( 'Your Order has been Accepted.', 'masterstudy-lms-learning-management-system' );

		self::send_email( 'New Order', $message, $user['email'], array(), 'stm_lms_new_order_accepted' );

		self::remove_wp_mail_text_html();
	}

	public static function add_user_course( $user_id, $course_id ) {
		self::wp_mail_text_html();

		$user    = STM_LMS_User::get_current_user( $user_id );
		$authors = array();

		if ( ! empty( $course_id ) ) {
			$post_author   = get_post_field( 'post_author', $course_id );
			$co_instructor = get_post_meta( $course_id, 'co_instructor', true );

			if ( ! empty( $post_author ) ) {
				$post_author_info = get_userdata( $post_author );

				if ( ! empty( $co_instructor_info->user_email ) ) {
					$authors[] = $post_author_info->user_email;
				}
			}

			if ( ! empty( $co_instructor ) ) {
				$co_instructor_info = get_userdata( $co_instructor );

				if ( ! empty( $co_instructor_info->user_email ) ) {
					$authors[] = $co_instructor_info->user_email;
				}
			}
		}

		$course_title = get_the_title( $course_id );
		$login        = $user['login'];
		$message      = sprintf(
			/* translators: %1$s Course Title, %2$s User Login */
			esc_html__( 'Course %1$s was added to %2$s.', 'masterstudy-lms-learning-management-system' ),
			$course_title,
			$login
		);

		if ( apply_filters( 'stm_lms_send_admin_course_notice', true ) ) {
			self::send_email( 'Course added to User', $message, '', $authors, 'stm_lms_course_added_to_user', compact( 'course_title', 'login' ) );
		}

		$message = sprintf(
			/* translators: %s Course Title */
			esc_html__( 'Course %s is now available to learn.', 'masterstudy-lms-learning-management-system' ),
			$course_title
		);

		self::send_email( 'Course added.', $message, $user['email'], array(), 'stm_lms_course_available_for_user', compact( 'course_title' ) );
		self::remove_wp_mail_text_html();
	}

	public static function send_email( $subject, $message, $to = '', $additional_receivers = array(), $filter = 'stm_lms_send_email_filter', $data = array() ) {
		$to        = ( ! empty( $to ) ) ? $to : get_option( 'admin_email' );
		$receivers = array_unique( array_merge( array( $to ), $additional_receivers ) );

		$data = apply_filters(
			'stm_lms_filter_email_data',
			array(
				'subject'     => $subject,
				'message'     => $message,
				'vars'        => $data,
				'filter_name' => $filter,
			)
		);

		if ( ! isset( $data['enabled'] ) || ( isset( $data['enabled'] ) && $data['enabled'] ) ) {
			wp_mail( $receivers, $data['subject'], $data['message'] );
		}
	}

}
