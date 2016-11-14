<?PHP

//replaces one (1) new-line in a text with <br> tag
//replaces two (2) new-lines in a text with </p><p> tags.
//this assumes that the text will be put inside <p> tags in the page where it will be displayed.
function text2html($text)
{
	$text = str_replace("\r\n\r\n","</p><p>",$text);
	$text = str_replace("\r\n","<br/>",$text);
	return $text;
}

//Triggered by shortcode wpcm_lecturers (defined in wp-course-manager.php)
function WPCM_list_lecturers($content=null) {
	$lecturer = $_REQUEST['id'];	
	
	if ($lecturer) {
		$output = WPCM_show_one_lecturer($lecturer);
	}
	else {
		$output = WPCM_list_all_lecturers();
	}
	return $output;
}	


function WPCM_list_all_lecturers() {
	$lecturers = get_lecturers();

	$output = "<div class='WPCM_content WPCM_lecturers'>";	
	$output .= "<ul>";
	
	foreach ($lecturers as $l) {
		$output .= "<li><a href='?id=$l->id'>$l->name</a></li>";		
		
		}

	$output .= "</ul>";
	$output .= "</div>";	
	
	return $output;
	}
	
function WPCM_show_one_lecturer($id) {
	
	$lecturers = get_lecturers($id);
	$courses = get_lecturers_courses($id);
	
	$courses_page = get_option('wpcm_course_page');
	
	$name = stripslashes($lecturers[0]->name);
	$image = $lecturers[0]->image;
	$description = text2html(stripslashes($lecturers[0]->description));
	$url = $lecturers[0]->url;
	
	
	$output = "<div class='WPCM_content WPCM_lecturers'>";
	
	$output .= "<h2>".$name."</h2>";		
	$output .= "<div id='WPCM_lecturer_image'>";
	$output .= "<img src='".$image."' alt='".__("Portrait of the lecturer", 'wp-course-manager')."' title='".$name."' />";
	$output .= "</div>";
	$output .= "<p>";
	$output .= $description;
	$output .= "</p>";
	$output .= "<div>";
	$output .= __("Home page", 'wp-course-manager').": <a href='". $url ."' target='_blank' title='".$url."'>".$url."</a>";
	$output .= "</div>";
	
	$output .= "<h3>".__("Courses", 'wp-course-manager')."</h3>";
	$output .= "<p>" . $name . " " . __("holds the following courses:", 'wp-course-manager') ."</p>";
	$output .= "<ul>";
	
	//$courses_page holds the short-hand url to the page where the shortcode for the courses is placed. 
	//This is saved with set_option() in the plugin settings, and if that setting is not set by the user, 
	//this value will be empty. In that case, we will not create any links to the courses.
	if($courses_page != '')		
	{
			foreach ($courses as $course)
			{
				$output .= "<li><a href=\"".$courses_page."?id=$course->id\" title=\"$course->title\">$course->title</a></li>";
			}
	}
	else
	{
			foreach ($courses as $course)
			{
				$output .= "<li>$course->title</li>";
			}
	}

	$output .= "</ul>";
	
	$output .= "</div>";	
		
	return $output;
	
	}	
	
//Triggered by shortcode wpcm_courses (defined in wp-course-manager.php)
function WPCM_list_courses($conten=null){
	$course = $_REQUEST['id'];	
	
	if ($course) {
		$output = WPCM_show_one_course($course);
	}
	else {
		$output = WPCM_list_all_courses();
	}
	return $output;	
	
}

function WPCM_list_all_courses(){
	
	$courses = get_courses();
	
	$output = "<div class='WPCM_content WPCM_courses'>";
	$output .= "<ul>";
	
	foreach ($courses as $course)
	{
		$output .= "<li><a href='?id=".$course->id."' >".$course->title."</a></li>";	
	}

	$output .= "</ul></div>";

	return $output;

}	

