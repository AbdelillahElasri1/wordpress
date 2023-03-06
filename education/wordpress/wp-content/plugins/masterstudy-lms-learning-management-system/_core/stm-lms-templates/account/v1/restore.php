<?php

$token = ( ! empty( $_GET['restore_password'] ) ) ? sanitize_text_field( $_GET['restore_password'] ) : '';

if ( ! empty( $token ) ) {
	$user_id = STM_LMS_User::check_restore_token( $token );
}

if ( ! empty( $user_id ) ) :

	$user = STM_LMS_User::get_current_user( $user_id );
	stm_lms_register_style( 'account/v1/restore_password' );
	stm_lms_register_script( 'account/v1/restore_password', array( 'vue.js', 'vue-resource.js' ) );
	wp_localize_script(
		'stm-lms-account/v1/restore_password',
		'stm_lms_restore_password',
		array(
			'token' => $token,
		)
	);

	?>

	<div id="stm-lms-reset-password">
		<div class="stm-lms-login__top">
			<h3><?php esc_html_e( 'Restore password', 'masterstudy-lms-learning-management-system' ); ?></h3>
		</div>

		<div class="stm_lms_login_wrapper">
			<div class="form-group">
				<label class="heading_font">
					<?php printf( esc_html__( 'New password for "%s"', 'masterstudy-lms-learning-management-system' ), esc_html( $user['login'] ) ); ?>
				</label>

				<input type="hidden" v-model="token"/>

				<input type="text"
					   v-model="password"
					   v-on:keyup.enter="changePassword"
					   name="new_password"
					   placeholder="<?php esc_attr_e( 'Enter new password', 'masterstudy-lms-learning-management-system' ); ?>"
					   class="form-control">
			</div>

			<div class="stm_lms_register_wrapper__actions">
				<a href="#" class="btn btn-default" @click.prevent="changePassword" v-bind:class="{'loading': loading}">
					<span><?php esc_html_e( 'Restore', 'masterstudy-lms-learning-management-system' ); ?></span>
				</a>
			</div>

		</div>

		<transition name="slide-fade">
			<div class="stm-lms-message" v-bind:class="status" v-if="message" v-html="message">
			</div>
		</transition>

	</div>

	<?php
endif;
