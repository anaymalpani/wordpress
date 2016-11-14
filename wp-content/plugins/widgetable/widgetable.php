<?php
/*
Plugin Name: Widgetable
Plugin URI: http://halgatewood.com/widgetable
Description: Dynamic Widgets that can be selected for each page, post, custom_post_type.
Author: Hal Gatewood
Author URI: http://www.halgatewood.com
Version: 1.3
*/

/*
This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; version 2 of the License.

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA 
*/



// SHOW WIDGETABLE FORM FOR THESE POST TYPES:
$widgetable_post_types = apply_filters( 'widgetable_post_types', array( 'post', 'page' ) );

add_option( 'widgetable_options', array( 'number_of_widget_spots' => 3 ) );
add_action( 'admin_init', 'widgetable_settings_init' );
add_action( 'init', 'create_widgetable_type' );
add_filter( 'post_updated_messages', 'codex_widgetable_updated_messages' );
add_action( 'admin_menu', 'widgetable_options_menu' );
add_action( 'add_meta_boxes', 'widgetable_add_custom_box' );
add_action( 'save_post', 'widgetable_save_postdata' );
add_action( 'admin_head', 'widgetable_css' );

function widgetable_settings_init()
{
	register_setting( 'widgetable_options', 'widgetable_options', 'widgetable_options_validate' );
	
	add_settings_section('widgetable_main', 'Settings', 'widgetable_section_text', 'widgetable');
	add_settings_field('widgetable_number_of_spots', 'Number of Widget Spots', 'widgetable_number_of_spots', 'widgetable', 'widgetable_main');
}


function widgetable_section_text() {}

function widgetable_number_of_spots() 
{
	$options = get_option('widgetable_options');
	echo "<input id='widgetable_number_of_spots' name='widgetable_options[number_of_widget_spots]' size='2' maxlength='2' type='text' value='{$options['number_of_widget_spots']}' />";
}


function widgetable_options_validate($input) 
{
	// WIDGET SPOTS: SET TO INTEGER, CHECK IF LESS THAN 1
	$newinput['number_of_widget_spots'] = (int) trim($input['number_of_widget_spots']);
	if($newinput['number_of_widget_spots'] < 1) { $newinput['number_of_widget_spots'] = 1; }
	
	return $newinput;
}

function widgetable_options_menu() 
{
	if (current_user_can('manage_options')) 
	{
		add_options_page('Widgetable Options', 'Widgetable', 'manage_options', 'widgetable', 'widgetable_options');
	}
}

function widgetable_options()
{
	echo '<div class="wrap">';
	echo screen_icon();
	echo "<h2>Widgetable</h2>";
	echo '<form action="options.php" method="post">';
	settings_fields('widgetable_options');
	do_settings_sections('widgetable');
	echo '<p><input name="Submit" type="submit" class="button-primary" value="Save Changes" /></p>';
	echo '</form>';
	echo '</div>';
}

function create_widgetable_type() 
{
  	$labels = array(
				    'name' => _x('Widgets', 'post type general name'),
				    'singular_name' => _x('Widget', 'post type singular name'),
				    'add_new' => _x('Add New', 'widget'),
				    'add_new_item' => __('Add New Widget'),
				    'edit_item' => __('Edit Widget'),
				    'new_item' => __('New Widget'),
				    'all_items' => __('All Widgets'),
				    'view_item' => __('View Widget'),
				    'search_items' => __('Search Widgets'),
				    'not_found' =>  __('No widgets found'),
				    'not_found_in_trash' => __('No widgets found in Trash'), 
				    'parent_item_colon' => '',
				    'menu_name' => 'Widgets'
  					);
						
	$args = array(
					'labels' => $labels,
					'public' => true,
					'publicly_queryable' => true,
					'show_ui' => true, 
					'show_in_menu' => true, 
					'query_var' => true,
					'rewrite' => array('with_front' => false),
					'capability_type' => 'post',
					'has_archive' => true,
					'hierarchical' => false,
					'menu_position' => 26,
					'exclude_from_search' => true,
					'supports' => array( 'title', 'editor', 'custom-fields' )
					);
					
	register_post_type( 'widget', $args );
}

