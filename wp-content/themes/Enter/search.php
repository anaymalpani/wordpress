<?php get_header(); ?>

<?php
global $themeum;

$sidebar = 'right';
$content_class = 'col-md-9';
$sidebar_class = 'col-md-3';

if ( isset($themeum['blog_extend']) && ($themeum['blog_extend'] == 1) ) {
    if ($themeum['sidebar_pos'] == 'left') {
        $content_class = 'col-md-9 col-sm-push-3';
        $sidebar_class = 'col-md-3 col-sm-pull-9';
    } else if($themeum['sidebar_pos'] == 'none') {
        $content_class = 'col-md-12';
        $sidebar_class = 'no-display';
    }
}
?>

<section id="main" class="container">
    <div class="row">
        <div id="content" class="site-content <?php echo $content_class; ?>" role="main">

            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                <?php endwhile; ?>
                <div class="col-md-12">
                    <?php echo themeum_pagination(); ?>
                </div>
            <?php else: ?>
                <?php get_template_part( 'post-format/content', 'none' ); ?>
            <?php endif; ?>
        </div> <!-- #content -->

        <div id="sidebar" class="<?php echo $sidebar_class; ?>" role="complementary">
            <div class="sidebar-inner">
                <aside class="widget-area">
                    <?php dynamic_sidebar('sidebar');?>
                </aside>
            </div>
        </div> <!-- #sidebar -->

    </div> <!-- .row -->
</section> <!-- .container -->

<?php get_footer();