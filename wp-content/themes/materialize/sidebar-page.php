<?php
/**
 *
 *  The template for the single page sidebar containing the widgets.
 *  Single page - the content layout with left or right sidebar.
 *
 *  @package WordPress
 *  @subpackage Materialize
 *  @since Materialize 1.0
 */

    // single page sidebar
    if ( dynamic_sidebar( 'page' ) ){
        // if not empty
    }

    /**
     *
     *  display default content if is enabled default content option
     *  and if is empty sidebar content.
     *
     *  Admin Dashboard / Appearance / Customize / Addtitional
     *  option "Default Content" 
     */

    else if( (bool)get_theme_mod( 'mythemes-default-content', true ) ){

        // widgets
        // search widget
        echo '<div class="widget widget_search">';
        get_template_part( 'searchform' );
        echo '</div>';
        
        // text widget
        echo '<div class="widget widget_text">';
        echo '<h4 class="widget-title">' . __( 'Default Content' , 'materialize' ) . '</h4>';
        echo '<div class="textwidget">';
        echo '<p>' . __( 'You can hide all default content from sidebars if you go to Admin Dashboard &rsaquo; Appearance &rsaquo; Customize &rsaquo; Additional and disable option "Display default content".' , 'materialize' ) . '</p>';
        echo '</div>';
        echo '</div>';
    }
?>