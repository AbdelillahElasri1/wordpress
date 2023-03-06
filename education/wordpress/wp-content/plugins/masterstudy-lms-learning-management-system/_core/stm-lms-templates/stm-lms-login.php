<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
} //Exit if accessed directly ?>

<?php
wp_enqueue_script( 'vue.js' );
wp_enqueue_script( 'vue-resource.js' );
do_action( 'stm_lms_template_main' );

if ( function_exists( 'vc_asset_url' ) ) {
	wp_enqueue_style( 'stm_lms_wpb_front_css', vc_asset_url( 'css/js_composer.min.css' ), array( '' ), STM_LMS_VERSION );
}

?>

<?php STM_LMS_Templates::show_lms_template( 'modals/preloader' ); ?>

<div class="stm-lms-wrapper stm-lms-wrapper__login">

	<div class="container">

		<div class="row">

			<div class="col-md-6">
				<?php STM_LMS_Templates::show_lms_template( 'account/v1/login' ); ?>
			</div>

			<div class="col-md-6">
				<?php STM_LMS_Templates::show_lms_template( 'account/v1/register' ); ?>
			</div>

		</div>

	</div>

</div>
