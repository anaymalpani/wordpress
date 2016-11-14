<?php
#-----------------------------------------------------------------
# Columns
#-----------------------------------------------------------------

$themeum_shortcodes = array();



//Basic
$themeum_shortcodes['header_1'] = array( 
    'type'=>'heading', 
    'title'=>__('Basic', 'themeum')
    );



//container
$themeum_shortcodes['themeum_container'] = array( 
    'type'=>'simple', 
    'title'=>__('Container', 'themeum')
    );


$themeum_shortcodes['themeum_divider'] = array( 
    'type'=>'radios', 
    'title'=>__('Divider', 'themeum'), 
    'attr'=>array(
        'size'=>array(
            'type'=>'select', 
            'title'=> __('Divider Size', 'themeum'), 
            'values'=>array(
                'divider-default'   =>'Default',
                'divider-lg'        =>'Large',
                'divider-md'        =>'Medium',
                'divider-sm'        =>'Small',
                'divider-xs'        =>'Extra Small',
                )
            ),
        ) 

    );

$cols = array('1' => 'Column one','1/2' => 'Column 1/2', '1/3' => 'Column 1/3', '1/4' => 'Column 1/4', '2/3' => 'Column 2/3', '3/4' => 'Column 3/4');

// columns
$themeum_shortcodes['themeum_column'] = array( 
    'type'=>'text', 
    'title'=>__('Column', 'themeum' ), 
    'attr'=>array(
         'col'=>array(
            'type'=>'select', 
            'title'=> __('Column Type: ', 'themeum'),
            'values'=>$cols
        )
    )

    );


//Elements
$themeum_shortcodes['header_3'] = array( 
    'type'=>'heading', 
    'title'=>__('Elements', 'themeum')
);


//Button
$themeum_shortcodes['themeum_button'] = array( 
    'type'=>'radios', 
    'title'=>__('Button', 'themeum'), 
    'attr'=>array(

        'size'=>array(
            'type'=>'select', 
            'title'=> __('Button Size', 'themeum'), 
            'values'=>array(
                ''     =>'Default',
                'lg'   =>'Large',
                'sm'   =>'Medium',
                'xs'   =>'Small',
                )
            ),

        'type'=>array(
            'type'=>'select', 
            'title'=> __('Button Type', 'themeum'), 
            'values'=>array(
                'default'=>'Default',
                'primary'=>'Primary',
                'success'=>'Success',
                'info'  =>'Info',
                'warning'=>'Warning',
                'danger'=>'Danger',
                'link'=>'Link',
                )
            ),

        'url'=>array(
            'type'=>'text', 
            'title'=>__('Link URL', 'themeum')
            ),
        'text'=>array(
            'type'=>'text', 
            'title'=>__('Text', 'themeum')
            ),
        ) 

    );

// alert
$themeum_shortcodes['themeum_alert'] = array( 
    'type'=>'simple', 
    'title'=>__('Alert', 'themeum' ),
    'attr'=>array(
        'close'=>array(
            'type'=>'select', 
            'title'=> __('Show Close Button', 'themeum'), 
            'values'=>  array( 'no'=>'No', 'yes'=>'Yes' )
            ),  
        'type'=>array(
            'type'=>'select', 
            'title'=> __('Alert Type', 'themeum'), 
            'values'=>  array( 'none'=>'None', 'success'=>'Success', 'info'=>'Info', 'warning'=>'Warning', 'danger'=>'Danger' )
            ),  
        'title'=>array(
            'type'=>'text', 
            'title'=> __('Alert Title', 'themeum')
            ),
        ) 

    );

// progressbar
$themeum_shortcodes['themeum_progressbar'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Progress Bars', 'themeum' ), 
    'attr'=>array(
        'progressbar'=>array('type'=>'custom')
        )
    );

$themeum_shortcodes['themeum_tabs'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Tabs', 'themeum' ), 
    'attr'=>array(
        'tabs'=>array('type'=>'custom')
        )
    );

$themeum_shortcodes['themeum_accordion'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Accordion', 'themeum' ), 
    'attr'=>array(
        'accordion'=>array('type'=>'custom')
        )
    );

//Elements
$themeum_shortcodes['header_4'] = array( 
    'type'=>'heading', 
    'title'=>__('Content', 'themeum')
);

// Service Shortcode

$themeum_shortcodes['service'] = array( 
    'type'=>'simple', 
    'title'=>__('Service', 'themeum'), 
    'attr'=>array(

        'title'=>array(
            'type'=>'text', 
            'title'=>__('Title', 'themeum')
            ),
        'img'=>array(
            'type'=>'text', 
            'title'=>__('Image Url', 'themeum')
            ),
        ) 

    );

// Blog

