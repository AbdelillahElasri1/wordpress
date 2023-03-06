<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

register_activation_hook( MS_LMS_FILE, 'stm_lms_curriculum_log' );

function stm_lms_curriculum_log() {
	global $wpdb;

	$table_name = stm_lms_curriculum_log_name( $wpdb );

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		log_id mediumint(9) NOT NULL AUTO_INCREMENT,
		course_id bigint NOT NULL,
		item_id mediumint(9) NOT NULL,
		item_type TEXT NOT NULL DEFAULT '',
		item_title TEXT NOT NULL DEFAULT '',
		old_title TEXT NOT NULL DEFAULT '',
		item_action TEXT NOT NULL DEFAULT '',
		date INT NOT NULL,
		PRIMARY KEY  (log_id)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	dbDelta( $sql );
}
