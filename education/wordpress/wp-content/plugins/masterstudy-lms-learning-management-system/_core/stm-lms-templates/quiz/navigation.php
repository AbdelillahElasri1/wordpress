<?php
/**
 * @var $post_id
 * @var $item_id
 */

$course_meta = STM_LMS_Helpers::parse_meta_field($post_id);
if(!empty($course_meta['curriculum'])):
	$curriculum = STM_LMS_Helpers::only_array_numbers(explode(',', $course_meta['curriculum']));
	if(in_array($item_id, $curriculum)) {
		$current_lesson_id = array_search($item_id, $curriculum);
		$prev_lesson = (!empty($curriculum[$current_lesson_id - 1])) ? $curriculum[$current_lesson_id - 1] : '';
		$next_lesson = (!empty($curriculum[$current_lesson_id + 1])) ? $curriculum[$current_lesson_id + 1] : '';
	} ?>

	<div class="stm-lms-lesson_navigation">

		<div class="stm-lms-lesson_navigation_side stm-lms-lesson_navigation_prev">
			<?php if(!empty($prev_lesson)): ?>
				<a href="<?php echo esc_url(STM_LMS_Lesson::get_lesson_url($post_id, $prev_lesson)) ?>">
					<?php echo sanitize_text_field(get_the_title($prev_lesson)); ?>
				</a>
			<?php endif; ?>
		</div>

		<div class="stm-lms-lesson_navigation_side stm-lms-lesson_navigation_next">
			<?php if(!empty($next_lesson)): ?>
				<a href="<?php echo esc_url(STM_LMS_Lesson::get_lesson_url($post_id, $next_lesson)) ?>">
					<?php echo sanitize_text_field(get_the_title($next_lesson)); ?>
				</a>
			<?php endif; ?>
		</div>

	</div>

<?php endif;