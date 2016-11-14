<?php



	global $themename; 



	global $shortname;



?>



<?php get_header(); ?>



<!-- #Container Area -->



<div id="container" class="clearfix">



	<div class="container_24 clearfix">



	  <div class="grid_24">



	   <div class="pagetitle-wrap grid_24 clearfix">



			<div class="page-title grid_11">



				<?php _e('Error 404 - Not Found','biznez-lite'); ?>



			</div>

			<div class="skt-breadcrumb grid_11">

			  <?php if ((class_exists('biznez_lite_breadcrumb_class'))) {$biznez_breadcumb->biznez_lite_custom_breadcrumb();} ?>

		    </div>



		</div><!--pagetitle-warp-->



		<!-- Content -->



		<div id="content" class="grid_16 alpha">



            <div class="error-search">



				<?php get_search_form(); ?> 



			</div>



			<div class="clear"></div>



			<span class="not-found-txt"><?php _e('Page Not Found.', 'biznez-lite' ); ?></span>



			<p><?php _e( 'Apologies, but the page you requested could not be found.', 'biznez-lite' ); ?></p>



		</div>



		<!-- Content -->



		<!-- Sider-bar -->



		<div id="sider-bar" class="grid_7 omega"> 



			<?php get_sidebar(); ?>



		</div>



		<!-- Sider-bar -->



	</div>



	</div>



</div>



<!-- #Container Area -->



<?php get_footer(); ?>