<?php
/*-------------------------------------------------------------------
 *				Service Shortcode
 *------------------------------------------------------------------*/

add_shortcode('service','service_shortcode');

function service_shortcode( $atts, $content = null )
{
	extract(shortcode_atts(array( 'title' =>'', 'img' => ''),$atts));

	$output = '';
	$output .= '<div class="media service-media">';
	$output .= '<img src="'.$img.'" class="pull-left" alt="" />';
	$output .= '<div class="media-body">';
	$output .= '<h3 class="media-heading">'.$title.'</h3>';
	$output .= '<p>'.$content.'</p>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}


/*-------------------------------------------------------------------
 *				Pricing Shortcode
 *------------------------------------------------------------------*/

//Pricing Columns shortcode
function pricing_table_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		"col" 			=> '4',
		"name" 			=> 'Starter',
		"subtitle" 		=> 'Best for Small Business',
		"price" 		=> '30',
		"duration" 		=> 'month',
		'link' 			=> '#',
		'btn_text' 	=> 'Select Plan',
	), $atts));

	$html = '';

	$plan_col = '';

	if ( $col == '5' ) {
		$plan_col="col-extra-5";
	}
	if ( $col == '4' ) {
		$plan_col="col-sm-6 col-md-3";
	}
	if ( $col == '3' ) {
		$plan_col="col-sm-6 col-md-4";
	}
	if ( $col == '2' ) {
		$plan_col="col-sm-6 col-md-6";
	}
	if ( $col == '1' ) {
		$plan_col="col-sm-12 col-md-12";
	}
	else {
		$plan_col="col-sm-6 col-md-3";
	}

	$html .= '<div class="'.$plan_col.'"><ul class="plan text-center">';
	$html .= '<li class="plan-name"><span>'.$name.'</span>'.$subtitle.'</li>';
	$html .= '<li class="plan-price"><span>'.$price.'</span>'.$duration.'</li>';
	$html .= do_shortcode($content);
	$html .= '<li class="get-plan"><a href="'.$link.'" class="btn btn-plan">'.$btn_text.'</a></li>';
	$html .= '</ul></div>';

	return $html;
}
add_shortcode("pricing", "pricing_table_shortcode");



//pricing maincontent shortcode
add_shortcode('pricing_item','pricing_item_shortcode');

function pricing_item_shortcode($atts,$content = null)
{
	extract(shortcode_atts(array(
	'icon' => 'download',
	'icon_content' => '',
	),
	$atts));

	return '<li class="plan-content"><span>'.$content.'</span><i class="fa fa-'.$icon.'"></i>'.$icon_content.'</li>';
}


/*-------------------------------------------------------------------
 *				Blog Shortcode
 *------------------------------------------------------------------*/

add_shortcode('blog','blog_shortcode');

function blog_shortcode( $atts, $content = null )
{
	extract(shortcode_atts( array( 'number_post' => 4 ),$atts ));

	$args = array(
			'post_type'			=> 'post',
			'posts_per_page' 	=> $number_post
		);

	$posts = get_posts( $args );

	$output = '';
	$output .= '<div class="row blog-shortcode">';

	foreach ( $posts as $post )
	{
		setup_postdata( $post );

		$output .= '<div class="col-sm-6 single-blog">';
		$output .= '<div class="media">';
		$output .= '<div class="pull-left">';

		if (has_post_thumbnail($post->ID))
		{
			$thumb   = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb');
			$output .= '<img class="img-responsive" src="'.$thumb[0].'" title="" alt="">';
		}

		$output .= '<span class="date">'.get_the_date('M').'<span>'.get_the_date('d').'</span></span>';
		$output .= '</div>';
		$output .= '<div class="media-body single-blog-content">';
		$output .= '<h2><a href="'.get_permalink( $post->ID ).'">'.get_the_title($post->ID).'</a></h2>';
		$output .= '<p>'.the_excerpt_max_charlength(80).'</p>';
		$output .= '<ul class="post-meta">';
		$output .= '<li><a href=""><i class="fa fa-pencil-square-o"></i>'.get_the_author().'</a></li>';
		$output .= '<li><a href=""><i class="fa fa-comments"></i>'.get_comments_number( $post->ID ).'</a></li>';
		$output .= '</ul>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
	}

	$output .= '</div>';

	wp_reset_postdata();

	return $output;
}


