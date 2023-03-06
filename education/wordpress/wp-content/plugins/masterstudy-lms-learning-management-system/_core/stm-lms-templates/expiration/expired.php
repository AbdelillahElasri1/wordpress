<?php

/**
 * @var $course_id
 * @var $course_end_time
 * @var $course_info
 */

stm_lms_register_script('expiration/expired', array('jquery.cookie'));
wp_localize_script('stm-lms-expiration/expired', 'stm_lms_expired_course', array(
    'id' => $course_id
));

?>

<div class="stm_lms_expired_popup">

    <div class="stm_lms_expired_popup__overlay"></div>

    <div class="stm_lms_expired_popup__inner">

        <div class="stm_lms_expired_popup__close">
            <i class="fa fa-times"></i>
        </div>

        <div class="stm_lms_expired_popup__image">
            <?php echo get_the_post_thumbnail($course_id, 'img-480-380'); ?>
        </div>

        <div class="stm_lms_expired_popup__title">
            <?php echo get_the_title($course_id); ?>
        </div>

        <div class="stm_lms_expired_popup__notice heading_font">
            <?php esc_html_e('Course has expired', 'masterstudy-lms-learning-management-system'); ?>
        </div>

        <div class="stm_lms_expired_popup__date">
            <?php printf(esc_html__('Date of expiry: %s', 'masterstudy-lms-learning-management-system'), date_i18n('Y-m-d g:i', $course_info['end_time'])); ?>
        </div>

    </div>

</div>
