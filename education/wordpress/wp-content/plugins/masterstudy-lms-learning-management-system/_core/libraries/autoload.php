<?php
require_once STM_LMS_LIBRARY . '/mailchimp-integration.php';
require_once STM_LMS_LIBRARY . '/paypal/autoload.php';
require_once STM_LMS_LIBRARY . '/db/tables.php';
require_once STM_LMS_LIBRARY . '/mixpanel/init.php';

if ( is_admin() ) {
	require_once STM_LMS_LIBRARY . '/db/fix_rating.php';
	require_once STM_LMS_LIBRARY . '/compatibility/main.php';
	require_once STM_LMS_LIBRARY . '/announcement/main.php';
	require_once STM_LMS_LIBRARY . '/announcement/item-announcements.php';
	require_once STM_LMS_LIBRARY . '/admin-notification/admin-notification.php';
	require_once STM_LMS_LIBRARY . '/announcement/survey-notice.php';

	$init_data = array(
		'plugin_title' => 'MasterStudy LMS Plugin',
		'plugin_name'  => 'masterstudy-lms-learning-management-system',
		'plugin_file'  => MS_LMS_FILE,
		'logo'         => STM_LMS_URL . 'assets/img/ms-logo.png',
	);

	stm_admin_notification_init( $init_data );
}
