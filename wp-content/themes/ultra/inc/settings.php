<?php

/**
 * Initialize the settings.
 */
function ultra_theme_settings(){
	$settings = SiteOrigin_Settings::single();

	$settings->add_section( 'header', __('Header', 'ultra') );
	$settings->add_section( 'navigation', __('Navigation', 'ultra' ) );
	$settings->add_section( 'layout', __('Layout', 'ultra' ) );
	$settings->add_section( 'home', __('Home', 'ultra' ) );
	$settings->add_section( 'pages', __('Pages', 'ultra' ) );
	$settings->add_section( 'blog', __('Blog', 'ultra' ) );
	$settings->add_section( 'comments', __('Comments', 'ultra' ) );
	$settings->add_section( 'social', __('Social', 'ultra' ) );
	$settings->add_section( 'footer', __('Footer', 'ultra' ) );
	$settings->add_section( 'text', __('Site Text', 'ultra' ) );

	// Header.
	$settings->add_field('header', 'logo', 'media', __('Logo', 'ultra'), array(
		'description' => __('Your own custom logo.', 'ultra')
	) );

	$settings->add_teaser('header', 'image_retina', 'media', __('Retina Logo', 'ultra'), array(
		'choose' => __('Choose Image', 'ultra'),
		'update' => __('Set Logo', 'ultra'),
		'description' => __('A double sized version of your logo for use on high pixel density displays. Must be used in addition to standard logo.', 'ultra'),
	) );

	$settings->add_field('header', 'tagline', 'checkbox', __('Tagline', 'ultra'), array(
		'description' => __('Display the website tagline.', 'ultra')
	) );	

	$settings->add_field('header', 'top_bar', 'checkbox', __('Top Bar', 'ultra'), array(
		'description' => __('Display the top bar.', 'ultra')
	) );

	$settings->add_field('header', 'display', 'checkbox', __('Header', 'ultra'), array(
		'description' => __('Display the header.', 'ultra')
	) );		

	$settings->add_field('header', 'sticky', 'checkbox', __('Sticky Header', 'ultra'), array(
		'description' => __('Sticks the header to the top of the screen as the user scrolls down.', 'ultra')
	) );

	$settings->add_field('header', 'sticky_mobile', 'checkbox', __('Mobile Sticky Header', 'ultra'), array(
		'description' => __('Use the sticky header on mobile devices.', 'ultra')
	) );		

	$settings->add_field('header', 'opacity', 'text', __('Sticky Header Opacity', 'ultra'), array(
		'description' => __('Set the header background opacity once it turns sticky. 0.1 (lowest) - 1 (highest).', 'ultra')		
	) );		

	$settings->add_field('header', 'scale', 'checkbox', __('Sticky Header Scaling', 'ultra'), array(
		'description' => __('Scale the header down as it becomes sticky.', 'ultra')			
	) );		

	// Navigation.
	$settings->add_field('navigation', 'top_bar_menu', 'checkbox', __('Top Bar Menu', 'ultra'), array(
		'description' => __('Display the right top bar menu.', 'ultra')
	) );

	$settings->add_field('navigation', 'responsive_top_bar', 'checkbox', __('Responsive Top Bar', 'ultra'), array(
		'description' => __('Collapse the top bar for small screen devices.', 'ultra')
	) );	

	$settings->add_field('navigation', 'primary_menu', 'checkbox', __('Primary Menu', 'ultra'), array(
		'description' => __('Display the primary menu.', 'ultra')
	) );	

	$settings->add_field('navigation', 'responsive_menu', 'checkbox', __('Responsive Menu', 'ultra'), array(
		'description' => __('Use a special responsive menu for small screen devices. Requires the Primary Menu setting to be enabled.', 'ultra')
	) );		

	$settings->add_field('navigation', 'responsive_menu_collapse', 'number', __('Responsive Menu Collapse', 'ultra'), array(
		'description' => __('The pixel resolution when the primary menu and top bar collapse.', 'ultra')
	) );

	$settings->add_field('navigation', 'menu_search', 'checkbox', __('Menu Search', 'ultra'), array(
		'description' => __('Display a search icon in the main menu.', 'ultra')
	) );

	$settings->add_field('navigation', 'smooth_scroll', 'checkbox', __('Smooth Scroll', 'ultra'), array(
		'description' => __('Smooth scroll for internal anchor links from the main menu.', 'ultra')
	) );	

	$settings->add_field('navigation', 'breadcrumb_trail', 'checkbox', __('Breadcrumb Trail', 'ultra'), array(
		'description' => __('Display a breadcrumb trail below the menu. De-activate this setting if using Yoast Breadcrumbs or Breadcrumb NavXT.', 'ultra')
	) );		

	$settings->add_field('navigation', 'post_nav', 'checkbox', __('Post Navigation', 'ultra'), array(
		'description' => __('Display next/previous post navigation.', 'ultra')
	) );		

	$settings->add_field('navigation', 'scroll_top', 'checkbox', __('Scroll to Top', 'ultra'), array(
		'description' => __('Display the scroll to top button.', 'ultra')
	) );

	$settings->add_field('navigation', 'scroll_top_mobile', 'checkbox', __('Mobile Scroll to Top', 'ultra'), array(
		'description' => __('Display the scroll to top button on mobile devices.', 'ultra')
	) );					

	// Layout.
	$settings->add_field('layout', 'bound', 'select', __('Layout Bound', 'ultra'), array(
		'options' => array(
			'full' => __('Full Width', 'ultra'),
			'boxed' => __('Boxed', 'ultra'),
		),
		'description' => __('Select a full width or boxed theme layout.', 'ultra')
	) );

	$settings->add_field( 'layout', 'responsive', 'checkbox', __('Responsive Layout', 'ultra'), array(
		'description' => __('Adapt the site layout for mobile devices.', 'ultra')
	) );	

	$settings->add_field( 'layout', 'fitvids', 'checkbox', __('FitVids.js', 'ultra'), array(
		'description' => __('Include FitVids.js for fluid width video embeds.', 'ultra')
	));			

	// Home.
	$settings->add_field('home', 'slider', 'select', __('Home Slider', 'ultra'), array(
		'options' => siteorigin_metaslider_get_options(true),
		'description' => sprintf(
			__('This theme supports <a href="%s" target="_blank">Meta Slider</a>. <a href="%s">Install it</a> for free to easily build beautiful responsive sliders - <a href="%s" target="_blank">read more</a>.', 'ultra'),
			'https://getdpd.com/cart/hoplink/15318?referrer=1ag7po4k2uas40wowgw',
			siteorigin_metaslider_install_link(),
			'http://purothemes.com/documentation/ultra-theme/meta-slider/'
		)
	));	

	$settings->add_field('home', 'slider_stretch', 'checkbox', __('Stretch Slider', 'ultra'), array(
		'label' => __('Stretch Slider', 'ultra'),
		'description' => __('Stretch the home page slider to full screen width.', 'ultra'),
	) );

	$settings->add_field( 'home', 'header_overlaps', 'checkbox', __('Header Overlaps Slider', 'ultra'), array(
		'description' => __('Should the header overlap the home page slider?', 'ultra')
	) );	

	// Pages.
	$settings->add_field( 'pages', 'featured_image', 'checkbox', __('Featured Image', 'ultra'), array(
		'description' => __('Display the featured image on pages.', 'ultra')
	) );

	// Blog.
	$settings->add_field('blog', 'page_title', 'text', __('Blog Page Title', 'ultra'), array(
		'description' => __('The page title of the blog page.', 'ultra')
	) );

	$settings->add_field('blog', 'archive_layout', 'select', __('Blog Archive Layout', 'ultra'), array(
		'options' => ultra_blog_layout_options(),
		'description' => __('Choose the layout to be used on blog and archive pages.', 'ultra')
	) );

	$settings->add_field('blog', 'archive_featured_image', 'checkbox', __('Archive Featured Image', 'ultra'), array(
		'description' => __('Display the featured image on the blog archive pages.', 'ultra')
	) );	

	$settings->add_field('blog', 'archive_content', 'select', __('Archive Post Content', 'ultra'), array(
		'options' => array(
			'full' => __('Full Post Content', 'ultra'),
			'excerpt' => __('Post Excerpt', 'ultra'),
		),
		'description' => __('Choose how to display your post content on blog and archive pages. Select Full Post Content if using the "more" quicktag.', 'ultra'),	
	));			

	$settings->add_field('blog', 'read_more', 'text', __('Read More Text', 'ultra'), array(
		'description' => __('The link text displayed when posts are split using the "more" quicktag.', 'ultra'),		
	));	

	$settings->add_field('blog', 'excerpt_length', 'number', __('Post Excerpt Length', 'ultra'), array(
		'description' => __('If no manual post excerpt is added one will be generated. How many words should it be?', 'ultra'),
		'sanitize_callback' => 'absint'	
	));

    $settings->add_field('blog', 'excerpt_more', 'checkbox', __('Post Excerpt Read More Link', 'ultra'), array(
        'description' => __('Display the Read More Text below the post excerpt. Only applicable if Post Excerpt has been selected from the Archive Post Content setting.', 'ultra'),
    ));    	

	$settings->add_field('blog', 'post_featured_image', 'checkbox', __('Post Featured Image', 'ultra'), array(
		'description' => __('Display the featured image on the single post page.', 'ultra')
	) );	

	$settings->add_field('blog', 'post_date', 'checkbox', __('Post Date', 'ultra'), array(
		'description' => __('Display the post date.', 'ultra')
	));			

	$settings->add_field('blog', 'post_author', 'checkbox', __('Post Author', 'ultra'), array(
		'description' => __('Display the post author.', 'ultra')
	));	

	$settings->add_field('blog', 'post_comment_count', 'checkbox', __('Post Comment Count', 'ultra'), array(
		'description' => __('Display the post comment count.', 'ultra')
	));		

	$settings->add_field('blog', 'post_cats', 'checkbox', __('Post Categories', 'ultra'), array(
		'description' => __('Display the post categories.', 'ultra')
	));		

	$settings->add_field('blog', 'post_tags', 'checkbox', __('Post Tags', 'ultra'), array(
		'description' => __('Display the post tags.', 'ultra')
	));

	$settings->add_field('blog', 'post_author_box', 'checkbox', __('Post Author Box', 'ultra'), array(
		'description' => __('Display the post author biographical info.', 'ultra')
	));			

	$settings->add_field( 'blog', 'edit_link', 'checkbox', __( 'Edit Link', 'ultra' ), array(
		'description' => __( 'Display an Edit link below post content. Visible if a user is logged in and allowed to edit the content. Also applies to Pages.', 'ultra' )
	) );

	// Comments.
	$settings->add_field('comments', 'allowed_tags', 'checkbox', __('Comment Form Allowed Tags', 'ultra'), array(
		'description' => __('Display the explanatory text below the comment form that lets users know which HTML tags may be used.', 'ultra')
	) );	

	$settings->add_teaser('comments', 'ajax_comments', 'checkbox', __('AJAX Comments', 'ultra'), array(
		'description' => __('Allow users to submit comments without a page re-load on submit.', 'ultra'),
	));	 	

	// Social.
	$settings->add_teaser('social', 'share_post', 'checkbox', __('Post Sharing', 'ultra'), array(
		'description' => __('Show icons to share your posts on Facebook, Twitter, Google+ and LinkedIn.', 'ultra'),
	));	

	// Footer.
	$settings->add_field( 'footer', 'copyright_text', 'text', __( 'Copyright Text', 'ultra' ), array(
		'description' => __( '{site-title}, {copyright} and {year} can be used to display your website title, a copyright symbol and the current year.', 'ultra' ),
		'sanitize_callback' => 'wp_kses_post'
	) );

	$settings->add_field('footer', 'js_enqueue', 'checkbox', __('Enqueue JavaScript in Footer', 'ultra'), array(
		'description' => __('Enqueue theme JavaScript files in the footer. Doing so can improve site load time.', 'ultra'),
	));		

	$settings->add_teaser('footer', 'attribution', 'checkbox', __('Footer Attribution Link', 'ultra'), array(
		'description' => __('Remove the theme attribution link from your footer without editing any code.', 'ultra'),
	));			

	// Site Text.
	$settings->add_field( 'text', 'phone', 'text', __( 'Phone Number', 'ultra' ), array(
		'description' => __( 'A phone number displayed in the top bar. Use international dialing format to enable click to call.', 'ultra' )
	) );	

	$settings->add_field( 'text', 'email', 'text', __( 'Email Address', 'ultra' ), array(
		'description' => __( 'An email address to be displayed in the top bar', 'ultra' )
	) );				

	$settings->add_field( 'text', 'comments_closed', 'text', __( 'Comments Closed', 'ultra' ), array(
		'description' => __( 'The text visitors see at the bottom of posts when comments are closed.', 'ultra' )
	) );

	$settings->add_field( 'text', 'no_results_heading', 'text', __( 'No Search Results Heading', 'ultra' ), array(
		'description' => __( 'The search page heading visitors see when no results are found.', 'ultra' )
	) );		

	$settings->add_field( 'text', 'no_results_copy', 'text', __( 'No Search Results Text', 'ultra' ), array(
		'description' => __( 'The search page text visitors see when no results are found.', 'ultra' )
	) );	

	$settings->add_field( 'text', '404_heading', 'text', __( '404 Error Page Heading', 'ultra' ), array(
		'description' => __( 'The heading visitors see when no page is found.', 'ultra' )
	) );		

	$settings->add_field( 'text', '404_copy', 'text', __( '404 Error Page Text', 'ultra' ), array(
		'description' => __( 'The text visitors see no page is found.', 'ultra' )
	) );			
}
add_action('siteorigin_settings_init', 'ultra_theme_settings');