function codex_widgetable_updated_messages( $messages ) 
{
	global $post, $post_ID;

	$messages['widget'] = array(
							0 => '',
							1 => sprintf( __('Widget updated. <a href="%s">View Widget</a>'), esc_url( get_permalink($post_ID) ) ),
							2 => __('Custom field updated.'),
							3 => __('Custom field deleted.'),
							4 => __('Widget updated.'),
							5 => isset($_GET['revision']) ? sprintf( __('Widget restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
							6 => sprintf( __('Widget published. <a href="%s">View Widget</a>'), esc_url( get_permalink($post_ID) ) ),
							7 => __('Widget saved.'),
							8 => sprintf( __('Widget submitted. <a target="_blank" href="%s">Preview Widget</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
							9 => sprintf( __('Widget scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Widget</a>'),
							  		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
							10 => sprintf( __('Widget draft updated. <a target="_blank" href="%s">Preview Widget</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
							);
	return $messages;
}



// ADMIN: WIDGET ICONS
function widgetable_css()
{
	$icon 		= plugins_url( 'widgetable' ) . "/menu-icon.png";
	$icon_32 	= plugins_url( 'widgetable' ) . "/icon-32.png";
	
	echo "
		<style> 
			#menu-posts-widget .wp-menu-image { background: url({$icon}) no-repeat 6px -26px !important; }
			#menu-posts-widget.wp-has-current-submenu .wp-menu-image { background-position:6px 6px!important; }
			.icon32-posts-widget { background: url({$icon_32}) no-repeat 0 0 !important; }
			.widgetable_options { padding: 10px 0; margin-bottom: 7px; }
			.widgetable_options_row { margin-bottom: 7px; }
			.widgetable_select { width: 100%; }
		</style>
	";	
}

function widgetable_add_custom_box() 
{
	global $widgetable_post_types;
	$post_types = get_post_types();
	
	foreach($post_types as $post_type)
	{
		// DONT SHOW THIS BOX FOR THESE POST TYPES (use filter 'widgetable_post_types' to update)
		if( !in_array($post_type, $widgetable_post_types)) { continue; }
    
	    add_meta_box( 
	        'widgetable_sectionid',
	        'Sidebar Widgets',
	        'widgetable_inner_custom_box',
	        $post_type,
	        'side',
	        'low'
	    );
	}
}


/* META BOX ON POST PAGES */
function widgetable_inner_custom_box( $post ) 
{
	$selected_widget = get_post_meta($post->ID, "_widgetable_widgets");
	if(count($selected_widget)) { $selected_widget = $selected_widget[0]; }
	
	$use_parent = @reset(get_post_meta($post->ID, "_widgetable_use_parent"));
	$use_random = @reset(get_post_meta($post->ID, "_widgetable_use_random"));
	
	$use_parent_checked = ($use_parent) ? " CHECKED" : "";
	$use_random_checked = ($use_random) ? " CHECKED" : "";

	$options = get_option('widgetable_options');
	wp_nonce_field( plugin_basename( __FILE__ ), 'widgetable_noncename' );

	$widgets = get_posts( array( 'post_type' => 'widget', 'posts_per_page' => 1000, 'orderby' => 'title', 'order' => 'ASC' ) );
	
	for( $w = 1; $w <= $options['number_of_widget_spots']; $w++ )
	{
		echo '<div class="widgetable_options_row">';
		echo '<select name="widgetable_widgets[]" class="widgetable_select">';	
		echo '	<option value="">Select a Widget...</option>';
		foreach( $widgets as $widget)
		{
			$slctd = ($widget->ID == $selected_widget[$w - 1]) ? " SELECTED" : "";
			echo "	<option value='{$widget->ID}'{$slctd}>{$widget->post_title}</option>";
		}
		echo '</select>';
		echo '</div>';
	}
	
	echo '
			<div class="widgetable_options">
				<div class="widgetable_options_row" align="center">
					<strong>OR</strong>
				</div>
				<div>
					<input type="checkbox" name="widgetable_use_parent" value="1" '.$use_parent_checked.' /> Use Parent Widgets
				</div>
				<div>
					<input type="checkbox" name="widgetable_use_random" value="1" '.$use_random_checked.' /> Use Random Widgets
				</div>
			</div>
		';
}

/* SAVE POST DATA */
function widgetable_save_postdata( $post_id ) 
{
	global $widgetable_post_types;

	// UPDATE POST META VALUES
	if($_POST && in_array($_POST['post_type'] , $widgetable_post_types))
	{
		// CHECKS TO MAKE SURE THIS SAVE CAN HAPPEN
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( !wp_verify_nonce( $_POST['widgetable_noncename'], plugin_basename( __FILE__ ) ) ) return;
		if ( !current_user_can( 'edit_page', $post_id ) ) return;

		update_post_meta($post_id, "_widgetable_widgets", $_POST['widgetable_widgets']);
		
		$widgetable_use_parent = isset($_POST['widgetable_use_parent']) ? $_POST['widgetable_use_parent'] : 0;
		$widgetable_use_random = isset($_POST['widgetable_use_random']) ? $_POST['widgetable_use_random'] : 0;

		update_post_meta($post_id, "_widgetable_use_parent", $widgetable_use_parent);
		update_post_meta($post_id, "_widgetable_use_random", $widgetable_use_random);
	}
}


function get_widgetables()
{
	global $post;
	$options = get_option('widgetable_options');

	$widgets = array();
	$has_user_widgets = false;
	$selected_widgets = get_post_meta($post->ID, "_widgetable_widgets");
	
	if($selected_widgets)
	{
		$selected_widgets = $selected_widgets[0];
		foreach($selected_widgets as $selected_widget)
		{ 
			if($selected_widget)
			{
				$has_user_widgets = true; 
				break;
			}
		}
	}

	$use_default = false;
	$use_parent = @reset(get_post_meta($post->ID, "_widgetable_use_parent"));
	$use_random = @reset(get_post_meta($post->ID, "_widgetable_use_random"));
	
	if($has_user_widgets) // USER SELECTED WIDGETS
	{
		$args = array('post_type' => 'widget', 'post__in' => $selected_widgets, 'orderby' => 'post__in' );
		$widgets = get_posts($args);
	}
	elseif($use_parent) // GET PARENT WIDGETS
	{
		if($post->post_parent)
		{
			$selected_widgets = get_post_meta($post->post_parent, "_widgetable_widgets");
			if($selected_widgets)
			{
				$args = array('post_type' => 'widget', 'post__in' => $selected_widgets[0], 'orderby' => 'post__in' );
				$widgets = get_posts($args);
			}
			else
			{
				$use_default = true;
			}
		}
		else
		{
			$use_default = true;
		}
	}
	elseif($use_random)	// GET RANDOM WIDGETS
	{
		$args = array('post_type' => 'widget', 'orderby' => 'rand', 'posts_per_page' => $options['number_of_widget_spots'] );
		$widgets = get_posts($args);
	}
	else
	{
		$use_default = true;
	}

	if($use_default)
	{
		$args = array('post_type' => 'widget', 'orderby' => apply_filters( 'widgetable_default_order_by', 'rand'), 'posts_per_page' => $options['number_of_widget_spots'] );
		$widgets = get_posts($args);
	}
	
	// SHOW WIDGETS
	if($widgets)
	{
		foreach($widgets as $widget)
		{
			$custom_fields = get_post_custom($widget->ID);
			
			$show_title = true;
			$hide_title_field = isset($custom_fields['hide_title']) ? $custom_fields['hide_title'][0] : false;
			if($hide_title_field) { $show_title = false; }
		
			$content = apply_filters('the_content', $widget->post_content);
			$content = str_replace(']]>', ']]>', $content);

			// ** CHANGE THE HTML THAT IS BEING DISPLAYED BY USING THE FILTER 'widgetable_display_widget' **
		
			$html = "<div class=\"widget widget_text widgetable-wrap\">\n";
			if($show_title) { $html .= "	<h4 class=\"title widgetable-title\">{$widget->post_title}</h4>\n"; }
		
			$html .= "	<div class=\"textwidget widgetable-content\">\n";
			$html .= apply_filters( 'widgetable_display_widget', $content);
			$html .= "	</div>\n";
			$html .= "</div>\n";
		
			echo $html;
		}
	}
}


// Widgetable Widget for Widgets including the Main Widget
class WidgetableWidget extends WP_Widget
{
	function WidgetableWidget()
	{
		$widget_ops = array('classname' => 'WidgetableWidget', 'description' => 'Displays your widgetable widgets' );
		parent::__construct('WidgetableWidget', 'Widgetable Widgets', $widget_ops);
	}
 
	function widget($args, $instance)
	{
		if(function_exists('get_widgetables'))
		{
			get_widgetables();
		}
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("WidgetableWidget");') );


// FROM: http://wordpress.org/extend/plugins/sort-query-by-post-in/
add_filter( 'posts_orderby', 'sort_query_by_post_in', 10, 2 );
	
function sort_query_by_post_in( $sortby, $thequery ) 
{
	if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )
	{
		$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";
	}
	
	return $sortby;
}

// ADMIN SETTINGS SHORTCUT
add_filter('plugin_action_links', 'widgetable_plugin_action_links', 10, 2);
function widgetable_plugin_action_links($links, $file) 
{
    static $this_plugin;
    if (!$this_plugin) 
    {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) 
    {
        // The "page" query string value must be equal to the slug
        // of the Settings admin page we defined earlier, which in
        // this case equals "myplugin-settings".

        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=widgetable">Settings</a>';

        array_unshift($links, $settings_link);
    }
    return $links;
}

?>