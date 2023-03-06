<?php

$prev_next     = starter_get_option( 'post_single_prev_next' );
$post_comments = starter_get_option( 'post_single_comments' );

if ( comments_open() || get_comments_number() || comments_open() && ! empty( $post_comments ) ) : ?>
	<div class="page-post-comments">
		<?php comments_template(); ?>
	</div>
	<?php
endif;
