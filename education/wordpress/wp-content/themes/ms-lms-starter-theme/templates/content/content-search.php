<h1><?php esc_html_e( 'Search results', 'starter-text-domain' ); ?></h1>
<?php if ( have_posts() ) : ?>
	<div class="posts-template">
		<?php
		while ( have_posts() ) {
			the_post();
			?>
			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php get_template_part( 'templates/post/parts/featured-image' ); ?>
				<div class="post-main">
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
		?>
	</div>
<?php else : ?>
	<p><?php esc_html_e( 'Sorry, nothing was found', 'starter-text-domain' ); ?></p>
<?php endif; ?>
