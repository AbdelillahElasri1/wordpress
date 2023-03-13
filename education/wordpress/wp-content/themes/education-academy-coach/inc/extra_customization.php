<?php 

	$education_insight_logo_max_height = get_theme_mod('education_insight_logo_max_height');

	if($education_insight_logo_max_height != false){

		$education_insight_custom_style .='.custom-logo-link img{';

			$education_insight_custom_style .='max-height: '.esc_html($education_insight_logo_max_height).'px;';
			
		$education_insight_custom_style .='}';
	}
