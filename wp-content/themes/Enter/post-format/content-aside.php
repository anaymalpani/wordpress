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

    	        <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
                    <div class="featured-image">
                            <?php the_post_thumbnail('blog-large', array('class' => 'img-responsive img-blog')); ?>
                    
                        <span class="date"><?php the_time('M'); ?><span><?php the_time('d'); ?></span></span>
                        <span class="post-type"><i class="fa fa-picture-o"></i><span>Image Post</span></span>
                    </div>
                <?php } else{ //.entry-thumbnail ?>
                    <div class="no-image">
                        <span class="date"><?php the_time('M'); ?><span><?php the_time('d'); ?></span></span>
                    </div>
                <?php } ?>

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