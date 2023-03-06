<?php

namespace stmLms\Classes\Vendor;

abstract class LmsUpdateCallbacks {

	/**
	 * Add uf_new_messages column to Conversations table.
	 * Rename new_messages column to ut_new_messages in Conversations table.
	 */
	public static function lms_chat_columns() {
		global $wpdb;

		$table_name = stm_lms_user_conversation_name( $wpdb );

		if ( ! $wpdb->get_var( sprintf( "SHOW COLUMNS FROM `%s` LIKE 'uf_new_messages';", $table_name ) ) ) { // phpcs:ignore
			$wpdb->query( sprintf( "ALTER TABLE `%s` ADD `uf_new_messages` INT NOT NULL, CHANGE `new_messages` `ut_new_messages` INT;", $table_name ) ); // phpcs:ignore
		}
	}

	/**
	 * Delete page routes config transient to reset them and autosave new routes
	 */
	public static function lms_page_routes() {
		delete_transient( 'stm_lms_routes_pages_transient' );
		delete_transient( 'stm_lms_routes_pages_config_transient' );

		flush_rewrite_rules( true );
	}

	public static function lms_admin_notification_transient() {
		$data = array(
			'show_time'   => DAY_IN_SECONDS * 3 + time(),
			'step'        => 0,
			'prev_action' => '',
		);
		set_transient( 'stm_masterstudy-lms-learning-management-system_notice_setting', $data );
	}

	public static function lms_add_lesson_video_sources() {
		$lessons = get_posts(
			array(
				'post_type'      => 'stm-lessons',
				'posts_per_page' => -1,
			),
		);

		foreach ( $lessons as $lesson ) {
			$lesson_type       = get_post_meta( $lesson->ID, 'type', true );
			$lesson_poster     = get_post_meta( $lesson->ID, 'lesson_video_poster', true );
			$lesson_video      = get_post_meta( $lesson->ID, 'lesson_video', true );
			$lesson_video_url  = get_post_meta( $lesson->ID, 'lesson_video_url', true );
			$lesson_video_type = get_post_meta( $lesson->ID, 'video_type', true );

			if ( 'text' === $lesson_type || 'slide' === $lesson_type ) {
				if ( ! empty( $lesson_video_url ) ) {
					$lesson_type = 'video';
					update_post_meta( $lesson->ID, 'type', 'video' );
				}
			}

			if ( 'video' === $lesson_type ) {
				if ( ! empty( $lesson_video ) ) {
					update_post_meta( $lesson->ID, 'video_type', 'html' );
				} elseif ( ! empty( $lesson_video_url ) ) {
					$youtube_pos = strpos( $lesson_video_url, 'youtube' );
					$vimeo_pos   = strpos( $lesson_video_url, 'vimeo' );

					if ( false !== $youtube_pos ) {
						update_post_meta( $lesson->ID, 'video_type', 'youtube' );
						update_post_meta( $lesson->ID, 'lesson_youtube_url', $lesson_video_url );
					} elseif ( false !== $vimeo_pos ) {
						update_post_meta( $lesson->ID, 'video_type', 'vimeo' );
						update_post_meta( $lesson->ID, 'lesson_vimeo_url', $lesson_video_url );
					} else if ( ! empty( $lesson_poster ) ) {
						update_post_meta( $lesson->ID, 'lesson_ext_link_url', $lesson_video_url );
						if ( empty( $lesson_video_type ) ) {
							update_post_meta( $lesson->ID, 'video_type', 'ext_link' );
						}
					}
				}
			} elseif ( 'stream' === $lesson_type ) {
				$lesson_video_url = get_post_meta( $lesson->ID, 'lesson_video_url', true );
				update_post_meta( $lesson->ID, 'lesson_stream_url', $lesson_video_url );
			}
		}
	}
}