/**
 * Add default settings.
 *
 * @param $defaults
 *
 * @return mixed
 */
function ultra_settings_defaults( $defaults ){
	$defaults['header_logo'] = false;
	$defaults['header_image_retina'] = false;
	$defaults['header_tagline'] = false;
	$defaults['header_top_bar'] = true;
	$defaults['header_display'] = true;
	$defaults['header_sticky'] = true;
	$defaults['header_sticky_mobile'] = false;
	$defaults['header_opacity'] = 1;
	$defaults['header_scale'] = true;

	$defaults['navigation_top_bar_menu'] = true;
	$defaults['navigation_responsive_top_bar'] = false;
	$defaults['navigation_primary_menu'] = true;
	$defaults['navigation_responsive_menu'] = true;
	$defaults['navigation_responsive_menu_collapse'] = 1024;
	$defaults['navigation_menu_search'] = true;
	$defaults['navigation_smooth_scroll'] = true;
	$defaults['navigation_breadcrumb_trail'] = false;
	$defaults['navigation_post_nav'] = true;
	$defaults['navigation_scroll_top'] = true;
	$defaults['navigation_scroll_top_mobile'] = false;

	$defaults['layout_bound'] = 'full';
	$defaults['layout_responsive'] = true;
	$defaults['layout_fitvids'] = true;		

	$defaults['home_slider'] = 'demo';
	$defaults['home_slider_stretch'] = true;
	$defaults['home_header_overlaps'] = false;

	$defaults['pages_featured_image'] = true;

	$defaults['blog_page_title'] = __('Blog', 'ultra');
	$defaults['blog_archive_layout'] = 'blog';
	$defaults['blog_archive_featured_image'] = true;
	$defaults['blog_archive_content'] = 'full';
	$defaults['blog_read_more'] = __('Continue reading', 'ultra');
	$defaults['blog_excerpt_length'] = 55;
	$defaults['blog_excerpt_more'] = false;
	$defaults['blog_post_featured_image'] = true;
	$defaults['blog_post_date'] = true;
	$defaults['blog_post_author'] = true;
	$defaults['blog_post_comment_count'] = true;
	$defaults['blog_post_cats'] = true;
	$defaults['blog_post_tags'] = true;
	$defaults['blog_post_author_box'] = false;					
	$defaults['blog_edit_link'] = true;	

	$defaults['comments_allowed_tags'] = true;
	$defaults['comments_ajax_comments'] = true;

	$defaults['social_share_post'] = true;
	$defaults['social_share_page'] = false;
	$defaults['social_twitter'] = '';			

	$defaults['footer_copyright_text'] = __('{copyright} {year} {site-title}', 'ultra');
	$defaults['footer_attribution'] = true;
	$defaults['footer_js_enqueue'] = false;

	$defaults['text_phone'] = __('1800-345-6789', 'ultra');
	$defaults['text_email'] = __('info@yourdomain.com', 'ultra');
	$defaults['text_comments_closed'] = __('Comments are closed.', 'ultra');
	$defaults['text_no_results_heading'] = __('Nothing Found', 'ultra');
	$defaults['text_no_results_copy'] = __('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ultra');	
	$defaults['text_404_heading'] = __('Oops! That page can\'t be found.', 'ultra');
	$defaults['text_404_copy'] = __('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ultra');	

	return $defaults;
}
add_filter('siteorigin_settings_defaults', 'ultra_settings_defaults');

