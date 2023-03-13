<?php
/**
 * Education Insight: Customizer
 *
 * @subpackage Education Insight
 * @since 1.0
 */

function education_insight_customize_register( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/assets/css/customizer.css');

	// fontawesome icon-picker

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	// Add custom control.
  	require get_parent_theme_file_path( 'inc/customize/customize_toggle.php' );

	// Register the custom control type.
	$wp_customize->register_control_type( 'Education_Insight_Toggle_Control' );

	$wp_customize->add_section( 'education_insight_typography_settings', array(
		'title'       => __( 'Typography', 'education-insight' ),
		'priority'       => 24,
	) );

	$education_insight_font_choices = array(
		'' => 'Select',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'education_insight_headings_text', array(
		'sanitize_callback' => 'education_insight_sanitize_fonts',
	));
	$wp_customize->add_control( 'education_insight_headings_text', array(
		'type' => 'select',
		'description' => __('Select your suitable font for the headings.', 'education-insight'),
		'section' => 'education_insight_typography_settings',
		'choices' => $education_insight_font_choices
	));

	$wp_customize->add_setting( 'education_insight_body_text', array(
		'sanitize_callback' => 'education_insight_sanitize_fonts'
	));
	$wp_customize->add_control( 'education_insight_body_text', array(
		'type' => 'select',
		'description' => __( 'Select your suitable font for the body.', 'education-insight' ),
		'section' => 'education_insight_typography_settings',
		'choices' => $education_insight_font_choices
	) );

 	$wp_customize->add_section('education_insight_pro', array(
        'title'    => __('UPGRADE EDUCATION PREMIUM', 'education-insight'),
        'priority' => 1,
    ));

    $wp_customize->add_setting('education_insight_pro', array(
        'default'           => null,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Education_Insight_Pro_Control($wp_customize, 'education_insight_pro', array(
        'label'    => __('EDUCATION PREMIUM', 'education-insight'),
        'section'  => 'education_insight_pro',
        'settings' => 'education_insight_pro',
        'priority' => 1,
    )));

    // Theme General Settings
    $wp_customize->add_section('education_insight_theme_settings',array(
        'title' => __('Theme General Settings', 'education-insight'),
        'priority' => 1,
    ) );

    $wp_customize->add_setting( 'education_insight_sticky_header', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_sticky_header', array(
		'label'       => esc_html__( 'Show Sticky Header', 'education-insight' ),
		'section'     => 'education_insight_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'education_insight_sticky_header',
	) ) );

    $wp_customize->add_setting( 'education_insight_theme_loader', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_theme_loader', array(
		'label'       => esc_html__( 'Show Site Loader', 'education-insight' ),
		'section'     => 'education_insight_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'education_insight_theme_loader',
	) ) );

	$wp_customize->add_setting( 'education_insight_scroll_enable', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_scroll_enable', array(
		'label'       => esc_html__( 'Show Scroll Top', 'education-insight' ),
		'section'     => 'education_insight_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'education_insight_scroll_enable',
	) ) );

	$wp_customize->add_setting('education_insight_scroll_options',array(
        'default' => 'right_align',
        'sanitize_callback' => 'education_insight_sanitize_choices'
	));
	$wp_customize->add_control('education_insight_scroll_options',array(
        'type' => 'select',
        'label' => __('Scroll Top Alignment','education-insight'),
        'section' => 'education_insight_theme_settings',
        'choices' => array(
            'right_align' => __('Right Align','education-insight'),
            'center_align' => __('Center Align','education-insight'),
            'left_align' => __('Left Align','education-insight'),
        ),
	) );

	$wp_customize->add_setting('education_insight_scroll_top_icon',array(
		'default'	=> 'fas fa-chevron-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_scroll_top_icon',array(
		'label'	=> __('Add Scroll Top Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_theme_settings',
		'setting'	=> 'education_insight_scroll_top_icon',
		'type'		=> 'icon'
	)));	

	$wp_customize->add_setting( 'education_insight_shop_page_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_shop_page_sidebar', array(
		'label'       => esc_html__( 'Show Shop Page Sidebar', 'education-insight' ),
		'section'     => 'education_insight_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'education_insight_shop_page_sidebar',
	) ) );

	$wp_customize->add_setting( 'education_insight_wocommerce_single_page_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_wocommerce_single_page_sidebar', array(
		'label'       => esc_html__( 'Show Single Product Page Sidebar', 'education-insight' ),
		'section'     => 'education_insight_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'education_insight_wocommerce_single_page_sidebar',
	) ) );


	//theme width
	$wp_customize->add_section('education_insight_theme_width_settings',array(
        'title' => __('Theme Width Option', 'education-insight'),
        'priority' => 1,
    ) );

	$wp_customize->add_setting('education_insight_width_options',array(
        'default' => 'full_width',
        'sanitize_callback' => 'education_insight_sanitize_choices'
	));
	$wp_customize->add_control('education_insight_width_options',array(
        'type' => 'select',
        'label' => __('Theme Width Option','education-insight'),
        'section' => 'education_insight_theme_width_settings',
        'choices' => array(
            'full_width' => __('fullwidth','education-insight'),
            'container' => __('container','education-insight'),
            'container_fluid' => __('container fluid','education-insight'),
        ),
	) );

    // Post Layouts
    $wp_customize->add_section('education_insight_layout',array(
        'title' => __('Post Layout', 'education-insight'),
        'description' => __( 'Change the post layout from below options', 'education-insight' ),
    ) );

	$wp_customize->add_setting( 'education_insight_post_sidebar', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_post_sidebar', array(
		'label'       => esc_html__( 'Show Fullwidth', 'education-insight' ),
		'section'     => 'education_insight_layout',
		'type'        => 'toggle',
		'settings'    => 'education_insight_post_sidebar',
	) ) );

	$wp_customize->add_setting( 'education_insight_single_post_sidebar', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_single_post_sidebar', array(
		'label'       => esc_html__( 'Show Single Post Fullwidth', 'education-insight' ),
		'section'     => 'education_insight_layout',
		'type'        => 'toggle',
		'settings'    => 'education_insight_single_post_sidebar',
	) ) );

    $wp_customize->add_setting('education_insight_post_option',array(
		'default' => 'simple_post',
		'sanitize_callback' => 'education_insight_sanitize_select'
	));
	$wp_customize->add_control('education_insight_post_option',array(
		'label' => esc_html__('Select Layout','education-insight'),
		'section' => 'education_insight_layout',
		'setting' => 'education_insight_post_option',
		'type' => 'radio',
        'choices' => array(
            'simple_post' => __('Simple Post','education-insight'),
            'grid_post' => __('Grid Post','education-insight'),
        ),
	));

    $wp_customize->add_setting('education_insight_grid_column',array(
		'default' => '3_column',
		'sanitize_callback' => 'education_insight_sanitize_select'
	));
	$wp_customize->add_control('education_insight_grid_column',array(
		'label' => esc_html__('Grid Post Per Row','education-insight'),
		'section' => 'education_insight_layout',
		'setting' => 'education_insight_grid_column',
		'type' => 'radio',
        'choices' => array(
            '1_column' => __('1','education-insight'),
            '2_column' => __('2','education-insight'),
            '3_column' => __('3','education-insight'),
            '4_column' => __('4','education-insight'),
            '5_column' => __('6','education-insight'),
        ),
	));

	$wp_customize->add_setting( 'education_insight_date', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_date', array(
		'label'       => esc_html__( 'Hide Date', 'education-insight' ),
		'section'     => 'education_insight_layout',
		'type'        => 'toggle',
		'settings'    => 'education_insight_date',
	) ) );

	$wp_customize->selective_refresh->add_partial( 'education_insight_date', array(
		'selector' => '.date-box',
		'render_callback' => 'education_insight_customize_partial_education_insight_date',
	) );

	$wp_customize->add_setting( 'education_insight_admin', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_admin', array(
		'label'       => esc_html__( 'Hide Author/Admin', 'education-insight' ),
		'section'     => 'education_insight_layout',
		'type'        => 'toggle',
		'settings'    => 'education_insight_admin',
	) ) );

	$wp_customize->selective_refresh->add_partial( 'education_insight_admin', array(
		'selector' => '.entry-author',
		'render_callback' => 'education_insight_customize_partial_education_insight_admin',
	) );

	$wp_customize->add_setting( 'education_insight_comment', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_comment', array(
		'label'       => esc_html__( 'Hide Comment', 'education-insight' ),
		'section'     => 'education_insight_layout',
		'type'        => 'toggle',
		'settings'    => 'education_insight_comment',
	) ) );

	$wp_customize->selective_refresh->add_partial( 'education_insight_comment', array(
		'selector' => '.entry-comments',
		'render_callback' => 'education_insight_customize_partial_education_insight_comment',
	) );

	// Top Header
    $wp_customize->add_section('education_insight_top',array(
        'title' => __('Contact info', 'education-insight'),
        'description' => __( 'Add contact info in the below feilds', 'education-insight' ),
    ) );

	$wp_customize->add_setting('education_insight_call',array(
		'default' => '',
		'sanitize_callback' => 'education_insight_sanitize_phone_number'
	));
	$wp_customize->add_control('education_insight_call',array(
		'label' => esc_html__('Add Phone Number','education-insight'),
		'section' => 'education_insight_top',
		'setting' => 'education_insight_call',
		'type'    => 'text'
	));

	$wp_customize->selective_refresh->add_partial( 'education_insight_call', array(
		'selector' => '.top_header i',
		'render_callback' => 'education_insight_customize_partial_education_insight_call',
	) );


	$wp_customize->add_setting('education_insight_email',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_email'
	));
	$wp_customize->add_control('education_insight_email',array(
		'label' => esc_html__('Add Email Address','education-insight'),
		'section' => 'education_insight_top',
		'setting' => 'education_insight_email',
		'type'    => 'text'
	));

	// Social Media
    $wp_customize->add_section('education_insight_urls',array(
        'title' => __('Social Media', 'education-insight'),
        'description' => __( 'Add social media links in the below feilds', 'education-insight' ),
    ) );

    $wp_customize->add_setting('header_social_icon_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'education_insight_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Education_Insight_Toggle_Control( $wp_customize, 'header_social_icon_enable', 
        array(
            'label' => esc_html__('Hide / Show Social Icon', 'education-insight'),
            'type' => 'toggle',
            'section' => 'education_insight_urls',
        )
    ));

    $wp_customize->add_setting('education_insight_facebook_icon',array(
		'default'	=> 'fab fa-facebook-f',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_facebook_icon',array(
		'label'	=> __('Add Facebook Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_urls',
		'setting'	=> 'education_insight_facebook_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('education_insight_facebook',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('education_insight_facebook',array(
		'label' => esc_html__('Facebook URL','education-insight'),
		'section' => 'education_insight_urls',
		'setting' => 'education_insight_facebook',
		'type'    => 'url'
	));

	$wp_customize->selective_refresh->add_partial( 'education_insight_facebook', array(
		'selector' => '.links a i',
		'render_callback' => 'education_insight_customize_partial_education_insight_facebook',
	) );

	$wp_customize->selective_refresh->add_partial( 'education_insight_facebook', array(
		'selector' => '.links a i',
		'render_callback' => 'education_insight_customize_partial_education_insight_facebook',
	) );

	$wp_customize->add_setting('education_insight_header_fb_target',
    array(
        'default' => true,
        'sanitize_callback' => 'education_insight_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_header_fb_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'education-insight'),
            'type' => 'toggle',
            'section' => 'education_insight_urls',
        )
    ));  

	$wp_customize->add_setting('education_insight_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_twitter_icon',array(
		'label'	=> __('Add Twitter Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_urls',
		'setting'	=> 'education_insight_twitter_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('education_insight_twitter',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('education_insight_twitter',array(
		'label' => esc_html__('Twitter URL','education-insight'),
		'section' => 'education_insight_urls',
		'setting' => 'education_insight_twitter',
		'type'    => 'url'
	));

	$wp_customize->add_setting('education_insight_header_twt_target',
    array(
        'default' => true,
        'sanitize_callback' => 'education_insight_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_header_twt_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'education-insight'),
            'type' => 'toggle',
            'section' => 'education_insight_urls',
        )
    ));

	$wp_customize->add_setting('education_insight_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_linkedin_icon',array(
		'label'	=> __('Add Linkedin Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_urls',
		'setting'	=> 'education_insight_linkedin_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('education_insight_linkedin',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('education_insight_linkedin',array(
		'label' => esc_html__('Linkedin URL','education-insight'),
		'section' => 'education_insight_urls',
		'setting' => 'education_insight_linkedin',
		'type'    => 'url'
	));

	$wp_customize->add_setting('education_insight_header_linkedin_target',
    array(
        'default' => true,
        'sanitize_callback' => 'education_insight_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_header_linkedin_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'education-insight'),
            'type' => 'toggle',
            'section' => 'education_insight_urls',
        )
    ));

	$wp_customize->add_setting('education_insight_pintrest_icon',array(
		'default'	=> 'fab fa-pinterest-p',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_pintrest_icon',array(
		'label'	=> __('Add Pintrest Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_urls',
		'setting'	=> 'education_insight_pintrest_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('education_insight_pintrest',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('education_insight_pintrest',array(
		'label' => esc_html__('Pintrest URL','education-insight'),
		'section' => 'education_insight_urls',
		'setting' => 'education_insight_pintrest',
		'type'    => 'url'
	));

	$wp_customize->add_setting('education_insight_header_pintrest_target',
    array(
        'default' => true,
        'sanitize_callback' => 'education_insight_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_header_pintrest_target', 
        array(
            'label' => esc_html__('Open link in a new tab', 'education-insight'),
            'type' => 'toggle',
            'section' => 'education_insight_urls',
        )
    ));

    //Slider
	$wp_customize->add_section( 'education_insight_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'education-insight' ),
    	'description' => __( 'Image Dimension ( 700 x 795 ) px', 'education-insight' ),
		'priority'   => null,
	) );

	$wp_customize->add_setting( 'education_insight_hide_show', array(
		'default'           => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_hide_show', array(
		'label'       => esc_html__( 'Show Slider', 'education-insight' ),
		'section'     => 'education_insight_slider_section',
		'type'        => 'toggle',
		'settings'    => 'education_insight_hide_show',
	) ) );

	$education_insight_args = array('numberposts' => -1);
	$post_list = get_posts($education_insight_args);
	$i = 0;
	$pst_sls[]= __('Select','education-insight');
	foreach ($post_list as $key => $p_post) {
		$pst_sls[$p_post->ID]=$p_post->post_title;
	}
	for ( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting('education_insight_post_setting'.$i,array(
			'sanitize_callback' => 'education_insight_sanitize_choices',
		));
		$wp_customize->add_control('education_insight_post_setting'.$i,array(
			'type'    => 'select',
			'choices' => $pst_sls,
			'label' => __('Select post','education-insight'),
			'section' => 'education_insight_slider_section',
		));

		$wp_customize->selective_refresh->add_partial( 'education_insight_post_setting'.$i, array(
			'selector' => '.inner_carousel h2',
			'render_callback' => 'education_insight_customize_partial_education_insight_post_setting'.$i,
		) );
	}
	wp_reset_postdata();

	//Middle Section
	$wp_customize->add_section( 'education_insight_middle_section' , array(
    	'title'      => __( 'Services Settings', 'education-insight' ),
		'priority'   => null,
	) );

	$wp_customize->add_setting('education_insight_middle_sec_page_settigs',array(
		'sanitize_callback' => 'education_insight_sanitize_dropdown_pages',
	));
	$wp_customize->add_control('education_insight_middle_sec_page_settigs',array(
		'type'    => 'dropdown-pages',
		'label' => __('Select Page','education-insight'),
		'section' => 'education_insight_middle_section',
	));

	$wp_customize->selective_refresh->add_partial( 'education_insight_middle_sec_page_settigs', array(
		'selector' => '#middle-sec h3',
		'render_callback' => 'education_insight_customize_partial_education_insight_middle_sec_page_settigs',
	) );

	$education_insight_args = array('numberposts' => -1);
	$post_list = get_posts($education_insight_args);
	$s = 0;
	$pst_sls[]= __('Select','education-insight');
	foreach ($post_list as $key => $p_post) {
		$pst_sls[$p_post->ID]=$p_post->post_title;
	}
	for ( $s = 1; $s <= 4; $s++ ) {
		$wp_customize->add_setting('education_insight_mid_section_icon'.$s,array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('education_insight_mid_section_icon'.$s,array(
			'label' => esc_html__('Icon','education-insight'),
			'description' => esc_html__('Add the fontawesome class to add icon ex: fas fa-envelope','education-insight'),
			'section' => 'education_insight_middle_section',
			'setting' => 'education_insight_mid_section_icon',
			'type'    => 'text'
		));

		$wp_customize->add_setting('education_insight_middle_sec_settigs'.$s,array(
			'sanitize_callback' => 'education_insight_sanitize_choices',
		));
		$wp_customize->add_control('education_insight_middle_sec_settigs'.$s,array(
			'type'    => 'select',
			'choices' => $pst_sls,
			'label' => __('Select post','education-insight'),
			'section' => 'education_insight_middle_section',
		));
	}
	wp_reset_postdata();

	// Top Categories
	$wp_customize->add_section('education_insight_popular_courses',array(
		'title' => esc_html__('Courses Settings','education-insight'),
		'description' => __( 'Image Dimension ( 410 x 260 ) px', 'education-insight' ),
	));

	$wp_customize->add_setting('education_insight_popular_courses_heading',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('education_insight_popular_courses_heading',array(
		'label' => esc_html__('Heading','education-insight'),
		'section' => 'education_insight_popular_courses',
		'setting' => 'education_insight_popular_courses_heading',
		'type'    => 'text'
	));

	$wp_customize->selective_refresh->add_partial( 'education_insight_popular_courses_heading', array(
		'selector' => '#course-cat h3',
		'render_callback' => 'education_insight_customize_partial_education_insight_popular_courses_heading',
	) );

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= __('Select','education-insight');
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('education_insight_popular_courses_setting',array(
		'default' => 0,
		'sanitize_callback' => 'education_insight_sanitize_select',
	));
	$wp_customize->add_control('education_insight_popular_courses_setting',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => esc_html__('Select Category to display courses','education-insight'),
		'section' => 'education_insight_popular_courses',
	));

	//Footer
    $wp_customize->add_section( 'education_insight_footer_copyright', array(
    	'title'      => esc_html__( 'Footer Text', 'education-insight' ),
	) );

    $wp_customize->add_setting('education_insight_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('education_insight_footer_text',array(
		'label'	=> esc_html__('Copyright Text','education-insight'),
		'section'	=> 'education_insight_footer_copyright',
		'type'		=> 'text'
	));

	$wp_customize->selective_refresh->add_partial( 'education_insight_footer_text', array(
		'selector' => '.site-info a',
		'render_callback' => 'education_insight_customize_partial_education_insight_footer_text',
	) );

	$wp_customize->add_setting('education_insight_footer_widget',array(
		'default' => '4',
		'sanitize_callback' => 'education_insight_sanitize_select'
	));
	$wp_customize->add_control('education_insight_footer_widget',array(
		'label' => esc_html__('Footer Per Column','education-insight'),
		'section' => 'education_insight_footer_copyright',
		'setting' => 'education_insight_footer_widget',
		'type' => 'radio',
				'choices' => array(
						'1'   => __('1 Column', 'education-insight'),
						'2'  => __('2 Column', 'education-insight'),
						'3' => __('3 Column', 'education-insight'),
						'4' => __('4 Column', 'education-insight')
				),
	));


    $wp_customize->add_setting( 'education_insight_logo_title', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_logo_title', array(
		'label'       => esc_html__( 'Show Site Title', 'education-insight' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'education_insight_logo_title',
	) ) );

    $wp_customize->add_setting( 'education_insight_logo_text', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Education_Insight_Toggle_Control( $wp_customize, 'education_insight_logo_text', array(
		'label'       => esc_html__( 'Show Site Tagline', 'education-insight' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'education_insight_logo_text',
	) ) );


	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'education_insight_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'education_insight_customize_partial_blogdescription',
	) );

	//front page
	$education_insight_num_sections = apply_filters( 'education_insight_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $education_insight_num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'education_insight_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'education-insight' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'education-insight' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'education_insight_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'education_insight_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'education_insight_customize_register' );

