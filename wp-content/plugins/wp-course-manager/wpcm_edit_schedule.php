<?PHP

//This page holds the code for editing the course schedule.
//The function WPCM_edit_schedule() is called from the file wpcm_plugin_options.php.


function WPCM_edit_schedule() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.', 'wp-course-manager') );
	}
	
	$action = $_REQUEST['action'];
	$id = $_REQUEST['id'];
	$save = $_REQUEST['save'];
	//echo "action &amp; id &amp; save: ".$action." ".$id." ".$save."</br>";

	echo '<div class="wpcm_settings_wrap">';

	echo "<h1>".__('WP Course Manager', 'wp-course-manager')." - ".__('Manage Schedule', 'wp-course-manager')."</h1>";
	
	if ($action=='update_schedule') {
		update_schedule($id, $save);
	}
	else if ($action=='remove_schedule') {
		remove_schedule($id);
	}
	else if ($action=='add_schedule') {
		add_schedule($save);
	}
	else {
		list_all_schedule($save);
	}
		
	echo '</div>';

}


function update_schedule($id, $save){
	
}

function remove_schedule($id){
	$schedule = get_event($id);
	$event = $schedule[0];
	$course = get_courses($event->courses_id);
	$course_title = $course[0]->title;
	
	echo "<p>".__('Deleting scheduled event for ', 'wp-course-manager')."<em>".$course_title."</em>, ".stripslashes($event->date)."</p>";
	
	delete_schedule($id);

	
	list_all_schedule();
	
	
}

function add_schedule($save){
	echo "<h2>".__('Add a new scheduled event', 'wp-course-manager')."</h2>";
?>
<form id="add_schedule" name="add_schedule" action="admin.php?page=<?PHP echo $_GET['page']?>" method="post">

<table>
<tr>
	<td><?PHP _e('Course', 'wp-course-manager');?>:</td><td><select name="courses_id" >
		
	<?PHP
	$courses = get_courses();

	foreach ($courses as $course)
		echo "<option value=\"$course->id\">$course->title</option>";
	?>	
	
	</select>
	</td>
</tr>
<tr>
	<td><?PHP _e('Date', 'wp-course-manager');?>: (YYYY-MM-DD)</td><td><input type="text" name="date" maxlength="10"/></td>
</tr>
<tr>
	<td><?PHP _e('City', 'wp-course-manager');?>:</td><td><input type="text" name="city" maxlength="255"/></td>
</tr>
<tr>
	<td><?PHP _e('Venue', 'wp-course-manager');?>:</td><td><input type="text" name="venue" maxlength="255"/></td>
</tr>
<tr>
	<td><?PHP _e('More info', 'wp-course-manager');?> (<?PHP _e('url to the PDF file', 'wp-course-manager');?>):</td><td><input type="text" name="more_info_url" maxlength="255"/></td>
</tr>

</table>
<input type="hidden" name="save" value="1" />
<input type="submit" value="<?PHP _e('Save', 'wp-course-manager');?>" />

</form>

<?PHP
	
}
	
function list_all_schedule($save=0) {

	//get the schedule from the DB.
	//but first save new scheduled event if save == 1
	
	if ($save==1) {	
				
		$courses_id = $_REQUEST['courses_id'];
		$date = $_REQUEST['date'];
		$city = $_REQUEST['city'];
		$venue = $_REQUEST['venue'];
		$more_info_url = $_REQUEST['more_info_url'];
				
		$data = array(
						'courses_id'=>$courses_id,
						'date'=>htmlspecialchars(stripslashes($date)),
						'city'=>htmlspecialchars(stripslashes($city)),
						'venue'=>htmlspecialchars(stripslashes($venue)),
						'more_info_url'=>htmlspecialchars(stripslashes($more_info_url))
					);		

		//set_schedule() can be found in wpcm_db_access.php
		$id = set_schedule( $data );
	}	
	 
	//get_schedule() can be found in wpcm_db_access.php
	$schedule = get_schedule("admin");
	
	
	echo "<h2>".__('Manage Schedule', 'wp-course-manager')."</h2>";
	echo "<p>+ <a href=\"admin.php?page=".$_GET['page']."&amp;action=add_schedule\">".__('Add Schedule', 'wp-course-manager')."</a></p>";

	echo "<p>".__("It's only possible to add new or delete scheduled events.", 'wp-course-manager')."</p>";

	echo "<table>";
	foreach ($schedule as $event){
		$course = get_courses($event->courses_id);
		$course_title = $course[0]->title; 
		echo "<tr><td>$course_title</td><td>$event->date</td><td>$event->city</td><td><a href=\"admin.php?page=".$_GET['page']."&amp;action=remove_schedule&amp;id=".$event->id."\" onclick=\"return confirm('".__('Do you really want to delete the scheduled event?', 'wp-course-manager')."');\">".__('Remove', 'wp-course-manager')."</a></td></tr>";
		
		}
	echo "</table>";
	echo '</div>';
	
}
	
?>