function ultra_blog_layout_options() {
	$layouts = array();
	foreach ( glob( get_template_directory().'/loops/loop-*.php') as $template ) {
		$headers = get_file_data( $template, array(
			'loop_name' => 'Loop Name',
		) );

		preg_match( '/loop\-(.*?)\.php/', basename( $template ), $matches );
		if ( ! empty( $matches[1] ) ) {
			$layouts[$matches[1]] = $headers['loop_name'];
		}
	}
	return $layouts;
}

function ultra_siteorigin_settings_home_slider_update_post_meta( $new_value, $old_value ) {

	// Update home slider post meta.
	$home_id = get_option( 'page_on_front' );
	if ( $home_id ) {
		update_post_meta( $home_id, 'ultra_metaslider_slider', siteorigin_setting( 'home_slider' ) );
 		update_post_meta( $home_id, 'ultra_metaslider_slider_stretch', siteorigin_setting( 'home_slider_stretch' ) );		
 		update_post_meta( $home_id, 'ultra_metaslider_slider_overlap', siteorigin_setting( 'home_header_overlaps' ) );			
	}
	return $new_value;
}
add_filter( 'update_option_theme_mods_ultra', 'ultra_siteorigin_settings_home_slider_update_post_meta', 10, 2 );

/**
 * Localize the theme settings.
 */
