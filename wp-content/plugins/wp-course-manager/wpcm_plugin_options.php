<?PHP

function WPCM_options_menu() {
	//Plugin settings page. The Code is below, in this file.
	add_menu_page(__('WP Course Manager', 'wp-course-manager'), __('WP Course Manager', 'wp-course-manager'), 'manage_options', 'WPCM_top_options_page', 'WPCM_plugin_options');
	
	//Submenu page to edit Lecturers. The code is in the file wpcm_edit_lecturers.php	
	add_submenu_page( 'WPCM_top_options_page', __('WP Course Manager - Edit Lecturers', 'wp-course-manager'), __('Edit Lecturers', 'wp-course-manager'), 'manage_options', 'WPCM_edit_lecturers', 'WPCM_edit_lecturers');

	//Submenu page to edit Courses. The code is in the file wpcm_edit_courses.php
	add_submenu_page( 'WPCM_top_options_page', __('WP Course Manager - Edit Courses', 'wp-course-manager'), __('Edit Courses', 'wp-course-manager'), 'manage_options', 'WPCM_edit_courses', 'WPCM_edit_courses');
	
	//Submenu page to edit the schedule. The code is in the file wpcm_edit_schedule.php	
	add_submenu_page( 'WPCM_top_options_page', __('WP Course Manager - Edit Schedule', 'wp-course-manager'), __('Edit Schedule', 'wp-course-manager'), 'manage_options', 'WPCM_edit_schedule', 'WPCM_edit_schedule');
}
			

function WPCM_plugin_options() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.', 'wp-course-manager') );
	}
