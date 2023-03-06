<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

register_activation_hook( MS_LMS_FILE, 'stm_lms_curriculum_bind' );

function stm_lms_curriculum_bind() {
	global $wpdb;

	$table_name = stm_lms_curriculum_bind_name( $wpdb );

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		bind_id mediumint(9) NOT NULL AUTO_INCREMENT,
		item_id mediumint(9) NOT NULL,
		course_id bigint NOT NULL,
		item_type TEXT NOT NULL DEFAULT '',
		date INT NOT NULL,
		PRIMARY KEY  (bind_id)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	dbDelta( $sql );
}
