<?php
$cfgs = array(

    /* AUTHOR */
    'author'        => array(
        'name'              => 'myThem.es',
        'description'       => __( 'myThem.es Marketplace provides WordPress themes with the best quality and the smallest prices.' , 'materialize' ),
        'url'               => 'http://mythem.es/'
    ),

    /* THEMES */
    'theme'         => array(
        'type'              => 'free',
        'description'       => __( 'Materialize - Best WordPress Theme based on Material Design.' , 'materialize' ),
        //'premium'           => 'http://mythem.es/item/cannyon-premium-multipurpose-wordpress-theme/'
    ),

    /* LINKS */
    'links'         => array(
        'referrals'         => 'http://mythem.es/referrals/',
        'affiliates'        => 'http://mythem.es/affiliates/',
        'plugins'           => 'javascript:void(null);',
        'items'             => 'http://mythem.es/our-items/'
    ),

    'faqs'          => array(
        array(
            'title'     => __( 'Welcome Message !' , 'materialize' ),
            'content'   => 

                '<p>' . __( 'Thank you for choosing myThem.es and use one of our WordPress Themes your choice is greatly appreciated!' , 'materialize' ) . '</p>' .

                '<p>' . __( 'If you have any questions ask!' , 'materialize' ) . '</p>' .

                '<p>' . __( 'And please help us to increase the theme quality ( report bugs ).' , 'materialize' ) . '</p>' .

                '<p>' . __( 'Also please help us to increase the theme rank!' , 'materialize' ) . '</p>'
        ),
        array(
            'title'     => __( 'Default content from Sidebars: Footer, Blog, Single, Special Page' , 'materialize' ),
            'content'   => 

                '<p><big><strong>' . __( 'GENERAL ABOUT DEFAULT CONTENT' , 'materialize' ) . '</strong></big></p>' .

                '<p>' . __( 'The default content exists only in sidebars !' , 'materialize' ) . '</p>' .
                '<p>' . __( 'The default content is hardcoded in theme files. But you can:' , 'materialize' ) . '</p>' .
                '<p>' . __( '1. Disable all default content and fill with your content.', 'materialize' ) . '</p>' .
                '<p>' . __( '2. Replace only one section or more sections with your content.', 'materialize' ) . '</p>' .

                '<div id="mythemes-header-alert" class="mythemes-flat-alert success"><p>' .
                __( 'You can hide all default content if you go to <strong>Admin Dashboard &rsaquo; Appearance &rsaquo; Customize &rsaquo; Additional</strong> and disable option "Display default content".' , 'materialize' ) .
                '</p></div>' .

                '<p>' . __( '<strong>IMPORTANT</strong>: if the option "Display default content" is enabled and the Header Sidebars is empty then will be displayed the default content ( hardcoded ) from this sidebar.' , 'materialize' ) . '</p>' .
                '<p>' . __( 'So, just is need to get and put a text widget and fill the Text widget with you Title and with your Content.' , 'materialize' ) . '</p>' .
                '<p>' . __( '<strong>IMPORTANT</strong>: The widgets are placed in the left and the sidebars are placed in the right ( <strong>Appearance &rsaquo; Widgets</strong> ).' , 'materialize' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'FOOTER' , 'materialize' ) . '</strong></big></p>' .

                '<p>' . __( 'In the footer before the copyright section there are 3 components that are entitle:' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. Materialize' , 'materialize' ) . '</p>' .
                '<p>' . __( '2. ADDRESS' , 'materialize' ) . '</p>' .
                '<p>' . __( '3. CONTACT' , 'materialize' ) . '</p>' .
                '<p>' . __( '4. WORKING HOURS' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Here we have three sidebars with default content. These are "Header Front Page Sidebars". If you go to Admin Dashboard &rsaquo; Appearance &rsaquo; Widgets you can see sidebars:' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. Footer - First Sidebar ( is used the sample Text widget )' , 'materialize' ) . '</p>' .
                '<p>' . __( '2. Footer - Second Sidebar ( is used the sample Text widget )' , 'materialize' ) . '</p>' .
                '<p>' . __( '3. Footer - Third Sidebar ( is used the sample Text widget )' , 'materialize' ) . '</p>' .
                '<p>' . __( '4. Footer - Fourth Sidebar ( is used the sample Text widget )' , 'materialize' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'BLOG ( MAIN SIDEBAR )' , 'materialize' ) . '</strong></big></p>' .

                '<p>' . __( 'By default is used content from next widgets: "Search", "Tags Cloud" and "Categories".' , 'materialize' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'SINGLE POST ( SINGLE SIDEBAR )' , 'materialize' ) . '</strong></big></p>' .
                
                '<p>' . __( 'By default is used content from next widgets: "Post Meta [myThem.es]", "Post Categories [myThem.es]" and "Post Tags [myThem.es]".' , 'materialize' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'REPLACE CONTENT VS DISABLE DEFAULT CONTENT' , 'materialize' ) . '</strong></big></p>' .

                '<p>' . __( 'If you disable the default content then it will disable all default content from your web site ( sidebars with default content listed above ):' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '- Footer Sidebars' , 'materialize' ) . '</p>' .
                '<p>' . __( '- Main Blog Sidebar' , 'materialize' ) . '</p>' .
                '<p>' . __( '- Single Sidebar' , 'materialize' ) . '</p>' .
                '<p>' . __( '- ...' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Also you can replace the default content with your content. This will allow you to make one or more changes. You will not need to replace all default content.' , 'materialize' ) . '</p>' .

                '<p>' . __( 'To replace the default content you need to add a widget with your content in the sidebar with default content ( listed above). The default content will automatically change with your content (only for this sidebar).' , 'materialize' ) . '</p>'

        ),
        array(
            'title'     => __( 'Custom CSS and Customizations' , 'materialize' ),
            'content'   => 

                '<p>' . __( 'This theme comes with special option. This option allow add custom css to customize your web site to your needs.' , 'materialize' ) . '</p>' .

                '<p>' . __( 'To use it go to Admin Dashboard' , 'materialize' ) . '</p>' .

                '<p>' . __( 'Appearance &rsaquo; Customize &rsaquo; Others - option "Custom css".' , 'materialize' ) . '</p>' .

                '<p>' . __( 'You can use it for multiple case, just is need to add you css in this field.' , 'materialize' ) . '</p>'
        ),
        array(
            'title'     => __( 'Customize the Theme' , 'materialize' ),
            'content'   =>

                '<p>' . __( 'This theme comes with a set of options what allow you to customize content, header, layouts, social items and others.' , 'materialize' ) . '</p>' .

                '<p>' . __( 'You can see theme options if you go to Admin Dashboard' , 'materialize' ) . '</p>' .

                '<p>' . __( 'Appearance &rsaquo; Customize' , 'materialize' ) . '</p>' .

                '<p>' . __( 'Here you can see:' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '01. Site Identity' , 'materialize' ) . '</p>' .
                '<p>' . __( '02. Colors' , 'materialize' ) . '</p>' .
                '<p>' . __( '03. Background Image' , 'materialize' ) . '</p>' .
                '<p>' . __( '04. Header Image' , 'materialize' ) . '</p>' .
                '<p>' . __( '05. Header Elements' , 'materialize' ) . '</p>' .
                '<p>' . __( '06. Breadcrumbs' , 'materialize' ) . '</p>' .
                '<p>' . __( '07. Additional' , 'materialize' ) . '</p>' .
                '<p>' . __( '08. Layout' , 'materialize' ) . '</p>' .
                '<p>' . __( '09. Social' , 'materialize' ) . '</p>' .
                '<p>' . __( '10. Others' , 'materialize' ) . '</p>' .
                '<p>' . __( '11. Menu' , 'materialize' ) . '</p>' .
                '<p>' . __( '12. Widgets' , 'materialize' ) . '</p>' .
                '<p>' . __( '13. Static Front Page' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'All you have to do is play with them and view live changes.' , 'materialize' ) . '</p>' .

                '<p>' . __( 'Try and you will discover how easy it is to customize your own style.' , 'materialize' ) . '</p>'
        )

    )
);

mythemes_cfg::set( $cfgs );
?>