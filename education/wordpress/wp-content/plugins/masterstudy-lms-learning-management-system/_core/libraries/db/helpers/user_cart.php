<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function stm_lms_add_user_cart( $user_cart ) {
	global $wpdb;
	$table_name = stm_lms_user_cart_name( $wpdb );

	$wpdb->insert(
		$table_name,
		$user_cart
	);
}

function stm_lms_get_item_in_cart( $user_id, $item_id, $fields = array() ) {
	global $wpdb;
	$table = stm_lms_user_cart_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	$request = "SELECT {$fields} FROM {$table}
			WHERE 
			user_ID = {$user_id} AND
			item_id = {$item_id}";

	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	return $wpdb->get_results( $request, ARRAY_N );
}

function stm_lms_get_cart_items( $user_id, $fields = array() ) {
	global $wpdb;
	$table = stm_lms_user_cart_name( $wpdb );

	$fields = ( empty( $fields ) ) ? '*' : implode( ',', $fields );

	$request = "SELECT {$fields} FROM {$table}
			WHERE 
			user_ID = {$user_id}";
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	return $wpdb->get_results( $request, ARRAY_A );
}

function stm_lms_get_delete_cart_item( $user_id, $item_id ) {
	global $wpdb;
	$table = stm_lms_user_cart_name( $wpdb );

	$wpdb->delete(
		$table,
		array(
			'user_id' => $user_id,
			'item_id' => $item_id,
		)
	);
}

function stm_lms_get_delete_cart_items( $user_id ) {
	global $wpdb;
	$table = stm_lms_user_cart_name( $wpdb );

	$wpdb->delete(
		$table,
		array(
			'user_id' => $user_id,
		)
	);
}
