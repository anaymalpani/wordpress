<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'thm_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function thm_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'thm_';

		// 1st meta box
	$meta_boxes[] = array(
		'id' 		=> 'post-meta-quote',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Post Quote Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(
			array(
				// Field name - Will be used as label
				'name'  	=> __( 'Qoute Text', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    	=> "{$prefix}qoute",
				'desc'  	=> __( 'Write Your Qoute Here', 'themeum' ),
				'type'  	=> 'textarea',
				// Default value (optional)
				'std'   	=> ''
			),
			array(
				'name'  	=> __( 'Qoute Author', 'themeum' ),
				'id'    	=> "{$prefix}qoute_author",
				'desc'  	=> __( 'Write Qoute Author or Source', 'themeum' ),
				'type'  	=> 'text',
				'std'   	=> ''
			)
		)
	);

	$meta_boxes[] = array(
		'id' 		=> 'post-meta-chat',
		'title' 	=> __( 'Post Chat Settings', 'themeum' ),
		'pages' 	=> array( 'post'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,
		'fields' 	=> array(
			array(
				'name'  	=> __( 'Chat Message', 'themeum' ),
				'id'    	=> "{$prefix}chat_text",
				'type' 		=> 'wysiwyg',
				'raw'  		=> false,
				'options' 	=> array(
					'textarea_rows' 	=> 4,
					'teeny'         	=> false,
					'media_buttons' 	=> false,
				)
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' 		=> 'post-meta-link',
		'title' 	=> __( 'Post Link Settings', 'themeum' ),
		'pages' 	=> array( 'post'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,
		'fields' 	=> array(
			array(
				'name'  	=> __( 'Link URL', 'themeum' ),
				'id'    	=> "{$prefix}link",
				'desc'  	=> __( 'Write Your Link', 'themeum' ),
				'type'  	=> 'text',
				'std'   	=> ''
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' 		=> 'post-meta-audio',
		'title' 	=> __( 'Post Audio Settings', 'themeum' ),
		'pages' 	=> array( 'post'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,
		'fields' 	=> array(
			array(
				'name'  	=> __( 'Audio Embed Code', 'themeum' ),
				'id'    	=> "{$prefix}audio_code",
				'desc'  	=> __( 'Write Your Audio Embed Code Here', 'themeum' ),
				'type'  	=> 'textarea',
				'std'   	=> ''
			)
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-status',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Status Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Status URL', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}status_url",
				'desc'  => __( 'Write Facebook, Twitter etc status link', 'themeum' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-video',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Video Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Video Embed Code/ID', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}video",
				'desc'  => __( 'Write Your Vedio Embed Code/ID Here', 'themeum' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				'name'     => __( 'Select Vedio Type/Source', 'themeum' ),
				'id'       => "{$prefix}video_source",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'1' => __( 'Embed Code', 'themeum' ),
					'2' => __( 'YouTube', 'themeum' ),
					'3' => __( 'Vimeo', 'themeum' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '1'
			),
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-gallery',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Gallery Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				'name'             => __( 'Gallery Image Upload', 'themeum' ),
				'id'               => "{$prefix}gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 5,
			)			
		)
	);


	$meta_boxes[] = array(
		'id' => 'page-meta-settings',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Page Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'page'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Alternative Title', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}page_title",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Subtitle', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}page_subtitle",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Disable Title', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}no_title",
				'type'  => 'checkbox',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Open in New Pape', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}no_hash",
				'type'  => 'checkbox',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Disable From Menu', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}disable_menu",
				'type'  => 'checkbox',
				// Default value (optional)
				'std'   => ''
			),
			array(
				'name'     => __( 'Page Section Type', 'themeum' ),
				'id'       => "{$prefix}section_type",
				'type'     => 'select_advanced',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'default' 	=> __( 'Default', 'themeum' ),
					'full' 		=> __( 'Full-Width', 'themeum' ),
					'parallax' 	=> __( 'Parallax', 'themeum' )
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'default'
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Remove Section\'s Padding', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}remove_pad",
				'type'  => 'checkbox',
				// Default value (optional)
				'std'   => ''
			),
			array(
				'name'     => __( 'Background Type', 'themeum' ),
				'id'       => "{$prefix}bg_type",
				'type'     => 'select_advanced',
				'options'  => array(
								0 		=> __( 'None', 'themeum' ),
								1 		=> __( 'Image', 'themeum' ),
								2 		=> __( 'Video', 'themeum' ),
								3 		=> __( 'Self Hosted Video', 'themeum' )
				),
				'multiple'    => false,
				'std'         => 0
			),
			array(
				'name'    => __( 'Background Url', 'themeum' ),
				'id'      => "{$prefix}background_url",
				'type'    => 'text'
			)
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'project-meta-setting',
		'title' => __( 'project Infomation', 'themeum' ),
		'pages' => array( 'project'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => __( 'Subtitle', 'themeum' ),
				'id'    => "{$prefix}project_subtitle",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => __( 'Client Name', 'themeum' ),
				'id'    => "{$prefix}project_client",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => __( 'Project Url', 'themeum' ),
				'id'    => "{$prefix}project_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => __( 'Project Date', 'themeum' ),
				'id'    => "{$prefix}project_date",
				'type'  => 'date',			
			),
			array(
				'name'  => __( 'Project Testimonial', 'themeum' ),
				'id'    => "{$prefix}project_feedback",
				'type'  => 'textarea',			
			)
		)
	);

	$meta_boxes[] = array(
		'id' => 'slider-meta-setting',
		'title' => __( 'Additional Infomation', 'themeum' ),
		'pages' => array( 'slider'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => __( 'Title Animation', 'themeum' ),
				'id'    => "{$prefix}title_anim",
				'type'  => 'text',
				'type'  => 'select_advanced',
				'options'  => array(
						'bounceInRight' 	=> __( 'bounceInRight', 'themeum' ),
						'bounceInLeft' 		=> __( 'bounceInLeft', 'themeum' ),
						'bounceInUp' 		=> __( 'bounceInUp', 'themeum' ),
						'bounceInDown' 		=> __( 'bounceInDown', 'themeum' ),
						'fadeIn' 			=> __( 'fadeIn', 'fadeIn' ),
				),
				'multiple'    => false,
				'placeholder' => __( 'Select an Animation', 'themeum' ),
			),
			array(
				'name'  => __( 'Subtitle', 'themeum' ),
				'id'    => "{$prefix}subtitle",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => __( 'Subtitle Animation', 'themeum' ),
				'id'    => "{$prefix}subtitle_anim",
				'type'  => 'text',
				'type'  => 'select_advanced',
				'options'  => array(
						'bounceInRight' 	=> __( 'bounceInRight', 'themeum' ),
						'bounceInLeft' 		=> __( 'bounceInLeft', 'themeum' ),
						'bounceInUp' 		=> __( 'bounceInUp', 'themeum' ),
						'bounceInDown' 		=> __( 'bounceInDown', 'themeum' ),
						'fadeIn' 			=> __( 'fadeIn', 'fadeIn' ),
				),
				'multiple'    => false,
				'placeholder' => __( 'Select an Animation', 'themeum' ),
			),
			array(
				'name'  => __( 'Button Text', 'themeum' ),
				'id'    => "{$prefix}btn_text",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => __( 'Button Link', 'themeum' ),
				'id'    => "{$prefix}btn_link",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => __( 'Button Animation', 'themeum' ),
				'id'    => "{$prefix}btn_anim",
				'type'  => 'select_advanced',
				'options'  => array(
						'bounceInRight' 	=> __( 'bounceInRight', 'themeum' ),
						'bounceInLeft' 		=> __( 'bounceInLeft', 'themeum' ),
						'bounceInUp' 		=> __( 'bounceInUp', 'themeum' ),
						'bounceInDown' 		=> __( 'bounceInDown', 'themeum' ),
						'fadeIn' 			=> __( 'fadeIn', 'fadeIn' ),
				),
				'multiple'    => false,
				'placeholder' => __( 'Select an Animation', 'themeum' ),
			),
			array(
				'name'  => __( 'Background Video Link MP4', 'themeum' ),
				'id'    => "{$prefix}video_link_mp4",
				'type'  => 'text'
			),
			array(
				'name'  => __( 'Background Video Link webm', 'themeum' ),
				'id'    => "{$prefix}video_link_webm",
				'type'  => 'text'
			),
		)
	);

	//Team Metabox
	$meta_boxes[] = array(
		'id' => 'team-meta-setting',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Additional Infomation', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'team'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Designation', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}designation",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Facebook Url', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}facebook_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Twitter Url', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}twitter_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Google Plus Url', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}plusone_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Pinterest Url', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}pinterest_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Linkedin Url', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}linkedin_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Dribbble Url', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}dribbble_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Flickr Url', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}flickr_url",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)
		)
	);

	return $meta_boxes;
}