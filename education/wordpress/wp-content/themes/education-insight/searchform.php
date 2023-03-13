<?php
/**
 * Template for displaying search forms in Education Insight
 *
 * @subpackage Education Insight
 * @since 1.0
 */
?>

<?php $education_insight_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'education-insight' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><?php echo esc_html_x( 'Search', 'submit button', 'education-insight' ); ?></button>
</form>