<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function stm_lms_add_user_search( $user_id, $search, $time = null ) {
	global $wpdb;
	$table_name = stm_lms_user_searches_name( $wpdb );

	$time = ( ! empty( $time ) ) ? $time : time();

	$data = compact( 'user_id', 'search', 'time' );

	$wpdb->insert(
		$table_name,
		$data
	);

	stm_lms_add_search_stat( $search );
}

function stm_lms_add_search_stat( $search ) {
	global $wpdb;
	$table_name = stm_lms_user_searches_stats_name( $wpdb );

	$request = "SELECT * FROM {$table_name}
			WHERE
			search = '{$search}'";

	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	$r = $wpdb->get_results( $request, ARRAY_A );

	if ( empty( $r ) ) {
		$wpdb->insert(
			$table_name,
			array(
				'search' => $search,
				'stat'   => 1,
			)
		);
	} else {
		$r = STM_LMS_Helpers::simplify_db_array( $r );
		$wpdb->update(
			$table_name,
			array(
				'stat' => $r['stat'] + 1,
			),
			array(
				'search' => $search,
			)
		);
	}
}

function stm_lms_get_popular_user_searches( $limit = 15 ) {
	global $wpdb;
	$table = stm_lms_user_searches_stats_name( $wpdb );

	$limit = intval( $limit );
	if ( empty( $limit ) || $limit > 15 ) {
		$limit = 15;
	}

	$request = "SELECT search FROM {$table}
      ORDER BY 'stat'
      LIMIT {$limit}";

	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	return $wpdb->get_results( $request, ARRAY_A );
}
