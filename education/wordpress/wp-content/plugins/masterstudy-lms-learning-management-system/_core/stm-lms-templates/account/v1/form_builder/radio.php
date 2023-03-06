<?php
/**
 * @var $name
 * @var $model
 */

if(empty($name)) $name = 'field.id';
if(empty($model)) $model = 'field.value';
?>

<label v-if="field.type === 'radio' && choice !== ''"
       v-for="(choice, index) in field.choices"
       class="radio-label">

    <input type="radio"
           :name="<?php echo stm_lms_filtered_output($name); ?>"
           v-bind:value="choice"
           :checked="index === 0"
           v-model="<?php echo stm_lms_filtered_output($model); ?>"/>

    <span v-html="choice"></span>

</label>