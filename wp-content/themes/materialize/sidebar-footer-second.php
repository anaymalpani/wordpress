<?php
/**
 *
 *  The template for the sooter second sidebar containing the widgets
 *
 *  @package WordPress
 *  @subpackage Materialize
 *  @since Materialize 1.0
 */

	// footer second sidebar
    if ( dynamic_sidebar( 'footer-second' ) ){
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
        echo '<h5>' . __( 'Address' , 'materialize' ) . '</h5>';
        echo '<div class="textwidget">' . sprintf( __( '1 Infinite Loop %s Cupertino, CA 95014 %s United States' , 'materialize' ) , '<br/>' , '<br/>' ) . '</div>';
        echo '</div>';
    }
?>