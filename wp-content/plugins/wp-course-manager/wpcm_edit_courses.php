<?PHP

//This page holds the code for editing Courses.
//The function WPCM_edit_courses() is called from the file wpcm_plugin_options.php.


function WPCM_edit_courses() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.', 'wp-course-manager') );
	}
	echo '<div class="wpcm_settings_wrap">';
	
	
	$action = $_REQUEST['action'];
	$id = $_REQUEST['id'];
	$save = $_REQUEST['save'];
	//echo "action &amp; id &amp; save: ".$action." ".$id." ".$save."</br>";

	echo "<h1>".__('WP Course Manager', 'wp-course-manager')." - ".__('Manage Courses', 'wp-course-manager')."</h1>";
	
	if ($action=='update_course') {
		update_course($id, $save);
	}
	else if ($action=='delete_course') {
		remove_course($id);
	}
	else if ($action=='add_course') {
		add_course($save);
	}
	else {
		list_all_courses();
	}
		
	echo '</div>';
}


function list_all_courses() {

	//get all the courses from the DB. 
	//get_courses() can be found in wpcm_db_access.php
	$courses = get_courses();
	
	echo "<h2>".__('Manage courses', 'wp-course-manager')."</h2>";
	echo "<p>+ <a href=\"admin.php?page=".$_GET['page']."&amp;action=add_course\">".__('Add Course', 'wp-course-manager')."</a></p>";

	echo "<table>";
	
	foreach ($courses as $course){
		echo "<tr><td><a href=\"admin.php?page=".$_GET['page']."&amp;action=update_course&amp;id=$course->id\" title=\"".__('Edit', 'wp-course-manager')." $course->title\">$course->title</a></td>";
		echo "<td><a href=\"admin.php?page=".$_GET['page']."&amp;action=delete_course&amp;id=$course->id\" onclick=\"return confirm('".__('Do you really want to delete the course?', 'wp-course-manager')."');\" title=\"".__('Delete', 'wp-course-manager')." $course->title\">".__('Delete', 'wp-course-manager')."</a></td>";
	}

	echo "</table>";
}

function update_course($id, $save) {
	
	if ($save==1) {	
				
		$title = $_REQUEST['title'];
		$short_description = $_REQUEST['short_description'];		
		$description = $_REQUEST['description'];
		$target = $_REQUEST['target'];
		
		$lecturers = $_REQUEST['lecturers'];
				
		$course_data = array(
						'id'=>$id,
						'title'=>htmlspecialchars(stripslashes($title)),
						'short_description'=>htmlspecialchars(stripslashes($short_description)),
						'description'=>htmlspecialchars(stripslashes($description)),
						'target'=>htmlspecialchars(stripslashes($target))
					);
				

		//set_course() can be found in wpcm_db_access.php
		$id = set_course( $course_data, $lecturers );
	}
	

	$c = get_courses($id);
	$course = $c[0];	
	//print_r($course);
	//echo "</br>TITLE: $course->title";
	?>

	<form id="wpcm_update_course" name="update_course" action="admin.php?page=<?PHP echo $_GET['page']."&amp;action=update_course&amp;id=$course->id"; ?>" method="post">

		<table class="wpcm_admin_update_table">
			<tr>
				<td><?PHP _e('Title:', 'wp-course-manager') ?></td>
				<td><input type="text" name="title" maxlength=255 value="<?PHP echo stripslashes($course->title); ?>" /></td>
			</tr>
			<tr>
				<td><?PHP _e('Lead Paragraph:', 'wp-course-manager') ?></td>
				<td><textarea name="short_description" rows="7" cols="40"><?PHP echo stripslashes($course->short_description); ?></textarea></td>
			</tr>
			<tr>
				<td><?PHP _e('Description: (Make two new-lines for a new paragraph.)', 'wp-course-manager') ?></td>
				<td><textarea name="description" rows="20" cols="40"><?PHP echo stripslashes($course->description); ?></textarea></td>
			</tr>
			<tr>
				<td><?PHP _e('Target:', 'wp-course-manager') ?></td>
				<td><input type="text" name="target" maxlength=255 value="<?PHP echo stripslashes($course->target); ?>" /></td>
			</tr>
			<tr>
				<td><?PHP _e('Lecturer(s): (use ctrl to select more than one)', 'wp-course-manager') ?></td>
				<td>

		<?PHP
		
			$lecturers = get_lecturers();
			$course_holders = get_course_holders($id);
			
			$course_holders_ids = array();
			$i=0;
			foreach ($course_holders as $course_holder)
			{
				$course_holders_ids[$i]=$course_holder->id;
				$i++;
			}
			//echo "<br />***<br />";
			//print_r($course_holders_ids);
			
			$selected = "";
			echo "<select multiple=\"multiple\" name=\"lecturers[]\">";

			foreach ($lecturers as $lecturer)
			{
				
				if (in_array($lecturer->id, $course_holders_ids)) 
				{
					$selected = " selected='selected' ";
				}
				
				echo "<option $selected value=\"$lecturer->id\">$lecturer->name</option>";
				$selected = "";
		}
?>	
		</select>
	</td>
</tr>
				
	
			
		</table>
<!--		<input type="hidden" name="id" value="<?PHP echo $lecturer->id;?>" />-->
		<input type="hidden" name="save" value="1" />
		<input type="submit" value="<?PHP _e('Save', 'wp-course-manager'); ?>" />

	</form>


<?PHP	

	echo "<p><a href='admin.php?page=".$_GET['page']."'>" . __('Cancel', 'wp-course-manager') . " (" . __('Go back to all lecturers', 'wp-course-manager').")</a></p>";
		
	
}

