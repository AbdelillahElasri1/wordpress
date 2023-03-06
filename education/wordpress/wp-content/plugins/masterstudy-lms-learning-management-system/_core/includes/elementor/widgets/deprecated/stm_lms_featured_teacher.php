<?php

namespace StmLmsElementor\Widgets;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class StmLmsFeaturedTeacher extends Widget_Base {


	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'stm_lms_featured_teacher';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Featured Teacher', 'masterstudy-lms-learning-management-system' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-user-circle-o lms-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'stm_lms_old' );
	}

	protected function register_controls() {
		$users = array();
		if ( is_admin() ) {
			$blog_users = get_users( "blog_id={$GLOBALS['blog_id']}" );
			foreach ( $blog_users as $user ) {
				$user_id = $user->ID;
				if ( ! \STM_LMS_Instructor::is_instructor( $user_id ) ) {
					continue;
				}
				$name              = ( ! empty( $user->data->display_name ) ) ? $user->data->display_name : $user->data->user_login;
				$users[ $user_id ] = $name;
			}
		}

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'masterstudy-lms-learning-management-system' ),
			)
		);
		$this->add_control(
			'instructor',
			array(
				'name'        => 'instructor',
				'label'       => __( 'Instructor', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => $users,
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'name'        => 'posts_per_page',
				'label'       => __( 'Number of courses to show', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$this->add_control(
			'posts_per_row',
			array(
				'name'        => 'posts_per_row',
				'label'       => __( 'Number of courses per row', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$this->add_control(
			'position',
			array(
				'name'        => 'position',
				'label'       => __( 'Instructor Position', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$this->add_control(
			'bio',
			array(
				'name'        => 'bio',
				'label'       => __( 'Instructor Bio', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			)
		);

		$this->add_control(
			'image',
			array(
				'name'        => 'image',
				'label'       => __( 'Image', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			)
		);

		$this->add_control(
			'instructor_btn_text',
			array(
				'name'        => 'instructor_btn_text',
				'label'       => __( 'All instructor courses button text', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_featured_title_style',
			array(
				'label' => esc_html__( 'Teacher name', 'masterstudy-lms-learning-management-system' ),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name' => 'typography_teacher_name',
				'selector' => '{{WRAPPER}} .stm_lms_featured_teacher_content__text h2',
			)
		);
		$this->add_control(
			'teacher_name_color',
			array(
				'label'     => esc_html__( 'Teacher name color', 'masterstudy-lms-learning-management-system' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .stm_lms_featured_teacher_content__text h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_view_course_card_border_featured',
			array(
				'label' => esc_html__( 'Course Card', 'masterstudy-lms-learning-management-system' ),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name' => 'border',
				'selector' => '{{WRAPPER}} .stm_lms_courses_carousel .owl-stage .owl-item .stm_lms_courses__single__inner',
			)
		);
		$this->add_control(
			'course_card_button_border_radius_featured',
			array(
				'label'      => esc_html__( 'Border Radius', 'masterstudy-lms-learning-management-system' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_lms_courses__single__inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .stm_lms_courses__single--image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0',
					'{{WRAPPER}} .stm_lms_courses__single--image' => 'overflow: hidden',
				),
				'default'    => array(
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10',
					'unit'   => 'px',
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$atts     = array(
			'css'                 => '',
			'instructor'          => ! empty( $settings['instructor'] ) ? $settings['instructor'] : '',
			'position'            => ! empty( $settings['position'] ) ? $settings['position'] : '',
			'bio'                 => ! empty( $settings['bio'] ) ? $settings['bio'] : '',
			'image'               => ! empty( $settings['image']['id'] ) ? $settings['image']['id'] : '',
			'posts_per_page'      => ! empty( $settings['posts_per_page'] ) ? $settings['posts_per_page'] : 4,
			'posts_per_row'       => ! empty( $settings['posts_per_row'] ) ? $settings['posts_per_row'] : 4,
			'instructor_btn_text' => ! empty( $settings['instructor_btn_text'] ) ? $settings['instructor_btn_text'] : '',
		);
		\STM_LMS_Templates::show_lms_template( 'shortcodes/stm_lms_featured_teacher', $atts );
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
	}
}



