<?php
$author_name = get_the_author_meta( 'display_name' );
$author_bio  = get_the_author_meta( 'description' );
?>
<div class="single-post-author-bio">
	<div class="single-post-author-bio__avatar">
		<?php echo get_avatar( get_the_author_meta( 'email' ), 70 ); ?>
	</div>
	<div class="single-post-author-bio__info">
		<div class="single-post-author-bio__name">
			<?php echo esc_html( $author_name ); ?>
		</div>
		<div class="single-post-author-bio__bio">
			<?php echo wp_kses_post( $author_bio ); ?>
		</div>
	</div>
</div>
