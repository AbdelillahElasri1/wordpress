<?php

function stm_lms_quiz_types($single = false) {

	$types = array(
		'type' => 'select',
		'label' => esc_html__('Quiz Style', 'masterstudy-lms-learning-management-system'),
		'options' => array(
			'default' => esc_html__('One page', 'masterstudy-lms-learning-management-system'),
			'pagination' => esc_html__('Pagination', 'masterstudy-lms-learning-management-system'),
		),
		'value' => 'default',
	);

	if($single) {
		$types['options'] = array(
			'global' => esc_html__('Default style', 'masterstudy-lms-learning-management-system'),
		) + $types['options'];

		$types['value'] = 'global';

		$types['hint'] = esc_html__('Select the style of displaying questions in the quiz.', 'masterstudy-lms-learning-management-system');

	}

	return $types;
}

function stm_lms_settings_quiz_section()
{
	return array(
		'name' => esc_html__('Quiz', 'masterstudy-lms-learning-management-system'),
		'label' => esc_html__('Quiz Settings', 'masterstudy-lms-learning-management-system'),
		'icon' => 'fas fa-question',
		'fields' => array(
			'quiz_style' => stm_lms_quiz_types(),
			'quiz_media_type' => array(
				'type' => 'select',
				'label' => esc_html__('Media Type', 'masterstudy-lms-learning-management-system'),
				'hint' => esc_html__('Image Attachment type, either File Upload or input for Text URL.', 'masterstudy-lms-learning-management-system'),
				'options' => array(
					'upload' => esc_html__('File Upload', 'masterstudy-lms-learning-management-system'),
					'url' => esc_html__('URL (Text Input)', 'masterstudy-lms-learning-management-system'),
				),
				'value' => 'upload',
			)
		)
	);
}
