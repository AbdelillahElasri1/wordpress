<div class="stm_lms_splash_wizard__content_tab"
	v-if="active_step === 'general'">
	<h4>
		<?php esc_html_e( 'General', 'masterstudy-lms-learning-management-system' ); ?>
	</h4>
	<hr/>
	<div class="stm_lms_splash_wizard__field stm_lms_splash_wizard__field_pages">
		<?php
		STM_LMS_Templates::show_lms_template(
			'wizard/views/field_data',
			array(
				'title' => esc_html__( 'Create LMS Pages', 'masterstudy-lms-learning-management-system' ),
				'desc'  => esc_html__( 'Create LMS system pages automatically.', 'masterstudy-lms-learning-management-system' ),
			)
		);
		?>
		<div class="stm_lms_splash_wizard__field_input">
			<?php
			STM_LMS_Templates::show_lms_template(
				'wizard/fields/pages',
				array(
					'pages' => array(
						'user_url'         => esc_html__( 'User Account', 'masterstudy-lms-learning-management-system' ),
						'user_url_profile' => esc_html__( 'User Public Account', 'masterstudy-lms-learning-management-system' ),
						'wishlist_url'     => esc_html__( 'Wishlist', 'masterstudy-lms-learning-management-system' ),
						'checkout_url'     => esc_html__( 'Checkout', 'masterstudy-lms-learning-management-system' ),
					),
				)
			);
			?>
		</div>
	</div>
	<hr v-if="isPro()"/>
	<div class="stm_lms_splash_wizard__field stm_lms_splash_wizard__field_switch"
		v-if="isPro()"
		v-bind:class="{'inactive' : !wizard.wocommerce_checkout}">
		<?php
		STM_LMS_Templates::show_lms_template(
			'wizard/views/field_data',
			array(
				'title' => esc_html__( 'WooCommerce Checkout', 'masterstudy-lms-learning-management-system' ),
			)
		);
		?>
		<div class="stm_lms_splash_wizard__field_input">
			<?php
			STM_LMS_Templates::show_lms_template(
				'wizard/fields/switcher',
				array(
					'model' => 'wizard.wocommerce_checkout',
					'desc'  => esc_html__( 'You need to install the WooCommerce plugin and set the Cart and Checkout pages.', 'masterstudy-lms-learning-management-system' ),
				)
			);
			?>
		</div>
	</div>
	<hr/>
	<div class="stm_lms_splash_wizard__field stm_lms_splash_wizard__field_switch"
		v-bind:class="{'inactive' : !wizard.guest_checkout}">
		<?php
		STM_LMS_Templates::show_lms_template(
			'wizard/views/field_data',
			array(
				'title' => esc_html__( 'Enable Guest Checkout', 'masterstudy-lms-learning-management-system' ),
			)
		);
		?>
		<div class="stm_lms_splash_wizard__field_input">
			<?php
			STM_LMS_Templates::show_lms_template(
				'wizard/fields/switcher',
				array(
					'model' => 'wizard.guest_checkout',
					'desc'  => esc_html__( 'Allow the guests to skip the registration and proceed with the purchase by only entering their email address.', 'masterstudy-lms-learning-management-system' ),
				)
			);
			?>
		</div>
	</div>
	<hr v-if="isMarketPlace() && isPro()"/>
	<div class="stm_lms_splash_wizard__field stm_lms_splash_wizard__field_number admin_comission" v-if="isMarketPlace() && isPro()">
		<?php
		STM_LMS_Templates::show_lms_template(
			'wizard/views/field_data',
			array(
				'title' => esc_html__( 'Admin commission', 'masterstudy-lms-learning-management-system' ),
			)
		);
		?>
		<div class="stm_lms_splash_wizard__field_input">
			<?php
			STM_LMS_Templates::show_lms_template(
				'wizard/fields/number',
				array(
					'model' => 'wizard.author_fee',
					'desc'  => esc_html__( 'Specify the % that you’ll get from instructors’ sales.', 'masterstudy-lms-learning-management-system' ),
				)
			);
			?>
		</div>
	</div>
</div>
