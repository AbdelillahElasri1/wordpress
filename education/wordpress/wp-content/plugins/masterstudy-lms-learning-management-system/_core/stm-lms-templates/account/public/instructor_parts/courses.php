<?php
/**
 * @var $current_user
 */
stm_lms_register_style('courses');
stm_lms_register_script('courses');

$args = array(
    'author' => $current_user['id'],
    'class' => 'vue_is_disabled'
);

?>

<div class="stm_lms_courses">

    <div class="stm_lms_courses__top">
        <h3><?php esc_html_e('Teacher Courses', 'masterstudy-lms-learning-management-system'); ?></h3>
    </div>

    <?php STM_LMS_Templates::show_lms_template('courses/grid', array('args' => $args)); ?>

</div>
