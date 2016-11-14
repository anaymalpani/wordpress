<?php
define('WP_USE_THEMES', false);
$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

$output = '';

$args = array(  'post_type'			=>'project',
				'posts_per_page' 	=> $_GET['perpage'],
				'paged' 			=> $_GET['paged'],
				'orderby' 			=> 'menu_order',
				'order' 			=> 'ASC'	
	);

$projects = new WP_Query($args);

if($projects->have_posts()):

	while ($projects->have_posts()): $projects->the_post();
		$terms = get_the_terms( $post->ID, 'project_tag' );

		$term_name = '';

		if ($terms)
		{
			foreach ( $terms as $term )
			{
				$term_name .= ' '.$term->slug;
			}
		}

		$output .= '<div class="col-md-3 portfolio-item'.$term_name.'">';
		$output .= '<div class="view efffect">';
		$output .= '<div class="portfolio-image">';

		if (has_post_thumbnail($post->ID))
		{
			$thumb 			= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
			$large_image 	= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');

			$output .= '<img class="img-responsive" src="'.$thumb[0].'" title="" alt="">';
		}
		else
		{
			$output .= '<img class="img-responsive" src="images/work_1.jpg" title="" alt="">';
		}

		$output .= '</div>';
		$output .= '<div class="mask text-center">';
		$output .= '<h3>'.get_the_title($post->ID).'</h3>';
		$output .= '<h4>'.get_post_meta( $post->ID, 'thm_project_subtitle', true ).'</h4>';
		$output .= '<a class="folio-read-more" href="#" data-post_id="'.$post->ID.'" data-single_url="'.get_permalink( $post->ID ).'" data-project_url="'.get_permalink( $post->ID ).'"><i class="fa fa-link"></i></a>';
		$output .= '<a data-rel="prettyPhoto" href="'.$large_image[0].'"><i class="fa fa-search"></i></a>';
		$output .= '</div>';
		
		$output .= '</div>';
		$output .= '</div>';
	endwhile;
endif;

echo $output;
