<?php
// Product Registration
define( 'STM_THEME_NAME', 'Starter' );
define( 'STM_THEME_CATEGORY', 'Business, Finance WordPress Theme' );
define( 'STM_ENVATO_ID', '14740561' );
define( 'STM_TOKEN_OPTION', 'stm_starter_token' );
define( 'STM_TOKEN_CHECKED_OPTION', 'stm_starter_token_checked' );
define( 'STM_THEME_SETTINGS_URL', 'starter_settings' );
define( 'GENERATE_TOKEN', 'https://docs.stylemixthemes.com/starter-theme-documentation/getting-started/theme-activation' );
define( 'SUBMIT_A_TICKET', 'https://support.stylemixthemes.com/tickets/new/support?item_id=12' );
define( 'STM_DEMO_SITE_URL', 'https://starter.stylemixthemes.com/' );
define( 'STM_DOCUMENTATION_URL', 'https://docs.stylemixthemes.com/starter-theme-documentation/' );
define( 'STM_CHANGELOG_URL', 'https://docs.stylemixthemes.com/starter-theme-documentation/extra-materials/changelog' );
define( 'STM_INSTRUCTIONS_URL', 'https://docs.stylemixthemes.com/starter-theme-documentation/getting-started/theme-activation' );
define( 'STM_INSTALL_VIDEO_URL', 'https://www.youtube.com/watch?v=WkZnOS1ZDFM' );
define( 'STM_VOTE_URL', 'https://stylemixthemes.cnflx.io/boards/starter-business-finance-wordpress-theme' );
define( 'STM_BUY_ANOTHER_LICENSE', 'https://themeforest.net/item/starter-business-finance-wordpress-theme/14740561?s_rank=3' );
define( 'STM_VIDEO_TUTORIALS', 'https://www.youtube.com/playlist?list=PL3Pyh_1kFGGCfPdptK3Q9HXFZKL5RI6Ht' );
define( 'FACEBOOK_COMMUNITY', '' );
define( 'STM_THEME_VERSION', ( WP_DEBUG ) ? time() : wp_get_theme()->get( 'Version' ) );
define( 'STM_THEME_PATH', dirname( __FILE__ ) );
define( 'STM_INCLUDES_PATH', STM_THEME_PATH . '/includes' );
define( 'STM_TEMPLATE_URI', get_template_directory_uri() );
define( 'STM_TEMPLATE_DIR', get_template_directory() );

require_once STM_INCLUDES_PATH . '/custom-functions.php';
require_once STM_INCLUDES_PATH . '/enqueue.php';
require_once STM_INCLUDES_PATH . '/comments.php';
require_once STM_INCLUDES_PATH . '/theme-config.php';
require_once STM_INCLUDES_PATH . '/helpers.php';
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Constants
 */
define( 'MS_LMS_STARTER_THEME_DIR', get_parent_theme_file_path() );
define( 'MS_LMS_STARTER_THEME_URI', get_parent_theme_file_uri() );
define( 'MS_LMS_STARTER_THEME_VERSION', ( WP_DEBUG ) ? time() : wp_get_theme()->get( 'Version' ) );

/**
 * Include dashboard.php
 */
if ( is_admin() ) {
	require_once MS_LMS_STARTER_THEME_DIR . '/includes/dashboard/init.php';
}

if ( get_theme_mod( 'ms_lms_starter_preloader' ) ) {
	function ms_lms_starter_footer_content() {
		get_template_part( 'templates/modals/preloader' );
	}

	add_action( 'wp_head', 'ms_lms_starter_footer_content' );

}
/** Register and Enqueue Styles */
function stm_ms_lms_theme_register_styles() {
	$version = time(); /* wp_get_theme()->get( 'Version' ); */
	wp_enqueue_style( 'stm_lms_starter_theme_css_frontend', MS_LMS_STARTER_THEME_URI . '/assets/css/style.css', array(), $version );
}
add_action( 'wp_enqueue_scripts', 'stm_ms_lms_theme_register_styles' );

function stm_ms_lms_theme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'stm_ms_lms_theme_add_woocommerce_support' );

function stm_ms_lms_theme_remove_shop_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'template_redirect', 'stm_ms_lms_theme_remove_shop_breadcrumbs' );

add_action(
	'admin_init',
	function () {
		delete_transient( 'elementor_activation_redirect' );
	}
);
function stm_ms_lms_theme_woocommerce_image_size_gallery_thumbnail( $size ) {
	return array(
		'width'  => 470,
		'height' => 470,
		'crop'   => 1,
	);
}
add_filter( 'woocommerce_get_image_size_single', 'stm_ms_lms_theme_woocommerce_image_size_gallery_thumbnail' );

/* Including plugins TGM */
require_once MS_LMS_STARTER_THEME_DIR . '/includes/tgm/theme-required-plugins.php';

/* Including Customizer */
require_once MS_LMS_STARTER_THEME_DIR . '/includes/customizer.php';

/* Merlin Demo Import*/
require_once MS_LMS_STARTER_THEME_DIR . '/merlin/class-merlin.php';

require_once MS_LMS_STARTER_THEME_DIR . '/merlin/vendor/autoload.php';

require_once MS_LMS_STARTER_THEME_DIR . '/includes/merlin-config.php';

require_once MS_LMS_STARTER_THEME_DIR . '/includes/upgrade/classes/class-starter-loader.php';
