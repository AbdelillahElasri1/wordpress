<?php
define( 'STM_FREEMIUS_CHECKOUT_LINK', 'https://checkout.freemius.com/mode/dialog/plugin/' );
define( 'STM_FREEMIUS_CHECKOUT_UTM_SOURCE', 'utm_source=wpadmin&utm_medium=buynow&utm_campaign=masterstudy-plugin' );
define( 'STM_FREEMIUS_PLUGIN_INFO_URL', 'https://stylemixthemes.com/api/freemius/masterstudy-lms-learning-management-system-pro.json' );

function get_freemius_info() {
	$response = wp_remote_get( STM_FREEMIUS_PLUGIN_INFO_URL );

	$body = wp_remote_retrieve_body( $response );

	$body = json_decode( $body );

	if ( empty( $body ) ) {
		return '';
	}

	$freemius_info = array();

	/**
	 * Set to Array Premium Plan's Prices
	 */
	function set_premium_plan_prices( $plans, $plugin_id ) {
		$plan_info = array();

		$plan_data = array(
			'1'    => array(
				'text'      => __( 'Single Site', 'masterstudy-lms-learning-management-system' ),
				'classname' => '',
				'type'      => '',
			),
			'5'    => array(
				'classname' => 'stm_plan--popular',
				'text'      => __( 'Up to 5 Sites', 'masterstudy-lms-learning-management-system' ),
				'type'      => __( 'Most Popular', 'masterstudy-lms-learning-management-system' ),
			),
			'5000' => array(
				'classname' => 'stm_plan--developer',
				'text'      => __( 'Unlimited', 'masterstudy-lms-learning-management-system' ),
				'type'      => __( 'Developer Oriented', 'masterstudy-lms-learning-management-system' ),
			),
		);

		foreach ( $plans as $plan ) {
			if ( 'premium' == $plan->name ) {
				if ( isset( $plan->pricing ) ) {
					foreach ( $plan->pricing as $pricing ) {
						$plan_info[ 'licenses_' . $pricing->licenses ]      = $pricing;
						$plan_info[ 'licenses_' . $pricing->licenses ]->url = STM_FREEMIUS_CHECKOUT_LINK . "{$plugin_id}/plan/{$pricing->plan_id}/licenses/{$pricing->licenses}/";

						if ( ! isset( $plan_data[ $pricing->licenses ] ) ) {
							$plan_data[ $pricing->licenses ] = array(
								'text'      => esc_html__( 'Up to ', 'masterstudy-lms-learning-management-system' ) . $pricing->licenses . esc_html__( ' Sites', 'masterstudy-lms-learning-management-system' ),
								'classname' => '',
								'type'      => '',
							);
						}
						$plan_info[ 'licenses_' . $pricing->licenses ]->data = $plan_data[ $pricing->licenses ];
					}
				}
				break;
			}
		}

		return array_reverse( $plan_info );
	}

	/**
	 * Set to Array Latest Plugin's Info
	 */
	function set_latest_info( $latest ) {
		$latest_info['version']           = $latest->version;
		$latest_info['tested_up_to']      = $latest->tested_up_to_version;
		$latest_info['created']           = date( 'M j, Y', strtotime( $latest->created ) );
		$latest_info['last_update']       = date( 'M j, Y', strtotime( $latest->updated ) );
		$latest_info['wordpress_version'] = $latest->requires_platform_version;

		return $latest_info;
	}

	if ( isset( $body->plans ) && ! empty( $body->plans ) ) {
		$freemius_info['plan'] = set_premium_plan_prices( $body->plans, $body->id );
	}

	if ( isset( $body->latest ) && ! empty( $body->latest ) ) {
		$freemius_info['latest'] = set_latest_info( $body->latest );
	}

	if ( isset( $body->info ) && ! empty( $body->info ) ) {
		$freemius_info['info'] = $body->info;
	}

	return $freemius_info;
}