/*-------------------------------------------------------------------
 *				Parallax Content Shortcode
 *------------------------------------------------------------------*/

add_shortcode('parallax','parallax_shortcode');

function parallax_shortcode( $atts, $content = null )
{
	$output = '';
	$output .= '<div class="parallax-content">';
	$output .= '<h2 class="title">'.do_shortcode( $content ).'</h2>';
	$output .= '</div>';

	return $output;
}


/*-------------------------------------------------------------------
 *				Testimonial Shortcode
 *------------------------------------------------------------------*/

add_shortcode('testimonial','testimonial_shortcode');

function testimonial_shortcode( $atts, $content =null )
{
	extract(shortcode_atts(array('slide_no' => 2),$atts));

	$output = '';
	$output .= '<div class="testimonial-wrapper">';
	$output .= '<div id="testimonial-carousel" class="carousel slide" data-ride="carousel">';

	if (!empty($slide_no))
	{
		$output .= '<ol class="carousel-indicators">';

		for ($i=0; $i < $slide_no; $i++)
		{ 
			$output .= '<li data-target="#testimonial-carousel" data-slide-to="'.$i.'" class="'.(( $i == 0 )? 'active' : '').'"></li>';
		}

		$output .= '</ol>';
	}

	$output .= '<div class="carousel-inner">';
	$output .= do_shortcode( $content );
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}

add_shortcode('testimonial_content','testimonial_content_shortcode');

function testimonial_content_shortcode( $atts, $content =null )
{
	extract(shortcode_atts( array( 'name' => '', 'position' => '', 'active' => '' ),$atts ) );
	
	$output = '';
	$output .= '<div class="item '.( ( $active == 'yes' )? 'active' : '').'">';
	$output .= '<div class="testimonial">';
	$output .= '<h2>'.$content.'</h2>';
	$output .= '<p><span>'.$name.'</span> -'.$position.'</p>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}


/*-------------------------------------------------------------------
 *				Feature Item Shortcode
 *------------------------------------------------------------------*/

add_shortcode('feature','feature_shortcode');

function feature_shortcode( $atts, $content = null )
{
	$output = '';
	$output .= '<div class="features clearfix">';
	$output .= '<div class="col-sm-5 col-sm-push-7">';
	$output .= '<ul class="nav features-nav">';
	$output .= do_shortcode( $content );
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '<div class="col-sm-7 col-sm-pull-5">';
	$output .= '<div class="tab-content">';
	$output .= '<div class="tab-pane active" id="creative">';
	$output .= '<div id="community-carousel" class="carousel slide" data-ride="carousel">';
	$output .= '<ul class="carousel-indicators">';

	$count = count( $atts );

	for ($i=0; $i < $count ; $i++) {
		$output .= '<li data-target="#community-carousel" data-slide-to="'.$i.'" class="'.( ( $i == 0 ) ? 'active': '').'"></li>';
	}
	
	$output .= '</ul>';
	$output .= '<div class="carousel-inner">';

	$index = 0;
	foreach ($atts as $key => $value)
	{
		$output .= '<div class="item '.( ( $index == 0 ) ? 'active': '').'" style="background-image: url(\''.$value.'\')"></div>';
		$index++;
	}

	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}


add_shortcode('feature_content','feature_content_shortcode');

function feature_content_shortcode( $atts, $content = null )
{
	extract(shortcode_atts( array( 'title' => '', 'active' => '', 'slide_no' => '0' ), $atts ));

	$output = '';
	$output .= '<li data-target="#community-carousel" class="'.( ( $active == 'yes' ) ? 'active': '').'" data-slide-to="'.$slide_no.'">';
	$output .= '<div class="vertical-middle">';
	$output .= '<div>';		  	
	$output .= '<div class="media">';
	$output .= '<div class="pull-left">';
	$output .= '<i class="fa fa-comments media-object"></i>';
	$output .= '</div>';
	$output .= '<div class="media-body media-content">';
	$output .= '<h3 class="media-heading">'.$title.'</h3>';
	$output .= '<p>'.$content.'</p>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</li>';

	return $output;
}


/*-------------------------------------------------------------------
 *				Text Slider Shortcode
 *------------------------------------------------------------------*/

add_shortcode('text_slider','text_slider_shortcode');

function text_slider_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array( 'img' => '', 'video_mp4' => '', 'video_webm' => '', 'subtitle' => '', 'btn_link' => '#', 'btn_txt' => '' ),$atts ) );

	$output = '';
	$output .= '<div id="text-carousel" class="carousel slide" data-interval="false">';

	$output .= '<div class="carousel-inner">';
	if ($img != '') {
		$output .= '<div class="item active" style="background-image: url('.$img.');">';
	}else{
		$output .= '<div class="item active">';
	}

	if(($video_mp4 != '') || ($video_webm != '') )
	{
		$output .= '<video autoplay loop muted>';
		$output .= '<source src="'.$video_webm.'" type="video/webm">';
		$output .= '<source src="'.$video_mp4.'" type="video/mp4">';
		$output .= '</video>';
	}
	
	$output .= '<div class="carousel-caption">';
	$output .= '<div class="slidetexts">';
	$output .= '<ul class="slide-text">';
	$output .= do_shortcode( $content );
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '<p>'.$subtitle.'</p>';

	if ($btn_txt !='') {
		$output .= '<a class="btn btn-default btn-transparent" href="'.$btn_link.'">'.$btn_txt.'</a>';
	}
	
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}

