<?php
//	Registers the Widgets and Sidebars for the site

function biznez_lite_widgets_init() {
	register_sidebar(array(

		'name' => 'primary-widget-area',

		'id' => 'primary-widget-area',

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	));

	

	register_sidebar(array(

		'name' => 'secondary-widget-area',

		'id' => 'secondary-widget-area',

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	));

	

	register_sidebar(array(

		'name' => 'first-footer-widget-area',

		'id' => 'first-footer-widget-area',

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	));

	

	register_sidebar(array(

		'name' => 'second-footer-widget-area',

		'id' => 'second-footer-widget-area',

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	));

	register_sidebar(array(

		'name' => 'third-footer-widget-area',

		'id' => 'third-footer-widget-area',

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	));

	

	register_sidebar(array(

		'name' => 'fourth-footer-widget-area',

		'id' => 'fourth-footer-widget-area',

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	));
	
	register_sidebar(array(

		'name' => 'skt-woocommerce-widget-area',

		'id' => 'widget-area',

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	));

}
add_action( 'widgets_init', 'biznez_lite_widgets_init' );

/***************register nav menus*********************/
function biznez_lite_after_setup_theme() {

	/***** Make theme available for translation ****/
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain('biznez-lite', get_template_directory() . '/languages');
	// This theme allows users to set a custom header.
	add_theme_support( 'custom-header', array( 'flex-width' => true, 'width' => 1600, 'flex-height' => true, 'height' => 750, 'default-image' => get_template_directory_uri() . '/images/header.png') );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'connexions_lite_custom_background_args', array('default-color' => 'ffffff', ) ) );

	register_nav_menus( array(
		'Header' => __( 'Primary Navigation','biznez-lite'),
	));

	/**
	 * Add Customizer 
	 */
	require get_template_directory() . '/inc/customizer.php';
	
}

add_action( 'after_setup_theme', 'biznez_lite_after_setup_theme' );

/******* theme check fix ***********/
if ( ! isset( $content_width ) ){
    $content_width = 900;
}



/**
* Funtion to add CSS class to body
*/
function biznez_lite_add_class( $classes ) {

	if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_front_page() ) {
		$classes[] = 'front-page';
	}
	return $classes;
}
add_filter( 'body_class', 'biznez_lite_add_class' );

/*---------------------------------------------------------------------------*/
/* ADMIN SCRIPT: Enqueue scripts in back-end
/*---------------------------------------------------------------------------*/
if( !function_exists('biznez_lite_page_admin_enqueue_scripts') ){

    add_action('admin_enqueue_scripts','biznez_lite_page_admin_enqueue_scripts');
    /**
     * Register scripts for admin panel
     * @return void
     */
    function biznez_lite_page_admin_enqueue_scripts(){	
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('my-upload', get_template_directory_uri() .'/SketchBoard/js/admin-jqery.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_style('thickbox');
    }
}


/**
 * Add Config File 
 */
require_once(get_template_directory() . '/SketchBoard/functions/admin-init.php');


//---------------------------------------------------------------------
//---------------------------------------------------------------------
/* Theme Recommended Plugins
/*---------------------------------------------------------------------------*/
if ( !defined( 'BIZNEZ_REQUIRED_PLUGINS' ) ) {
	define( 'BIZNEZ_REQUIRED_PLUGINS', trailingslashit(get_theme_root()) . 'biznez-lite/inc/plugins' );
}
include_once('inc/skt-required-plugins.php');
//---------------------------------------------------------------------
/* Upshell Pro Theme
/*---------------------------------------------------------------------------*/
require_once( trailingslashit( get_template_directory() ) . 'sketchthemes-upsell/class-customize.php' );

?>