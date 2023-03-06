<?php
/**
 * Content width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

/**
 * Add Favicon
 */
function starter_get_favicon() {
	$favicon = starter_get_option( 'favicon' );
	if ( $favicon ) {
		echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( wp_get_attachment_url( $favicon ) ) . '" />' . "\n";
	} else {
		echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( get_template_directory_uri() ) . '/favicon.png" />' . "\n";
	}
}

add_action( 'wp_head', 'starter_get_favicon' );

/**
 * Setup settings
 */
if ( ! function_exists( 'starter_setup' ) ) {
	function starter_setup() {
		load_theme_textdomain( 'starter-text-domain', get_template_directory() . '/languages' );
		add_theme_support( 'widgets' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		register_nav_menus(
			array(
				'ms-lms-starter-theme-main-menu' => esc_html__( 'Header menu', 'starter-text-domain' ),
			)
		);
	}
}

add_action( 'after_setup_theme', 'starter_setup' );

/** sub menu in Appearance**/

function add_theme_loader_to_admin_menu() {
	$page_title = esc_html__( 'MasterStudy Starter Demo Import', 'starter-text-domain' );
	add_submenu_page( 'themes.php', $page_title, $page_title, 'manage_options', 'admin.php?page=starter_lms_demo_installer', '' );
}
add_action( 'admin_menu', 'add_theme_loader_to_admin_menu' );

/**
 * Add ping back url
 */
function starter_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'starter_pingback_header' );

/**
 * Custom excerpt size
 */
function starter_minimize_word( $word, $length = '40', $affix = '...' ) {
	if ( ! empty( intval( $length ) ) ) {
		$word_length = mb_strlen( $word );
		if ( $word_length > $length ) {
			$word = mb_strimwidth( $word, 0, $length, $affix );
		}
	}

	return sanitize_text_field( $word );
}

function starter_stored_theme_options() {
	$options = get_option( 'stm_theme_settings', array() );
	return apply_filters( 'starter_stored_theme_options', $options );
}

function starter_get_option( $option_name, $default = false ) {
	$options = starter_stored_theme_options();
	$option  = null;

	if ( ! empty( $options[ $option_name ] ) ) {
		$option = $options[ $option_name ];
	} elseif ( isset( $default ) ) {
		$option = $default;
	}

	return $option;
}

function starter_read_more_link() {
	if ( ! is_admin() ) {
		return '<a href="' . esc_url( get_permalink() ) . '" class="more-link"><span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span></a>';
	}
}

add_filter( 'excerpt_more', 'starter_read_more_link' );

function starter_filter_head() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}

add_action( 'get_header', 'starter_filter_head' );

function starter_admin_bar_css() {
	?>
	<style type="text/css" media="screen">
		body { margin-top: 32px !important; }
		@media screen and (max-width: 782px) { body { margin-top: 46px !important; } }
	</style>
	<?php
}

add_theme_support( 'admin-bar', array( 'callback' => 'starter_admin_bar_css' ) );

function starter_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary sidebar', 'starter-text-domain' ),
			'id'            => 'primary-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'starter-text-domain' ),
			'before_widget' => '<section id="%1$s" class="widget widget-container %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'starter_widgets_init' );

/**
 * Custom Pagination
 */
if ( ! function_exists( 'posts_pages_pagination' ) ) :
	function posts_pages_pagination( $paging_extra_class = '', $current_query = '' ) {
		global $wp_query, $wp_rewrite;

		if ( ! $current_query ) {
			$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			$pages = $wp_query->max_num_pages;
		} else {
			$paged = $current_query->query_vars['paged'];
			$pages = $current_query->max_num_pages;
		}

		if ( $pages < 2 ) {
			return;
		}

		$page_num_link = html_entity_decode( get_pagenum_link() );
		$query_args    = array();
		$url_parts     = explode( '?', $page_num_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$page_num_link = remove_query_arg( array_keys( $query_args ), $page_num_link );
		$page_num_link = trailingslashit( $page_num_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $page_num_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		$links = paginate_links(
			array(
				'base'      => $page_num_link,
				'format'    => $format,
				'total'     => $pages,
				'current'   => $paged,
				'mid_size'  => 1,
				'add_args'  => array_map( 'urlencode', $query_args ),
				'prev_text' => __( 'Prev', 'starter-text-domain' ),
				'next_text' => __( 'Next', 'starter-text-domain' ),
				'type'      => 'list',
			)
		);

		if ( $links ) {
			echo wp_kses_post( $links );
		}
	}
endif;

/*MegaMenu*/
require_once get_template_directory() . '/includes/megamenu/main.php';

add_action( 'admin_head', 'starter_theme_nonces' );

function starter_theme_nonces() {
	$nonces = array(
		'stm_update_starter_theme',
		'starter_lms_settings_save',
	);

	$nonces_list = array();

	foreach ( $nonces as $nonce_name ) {
		$nonces_list[ $nonce_name ] = wp_create_nonce( $nonce_name );
	}

	?>
	<script>
		var starter_theme_nonces = <?php echo json_encode( $nonces_list ); ?>;
	</script>
	<?php
}

add_filter( 'body_class', 'ms_lms_starter_body_classes' );
function ms_lms_starter_body_classes( $classes ) {
	$classes[] = 'theme-ms-lms-starter-theme';
	return $classes;
}