$themeum_shortcodes['blog'] = array( 
    'type'=>'radios', 
    'title'=>__('Blog', 'themeum'), 
    'attr'=>array(

        'number_post'=>array(
                'type'=>'text', 
                'title'=>__('Number Of Post Shown', 'themeum')
                ),
        ) 

    );


$themeum_shortcodes['parallax'] = array( 
    'type'=>'simple', 
    'title'=>__('Parallax', 'themeum'), 

);

$themeum_shortcodes['fade_slider'] = array( 
    'type'=>'simple', 
    'title'=>__('Fade Slider', 'themeum'),

);

$themeum_shortcodes['contact_holder'] = array( 
    'type'=>'simple', 
    'title'=>__('Contact Form Section', 'themeum'),

);

$themeum_shortcodes['map'] = array( 
    'type'=>'simple', 
    'title'=>__('Google Map', 'themeum'),

);

$themeum_shortcodes['social'] = array( 
    'type'=>'simple', 
    'title'=>__('Social Icon', 'themeum'),

);

$themeum_shortcodes['testimonial'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Testimonial', 'themeum' ), 
    'attr'=>array(
        'testimonial'=>array('type'=>'custom')
        )
    );

$themeum_shortcodes['themeum_project'] = array( 
    'type'=>'radios', 
    'title'=>__('Portfolio', 'themeum'),
    );

$themeum_shortcodes['themeum_slider'] = array( 
    'type'=>'radios', 
    'title'=>__('Themeum Slider', 'themeum'),
    );

$themeum_shortcodes['enter_team'] = array( 
    'type'=>'radios', 
    'title'=>__('Team Member', 'themeum'),
    'attr'=>array(
        'per_page'=>array(
            'type'=>'text', 
            'title'=>__('Number of Member', 'themeum')
            ),

        'hide_nav'=>array(
            'type'=>'select', 
            'title'=> __('Disable Nav', 'themeum'), 
            'values'=>array(
                'no'     =>'no',
                'yes'   =>'Yes'
                )
            ),
        )
    
    );

//Elements
$themeum_shortcodes['header_5'] = array( 
    'type'=>'heading', 
    'title'=>__('Pricing', 'themeum')
);

$themeum_shortcodes['pricing'] = array( 
    'type'=>'simple', 
    'title'=>__('Pricing Column', 'themeum'),
    'attr'=>array(
        'col'=>array(
            'type'=>'select', 
            'title'=> __('Pricing Column Style', 'themeum'), 
            'values'=>array(
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
            )
        ),
        'name'      =>array(
            'type'      =>'text', 
            'title'     =>__('Plan Name', 'themeum')
        ),
        'subtitle'  =>array(
            'type'      =>'text', 
            'title'     =>__('Plan Subhead', 'themeum')
        ),
        'price'     =>array(
            'type'      =>'text', 
            'title'     =>__('Plan Price', 'themeum')
        ),
        'duration'  =>array(
            'type'      =>'text', 
            'title'     =>__('Plan Duration', 'themeum')
        ),
        'link'      =>array(
            'type'      =>'text', 
            'title'     =>__('Plan Button Link', 'themeum')
        ),
        'btn_text'      =>array(
            'type'      =>'text', 
            'title'     =>__('Plan Button Text', 'themeum')
        ),
    )
);

// pricing item
$themeum_shortcodes['pricing_item'] = array( 
    'type'=>'simple', 
    'title'=>__('Pricing Content', 'themeum'),
    'attr'=>array(
        'icon'      =>array(
            'type'      =>'text', 
            'title'     =>__('Icon Name (font awesome)', 'themeum')
        ),
        'icon_content'  =>array(
            'type'      =>'text', 
            'title'     =>__('Price Icon Content', 'themeum')
        ),
    )
);

$themeum_shortcodes['header_6'] = array( 
    'type'=>'heading', 
    'title'=>__('Text Slider', 'themeum')
);

$themeum_shortcodes['text_slider'] = array( 
    'type'=>'simple', 
    'title'=>__('Slider Wrap', 'themeum'),
    'attr'=>array(
        'img'      =>array(
            'type'      =>'text', 
            'title'     =>__('Background Image url', 'themeum')
        ),
        'video_mp4' =>array(
            'type'      =>'text', 
            'title'     =>__('MP4 Video url', 'themeum')
        ),
        'video_webm' =>array(
            'type'      =>'text', 
            'title'     =>__('webm Video url', 'themeum')
        ),
        'subtitle' =>array(
            'type'      =>'text', 
            'title'     =>__('Subtitle', 'themeum')
        ),
        'btn_link' =>array(
            'type'      =>'text', 
            'title'     =>__('Button Link', 'themeum')
        ),
        'btn_txt' =>array(
            'type'      =>'text', 
            'title'     =>__('Button Text', 'themeum')
        ),
    )
);

$themeum_shortcodes['tx_slide'] = array( 
    'type'=>'simple', 
    'title'=>__('Slide Content', 'themeum'),
);

