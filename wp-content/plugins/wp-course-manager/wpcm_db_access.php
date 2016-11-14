<?PHP

global $wpdb;
$lecturer_table_name = $wpdb->prefix . "wpcm_lecturers";
$course_table_name = $wpdb->prefix . "wpcm_courses";
$course_holders_table_name = $wpdb->prefix . "wpcm_course_holders";
$schedule_table_name = $wpdb->prefix . "wpcm_schedule";


function print_status($result){
		global $wpdb;		
		if($result === FALSE) {
			echo "<p class='wpcm_error'>".__('It was not possible to perform the operation.', 'wp-course-manager')."</p>";
			$wpdb->print_error();
		}
		else
		{
			echo "<p class='wpcm_information'>".__('The operation has been performed successfully.', 'wp-course-manager')."</p>";
		}
}


function get_lecturers($id="all"){
	global $wpdb;	
	global $lecturer_table_name;
	
	if($id == "all")
		$query="SELECT * FROM $lecturer_table_name";
	else
		$query="SELECT * FROM $lecturer_table_name WHERE id=$id";

//	echo $query;	
	$result = $wpdb->get_results($query); 
	return $result;

}

//Saves a lecturer to the DB, or creates a new one if no $lecturer[id] is present.
//Returns $id of the updated or created lecturer.
//$lecturer must be an array with all the data to be saved, the data pairs as the table data structure

function set_lecturer($lecturer) {
	//echo "Data: ";	
	//print_r($lecturer);
	//echo $lecturer[name].$lecturer[id];	
	
	//print_r(array('id'=>$lecturer[id]));	
		
	global $wpdb;
	global $lecturer_table_name;
	$wpdb->show_errors();
	
	if ($lecturer[id]) {
		//echo '<p>Update!</p>';
		$result = $wpdb->update( $lecturer_table_name, $lecturer, array('id'=>$lecturer[id]), array( '%d', '%s', '%s','%s','%s') ,array( '%d' ));
		$id = $lecturer[id];
	}
	else {
		//echo '<p>Insert!</p>';
		$result = $wpdb->insert( $lecturer_table_name, $lecturer, array('%s', '%s','%s','%s'));
		$id = $wpdb->insert_id;
	}
	print_status($result);
	return $id;
	
}

//Deletes a lecturer from the DB
//$id is, of course, the id of the lecturer to be removed. Called from wpcm_edit_lecturer.php
//Also removes any accurance of this lecturer in course_holder, but leaves the course it self.
//The course in question might then be without any lecturers.

function delete_lecturer($id) {
	global $wpdb;
	global $lecturer_table_name;
	global $course_holders_table_name;
	
	$query = "DELETE FROM $lecturer_table_name WHERE id = $id";
	$result = $wpdb->query($query);	
	print_status($result);
	
	$query = "DELETE FROM $course_holders_table_name WHERE lecturers_id = $id";
	$result = $wpdb->query($query);	
	print_status($result);
	
}


//Get all courses, or one if $id is specified.
//Always returns an array of courses (that is an array of course info)
//When an $id is specified get_courses() returns an array with one array of course info.
//Example: To get the course title: $result[0]->title;
 
function get_courses($id="all") {
	global $wpdb;	
	global $course_table_name;

	if($id == "all")
		$query="SELECT * FROM $course_table_name";
	else
		$query="SELECT * FROM $course_table_name WHERE id=$id";

	//echo $query;
		
	$result = $wpdb->get_results($query); 

	return $result;
	
} 

//Saves a course to the DB, or creates a new one if no $course[id] is present.
//Returns $id of the updated or created course.
//$course must be an array with all the data to be saved, the data pairs as the table data structure
//$lecturers must be an array with the id of the lecturers that are connected to the course.

function set_course($course, $lecturers) {
	//echo "Data: ";	
	//print_r($course);
	//echo $course[title].$course[id];	
	
	//print_r(array('id'=>$course[id]));	
		
	global $wpdb;
	global $course_table_name;
	global $course_holders_table_name;
	
	$wpdb->show_errors();
	
	if ($course[id]) {
		//echo '<p>Update!</p>';
		$result = $wpdb->update( $course_table_name, $course, array('id'=>$course[id]), array( '%d', '%s', '%s','%s','%s') ,array( '%d' ));
		$id = $course[id];
	}
	else {
		//echo '<p>Insert!</p>';
		$result = $wpdb->insert( $course_table_name, $course, array('%s', '%s','%s','%s'));
		$id = $wpdb->insert_id;
	}
	print_status($result);
	
	if($lecturers)
		{
			$query = "DELETE FROM $course_holders_table_name WHERE courses_id=$id";
			$result = $wpdb->query($query);


			foreach ($lecturers as $lecturer)
			{
				$result = $wpdb->insert($course_holders_table_name, array('courses_id'=>$id,'lecturers_id'=>$lecturer),array('%d','%d'));
				
			}
		}
		else 
		{
			/*echo "Ingen föreläsare vald";*/	
		}
		
	
	return $id;
	
}



