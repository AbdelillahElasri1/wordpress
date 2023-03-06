<?php
$post_category = get_the_category();
$author_link   = get_the_author_posts_link();
$author_name   = get_the_author_meta( 'display_name' );
$posted        = get_the_time( 'U' );
?>

<div class="post-info">

	<?php if ( $post_category ) : ?>
		<div class="post-info__item post-categories">
			<h6 class="screen-reader-text"><?php esc_html_e( 'Categories:', 'starter-text-domain' ); ?></h6>
			<?php echo wp_kses_post( get_the_category_list( esc_html__( ', ', 'starter-text-domain' ) ) ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $author_link ) : ?>
		<div class="post-info__item post-author">
			<span class="screen-reader-text"><?php esc_html_e( 'Posted by: ', 'starter-text-domain' ); ?></span>
			<?php echo wp_kses_post( $author_link ); ?>
		</div>
	<?php endif; ?>

	<?php if ( $posted ) : ?>
		<div class="post-info__item post-date">
			<?php echo esc_html( human_time_diff( $posted, time() ) . ' ago' ); ?>
		</div>
	<?php endif; ?>

	<div class="post-info__item post-comment">
		<?php comments_number( 'No comments', '1 Comment', '% Comments' ); ?>
	</div>

</div>
