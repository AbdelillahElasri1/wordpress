<?php
/**
 * Education Insight functions and definitions
 *
 * @subpackage Education Insight
 * @since 1.0
 */


if (!function_exists('education_insight_loop_columns')) {
		function education_insight_loop_columns() {
		return 3;
	}
}
add_filter('loop_shop_columns', 'education_insight_loop_columns');

function education_insight_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function education_insight_sanitize_choices( $education_insight_input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $education_insight_input, $control->choices ) ) {
        return $education_insight_input;
    } else {
        return $setting->default;
    }
}

function education_insight_sanitize_phone_number( $phone ) {
  return preg_replace( '/[^\d+]/', '', $phone );
}

function education_insight_sanitize_select( $education_insight_input, $setting ){
    $education_insight_input = sanitize_key($education_insight_input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $education_insight_input, $choices ) ? $education_insight_input : $setting->default );
}

function education_insight_sanitize_checkbox( $education_insight_input ) {
	return ( ( isset( $education_insight_input ) && true == $education_insight_input ) ? true : false );
}

function education_insight_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

function education_insight_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<div class="link-more"><a href="%1$s" class="more-link">%2$s</a></div>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'education-insight' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'education_insight_excerpt_more' );

function education_insight_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
   		wp_safe_redirect( admin_url("themes.php?page=education-insight-guide-page") );
   	}
}
add_action('after_setup_theme', 'education_insight_notice');

function education_insight_add_new_page() {
  $edit_page = admin_url().'post-new.php?post_type=page';
  echo json_encode(['page_id'=>'','edit_page_url'=> $edit_page ]);

  exit;
}
add_action( 'wp_ajax_education_insight_add_new_page','education_insight_add_new_page' );


function education_insight_setup() {
	add_theme_support( "align-wide" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'education-insight-featured-image', 2000, 1200, true );
	add_image_size( 'education-insight-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary-1' => __( 'Primary Left Menu', 'education-insight' ),
		'primary-2' => __( 'Primary Right Menu', 'education-insight' ),
		'primary-3' => __( 'Mobile Menu', 'education-insight' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', education_insight_fonts_url() ) );

}
add_action( 'after_setup_theme', 'education_insight_setup' );

function education_insight_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'education-insight' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'education-insight' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'education-insight' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'education-insight' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'education-insight' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'education-insight' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'education_insight_widgets_init' );

function education_insight_fonts_url(){
	$education_insight_font_url = '';
	$education_insight_font_family = array();
	$education_insight_font_family[] = 'Roboto Slab:wght@100;200;300;400;500;600;700;800;900';
	$education_insight_font_family[] = 'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900';
	$education_insight_font_family[] = 'Catamaran:wght@100;200;300;400;500;600;700;800;900';
	$education_insight_font_family[] = 'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';

	$education_insight_query_args = array(
		'family'	=> rawurlencode(implode('|',$education_insight_font_family)),
	);
	$education_insight_font_url = add_query_arg($education_insight_query_args,'//fonts.googleapis.com/css');
	return $education_insight_font_url;
	$education_insight_contents = wptt_get_webfont_url( esc_url_raw( $education_insight_fonts_url ) );
}

//Enqueue scripts and styles.
function education_insight_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'education-insight-fonts', education_insight_fonts_url(), array());

	// Bootstarp
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() .'/assets/css/bootstrap.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'education-insight-style', get_stylesheet_uri() );

	// Theme Customize CSS.
	require get_parent_theme_file_path( 'inc/extra_customization.php' );
	wp_add_inline_style( 'education-insight-style',$education_insight_custom_style );

	// font-awesome
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	// Block Style
	wp_enqueue_style( 'education-insight-block-style', get_template_directory_uri().'/assets/css/blocks.css' );

	// Custom JS
	wp_enqueue_script( 'education-insight-custom.js', get_theme_file_uri( '/assets/js/education-insight-custom.js' ), array( 'jquery' ), true );

	// Nav Focus JS
	wp_enqueue_script( 'education-insight-navigation-focus', get_theme_file_uri( '/assets/js/navigation-focus.js' ), array( 'jquery' ), true );

	// Superfish JS
	wp_enqueue_script( 'superfish-js', get_theme_file_uri( '/assets/js/jquery.superfish.js' ), array( 'jquery' ),true );

	// Bootstarp JS
	wp_enqueue_script( 'bootstrap.js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ),true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'education_insight_scripts' );

function education_insight_fonts_scripts() {
	$education_insight_headings_font = esc_html(get_theme_mod('education_insight_headings_text'));
	$education_insight_body_font = esc_html(get_theme_mod('education_insight_body_text'));

	if( $education_insight_headings_font ) {
		wp_enqueue_style( 'education-insight-headings-fonts', '//fonts.googleapis.com/css?family='. $education_insight_headings_font );
	} else {
		wp_enqueue_style( 'education-insight-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
	}
	if( $education_insight_body_font ) {
		wp_enqueue_style( 'education-insight-body-fonts', '//fonts.googleapis.com/css?family='. $education_insight_body_font );
	} else {
		wp_enqueue_style( 'education-insight-source-body', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600');
	}
}
add_action( 'wp_enqueue_scripts', 'education_insight_fonts_scripts' );

function education_insight_enqueue_admin_script( $hook ) {

	// Admin JS
	wp_enqueue_script( 'education-insight-admin.js', get_theme_file_uri( '/assets/js/education-insight-admin.js' ), array( 'jquery' ), true );

	wp_localize_script('education-insight-admin.js', 'education_insight_scripts_localize',
        array(
            'ajax_url' => esc_url(admin_url('admin-ajax.php'))
        )
    );
}
add_action( 'admin_enqueue_scripts', 'education_insight_enqueue_admin_script' );

// Enqueue editor styles for Gutenberg
function education_insight_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'education-insight-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'education-insight-fonts', education_insight_fonts_url(), array());
}
add_action( 'enqueue_block_editor_assets', 'education_insight_block_editor_styles' );

function education_insight_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'education_insight_front_page_template' );

require get_parent_theme_file_path( '/inc/custom-header.php' );

require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/customizer.php' );

require get_parent_theme_file_path( '/inc/dashboard/dashboard.php' );

require get_parent_theme_file_path( '/inc/typofont.php' );

require get_parent_theme_file_path( '/inc/wptt-webfont-loader.php' );

# Load scripts and styles.(fontawesome)
add_action( 'customize_controls_enqueue_scripts', 'education_insight_customize_controls_register_scripts' );

function education_insight_customize_controls_register_scripts() {
	
	wp_enqueue_style( 'education-insight-ctypo-customize-controls-style', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
}