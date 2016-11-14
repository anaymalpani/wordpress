<?php 

get_header(); 

global $themename; global $shortname; 

?>

		<div id="container" class="clearfix">

		  <div class="container_24 clearfix">

			<div class="grid_24">

			<!-- Content -->

			 <div class="pagetitle-wrap grid_24 clearfix">

						<div class="page-title grid_11">

						<?php if(is_page()){single_post_title();}else{ _e('Blog','biznez-lite');}  ?>

						</div>

					</div><!--pagetitle-warp-->

			 <div id="content" class="grid_16 alpha">

					<?php if(have_posts()) : ?>

					<?php 

					while(have_posts()) : the_post(); ?>

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>" >

					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

					<div class="post-image clearfix">

						<?php

						if(has_post_thumbnail())

							{ ?>

						<?php $thumbsrc = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ,'full'); 

						?>

						<a href="<?php echo $thumbsrc; ?>" class="zoombox" data-rel="prettyPhoto"><img src="<?php echo $thumbsrc;?>" alt="blog-thumbnail" style="height: 270px;" /><span></span></a>

						<?php } ?>

					</div>

					<div class="entry-meta">

							<span class="author-name"> <?php _e('Posted by ','biznez-lite'); the_author_posts_link(); ?> </span><?php echo '|'; ?>

							<span class="date-time"><?php the_time('l, j F, Y') ?> </span> <?php echo '|'; ?>	

						  <span class="comment"> <?php comments_popup_link(__('No Comments','biznez-lite'), __('1 Comment','biznez-lite'), __('% Comments ','biznez-lite')) ; ?> </span>					

					</div> 

					<div class="entry clearfix">

							<?php the_excerpt(); ?>
							<?php wp_link_pages( array('before' => '<p><strong>'.__('Pages :','biznez-lite').'</strong>','after' => '</p>', __('number','biznez-lite') ) ); ?>
							<div class="readmore"><a href="<?php echo get_permalink($post->ID); ?>"><?php _e('Read More &rarr;','biznez-lite'); ?></a></div>

					</div>

					</div>

					<div class="clearfix"></div>

					<?php endwhile; ?>

					<div class="navigation">

						<?php if(function_exists('biznez_lite_pagenavi') && get_theme_mod('_show_pagenavi', 'on') == 'on' ) { biznez_lite_pagenavi();} else { ?>

						<div class="alignleft"><?php previous_posts_link('&larr;Previous') ?></div>

						<div class="alignright"><?php next_posts_link('Next&rarr;','') ?></div>

						<?php } ?>

					</div>

					<?php else : ?>

					<div class="post">

					<h2><?php _e('Not Found','biznez-lite'); ?></h2>

					</div>

					<?php endif; ?>

			</div>

	<!-- content -->

	<!-- Sidebar -->

			<div id="siderbar" class="grid_7 omega">

				<?php get_sidebar(); ?>	

            </div>				

			<div class="clear"></div>

	<!-- Sidebar -->

	</div>

  </div>

</div>

<?php get_footer(); ?>