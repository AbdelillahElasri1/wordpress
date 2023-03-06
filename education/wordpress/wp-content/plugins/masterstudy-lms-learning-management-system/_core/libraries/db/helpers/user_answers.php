<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function stm_lms_add_user_answer( $user_answer ) {
	global $wpdb;
	$table_name = stm_lms_user_answers_name( $wpdb );

	$wpdb->insert(
		$table_name,
		$user_answer
	);
}

function stm_lms_reset_user_answers( $course_id, $student_id ) {
	global $wpdb;
	$table = stm_lms_user_answers_name( $wpdb );
	$wpdb->query(
		$wpdb->prepare(
		// phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			"DELETE FROM {$table} WHERE `course_id` = %d AND `user_id` = %d ",
			$course_id,
			$student_id
		)
	);
	wp_reset_postdata();
}

function stm_lms_get_user_answers( $user_id, $quiz_id, $attempt = '1', $get_correct = false, $fields = array() ) {
	global $wpdb;
	$table = stm_lms_user_answers_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	$request = "SELECT {$fields} FROM {$table}
			WHERE 
			user_ID = {$user_id} AND
			quiz_id = {$quiz_id} AND
			attempt_number = {$attempt}";
	if ( $get_correct ) {
		$request .= ' AND correct_answer = 1';
	}
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	$r = $wpdb->get_results( $request, ARRAY_N );

	return $r;
}

function stm_lms_get_quiz_latest_answers( $user_id, $quiz_id, $questions_quantity, $fields = array() ) {
	global $wpdb;
	$table = stm_lms_user_answers_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	$request = "SELECT {$fields} FROM {$table}
			WHERE 
			user_ID = {$user_id} AND
			quiz_id = {$quiz_id}
			ORDER BY user_answer_id DESC
			LIMIT {$questions_quantity}";
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	$r = $wpdb->get_results( $request, ARRAY_A );

	return $r;
}

function stm_lms_get_quiz_attempt_answers( $user_id, $quiz_id, $fields = array(), $attempt = 1 ) {
	global $wpdb;
	$table = stm_lms_user_answers_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	$request = "SELECT {$fields} FROM {$table}
			WHERE 
			user_ID = {$user_id} AND
			quiz_id = {$quiz_id} AND 
			attempt_number = {$attempt}
			ORDER BY attempt_number DESC";
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	$r = $wpdb->get_results( $request, ARRAY_A );

	return $r;
}
