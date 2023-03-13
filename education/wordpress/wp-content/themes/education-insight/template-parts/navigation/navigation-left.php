<?php
/**
 * Displays top navigation
 *
 * @subpackage Education Insight
 * @since 1.0
 */
?>

<div id="gb_responsive" class="nav side_gb_nav">
	<nav id="top_gb_menu" class="gb_nav_menu" role="navigation" aria-label="<?php esc_attr_e( 'Left Side Menu', 'education-insight' ); ?>">
		<?php if(has_nav_menu('primary-1')){
		    wp_nav_menu( array( 
				'theme_location' => 'primary-1',
				'container_class' => 'gb_navigation clearfix' ,
				'menu_class' => 'clearfix',
				'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
				'fallback_cb' => 'wp_page_menu',
		    ) ); 
		} ?>
	</nav>
</div>