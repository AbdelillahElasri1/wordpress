<?php

$rating = STM_LMS_Instructor::my_rating();

if (!empty($rating['total_marks'])): ?>
    <div class="stm-lms-user_rating">
        <div class="star-rating star-rating__big">
            <span style="width: <?php echo floatval($rating['percent']); ?>%;"></span>
        </div>
        <strong class="rating heading_font"><?php echo floatval($rating['average']); ?></strong>
        <div class="stm-lms-user_rating__total">
            <?php echo sanitize_text_field($rating['total_marks']); ?>
        </div>
    </div>
<?php endif; ?>