<?php
// phpcs:ignoreFile

/**
 * Register Menu for Header
 */
function stm_menu_import_globalstudy()
{

	$locations = get_theme_mod ( 'nav_menu_locations' );
	$menus = wp_get_nav_menus ();

	if ( !empty( $menus ) ) {
		foreach ( $menus as $menu ) {
			$menu_names = array(
				'MS LMS Starter Theme Main Menu',
			);

			if ( is_object ( $menu ) && in_array ( $menu->name, $menu_names ) ) {
				$locations['ms-lms-starter-theme-main-menu'] = $menu->term_id;
			}
		}
	}
	set_theme_mod ( 'nav_menu_locations', $locations );

}

add_action ( 'merlin_after_all_import', 'stm_menu_import_globalstudy' );

/**
 * Generating Pages for Theme Options
 */
function stm_globalstudy_generate_lms_pages()
{
	$args = array(
		'post_type' => 'page',
		'post_status' => 'publish'
	);
	$pages = get_pages ( $args );

	global $wp_filesystem;

	if ( empty( $wp_filesystem ) ) {
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem ();
	}

	$mods = STM_INCLUDES_PATH . '/demo/theme_mods.json';
	$encode_options = $wp_filesystem->get_contents ( $mods );
	$import_options = json_decode ( $encode_options, true );
	update_option ( 'stm_lms_settings', $import_options );

	$options = get_option ( 'stm_lms_settings', array() );


	foreach ( $pages as $page ) {
		if ( $page->post_name == 'user-account' ) {
			$options['user_url'] = ( $page->ID );
		}

		if ( $page->post_name == 'user-public-account' ) {
			$options['user_url_profile'] = ( $page->ID );
		}

		if ( $page->post_name == 'courses' ) {
			$options['courses_page'] = ( $page->ID );
		}

		if ( $page->post_name == 'wishlist' ) {
			$options['wishlist_url'] = ( $page->ID );
		}

		if ( $page->post_name == 'checkout' ) {
			$options['checkout_url'] = ( $page->ID );
		}
	}

	update_option ( 'stm_lms_settings', $options );

	$settings = get_option ( 'stm_lms_settings', array() );
	$id = 'stm_lms_settings';

	$response = array(
		'reload'  => false,
		'updated' => false,
	);

	$response['reload'] = apply_filters( 'wpcfto_reload_after_save', $id, $settings );

	do_action( 'wpcfto_settings_saved', $id, $settings );

	$response['updated'] = update_option( $id, $settings );

	do_action( 'wpcfto_after_settings_saved', $id, $settings );
}

if ( empty( get_option( 'stm_lms_settings' ) ) ) {
	add_action( 'merlin_after_all_import', 'stm_globalstudy_generate_lms_pages' );
}

function elementor_set_default_settings_starter() {
	//Elementor Settings
	$active_kit = intval( get_option( 'elementor_active_kit', 0 ) );
	$meta       = get_post_meta( $active_kit, '_elementor_page_settings', true );

	if ( ! empty( $active_kit ) ) {
		$meta                    = ( ! empty( $meta ) ) ? $meta : array();
		$meta['container_width'] = array(
			'size'  => '1230',
			'unit'  => 'px',
			'sizes' => array(),
		);
		update_post_meta( $active_kit, '_elementor_page_settings', $meta );

		if ( class_exists( 'Elementor\Core\Responsive\Responsive' ) ) {
			Elementor\Core\Responsive\Responsive::compile_stylesheet_templates();
		}
	}

	$elementor_cpt_support = array(
		'post',
		'page',
		'stm_courses',
	);
	update_option( 'elementor_cpt_support', $elementor_cpt_support );

	// AddToAny Share Buttons
	$new_options       = array(
		'icon_size'                         => 20,
		'display_in_posts_on_front_page'    => '-1',
		'display_in_posts_on_archive_pages' => '-1',
		'display_in_excerpts'               => '-1',
		'display_in_posts'                  => '-1',
		'display_in_pages'                  => '-1',
		'display_in_attachments'            => '-1',
		'display_in_feed'                   => '-1',
	);
	$custom_post_types = array_values(
		get_post_types(
			array(
				'public'   => true,
				'_builtin' => false,
			),
			'objects'
		)
	);
	foreach ( $custom_post_types as $custom_post_type_obj ) {
		$placement_name                                     = $custom_post_type_obj->name;
		$new_options[ 'display_in_cpt_' . $placement_name ] = '-1';
	}

	update_option( 'addtoany_options', $new_options );

	global $wpdb;

	$from = trim( 'https://masterstudy.stylemixthemes.com/lms-plugin/' );
	$to   = get_site_url();

	$rows_affected = $wpdb->query(
		$wpdb->prepare(
			"UPDATE {$wpdb->postmeta} 
			SET `meta_value` = REPLACE(`meta_value`, %s, %s) 
			WHERE `meta_key` = '_elementor_data' 
			AND `meta_value` 
			LIKE %s ;",
			array(
				str_replace( '/', '\\\/', $from ),
				str_replace( '/', '\\\/', $to ),
				'[%',
			)
		)
	);

	if ( class_exists( 'Elementor\Core\Responsive\Responsive' ) ) {
		Elementor\Core\Responsive\Responsive::compile_stylesheet_templates();
	}
}
add_action ( 'merlin_after_all_import', 'elementor_set_default_settings_starter' );

