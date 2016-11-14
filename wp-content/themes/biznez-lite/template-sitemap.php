<?php 

/*

Template name: Sitemap

*/ 

get_header(); ?>

<!-- #Container Area -->

<div id="container" class="clearfix">

	<div class="wrapper container_24 clearfix">

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

		<div id="content" class="grid_16 alpha">

		 <?php endwhile; ?>

			<?php else : ?>

			<?php endif; ?>	

			<!-- SiteMap -->

			<div id="site_map" class="clearfix">

				<!-- First Column -->

				<div class="sitemap-first sitemap-rows">

					<div class="left_site sitemap-box">

						<div class="title"><?php _e('Pages','biznez-lite');?></div>

						<ul><?php wp_list_pages('title_li='); ?></ul>

					</div>

					<div class="mid_site sitemap-box">

						<div class="title"><?php _e('Categories','biznez-lite');?></div>

						<ul><?php wp_list_categories('title_li='); ?></ul>

					</div>

					<div class="right_site sitemap-box">

						<div class="title"><?php _e('Blog Entries','biznez-lite');?></div>

						<ul>

						<?php

						$args=array(

						'post_type'=>'post',

						'posts_per_page'=>-1

						);

						// The Query

						$the_query = new WP_Query( $args );

						// The Loop

						while ( $the_query->have_posts() ) : $the_query->the_post();

						echo '<li>';

						?>

						<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>

						<?php

						echo '</li>';

						endwhile;

						// Reset Post Data

						wp_reset_postdata();

						?>

						</ul>	

					</div>

				</div>

				<!-- First Column -->

				<!-- Second Column -->

				<div class="sitemap-second sitemap-rows">

					<div class="post-heading title"><?php _e('Posts Per Category','biznez-lite');?></div>

					<?php

					$args = array(

					'post_type'                     => 'post',

					'child_of'                 => 0,

					'orderby'                  => 'name',

					'order'                    => 'ASC',

					'hide_empty'               => 1,

					'taxonomy'                 => 'category'

					);

					$categories=  get_categories($args);

					$count=1;

					foreach($categories as $category) {

					?>

					<div class="<?php if($count%3==1){ echo "left_site";}?> <?php if($count%3==2){ echo "mid_site";}?> <?php if($count%3==0){ echo "right_site";}?> sitemap-box">

						<div class="title"><?php echo $category->cat_name;?></div>

						<ul>

							<?php

							$args=array(

							'post_type'=>'post',

							'cat'=>$category->term_id,

							'posts_per_page'=>-1

							);

							// The Query

							$the_query = new WP_Query( $args );

							// The Loop

							while ( $the_query->have_posts() ) : $the_query->the_post();

							echo '<li>';

							?>

							<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>

							<?php

							echo '</li>';

							endwhile;

							// Reset Post Data

							wp_reset_postdata();

							?>

						</ul>

					</div>

					 <?php

					 $count++;

					 }

					 ?>

				 </div>

				<!-- Second Column -->	

			</div>

			<!-- SiteMap -->

		</div>

		<!-- content -->

		<!-- Sidebar -->

		<div id="sider-bar" class="grid_6 omega">

			<?php get_sidebar(); ?>

		</div>

		<!-- Sidebar -->

	</div>

</div>

<!-- #Container Area -->

<?php get_footer(); ?>