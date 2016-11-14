<?php 
/*
Plugin Name: Themeum Enter Shortcodes
Plugin URI: http://www.themeum.com
Description: Themeum Enter theme Shortcode Plugins
Author: Themeum
Version: 1.0
Author URI: http://www.themeum.com
*/

require_once( plugin_dir_path( __FILE__ ).'/view-shortcode.php' );

#-----------------------------------------------------------------#
# Register TinyMCE Shortcode Buttons
#-----------------------------------------------------------------#
function themeum_tinymce_js() {

//make sure the user has correct permissions
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
        return;
    }

//only add to visual mode
    if ( get_user_option('rich_editing') == 'true' ) {
        add_filter( 'mce_external_plugins', 'add_js_plugin' );
        add_filter( 'mce_buttons', 'register_themeum_tinymce_button' );
    }

}

add_action('init', 'themeum_tinymce_js');


function add_js_plugin( $plugin_array ) {
    $plugin_array['themeum_buttons'] = plugins_url('/themeum.tinymce.js',__FILE__);
    return $plugin_array;
}

#-----------------------------------------------------------------
# Create Button
#-----------------------------------------------------------------
function register_themeum_tinymce_button( $buttons ) {
array_push( $buttons, "themeumscgenerator" );  // "themeumscgenerator"  from tinymce.js
return $buttons; 
}