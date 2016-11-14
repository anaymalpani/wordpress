<?php get_header(); ?> 

<!-- #Container Area -->

<div id="container" class="clearfix">

	<div class="container_24 clearfix">

	  <div class="grid_24">

	  <div class="pagetitle-wrap clearfix">

			<div class="page-title grid_11">

				<?php the_title(); ?>

			</div>

			<div class="skt-breadcrumb grid_11">

			<?php

					if ((class_exists('biznez_lite_breadcrumb_class'))) {$biznez_breadcumb->biznez_lite_custom_breadcrumb();}

			?>

			</div>



		</div><!--pagetitle-warp-->

		<!-- Content -->

		<div id="content" class="grid_16 alpha">

			<div class="entry grid_16 alpha">

						<?php woocommerce_content(); ?>

			</div>

		</div>

		<!-- Sider-bar -->

		<div id="sider-bar" class="grid_7 omega"> 

			<?php get_sidebar('woocommerce'); ?>

		</div>

		<!-- Sider-bar -->

	</div>

  </div>

</div>

<!-- #Container Area -->

<?php get_footer(); ?>