<?php
/**
 * @var $model
 * @var $value
 */

if(!empty($value)) {
    $value = "v-bind:value=\"{$value}\"";
} else {
    $value = '';
}

if(empty($model)) $model = "field.value";
?>

<input class="form-control"
       v-if="field.type === 'text' || field.type === 'tel' || field.type === 'email'"
       :placeholder="field.placeholder ? field.placeholder : ''"
       :type="field.type"
       <?php echo stm_lms_filtered_output($value); ?>
       v-model="<?php echo stm_lms_filtered_output($model); ?>"/>