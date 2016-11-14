<?php
/*
Plugin Name:Comparebar Plugin
Plugin URI: http://www.wpfruits.com
Description: This plugin will show the comparision between two members
Author: WPFruits
Version: 1.0.4
Author URI: http://www.wpfruits.com
*/
//----------------------------------------------------------------------------------
/*---Load Required Files------------------------------
----------------------------------------------------*/
include_once('scripts.php');
include_once('inc/admin/cb_admin.php');
//---------------------------------------------------

function compbar_plugin_admin_menu() {
	add_menu_page('Add Compare Bar', 'Comparebar', 'publish_posts', 'comparebar','add_comparebar',plugins_url('inc/images/icon.png',__FILE__));
	add_submenu_page('comparebar', 'Edit Comparebar', '', 'publish_posts','cbar_edit','edit_comparebar');
}
add_action('admin_menu', 'compbar_plugin_admin_menu');

//This function will create new database fields with default values
function cbar_defaults(){
	    $default = array(
		'bgcolor'=>'#750400',
		'title' => 'This is the title',
		'img_width' =>'155',
		'img_height' =>'220',
		'image1_title' => 'First Image',
		'image1_path' => plugins_url('inc/images/fighter.png',__FILE__),
		'image1_hoverDes' => 'This is first image description',
		'image2_title' => 'Second Image',
		'image2_path' => plugins_url('inc/images/fighter.png',__FILE__),
		'image2_hoverDes' => 'This is second image description',
		'compare_txt' => 'VS'
		);
return $default;
}

function comp_install(){
    global $wpdb;
	$table_name = $wpdb->prefix . "comparebar"; 
		$sql = "CREATE TABLE " . $table_name . " (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  option_name VARCHAR(255) NOT NULL DEFAULT  'comparebar_options',
		  active tinyint(1) NOT NULL DEFAULT  '0',
		  PRIMARY KEY (`id`),
          UNIQUE (
                    `option_name`
            )
		);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
}

// Runs when plugin is activated and creates new database field
register_activation_hook(__FILE__,'comparebar_plugin_install');

add_action('admin_init', 'comparebar_plugin_redirect');
function comparebar_plugin_activate() {
    add_option('comparebar_plugin_do_activation_redirect', true);
}

function comparebar_plugin_redirect() {
    if (get_option('comparebar_plugin_do_activation_redirect', false)) {
        delete_option('comparebar_plugin_do_activation_redirect');
        wp_redirect('admin.php?page=comparebar');
    }
}

function comparebar_plugin_install() {
    add_option('comparebar_options', cbar_defaults());
	$cbar_version = get_option('cbar_version'); 
	if(!$cbar_version)
	add_option('cbar_version',cbar_get_version());
    comp_install();
    global $wpdb;
	$table_name = $wpdb->prefix . "comparebar"; 
    $sql = "INSERT INTO " . $table_name . " values ('','comparebar_options','1');";
    $wpdb->query( $sql );
	comparebar_plugin_activate();
}

// get notificationbar version
function cbar_get_version(){
	if ( ! function_exists( 'get_plugins' ) )
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}
include_once('inc/front/cb_front.php');

//----------------------------------------------------------------------------------