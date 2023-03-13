<?php
/**
 * Displays footer site info
 *
 * @subpackage Education Insight
 * @since 1.0
 * @version 1.4
 */

?>

<div class="site-info">
	<?php
		echo esc_html( get_theme_mod( 'education_insight_footer_text' ) );
		printf(
			/* translators: %s: Education WordPress Theme. */
			esc_html__( ' %s ', 'education-insight' ),
			'<a target="_blank" href="' . esc_url( 'https://www.ovationthemes.com/wordpress/free-education-wordpress-theme/') . '"> Education WordPress Theme</a>'
		);
	?>
</div>
