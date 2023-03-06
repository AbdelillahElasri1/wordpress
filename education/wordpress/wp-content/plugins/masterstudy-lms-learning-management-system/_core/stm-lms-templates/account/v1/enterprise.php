<?php
$enterprise_form = array();
if ( class_exists( 'STM_LMS_Form_Builder' ) ) {
	$enterprise_form = STM_LMS_Form_Builder::get_form_fields( 'enterprise_form' );
}
if ( ! empty( $enterprise_form ) ) :
	$enterprise_form = json_encode( $enterprise_form );
	?>
	<script>
		window.enterpriseFormFields = <?php echo wp_kses_post( $enterprise_form ); ?>
	</script>
<?php endif; ?>

<div id="stm-lms-enterprise" class="stm-lms-enterprise">

	<div class="stm_lms_enterprise_wrapper">
		<form @submit.prevent="send()">
			<?php if ( ! empty( $enterprise_form ) ) : ?>
				<div class="form-group" v-if="additionalFields.length > 0" v-for="(field, index) in additionalFields">

					<label class="heading_font" v-if="typeof field.label !== 'undefined'" v-html="field.label"></label>

					<?php STM_LMS_Templates::show_lms_template( 'account/v1/form_builder/email' ); ?>

					<?php STM_LMS_Templates::show_lms_template( 'account/v1/form_builder/select' ); ?>

					<?php STM_LMS_Templates::show_lms_template( 'account/v1/form_builder/radio' ); ?>

					<?php STM_LMS_Templates::show_lms_template( 'account/v1/form_builder/textarea' ); ?>

					<?php STM_LMS_Templates::show_lms_template( 'account/v1/form_builder/checkbox' ); ?>

					<?php STM_LMS_Templates::show_lms_template( 'account/v1/form_builder/file' ); ?>

					<div class="field-description" v-if="field.description" v-html="field.description"></div>

				</div>
			<?php else : ?>
				<div class="form-group">
					<label class="heading_font"><?php esc_html_e( 'Name', 'masterstudy-lms-learning-management-system' ); ?></label>
					<input class="form-control"
						   type="text"
						   name="name"
						   v-model="name"
						   placeholder="<?php esc_html_e( 'Enter your name', 'masterstudy-lms-learning-management-system' ); ?>"/>
				</div>

				<div class="form-group">
					<label class="heading_font"><?php esc_html_e( 'E-mail', 'masterstudy-lms-learning-management-system' ); ?></label>
					<input class="form-control"
						   type="text"
						   name="email"
						   v-model="email"
						   placeholder="<?php esc_html_e( 'Enter Your Email', 'masterstudy-lms-learning-management-system' ); ?>"/>
				</div>

				<div class="form-group">
					<label class="heading_font"><?php esc_html_e( 'Message', 'masterstudy-lms-learning-management-system' ); ?></label>
					<textarea class="form-control"
							  type="text"
							  name="text"
							  v-model="text"
							  placeholder="<?php esc_html_e( 'Enter Your Message', 'masterstudy-lms-learning-management-system' ); ?>"></textarea>
				</div>
			<?php endif; ?>
			<button type="submit"
					class="btn btn-default"
					:disabled="loading"
					v-bind:class="{'loading': loading}">
				<span><?php esc_html_e( 'Send Enquiry', 'masterstudy-lms-learning-management-system' ); ?></span>
			</button>
		</form>
	</div>

	<transition name="slide-fade">
		<div class="stm-lms-message" v-bind:class="status" v-if="message">
			{{ message }}
		</div>
	</transition>

</div>
