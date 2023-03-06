<?php
// phpcs:ignoreFile
/**
 * Merlin WP configuration file.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

if ( ! class_exists( 'Merlin' ) ) {
    return;
}

/**
 * Set directory locations, text strings, and settings.
 */
$wizard = new Merlin(

    $config = array(
        'directory'            => 'merlin', // Location / directory where Merlin WP is placed in your theme.
        'merlin_url'           => 'starter_lms_demo_installer', // The wp-admin page slug where Merlin WP loads.
        'parent_slug'          => 'starter_lms_demo_installer', // The wp-admin parent page slug for the admin menu item.
        'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
        'child_action_btn_url' => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/', // URL for the 'child-action-link'.
        'dev_mode'             => true, // Enable development mode for testing.
        'license_step'         => false, // EDD license activation step.
        'license_required'     => false, // Require the license activation step.
        'license_help_url'     => '', // URL for the 'license-tooltip'.
        'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
        'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
        'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
        'ready_big_button_url' => '/', // Link for the big button on the ready step.
    ),
    $strings = array(
        'admin-menu'               => esc_html__( 'LMS Starter Setup', 'ms-lms-starter-theme' ),

        /* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
        'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; starter_lms Setup: %3$s%4$s', 'ms-lms-starter-theme' ),
        'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'ms-lms-starter-theme' ),
        'ignore'                   => esc_html__( 'Disable this wizard', 'ms-lms-starter-theme' ),

        'btn-skip'                 => esc_html__( 'Skip', 'ms-lms-starter-theme' ),
        'btn-next'                 => esc_html__( 'Next', 'ms-lms-starter-theme' ),
        'btn-start'                => esc_html__( 'Start', 'ms-lms-starter-theme' ),
        'btn-no'                   => esc_html__( 'Cancel', 'ms-lms-starter-theme' ),
        'btn-plugins-install'      => esc_html__( 'Install', 'ms-lms-starter-theme' ),
        'btn-child-install'        => esc_html__( 'Install', 'ms-lms-starter-theme' ),
        'btn-content-install'      => esc_html__( 'Install', 'ms-lms-starter-theme' ),
        'btn-import'               => esc_html__( 'Import', 'ms-lms-starter-theme' ),
        'btn-license-activate'     => esc_html__( 'Activate', 'ms-lms-starter-theme' ),
        'btn-license-skip'         => esc_html__( 'Later', 'ms-lms-starter-theme' ),

        /* translators: Theme Name */
        'license-header%s'         => esc_html__( 'Activate %s', 'ms-lms-starter-theme' ),
        /* translators: Theme Name */
        'license-header-success%s' => esc_html__( '%s is Activated', 'ms-lms-starter-theme' ),
        /* translators: Theme Name */
        'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'ms-lms-starter-theme' ),
        'license-label'            => esc_html__( 'License key', 'ms-lms-starter-theme' ),
        'license-success%s'        => esc_html__( 'starter_lms is already registered, so you can go to the next step!', 'ms-lms-starter-theme' ),
        'license-json-success%s'   => esc_html__( 'starter_lms is activated! Remote updates and theme support are enabled.', 'ms-lms-starter-theme' ),
        'license-tooltip'          => esc_html__( 'Need help?', 'ms-lms-starter-theme' ),

        /* translators: Theme Name */
        'welcome-header%s'         => esc_html__( 'Welcome to %s', 'ms-lms-starter-theme' ),
        'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'ms-lms-starter-theme' ),
        'welcome%s'                => esc_html__( 'This wizard will set up your Masterstudy LMS theme, install plugins, and import demo content. It is optional & should take only a few minutes.', 'ms-lms-starter-theme' ),
        'welcome-success%s'        => esc_html__( 'You may have already run this MasterStudy Starter Theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'ms-lms-starter-theme' ),

        'child-header'             => esc_html__( 'Install Child Theme', 'ms-lms-starter-theme' ),
        'child-header-success'     => esc_html__( 'You\'re good to go!', 'ms-lms-starter-theme' ),
        'child'                    => esc_html__( 'Let\'s build and activate a Child Theme so you may easily make changes to the theme.', 'ms-lms-starter-theme' ),
        'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'ms-lms-starter-theme' ),
        'child-action-link'        => esc_html__( 'Learn about Child Themes', 'ms-lms-starter-theme' ),
        'child-json-success%s'     => esc_html__( 'Awesome. starter_lms theme has already been installed and is now activated.', 'ms-lms-starter-theme' ),
        'child-json-already%s'     => esc_html__( 'Awesome. starter_lms theme has been created and is now activated.', 'ms-lms-starter-theme' ),

        'plugins-header'           => esc_html__( 'Install Plugins', 'ms-lms-starter-theme' ),
        'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'ms-lms-starter-theme' ),
        'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'ms-lms-starter-theme' ),
        'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'ms-lms-starter-theme' ),
        'plugins-action-link'      => esc_html__( 'Advanced', 'ms-lms-starter-theme' ),

        'import-header'            => esc_html__( 'Import Demo Content', 'ms-lms-starter-theme' ),
        'import'                   => esc_html__( 'Let\'s import demo content to your website, to help you get familiar with the theme.', 'ms-lms-starter-theme' ),
        'import-action-link'       => esc_html__( 'Advanced', 'ms-lms-starter-theme' ),

        'ready-header'             => esc_html__( 'All done. Have fun!', 'ms-lms-starter-theme' ),

        /* translators: Theme Author */
        'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'ms-lms-starter-theme' ),
        'ready-action-link'        => esc_html__( 'Extras', 'ms-lms-starter-theme' ),
        'ready-big-button'         => esc_html__( 'View your website', 'ms-lms-starter-theme' ),
        'lms-big-button'           => esc_html__( 'Setup MasterStudy Plugin', 'ms-lms-starter-theme' ),
    )
);


/**
 * Demo import
 */

if ( ! function_exists( 'starter_lms_divi_demo_import_files' ) ) {
    function starter_lms_divi_demo_import_files() {

            $demo  = array(
            array(
                'import_file_name' => esc_html__( 'Demo Content', 'ms-lms-starter-theme' ),
                'import_file_url' => 'https://masterstudy.stylemixthemes.com/starter-demo-files/new.xml',
                'import_widget_file_url' => 'https://masterstudy.stylemixthemes.com/starter-demo-files/starter_widgets.wie',
                'import_customizer_file_url' => 'https://masterstudy.stylemixthemes.com/starter-demo-files/starter_customizer.dat',
                'import_preview_image_url' => 'https://masterstudy.stylemixthemes.com/starter-demo-files/screenshot.png',
                'preview_url' => 'https://masterstudy.stylemixthemes.com/lms-plugin/',
            ),
        );
            return $demo;
    }
}
add_filter( 'merlin_import_files', 'starter_lms_divi_demo_import_files' );
add_filter( 'pt-ocdi/import_files', 'starter_lms_divi_demo_import_files' );

/**
 * Disable regenerate thumbnails
 */
add_filter( 'merlin_regenerate_thumbnails_in_content_import', '__return_false' );
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
