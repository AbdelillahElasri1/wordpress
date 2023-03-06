<?php

/**
 * @var $course_id
 * @var $course_end_time
 */

?>

<div class="stm_lms_expired_notice__wrapper">
    <div class="stm_lms_expired_notice warning_expired">
        <i class="far fa-clock"></i>
        <?php printf(
            _n(
                'Course available for %s day',
                'Course available for <strong>%s days</strong>',
                $course_end_time,
                'masterstudy-lms-learning-management-system'
            ),
            $course_end_time
        ) ?>
    </div>
</div>