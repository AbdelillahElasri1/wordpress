<?php 

	$education_insight_sticky_header = get_theme_mod('education_insight_sticky_header');

	$education_insight_custom_style= "";

	if($education_insight_sticky_header != true){

		$education_insight_custom_style .='.wrap_figure.fixed{';

			$education_insight_custom_style .='position: static;';
			
		$education_insight_custom_style .='}';
	}

	/*---------------------------Width -------------------*/

	$education_insight_custom_style= "";
	
	$education_insight_theme_width = get_theme_mod( 'education_insight_width_options','full_width');

    if($education_insight_theme_width == 'full_width'){

		$education_insight_custom_style .='body{';

			$education_insight_custom_style .='max-width: 100%;';

		$education_insight_custom_style .='}';

	}else if($education_insight_theme_width == 'container'){

		$education_insight_custom_style .='body{';

			$education_insight_custom_style .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';

		$education_insight_custom_style .='}';

	}else if($education_insight_theme_width == 'container_fluid'){

		$education_insight_custom_style .='body{';

			$education_insight_custom_style .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';

		$education_insight_custom_style .='}';
	}

	/*---------------------------Scroll-top-position -------------------*/
	
	$education_insight_scroll_options = get_theme_mod( 'education_insight_scroll_options','right_align');

    if($education_insight_scroll_options == 'right_align'){

		$education_insight_custom_style .='.scroll-top button{';

			$education_insight_custom_style .='';

		$education_insight_custom_style .='}';

	}else if($education_insight_scroll_options == 'center_align'){

		$education_insight_custom_style .='.scroll-top button{';

			$education_insight_custom_style .='right: 0; left:0; margin: 0 auto; top:85% !important';

		$education_insight_custom_style .='}';

	}else if($education_insight_scroll_options == 'left_align'){

		$education_insight_custom_style .='.scroll-top button{';

			$education_insight_custom_style .='right: auto; left:5%; margin: 0 auto';

		$education_insight_custom_style .='}';
	}