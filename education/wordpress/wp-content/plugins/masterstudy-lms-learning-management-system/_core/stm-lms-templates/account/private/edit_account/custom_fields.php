<?php
$forms = get_option('stm_lms_form_builder_forms', array());
$profile_form = array();
if (class_exists('STM_LMS_Form_Builder') && !empty($forms) && is_array($forms)) {
    foreach ($forms as $form) {
        if ($form['slug'] === 'profile_form') {
            $profile_form = $form['fields'];
        }
    }
}
if (!empty($profile_form)):
    $profile_form = json_encode($profile_form);
    ?>
    <script xmlns:v-bind="http://www.w3.org/1999/xhtml">
        window.profileForm = <?php echo sanitize_text_field($profile_form); ?>
    </script>
<?php endif; ?>
<div class="row" v-if="additionalFields.length" v-for="(field, index) in additionalFields">
    <div class="col-md-12">
        <div class="form-group">
            <label class="heading_font" v-if="typeof field.label !== 'undefined'" v-html="field.label"></label>

            <?php STM_LMS_Templates::show_lms_template(
                'account/v1/form_builder/email',
                array(
                    'value' => "!data.meta[field.id] || data.meta[field.id] === 'false' ? false : true",
                    'model' => "data.meta[field.id]"
                ));
            ?>

            <?php STM_LMS_Templates::show_lms_template(
                'account/v1/form_builder/select',
                array(
                    'model' => "data.meta[field.id]"
                ));
            ?>

            <?php STM_LMS_Templates::show_lms_template(
                'account/v1/form_builder/radio',
                array(
                    'name' => "data.meta[field.id]",
                    'model' => "data.meta[field.id]",
                ));
            ?>

            <?php STM_LMS_Templates::show_lms_template(
                'account/v1/form_builder/textarea',
                array(
                    'model' => "data.meta[field.id]",
                ));
            ?>

            <?php STM_LMS_Templates::show_lms_template(
                'account/v1/form_builder/checkbox',
                array(
                    'model' => "data.meta[field.id]",
                ));
            ?>

            <div class="file-wrap" v-if="field.type === 'file'">
                <label class="file-browse-wrap">
                    <span class="file-browse">
                    <?php esc_html_e('Browse...', 'masterstudy-lms-learning-management-system'); ?>
                    </span>
                    <input v-if="!data.meta[field.id]" type="file" :ref="'file-' + index"
                           :accept="field.extensions ? field.extensions : '.jpeg,.jpg,.png,.mp4,.pdf'"
                           @change="loadImage(index)"/>
                    <span class="filename" v-if="typeof field.value !== 'undefined' && field.value"
                          v-html="field.value.split('/').pop()"></span>
                    <span class="filename"
                          v-else-if="!loading" v-html="field.placeholder"></span>
                    <span class="filename"
                          v-else><?php esc_html_e('Loading...', 'masterstudy-lms-learning-management-system'); ?></span>
                </label>
                <i v-if="data.meta[field.id]" class="fas fa-times" @click="data.meta[field.id] = ''"></i>
                <i v-else class="fas fa-paperclip"></i>
                <div v-if="data.meta[field.id]" class="file-value" v-html="data.meta[field.id]"></div>
                <input type="hidden" v-model="field.extensions"/>
            </div>

            <div class="field-description" v-if="field.description" v-html="field.description"></div>

        </div>

    </div>

</div>