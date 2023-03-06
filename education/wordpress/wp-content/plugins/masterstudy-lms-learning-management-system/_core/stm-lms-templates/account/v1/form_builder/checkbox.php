<label v-if="field.type === 'checkbox' && typeof field.choices !== 'undefined' && choice !== ''"
       v-for="(choice, choiceIndex) in field.choices"
       class="radio-label">

    <input type="checkbox"
           :name="field.id + choiceIndex"
           v-bind:value="choice"
           v-bind:checked="isChecked(choice, index, field.id)"
           @change="checkboxChange(event, index, choice, true)"/>
    <span v-html="choice"></span>

</label>