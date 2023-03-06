<?php

/**
 * @var $course_id
 * @var $course_end_time
 * @var $course_info
 */

$end_time = $course_info['end_time'];
$time_left = $end_time - time();

$days_left = floor($time_left / (24 * 60 * 60));
?>

<div class="stm_lms_expired_notice expired_in_progress">
    <i class="far fa-clock"></i>
    <?php if ($days_left < 1) {
        printf(
            esc_html__('Course expires in: %s', 'masterstudy-lms-learning-management-system'),
            "<strong><span data-lms-timer='{$time_left}'></span></strong>");
    } else {
        printf(esc_html__('Course expires in: %s days%s', 'masterstudy-lms-learning-management-system'), "<strong>{$days_left}", "</strong>");
    } ?>
</div>