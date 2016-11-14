<?php
/**
 *
 *  The template for the footer first sidebar containing the widgets
 *
 *  @package WordPress
 *  @subpackage Materialize
 *  @since Materialize 1.0
 */

	// footer first sidebar
    if ( dynamic_sidebar( 'footer-first' ) ){
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

        //text widget
        echo '<div class="widget widget_text">';
        echo '<h5>' . __( 'Materialize' , 'materialize' ) . '</h5>';
        echo '<div class="textwidget">';
        echo sprintf( __( 'It is a clean white WordPress theme %s with creative material design and %s responsive layout.' , 'materialize' ), '<br/>' , '<br/>' );
        echo '</div>';
        echo '</div>';
    }
?>