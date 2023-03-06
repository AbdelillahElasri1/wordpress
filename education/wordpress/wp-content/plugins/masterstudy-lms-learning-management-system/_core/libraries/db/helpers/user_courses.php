<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function stm_lms_points_column_available() {
	global $wpdb;
	$table_name = stm_lms_user_courses_name( $wpdb );
	$column     = $wpdb->get_col_length( $table_name, 'for_points' );
	if ( isset( $column['length'] ) ) {
		return $column['length'];
	}
	return false;
}

function stm_lms_add_user_course( $user_course ) {
	global $wpdb;
	$table_name = stm_lms_user_courses_name( $wpdb );
	if ( ! stm_lms_points_column_available() ) {
		// phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$wpdb->query( "ALTER TABLE {$table_name} ADD `for_points` VARCHAR (255)" );
	}

	$wpdb->insert(
		$table_name,
		$user_course
	);
}

function stm_lms_get_user_course( $user_id, $course_id, $fields = array(), $enterprise = '' ) {
	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	$request = "SELECT {$fields} FROM {$table}
			WHERE
			user_ID = {$user_id} AND
			course_id = {$course_id}";

	if ( ! empty( $enterprise ) ) {
		$request .= " AND enterprise_id = {$enterprise}";
	}

	$request .= ' LIMIT 1';
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	$r = $wpdb->get_results( $request, ARRAY_A );
	return $r;
}

function stm_lms_get_user_completed_courses( $user_id, $fields = array(), $limit = 1 ) {
	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	$threshold = STM_LMS_Options::get_option( 'certificate_threshold', 70 );

	$request = "SELECT {$fields} FROM {$table}
			WHERE
			user_ID = {$user_id} AND
			progress_percent >= {$threshold}";

	if ( -1 !== $limit ) {
		$request .= " LIMIT {$limit}";
	}
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	$r = $wpdb->get_results( $request, ARRAY_A );
	return $r;
}

function stm_lms_get_course_users( $course_id, $fields = array() ) {
	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	$request = "SELECT {$fields} FROM {$table}
			WHERE
			course_id = {$course_id}";
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	$r = $wpdb->get_results( $request, ARRAY_A );
	return $r;
}

function stm_lms_get_user_courses_by_subscription( $user_id, $subscription_id, $fields = array(), $limit = 1, $order_by = '' ) {
	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	$subs = ( '*' !== $subscription_id ) ? "subscription_id = {$subscription_id}" : 'subscription_id > 0';

	$request = "SELECT {$fields} FROM {$table}
			WHERE
			user_ID = {$user_id} AND
			{$subs}";

	if ( ! empty( $order_by ) ) {
		$request .= " ORDER BY {$order_by}";
	}
	if ( ! empty( $limit ) ) {
		$request .= " LIMIT {$limit}";
	}
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	$r = $wpdb->get_results( $request, ARRAY_A );
	return $r;
}

function stm_lms_get_user_courses( $user_id, $limit = '', $offset = '', $fields = array(), $get_total = false, $courses = '', $sort = '' ) {
	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	if ( $get_total ) {
		$fields = 'COUNT(*)';
	}

	if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		global $sitepress;
		$courses = " AND lng_code='" . $sitepress->get_locale( ICL_LANGUAGE_CODE ) . "' " . $courses;
	}

	if ( empty( $sort ) ) {
		$sort = 'ORDER BY user_course_id DESC';
	}

	$request = "SELECT {$fields} FROM {$table}
			WHERE
			user_id = {$user_id}
			{$courses}
			{$sort}";

	if ( ! empty( $limit ) ) {
		$request .= " LIMIT {$limit}";
	}
	if ( ! empty( $offset ) ) {
		$request .= " OFFSET {$offset}";
	}
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	$r = $wpdb->get_results( $request, ARRAY_A );
	return $r;
}

function stm_lms_update_user_course_progress( $user_course_id, $progress ) {
	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$wpdb->update(
		$table,
		array( 'progress_percent' => $progress ),
		array( 'user_course_id' => $user_course_id ),
		array( '%d' ),
		array( '%d' )
	);
}

function stm_lms_update_user_course_endtime( $user_course_id, $endtime ) {
	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$wpdb->update(
		$table,
		array( 'end_time' => $endtime ),
		array( 'user_course_id' => $user_course_id ),
		array( '%d' ),
		array( '%d' )
	);
}

function stm_lms_get_delete_user_course( $user_id, $item_id ) {
	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$wpdb->delete(
		$table,
		array(
			'user_id'   => $user_id,
			'course_id' => $item_id,
		)
	);
}

function stm_lms_get_delete_user_courses( $user_id ) {
	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$wpdb->delete(
		$table,
		array(
			'user_id' => $user_id,
		)
	);
}

function stm_lms_get_delete_courses( $course_id ) {
	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$wpdb->delete(
		$table,
		array(
			'course_id' => $course_id,
		)
	);
}

function stm_lms_update_user_current_lesson( $course_id, $item_id ) {
	$user = STM_LMS_User::get_current_user();
	if ( empty( $user['id'] ) ) {
		return false;
	}
	$user_id = $user['id'];

	global $wpdb;
	$table = stm_lms_user_courses_name( $wpdb );

	$wpdb->update(
		$table,
		array( 'current_lesson_id' => $item_id ),
		array(
			'user_id'   => $user_id,
			'course_id' => $course_id,
		),
		array( '%d' ),
		array( '%d' )
	);
}