function education_insight_customize_partial_blogname() {
	bloginfo( 'name' );
}

function education_insight_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function education_insight_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function education_insight_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

define('EDUCATION_INSIGHT_PRO_LINK',__('https://www.ovationthemes.com/wordpress/education-wordpress-theme/','education-insight'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Education_Insight_Pro_Control')):
    class Education_Insight_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
	        <div class="col-md-2 col-sm-6 upsell-btn">
                <a href="<?php echo esc_url( EDUCATION_INSIGHT_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE EDUCATION PREMIUM','education-insight');?> </a>
	        </div>
            <div class="col-md-4 col-sm-6">
                <img class="education_insight_img_responsive " src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png">
            </div>
	        <div class="col-md-3 col-sm-6">
	            <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('EDUCATION PREMIUM - Features', 'education-insight'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'education-insight');?> </li>
                </ul>
        	</div>
		    <div class="col-md-2 col-sm-6 upsell-btn upsell-btn-bottom">
	            <a href="<?php echo esc_url( EDUCATION_INSIGHT_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE EDUCATION PREMIUM','education-insight');?> </a>
		    </div>
			<p><?php printf(__('Please review us if you love our product on %1$sWordPress.org%2$s. </br></br>  Thank You', 'education-insight'), '<a target="blank" href="https://wordpress.org/support/theme/education-insight/reviews/">', '</a>');
            ?></p>
        </label>
    <?php } }
endif;
