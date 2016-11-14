<?php 

	get_header(); 

	global $themename;  

	global $shortname;  

?>

<!-- #Container Area -->

<div id="container" class="clearfix">

	<div class="container_24 clearfix">

	  <div class="grid_24">

		<div class="skt-breadcrumb grid_11">

			<?php if ((class_exists('biznez_lite_breadcrumb_class'))) {$biznez_breadcumb->biznez_lite_custom_breadcrumb();} ?>

		</div>

		<?php if(have_posts()) : ?>

		<?php while(have_posts()) : the_post(); ?>

			<div class="pagetitle-wrap clearfix">

				<div class="page-title grid_11">

					<?php the_title(); ?>

				</div>

			</div>

		<!--pagetitle-warp-->

		<!-- Content -->

		<div id="content" class="grid_16 alpha">

			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			
				<?php  if(has_post_thumbnail()){ ?>
					<div class="post-image clearfix">
						<?php the_post_thumbnail('full'); ?>
					</div>
				<?php } ?>
				
				<div class="entry-meta">

						<span class="author-name"> <?php _e('Posted by ','biznez-lite'); the_author_posts_link(); ?> </span><?php echo '|'; ?>

						<span class="date-time"><?php the_time('l, j F, Y') ?> </span> <?php echo '|'; ?>	

						<span class="comment"> <?php comments_popup_link(__('No Comments','biznez-lite'), __('1 Comment','biznez-lite'), __('% Comments ','biznez-lite')) ; ?> </span>					

						<span> <?php edit_post_link(__( 'Edit', 'biznez-lite' ),'|','') ; ?></span>

				</div> 

				<div class="entry clearfix">

					<?php the_content(); ?>

					 <div class="post-tags clearfix">
						<?php _e('This entry was posted in ','biznez-lite');?><?php the_category(', '); ?>
						<?php the_tags(__(' and tagged ','biznez-lite')); ?>

					</div>

					<?php wp_link_pages( array('before' => '<p><strong>'.__('Pages :','biznez-lite').'</strong>','after' => '</p>', __('number','biznez-lite') ) ); ?>

				</div>

				<div class="comments-template">

					<?php comments_template(); ?>

				</div>

			</div>	

			<?php endwhile; ?>

			<div class="navigation">

			<span class="nav-previous"><?php previous_post_link('&laquo; %link'); ?></span>

			<span class="nav-next"><?php next_post_link(' %link &raquo;'); ?></span>

			</div>

			<?php else : ?>

			<div class="post"><h2><?php _e('Not Found','biznez-lite'); ?></h2></div>

			<?php endif; ?>		

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