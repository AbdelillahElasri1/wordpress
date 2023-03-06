<?php

/**
 * @var $course_id
 * @var $expired_popup
 */

stm_lms_register_style('expiration/main');

$course_end_time = STM_LMS_Course::get_course_time_expiration($course_id);
$is_course_time_expired = STM_LMS_Course::is_course_time_expired(get_current_user_id(), $course_id);
$course_info = STM_LMS_Course::get_course_expiration_time(get_current_user_id(), $course_id);

$expired_popup = (isset($expired_popup)) ? $expired_popup : true;

if(isset($course_info['end_time']) and empty($course_info['end_time'])) return false;

/*If we just telling about course expiration info*/
if (empty($course_info) && !empty($course_end_time)) {
    STM_LMS_Templates::show_lms_template('expiration/info', compact('course_id', 'course_end_time'));

/*If we have course and time is not expired*/
} elseif (!$is_course_time_expired && !empty($course_info) && !empty($course_end_time)) {
    STM_LMS_Templates::show_lms_template('expiration/not_expired', compact('course_id', 'course_end_time', 'course_info'));

/*If we have course and time is expired*/
} elseif($is_course_time_expired && !empty($course_info) && !empty($course_end_time)) {
    STM_LMS_Templates::show_lms_template('expiration/info', compact('course_id', 'course_end_time'));
    if($expired_popup) STM_LMS_Templates::show_lms_template('expiration/expired', compact('course_id', 'course_end_time', 'course_info'));
}