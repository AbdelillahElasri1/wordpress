<?php

add_action( 'bizberg_before_homepage_blog', 'get_education_homepage_about' );
function get_education_homepage_about(){

	$data = bizberg_get_theme_mod( 'get_education_about_section' ); 
	$data = json_decode( $data,true );

	if( !empty( $data ) ){  ?>

		<div class="services_wrapper">
			
			<div class="container">
				
				<div class="row clearfix">

					<?php 

					foreach( $data as $value ){ 

						$page_id  = !empty( $value['serices_id'] ) ? $value['serices_id'] : '';
						$page_obj = get_post( $page_id ); 
						$icon     = !empty( $value['icon'] ) ? $value['icon'] : ''; ?>

						<div class="col-lg-4 col-md-6 col-sm-12 feature-block">
		                    <div class="feature-block-one">
		                        <div class="inner-box p_relative d_block b_radius_10 pl_150 pt_35 pr_30 pb_30">
		                            <div class="icon-box p_absolute centred fs_65 color-white">
		                            	<i class="<?php echo esc_attr( $icon ); ?>"></i>
		                            </div>
		                            <h4 class="p_relative d_block fs_20 lh_30 mb_18">
		                            	<a href="index.html" class="d_iblock black-color hov-color">
		                            		<?php echo esc_html( $page_obj->post_title ); ?>		
		                            	</a>
		                            </h4>
		                            <p class="mb_8 lh_30"><?php echo esc_html( wp_trim_words( sanitize_text_field( $page_obj->post_content ), 10, null ) ); ?></p>
		                        </div>
		                    </div>
		                </div>

						<?php
					}

					?>                

	            </div>	
	            		
			</div>

		</div>

		<?php

	}
	
}