<?php
/**
 *
 *  The template for the single post sidebar containing the widgets.
 *  Single post - the content layout with left or right sidebar.
 *
 *  @package WordPress
 *  @subpackage Materialize
 *  @since Materialize 1.0
 */

    // single post sidebar
    if ( dynamic_sidebar( 'post' ) ){
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

        // return null if not is the single post
        if( !is_singular( 'post' ) ){
        	return;
        }

        global $post;

        // widgets
        // post meta widget
        $y      = esc_attr( get_post_time( 'Y', false, $post -> ID ) );
        $m      = esc_attr( get_post_time( 'm', false, $post -> ID ) );
        $d      = esc_attr( get_post_time( 'd', false, $post -> ID ) );

        $name   = get_the_author_meta( 'display_name' , $post -> post_author );
        $dtime  = get_post_time( 'Y-m-d', false, $post -> ID  );
        $ptime  = get_post_time( esc_attr( get_option( 'date_format' ) ), false , $post -> ID, true );

        echo '<div class="widget widget_post_meta">';
        echo '<div class="large-icons">';
        echo '<ul>';
        edit_post_link( '<i class="mythemes-icon-pencil"></i>' . __( 'Edit' , 'materialize' ) , '<li>', '</li>' );
        echo '<li><a href="' . esc_url( get_day_link( $y , $m , $d ) ) . '">';
        echo '<time datetime="' . esc_attr( $dtime ) . '"><i class="mythemes-icon-calendar"></i>' . esc_html( $ptime ) . '</time></a></li>';
        echo '<li><a href="' . esc_url( get_author_posts_url( $post -> post_author ) ) . '" title="' . sprintf( __( 'Writed by %s' , 'materialize' ), esc_attr( $name ) ) . '"><i class="mythemes-icon-user-5"></i>' . esc_html( $name ) . '</a></li>';
        
        // comments
        if( $post -> comment_status == 'open' ) {
            $nr = get_comments_number( $post -> ID );
            echo '<li>';
            echo '<a href="' . esc_url( get_comments_link( $post -> ID ) ) . '">';
            echo '<i class="mythemes-icon-comment-5"></i>';
            echo sprintf( _nx( '%s Comment' , '%s Comments' , absint( $nr ) , 'Number of comment(s) from widget "myThemes: Meta Details"' , 'materialize' ), number_format_i18n( absint( $nr ) ) );
            echo '</a></li>';
        }

        // views - with JetPack plugin
        if( function_exists( 'stats_get_csv' ) ) {
            $args = array(
                'days'      => -1,
                'post_id'   => $post -> ID,
            );

            $result = stats_get_csv( 'postviews' , $args );
            $views  = $result[ 0 ][ 'views' ];

            echo '<li><i class="mythemes-icon-eye-2"></i> ' . sprintf( _n( '%s view' , '%s views' , absint( $views ) , 'materialize' ) , number_format_i18n( absint( $views ) ) ) . '</li>';
        }

        echo '</ul>';
        echo '</div>';
        echo '</div>';

        // post categories widget
        if( has_category() ){
            echo '<div class="widget widget_post_categories">';
            echo '<h4 class="widget-title">' . __( 'Article Categories' , 'materialize' ) . '</h4>';
            echo '<div>';
            echo '<ul>';
            echo '<li>';
            the_category( '</li><li>' );
            echo '</li>';
            echo '</ul>';
            echo '</div>';
            echo '</div>';
        }

        // post tags widget
        if( has_tag() ){
            echo '<div class="widget widget_post_tags">';
            echo '<h4 class="widget-title">' . __( 'Article Tags' , 'materialize' ) . '</h4>';
            echo '<div class="tagcloud">';

            $tags = wp_get_post_tags( $post -> ID );

            foreach( $tags as $t => $tag ){
                $tag_url = get_tag_link( $tag -> term_id );

                if( is_wp_error( $tag_url ) ){
                    continue;
                }

                echo '<a href="' . esc_url( $tag_url ) . '" title="' . absint( $tag -> count ) . '">';
                echo esc_html( $tag -> name );
                echo '</a>';
            }
            
            echo '<div class="clearfix"></div>';
            echo '</div>';
            echo '</div>';
        }
    }
?>