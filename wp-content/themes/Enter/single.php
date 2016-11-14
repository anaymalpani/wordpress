<?php get_header(); ?>

    <section id="main" class="container">
        <div class="row">
            <div id="content" class="site-content col-md-9" role="main">

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'post-format/single', get_post_format() ); ?>

                    <?php endwhile; ?>
                    
                <?php else: ?>
                    <?php get_template_part( 'post-format/single', 'none' ); ?>
                <?php endif; ?>

            </div> <!-- #content -->

            <div id="sidebar" class="col-md-3" role="complementary">
                <div class="sidebar-inner">
                    <aside class="widget-area">
                        <?php dynamic_sidebar( 'sidebar' ); ?>
                    </aside>
                </div>
            </div> <!-- #sidebar -->

        </div> <!-- .row -->
    </section> <!-- .container -->

<?php get_footer();