<?php
$terms     = array();
$terms_all = stm_lms_get_lms_terms_with_meta( 'course_icon', null, array( 'number' => 10 ) );

if ( ! empty( $terms_all ) ) {
	foreach ( $terms_all as $term ) {
		$meta_value = get_term_meta( $term->term_id, 'course_icon', true );

		if ( ! empty( $meta_value ) ) {
			$terms[] = array(
				'id'    => $term->term_id,
				'image' => $meta_value,
				'title' => $term->name,
			);
		}
	}
}
?>

<?php if ( ! empty( $terms ) ) : ?>
	<div class="stm_lms_user_float_menu__tabs heading_font">
		<a href="#" class="active" data-show=".stm_lms_user_float_menu__login">
			<?php esc_html_e( 'Login', 'masterstudy-lms-learning-management-system' ); ?>
		</a>
		<a href="#" data-show=".stm_lms_user_float_menu__categories"><?php esc_html_e( 'Categories', 'masterstudy-lms-learning-management-system' ); ?></a>
	</div>
<?php endif; ?>

<div class="stm_lms_user_float_menu__scrolled logged-out-content">

	<div class="stm_lms_user_float_menu__login">

		<div class="stm_lms_user_float_menu__empty heading_font">
			<span>
				<?php esc_html_e( 'Hey, Please Login', 'masterstudy-lms-learning-management-system' ); ?>
			</span>
			<i class="fa fa-user"></i>
		</div>

		<div class="stm_lms_user_float_menu__login_head">
			<h4><?php esc_html_e( 'Sign in', 'masterstudy-lms-learning-management-system' ); ?></h4>
			<a href="<?php echo esc_url( STM_LMS_User::login_page_url() ); ?>"><?php esc_html_e( 'Registration', 'masterstudy-lms-learning-management-system' ); ?></a>
		</div>

		<?php STM_LMS_Templates::show_lms_template( 'account/v1/login' ); ?>

		<div class="heading_font">
			<?php do_action( 'stm_lms_login_end' ); ?>
		</div>
	</div>

	<?php if ( ! empty( $terms ) ) : ?>
		<div class="stm_lms_user_float_menu__categories __hidden">
			<?php foreach ( $terms as $term_order => $term ) : ?>
				<?php
				STM_LMS_Templates::show_lms_template(
					'account/float_menu/menu_items/dynamic_menu_item',
					array(
						'order'        => 150,
						'lms_template' => 'stm-lms-taxonomy',
						'menu_title'   => $term['title'],
						'menu_icon'    => $term['image'],
						'menu_url'     => get_term_link( $term['id'], 'stm_lms_course_taxonomy' ),
						'font_pack'    => '',
					)
				);
				?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

</div>
