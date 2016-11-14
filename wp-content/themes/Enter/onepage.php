<?php
/*
 * Template Name: Frontpage
 */
get_header(); 

?>
<?php
	$current_page_id = get_option('page_on_front'); // get front page id

	// checking menu exist in location "primary"
	if(  ( $locations = get_nav_menu_locations() ) && $locations['primary'] )
	{
		$menu 			= wp_get_nav_menu_object( $locations['primary'] );
		$menu_items 	= wp_get_nav_menu_items( $menu->term_id );

		$post_ids = array();
		foreach ($menu_items as $items) {
			if($items->object == 'page'){
				$post_ids[] = $items->object_id;
			}
		}

		$args = array( 'post_type' => 'page', 'post__in' => $post_ids, 'posts_per_page' => count( $post_ids ), 'orderby' => 'post__in' );
	}
	else
	{
		$args = array( 'post_type' => 'page');
	}

	$allPosts = new WP_Query( $args ); // get pages on menu

	$parallaxId = array();

	if (have_posts()) {
		// Start the Loop.
		while ( $allPosts->have_posts() ) { $allPosts->the_post();
			// set global $post
			global $post;

			$separator 				= get_post_meta( $post->ID, 'thm_no_hash', true );
			$page_section 			= get_post_meta( $post->ID, 'thm_section_type', true );
			$no_title 				= get_post_meta( $post->ID, 'thm_no_title', true );
			$menu_disable 			= get_post_meta( $post->ID, 'thm_disable_menu', true );
			$remove_pad 			= get_post_meta( $post->ID, 'thm_remove_pad', true );
			$page_title 			= get_post_meta( $post->ID, 'thm_page_title', true );
			$page_subtitle 			= get_post_meta( $post->ID, 'thm_page_subtitle', true );

			$pad_class = '';

			if($remove_pad != 1){
				$pad_class = 'page-wrapper ';
			}

			$postId = get_the_ID();

			if(( $separator != 1 ) && ( $postId != $current_page_id ))
			{
				if( $page_section == 'default' ){		// Default Content Page
				?>
					<section id="<?php echo $post->post_name; ?>" class="<?php echo $pad_class; ?>">
						<?php if( $no_title != 1 ){ ?>
							<div class="clearfix title-wrap">
								<h2 class="title"><?php if($page_title != '') { echo $page_title; }else{ echo get_the_title(); } ?> </h2>
							</div>
						<?php }?>
						<div class="container page-content">
							<?php echo do_shortcode(get_the_content()); ?>
						</div> <!-- .container -->
					</section>
				<?php
				}
				elseif( $page_section == 'full' )
				{
				?>
					<div id="<?php echo $post->post_name; ?>" class="<?php echo $pad_class; ?>full-width clearfix">
						<?php if( $no_title != 1 ){ ?>
							<div class="clearfix title-wrap">
								<h2 class="title"><?php if($page_title != '') { echo $page_title; }else{ echo get_the_title(); } ?> </h2>
							</div>
						<?php }?>
						<div class="page-fullwdth-content">	
								<?php echo do_shortcode(get_the_content()); ?>
						</div> <!-- .page-fullwdth-content -->
					</div> <!-- .page-content -->
				<?php
				}
				else
				{
					// Parallax Page
					$image = get_post_meta( $post->ID, 'thm_background_url', true );

					$parallaxId[] = $post->post_name;
				?>
					<section id="<?php echo $post->post_name; ?>" class="<?php echo $pad_class; ?> parallax parallax-section" style="background-image:url('<?php if(isset($image)) echo $image;?>');">
						<?php if( $no_title != 1 ) { ?>
							<div class="clearfix title-wrap">
								<h2 class="title"><?php if($page_title != '') { echo $page_title; }else{ echo get_the_title(); } ?> </h2>
							</div>
						<?php }?>
						<div class="container">
							<?php echo do_shortcode(get_the_content()); ?>
						</div>
					</section> <!-- /.parallax -->
				<?php
				}
			} // check only for one-page item
		}

		wp_reset_query();

		if( !empty( $parallaxId ) )
		{
			function add_my_script()
			{
				global $parallaxId;
				$output ='';
				$output .='<script type="text/javascript">';
				$output .='jQuery(document).ready(function($) {';
				$output .='$(window).load(function(){';
					
				foreach( $parallaxId as $id ){
					$output .='$("#'.$id.'").parallax("50%", 0.5);';
				}

				$output .='})';
				$output .='})';
				$output .='</script>';
				echo $output;
			}

			add_action('wp_footer','add_my_script',100);
		} // add parallax
	}

?>

<?php get_footer(); ?>