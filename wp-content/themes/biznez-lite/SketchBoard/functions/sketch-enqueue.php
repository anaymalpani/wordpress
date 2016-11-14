<?php

/************************************************
*
*  enquque css and javascript
*
************************************************/

//enqueue admin jquery 
function biznez_lite_backscript_enqueqe() {
	if(is_admin()){
		wp_enqueue_script('sketch-admin',get_template_directory_uri().'/SketchBoard/functions/js/sketch.admin.js',array('jquery'),'1.0.0',1);
		wp_enqueue_style('sketch-admin-style',get_template_directory_uri().'/SketchBoard/functions/css/sketch.admin.css');
	}
}
add_action('wp_enqueue_scripts', 'biznez_lite_backscript_enqueqe');


function biznez_lite_theme_stylesheet(){


	global $wp_version;

	$skt_version = NULL;
	$theme = wp_get_theme();
	$skt_version = $theme['Version'];

	wp_enqueue_script( 'comment-reply' );

	wp_enqueue_style( 'reset', get_template_directory_uri().'/css/reset.css', false, $skt_version );
	wp_enqueue_style( 'grid-stylesheet', get_template_directory_uri().'/css/1008.css', false, $skt_version );
	wp_enqueue_style( 'typography', get_template_directory_uri().'/css/typography.css', false, $skt_version  );
	wp_enqueue_style( 'biznez-style', get_stylesheet_uri(), false, $skt_version );
	wp_enqueue_script('orbitslider',get_template_directory_uri().'/js/jquery.orbit-1.3.0.js',array('jquery'),'1.0',true);
	wp_enqueue_script('ddsmoothmenusimple',get_template_directory_uri().'/js/ddsmoothmenu.js',array('jquery'),'1.0' );
	wp_enqueue_script('colorboxsimple',get_template_directory_uri() .'/js/jquery.prettyPhoto.js',array('jquery'),'1.0',true );
	// wp_enqueue_script('biznez_jcarousellite_slide',get_template_directory_uri().'/js/jquery.jcarousel.js',array('jquery'),'1.0',true );
	wp_enqueue_script('custom_slide',get_template_directory_uri().'/js/custom.js',array('jquery'),'1.0' );
	wp_enqueue_script('blackandwhite',get_template_directory_uri().'/js/jQuery.BlackAndWhite.js',array('jquery'),'1.0');
	wp_enqueue_script('kwiks_slide',get_template_directory_uri().'/js/kwiks.js',array('jquery'),'1.0',true);
	wp_enqueue_script('easing_slide',get_template_directory_uri().'/js/jquery.easing.1.3.js',array('jquery'),'1.0',true );
	wp_enqueue_script('tolltip-js', get_template_directory_uri() . '/js/jquery.tipTip.js', array('jquery'), '1.0', true);

	
	wp_enqueue_style( 'biznez-theme-stylesheet', get_template_directory_uri().'/SketchBoard/css/skt-theme-stylesheet.css', false, $skt_version );
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri().'/css/prettyPhoto.css', false, $skt_version );
	wp_enqueue_style( 'orbit-theme', get_template_directory_uri().'/css/orbit-1.3.0.css', false, $skt_version );
	wp_enqueue_style( 'portfolioStyle', get_template_directory_uri().'/css/portfolioStyle.css', false, $skt_version );
	wp_enqueue_style( 'google-Fonts-OpenSans','http://fonts.googleapis.com/css?family=Open+Sans:400,600,400italic' );
	wp_enqueue_style( 'google-Fonts-DroidSerif','http://fonts.googleapis.com/css?family=Droid+Serif' );
	wp_enqueue_style( 'biznez-tolltip-css', get_template_directory_uri().'/css/tipTip.css', false, $skt_version  );
	wp_enqueue_style( 'elusive-webfont-css', get_template_directory_uri().'/css/elusive-webfont.css', false, $skt_version );
	wp_enqueue_style( 'elusive-webfont-ie-css', get_template_directory_uri().'/css/elusive-webfont-ie7.css', false, $skt_version  );

}
add_action('wp_enqueue_scripts', 'biznez_lite_theme_stylesheet');

function biznez_lite_head_css(){
global $shortname;
	if(!is_admin())
	{
		require_once(get_template_directory().'/inc/biznez-custom-css.php');
	}   
}
add_action('wp_head', 'biznez_lite_head_css');

//enqueue footer script 
function biznez_lite_footer_script() {
	global $shortname;
	if(!is_admin())
	{
		require_once(get_template_directory().'/js/orbit-slider-config.php');
		require_once(get_template_directory().'/js/jquery-jcarousel-config.php');
	}    
}

add_action('wp_footer', 'biznez_lite_footer_script');