<?php
/** @var array|WP_Error $response */

class StarterUpdateCheck {

	public static function starter_server_version() {

		$response = wp_remote_get( 'https://masterstudy.stylemixthemes.com/starter-demo-files/versions.json' );

		if ( is_array( $response ) && ! is_wp_error( $response ) ) {
			$json = json_decode( $response['body'] );
		}
		$starter_available_version = '';
		foreach ( $json as $item ) {
			$starter_available_version = $item->masterstudy_starter->version;
		}

		return $starter_available_version;
	}

	public static function is_starter_available_update() {
		$last_version    = get_transient( 'stm_lms_starter_theme_version' );
		$theme_name      = wp_get_theme();
		$current_version = $theme_name->version;

		if ( $current_version < $last_version ) {
			return true;
		} else {
			return false;
		}
	}

	public static function starter_update_notice() {

		$last_version = get_transient( 'stm_lms_starter_theme_version' );

		if ( self::is_starter_available_update() ) {
			add_action(
				'admin_notices',
				function () use ( $last_version ) {
					// phpcs:disable
					echo '<div class="notice notice-warning stm-loader-warning">
				<div class="notice-wrapper">
					<div class="inner-wrapper">
						<img src="' . MS_LMS_STARTER_THEME_URI . '/assets/images/base/icon_40.png' . '" alt="">
						<p class="install-text">' . esc_html( __( 'MasterStudy Starter Theme - There is a new version ' . $last_version . '  available for updating! ', 'starter-text-domain' ) ) . ' &nbsp;</p>
					</div>
					<a href="" class="stm_lms_install_button buttonload button" name="loader" id="loader">
						<span class="ui-button-text">' . esc_html( __( 'Update', 'starter-text-domain' ) ) . '</span>
						<i class="fa fa-refresh fa-spin installing"></i>
						<i class="fa fa-check downloaded" aria-hidden="true"></i>
					</a>
				</div>
			</div>';
					// phpcs:enable
				}
			);
		}
	}
}
