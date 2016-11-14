<?php 

/*

Template Name: Full Width

*/

get_header(); 

?>



<div id="full_Width" class="container_24 clearfix"> <!-- Content -->



  <div id="content" class="grid_24">



    <div class="skt-breadcrumb grid_11">

		<?php if ((class_exists('biznez_lite_breadcrumb_class'))) {$biznez_breadcumb->biznez_lite_custom_breadcrumb();} ?>

	</div>

    <?php if(have_posts()) : ?>

    <?php while(have_posts()) : the_post(); ?>

	<div class="pagetitle-wrap clearfix">

			<div class="page-title grid_11">

				<?php the_title(); ?>

			</div>

		</div><!--pagetitle-warp-->

    <div class="post" id="post-<?php the_ID(); ?>">



      <div class="entry clearfix">



        <?php the_content(); ?>



        <?php wp_link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>



        <?php edit_post_link( __( 'Edit', 'biznez-lite' ), '<p>', '</p>'); ?>



      </div>



    </div>



    <?php endwhile; ?>



    <?php else :  ?>



    <div class="post">



      <h2>



        <?php _e('Not Found','biznez-lite'); ?>



      </h2>



    </div>



    <?php endif; ?>



    <div class="clear"></div>



  </div>



  <div class="clear"></div>



</div>



<!-- content -->



<?php get_footer(); ?>