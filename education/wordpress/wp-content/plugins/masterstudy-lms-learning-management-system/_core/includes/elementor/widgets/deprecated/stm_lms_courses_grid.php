<?php

namespace StmLmsElementor\Widgets;

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
class StmLmsCoursesGrid extends Widget_Base {


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
		return 'stm_lms_courses_grid';
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
		return __( 'Courses Grid', 'masterstudy-lms-learning-management-system' );
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
		return 'stmlms-courses-grid-old lms-icon';
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
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'masterstudy-lms-learning-management-system' ),
			)
		);

		$this->add_control(
			'hide_top_bar',
			array(
				'name'        => 'hide_top_bar',
				'label'       => __( 'Hide Top bar', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => array(
					'hidden'  => __( 'Hide', 'masterstudy-lms-learning-management-system' ),
					'showing' => __( 'Show', 'masterstudy-lms-learning-management-system' ),
				),
				'default'     => 'showing',
			)
		);

		$this->add_control(
			'title',
			array(
				'name'        => 'title',
				'label'       => __( 'Title', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'condition'   => array(
					'hide_top_bar' => 'showing',
				),
			)
		);

		$this->add_control(
			'hide_load_more',
			array(
				'name'        => 'hide_load_more',
				'label'       => __( 'Load more', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => array(
					'hidden'  => __( 'Hide', 'masterstudy-lms-learning-management-system' ),
					'showing' => __( 'Show', 'masterstudy-lms-learning-management-system' ),
				),
				'default'     => 'showing',
			)
		);

		$this->add_control(
			'hide_sort',
			array(
				'name'        => 'hide_sort',
				'label'       => __( 'Sort', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => array(
					'hidden'  => __( 'Hide', 'masterstudy-lms-learning-management-system' ),
					'showing' => __( 'Show', 'masterstudy-lms-learning-management-system' ),
				),
				'default'     => 'showing',
			)
		);

		$this->add_control(
			'per_row',
			array(
				'name'        => 'per_row',
				'label'       => __( 'Courses Per Row', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => array(
					'6' => '6',
					'4' => '4',
					'3' => '3',
				),
				'default'     => '6',
			)
		);

		$this->add_control(
			'image_size',
			array(
				'name'        => 'image_size',
				'label'       => __( 'Image size (Ex. : thumbnail)', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'name'        => 'posts_per_page',
				'label'       => __( 'Number of courses to show', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'label_block' => true,
			)
		);

		$this->add_control(
			'taxonomy',
			array(
				'name'        => 'taxonomy',
				'label'       => __( 'Select taxonomy', 'masterstudy-lms-learning-management-system' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => stm_lms_elementor_autocomplete_terms( 'stm_lms_course_taxonomy' ),
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
			'css'              => '',
			'hide_top_bar'     => ! empty( $settings['hide_top_bar'] ) ? $settings['hide_top_bar'] : 'showing',
			'title'            => ! empty( $settings['title'] ) ? $settings['title'] : '',
			'hide_load_more'   => ! empty( $settings['hide_load_more'] ) ? $settings['hide_load_more'] : 'showing',
			'hide_sort'        => ! empty( $settings['hide_sort'] ) ? $settings['hide_sort'] : 'showing',
			'per_row'          => ! empty( $settings['per_row'] ) ? $settings['per_row'] : 6,
			'image_size'       => ! empty( $settings['image_size'] ) ? $settings['image_size'] : '',
			'posts_per_page'   => ! empty( $settings['posts_per_page'] ) ? $settings['posts_per_page'] : '',
			'taxonomy_default' => ! empty( $settings['taxonomy'] ) ? implode( ', ', $settings['taxonomy'] ) : '',
		);

		\STM_LMS_Templates::show_lms_template( 'shortcodes/stm_lms_courses_grid', $atts );
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



