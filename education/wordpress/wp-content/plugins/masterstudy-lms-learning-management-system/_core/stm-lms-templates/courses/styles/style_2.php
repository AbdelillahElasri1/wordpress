<?php
/**
 * @var $has_sale_price
 * @var $id
 * @var $price
 * @var $sale_price
 * @var $author_id
 * @var $style
 */

$classes = array($has_sale_price, $style);

$level = get_post_meta($id, 'level', true);
$duration = get_post_meta($id, 'duration_info', true);
$lectures = STM_LMS_Course::curriculum_info(get_post_meta($id, 'curriculum', true));
?>


<div class="stm_lms_courses__single stm_lms_courses__single_animation <?php echo implode(' ', $classes); ?>">

    <div class="stm_lms_courses__single__inner">

        <div class="stm_lms_courses__single__inner__image">

			<?php STM_LMS_Templates::show_lms_template('courses/parts/image', array('id' => $id, 'img_size' => '370x200')); ?>

            <a href="<?php the_permalink(); ?>" class="stm_price_course_hoverable">
			    <?php STM_LMS_Templates::show_lms_template('global/price', compact('price', 'sale_price')); ?>
            </a>

        </div>

        <div class="stm_lms_courses__single--inner">

			<?php STM_LMS_Templates::show_lms_template('courses/parts/title'); ?>

			<?php STM_LMS_Templates::show_lms_template('courses/parts/terms', array('id' => $id, 'symbol' => '')); ?>

            <div class="stm_lms_courses__single--info_meta">

				<?php STM_LMS_Templates::show_lms_template('courses/parts/meta', compact('level', 'duration', 'lectures')); ?>

            </div>


        </div>

    </div>

</div>