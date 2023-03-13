<?php
/**
 * The template for displaying all pages
 * 
 * @subpackage Education Insight
 * @since 1.0
 */

get_header(); ?>

<main id="content">
	<div class="container" id="custom-a-tag">
		<div id="primary" class="content-area entry-content">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/page/content', 'page' );

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main>
		</div>
	</div>
</main>

<?php get_footer();
