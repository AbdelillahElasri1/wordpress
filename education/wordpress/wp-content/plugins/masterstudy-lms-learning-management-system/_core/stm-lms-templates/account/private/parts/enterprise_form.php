<?php
stm_lms_register_style( 'enterprise' );
stm_lms_register_script( 'enterprise' );
?>
<div class="stm_lms_become_instructor enterprise">
	<i class="stmlms-case secondary_color"></i>
	<h3><?php esc_html_e( 'Have a question?', 'masterstudy-lms-learning-management-system' ); ?></h3>
	<p><?php esc_html_e( 'Here you can send a direct request to the site owner.', 'masterstudy-lms-learning-management-system' ); ?></p>
	<a href="#" class="btn-default btn lms_become_instructor_btn" data-target=".stm-lms-modal-enterprise"
		data-lms-modal="enterprise">
		<?php esc_html_e( 'Send Request', 'masterstudy-lms-learning-management-system' ); ?>
	</a>
</div>
