<?php if ( have_posts() ) : ?>
	<div class="pages-template">
		<?php
		while ( have_posts() ) {
			the_post();
			?>
			<section class="page-content">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</section>
			<?php
			get_template_part( 'templates/page/parts/next-page' );
			get_template_part( 'templates/page/parts/comments' );
			?>
		<?php } ?>
	</div>
<?php endif; ?>
