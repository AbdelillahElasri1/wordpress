<?php
/**
 * Init Styles & scripts
 */

function masterstudy_starter_admin_script_styles() {
	wp_enqueue_script( 'admin_masterstudy_starter_script', STM_TEMPLATE_URI . '/includes/dashboard/assets/js/admin_scripts.js', array( 'jquery' ), STM_THEME_VERSION, true );
	wp_enqueue_style( 'admin_masterstudy_starter_style', STM_TEMPLATE_URI . '/includes/dashboard/assets/css/admin_styles.css', '', STM_THEME_VERSION );
}

add_action( 'admin_enqueue_scripts', 'masterstudy_starter_admin_script_styles' );

function masterstudy_starter_show_nav_item() {

	add_menu_page(
		esc_html__( 'Welcome to Masterstudy Starter Page', 'masterstudy_starter' ),
		esc_html__( 'Masterstudy Starter', 'masterstudy_starter' ),
		'manage_options',
		'masterstudy-starter-options',
		'masterstudy_starter_admin_page_content',
		STM_TEMPLATE_URI . '/assets/images/base/icon.png',
		'2'
	);
}

add_action( 'admin_menu', 'masterstudy_starter_show_nav_item' );

function masterstudy_starter_admin_page_content() {
	?>
	<div class="starter-row">
		<div class="starter-column has-content">
			<div class="content">
				<div class="logo">
					<img src="<?php echo esc_url( STM_TEMPLATE_URI . '/assets/images/base/starter_logo.svg' ); ?>" alt="">
				</div>
				<div class="text">MasterStudy Strater is a free WordPress theme for MasterStudy LMS, the popular
					eLearning plugin for WordPress. The fully customizable pre-built home layout with inner pages is
					ready in one-click demo import so no coding is required.
				</div>
				<div class="actions">
					<a href="https://docs.stylemixthemes.com/masterstudy-lms-starter-theme/" target="_blank" class="documentation starter-wpcfto-documentation starter-btn">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z"/></svg>
						Documentation</a>
					<a href="https://docs.stylemixthemes.com/masterstudy-lms-starter-theme/extra-materials/changelog" target="_blank" class="changelog starter-transients starter-btn">Changelog</a>
				</div>
			</div>
			<img src="<?php echo esc_url( STM_TEMPLATE_URI . '/assets/images/base/admin-left.jpg' ); ?>" alt="">
		</div>
		<div class="starter-column">
			<a href="https://stylemixthemes.com/masterstudy/" target="_blank" class="explore-courses">
				<img src="<?php echo esc_url( STM_TEMPLATE_URI . '/assets/images/base/admin-right.jpg' ); ?>" alt="">
			</a>
		</div>
	</div>
	<?php
}
