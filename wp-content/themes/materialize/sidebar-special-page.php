<?php
/**
 *
 *  The template for the special page sidebar containing the widgets
 *  Special Page - the content layout with left or right sidebar.
 *
 *  @package WordPress
 *  @subpackage Materialize
 *  @since Materialize 1.0
 */

    // special page sidebar
    if ( dynamic_sidebar( 'special-page' ) ){
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
        // text widget
        echo '<div class="widget widget_text">';
        echo '<h4 class="widget-title">' . __( 'Contact Us' , 'materialize' ) . '</h4>';
        echo '<div class="textwidget">';
        echo sprintf( __( 'facebook: %s' , 'materialize' ) , ' <a href="#">https://facebook.com/#</a>' ) . '<br>';
        echo sprintf( __( 'direct: %s' , 'materialize' ) , ' <a href="#">http://your-website.com/#</a>' ) . '<br>';
        echo '</div>';
        echo '</div>';

        // text widget
        echo '<div class="widget widget_text">';
        echo '<h4 class="widget-title">' . __( 'Working Hours' , 'materialize' ) . '</h4>';
        echo '<div class="textwidget">';
        echo '08:00 - 17:00<br/>';
        echo __( 'Monday to Friday' , 'materialize' );
        echo '</div>';
        echo '</div>';

        // text widget
        echo '<div class="widget widget_text">';
        echo '<h4 class="widget-title">' . __( 'Address' , 'materialize' ) . '</h4>';
        echo '<div class="textwidget">';
        echo '1 Infinite Loop<br/>Cupertino, CA 95014, USA';
        echo '</div>';
        echo '</div>';
    }
?>