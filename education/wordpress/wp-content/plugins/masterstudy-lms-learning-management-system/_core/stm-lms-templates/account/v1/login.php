


<?php

$r_enabled = STM_LMS_Helpers::g_recaptcha_enabled();
enqueue_login_script();
stm_lms_register_style('login');

if ($r_enabled):
    $recaptcha = STM_LMS_Helpers::g_recaptcha_keys();
endif;

$site_key = (!empty($recaptcha['public'])) ? $recaptcha['public'] : '';


STM_LMS_Templates::show_lms_template('account/v1/restore');
?>

    <div id="stm-lms-login<?php if (isset($form_position)) esc_attr_e($form_position); ?>" class="stm-lms-login active vue_is_disabled"
         v-init="site_key = '<?php echo stm_lms_filtered_output($site_key); ?>'"
         v-bind:class="{'is_vue_loaded' : vue_loaded}">

        <div class="stm-lms-login__top">
            <?php if (defined('WORDPRESS_SOCIAL_LOGIN_ABS_PATH') and apply_filters('stm_lms_show_social_login', true)) {
                do_action('wordpress_social_login');
            } ?>

            <h3><?php esc_html_e('Login', 'masterstudy-lms-learning-management-system'); ?></h3>

            <?php do_action('stm_lms_login_end'); ?>
        </div>

        <div class="stm_lms_login_wrapper">

            <div class="form-group">
                <label class="heading_font">
                    <?php echo apply_filters('stm_lms_login_label', esc_html__('Username', 'masterstudy-lms-learning-management-system')); ?>
                </label>
                <input class="form-control"
                       type="text"
                       name="login"
                       v-model="login"
                       v-on:keyup.enter="logIn()"
                       placeholder="<?php esc_html_e('Enter username', 'masterstudy-lms-learning-management-system'); ?>"/>
            </div>

            <div class="form-group">
                <label class="heading_font">
                    <?php echo apply_filters('stm_lms_password_label', esc_html__('Password', 'masterstudy-lms-learning-management-system')); ?>
                </label>
                <input class="form-control"
                       type="password"
                       name="password"
                       v-model="password"
                       v-on:keyup.enter="logIn()"
                       placeholder="<?php esc_html_e('Enter password', 'masterstudy-lms-learning-management-system'); ?>"/>
            </div>

            <div class="stm_lms_login_wrapper__actions">

                <label class="stm_lms_styled_checkbox stm_lms_remember_me">
                <span class="stm_lms_styled_checkbox__inner">
                    <input
                            type="checkbox"
                            name="remember_me"
                            v-model="remember"
                            v-on:keyup.enter="logIn()"
                    />
                    <span><i class="fa fa-check"></i> </span>
                </span>
                    <span><?php esc_html_e('Remember me', 'masterstudy-lms-learning-management-system'); ?></span>
                </label>

                <span class="lostpassword"
                      @click.prevent="open_lost_password = !open_lost_password"
                      title="<?php esc_html_e('Lost Password', 'masterstudy-lms-learning-management-system'); ?>">
                <?php esc_html_e('Lost Password', 'masterstudy-lms-learning-management-system'); ?>
            </span>

                <a href="#"
                   class="btn btn-default"
                   v-bind:class="{'loading': loading}"
                   @click.prevent="logIn()">
                    <span><?php echo _x('Login', 'Login button', 'masterstudy-lms-learning-management-system'); ?></span>
                </a>

            </div>

            <div class="stm_lms_lost_password_form" v-if="open_lost_password">

                <div class="form-group">
                    <label class="heading_font">
                        <?php echo apply_filters('stm_lms_lost_password_label', esc_html__('Login/E-mail', 'masterstudy-lms-learning-management-system')); ?>
                    </label>
                    <input class="form-control"
                           type="text"
                           name="login"
                           v-model="lost_password"
                           placeholder="<?php esc_html_e('Enter login/e-mail', 'masterstudy-lms-learning-management-system'); ?>"/>
                </div>

                <a href="#"
                   class="btn btn-default"
                   v-bind:class="{'loading': lost_password_process}"
                   @click.prevent="lostPassword()">
                    <span><?php esc_html_e('Send', 'masterstudy-lms-learning-management-system'); ?></span>
                </a>

            </div>

        </div>

        <transition name="slide-fade">
            <div class="stm-lms-message" v-bind:class="status" v-if="message" v-html="message">
            </div>
        </transition>

    </div>

<?php if (defined('APSL_VERSION') and apply_filters('stm_lms_show_social_login', true)) {
    echo do_shortcode("[apsl-login-lite login_text='']");
} ?>

<?php if (defined('NSL_PATH_FILE') and apply_filters('stm_lms_show_social_login', true)) {
    echo do_shortcode('[nextend_social_login]');
} ?>

<?php do_action('stm_lms_login_section_end'); ?>