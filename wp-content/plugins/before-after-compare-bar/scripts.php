<?php
if (isset($_GET['page']) && $_GET['page'] == 'cbar_edit') {
add_action('admin_print_scripts', 'cbar_upload_admin_scripts');
add_action('admin_print_styles', 'cbar_upload_admin_styles');
}
add_action('admin_init', 'cb_admin_scripts');
add_action('wp_enqueue_scripts', 'cb_front_scripts');
function cb_admin_scripts(){
	if(is_admin()){
		if(isset($_REQUEST['page']) && ($_REQUEST['page']=="comparebar" || $_REQUEST['page']=="cbar_edit")){
			wp_enqueue_script('jquery');
			wp_enqueue_script('farbtastic');
			wp_enqueue_style('farbtastic');	
		}
		wp_register_script('cb_admin-js',plugins_url('inc/admin/js/cb_admin.js',__FILE__),array('jquery'));
		wp_enqueue_script('cb_admin-js');
		wp_register_style('cb_admin-css',plugins_url('inc/admin/css/cb_admin.css',__FILE__),false, '1.0.0');
		wp_enqueue_style('cb_admin-css');
	}
}
function cb_front_scripts() {	
	if(!is_admin()){
		wp_enqueue_script('jquery');
		wp_register_script('cb_front-js',plugins_url('inc/front/js/comparebar.js',__FILE__), array('jquery'));
		wp_enqueue_script('cb_front-js');
		wp_register_style('cb_front-css',plugins_url('inc/front/css/comparebar.css',__FILE__));
		wp_enqueue_style('cb_front-css');
	}
}
function cbar_upload_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}
function cbar_upload_admin_styles() {
	wp_enqueue_style('thickbox');
}
?>