function ultra_siteorigin_settings_localize( $loc ){
	$loc = array(
		'section_title' 			=> esc_html__( 'Theme Settings', 'ultra' ),
		'section_description' 		=> esc_html__( 'Settings for your theme.', 'ultra' ),
		'premium_only'				=> esc_html__( 'Premium Only', 'ultra' ),
		'premium_url' 				=> '#',
		// For the settings metabox.
		'meta_box'            		=> esc_html__( 'Page Settings', 'ultra' ),
		// For archives section
		'page_section_title' 		=> esc_html__( 'Page Template Settings', 'ultra' ),
		'page_section_description' 	=> esc_html__( 'Change layouts for various pages on your site.', 'ultra' ),
		// For all the different temples and template types
		'template_home' 			=> esc_html__( 'Blog Page', 'ultra' ),
		'template_search' 			=> esc_html__( 'Search Results', 'ultra' ),
		'template_date' 			=> esc_html__( 'Date Archives', 'ultra' ),
		'template_404' 				=> esc_html__( 'Not Found', 'ultra' ),
		'template_author' 			=> esc_html__( 'Author Archives', 'ultra' ),
		'templates_post_type' 		=> esc_html__( 'Type', 'ultra' ),
		'templates_taxonomy' 		=> esc_html__( 'Taxonomy', 'ultra' ),
	);
	return $loc;
}
add_filter( 'siteorigin_settings_localization', 'ultra_siteorigin_settings_localize' );

