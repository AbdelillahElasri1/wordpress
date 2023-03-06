<?php
/**
 * @var $model
 */

if(empty($model)) $model = 'field.value';
?>

<textarea class="form-control"
          v-model="<?php echo stm_lms_filtered_output($model); ?>"
          v-if="field.type === 'textarea'"
          :placeholder="field.placeholder ? field.placeholder : ''"></textarea>