add_shortcode('tx_slide','tx_slide_shortcode');

function tx_slide_shortcode( $atts, $content = null )
{
	$output = '';
	$output .= '<li class="texts text-center">';
	$output .= do_shortcode( $content );
	$output .= '</li>';

	return $output;
}


/*-------------------------------------------------------------------
 *				Fade Slider Shortcode
 *------------------------------------------------------------------*/

add_shortcode('fade_slider','fade_slider_shortcode');

function fade_slider_shortcode( $atts, $content = null ){
	global $themeum;

	$output = '';
	if($themeum['fade_slider']){
		$output .= '<ul class="image-slideshow">';

		foreach ($themeum['fade_slider'] as $key => $slide) {
			$output .= '<li>';
			$output .= '<span>Image '.$key.'</span>';
			$output .= '<div>';
			$output .= '<h3>'.$slide['title'].'</h3>';
			$output .= '<p>'.$slide['description'].'</p>';
			$output .= '</div>';
			$output .= '</li>';
		}
		
	    $output .= '</ul>';
	}

    return $output;
}


/*-------------------------------------------------------------------
 *				Contact Holder
 *------------------------------------------------------------------*/

add_shortcode('contact_holder','contact_holder_shortcode');

function contact_holder_shortcode( $atts, $content = null )
{
	$output = '';
	$output .= '<div id="contact-wrap">';
	$output .= do_shortcode( $content );
	$output .= '</div>';

	return $output;
}


/*-------------------------------------------------------------------
 *				Map Shortcpde
 *------------------------------------------------------------------*/

add_shortcode('map','map_shortcode');

function map_shortcode( $atts, $content = null )
{
	global $themeum;

	$output = '';
	$output .= '<div id="gmap-wrap">';
	$output .= '<div id="gmap"></div>';
	$output .= '</div>';

	return $output;
}

/*-------------------------------------------------------------------
 *				Social Icon Shortcodes
 *------------------------------------------------------------------*/

add_shortcode('social','social_shortcode');

