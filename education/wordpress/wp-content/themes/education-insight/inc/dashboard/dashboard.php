<?php

add_action( 'admin_menu', 'education_insight_gettingstarted' );
function education_insight_gettingstarted() {
	add_theme_page( esc_html__('Theme Documentation', 'education-insight'), esc_html__('Theme Documentation', 'education-insight'), 'edit_theme_options', 'education-insight-guide-page', 'education_insight_guide');
}

function education_insight_admin_theme_style() {
   wp_enqueue_style('education-insight-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/dashboard.css');
}
add_action('admin_enqueue_scripts', 'education_insight_admin_theme_style');

if ( ! defined( 'EDUCATION_INSIGHT_SUPPORT' ) ) {
	define('EDUCATION_INSIGHT_SUPPORT',__('https://wordpress.org/support/theme/education-insight/','education-insight'));
}
if ( ! defined( 'EDUCATION_INSIGHT_REVIEW' ) ) {
	define('EDUCATION_INSIGHT_REVIEW',__('https://wordpress.org/support/theme/education-insight/reviews/','education-insight'));
}
if ( ! defined( 'EDUCATION_INSIGHT_LIVE_DEMO' ) ) {
define('EDUCATION_INSIGHT_LIVE_DEMO',__('https://www.ovationthemes.com/demos/education-insight/','education-insight'));
}
if ( ! defined( 'EDUCATION_INSIGHT_BUY_PRO' ) ) {
define('EDUCATION_INSIGHT_BUY_PRO',__('https://www.ovationthemes.com/wordpress/education-wordpress-theme/','education-insight'));
}
if ( ! defined( 'EDUCATION_INSIGHT_PRO_DOC' ) ) {
define('EDUCATION_INSIGHT_PRO_DOC',__('https://ovationthemes.com/docs/ot-education-insight-pro/','education-insight'));
}
if ( ! defined( 'EDUCATION_INSIGHT_THEME_NAME' ) ) {
define('EDUCATION_INSIGHT_THEME_NAME',__('Premium Education Theme','education-insight'));
}

/**
 * Theme Info Page
 */
function education_insight_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$education_insight_theme = wp_get_theme(); ?>

	<div class="getting-started__header">
		<div class="col-md-10">
			<h2><?php echo esc_html( $education_insight_theme ); ?></h2>
			<p><?php esc_html_e('Version: ', 'education-insight'); ?><?php echo esc_html($education_insight_theme['Version']);?></p>
		</div>
		<div class="col-md-2">
			<div class="btn_box">
				<a class="button-primary" href="<?php echo esc_url( EDUCATION_INSIGHT_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support', 'education-insight'); ?></a>
				<a class="button-primary" href="<?php echo esc_url( EDUCATION_INSIGHT_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'education-insight'); ?></a>
			</div>
		</div>
	</div>

	<div class="wrap getting-started">
		<div class="container">
			<div class="col-md-9">
				<div class="leftbox">
					<h3><?php esc_html_e('Documentation','education-insight'); ?></h3>
					<p><?php esc_html_e('To setup the education theme follow the below steps.','education-insight'); ?></p>

					<h4><?php esc_html_e('1. Setup Logo','education-insight'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Site Identity >> Upload your logo or Add site title and site description.','education-insight'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','education-insight'); ?></a>

					<h4><?php esc_html_e('2. Setup Contact Info','education-insight'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Contact info >> Add your phone number and email address.','education-insight'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=education_insight_top') ); ?>" target="_blank"><?php esc_html_e('Add Contact Info','education-insight'); ?></a>

					<h4><?php esc_html_e('3. Setup Menus','education-insight'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Menus >> Create Menus >> Add pages, post or custom link then save it.','education-insight'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Add Menus','education-insight'); ?></a>

					<h4><?php esc_html_e('4. Setup Social Icons','education-insight'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Social Media >> Add social links.','education-insight'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=education_insight_urls') ); ?>" target="_blank"><?php esc_html_e('Add Social Icons','education-insight'); ?></a>

					<h4><?php esc_html_e('5. Setup Footer','education-insight'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Widgets >> Add widgets in footer 1, footer 2, footer 3, footer 4. >> ','education-insight'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widgets','education-insight'); ?></a>

					<h4><?php esc_html_e('5. Setup Footer Text','education-insight'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Footer Text >> Add copyright text. >> ','education-insight'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=education_insight_footer_copyright') ); ?>" target="_blank"><?php esc_html_e('Footer Text','education-insight'); ?></a>

					<h3><?php esc_html_e('Setup Home Page','education-insight'); ?></h3>
					<p><?php esc_html_e('To step the home page follow the below steps.','education-insight'); ?></p>

					<h4><?php esc_html_e('1. Setup Page','education-insight'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Pages >> Add New Page >> Select "Custom Home Page" from templates >> Publish it.','education-insight'); ?></p>
					<a class="dashboard_add_new_page button-primary"><?php esc_html_e('Add New Page','education-insight'); ?></a>

					<h4><?php esc_html_e('2. Setup Slider','education-insight'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post >> Add title, content and featured image >> Publish it.','education-insight'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Slider Settings >> Select post.','education-insight'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=education_insight_slider_section') ); ?>" target="_blank"><?php esc_html_e('Add Slider','education-insight'); ?></a>

					<h4><?php esc_html_e('3. Setup Services','education-insight'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Pages >> Add New Pages >> Add title, content and featured image >> Publish it.','education-insight'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Services Settings >> Select page','education-insight'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=education_insight_middle_section') ); ?>" target="_blank"><?php esc_html_e('Add Services Page','education-insight'); ?></a>

					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post >> Add title, content and featured image >> Publish it.','education-insight'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Services Settings >> Select post','education-insight'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Services Settings >> Add Fontawesome icons classes ex: fas fa-envelope','education-insight'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=education_insight_middle_section') ); ?>" target="_blank"><?php esc_html_e('Add Services Post','education-insight'); ?></a>

					<h4><?php esc_html_e('4. Setup Courses','education-insight'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post Category >> Add New Post >> Add title, content, select post category and featured image >> Publish it.','education-insight'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Courses Settings >> Add section heading and select post category.','education-insight'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=education_insight_popular_courses') ); ?>" target="_blank"><?php esc_html_e('Add Courses','education-insight'); ?></a>
				</div>
          	</div>
			<div class="col-md-3">
				<h3><?php echo esc_html(EDUCATION_INSIGHT_THEME_NAME); ?></h3>
				<img class="education_insight_img_responsive" style="width: 100%;" src="<?php echo esc_url( $education_insight_theme->get_screenshot() ); ?>" />
				<div class="pro-links">
					<hr>
					<a class="button-primary buynow" href="<?php echo esc_url( EDUCATION_INSIGHT_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'education-insight'); ?></a>
			    	<a class="button-primary livedemo" href="<?php echo esc_url( EDUCATION_INSIGHT_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'education-insight'); ?></a>
					<a class="button-primary docs" href="<?php echo esc_url( EDUCATION_INSIGHT_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'education-insight'); ?></a>
					<hr>
				</div>
				<ul style="padding-top:10px">
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'education-insight');?> </li>
                </ul>
        	</div>
		</div>
	</div>

<?php }?>
