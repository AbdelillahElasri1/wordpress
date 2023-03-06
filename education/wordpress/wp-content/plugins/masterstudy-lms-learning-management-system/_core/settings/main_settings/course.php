<?php
function stm_lms_settings_course_section() {
	return array(
		'name'   => esc_html__( 'Course', 'masterstudy-lms-learning-management-system' ),
		'label'  => esc_html__( 'Course Settings', 'masterstudy-lms-learning-management-system' ),
		'icon'   => 'fas fa-book',
		'fields' => array(
			'course_style'                         => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Course Page Style', 'masterstudy-lms-learning-management-system' ),
				'options' => array(
					'default' => esc_html__( 'Default', 'masterstudy-lms-learning-management-system' ),
					'classic' => esc_html__( 'Classic', 'masterstudy-lms-learning-management-system' ),
					'udemy'   => esc_html__( 'Modern', 'masterstudy-lms-learning-management-system' ),
				),
				'value'   => 'default',
				'pro'     => true,
				'pro_url' => 'https://stylemixthemes.com/wordpress-lms-plugin/?utm_source=wpadmin-ms&utm_medium=ms-settings&utm_campaign=course-settings-get-pro',
			),

			'course_tabs'                          => array(
				'group' => 'started',
				'type'  => 'notice',
				'label' => esc_html__( 'Course Tabs', 'masterstudy-lms-learning-management-system' ),
			),
			'course_tab_description'               => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable "Description" tab', 'masterstudy-lms-learning-management-system' ),
				'value' => true,
			),
			'course_tab_curriculum'                => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable "Curriculum" tab', 'masterstudy-lms-learning-management-system' ),
				'value' => true,
			),
			'course_tab_faq'                       => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable "FAQ" tab', 'masterstudy-lms-learning-management-system' ),
				'value' => true,
			),
			'course_tab_announcement'              => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable "Announcement" tab', 'masterstudy-lms-learning-management-system' ),
				'value' => true,
			),
			'course_tab_reviews'                   => array(
				'group' => 'ended',
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable "Reviews" tab', 'masterstudy-lms-learning-management-system' ),
				'value' => true,
			),

			'course_levels_config'                 => array(
				'type'   => 'repeater',
				'label'  => esc_html__( 'Course levels', 'masterstudy-lms-learning-management-system' ),
				'fields' => array(
					'id'    => array(
						'type'    => 'text',
						'label'   => esc_html__( 'Level ID', 'masterstudy-lms-learning-management-system' ),
						'columns' => '50',
					),
					'label' => array(
						'type'    => 'text',
						'label'   => esc_html__( 'Level Label', 'masterstudy-lms-learning-management-system' ),
						'columns' => '50',
					),
				),
				'value'  => array(
					array(
						'id'    => 'beginner',
						'label' => esc_html__( 'Beginner', 'masterstudy-lms-learning-management-system' ),
					),
					array(
						'id'    => 'intermediate',
						'label' => esc_html__( 'Intermediate', 'masterstudy-lms-learning-management-system' ),
					),
					array(
						'id'    => 'advanced',
						'label' => esc_html__( 'Advanced', 'masterstudy-lms-learning-management-system' ),
					),
				),
			),

			'lesson_style'                         => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Lesson Page Style', 'masterstudy-lms-learning-management-system' ),
				'options' => array(
					'default' => esc_html__( 'Default', 'masterstudy-lms-learning-management-system' ),
					'classic' => esc_html__( 'Classic', 'masterstudy-lms-learning-management-system' ),
				),
				'value'   => 'default',
			),
			'redirect_after_purchase'              => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Redirect to Checkout after adding to Cart', 'masterstudy-lms-learning-management-system' ),
			),
			'course_allow_new_categories'          => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Allow instructors to create new categories', 'masterstudy-lms-learning-management-system' ),
				'hint'  => esc_html__( 'Allow instructors create new categories for courses.', 'masterstudy-lms-learning-management-system' ),
			),
			'course_allow_new_question_categories' => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Allow instructors to create new question categories', 'masterstudy-lms-learning-management-system' ),
			),
			'course_allow_presto_player'           => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Allow Presto Player Source for Instructors', 'masterstudy-lms-learning-management-system' ),
				'hint'  => esc_html__( 'Instructors will able to select videos from Presto Payer Media Hub', 'masterstudy-lms-learning-management-system' ),
			),
			'course_lesson_video_types'            => array(
				'group' => 'started',
				'type'  => 'notice',
				'label' => esc_html__( 'Preferred Video Source', 'masterstudy-lms-learning-management-system' ),
				'value' => true,
			),
			'course_lesson_video_type_html'        => array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'HTML (MP4)', 'masterstudy-lms-learning-management-system' ),
				'toggle'  => false,
				'columns' => '33',
				'value'   => true,
			),
			'course_lesson_video_type_youtube'     => array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'YouTube', 'masterstudy-lms-learning-management-system' ),
				'toggle'  => false,
				'columns' => '33',
				'value'   => true,
			),
			'course_lesson_video_type_vimeo'       => array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Vimeo', 'masterstudy-lms-learning-management-system' ),
				'toggle'  => false,
				'columns' => '33',
				'value'   => true,
			),
			'course_lesson_video_type_ext_link'    => array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'External link', 'masterstudy-lms-learning-management-system' ),
				'toggle'  => false,
				'columns' => '33',
				'value'   => true,
			),
			'course_lesson_video_type_embed'       => array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Embed', 'masterstudy-lms-learning-management-system' ),
				'toggle'  => false,
				'columns' => '33',
				'value'   => true,
			),
			'course_lesson_video_type_shortcode'   => array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Shortcode', 'masterstudy-lms-learning-management-system' ),
				'toggle'  => false,
				'columns' => '33',
				'group'   => 'ended',
				'value'   => true,
			),
			'enable_sticky'                        => array(
				'group' => 'started',
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable bottom sticky panel', 'masterstudy-lms-learning-management-system' ),
			),
			'enable_sticky_title'                  => array(
				'type'       => 'checkbox',
				'label'      => esc_html__( 'Enable Title in bottom sticky panel', 'masterstudy-lms-learning-management-system' ),
				'dependency' => array(
					'key'   => 'enable_sticky',
					'value' => 'not_empty',
				),
				'columns'    => '50',
			),
			'enable_sticky_rating'                 => array(
				'type'       => 'checkbox',
				'label'      => esc_html__( 'Enable Rating in bottom sticky panel', 'masterstudy-lms-learning-management-system' ),
				'dependency' => array(
					'key'   => 'enable_sticky',
					'value' => 'not_empty',
				),
				'columns'    => '50',
			),
			'enable_sticky_teacher'                => array(
				'type'       => 'checkbox',
				'label'      => esc_html__( 'Enable Teacher in bottom sticky panel', 'masterstudy-lms-learning-management-system' ),
				'dependency' => array(
					'key'   => 'enable_sticky',
					'value' => 'not_empty',
				),
				'columns'    => '50',
			),
			'enable_sticky_category'               => array(
				'type'       => 'checkbox',
				'label'      => esc_html__( 'Enable Category in bottom sticky panel', 'masterstudy-lms-learning-management-system' ),
				'dependency' => array(
					'key'   => 'enable_sticky',
					'value' => 'not_empty',
				),
				'columns'    => '50',
			),
			'enable_sticky_price'                  => array(
				'type'       => 'checkbox',
				'label'      => esc_html__( 'Enable Price in bottom sticky panel', 'masterstudy-lms-learning-management-system' ),
				'dependency' => array(
					'key'   => 'enable_sticky',
					'value' => 'not_empty',
				),
				'columns'    => '50',
			),
			'enable_sticky_button'                 => array(
				'group'      => 'ended',
				'type'       => 'checkbox',
				'label'      => esc_html__( 'Enable Buy Button in bottom sticky panel', 'masterstudy-lms-learning-management-system' ),
				'dependency' => array(
					'key'   => 'enable_sticky',
					'value' => 'not_empty',
				),
				'columns'    => '50',
			),
			'enable_related_courses'               => array(
				'group' => 'started',
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable related courses', 'masterstudy-lms-learning-management-system' ),
			),
			'related_option'                       => array(
				'group'      => 'ended',
				'type'       => 'select',
				'label'      => esc_html__( 'Select the display option for related courses', 'masterstudy-lms-learning-management-system' ),
				'options'    => array(
					'by_category' => esc_html__( 'By category', 'masterstudy-lms-learning-management-system' ),
					'by_author'   => esc_html__( 'By author', 'masterstudy-lms-learning-management-system' ),
					'by_level'    => esc_html__( 'By level', 'masterstudy-lms-learning-management-system' ),
				),
				'value'      => 'default',
				'dependency' => array(
					'key'   => 'enable_related_courses',
					'value' => 'not_empty',
				),
			),
			'finish_popup_image_disable'           => array(
				'group' => 'started',
				'type'  => 'checkbox',
				'label' => esc_html__( 'Disable default image for course completion notification', 'masterstudy-lms-learning-management-system' ),
				'hint'  => esc_html__( 'Disable the display of a default image in the course completion notification.', 'masterstudy-lms-learning-management-system' ),
				'value' => false,
			),
			'finish_popup_image_failed'            => array(
				'type'       => 'image',
				'label'      => esc_html__( 'Upload an image for course completion notification (failed courses)', 'masterstudy-lms-learning-management-system' ),
				'hint'       => esc_html__( 'Upload a custom image, to show in the notification of failed course.', 'masterstudy-lms-learning-management-system' ),
				'dependency' => array(
					'key'   => 'finish_popup_image_disable',
					'value' => 'empty',
				),
			),
			'finish_popup_image_success'           => array(
				'type'       => 'image',
				'group'      => 'ended',
				'label'      => esc_html__( 'Upload an image for course completion notification (passed courses)', 'masterstudy-lms-learning-management-system' ),
				'hint'       => esc_html__( 'Upload a custom image, to show in the notification of a successful course completion.', 'masterstudy-lms-learning-management-system' ),
				'dependency' => array(
					'key'   => 'finish_popup_image_disable',
					'value' => 'empty',
				),
			),
		),
	);
}
