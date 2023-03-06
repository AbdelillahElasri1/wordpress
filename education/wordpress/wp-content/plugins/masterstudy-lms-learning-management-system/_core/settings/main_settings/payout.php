<?php

function stm_lms_settings_payout_section() {
	return array(
		'name'   => esc_html__( 'Payout', 'masterstudy-lms-learning-management-system' ),
		'label'  => esc_html__( 'Payout Settings', 'masterstudy-lms-learning-management-system' ),
		'icon'   => 'fas fa-hand-holding-usd',
		'fields' => array(
			'payout' => array(
				'pro'     => true,
				'pro_url' => 'https://stylemixthemes.com/wordpress-lms-plugin/?utm_source=wpadmin-ms&utm_medium=ms-settings&utm_campaign=payouts-get-pro',
				'type'    => 'payout',
				'label'   => esc_html__( 'Masterstudy LMS PRO Payout', 'masterstudy-lms-learning-management-system' ),
			),
		),
	);
}
