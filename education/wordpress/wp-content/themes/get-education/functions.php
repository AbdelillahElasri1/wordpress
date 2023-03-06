<?php

require get_stylesheet_directory() . '/customizer/options-services.php';
require get_stylesheet_directory() . '/customizer/options-testimonial.php';
require get_stylesheet_directory() . '/sections/services.php';
require get_stylesheet_directory() . '/sections/testimonial.php';

add_action( 'wp_enqueue_scripts', 'get_education_chld_thm_parent_css' );
function get_education_chld_thm_parent_css() {

    wp_enqueue_style( 
    	'get_education_chld_css', 
    	trailingslashit( get_template_directory_uri() ) . 'style.css', 
    	array( 
    		'bootstrap',
    		'font-awesome-5',
    		'bizberg-main',
    		'bizberg-component',
    		'bizberg-style2',
    		'bizberg-responsive' 
    	) 
    );

    if ( is_rtl() ) {
        wp_enqueue_style( 
            'get_education_parent_rtl', 
            trailingslashit( get_template_directory_uri() ) . 'rtl.css'
        );
    }

    wp_enqueue_script( 'get_education_scripts', get_stylesheet_directory_uri() . '/script.js', array('jquery') );
    
}

add_action( 'after_setup_theme', 'get_education_setup_theme' );
function get_education_setup_theme() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
}

add_filter( 'bizberg_sidebar_settings', 'get_education_sidebar_settings' );
function get_education_sidebar_settings(){
    return '4';
}

add_filter( 'bizberg_footer_social_links' , 'get_education_footer_social_links' );
function get_education_footer_social_links(){
    return [];
}

add_filter( 'bizberg_theme_color', 'get_education_change_theme_color' );
add_filter( 'bizberg_header_menu_color_hover_sticky_menu', 'get_education_change_theme_color' );
add_filter( 'bizberg_header_button_color_sticky_menu', 'get_education_change_theme_color' );
add_filter( 'bizberg_header_button_color_hover_sticky_menu', 'get_education_change_theme_color' );
add_filter( 'bizberg_transparent_header_menu_color_hover', 'get_education_change_theme_color' );
add_filter( 'bizberg_transparent_header_sticky_menu_color_hover', 'get_education_change_theme_color' );
add_filter( 'bizberg_header_menu_color_hover', 'get_education_change_theme_color' );
add_filter( 'bizberg_header_button_color', 'get_education_change_theme_color' );
add_filter( 'bizberg_header_button_color_hover', 'get_education_change_theme_color' );
add_filter( 'bizberg_slider_title_box_highlight_color', 'get_education_change_theme_color' );
add_filter( 'bizberg_slider_arrow_background_color', 'get_education_change_theme_color' );
add_filter( 'bizberg_slider_dot_active_color', 'get_education_change_theme_color' );
add_filter( 'bizberg_read_more_background_color', 'get_education_change_theme_color' );
add_filter( 'bizberg_read_more_background_color_2', 'get_education_change_theme_color' );
add_filter( 'bizberg_link_color_hover', 'get_education_change_theme_color' );
add_filter( 'bizberg_blog_listing_pagination_active_hover_color', 'get_education_change_theme_color' );
add_filter( 'bizberg_sidebar_widget_link_color_hover', 'get_education_change_theme_color' );
add_filter( 'bizberg_sidebar_widget_title_color', 'get_education_change_theme_color' );
add_filter( 'bizberg_footer_social_icon_background', 'get_education_change_theme_color' );
function get_education_change_theme_color(){
    return '#ffb606';
}

add_filter( 'bizberg_link_color', 'get_education_bizberg_link_color' );
function get_education_bizberg_link_color(){
    return '#64686d';
}

add_filter( 'bizberg_three_col_listing_radius', 'get_education_three_col_listing_radius' );
function get_education_three_col_listing_radius(){
    return '0';
}

add_filter( 'bizberg_transparent_header_homepage', 'get_education_transparent_header_homepage' );
function get_education_transparent_header_homepage(){
    return true;
}

add_filter( 'bizberg_transparent_navbar_background', 'get_education_transparent_navbar_background' );
function get_education_transparent_navbar_background(){
    return 'rgba(10,10,10,0)';
}

add_filter( 'bizberg_header_blur', 'get_education_header_blur' );
function get_education_header_blur(){
    return 0;
}

add_filter( 'bizberg_transparent_header_menu_sticky_background', 'get_education_transparent_header_menu_sticky_background' );
add_filter( 'bizberg_transparent_header_menu_toggle_color_mobile', 'get_education_transparent_header_menu_sticky_background' );
function get_education_transparent_header_menu_sticky_background(){
    return '#fff';
}

add_filter( 'bizberg_transparent_header_menu_sticky_text_color', 'get_education_transparent_header_menu_sticky_text_color' );
function get_education_transparent_header_menu_sticky_text_color(){
    return '#64686d';
}