/**
 * Setup Page Settings for Ultra.
 */
function ultra_page_settings( $settings, $type, $id ){

	$settings['layout'] = array(
		'type'    => 'select',
		'label'   => esc_html__( 'Page Layout', 'ultra' ),
		'options' => array(
			'default'            => esc_html__( 'Default', 'ultra' ),
			'no-sidebar'         => esc_html__( 'No Sidebar', 'ultra' ),
			'full-width'         => esc_html__( 'Full Width', 'ultra' ),
			'full-width-sidebar' => esc_html__( 'Full Width, With Sidebar', 'ultra' ),
		),
	);

	$settings['display_top_bar'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Top Bar', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the top bar. Global setting must be enabled.', 'ultra' )
	);		

	$settings['display_header'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Header', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the header. Global setting must be enabled.', 'ultra' )
	);	

	$settings['header_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Header Bottom Margin', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the margin below the header.', 'ultra' )
	);	

	$settings['page_title'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Page Title', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the page title.', 'ultra' )
	);

	$settings['footer_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Top Margin', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the margin above the footer.', 'ultra' )
	);

	$settings['display_footer_widgets'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Widgets', 'ultra' ),
		'checkbox_label' => esc_html__( 'Enable', 'ultra' ),
		'description'    => esc_html__( 'Display the footer widgets.', 'ultra' )
	);

	return $settings;
}
add_filter( 'siteorigin_page_settings', 'ultra_page_settings', 10, 3 );

/**
 * Add the default Page Settings.
 */
function ultra_setup_page_setting_defaults( $defaults, $type, $id ) {
	$defaults['layout']              	= 'default';
	$defaults['display_top_bar']   		= true;
	$defaults['display_header']      	= true;
	$defaults['header_margin']     		= true;
	$defaults['page_title']          	= true;
	$defaults['display_footer_widgets'] = true;
	$defaults['footer_margin']       	= true;

	return $defaults;
}
add_filter( 'siteorigin_page_settings_defaults', 'ultra_setup_page_setting_defaults', 10, 3 );

function ultra_page_settings_message( $post ){
	if( $post->post_type == 'page' ) {
		?>
		<div class="so-page-settings-message" style="background-color: #f3f3f3; padding: 10px; margin-top: 12px; border: 1px solid #d0d0d0">
			<?php _e( 'To use these page settings, please use the <strong>Default</strong> template selected under <strong>Page Attributes</strong>.', 'ultra' ) ?>
		</div>
		<?php
	}
}
add_action( 'siteorigin_settings_before_page_settings_meta_box', 'ultra_page_settings_message' );