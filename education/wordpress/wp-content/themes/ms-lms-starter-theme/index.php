<?php get_header(); ?>
<div id="wrapper" class="wrapper">
	<div class="container">
		<?php get_template_part( 'templates/' . get_post_type() . '/index' ); ?>
	</div>
</div>
<?php
get_footer();
