<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="blog-item">

        <div class="col-sm-2">
            <div class="entry-meta text-center">
                <?php echo get_avatar( get_the_author_meta('user_email'), $size = '50'); ?>
                <h2><?php the_author_posts_link() ?></h2>
                <hr>
                <span><i class="fa fa-eye"></i> <?php echo get_post_meta(get_the_ID(),'_post_count_key',true); // dont-delete ?> </span>
                <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                <span class="comments-number"> <i class="fa fa-comments-o"></i> <?php echo get_comments_number(get_the_ID()); ?></span>
                <?php endif; //.comment-link ?>
            </div>
        </div>
			
			<div class="col-sm-10">

				<div class="blog-content">
					<div class="featured-image">
						<?php $video_source = rwmb_meta( 'thm_video_source' ); ?>
						<?php $video = rwmb_meta( 'thm_video' ); ?>

						<?php if($video_source == 1): ?>
							<?php echo rwmb_meta( 'thm_video' ); ?>
						<?php elseif ($video_source == 2): ?>
							<?php echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.$video.'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe>'; ?>
						<?php elseif ($video_source == 3): ?>
							<?php echo '<iframe src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="350" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; ?>
						<?php endif; ?>
						<span class="date"><?php the_time('M'); ?><span><?php the_time('d'); ?></span></span>

					</div>

	                 <header class="entry-header">
	                        <h3 class="entry-title">
	                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
	                            <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
	                            <sup class="featured-post"><?php _e( 'Sticky', 'themeum' ) ?></sup>
	                            <?php } ?>
	                        </h3> <!-- //.entry-title -->
	                </header>   
					 <div class="post-content">
			            <?php the_excerpt(); ?>
			        </div>

		        </div><!--/.blog-content-->

			</div>
	</div> <!--/#post-->


</article> <!--/#post-->

