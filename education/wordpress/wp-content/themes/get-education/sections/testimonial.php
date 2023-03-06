<?php

add_action( 'bizberg_before_homepage_blog', 'get_education_homepage_testimonials' );
function get_education_homepage_testimonials(){

	$page_id        = bizberg_get_theme_mod( 'get_education_testimonial_page' );
	$testi_name     = bizberg_get_theme_mod( 'testi_name' );
	$testi_position = bizberg_get_theme_mod( 'testi_position' );

	if( empty( $page_id ) ){
		return;
	}

	$page_obj = get_post( $page_id ); ?>

	<div class="testimonial_wrapper">

		<div class="container">

			<div class="testimonial_inner_wrapper">
				
				<i class="fas fa-quote-right"></i>

				<h4><?php echo esc_html( $page_obj->post_title ); ?></h4>

				<p><?php echo esc_html( wp_trim_words( sanitize_text_field( $page_obj->post_content ), 40, null ) ); ?></p>

				<div class="title_wrapper">
					<div class="name"><?php echo esc_html( $testi_name ); ?></div>
					<div class="position"><?php echo esc_html( $testi_position ); ?></div>
				</div>

			</div>

		</div>

	</div>

	<?php
}