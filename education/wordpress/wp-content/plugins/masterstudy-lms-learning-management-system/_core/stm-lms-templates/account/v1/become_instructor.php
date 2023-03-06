<?php
$forms = get_option('stm_lms_form_builder_forms', array());
$become_instructor_form = array();
if (class_exists('STM_LMS_Form_Builder') && !empty($forms) && is_array($forms)) {
    foreach ($forms as $form) {
        if ($form['slug'] === 'become_instructor') {
            $become_instructor_form = $form['fields'];
        }
    }
}

if (!empty($become_instructor_form)):
    $become_instructor_form = json_encode($become_instructor_form);
    ?>
    <script>
        window.becomeInstructorFormFields = <?php echo sanitize_text_field($become_instructor_form); ?>
    </script>
<?php endif; ?>

<div id="stm-lms-become-instructor" class="stm-lms-become-instructor">

	<div class="stm_lms_bi_wrapper">
        <form @submit.prevent="send()">
            <?php if (!empty($become_instructor_form)): ?>
                <div class="form-group" v-if="additionalFields.length" v-for="(field, index) in additionalFields">
                    <label class="heading_font" v-if="typeof field.label !== 'undefined'" v-html="field.label"></label>

                    <?php STM_LMS_Templates::show_lms_template('account/v1/form_builder/email'); ?>

                    <?php STM_LMS_Templates::show_lms_template('account/v1/form_builder/select'); ?>

                    <?php STM_LMS_Templates::show_lms_template('account/v1/form_builder/radio'); ?>

                    <?php STM_LMS_Templates::show_lms_template('account/v1/form_builder/textarea'); ?>

                    <?php STM_LMS_Templates::show_lms_template('account/v1/form_builder/checkbox'); ?>

                    <?php STM_LMS_Templates::show_lms_template('account/v1/form_builder/file'); ?>

                    <div class="field-description" v-if="field.description" v-html="field.description"></div>

                </div>
            <?php else: ?>
                <div class="form-group" v-bind:class="{'error' : !degree_filled }">
                    <label class="heading_font"><?php esc_html_e('Degree', 'masterstudy-lms-learning-management-system'); ?></label>
                    <input class="form-control"
                           type="text"
                           name="degree"
                           v-model="degree"
                           placeholder="<?php esc_html_e('Enter degree', 'masterstudy-lms-learning-management-system'); ?>"/>
                </div>

                <div class="form-group" v-bind:class="{'error' : !expertize_filled }">
                    <label class="heading_font"><?php esc_html_e('Expertise', 'masterstudy-lms-learning-management-system'); ?></label>
                    <input class="form-control"
                           type="text"
                           name="expertize"
                           v-model="expertize"
                           placeholder="<?php esc_html_e('Enter Expertise', 'masterstudy-lms-learning-management-system'); ?>"/>
                </div>
            <?php endif; ?>

            <button type="submit"
                    class="btn btn-default"
                    :disabled="loading"
                    v-bind:class="{'loading': loading}">
                <span><?php esc_html_e('Send Application', 'masterstudy-lms-learning-management-system'); ?></span>
            </button>
        </form>

	</div>

	<transition name="slide-fade">
		<div class="stm-lms-message" v-bind:class="status" v-if="message">
			{{ message }}
		</div>
	</transition>

</div>