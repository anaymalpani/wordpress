<?php

function biznez_lite_customize_register( $wp_customize ) {

	// define image directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	// Do stuff with $wp_customize, the WP_Customize_Manager object.
	$wp_customize->remove_control('header_textcolor');

	// ====================================
	// = biznez Lite Theme Pannel
	// ====================================
	$wp_customize->add_panel( 'home_page_panel', array(
		'title' => __( 'Home Page Settings', 'biznez-lite'),
		'priority' => 10,
	) );


	// ====================================
	// = biznez Lite Theme Sections
	// ====================================
	$wp_customize->add_section( 'general_settings' , array(
		'title' 		=> __('General Settings','biznez-lite'),

	) );
	$wp_customize->add_section( 'notification_section' , array(
		'title' 		=> __('Notification Bar','biznez-lite'),

	) );
	$wp_customize->add_section( 'footer_settings' , array(
		'title' 		=> __('Footer','biznez-lite'),

	) );
	$wp_customize->add_section( 'about_page' , array(
		'title' => __('About Page','biznez-lite'),
		'active_callback' => 'biznez_lite_is_about_page_template'
	) );
	$wp_customize->add_section( 'contact_page' , array(
		'title' => __('Contact Page Options','biznez-lite'),
		'active_callback' => 'biznez_lite_is_contact_page_template'
	) );
	// Home Page Section
	$wp_customize->add_section( 'slider_section' , array(
		'title' 		=> __('Slider Configuration','biznez-lite'),
		'panel'	 => 'home_page_panel',
	) );
	$wp_customize->add_section( 'home_featured_section' , array(
		'title' => __('Featured Box','biznez-lite'),
		'panel' => 'home_page_panel',
	) );
	$wp_customize->add_section( 'home_testimonial_section' , array(
		'title' => __('Testimonial','biznez-lite'),
		'panel' => 'home_page_panel',
	) );
	$wp_customize->add_section( 'home_clientlogo_section' , array(
		'title' => __('Client Logos','biznez-lite'),
		'panel' => 'home_page_panel',
	) );
	$wp_customize->add_section( 'home_cta_section' , array(
		'title' => __('Call to Action','biznez-lite'),
		'panel' => 'home_page_panel',
	) );
	
	$wp_customize->add_setting( '_colorpicker', array(
		'default'           => '#30b7ff' ,
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, '_colorpicker', array(
		'priority' 		=> 1,
		'section'     	=> 'colors',
		'label'       	=> __( 'Primary Color Scheme', 'biznez-lite' ),
	) ) );
	$wp_customize->add_setting( '_headerbackground', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, '_headerbackground', array(
		'priority' => 2,
		'section'     	=> 'colors',
		'label'       	=> __( 'Header background Color', 'biznez-lite' ),
	) ) );

	// ====================================
	// = General Settings Sections
	// ====================================
	$wp_customize->add_setting( '_logo_img', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_logo_img', array(
		'label' => __( 'Logo Image', 'biznez-lite' ),
		'description' => __('Recomended size : 160x35 px', 'biznez-lite'),
		'section' => 'general_settings',
		'mime_type' => 'image',
	) ) );

	$wp_customize->add_setting( '_logo_wdth', array(
		'default'        => __('154', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea'
	));
	$wp_customize->add_control('_logo_wdth', array(
		'section' => 'general_settings',
		'label' => __('Logo Image Width in px','biznez-lite'),
	));

	$wp_customize->add_setting( '_logo_hght', array(
		'default'        => __('37', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea'
	));
	$wp_customize->add_control('_logo_hght', array(
		'description' => __('Enter Logo Image Height in PX.', 'biznez-lite'),
		'section' => 'general_settings',
		'label' => __('Logo Image Height in px','biznez-lite'),
	));
	// Breadcrumb
	$wp_customize->add_setting( '_breadcrumb', array(
		'default'           => 'on',
		'sanitize_callback' => 'biznez_lite_sanitize_on_off'
	) );
	$wp_customize->add_control( '_breadcrumb', array(
		'type' => 'radio',
		'section' => 'general_settings',
		'label' => __( 'Breadcrumb ON/OFF', 'biznez-lite' ),
		'choices' => array(
			'on' => __('ON', 'biznez-lite' ),
			'off'=> __('OFF', 'biznez-lite' ),
		),
	) );
	$wp_customize->add_setting( '_breadcrumb_sep', array(
		'default'           => 'off',
		'sanitize_callback' => 'biznez_lite_sanitize_on_off'
	) );
	$wp_customize->add_control( '_breadcrumb_sep', array(
		'type' => 'radio',
		'section' => 'general_settings',
		'label' => __( 'Breadcrumb Seperator Type', 'biznez-lite' ),
		'choices' => array(
			'on' => __('Image', 'biznez-lite' ),
			'off'=> __('Text', 'biznez-lite' ),
		),
	) );
	$wp_customize->add_setting( '_bdcrumb_simg', array(
		'default'           => $imagepath.'ber-arrow.png',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_bdcrumb_simg', array(
		'label' => __( 'Breadcrumb Separator Image', 'biznez-lite' ),
		'description' => __('Recomended - width:16px and height:16px', 'biznez-lite'),
		'section' => 'general_settings',
		'mime_type' => 'image',
		'active_callback' => 'biznez_lite_active_breadcrumb_sep_image'
	) ) );
	$wp_customize->add_setting( '_bdcrumb_stxt', array(
		'default'        => ' / ',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea'
	));
	$wp_customize->add_control('_bdcrumb_stxt', array(
		'section' => 'general_settings',
		'label' => __('Breadcrumb Seperator Text','biznez-lite'),
		'active_callback' => 'biznez_lite_active_breadcrumb_sep_text'
	));

	// Persistent header
	$wp_customize->add_setting( '_skenavfull', array(
		'default'           => 'on',
		'sanitize_callback' => 'biznez_lite_sanitize_on_off',
	) );
	$wp_customize->add_control( '_skenavfull', array(
		'label' => __( 'Persistent Navigation ON/OFF', 'biznez-lite' ),
		'section' => 'general_settings',
		'type' => 'radio',
		'choices' => array(
			'on' =>'ON',
			'off'=> 'OFF'
		),
	) );

	// Custom Pagination
	$wp_customize->add_setting( '_show_pagenavi', array(
		'default'           => 'on',
		'sanitize_callback' => 'biznez_lite_sanitize_on_off'
	) );
	$wp_customize->add_control( '_show_pagenavi', array(
		'type' => 'radio',
		'section' => 'general_settings',
		'label' => __( 'Custom Pagination', 'biznez-lite' ),
		'choices' => array(
			'on' => __('ON', 'biznez-lite' ),
			'off'=> __('OFF', 'biznez-lite' ),
		),
	) );

	// ====================================
	// = Home Slider Settings Sections
	// ====================================
	$wp_customize->add_setting( '_slider_type', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_slider_type',
	) );
	$wp_customize->add_control( '_slider_type', array(
		'type' => 'select',
		'choices' => array(
			'normal' => __('NormalSlider', 'biznez-lite'),
			'fullwidth' => __('FullWidthSlider', 'biznez-lite')
		),
		'section' => 'slider_section',
		'label' => __( 'Select Slider Type', 'biznez-lite' ),
		'description' => __( 'Select slider type for front page.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_effect_select', array(
		'default'           => 'horizontal-slide',
		'sanitize_callback' => 'biznez_lite_sanitize_slider_animation'
	) );
	$wp_customize->add_control( '_effect_select', array(
		'type' => 'select',
		'section' => 'slider_section',
		'label' => __( 'Select Slider Type', 'biznez-lite' ),
		'choices' => array(
			'fade' => __('Fade', 'biznez-lite' ),
			'horizontal-slide'=> __('Horizontal Slide', 'biznez-lite' ),
			'vertical-slide' => __('Vertical Slide', 'biznez-lite' ),
			'horizontal-push' => __('Horizontal Push', 'biznez-lite' )
		),
	) );

	$wp_customize->add_setting( '_animation_speed', array(
		'default'        => '800',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea'
	));
	$wp_customize->add_control('_animation_speed', array(
		'section' => 'slider_section',
		'label' => __('Animation Speed','biznez-lite'),
	));

	$wp_customize->add_setting( '_slider_title1', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_slider_title1', array(
		'section'  		=> 'slider_section',
		'label'    		=> __( 'First Slide Title', 'biznez-lite' ),
		'description' => __( 'Enter title for first slide.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_slider_img1', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_slider_img1', array(
		'label' => __( 'Upload First Slide Image', 'biznez-lite' ),
		'description' => __('Upload image for front page slider.', 'biznez-lite'),
		'section' => 'slider_section',
		'mime_type' => 'image',
	) ) );

	$wp_customize->add_setting( '_content_slider1', array(
		'default'        => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_content_slider1', array(
		'section' => 'slider_section',
		'type' => 'textarea',
		'label' => __('Content For First Slide','biznez-lite'),
		'description' => __( 'Enter content for first slide.', 'biznez-lite' ),
	));

	$wp_customize->add_setting( '_slider_link1', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_slider_link1', array(
		'type'     		=> 'url',
		'section'  		=> 'slider_section',
		'label'    		=> __( 'First Slide Link', 'biznez-lite' ),
		'description' => __( 'Enter first slide link.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_slider_title2', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_slider_title2', array(
		'section'  		=> 'slider_section',
		'label'    		=> __( 'Second Slide Title', 'biznez-lite' ),
		'description' => __( 'Enter title for second slide.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_slider_img2', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_slider_img2', array(
		'label' => __( 'Upload Second Slide Image', 'biznez-lite' ),
		'description' => __('Upload image for front page slider.', 'biznez-lite'),
		'section' => 'slider_section',
		'mime_type' => 'image',
	) ) );

	$wp_customize->add_setting( '_content_slider2', array(
		'default'        => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_content_slider2', array(
		'section' => 'slider_section',
		'type' => 'textarea',
		'label' => __('Content For Second Slide','biznez-lite'),
		'description' => __( 'Enter content for second slide.', 'biznez-lite' ),
	));

	$wp_customize->add_setting( '_slider_link2', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_slider_link2', array(
		'type'     		=> 'url',
		'section'  		=> 'slider_section',
		'label'    		=> __( 'Second Slide Link', 'biznez-lite' ),
		'description' => __( 'Enter second slide link.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_slider_title3', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_slider_title3', array(
		'section'  		=> 'slider_section',
		'label'    		=> __( 'Third Slide Title', 'biznez-lite' ),
		'description' => __( 'Enter title for third slide.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_slider_img3', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_slider_img3', array(
		'label' => __( 'Upload Third Slide Image', 'biznez-lite' ),
		'description' => __('Upload image for front page slider.', 'biznez-lite'),
		'section' => 'slider_section',
		'mime_type' => 'image',
	) ) );

	$wp_customize->add_setting( '_content_slider3', array(
		'default'        => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_content_slider3', array(
		'section' => 'slider_section',
		'type' => 'textarea',
		'label' => __('Content For Third Slide','biznez-lite'),
		'description' => __( 'Enter content for third slide.', 'biznez-lite' ),
	));

	$wp_customize->add_setting( '_slider_link3', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_slider_link3', array(
		'type'     		=> 'url',
		'section'  		=> 'slider_section',
		'label'    		=> __( 'Third Slide Link', 'biznez-lite' ),
		'description' => __( 'Enter third slide link.', 'biznez-lite' ),
	) );

	// ====================================
	// = Home Featured Settings Sections
	// ====================================

	$wp_customize->add_setting( '_hide_frontboxes', array(
		'default'           => 'on',
		'sanitize_callback' => 'biznez_lite_sanitize_on_off',
	) );
	$wp_customize->add_control( '_hide_frontboxes', array(
		'label' => __( 'Enable/Disable Feature Box on Front Page', 'biznez-lite' ),
		'section' => 'home_featured_section',
		'type' => 'radio',
		'choices' => array(
			'on' =>'ON',
			'off'=> 'OFF'
		),
	) );

	$wp_customize->add_setting( '_feature_type', array(
		'default'           => 'normal',
		'sanitize_callback' => 'biznez_lite_sanitize_feature_type'
	) );
	$wp_customize->add_control( '_feature_type', array(
		'type' => 'select',
		'section' => 'home_featured_section',
		'label' => __( 'Select Featured box Type', 'biznez-lite' ),
		'description' 	=> __('Select featured box for front page.', 'biznez-lite' ),
		'choices' => array(
			'normal' => __('Normal', 'biznez-lite'),
			'centercontent' => __('Center Content', 'biznez-lite')
		),
	) );
	// First Feature Box
	$wp_customize->add_setting( '_fb1_heading', array(
		'default'           => 'Heading',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_fb1_heading', array(
		'label' => __( 'First Featured Box Heading:', 'biznez-lite' ),
		'description' 	=> __('Enter first featured box heading.', 'biznez-lite' ),
		'section' => 'home_featured_section',
	) );

	$wp_customize->add_setting( '_fb1_icon', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_fb1_icon', array(
		'section' 		=> 'home_featured_section',
		'label' 		=> __( 'First Featured Box Icon', 'biznez-lite' ),
		'description' 	=> __('Choose image for first featured area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_fb1_content', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_fb1_content', array(
		'label' => __( 'First Featured Box Content', 'biznez-lite' ),
		'description' 	=> __('Enter first featured box content.', 'biznez-lite' ),
		'section' => 'home_featured_section',
		'type' => 'textarea'
	) );

	$wp_customize->add_setting( '_fb1_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_fb1_link', array(
		'type'     		=> 'url',
		'section'  		=> 'home_featured_section',
		'label'    		=> __( 'First Featured Box Link:', 'biznez-lite' ),
		'description' 	=> __('Enter first featured box link.', 'biznez-lite' ),
	) );
	// Second Feature Box
	$wp_customize->add_setting( '_fb2_heading', array(
		'default'           => 'Heading',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_fb2_heading', array(
		'label' => __( 'Second Featured Box Heading:', 'biznez-lite' ),
		'description' 	=> __('Enter second featured box heading.', 'biznez-lite' ),
		'section' => 'home_featured_section',
	) );

	$wp_customize->add_setting( '_fb2_icon', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_fb2_icon', array(
		'section' 		=> 'home_featured_section',
		'label' 		=> __( 'Second Featured Box Icon', 'biznez-lite' ),
		'description' 	=> __('Choose image for second featured area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_fb2_content', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_fb2_content', array(
		'label' => __( 'Second Featured Box Content', 'biznez-lite' ),
		'description' 	=> __('Enter second featured box content.', 'biznez-lite' ),
		'section' => 'home_featured_section',
		'type' => 'textarea'
	) );

	$wp_customize->add_setting( '_fb2_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_fb2_link', array(
		'type'     		=> 'url',
		'section'  		=> 'home_featured_section',
		'label'    		=> __( 'Second Featured Box Link:', 'biznez-lite' ),
		'description' 	=> __('Enter second featured box link.', 'biznez-lite' ),
	) );
	// Third Feature Box
	$wp_customize->add_setting( '_fb3_heading', array(
		'default'           => 'Heading',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_fb3_heading', array(
		'label' => __( 'Third Featured Box Heading:', 'biznez-lite' ),
		'description' 	=> __('Enter third featured box heading.', 'biznez-lite' ),
		'section' => 'home_featured_section',
	) );

	$wp_customize->add_setting( '_fb3_icon', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_fb3_icon', array(
		'section' 		=> 'home_featured_section',
		'label' 		=> __( 'Third Featured Box Icon', 'biznez-lite' ),
		'description' 	=> __('Choose image for third featured area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_fb3_content', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_fb3_content', array(
		'label' => __( 'Third Featured Box Content', 'biznez-lite' ),
		'description' 	=> __('Enter third featured box content.', 'biznez-lite' ),
		'section' => 'home_featured_section',
		'type' => 'textarea'
	) );

	$wp_customize->add_setting( '_fb3_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_fb3_link', array(
		'type'     		=> 'url',
		'section'  		=> 'home_featured_section',
		'label'    		=> __( 'Third Featured Box Link:', 'biznez-lite' ),
		'description' 	=> __('Enter third featured box link.', 'biznez-lite' ),
	) );

	// Fourth Feature Box
	$wp_customize->add_setting( '_fb4_heading', array(
		'default'           => 'Heading',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_fb4_heading', array(
		'label' => __( 'Fourth Featured Box Heading:', 'biznez-lite' ),
		'description' 	=> __('Enter forth featured box heading.', 'biznez-lite' ),
		'section' => 'home_featured_section',
	) );

	$wp_customize->add_setting( '_fb4_icon', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_fb4_icon', array(
		'section' 		=> 'home_featured_section',
		'label' 		=> __( 'Fourth Featured Box Icon', 'biznez-lite' ),
		'description' 	=> __('Choose image for forth featured area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_fb4_content', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_fb4_content', array(
		'label' => __( 'Fourth Featured Box Content', 'biznez-lite' ),
		'description' 	=> __('Enter forth featured box content.', 'biznez-lite' ),
		'section' => 'home_featured_section',
		'type' => 'textarea'
	) );

	$wp_customize->add_setting( '_fb4_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_fb4_link', array(
		'type'     		=> 'url',
		'section'  		=> 'home_featured_section',
		'label'    		=> __( 'Fourth Featured Box Link:', 'biznez-lite' ),
		'description' 	=> __('Enter forth featured box link.', 'biznez-lite' ),
	) );

	// ====================================
	// = Home Testimonial Settings Sections
	// ====================================

	$wp_customize->add_setting( '_hide_testclientbox', array(
		'default'           => 'on',
		'sanitize_callback' => 'biznez_lite_sanitize_on_off',
	) );
	$wp_customize->add_control( '_hide_testclientbox', array(
		'label' => __( 'Enable/Disable Testimonial and Client Box.', 'biznez-lite' ),
		'section' => 'home_testimonial_section',
		'type' => 'radio',
		'choices' => array(
			'on' =>'ON',
			'off'=> 'OFF'
		),
	) );

	$wp_customize->add_setting( '_front_testmonialheadtxt', array(
		'default'        => __('Testimonials', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_front_testmonialheadtxt', array(
		'label' => __('Testimonial Heading Text','biznez-lite'),
		'description' 	=> __('Enter testimonial heading text.', 'biznez-lite' ),
		'section' => 'home_testimonial_section',
	));

	//First Testimonial
	$wp_customize->add_setting( '_testi1_content', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_testi1_content', array(
		'label' => __( 'First Testimonial Box Content', 'biznez-lite' ),
		'description' 	=> __('Enter first testimonial box content.', 'biznez-lite' ),
		'section' => 'home_testimonial_section',
		'type' => 'textarea'
	) );

	$wp_customize->add_setting( '_testau1_name', array(
		'default'        => __('Testimonials', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_testau1_name', array(
		'label' => __('First Testimonial Author','biznez-lite'),
		'description' 	=> __('Enter first testimonial author.', 'biznez-lite' ),
		'section' => 'home_testimonial_section',
	));

	$wp_customize->add_setting( '_testau1_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_testau1_link', array(
		'type'     		=> 'url',
		'section'  		=> 'home_testimonial_section',
		'label'    		=> __( 'First Testimonial Author Link', 'biznez-lite' ),
		'description' 	=> __('Enter first testimonial author link.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_testau1_link_text', array(
		'default'        => __('Testimonials', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_testau1_link_text', array(
		'label' => __('First Testimonial Author Link Text','biznez-lite'),
		'description' 	=> __('Enter first testimonial author link text.', 'biznez-lite' ),
		'section' => 'home_testimonial_section',
	));

	//Second Testimonial
	$wp_customize->add_setting( '_testi2_content', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_testi2_content', array(
		'label' => __( 'Second Testimonial Box Content', 'biznez-lite' ),
		'description' 	=> __('Enter second testimonial box content.', 'biznez-lite' ),
		'section' => 'home_testimonial_section',
		'type' => 'textarea'
	) );

	$wp_customize->add_setting( '_testau2_name', array(
		'default'        => __('Testimonials', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_testau2_name', array(
		'label' => __('Second Testimonial Author','biznez-lite'),
		'description' 	=> __('Enter second testimonial author.', 'biznez-lite' ),
		'section' => 'home_testimonial_section',
	));

	$wp_customize->add_setting( '_testau2_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_testau2_link', array(
		'type'     		=> 'url',
		'section'  		=> 'home_testimonial_section',
		'label'    		=> __( 'Second Testimonial Author Link', 'biznez-lite' ),
		'description' 	=> __('Enter second testimonial author link.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_testau2_link_text', array(
		'default'        => __('Testimonials', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_testau2_link_text', array(
		'label' => __('Second Testimonial Author Link Text','biznez-lite'),
		'description' 	=> __('Enter second testimonial author link text.', 'biznez-lite' ),
		'section' => 'home_testimonial_section',
	));

	// ====================================
	// = Home Client Logo Settings Sections
	// ====================================

	$wp_customize->add_setting( '_client_title', array(
		'default'           => 'Our Clients',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_client_title', array(
		'label' => __( 'Client Title', 'biznez-lite' ),
		'description' 	=> __('Enter client title.', 'biznez-lite' ),
		'section' => 'home_clientlogo_section',
	) );

	//First Client
	$wp_customize->add_setting( '_ourclient_icon1', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_ourclient_icon1', array(
		'section' 		=> 'home_clientlogo_section',
		'label' 		=> __( 'First Client Logo Image', 'biznez-lite' ),
		'description' 	=> __('Upload image for first client logo area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_ourclient_link1', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_ourclient_link1', array(
		'type'     		=> 'url',
		'section'  		=> 'home_clientlogo_section',
		'label'    		=> __( 'First Client Logo Image Link', 'biznez-lite' ),
		'description' 	=> __('Enter link for first client logo image.', 'biznez-lite' ),
	) );

	//First Client
	$wp_customize->add_setting( '_ourclient_icon1', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_ourclient_icon1', array(
		'section' 		=> 'home_clientlogo_section',
		'label' 		=> __( 'First Client Logo Image', 'biznez-lite' ),
		'description' 	=> __('Upload image for first client logo area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_ourclient_link1', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_ourclient_link1', array(
		'type'     		=> 'url',
		'section'  		=> 'home_clientlogo_section',
		'label'    		=> __( 'First Client Logo Image Link', 'biznez-lite' ),
		'description' 	=> __('Enter link for first client logo image.', 'biznez-lite' ),
	) );

	//Second Client
	$wp_customize->add_setting( '_ourclient_icon2', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_ourclient_icon2', array(
		'section' 		=> 'home_clientlogo_section',
		'label' 		=> __( 'Second Client Logo Image', 'biznez-lite' ),
		'description' 	=> __('Upload image for second client logo area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_ourclient_link2', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_ourclient_link2', array(
		'type'     		=> 'url',
		'section'  		=> 'home_clientlogo_section',
		'label'    		=> __( 'Second Client Logo Image Link', 'biznez-lite' ),
		'description' 	=> __('Enter link for second client logo image.', 'biznez-lite' ),
	) );

	//Third Client
	$wp_customize->add_setting( '_ourclient_icon3', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_ourclient_icon3', array(
		'section' 		=> 'home_clientlogo_section',
		'label' 		=> __( 'Third Client Logo Image', 'biznez-lite' ),
		'description' 	=> __('Upload image for third client logo area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_ourclient_link3', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_ourclient_link3', array(
		'type'     		=> 'url',
		'section'  		=> 'home_clientlogo_section',
		'label'    		=> __( 'Third Client Logo Image Link', 'biznez-lite' ),
		'description' 	=> __('Enter link for third client logo image.', 'biznez-lite' ),
	) );

	//Fourth Client
	$wp_customize->add_setting( '_ourclient_icon4', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_ourclient_icon4', array(
		'section' 		=> 'home_clientlogo_section',
		'label' 		=> __( 'Fourth Client Logo Image', 'biznez-lite' ),
		'description' 	=> __('Upload image for fourth client logo area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_ourclient_link4', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_ourclient_link4', array(
		'type'     		=> 'url',
		'section'  		=> 'home_clientlogo_section',
		'label'    		=> __( 'Fourth Client Logo Image Link', 'biznez-lite' ),
		'description' 	=> __('Enter link for fourth client logo image.', 'biznez-lite' ),
	) );

	//Fifth Client
	$wp_customize->add_setting( '_ourclient_icon5', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_ourclient_icon5', array(
		'section' 		=> 'home_clientlogo_section',
		'label' 		=> __( 'Fifth Client Logo Image', 'biznez-lite' ),
		'description' 	=> __('Upload image for fifth client logo area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_ourclient_link5', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_ourclient_link5', array(
		'type'     		=> 'url',
		'section'  		=> 'home_clientlogo_section',
		'label'    		=> __( 'Fifth Client Logo Image Link', 'biznez-lite' ),
		'description' 	=> __('Enter link for fifth client logo image.', 'biznez-lite' ),
	) );

	//Sixth Client
	$wp_customize->add_setting( '_ourclient_icon6', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_ourclient_icon6', array(
		'section' 		=> 'home_clientlogo_section',
		'label' 		=> __( 'Sixth Client Logo Image', 'biznez-lite' ),
		'description' 	=> __('Upload image for sixth client logo area.', 'biznez-lite' ),
	) ) );

	$wp_customize->add_setting( '_ourclient_link6', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_ourclient_link6', array(
		'type'     		=> 'url',
		'section'  		=> 'home_clientlogo_section',
		'label'    		=> __( 'Sixth Client Logo Image Link', 'biznez-lite' ),
		'description' 	=> __('Enter link for sixth client logo image.', 'biznez-lite' ),
	) );

	// ====================================
	// = Home CTA Settings Sections
	// ====================================

	$wp_customize->add_setting( '_hide_frontcontentbox', array(
		'default'           => 'off',
		'sanitize_callback' => 'biznez_lite_sanitize_on_off',
	) );
	$wp_customize->add_control( '_hide_frontcontentbox', array(
		'label' => __( 'Enable/Disable Front Content Box.', 'biznez-lite' ),
		'section' => 'home_cta_section',
		'type' => 'radio',
		'choices' => array(
			'on' =>'ON',
			'off'=> 'OFF'
		),
	) );

	$wp_customize->add_setting( '_frontmain_content', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_frontmain_content', array(
		'label' => __( 'Front Content Box', 'biznez-lite' ),
		'description' 	=> __('Enter front content box content.', 'biznez-lite' ),
		'section' => 'home_cta_section',
		'type' => 'textarea'
	) );

	$wp_customize->add_setting( '_frontmain_buttonlink', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_frontmain_buttonlink', array(
		'type'     		=> 'url',
		'section'  		=> 'home_cta_section',
		'label'    		=> __( 'Front Content Box Button Link', 'biznez-lite' ),
		'description' 	=> __('Enter front content box button link.', 'biznez-lite' ),
	) );

	// ====================================
	// = About Page Settings Sections
	// ====================================
	$wp_customize->add_setting( '_about_teamhead', array(
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_about_teamhead', array(
		'label' => __('Team Member Heading Text','biznez-lite'),
		'description' => __( 'Change team member heading text.', 'biznez-lite' ),
		'section' => 'about_page',
	));

	$wp_customize->add_setting( '_tm_name1', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_tm_name1', array(
		'label' => __('First Team Member Name','biznez-lite'),
		'description' => __( 'Enter name of first team member.', 'biznez-lite' ),
		'section' => 'about_page',
	));

	$wp_customize->add_setting( '_tm_img1', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_tm_img1', array(
		'label' => __( 'Upload First Team Member Image', 'biznez-lite' ),
		'description' => __('upload image for team member. Size: Width 180px and Height 180px.', 'biznez-lite'),
		'section' => 'about_page',
		'mime_type' => 'image',
	) ) );

	$wp_customize->add_setting( '_tm_content1', array(
		'default'        => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_tm_content1', array(
		'section' => 'about_page',
		'type' => 'textarea',
		'label' => __('First Team Member Content','biznez-lite'),
		'description' => __( 'Enter content for first team member.', 'biznez-lite' ),
	));

	$wp_customize->add_setting( '_tm_job1', array(
		'default'           => '',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_tm_job1', array(
		'label' => __('First Team Member Job Title','biznez-lite'),
		'description' => __( 'Enter job title for first team member .', 'biznez-lite' ),
		'section' => 'about_page',
	));

	$wp_customize->add_setting( '_tm_fb1', array(
		'default'           => 'https://www.facebook.com/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_tm_fb1', array(
		'type'     		=> 'url',
		'section'  		=> 'about_page',
		'label'    		=> __( 'First Team Member Facebook url', 'biznez-lite' ),
		'description' => __( 'Enter first team member facebook url.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_tm_tw1', array(
		'default'           => 'https://twitter.com/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_tm_tw1', array(
		'type'     		=> 'url',
		'section'  		=> 'about_page',
		'label'    		=> __( 'First Team Member Twitter url', 'biznez-lite' ),
		'description' => __( 'Enter first team member twitter url.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_tm_drd1', array(
		'default'           => 'http://dribbble.com/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_tm_drd1', array(
		'type'     		=> 'url',
		'section'  		=> 'about_page',
		'label'    		=> __( 'First Team Member Dribbble  url', 'biznez-lite' ),
		'description' => __( 'Enter first team member dribbble  url.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_tm_name2', array(
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_tm_name2', array(
		'label' => __('Second Team Member Name','biznez-lite'),
		'description' => __( 'Enter name of second team member.', 'biznez-lite' ),
		'section' => 'about_page',
	));

	$wp_customize->add_setting( '_tm_img2', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_tm_img2', array(
		'label' => __( 'Upload Second Team Member Image', 'biznez-lite' ),
		'description' => __('upload image for team member. Size: Width 180px and Height 180px.', 'biznez-lite'),
		'section' => 'about_page',
		'mime_type' => 'image',
	) ) );

	$wp_customize->add_setting( '_tm_content2', array(
		'default'        => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_tm_content2', array(
		'section' => 'about_page',
		'type' => 'textarea',
		'label' => __('Second Team Member Content','biznez-lite'),
		'description' => __( 'Enter content for second team member.', 'biznez-lite' ),
	));

	$wp_customize->add_setting( '_tm_job2', array(
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_tm_job2', array(
		'label' => __('Second Team Member Job Title','biznez-lite'),
		'description' => __( 'Enter job title for second team member.', 'biznez-lite' ),
		'section' => 'about_page',
	));

	$wp_customize->add_setting( '_tm_fb2', array(
		'default'           => 'https://www.facebook.com/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_tm_fb2', array(
		'type'     		=> 'url',
		'section'  		=> 'about_page',
		'label'    		=> __( 'Second Team Member Facebook url', 'biznez-lite' ),
		'description' => __( 'Enter second team member facebook url.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_tm_tw2', array(
		'default'           => 'https://twitter.com/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_tm_tw2', array(
		'type'     		=> 'url',
		'section'  		=> 'about_page',
		'label'    		=> __( 'Second Team Member Twitter url', 'biznez-lite' ),
		'description' => __( 'Enter second team member twitter url.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_tm_drd2', array(
		'default'           => 'http://dribbble.com/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_tm_drd2', array(
		'type'     		=> 'url',
		'section'  		=> 'about_page',
		'label'    		=> __( 'Second Team Member Dribbble  url', 'biznez-lite' ),
		'description' => __( 'Enter second team member dribbble  url.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_tm_name3', array(
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_tm_name3', array(
		'label' => __('Third Team Member Name','biznez-lite'),
		'description' => __( 'Enter name of third team member.', 'biznez-lite' ),
		'section' => 'about_page',
	));

	$wp_customize->add_setting( '_tm_img3', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control( $wp_customize, '_tm_img3', array(
		'label' => __( 'Upload Third Team Member Image', 'biznez-lite' ),
		'description' => __('upload image for team member. Size: Width 180px and Height 180px.', 'biznez-lite'),
		'section' => 'about_page',
		'mime_type' => 'image',
	) ) );

	$wp_customize->add_setting( '_tm_content3', array(
		'default'        => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_tm_content3', array(
		'section' => 'about_page',
		'type' => 'textarea',
		'label' => __('Third Team Member Content','biznez-lite'),
		'description' => __( 'Enter content for third team member.', 'biznez-lite' ),
	));

	$wp_customize->add_setting( '_tm_job3', array(
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_tm_job3', array(
		'label' => __('Third Team Member Job Title','biznez-lite'),
		'description' => __( 'Enter job title for third team member .', 'biznez-lite' ),
		'section' => 'about_page',
	));

	$wp_customize->add_setting( '_tm_fb3', array(
		'default'           => 'https://www.facebook.com/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_tm_fb3', array(
		'type'     		=> 'url',
		'section'  		=> 'about_page',
		'label'    		=> __( 'Third Team Member Facebook url', 'biznez-lite' ),
		'description' => __( 'Enter third team member facebook url.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_tm_tw3', array(
		'default'           => 'https://twitter.com/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_tm_tw3', array(
		'type'     		=> 'url',
		'section'  		=> 'about_page',
		'label'    		=> __( 'Third Team Member Twitter url', 'biznez-lite' ),
		'description' => __( 'Enter third team member twitter url.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_tm_drd3', array(
		'default'           => 'http://dribbble.com/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( '_tm_drd3', array(
		'type'     		=> 'url',
		'section'  		=> 'about_page',
		'label'    		=> __( 'Third Team Member Dribbble  url', 'biznez-lite' ),
		'description' => __( 'Enter third team member dribbble  url.', 'biznez-lite' ),
	) );

	// ====================================
	// = Contact Page Settings Sections
	// ====================================
	$wp_customize->add_setting( '_header_phone', array(
		'default'           => '123-456-7891',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_header_phone', array(
		'section'  		=> 'contact_page',
		'label'    		=> __( 'Phone Number', 'biznez-lite' ),
		'description' => __( 'Put your phone number here to show in mobile view in header.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_add_title', array(
		'default'           => 'Office Address',
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	) );
	$wp_customize->add_control( '_add_title', array(
		'section'  		=> 'contact_page',
		'label'    		=> __( 'Address Title', 'biznez-lite' ),
		'description' => __( 'Put your address title here.', 'biznez-lite' ),
	) );

	$wp_customize->add_setting( '_contact_address_area', array(
		'default'        => __('Biznez<br />
						Forever Street 862<br />
						NSW - 125 - CA<br /><br />
						Phone: 123-456-7891<br />
						Fax: 123-456-7891<br />', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_contact_address_area', array(
		'type'	=> 'textarea',
		'section' => 'contact_page',
		'label' => __('Address Area (Put Your Address and Map Iframe Here)','biznez-lite'),
		'description' => __( 'Put your address here.', 'biznez-lite' ),
	));

	// = Notificaation Settings -> Notificaation Section
	// ===============================================
	$wp_customize->add_setting( '_notification_on_off', array(
		'default'           => 'on',
		'sanitize_callback' => 'biznez_lite_sanitize_on_off',
	) );
	$wp_customize->add_control( '_notification_on_off', array(
		'type' => 'select',
		'section' => 'notification_section',
		'label' => __( 'Notification Bar On/Off', 'biznez-lite' ),
		'choices' => array(
			'on' => __('On', 'biznez-lite' ),
			'off'=> __('Off', 'biznez-lite' ),
		),
	) );
	
	$wp_customize->add_setting( '_noticification_text', array(
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
	));
	$wp_customize->add_control('_noticification_text', array(
		'section' => 'notification_section',
		'label' => __('Notification Content','biznez-lite'),
		'description' => __('You can use HTML..','biznez-lite'),
	));

	// ====================================
	// = Footer Settings Sections
	// ====================================
	$wp_customize->add_setting( '_copyright', array(
		'default'        => __('Proudly Powered by WordPress', 'biznez-lite'),
		'sanitize_callback' => 'biznez_lite_sanitize_textarea',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('_copyright', array(
		'label' => __('Copyright Text','biznez-lite'),
		'section' => 'footer_settings',
	));
	
}
add_action( 'customize_register', 'biznez_lite_customize_register' );


// sanitize textarea
function biznez_lite_sanitize_textarea( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

function biznez_lite_sanitize_checkbox( $input ) {
	if ( $input ) {
		return true;
	}
	return false;
}

function biznez_lite_sanitize_on_off( $input ) {

    if ( $input == 'on' ) {
        return $input;
    } else {
        return 'off';
    }
    
}

function biznez_lite_sanitize_slider_type( $input ) {
	$valid = array(
		'normal' => __('NormalSlider', 'biznez-lite'),
		'fullwidth' => __('FullWidthSlider', 'biznez-lite')
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

// sanitize slider_animation
function biznez_lite_sanitize_slider_animation( $input ) {
	$valid = array(
		'fade' => __('Fade', 'biznez-lite' ),
		'horizontal-slide'=> __('Horizontal Slide', 'biznez-lite' ),
		'vertical-slide' => __('Vertical Slide', 'biznez-lite' ),
		'horizontal-push' => __('Horizontal Push', 'biznez-lite' )
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

// sanitize slider_animation
function biznez_lite_sanitize_feature_type( $input ) {
	$valid = array(
		'normal' => __('Normal', 'biznez-lite'),
		'centercontent' => __('Center Content', 'biznez-lite')
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function biznez_lite_active_breadcrumb_sep_image( $control ) {
	if ( $control->manager->get_setting('_breadcrumb_sep')->value() == 'on' ) {
		return true;
	} else {
		return false;
	}
}

function biznez_lite_active_breadcrumb_sep_text( $control ) {
	if ( $control->manager->get_setting('_breadcrumb_sep')->value() == 'off' ) {
		return true;
	} else {
		return false;
	}
}

function biznez_lite_is_about_page_template() {
	if( is_page_template("template-about-page.php") ) {
		return true;
	} else {
		return false;
	}
}

function biznez_lite_is_contact_page_template() {
	if( is_page_template("contact-page.php") ) {
		return true;
	} else {
		return false;
	}
}
?>