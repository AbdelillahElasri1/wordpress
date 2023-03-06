<?php

new STM_LMS_User_Manager_Add_User();

class STM_LMS_User_Manager_Add_User {

	public function __construct() {
		add_action( 'wp_ajax_stm_lms_dashboard_add_user_to_course', array( $this, 'add_user' ) );
	}

	public function add_user() {
		check_ajax_referer( 'stm_lms_dashboard_add_user_to_course', 'nonce' );

		$request_body = file_get_contents( 'php://input' );

		$data = json_decode( $request_body, true );

		if ( empty( $data['email'] ) ) {
			die;
		}

		$email     = sanitize_text_field( $data['email'] );
		$course_id = intval( $data['course_id'] );

		if ( ! is_email( $email ) ) {
			wp_send_json(
				array(
					'status'  => 'error',
					'message' => esc_html__( 'Enter valid email', 'masterstudy-lms-learning-management-system' ),
				)
			);
		}

		$adding = STM_LMS_Instructor::_add_student_to_course( array( $course_id ), array( $email ) );

		if ( ! $adding['error'] ) {
			$adding['status'] = 'success';
			$meta             = STM_LMS_Helpers::parse_meta_field( $course_id );
			if ( ! empty( $meta['current_students'] ) ) {
				update_post_meta( $course_id, 'current_students', ++ $meta['current_students'] );
			} else {
				update_post_meta( $course_id, 'current_students', 1 );
			}
		}

		wp_send_json( $adding );
	}
}
