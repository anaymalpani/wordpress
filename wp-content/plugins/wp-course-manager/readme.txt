=== WP Course Manager ===
Contributors: henrikhoff
Donate link: https://github.com/henrikhoff/WPCM
Tags: course, schedule, education, event, events, teacher, lecture, lecturer
Requires at least: 3.0.0
Tested up to: 4.4.2
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WordPress Course Manager - a WordPress Plugin to handle courses, lecturers and a schedule of dates when courses are held with one or more lecturer(s).

== Description ==
WordPress Course Manager - a WordPress Plugin to handle courses, lecturers and a schedule of dates when courses are held with one or more lecturer(s).

The plugin lets you manage:

* Lecturers - Name, biography, picture and homepage url.
* Courses - Name, description, lecturers
* Schedule - Course, date, place, url to page/file with more information.

The plugin has very basic styling with css, relying mostly on the current theme to style things like typography, margins, paddings and so on. The plugin style is made to be responsive (works well on both small and big screens) and tested with the default 2013 theme.

Javascript is required to be enabled in the browser for the schedule page to work

This plugin was developed since I couldn't find any other plugin that provided this functionality, and I needed it for the home page of the Swedish educational company Utbildningsglädje (http://www.utbildningsgladje.nu).

What I needed was to manage lecturers that can hold different courses and create a schedule with courses to be held at different locations.



== Installation ==

How to install WP Course Manager:

1. Upload the folder `WP Course Manager` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add information about lecturers, courses and their scheduled events in WP Course Manager settings. 
4. Create 3 pages where the following shortcodes should be placed:
   * [wpcm_lecturers] to list all lecturers
   * [wpcm_courses] to list all courses
   * [wpcm_schedule] to list the schedule
5. In the plugin settings, set what pages contain the different shortcodes.

== Frequently Asked Questions ==

= Why is the FAQ almost empty? =

I haven't received any questions yet...


== Screenshots ==

1. The plugin options page. This is where you tell the plugin what pages you have put the shortcodes in.
2. Edit lecturer information.
3. Manage the schedule. A new scheduled event has just been added.
4. The schedule list on the page with the shortcode for listing the schedule. This is how the visitor to the site sees it.
5. The schedule list with detailed information about one scheduled event.
6. Information about a lecturer, on the page where the shortcode for showing lecturers is put.
7. Information about a course, on the page where the shortcode for showing courses is put.

== Changelog ==


= 1.0 =
* Project created
* Basic administrative features, manage lecturers, courses and a schedule.
* Show info about lecturers, courses and the schedule with shortcodes in pages.

= 1.1 =
* Fixed issue where scripts and css didn't register correctly.
* Added Swedish translation of plugin

= 1.2 =
* Lots of different small fixes, mostly concerning css and removing old debug outputs.
* Added uninstall script that removes plugin options and DB tables when the plugin is removed through the Wordpress plugin manager.
* Added plugin screenshots and a better description.

= 1.3 =
* Added setting to specify the Date format to use for the schedule.

== Upgrade Notice ==

No specific upgrade info for version 1.3.
