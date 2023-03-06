<div class="modal fade stm-lms-modal-become-instructor" tabindex="-1" role="dialog" aria-labelledby="stm-lms-modal-become-instructor">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php STM_LMS_Templates::show_lms_template('account/v1/become_instructor'); ?>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    stm_lms_become_instructor();
</script>