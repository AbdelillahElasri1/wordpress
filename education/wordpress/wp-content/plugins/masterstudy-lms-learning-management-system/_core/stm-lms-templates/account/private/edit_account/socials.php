<div class="stm_lms_edit_socials">
    <div class="row">

        <div class="col-md-12">
            <h3><?php esc_html_e('Social network', 'masterstudy-lms-learning-management-system'); ?></h3>
            <p><?php esc_html_e('Add your social profiles links, they will be shown on your public profile.', 'masterstudy-lms-learning-management-system'); ?></p>
        </div>

    </div>

    <div class="stm_lms_edit_socials_list">
        <div class="row">

            <div class="col-md-6">

                <div class="form-group">
                    <label class="heading_font"><?php esc_html_e('Facebook', 'masterstudy-lms-learning-management-system'); ?></label>
                    <div class="form-group-social">
                        <input v-model="data.meta.facebook"
                               class="form-control"
                               placeholder="<?php esc_html_e('Enter your Facebook URL', 'masterstudy-lms-learning-management-system') ?>"/>
                        <i class="fab fa-facebook-f"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="heading_font"><?php esc_html_e('Google Plus', 'masterstudy-lms-learning-management-system'); ?></label>
                    <div class="form-group-social">
                        <input v-model="data.meta['google-plus']"
                               class="form-control"
                               placeholder="<?php esc_html_e('Enter your Google Plus URL', 'masterstudy-lms-learning-management-system') ?>"/>
                        <i class="fab fa-google-plus-g"></i>
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label class="heading_font"><?php esc_html_e('Twitter', 'masterstudy-lms-learning-management-system'); ?></label>
                    <div class="form-group-social">
                        <input v-model="data.meta.twitter"
                               class="form-control"
                               placeholder="<?php esc_html_e('Enter your Twitter URL', 'masterstudy-lms-learning-management-system') ?>"/>
                        <i class="fab fa-twitter"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="heading_font"><?php esc_html_e('Instagram', 'masterstudy-lms-learning-management-system'); ?></label>
                    <div class="form-group-social">
                        <input v-model="data.meta.instagram"
                               class="form-control"
                               placeholder="<?php esc_html_e('Enter your Instagram URL', 'masterstudy-lms-learning-management-system') ?>"/>
                        <i class="fab fa-instagram"></i>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>