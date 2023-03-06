<?php
/**
 * @var $model
 */

if(empty($model)) $model = "field.value";
?>

<select class="form-control disable-select"
        v-if="field.type === 'select' && typeof field.choices !== 'undefined'"
        v-init="<?php echo stm_lms_filtered_output($model) ?>"
        v-model="<?php echo stm_lms_filtered_output($model) ?>">
    <option v-if="field.placeholder" v-html="field.placeholder" v-bind:value="''"></option>
    <option v-for="choice in field.choices" v-html="choice" v-if="choice !== ''"></option>
</select>