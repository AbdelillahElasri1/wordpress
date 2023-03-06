<?php if (!defined('ABSPATH')) exit; //Exit if accessed directly ?>

<?php
/**
 * @var $current_user
 */

stm_lms_register_style('user_info_top');
stm_lms_register_style('edit_account');
stm_lms_register_style('instructor/account');

?>


<?php STM_LMS_Templates::show_lms_template('account/private/instructor_parts/top_info', array('current_user' => $current_user, 'socials' => true)); ?>

<?php STM_LMS_Templates::show_lms_template('account/private/instructor_parts/info', array('current_user' => $current_user)); ?>

<div class="multiseparator"></div>

<?php STM_LMS_Templates::show_lms_template('account/private/instructor_parts/courses', array('current_user' => $current_user)); ?>