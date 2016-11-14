<?PHP

function wpcm_install () {
	global $wpdb;
	
	update_option('wpcm_date_display_setting','Y-m-d');

	$table_name_1 = $wpdb->prefix . "wpcm_lecturers";
	$table_name_2 = $wpdb->prefix . "wpcm_courses";
	$table_name_3 = $wpdb->prefix . "wpcm_course_holders";
	$table_name_4 = $wpdb->prefix . "wpcm_schedule";   
   
	$sql_1 = "CREATE TABLE " . $table_name_1 . " (
	`id` int(11) NOT NULL auto_increment,
	`name` varchar(255) NOT NULL,
	`description` text,
	`url` varchar(255) default NULL,
	`image` varchar(255) default NULL,
	PRIMARY KEY  (`id`)
	);";
	
	$sql_2 = "CREATE TABLE " . $table_name_2 . " (
	`id` int(11) NOT NULL auto_increment,
	`title` varchar(255) NOT NULL,
	`short_description` text,
	`description` text,
	`target` varchar(255) default NULL,
	PRIMARY KEY  (`id`),
	UNIQUE KEY `title` (`title`)
	);";
  
	$sql_3 = "CREATE TABLE " . $table_name_3 . " (
	`id` int(11) NOT NULL auto_increment,
	`lecturers_id` int(11) NOT NULL,
	`courses_id` int(11) NOT NULL,
	PRIMARY KEY  (`id`)
	);";

	$sql_4 = "CREATE TABLE " . $table_name_4 . " (
	`id` int(11) NOT NULL auto_increment,
	`courses_id` int(11) NOT NULL,
	`date` date NOT NULL,
	`city` varchar(255) NOT NULL,
	`venue` varchar(255) default NULL,
	`more_info_url` varchar(255) default NULL,
	PRIMARY KEY  (`id`)
	);";



	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql_1);
	dbDelta($sql_2);
	dbDelta($sql_3);
	dbDelta($sql_4);

}

?>