function social_shortcode( $atts, $content = null )
{
	global $themeum;

	$output = '';
	$output .= '<div class="social-icons">';
	$output .= '<ul>';

	if ($themeum['facebook_url'] !='') {
		$output .= '<li><a href="'.$themeum['facebook_url'].'"><i class="fa fa-facebook"></i></a></li>';
	}

	if ($themeum['twitter_url'] !='') {
		$output .= '<li><a href="'.$themeum['twitter_url'].'"><i class="fa fa-twitter"></i></a></li>';
	}

	if ($themeum['pinterest_url'] !='') {
		$output .= '<li><a href="'.$themeum['pinterest_url'].'"><i class="fa fa-pinterest"></i></a></li>';
	}

	if ($themeum['gplus_url'] !='') {
		$output .= '<li><a href="'.$themeum['gplus_url'].'"><i class="fa fa-google-plus"></i></a></li>';
	}

	if ($themeum['linkin_url'] !='') {
		$output .= '<li><a href="'.$themeum['linkin_url'].'"><i class="fa fa-linkedin"></i></a></li>';
	}

	if ($themeum['flickr_url'] !='') {
		$output .= '<li><a href="'.$themeum['flickr_url'].'"><i class="fa fa-flickr"></i></a></li>';
	}

	if ($themeum['youtube_url'] !='') {
		$output .= '<li><a href="'.$themeum['youtube_url'].'"><i class="fa fa-youtube"></i></a></li>';
	}

	if ($themeum['dribble_url'] !='') {
		$output .= '<li><a href="'.$themeum['dribble_url'].'"><i class="fa fa-dribbble"></i></a></li>';
	}

	if ($themeum['rss_url'] !='') {
		$output .= '<li><a href="'.$themeum['rss_url'].'"><i class="fa fa-rss"></i></a></li>';
	}
	$output .= '</ul>';
	$output .= '</div>';

	return $output;
}

/*-------------------------------------------------------------------
 *				Container Shortcodes
 *------------------------------------------------------------------*/


add_shortcode('themeum_container','themeum_container_shortcode');

function themeum_container_shortcode($atts,$content = null)
{
	$output = '';
	$output .= '<div class="row">';
	$output .= do_shortcode($content);
	$output .= '</div>';

	return $output;
}


/*-------------------------------------------------------------------
 *				Divider Shortcodes
 *------------------------------------------------------------------*/

add_shortcode( 'themeum_divider', function( $atts, $content= null ){

	$atts = shortcode_atts(
		array(
			'size'  => 'default'
			), $atts);

	extract($atts);

	return '<div class="clearfix ' . $size . ' "></div>';
});


/*-------------------------------------------------------------------
 *				Divider Shortcodes
 *------------------------------------------------------------------*/

add_shortcode('themeum_column','themeum_column_shortcode');

function themeum_column_shortcode( $atts, $content = null)
{
	extract(shortcode_atts(array( 'col'=> 'col-md-12' ),$atts));

	$col_val = 	array(	
		'1' 	=> 'col-sm-12',
		'1/2' 	=> 'col-sm-6', 
		'1/3' 	=> 'col-sm-4', 
		'1/4' 	=> 'col-sm-3', 
		'2/3' 	=> 'col-sm-8', 
		'3/4' 	=> 'col-sm-9'
		);

	$output = '';
	$output .= '<div class="'.$col_val[$col].'">';
	$output .= do_shortcode($content);
	$output .= '</div>';

	return $output;
}


/*-------------------------------------------------------------------
 *				Divider Shortcodes
 *------------------------------------------------------------------*/

add_shortcode('themeum_button', 'themeum_button_shortcode');

function themeum_button_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array( 'size' => '', 'type' => '', 'url' => '', 'text' => 'Button'),$atts));

	$output = '';

	if(!$url):
		$output .= ' <button type="button" class="btn btn-'.$type.' btn-'.$size.' ">'.$text.'</button>';
	else:
		$output .= '<a href="'.$url.'" class="btn btn-'.$type.' btn-'.$size.'" role="button">'.$text.'</a>';
	endif;

	return $output;
}


/*-------------------------------------------------------------------
 *				Alert Shortcodes
 *------------------------------------------------------------------*/

add_shortcode('themeum_alert','themeum_alert_shortcode');

function themeum_alert_shortcode( $atts, $content = null )
{
	extract(shortcode_atts(array( 'close' => '', 'type' => '', 'title' => ''),$atts));

	$close_class = '';

	if($close == 'yes')
	{
		$close_class = 'alert-dismissable';
	}

	$output = '';
	$output .= '<div class="alert alert-'.$type.' '.$close_class.'">';

	if($close == 'yes'):
		$output .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	endif;

	if($title):
		$output .= '<strong>'.$title.'</strong>';
	endif;

	$output .= '<p>'.do_shortcode($content).'</p>';
	$output .= '</div>';

	return $output;
}


/*-------------------------------------------------------------------
 *				ProgressBar Shortcodes
 *------------------------------------------------------------------*/

add_shortcode( 'themeum_progressbar','themeum_progressbar_shortcode');

