<?php

/***************** EXCERPT LENGTH *****************/
function biznez_lite_excerpt_length($length) {
	return 110;
}
add_filter('excerpt_length', 'biznez_lite_excerpt_length');

/********************************************
 EXCERPT CONTROLL FUNCTION
*********************************************/
function biznez_lite_limit_words($string, $word_limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $word_limit));
}
/*******************************************************************
******************* pagination ***************************
********************************************************************/
/*  * Retrieve or display pagination code.
 *
 * Usage:
 * 
 * <?php if (function_exists("biznez_lite_pagenavi")) { biznez_lite_pagenavi(); } ?>
 * 
  */
function biznez_lite_round_num($num, $to_nearest) {
   return floor($num/$to_nearest)*$to_nearest;
}
function biznez_lite_pagenavi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $pagenavi_options = array();
    $pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = __('First Page','biznez-lite');
    $pagenavi_options['last_text'] = __('Last Page','biznez-lite');
    $pagenavi_options['next_text'] = '&raquo;';
    $pagenavi_options['prev_text'] = '&laquo;';
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 5;
    //If NOT a single Post is being displayed
    /*http://codex.wordpress.org/Function_Reference/is_single)*/
    if (!is_single()) {
        $request = $wp_query->request;
        /*http://php.net/manual/en/function.intval.php*/
        $posts_per_page = intval(get_query_var('posts_per_page'));
        //Retrieve variable in the WP_Query class.
        /*http://codex.wordpress.org/Function_Reference/get_query_var*/
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;
        //Determine whether a variable is empty
        /*http://php.net/manual/en/function.empty.php*/
        if(empty($paged) || $paged == 0) {
            $paged = 1;
        }
        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        //Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;
        if($start_page <= 0) {
            $start_page = 1;
        }
        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }
        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
        //biznez_lite_round_num() custom function - Rounds To The Nearest Value.
        $larger_start_page_start = (biznez_lite_round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = biznez_lite_round_num($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = biznez_lite_round_num($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = biznez_lite_round_num($end_page, 10) + ($larger_per_page);
        if($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }
        if($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            /*http://php.net/manual/en/function.str-replace.php */
            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="pagenavi">'."\n";
            if(!empty($pages_text)) {
                echo '<span class="pages">'.$pages_text.'</span>';
            }
            //Displays a link to the previous post which exists in chronological order from the current post.
            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
            previous_posts_link($pagenavi_options['prev_text']);
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
                /*http://codex.wordpress.org/Data_Validation*/
                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
                echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a>';
                if(!empty($pagenavi_options['dotleft_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotleft_text'].'</span>';
                }
            }
            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page">'.$page_text.'</a>';
                }
            }
            for($i = $start_page; $i  <= $end_page; $i++) {
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                    echo '<span class="current">'.$current_page_text.'</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            if ($end_page < $max_page) {
                if(!empty($pagenavi_options['dotright_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotright_text'].'</span>';
                }
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a>';
            }
            next_posts_link($pagenavi_options['next_text'], $max_page);
            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            echo '</div>'.$after."\n";
        }
    }
}

/**************************************************
*
*  Function for selecting contact us page
*
**************************************************/
function select_template($pg_id) {
  //deleting previous postmeta
  global $wpdb;
  $wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = '_wp_page_template' AND meta_value = 'contact-page.php'");
  //updating postmeta
  update_post_meta($pg_id, '_wp_page_template', 'contact-page.php');
}

/*********************************************
*
*   to check if a page template is active
*
*********************************************/
function is_pagetemplate_active($pagetemplate = '') {
    global $wpdb;
    $sql = "select meta_key from $wpdb->postmeta where meta_key like '_wp_page_template' and meta_value like '" . $pagetemplate . "'";
    $result = $wpdb->query($sql);
      if ($result)
        {
          return TRUE;
        }
      else 
        {
          return FALSE;
        }
}

/*********************************************
*   limit words
*********************************************/
function biznez_lite_slider_limit_words($string, $word_limit) {
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, $word_limit));
}


/***************************/
function biznez_header_stylingopt() {
    
    if( get_theme_mod('_skenavfull' , 'on') == 'on' ) {

       wp_enqueue_script('biznez-lite-stickyheader', get_template_directory_uri() .'/js/stickyheader.js', array('jquery') );

    }

    if( get_theme_mod( '_notification_on_off', 'on') == 'on') { ?>
    <div id="notificationbar">
        <span class="icon-chevron-up notification-close"></span>
        <div class="wrapper-notifi" >
            <div class="notification-content notifi-color">
        <?php echo wp_kses_post(get_theme_mod('_noticification_text','<div style="color: white; display: inline-block; margin-top: 5px; margin-right: 30px; font-size: 22px;"> Get <strong style="color: #0da159;">Best Services</strong> from Our Business.<button style="cursor: pointer; height: 30px; width: 140px; color: #fff; background-color: #0da159; border-color: #0da159; border-radius: 2px; font-size: 17px; margin-left: 20px;">Go Now</button> </div>')); ?>
            </div>
        </div>
    </div>
  <?php }

} 
add_action('wp_footer','biznez_header_stylingopt');