$freemius_info = get_freemius_info();
?>
<div class="stm-lms-go_pro">
	<section class="stm_go_pro">
		<div class="container">
			<div class="stm_go_pro_plugin">
				<h2 class="stm_go_pro_plugin__title">
					<?php esc_html_e( 'The Most Powerful WordPress LMS Plugin for Online Education', 'masterstudy-lms-learning-management-system' ); ?>
				</h2>
				<p class="stm_go_pro_plugin__content">
					<?php if ( isset( $freemius_info['info'] ) ) : ?>
						<?php
						if ( isset( $freemius_info['info']->short_description ) ) {
							nl2br( $freemius_info['info']->short_description );
						}
						?>
						<?php if ( $freemius_info['info']->url ) : ?>
							<a href="<?php echo esc_url( $freemius_info['info']->url ) . '?utm_source=wpadmin-ms&utm_medium=buynow&utm_campaign=learn-more'; ?>">
								<?php esc_html_e( 'Learn more.', 'masterstudy-lms-learning-management-system' ); ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
				</p>
			</div>
			<?php if ( isset( $freemius_info['plan'] ) ) : ?>
				<h2><?php esc_html_e( 'Pricing', 'masterstudy-lms-learning-management-system' ); ?></h2>
				<div class="stm-type-pricing">
					<div class="left active"><?php esc_html_e( 'Annual', 'masterstudy-lms-learning-management-system' ); ?></div>
					<div class="stm-type-pricing__switch">
						<input type="checkbox" id="GoProStmTypePricing">
						<label for="GoProStmTypePricing"></label>
					</div>
					<div class="right "><?php esc_html_e( 'Lifetime', 'masterstudy-lms-learning-management-system' ); ?></div>
				</div>
				<div class="row">
					<?php foreach ( $freemius_info['plan'] as $plan ) : ?>
						<div class="col-md-4">
							<div class="stm_plan <?php echo esc_attr( $plan->data['classname'] ); ?>">
								<?php if ( ! empty( $plan->data['type'] ) ) : ?>
									<div class="stm_plan__type">
										<?php echo esc_html( $plan->data['type'] ); ?>
									</div>
								<?php endif; ?>
								<div class="stm_price">
									<sup>$</sup>
									<span class="stm_price__value"
										data-price-annual="<?php echo esc_attr( $plan->annual_price ); ?>"
										data-price-lifetime="<?php echo esc_attr( $plan->lifetime_price ); ?>">
										<?php echo esc_html( $plan->annual_price ); ?>
									</span>
									<small>/<?php esc_html_e( 'per year', 'masterstudy-lms-learning-management-system' ); ?></small>
								</div>
								<p class="stm_plan__title"><?php echo esc_html( $plan->data['text'] ); ?></p>
								<a href="<?php echo 'https://stylemixthemes.com/wordpress-lms-plugin/pricing/?' . esc_attr( STM_FREEMIUS_CHECKOUT_UTM_SOURCE ) . '&licenses=' . esc_attr( $plan->licenses ) . '&billing_cycle=annual'; ?>"
								   class="stm_plan__btn stm_plan__btn--buy"
								   data-checkout-url-annual="<?php echo 'https://stylemixthemes.com/wordpress-lms-plugin/pricing/?' . esc_attr( STM_FREEMIUS_CHECKOUT_UTM_SOURCE ) . '&licenses=' . esc_attr( $plan->licenses ) . '&billing_cycle=annual'; ?>"
								   data-checkout-url-lifetime="<?php echo 'https://stylemixthemes.com/wordpress-lms-plugin/pricing/?' . esc_attr( STM_FREEMIUS_CHECKOUT_UTM_SOURCE ) . '&licenses=' . esc_attr( $plan->licenses ) . '&billing_cycle=lifetime'; ?>"
								   target="_blank">
									<?php esc_html_e( 'Get now', 'masterstudy-lms-learning-management-system' ); ?>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<p class="stm_terms_content">
				<?php
				$url       = 'https://stylemixthemes.com/subscription-policy/';
				$span_attr = 'class="stm_terms_content_support" data-support-lifetime="' . esc_attr__( 'Lifetime', 'masterstudy-lms-learning-management-system' ) . '" data-support-annual="' . esc_attr__( '1 year', 'masterstudy-lms-learning-management-system' ) . '"';
				printf( wp_kses_post( /* translators: %s: string */ __( 'You get <a href="%1$s"><span %2$s>1 year</span> updates and support</a> from the date of purchase. We offer 30 days Money Back Guarantee based on <a href="%1$s">Refund Policy</a>.', 'masterstudy-lms-learning-management-system' ) ), esc_url( $url ), esc_attr( $span_attr ) );
				?>
			</p>

			<?php if ( ! empty( $freemius_info['latest'] ) ) : ?>
				<ul class="stm_last_changelog_info">
					<li>
						<span class="stm_last_changelog_info__label">
							<?php esc_html_e( 'Version:', 'masterstudy-lms-learning-management-system' ); ?>
						</span>
						<span class="stm_last_changelog_info__value">
							<?php echo esc_html( $freemius_info['latest']['version'] ); ?>
							<a href="https://docs.stylemixthemes.com/masterstudy-lms/changelog/" target="_blank">
								<?php esc_html_e( 'View Changelog', 'masterstudy-lms-learning-management-system' ); ?>
							</a>
						</span>
					</li>
					<li>
						<span class="stm_last_changelog_info__label">
							<?php esc_html_e( 'Last Update:', 'masterstudy-lms-learning-management-system' ); ?>
						</span>
						<span class="stm_last_changelog_info__value">
							<?php echo esc_html( $freemius_info['latest']['created'] ); ?>
						</span>
					</li>
					<li>
						<span class="stm_last_changelog_info__label">
							<?php esc_html_e( 'WordPress Version:', 'masterstudy-lms-learning-management-system' ); ?>
						</span>
						<span class="stm_last_changelog_info__value">
							<?php echo esc_html( $freemius_info['latest']['wordpress_version'] ); ?> or higher
						</span>
					</li>
					<li>
						<span class="stm_last_changelog_info__label">
							<?php esc_html_e( 'Tested up to:', 'masterstudy-lms-learning-management-system' ); ?>
						</span>
						<span class="stm_last_changelog_info__value">
							<?php echo esc_html( $freemius_info['latest']['tested_up_to'] ); ?>
						</span>
					</li>
				</ul>
			<?php endif; ?>
		</div>
	</section>
</div>

<script>
	jQuery(document).ready(function ($) {
		$('#GoProStmTypePricing').on('change', function () {

			let parent = $(this).closest('.stm-type-pricing');

			let left = parent.find('.left'); //Annual
			let right = parent.find('.right'); //Lifetime
			let stm_price = $('.stm_price small');

			left.toggleClass('active', !this.checked);
			right.toggleClass('active', this.checked);

			stm_price.toggleClass('hidden', this.checked);

			let typePrice = 'annual';

			if (this.checked) typePrice = 'lifetime';

			let support = $('.stm_terms_content_support');
			support.text(support.attr('data-support-' + typePrice));

			$('.stm_plan__btn--buy').each(function () {
				let $this = $(this);
				let checkoutUrl = $this.attr('data-checkout-url-annual');
				if ('lifetime' === typePrice) {
					checkoutUrl = $this.attr('data-checkout-url-lifetime');
				}
				$this.attr('href', checkoutUrl);
			})

			$('.stm_price__value').each(function () {
				let $this = $(this);
				$this.text($this.attr('data-price-' + typePrice));
			})

		});

	});
</script>
