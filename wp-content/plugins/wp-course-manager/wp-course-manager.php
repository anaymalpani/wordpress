<?php
/*
Plugin Name: WP Course Manager
Plugin URI: https://github.com/henrikhoff/WPCM
Description: WordPress Course Manager - a WordPress Plugin to handle courses, lecturers and a schedule of dates when courses are held with one or more lecturer(s).
Version: 1.3
Author: Henrik Hoff
Author URI: http://about.me/henrik.hoff
License: GPL2
*/

/*  Copyright 2011-2016  Henrik Hoff  (email : henrik.w.hoff@gmail.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Include necessary files
//Functions for installing and upgrading the WPCM Plugin
include_once 'wpcm_install_upgrade.php'; 

//Functions for getting data from the WPCM DB Tables
include_once 'wpcm_db_access.php'; 

//Plugin settings and administration:
include_once 'wpcm_plugin_options.php';
include_once 'wpcm_edit_lecturers.php'; 
include_once 'wpcm_edit_courses.php';
include_once 'wpcm_edit_schedule.php';

//Plugin front-end features:
include_once 'wpcm_front-end.php';

$plugin_dir = basename(dirname(__FILE__));
load_plugin_textdomain( 'wp-course-manager', false, $plugin_dir );

//plugin installation hook. Function wpcm_install() can be found in wpcm_install_upgrade.php
register_activation_hook(__FILE__,'wpcm_install');

global $wpcm_db_version;
$wpcm_db_version = "1.0";

/**
 * Register javascript filed
 */
function register_plugin_scripts() {
    wp_register_script('tablesorter', plugins_url('jquery.tablesorter.js', __FILE__), array( 'jquery' ));
    wp_register_script('WPCM_scripts', plugins_url('wpcm_scripts.js', __FILE__), array( 'jquery', 'tablesorter' ));
    wp_enqueue_script('tablesorter');
    wp_enqueue_script('WPCM_scripts');
}

//Register javascripts
add_action( 'wp_enqueue_scripts', 'register_plugin_scripts' );


/**
 * Register style sheet.
 */
function register_plugin_styles() {
	wp_register_style( 'WPCM_css', plugins_url( 'WPCM.css', __FILE__));
	wp_enqueue_style( 'WPCM_css' );
}

// Register style sheet for plugin front-end and admin.
add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );
add_action( 'admin_enqueue_scripts', 'register_plugin_styles' );

//Plugin Settings and Administration	
add_action('admin_menu', 'WPCM_options_menu');

//register shortcodes for the users to use in their pages and posts
add_shortcode('wpcm_lecturers','WPCM_list_lecturers');
add_shortcode('wpcm_courses','WPCM_list_courses');
add_shortcode('wpcm_schedule','WPCM_list_schedule');



	
?>
