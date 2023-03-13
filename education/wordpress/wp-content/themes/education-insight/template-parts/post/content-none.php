<?php
/**
 * Template part for displaying a message that posts cannot be found
 * 
 * @subpackage Education Insight
 * @since 1.0
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'education-insight' ); ?></h1>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
				<?php
				/* translators: %s: Post editor URL. */
				printf( esc_html__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'education-insight' ), esc_url( admin_url( 'post-new.php' ) ) );
				?>
			</p>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'education-insight' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div>
</section>