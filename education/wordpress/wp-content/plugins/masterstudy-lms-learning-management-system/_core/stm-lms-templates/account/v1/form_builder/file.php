<?php
/**
 * @var $name
 */

$load = (!empty($name)) ? "loadImage(index, '{$name}')" : "loadImage(index)";

?>

<div class="file-wrap" v-if="field.type === 'file'">
    <label class="file-browse-wrap">

        <span class="file-browse">
            <?php esc_html_e('Browse...', 'masterstudy-lms-learning-management-system'); ?>
        </span>

        <input type="file"
               :ref="'file-' + index"
               :accept="field.extensions ? field.extensions : '.jpeg,.jpg,.png,.mp4,.pdf'"
               @change="<?php echo stm_lms_filtered_output($load); ?>"/>

        <input type="hidden" v-model="field.extensions"/>

        <span class="filename"
              v-if="typeof field.value !== 'undefined' && field.value"
              v-html="field.value.split('/').pop()">
        </span>

        <span class="filename"
              v-else-if="!loading"
              v-html="field.placeholder">
        </span>

        <span class="filename"
              v-else>
            <?php esc_html_e('Loading...', 'masterstudy-lms-learning-management-system'); ?>
        </span>

    </label>

    <i v-if="field.value" class="fas fa-times" @click="field.value = ''"></i>

    <i v-else class="fas fa-paperclip"></i>
</div>