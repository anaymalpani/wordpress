=== Plugin Name ===
Contributors: halgatewood,webstarsnepal
Donate link: http://halgatewood.com/widgetable/
Tags: adopt-me, widgets, sidebar
Requires at least: 3
Tested up to: 4.3
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Widgetable allows you to specify exactly which custom widgets you want on a per page/post basis.

== Description ==

It creates a custom post type of Widget and adds a meta box with some select boxes to the edit page. 
A setting in: Settings -> Widgetable allows you to specify how many select boxes to show.
Easily add the Widgetable Widget to your sidebar and you're done.

This plugin is geared for sidebars on a company website or non-blog sections of your website. It allows you to create reuseable text widgets, add custom logic with shortcodes or anything else you can do in the TinyMCE editor.

== Installation ==

1. Add plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add the Widgetable Widget to your sidebar or place `<?php get_widgetables(); ?>` in your template
1. Go to `Settings->Widgetable` and choose how many widget spots you want to show
1. Create a few widgets in the 'Widgets' area of your admin navigation
1. Go to a page or post and select which widgets to show


== Frequently Asked Questions ==

= I don't see the widgets on my website, what gives? =

There are two ways to install widgetable:

1. Add the Widgetable Widget to your sidebar.
1. Add `<?php get_widgetables(); ?>` in the sidebar (or wherever you want them to display).

It might be smart to add if `function_exists('get_widgetables')` around your call.

= How do I change the number of widget spots? =

Go to Settings -> Widgetable and choose how many widget spots you want to show

= How do I hide the widget title? =
When adding your widget you can set a custom field of 'hide_title' to true or 1

= How can I changed the widget template? =

To update how the widgets display you will need to use the 'widgetable_display_widget' filter. Example coming soon...




== Screenshots ==

1. Meta box on the post and pages edit page.
2. Widgets are custom post type and use standard WordPress functionality
3. Add shortcodes to your widget content area for even more widget options. Here we grab certain testimonials based on type.
4. Widgets displayed on the frontend. Including a MailChimp newsletter form.
5. Add the custom widgets by adding the Widgetable Widget to your sidebar

== Changelog ==

= 1.3 = 
* Updated WP_Widget contstruct

= 1.2 =
+ Added 'add_filters' for the following items:
++ Width Post Types to display the widgetable meta box on 'widgetable_post_types' (default: post, page)
++ Order of default widgets 'widgetable_default_order_by'
++ Removed template.php 'widgetable_display_widget'
+ Added Menu Icons
+ Fixed PHP errors

= 1.1 =
* Added widetable widget so you can easily add widgetable widgets to your sidebar.

= 1.0 =
* Initial load of the plugin.

