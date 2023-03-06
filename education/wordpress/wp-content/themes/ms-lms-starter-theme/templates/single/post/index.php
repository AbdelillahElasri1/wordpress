<?php
$settings         = get_option( 'stm_theme_settings', array() );
$sidebar          = ( $settings['single-post-sidebar'] ) ? $settings['single-post-sidebar'] : 'primary-sidebar';
$sidebar_position = ( $settings['single-post-sidebar-position'] ) ? 'sidebar-position-' . $settings['single-post-sidebar-position'] : 'sidebar-position-right';

if ( ! empty( $sidebar ) ) :
	?>
<div class="row <?php echo esc_attr( $sidebar_position ); ?>">
	<div class="stm-col-xl-9">
		<?php
		endif;
if ( have_posts() ) {
	echo '<main id="content">';
	while ( have_posts() ) :
		the_post();
		get_template_part( 'templates/single/post/parts/title' );
		get_template_part( 'templates/single/post/parts/info' );
		get_template_part( 'templates/single/post/parts/share' );
		get_template_part( 'templates/single/post/parts/thumbnail' );
		get_template_part( 'templates/single/post/parts/content' );
		get_template_part( 'templates/single/post/parts/next-page' );
		get_template_part( 'templates/single/post/parts/tags' );
		get_template_part( 'templates/single/post/parts/author' );
		get_template_part( 'templates/single/post/parts/share' );
		get_template_part( 'templates/single/post/parts/post-nav' );
		get_template_part( 'templates/single/post/parts/comments' );
	endwhile;
	echo '</main>';
} else {
	get_template_part( 'templates/content', 'none' );
}
if ( ! empty( $sidebar ) ) :
	?>
	</div>
	<div class="stm-col-xl-3">
		<?php get_sidebar(); ?>
	</div>
	<?php endif; ?>
</div>
