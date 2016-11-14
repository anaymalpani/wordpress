<?php
/**
 * Plugin Name: Material Design Iconic Font Integration
 * Plugin URI: http://www.jumptoweb.com
 * Description: This plugin integrate the Material Design Iconic Font library with your wordpress installation. You can use the shortcode generated with this plugin to add any icon to any widget.
 * Version: 2
 * Author: Manuel Costales
 * Author URI: http://www.manuelcostales.com
 */
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );
/*add javascripts to the header*/
add_action('wp_head', 'add_mdiconic_mc');
function add_mdiconic_mc() {
	wp_enqueue_style( 'md-iconic-font', plugin_dir_url( __FILE__ ).'css/material-design-iconic-font.min.css' );
}

//enabling the ability to enter shortcodes into widgets
add_filter('widget_text', 'do_shortcode');

add_shortcode( 'mdiconic', 'mdiconic_shortcode_mc' );
function mdiconic_shortcode_mc( $atts ) {
/*
 * Attributes availables
 * aclass -> classes to use in the <a> tag
 * target -> target of the <a> tag (_blank, _self, _parent, _top)
 * href   -> link to use in the <a> tag
 * iclass -> classes to use in the <i> tag
 *
 * All this attributes but the iclass are optionals
 */
	if (is_array($atts) && $atts['iclass']){ 
		$iclass = $atts['iclass'];}
	else {
		$iclass = "zmdi-google";}

	if (is_array($atts) && $atts['aclass']){ 
		$aclass = $atts['aclass'];}

	if (is_array($atts) && $atts['target']){ 
		$target = $atts['target'];}

	if (is_array($atts) && $atts['href']){ 
		$href = $atts['href'];}

	return isset($href) ? 
		"<a class=' ".$aclass."' href='".$href."' target=' ".$target."'><i class='zmdi ".$iclass."'></i></a>"
		: 
		"<i class='zmdi ".$iclass."'></i>";
}
