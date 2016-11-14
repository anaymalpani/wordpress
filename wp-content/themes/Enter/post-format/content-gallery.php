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
				<?php $slides = rwmb_meta('thm_gallery_images','type=image_advanced'); ?>
		        <?php $count = count($slides); ?>
		        <?php if($count > 0): ?>
				<div id="carousel-blog" class="carousel slide" data-ride="carousel">
					<!-- Wrapper for slides -->

					<div class="carousel-inner">
						<?php $slide_no = 1; ?>
						<?php foreach( $slides as $slide ): ?>
						<div class="item <?php if($slide_no == 1){ echo 'active'; }; ?>">
							<?php $images = wp_get_attachment_image_src( $slide['ID'], 'blog-large' ); ?>
							<img class="img-responsive" src="<?php echo $images[0]; ?>" width="100%" alt="" />
						</div>
						<?php $slide_no++ ?>
		                <?php endforeach; ?>
					</div>
					<span class="date"><?php the_time('M'); ?><span><?php the_time('d'); ?></span></span>
					<span class="post-type"><i class="fa fa-picture-o"></i><span>Slider Post</span></span>
					<!-- Controls -->
					<a class="left carousel-blog-control" href="#carousel-blog" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a class="right carousel-blog-control" href="#carousel-blog" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				 <?php endif; ?>	

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
		
	</div><!--/.blog-item-->

</article> <!--/#post-->

