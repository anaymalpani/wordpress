<?php
/**
 *
 *  The template for the footer third sidebar containing the widgets
 *
 *  @package WordPress
 *  @subpackage Materialize
 *  @since Materialize 1.0
 */

    // footer third sidebar
    if ( dynamic_sidebar( 'footer-third' ) ){
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
        echo '<h5>' . __( 'Contact' , 'materialize' ) . '</h5>';
        echo '<div class="textwidget">';
        echo sprintf( __( 'facebook: %s' , 'materialize' ) , ' <a href="#">https://facebook.com/#</a>' ) . '<br>';
        echo sprintf( __( 'direct: %s' , 'materialize' ) , ' <a href="#">http://your-website.com/#</a>' ) . '<br>';
        echo sprintf( __( 'e-mail: %s' , 'materialize' ) ,  ' ' . antispambot( 'support@mythem.es' ) );
        echo '</div>';
        echo '</div>';
    }
?>