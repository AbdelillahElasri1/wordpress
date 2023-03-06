<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function stm_lms_add_user_quiz_time( $user_quiz_time ) {
	global $wpdb;
	$table_name = stm_lms_user_quizzes_times_name( $wpdb );

	$wpdb->insert(
		$table_name,
		$user_quiz_time
	);
}

function stm_lms_get_user_quizzes_time( $user_id, $quiz_id, $fields = array() ) {
	global $wpdb;
	$table = stm_lms_user_quizzes_times_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	$request = "SELECT {$fields} FROM {$table}
			WHERE 
			user_id = {$user_id} AND
			quiz_id = {$quiz_id}";

	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	return $wpdb->get_results( $request, ARRAY_A );
}

function stm_lms_get_delete_user_quiz_time( $user_id, $item_id ) {
	global $wpdb;
	$table = stm_lms_user_quizzes_times_name( $wpdb );

	$wpdb->delete(
		$table,
		array(
			'user_id' => $user_id,
			'quiz_id' => $item_id,
		)
	);
}