?>
<div class="wpcm_settings_wrap">
	<h2><?PHP _e('WordPress Course Manager', 'wp-course-manager');?></h2>

    <?PHP	
	if (isset($_REQUEST['lecturer_page']) || isset($_REQUEST['course_page']) || isset($_REQUEST['schedule_page']) || isset($_REQUEST['registration_address']) )
	{
		$lecturer_page = $_REQUEST['lecturer_page'];
		$course_page = $_REQUEST['course_page'];
		$schedule_page = $_REQUEST['schedule_page'];
		$registration_address =  $_REQUEST['registration_address'];
		$date_display_setting = $_REQUEST['date_display_setting'];
		if ( $date_display_setting == '' )
			$date_display_setting = 'Y-m-d';


		update_option('wpcm_lecturer_page',$lecturer_page);
		update_option('wpcm_course_page',$course_page);
		update_option('wpcm_schedule_page',$schedule_page);
		update_option('wpcm_registration_address',$registration_address);
		update_option('wpcm_date_display_setting',$date_display_setting);

		echo '<p class="wpcm_information">'.__('Options saved!','wp-course-manager').'</p>';

	}


	$lecturer_page = get_option('wpcm_lecturer_page');
	$course_page = get_option('wpcm_course_page');
	$schedule_page = get_option('wpcm_schedule_page');
	$registration_address = get_option('wpcm_registration_address');
	$date_display_setting = get_option('wpcm_date_display_setting');
	
	//Make sure that we have the date display setting set
	//should be unnecessary, but might be needed after plugin upgrade.
	if ( $date_display_setting == '' )
	{
		update_option('wpcm_date_display_setting','Y-m-d');		
		$date_display_setting = 'Y-m-d';
	}

	
	?>
    <div class="WPCM_options_plugin_content_instructions">
        <h3><?PHP _e('Plugin content', 'wp-course-manager');?></h3>
        <p><?PHP _e('To manage the plugin content, use the links under WP Course Manager in the menu to the left.', 'wp-course-manager');?></p>
    </div>
    <div class="WPCM_options_plugn_setup_instructions">
        <h3><?PHP _e('How to use the plugin', 'wp-course-manager');?></h3>
        <p><?PHP _e('To set up the plugin to work as intended, you need to create three pages where the shortcodes will be placed.', 'wp-course-manager');?></p>
   
        <ul>
            <li><?PHP _e('One page lists all lecturers, and also displays detailed info about each lecturer. ', 'wp-course-manager'); _e('Shortcode to put on that page:', 'wp-course-manager'); ?> [wpcm_lecturers]</li>
            <li><?PHP _e('One page lists all courses, and also displays detailed info abou each course. ', 'wp-course-manager'); _e('Shortcode to put on that page:', 'wp-course-manager');?> [wpcm_courses]</li>
            <li><?PHP _e('One page lists the schedule, i.e. the dates for all planned course opportunities. ', 'wp-course-manager'); _e('Shortcode to put on that page:', 'wp-course-manager');?> [wpcm_schedule]</li>
        </ul>
        <p>
            <?PHP _e('', 'wp-course-manager')?>
        </p>
    </div>
    <div class="WPCM_options_section_1">
        <h3><?PHP _e('Plugin settings', 'wp-course-manager');?></h3>
        <h4><?PHP _e('Pages to use', 'wp-course-manager');?></h4>
        <form id="wpcm_options" method="post" action="admin.php?page=<?PHP echo $_GET['page'];?>">
            <fieldset>
                <legend><?PHP _e("Select the pages below that are used to display the plugin content.", 'wp-course-manager')?></legend>
                <p>
                    <label><?PHP _e("Page that displays", 'wp-course-manager');?> <strong> <?PHP _e("lecturers", 'wp-course-manager');?></strong>: </label>
                    <select name="lecturer_page">
                        <option value=""><?PHP _e("Select page", 'wp-course-manager');?></option>
	
                        <?PHP
                        $all_pages = get_pages();
                        foreach ($all_pages as $page)
                        {
                            $option = '<option value="' . $page->post_name . '" '. ($page->post_name == $lecturer_page ? 'selected' : '') .'>';
                            $option .= $page->post_title;
                            $option .= '</option>';
                            echo $option;
                        }
                        ?>
                    </select>
                    <br/>
                    <?PHP _e("This page should only contain this shortcode: ", 'wp-course-manager');?>[wpcm_lecturers]
                </p>
	            <p>
                    <label> <?PHP _e("Page that displays", 'wp-course-manager');?> <strong> <?PHP _e("courses", 'wp-course-manager')?></strong>: </label>
                    <select name="course_page">
                        <option value=""><?PHP _e("Select page", 'wp-course-manager');?></option>
                        <?PHP
                            foreach ($all_pages as $page)
                            {
                                $option = '<option value="' . $page->post_name . '" '. ($page->post_name == $course_page ? 'selected' : '') .'>';
                                $option .= $page->post_title;
                                $option .= '</option>';
                                echo $option;
                            }
                        ?>
                    </select>
                    <br/><?PHP _e("This page should only contain this shortcode: ", 'wp-course-manager');?>[wpcm_courses]
                </p>

                <p>
                    <label><?PHP _e("Page that displays", 'wp-course-manager');?> <strong><?PHP _e("the schedule", 'wp-course-manager');?></strong>: </label>
                    <select name="schedule_page">';
                        <option value=""><?PHP _e("Select page", 'wp-course-manager');?></option>
                        <?PHP
                            foreach ($all_pages as $page)
                            {
                                $option = '<option value="' . $page->post_name . '" '. ($page->post_name == $schedule_page ? 'selected' : '') .'>';
                                $option .= $page->post_title;
                                $option .= '</option>';
                                echo $option;
                            }
                        ?>
                    </select>
                    <br/><?PHP _e("This page should only contain this shortcode: ", 'wp-course-manager');?>[wpcm_schedule]
                </p>


					<h4><?PHP _e('Registration e-mail address','wp-course-manager');?></h4>
                <p>
                    <label><?PHP _e("E-mail address to be used when registering for a scheduled course event.", 'wp-course-manager');?></label>
                    <input type="email" name="registration_address" value="<?PHP echo $registration_address; ?>" /><br/>
                    <?PHP _e("Leave blank to disable the registration link in the event details.", 'wp-course-manager'); ?>
                </p>

					<h4><?PHP _e('Date display setting','wp-course-manager');?></h4>
					<p>
							<label><?PHP _e('Set how dates should be displayed for the site visitors.','wp-course-manager');?></label>
							<input type="text" name="date_display_setting" value="<?PHP echo $date_display_setting; ?>" /><br/>
							<?PHP _e('Default value: Y-m-d (2014-01-31). If you save with this value empty, it will revert to the default value.','wp-course-manager');?><br/>
							<?PHP _e('Use PHP date format codes, as documented in ','wp-course-manager');?><a href="http://php.net/manual/en/function.date.php" target="_blank" title="PHP date documentation"><?PHP _e('the PHP manual for the date function','wp-course-manager');?></a>.<br/>
							<?PHP _e('The plugin does not make a sanity check on the format codes entered in this setting, please use it carefully.','wp-course-manager');?>
					</p>

                <p>
                    <button type="submit"><?PHP _e("Save", 'wp-course-manager');?></button>
                </p>

            </fieldset>
        </form>
    </div>
</div>

<?PHP
}
?>