function WPCM_show_one_course($id) {
	$course = get_courses($id);
	$lecturers = get_course_holders($id);
	$dates = get_schedule($id);
	
	$lecturer_page = get_option('wpcm_lecturer_page');	
	
	$title = stripslashes($course[0]->title);
	$short_descr = text2html(stripslashes($course[0]->short_description));
	$description = text2html(stripslashes($course[0]->description));
	$target = stripslashes($course[0]->target);
	
	$output .= "<div class='WPCM_content WPCM_courses'>";
	
	$output .= "<h2>".$course[0]->title."</h2>";
	$output .= "<div class='WPCM_course_ingress'><p>".$short_descr."</p></div>";
    
    $output .= "<div class='WPCM_course_dates'>";
    $output .= "<h3>".__('Dates', 'wp-course-manager')."</h3>";
	$output .= "<ul>";
	if (isset($dates[0]))
	{
		foreach ( $dates as $date )
		{
            if ($date->more_info_url != '')
            {
                $output .= "<li><a href='".$date->more_info_url."'>".$date->date. ", ".$date->city."</a></li>";
            }
            else
            {
                $output .= "<li>".$date->date. ", ".$date->city."</li>";
            }
		}
	
	}
	else
	{
		$output .= "<li>".__('No scheduled dates for this course', 'wp-course-manager')."</li>"; 	
	}
	$output .= "</ul>";	
    $output .= "</div>";
    
	$output .= "<div class='WPCM_course_lecturers'>";
	$output .= "<h3>".__('Lecturers', 'wp-course-manager')."</h3>";
	
	foreach ( $lecturers as $lecturer)
	{
		$output .= "<div class='WPCM_course_holder'>";
		$output .= "<a href='".$lecturer_page."?id=".$lecturer->id."'>";
		$output .= "<img src='".$lecturer->image."' alt='".stripslashes($lecturer->name)."' /><br/>";
		$output .= stripslashes($lecturer->name)."</a>";
		$output .= "</div>";
	}
    $output .= "</div>";
	 
	
	$output .= "<div class='WPCM_course_description'>";
    $output .= "<h3>".__('Description', 'wp-course-manager')."</h3>";
	$output .= "<p>".$description."</p>";
    $output .= "</div>";

	$output .= "<div class='WPCM_course_target'>";
    $output .= "<h3>".__('Target group', 'wp-course-manager')."</h3>";	
	$output .= "<p>".$target."</p>";
    $output .= "</div>";
	
	$output .= "</div>";
	
	return $output;	
	
}

//Triggered by shortcode wpcm_schedule (defined in wp-course-manager.php)
function WPCM_list_schedule($content=null){

    $registration_address = get_option('wpcm_registration_address');
    $schedule = get_schedule();
    $course_page = get_option('wpcm_course_page');	
    
    $output = "<div class='WPCM_content WPCM_schedule'>";
    
    $output .= "<div id='WPCM_schedule_details'>";
    $output .= "<div id='WPCM_schedule_details_close_button'> </div>";
    $output .= "<div id='WPCM_schedule_details_date'><h4>".__("Date", 'wp-course-manager')."</h4><p>1970-01-01</p></div>";
    $output .= "<div id='WPCM_schedule_details_place'><h4>".__("City and venue", 'wp-course-manager')."</h4><p>Storstad, Grand hotell</div>";
    $output .= "<h3 id='WPCM_schedule_details_title'>Course title</h3>";
    $output .= "<div id='WPCM_schedule_details_descr'><p>Course short description</p></div>";
    $output .= "<div id='WPCM_schedule_details_more_info'><p>";
    $output .= __("More information about this event is ", 'wp-course-manager')."<a href='#'>".__("available here", 'wp-course-manager')."</a>";
    $output .= "</p></div>";

    if($registration_address !== '')
    {
        $output .= "<div id='WPCM_schedule_details_register'><h3>".__("Register", 'wp-course-manager')."</h3>";
        $output .= "<p>";
        $output .= __("Register for this event by ", 'wp-course-manager');
        $output .= "<a href='#'>".__("clicking here", 'wp-course-manager')."</a>.";
        $output .= "</p>";
        $output .= "</div>";
    }


    $output .= "</div>";
    
    $output .= "<table id='WPCM_schedule_table'>";
    $output .= "<thead><tr>";
    $output .= "<th>".__('Date', 'wp-course-manager')."</th><th>".__('Title', 'wp-course-manager')."</th><th>".__('City', 'wp-course-manager')."</th>";
    $output .= "</tr></thead>";
    $output .= "<tbody>";
    foreach ( $schedule as $event )
    {
        $course = get_courses($event->courses_id);
        $output .= "<tr ";
        $output .= "data-eventid='".$event->id."' ";
        $output .= "data-eventdate='".$event->date."' ";
        $output .= "data-eventcity='".$event->city."' ";
        $output .= "data-eventvenue='".$event->venue."' ";
        $output .= "data-eventurl='".$event->more_info_url."' ";
        $output .= "data-eventcourseid='".$event->courses_id."' ";
        $output .= "data-eventcoursetitle='".$course[0]->title."' ";
        $output .= "data-eventcoursedescr='".$course[0]->short_description."' ";
        $output .= "data-registrationurl='mailto:".$registration_address."?subject=".__("Registration for ", 'wp-course-manager').$course[0]->title.__(" in ", 'wp-course-manager').$event->city."' ";
        $output .= ">";
        $output .= "<td>";
        //"Ugly" fix to make sure the javascript tablesorter works for the date,
        //since it requires specially written parsers for each date format to be used
        //and I don't know what date format the blog admins choose.
        //This makes the table sort on the hidden date within the <span> tag.
        $output .= "<span style='display: none;'>".$event->date_original." </span>";
        $output .= $event->date;
        $output .= "</td>";
        $output .= "<td>";
        $output .= $course[0]->title;
        $output .= "</td>";
        $output .= "<td>";
        $output .= $event->city;
        $output .= "</td>";
        $output .= "</tr>";
    }
    $output .= "</tbody></table>";
    
    $output .= "</div>";
    
    return $output;
	
}
	
	
?>