add_filter( 'bizberg_banner_spacing', 'get_education_banner_spacing' );
function get_education_banner_spacing(){
    return [
        'padding-top'    => '160px',
        'padding-bottom' => '110px',
        'padding-left'   => '0px',
        'padding-right'  => '300px',
    ];
}

add_filter( 'bizberg_banner_image', 'get_education_banner_image' );
function get_education_banner_image(){
    return [
        'background-color'      => 'rgba(20,20,20,.8)',
        'background-image'      => get_stylesheet_directory_uri() . '/img/person-student-professional-room-conversation-education-115778-pxhere.com.jpg',
        'background-repeat'     => 'repeat',
        'background-position'   => 'center center',
        'background-size'       => 'cover',
        'background-attachment' => 'fixed'
    ];
}

add_filter( 'bizberg_banner_title', 'get_education_banner_title' );
function get_education_banner_title(){
    return esc_html__( 'Start learning from the world’s best.', 'get-education' );
}

add_filter( 'bizberg_banner_subtitle', 'get_education_banner_subtitle' );
function get_education_banner_subtitle(){
    return esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour.', 'get-education' );
}

add_filter( 'bizberg_banner_title_font_status' , 'get_education_banner_title_font_status' );
function get_education_banner_title_font_status(){
    return true;
}

add_filter( 'bizberg_banner_title_font_desktop' , 'get_education_banner_title_font_desktop' );
function get_education_banner_title_font_desktop(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => '900',
        'font-size'      => '80px',
        'line-height'    => '1',
        'letter-spacing' => '0',
        'text-transform' => 'none'
    ];
}

add_filter( 'bizberg_banner_title_font_tablet' , 'get_education_banner_title_font_tablet' );
function get_education_banner_title_font_tablet(){
    return [
        'font-size'      => '70px',
        'line-height'    => '1',
        'letter-spacing' => '0'
    ];
}

add_filter( 'bizberg_banner_title_font_mobile' , 'get_education_banner_title_font_mobile' );
function get_education_banner_title_font_mobile(){
    return [
        'font-size'      => '55px',
        'line-height'    => '1',
        'letter-spacing' => '0'
    ];
}

add_filter( 'bizberg_banner_subtitle_font_status' , 'get_education_banner_subtitle_font_status' );
function get_education_banner_subtitle_font_status(){
    return true;
}

add_filter( 'bizberg_banner_subtitle_font_settings_desktop' , 'get_education_banner_subtitle_font_settings_desktop' );
function get_education_banner_subtitle_font_settings_desktop(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => 'regular',
        'font-size'      => '20px',
        'line-height'    => '1.4',
        'letter-spacing' => '0',
        'text-transform' => 'none'
    ];
}

add_filter( 'bizberg_transparent_header_sticky_menu_toggle_color_mobile' , 'get_education_transparent_header_sticky_menu_toggle_color_mobile' );
function get_education_transparent_header_sticky_menu_toggle_color_mobile(){
    return '#434343';
}

add_filter( 'bizberg_site_title_font', 'get_education_site_title_font' );
function get_education_site_title_font(){
    return [
        'font-family'    => 'Montserrat',
        'variant'        => '600',
        'font-size'      => '23px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'uppercase',
        'text-align'     => 'left',
    ];
}

add_filter( 'bizberg_site_tagline_font', 'get_education_site_tagline_font' );
function get_education_site_tagline_font(){
    return [
        'font-family'    => 'Montserrat',
        'variant'        => '300',
        'font-size'      => '13px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'none',
        'text-align'     => 'left',
    ];
}

add_filter( 'bizberg_background_color_1', 'get_education_change_top_bar_color' );
add_filter( 'bizberg_background_color_2', 'get_education_change_top_bar_color' );
function get_education_change_top_bar_color(){
    return '#ffb606';
}

add_filter( 'bizberg_sidebar_spacing_status', 'get_education_sidebar_spacing_status' );
function get_education_sidebar_spacing_status(){
    return '0px';
}

add_filter( 'bizberg_sidebar_widget_border_color', 'get_education_sidebar_widget_background_color' );
add_filter( 'bizberg_sidebar_widget_background_color', 'get_education_sidebar_widget_background_color' );
function get_education_sidebar_widget_background_color(){
    return 'rgba(251,251,251,0)';
}

add_filter( 'bizberg_getting_started_screenshot', 'get_education_getting_started_screenshot' );
function get_education_getting_started_screenshot(){
    return true;
}

add_action( 'after_switch_theme', 'get_education_switch_theme' );
function get_education_switch_theme() {

    $flag = get_theme_mod( 'get_education_copy_settings', false );

    if ( true === $flag ) {
        return;
    }

    foreach( Kirki::$fields as $field ) {
        set_theme_mod( $field["settings"],$field["default"] );
    }

    //Set flag
    set_theme_mod( 'get_education_copy_settings', true );
    
}