<?php

add_action( 'vc_after_init', 'stm_lms_courses_featured_teacher_vc' );

function stm_lms_courses_featured_teacher_vc() {

	vc_map(
		array(
			'name'           => esc_html__( 'STM LMS Featured Teacher', 'masterstudy-lms-learning-management-system' ),
			'base'           => 'stm_lms_featured_teacher',
			'icon'           => 'stm_lms_featured_teacher',
			'description'    => esc_html__( 'Place Single Teacher', 'masterstudy-lms-learning-management-system' ),
			'html_template'  => STM_LMS_Templates::vc_locate_template( 'vc_templates/stm_lms_featured_teacher' ),
			'php_class_name' => 'WPBakeryShortCode_Stm_Lms_Ms_Featured_Teacher',
			'category'       => array(
				esc_html__( 'Content', 'masterstudy-lms-learning-management-system' ),
			),
			'params'         => array(
				array(
					'type'       => 'autocomplete',
					'heading'    => esc_html__( 'Select taxonomy', 'masterstudy-lms-learning-management-system' ),
					'param_name' => 'instructor',
					'settings'   => array(
						'multiple'       => false,
						'sortable'       => true,
						'min_length'     => 1,
						'max_length'     => 1,
						'no_hide'        => true,
						'unique_values'  => true,
						'display_inline' => true,
						'delay'          => 500,
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Number of courses to show', 'masterstudy-lms-learning-management-system' ),
					'param_name' => 'posts_per_page',
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Number of courses per row', 'masterstudy-lms-learning-management-system' ),
					'param_name' => 'posts_per_row',
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Instructor Position', 'masterstudy-lms-learning-management-system' ),
					'param_name' => 'position',
				),
				array(
					'type'       => 'textarea',
					'heading'    => __( 'Instructor Bio', 'masterstudy-lms-learning-management-system' ),
					'param_name' => 'bio',
				),
				array(
					'type'       => 'attach_image',
					'heading'    => __( 'Image', 'masterstudy-lms-learning-management-system' ),
					'param_name' => 'image',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'masterstudy-lms-learning-management-system' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'masterstudy-lms-learning-management-system' ),
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'All instructor courses button text', 'masterstudy-lms-learning-management-system' ),
					'param_name' => 'instructor_btn_text',
				),
			),
		)
	);
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Stm_Lms_Ms_Featured_Teacher extends WPBakeryShortCode {
	}
}


//Filters For autocomplete param:
//For suggestion:
add_filter(
	'vc_autocomplete_stm_lms_featured_teacher_instructor_callback',
	function ( $search ) {
		$users = array();
		$args  = array(
			'blog_id'        => $GLOBALS['blog_id'],
			'role__in'       => array( 'stm_lms_instructor' ),
			'number'         => 5,
			'search'         => '*' . sanitize_text_field( $search ) . '*',
			'search_columns' => array(
				'user_login',
				'user_nicename',
				'user_email',
			),
		);

		$blog_users = get_users( $args );
		foreach ( $blog_users as $user ) {
			$user_id = $user->ID;
			$name    = ( ! empty( $user->data->display_name ) ) ? $user->data->display_name : $user->data->user_login;
			$users[] = array(
				'label' => $name,
				'value' => $user_id,
			);
		}

		return $users;
	},
	10,
	1
);
