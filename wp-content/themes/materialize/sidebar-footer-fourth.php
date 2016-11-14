<?php
/**
 *
 *  The template for the footer fourth sidebar containing the widgets
 *
 *  @package WordPress
 *  @subpackage Materialize
 *  @since Materialize 1.0
 */

    // footer fourth sidebar
    if ( dynamic_sidebar( 'footer-fourth' ) ){
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

        // text widget
        echo '<div class="widget widget_text">';
        echo '<h5>' . __( 'Working Hours' , 'materialize' ) . '</h5>';
        echo '<div class="textwidget">';
        echo __( 'Monday to Friday' , 'materialize' ) . '<br/>';
        echo '08:00 - 17:00';
        echo '</div>';
        echo '</div>';
    }
?>