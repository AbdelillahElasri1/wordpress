<?php
$custom_logo_id = starter_get_option( 'logo' );
$logo_image     = wp_get_attachment_image_src( $custom_logo_id, 'full' );

if ( ! empty( $custom_logo_id ) ) { ?>
	<a hre="<?php echo esc_url( home_url( '/' ) ); ?>" class="starter-logo">
		<img src="<?php echo esc_url( $logo_image[0] ); ?>" alt="<?php echo esc_html( get_the_title( $custom_logo_id ) ); ?>">
	</a>
<?php } else { ?>
	<a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="starter-logo">
		<img
			width="151"
			height="33"
			src="
			<?php
				echo esc_url(
					get_template_directory_uri() . '/assets/images/base/logo-default.png'
				);
			?>
			"
			alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
		/>
	</a>
	<?php
}
