<?php 

/*Template Name: Image Gallery*/

get_header();

?>



<div id="image_gallery" >

  <div class="container_24 clearfix"> 

  <!-- Content -->

    <div id="content" class="grid_24">

       <div class="skt-breadcrumb grid_11">
			<?php
				if ((class_exists('skt_breadcrumb_class'))) {$skt_breadcumb->biznez_lite_custom_breadcrumb();}
			?>
		</div>
		<?php if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>
		<div class="pagetitle-wrap clearfix">
			<div class="page-title grid_11">
				<?php the_title(); ?>
			</div>
		</div><!--pagetitle-warp-->

      <div class="post" id="post-<?php the_ID(); ?>" style="float:left;">
		 <?php endwhile; ?>
			<?php else : ?>
			<?php endif; ?>
        <div class="entry">

          <ul class="preview attachment-gallery-wrap">

			<?php  
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(  
				'numberposts' => -1, // Using -1 loads all posts  
				'orderby' => 'menu_order', // This ensures images are in the order set in the page media manager  
				'order'=> 'ASC',  
				'post_mime_type' => 'image', // Make sure it doesn't pull other resources, like videos  
				'post_parent' => $post->ID, // Important part - ensures the associated images are loaded 
				'post_status' => null, 
				'post_type' => 'attachment',
				'paged' => $paged		
			);  
			  
			$images = get_children( $args );  
			// continued below ...  
			?>  
			
			<?php if($images){ ?>  
			<?php foreach($images as $image){ ?>
				<li class="feature_image"><a href="<?php echo $image->guid; ?>" class="zoombox" rel="prettyPhoto"> 
				<img src="<?php echo $image->guid; ?>" alt="<?php echo $image->post_title; ?>" title="<?php echo $image->post_title; ?>" style="height:165px;width:212px;" />   
				<span></span>	
				</a></li>
			<?php } ?> 
			<?php } ?>  

          </ul>

			<div class="clear"></div>
				

        </div>

      </div>

    </div>

    <div class="clear"></div>

  </div>

</div>



<!-- img_gallery -->



<?php get_footer(); ?>