<?php
function stm_lms_settings_general_section() {
	return array(
		'name'   => esc_html__( 'General', 'masterstudy-lms-learning-management-system' ),
		'label'  => esc_html__( 'General Settings', 'masterstudy-lms-learning-management-system' ),
		'icon'   => 'fas fa-sliders-h',
		'fields' => array(
			/*GROUP STARTED*/
			'main_color'            => array(
				'group'       => 'started',
				'type'        => 'color',
				'label'       => esc_html__( 'Main color', 'masterstudy-lms-learning-management-system' ),
				'columns'     => '33',
				'group_title' => esc_html__( 'Colors', 'masterstudy-lms-learning-management-system' ),
			),
			'secondary_color'       => array(
				'group'   => 'ended',
				'type'    => 'color',
				'label'   => esc_html__( 'Secondary color', 'masterstudy-lms-learning-management-system' ),
				'columns' => '33',
			),
			/*GROUP ENDED*/

			/*GROUP STARTED*/
			'currency_symbol'       => array(
				'group'       => 'started',
				'type'        => 'text',
				'label'       => esc_html__( 'Currency symbol', 'masterstudy-lms-learning-management-system' ),
				'columns'     => '50',
				'group_title' => esc_html__( 'Currency', 'masterstudy-lms-learning-management-system' ),
				'description' => esc_html__( 'This controls what currency prices are listed at in the catalog and which currency gateways will take payments in.', 'masterstudy-lms-learning-management-system' ),
			),
			'currency_position'     => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Currency Position', 'masterstudy-lms-learning-management-system' ),
				'value'       => 'left',
				'options'     => array(
					'left'  => esc_html__( 'Left', 'masterstudy-lms-learning-management-system' ),
					'right' => esc_html__( 'Right', 'masterstudy-lms-learning-management-system' ),
				),
				'columns'     => '50',
				'description' => esc_html__( 'This controls the position of the currency symbol.', 'masterstudy-lms-learning-management-system' ),
			),
			'currency_thousands'    => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Thousands Separator', 'masterstudy-lms-learning-management-system' ),
				'value'       => ',',
				'columns'     => '33',
				'description' => esc_html__( 'This sets the thousand separator of displayed prices.', 'masterstudy-lms-learning-management-system' ),
			),
			'currency_decimals'     => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Decimals Separator', 'masterstudy-lms-learning-management-system' ),
				'value'       => '.',
				'columns'     => '33',
				'description' => esc_html__( 'This sets the decimal separator of displayed prices.', 'masterstudy-lms-learning-management-system' ),
			),
			'decimals_num'          => array(
				'group'       => 'ended',
				'type'        => 'number',
				'label'       => esc_html__( 'Number of decimals', 'masterstudy-lms-learning-management-system' ),
				'value'       => 2,
				'columns'     => '33',
				'description' => esc_html__( 'This sets the number of decimal points shown in displayed prices.', 'masterstudy-lms-learning-management-system' ),
			),
			/*GROUP ENDED*/
			'wocommerce_checkout'   => array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Enable WooCommerce Checkout', 'masterstudy-lms-learning-management-system' ),
				'hint'    => esc_html__( 'Note, you need to install WooCommerce, and set Cart and Checkout Pages', 'masterstudy-lms-learning-management-system' ),
				'pro'     => true,
				'pro_url' => 'https://stylemixthemes.com/wordpress-lms-plugin/?utm_source=wpadmin-ms&utm_medium=ms-settings&utm_campaign=general-settings-get-pro',
			),
			'guest_checkout'        => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable Guest Checkout', 'masterstudy-lms-learning-management-system' ),
			),
			'guest_checkout_notice' => array(
				'type'         => 'notice_banner',
				'label'        => esc_html__( 'Required to enable guest checkout in WooCommerce', 'masterstudy-lms-learning-management-system' ),
				'dependency'   => array(
					array(
						'key'   => 'wocommerce_checkout',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'guest_checkout',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
			),
			'author_fee'            => array(
				'type'        => 'number',
				'label'       => esc_html__( 'Instructor earnings (%)', 'masterstudy-lms-learning-management-system' ),
				'value'       => '10',
				'pro'         => true,
				'pro_url'     => 'https://stylemixthemes.com/wordpress-lms-plugin/?utm_source=wpadmin-ms&utm_medium=ms-settings&utm_campaign=general-settings-get-pro',
				'description' => esc_html__( '% that instructors get from sales', 'masterstudy-lms-learning-management-system' ),
			),
			'courses_featured_num'  => array(
				'type'    => 'number',
				'label'   => esc_html__( 'Number of free featured', 'masterstudy-lms-learning-management-system' ),
				'value'   => 1,
				'pro'     => true,
				'pro_url' => 'https://stylemixthemes.com/wordpress-lms-plugin/?utm_source=wpadmin-ms&utm_medium=ms-settings&utm_campaign=general-settings-get-pro',
			),
			'deny_instructor_admin' => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Deny Instructors from accessing the admin panel (redirects to personal profile)', 'masterstudy-lms-learning-management-system' ),
			),
			'ms_plugin_preloader'   => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable Preloader', 'masterstudy-lms-learning-management-system' ),
				'value' => false,
			),
		),
	);
}
