<h2><?php esc_html_e('My Wishlist', 'masterstudy-lms-learning-management-system'); ?></h2>

<?php if(!empty($_COOKIE['stm_lms_wishlist'])):
	$wishlist = sanitize_text_field($_COOKIE['stm_lms_wishlist']);
	$args = array(
		'per_row' => 4,
		'post__in' => explode(',', $wishlist)
	);

	STM_LMS_Templates::show_lms_template('courses/grid', array('args' => $args));

else: ?>
    <h4><?php printf(__('Wishlist is empty. <a href="%s">View courses</a>', 'masterstudy-lms-learning-management-system'), STM_LMS_Course::courses_page_url()); ?></h4>
<?php endif; ?>