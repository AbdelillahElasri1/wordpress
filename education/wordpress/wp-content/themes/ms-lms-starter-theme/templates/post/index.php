<?php
$settings         = get_option( 'stm_theme_settings', array() );
$sidebar          = ( $settings['post-sidebar'] ) ? $settings['post-sidebar'] : 'primary-sidebar';
$sidebar_position = ( $settings['post-sidebar-position'] ) ? 'sidebar-position-' . $settings['post-sidebar-position'] : 'sidebar-position-right';
$post_layout      = ( $settings['post_layout'] ) ? 'post-layout-' . $settings['post_layout'] : 'post-layout-list';

if ( have_posts() ) : ?>
	<div class="posts-template <?php echo esc_attr( $post_layout ); ?>">
		<?php if ( ! empty( $sidebar ) ) : ?>
			<div class="row <?php echo esc_attr( $sidebar_position ); ?>">
				<div class="stm-col-xl-9">
			<?php
		endif;
		while ( have_posts() ) {
			the_post();
			?>
			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php get_template_part( 'templates/post/parts/featured-image' ); ?>
				<div class="post-main">
					<?php if ( is_sticky() ) : ?>
						<div class="post-sticky-badge"><?php esc_html_e( 'Sticky post', 'starter-text-domain' ); ?></div>
					<?php endif; ?>
					<?php
					get_template_part( 'templates/post/parts/title' );
					get_template_part( 'templates/post/parts/content' );
					get_template_part( 'templates/post/parts/info' );
					?>
				</div>
			</section>
			<?php
		}
			posts_pages_pagination( 'posts_pages_pagination' );
			wp_reset_postdata();
		if ( ! empty( $sidebar ) ) :
			?>
				</div>
				<div class="stm-col-xl-3">
					<?php get_sidebar(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
