<?php
/**
 * @var $stm_lms_vars
 */

if ( ! empty( $stm_lms_vars['course_id'] ) ) {
	$stm_lms_vars = array( $stm_lms_vars );
}

$subscription   = array_shift( $stm_lms_vars );
$subs           = STM_LMS_Subscriptions::user_subscription_levels();
$subs_id        = reset( $subs )->ID;
$user_approval  = get_user_meta( get_current_user_id(), 'pmpro_approval_' . $subs_id, true );
$needs_approval = false;

if ( ! empty( $user_approval['status'] ) && in_array( $user_approval['status'], array( 'pending', 'denied' ) ) ) {
	$needs_approval = true;
}
?>

<div class="modal fade stm-lms-use-subscription" tabindex="-1" role="dialog" aria-labelledby="stm-lms-use-subscription">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-body">

				<?php
				if ( count( $stm_lms_vars ) > 1 ) {
					STM_LMS_Templates::show_lms_template( 'account/v1/use_membership_multiply', compact( 'stm_lms_vars' ) );
				} else {
					STM_LMS_Templates::show_lms_template(
						'account/v1/use_membership',
						compact( 'subscription', 'needs_approval' )
					);
				}

				?>

			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	(function ($) {
		$('[data-lms-usemembership]').on('click', function (e) {
			e.preventDefault();

			var course_id = $(this).attr('data-lms-course');

			if (typeof stm_lms_course_id !== 'undefined') course_id = stm_lms_course_id;

			var data = {
				action: 'stm_lms_use_membership',
				nonce: stm_lms_nonces['stm_lms_use_membership'],
				course_id: course_id,
			};

			var membership_id = $(this).attr('data-membership-id');

			if(typeof membership_id !== 'undefined') {
				data['membership_id'] = membership_id;
			}
			$.ajax({
				url: stm_lms_ajaxurl,
				dataType: 'json',
				method: 'get',
				context: this,
				data: data,
				beforeSend: function () {
					$(this).addClass('loading');
				},
				complete: function (data) {
					var data = data['responseJSON'];
					$(this).removeClass('loading');
					if(typeof data['url'] !== 'undefined'){
						window.location.href = data['url'];
					}
					else {
						location.reload();
					}
				}
			});
		});
	})(jQuery)
</script>
