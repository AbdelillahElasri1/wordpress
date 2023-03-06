<?php

require_once STM_LMS_PATH . '/settings/main_settings/settings.php';

add_filter(
	'wpcfto_options_page_setup',
	function ( $setups ) {

		$setups[] = array(
			'option_name'     => 'stm_lms_settings',
			'title'           => esc_html__( 'LMS Settings', 'masterstudy-lms-learning-management-system' ),
			'sub_title'       => esc_html__( 'by StylemixThemes', 'masterstudy-lms-learning-management-system' ),
			'admin_bar_title' => esc_html__( 'LMS Settings', 'masterstudy-lms-learning-management-system' ),
			'logo'            => STM_LMS_URL . 'assets/admin/icon.svg',
			'page'            => array(
				'page_title' => 'LMS Settings',
				'menu_title' => 'MS LMS',
				'menu_slug'  => 'stm-lms-settings',
				'icon'       => STM_LMS_URL . 'assets/admin/icon.png',
				'position'   => 3,
			),
			'fields'          => array(
				'section_1'          => stm_lms_settings_general_section(),
				'section_2'          => stm_lms_settings_courses_section(),
				'section_course'     => stm_lms_settings_course_section(),
				'section_quiz'       => stm_lms_settings_quiz_section(),
				'section_routes'     => stm_lms_settings_route_section(),
				'section_3'          => stm_lms_settings_payments_section(),
				'section_5'          => stm_lms_settings_google_api_section(),
				'section_4'          => stm_lms_settings_profiles_section(),
				'section_6'          => stm_lms_settings_certificates_section(),
				'payout'             => stm_lms_settings_payout_section(),
				'gdpr'               => stm_lms_settings_gdpr_section(),
				'stm_lms_shortcodes' => stm_lms_settings_shortcodes_section(),
			),
		);

		return $setups;
	},
	5,
	1
);

add_action(
	'wpcfto_screen_stm_lms_settings_added',
	function () {

		add_submenu_page(
			'stm-lms-settings',
			'MasterStudy',
			'LMS Settings',
			'manage_options',
			'stm-lms-settings'
		);

		$post_types = array(
			'stm-courses',
			'stm-lessons',
			'stm-quizzes',
			'stm-questions',
			'stm-assignments',
			'stm-user-assignment',
			'stm-reviews',
			'stm-orders',
			'stm-ent-groups',
		);
		if ( class_exists( 'Stm_Lms_Statistics' ) ) {
			$post_types[] = 'stm-payout';
		}

		$taxonomies = array(
			'stm_lms_course_taxonomy',
			'stm_lms_question_taxonomy',
		);

		foreach ( $post_types as $post_type ) {
			$post_type_data = get_post_type_object( $post_type );

			if ( empty( $post_type_data ) ) {
				continue;
			}

			add_submenu_page(
				'stm-lms-settings',
				$post_type_data->label,
				$post_type_data->label,
				'manage_options',
				'/edit.php?post_type=' . $post_type
			);
		}

		foreach ( $taxonomies as $taxonomy ) {
			$tax_data = get_taxonomy( $taxonomy );

			add_submenu_page(
				'stm-lms-settings',
				$tax_data->label,
				$tax_data->label,
				'manage_options',
				'edit-tags.php?taxonomy=' . $taxonomy,
			);
		}

	},
	- 1,
	10
);

add_action(
	'admin_menu',
	function () {
		if ( ! defined( 'STM_LMS_PRO_PATH' ) ) {
			add_submenu_page(
				'stm-lms-settings',
				__( 'Upgrade', 'masterstudy-lms-learning-management-system' ),
				'<span style="color: #adff2f;"><span style="font-size: 14px;text-align:left;" class="dashicons dashicons-star-filled stm_go_pro_menu"></span>' . __( 'Upgrade', 'masterstudy-lms-learning-management-system' ) . '</span>',
				'manage_options',
				'stm-lms-go-pro',
				'stm_lms_render_go_pro',
			);
		}
	},
	100001
);

add_filter(
	'admin_body_class',
	function ( $classes ) {
		if ( ! defined( 'STM_LMS_PRO_PATH' ) ) {
			$classes .= ' not-lms-pro';
		}

		return $classes;
	}
);

function stm_lms_render_go_pro() {

	$v      = ( WP_DEBUG ) ? time() : STM_LMS_DB_VERSION;
	$assets = STM_LMS_URL . 'assets';

	wp_enqueue_style( 'stm_lms_go_pro', $assets . '/css/stm_lms_gopro.css', null, $v );

	require_once( STM_LMS_PATH . '/stm-lms-templates/stm-lms-go-pro.php' );

}

add_action( 'admin_footer', 'stm_lms_render_feature_request' );

function stm_lms_render_feature_request() {
	echo '<a id="feature-request" href="https://stylemixthemes.cnflx.io/boards/masterstudy-lms" target="_blank" style="display: none;">
		<img src=' . esc_url( STM_LMS_URL . 'assets/svg/feature-request.svg' ) . '>
		<span>Create a roadmap with us:<br>Vote for next feature</span>
	</a>';
}
