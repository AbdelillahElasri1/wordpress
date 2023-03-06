<?php
$post_tags = get_the_tags();

if ( $post_tags ) : ?>
	<div class="post-tags-list">
		<h6><?php esc_html_e( 'Tags:', 'starter-text-domain' ); ?></h6>
		<?php foreach ( $post_tags as $post_tag ) : ?>
			<a href="<?php echo esc_url( get_tag_link( $post_tag ) ); ?>" title="<?php echo esc_attr( $post_tag->name ); ?>">
				<?php echo esc_attr( $post_tag->name ); ?>
			</a>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