//Get all the lecturers that are associated with one course
//Or in other words: the lecturers that 'holds' the course

function get_course_holders($course_id)
{
	global $wpdb;
	global $course_holders_table_name;
	
	$query="SELECT * FROM $course_holders_table_name WHERE courses_id=$course_id";

	$result = $wpdb->get_results($query); 
	$my_result = array();
	$i=0;
	foreach ($result as $course_holder)
	{
		$result2 = get_lecturers($course_holder->lecturers_id);
		$my_result[$i] = $result2[0];
		$i++;
	}

	return $my_result;

}

//Deletes a course from the DB
//Also deletes all entries in course_holders and schedule tables for this course
//$id is, of course, the id of the course to be removed. Called from wpcm_edit_course.php

function delete_course($id) {
	global $wpdb;
	global $course_table_name;
	global $course_holders_table_name;
	global $schedule_table_name;
	
	$query = "DELETE FROM $course_table_name WHERE id = $id";
	$result = $wpdb->query($query);
	print_status($result);
	
	$query = "DELETE FROM $course_holders_table_name WHERE courses_id=$id";	
	$result = $wpdb->query($query);
	print_status($result);
	
	$query = "DELETE FROM $schedule_table_name WHERE courses_id=$id";	
	$result = $wpdb->query($query);
	print_status($result);
	
	
}

//Get the schedule for 
//future == all future scheduled events
//admin == all scheduled events
//$id == all future scheduled events from a specific course

//To get info about one specific scheduled event, use get_event($id)

function get_schedule($course_id="future"){
	global $wpdb;
	global $schedule_table_name;
	
	if($course_id == "future")
		//get all future scheduled courses
		$query="SELECT * FROM $schedule_table_name WHERE date>=CURDATE() ORDER BY date, city ASC";
	else if($course_id=="admin")		
		//get all schedules courses
		$query="SELECT * FROM $schedule_table_name ORDER BY date DESC";
	else
		//get all scheduled courses from a specific course
		$query="SELECT * FROM $schedule_table_name WHERE courses_id=$course_id AND date>=CURDATE() ORDER BY date, city ASC";
		
	$result = $wpdb->get_results($query);
	//echo $query;	
	//print_r($result);

    //The blog admin/editor can set how the date will be displayed to the end users
    //This is done in wpcm_plugin_options.php
    //Here we will get that setting and change the date format to whatever the admin has set.
    //If there, for any reason, is no such option set, we will use te default value 'Y-m-d'

    $date_display_setting = get_option('wpcm_date_display_setting');
    if ( $date_display_setting == '' )
        $date_display_setting = 'Y-m-d';

    foreach($result as $event)
    {
        $event->date_original = $event->date;
        $event->date = date($date_display_setting,strtotime($event->date));
    }


    return $result;
	
	}
	
//Get a single scheduled event
function get_event($id) {
	global $wpdb;
	global $schedule_table_name;
	
	$query="SELECT * FROM $schedule_table_name WHERE id=$id";
		
	$result = $wpdb->get_results($query);
	//echo $query;	
	//print_r($result);
	return $result;
		
}
	
function delete_schedule($id) {
	global $wpdb;
	global $schedule_table_name;
	
	$query = "DELETE FROM $schedule_table_name WHERE id = $id";
	$result = $wpdb->query($query);	
	print_status($result);
		
}

//saves the scheduled event $event. 
//If no $event->id is present, a new is created (otherwise updated)
//$event must be an array with all the data to be saved, the data pairs as the table data structure of the schedule table.

function set_schedule($event) {
	//echo "Data: ";	
	//print_r($event);	
		
		
	global $wpdb;
	global $schedule_table_name;
	
	$wpdb->show_errors();
	
	if ($event[id]) {
		//echo '<p>Update!</p>';
		$result = $wpdb->update( $schedule_table_name, $event, array('id'=>$schedule[id]), array( '%d', '%d', '%s','%s','%s','%s') ,array( '%d' ));
		$id = $course[id];
	}
	else {
		//echo '<p>Insert!</p>';
		$result = $wpdb->insert( $schedule_table_name, $event, array('%d', '%s','%s','%s','%s'));
		$id = $wpdb->insert_id;
	}
	print_status($result);
	
	
	return $id;

}

//Get the courses that a specific lecturer holds
function get_lecturers_courses($lecturer_id)
{
	global $wpdb;
	global $lecturer_table_name;
	global $course_table_name;
	global $course_holders_table_name;
	
	$query="SELECT * FROM $course_holders_table_name WHERE lecturers_id = $lecturer_id";	
		
	$result = $wpdb->get_results($query);
	//echo $query;	
	//print_r($result);
	
	/*echo "debug: ".$result[0][1]."<br>";*/	
	
	$my_result = array();
	$temp_result = array();
	$i=0;
	foreach ($result as $course)
	{
		/*echo $course[2].", ";*/
		$temp_result=get_courses($course->courses_id);
		$my_result[$i] = $temp_result[0];
		$i++;
	}


	return $my_result;

}



?>