function themeum_progressbar_shortcode( $atts, $content= null )
{
	return '<div>' . do_shortcode( $content ) . '</div>';
}


add_shortcode( 'themeum_bar', 'themeum_bar_shortcode');

function themeum_bar_shortcode( $atts, $content= null )
{

	$atts = shortcode_atts(
		array(
			"style"		=> '',
			"width"		=> '70'
			), $atts
		);

	extract($atts);

	$output = '';
	$output .= '<div class="progress">';
	$output .= '<div class="progress-bar ' . $style . '" role="progressbar" aria-valuenow="' . $width . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $width . '%">';
	$output .= '<span>' . do_shortcode( $content ) . '</span>';
	$output .= '</div>';
	$output .='</div>';

	return $output;
}


/*-------------------------------------------------------------------
 *				ProgressBar Shortcodes
 *------------------------------------------------------------------*/

add_shortcode('themeum_tabs','themeum_tabs_shortcode');

function themeum_tabs_shortcode( $atts, $content = null)
{
	return '<div class="sportson-tab">'.do_shortcode($content).'</div>';
}


add_shortcode('tab_nav','tab_nav_shortcode');

function tab_nav_shortcode( $atts, $content = null )
{
	extract(shortcode_atts(array(),$atts));

	$output = '';

	$output .= '<ul class="nav nav-tabs">';

	$i = 1;

	foreach($atts as $key => $value){

		$active = '';

		if ($i == 1) {
			$active = 'class="active"';
		}
		$output .= '<li '.$active.'><a href="#'.$key.'" data-toggle="tab">'.$value.'</a></li>';

		$i++;
	}

	$output .= '</ul>';
	$output .= '<div class="tab-content">';
	$output .= do_shortcode($content);
	$output .= '</div>';

	return $output;
}


add_shortcode('tab_text','tab_text_shortcode');

function tab_text_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array( 'id' => ''),$atts));

	$output = '';

	$active = '';

	if($id == "title11")
	{
		$active = 'in active';
	}

	$output .= '<div class="tab-pane fade '.$active.'" id="'.$id.'">';
	$output .= do_shortcode($content);
	$output .= '</div>';

	return $output;
}


/*-------------------------------------------------------------------
 *				ProgressBar Shortcodes
 *------------------------------------------------------------------*/

add_shortcode('themeum_accordion','themeum_accordion_shortcode');

function themeum_accordion_shortcode( $atts, $content = null )
{
	$output = '';
	$output .= '<div id="accordion" class="panel-group">';
	$output .= do_shortcode($content);
	$output .='</div>';

	return $output;
}

add_shortcode('themeum_collaps','themeum_collaps_shortcode');

function themeum_collaps_shortcode( $atts, $content = null )
{
	extract(shortcode_atts(array( 'title' => '', 'id' => ''),$atts));

	$output = '';
	$output .= '';

	$acc_class = '';

	if( $id  == 'id11' ){
		$acc_class = 'in';
	}

	$output .= '<div class="panel panel-default">';
	$output .= '<div class="panel-heading">';
	$output .= '<h4 class="panel-title">';
	$output .= '<a data-toggle="collapse" data-parent="#accordion" href="#'.$id.'">'.$title.'</a>';
	$output .= '</h4>';
	$output .= '</div>';
	$output .= '<div id="'.$id.'" class="panel-collapse collapse '.$acc_class.'">';
	$output .= '<div class="panel-body">'.do_shortcode($content).'</div>';
	$output .= '</div>';
	$output .= '</div>';
	
	return $output;
}

add_shortcode('themeum_ads','themeum_ads_shortcode');

function themeum_ads_shortcode( $atts, $content = null )
{
	global $smof_data;
	extract(shortcode_atts(array('ads' => ''),$atts));

	$image = $smof_data['ads_image_'.$ads];
	$link = $smof_data['ads_link_'.$ads];
	$text = $smof_data['ads_text_'.$ads];

	return '<div class="ad-container"><a href="'.$link.'"><img src="'.$image.'" class="img-responsive" alt="'.$text.'" /></a></div>';
}


add_shortcode('title_two','title_two_shortcode');

function title_two_shortcode( $atts, $content = null ){
	return '<div class="title-wrap news-block"><h2 class="title layout-two">'.$content.'</h2></div>';
}