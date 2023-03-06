<?php
// phpcs:ignoreFile
function stm_megamenu_front_scripts_method() {
    $base_url = get_template_directory_uri() . '/includes/';
    $front_css = $base_url . 'megamenu/assets/css/';
    $front_js = $base_url . 'megamenu/assets/js/';
    wp_enqueue_style( 'stm_megamenu', $front_css . 'megamenu.css' );
    wp_enqueue_script( 'stm_megamenu', $front_js . 'megamenu.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'stm_megamenu_front_scripts_method' );