function remove_course($id) {

	$c = get_courses($id);
	$course = $c[0];	
	
	echo "<p>".__('Deleting course ', 'wp-course-manager').stripslashes($course->title)."</p>";
	
	
	//Check if the course has scheduled events?
	//Now it just removes the course and all scheduled events with that course.
	
	delete_course($id);

	list_all_courses();
	
}

function add_course() { 
	echo "<h2>".__('Add a new Course', 'wp-course-manager')."</h2>";
	
?>

<form id="wpcm_update_course" name="update_course" action="admin.php?page=<?PHP echo $_GET['page']."&amp;action=update_course&amp;id=$course->id"; ?>" method="post">

		<table class="wpcm_admin_update_table">
			<tr>
				<td><?PHP _e('Title:', 'wp-course-manager') ?></td>
				<td><input type="text" name="title" maxlength=255 value="<?PHP echo stripslashes($course->title); ?>" /></td>
			</tr>
			<tr>
				<td><?PHP _e('Lead Paragraph:', 'wp-course-manager') ?></td>
				<td><textarea name="short_description" rows="7" cols="40"><?PHP echo stripslashes($course->short_description); ?></textarea></td>
			</tr>
			<tr>
				<td><?PHP _e('Description: (Make two new-lines for a new paragraph.)', 'wp-course-manager') ?></td>
				<td><textarea name="description" rows="20" cols="40"><?PHP echo stripslashes($course->description); ?></textarea></td>
			</tr>
			<tr>
				<td><?PHP _e('Target:', 'wp-course-manager') ?></td>
				<td><input type="text" name="target" maxlength=255 value="<?PHP echo stripslashes($course->target); ?>" /></td>
			</tr>
			<tr>
				<td><?PHP _e('Lecturer(s): (use ctrl to select more than one)', 'wp-course-manager') ?></td>
				<td>

		<?PHP
		
			$lecturers = get_lecturers();
			$course_holders = get_course_holders($id);
			
			$course_holders_ids = array();
			$i=0;
			foreach ($course_holders as $course_holder)
			{
				$course_holders_ids[$i]=$course_holder->id;
				$i++;
			}
			//echo "<br />***<br />";
			//print_r($course_holders_ids);
			
			$selected = "";
			echo "<select multiple=\"multiple\" name=\"lecturers[]\">";

			foreach ($lecturers as $lecturer)
			{
				
				if (in_array($lecturer->id, $course_holders_ids)) 
				{
					$selected = " selected='selected' ";
				}
				
				echo "<option $selected value=\"$lecturer->id\">$lecturer->name</option>";
				$selected = "";
		}
?>	
		</select>
	</td>
</tr>
				
	
			
		</table>
<!--		<input type="hidden" name="id" value="<?PHP echo $lecturer->id;?>" />-->
		<input type="hidden" name="save" value="1" />
		<input type="submit" value="<?PHP _e('Save', 'wp-course-manager'); ?>" />

	</form>

<?PHP

}


?>