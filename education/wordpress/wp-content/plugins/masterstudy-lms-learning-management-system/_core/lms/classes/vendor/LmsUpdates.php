<?php

namespace stmLms\Classes\Vendor;

abstract class LmsUpdates {

	private static $updates = array(
		'2.6.0'  => array( 'lms_chat_columns' ), // LMS Chat system update with fixes
		'2.6.4'  => array( 'lms_page_routes' ), // LMS Chat system update with fixes
		'2.6.7'  => array( 'lms_admin_notification_transient' ), // LMS Rate Us Admin Notification
		'2.9.22' => array( 'lms_add_lesson_video_sources' ), // Added lesson video sources
	);

	/**
	 * Init LMS Updates
	 */
	public static function init() {
		if ( version_compare( get_option( 'stm_lms_version', '1.0.0' ), STM_LMS_VERSION, '<' ) ) {
			self::update_version();
		}
	}

	/**
	 * Get All Updates
	 * @return array
	 */
	public static function get_updates() {
		return self::$updates;
	}

	/**
	 * Check If Needs Updates
	 * @return bool
	 */
	public static function needs_to_update() {
		$current_db_version = get_option( 'stm_lms_db_version', '1.0.0' );
		$update_versions    = array_keys( self::get_updates() );
		usort( $update_versions, 'version_compare' );

		return ! empty( $current_db_version ) && version_compare( $current_db_version, end( $update_versions ), '<' );
	}

	/**
	 * Run Needed Updates
	 */
	private static function maybe_update_db_version() {
		if ( self::needs_to_update() ) {
			$current_db_version = get_option( 'stm_lms_db_version', '1.0.0' );
			$updates            = self::get_updates();

			foreach ( $updates as $version => $callback_arr ) {
				if ( version_compare( $current_db_version, $version, '<' ) ) {
					foreach ( $callback_arr as $callback ) {
						call_user_func( array( '\\stmLms\\Classes\\Vendor\\LmsUpdateCallbacks', $callback ) );
					}
				}
			}
		}

		update_option( 'stm_lms_db_version', STM_LMS_DB_VERSION, true );
	}

	/**
	 * Update Plugin Version
	 */
	public static function update_version() {
		update_option( 'stm_lms_version', STM_LMS_VERSION, true );
		self::maybe_update_db_version();
	}

}
