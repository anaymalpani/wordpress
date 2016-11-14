 <?php 

 get_header();

/*Template name: About page */

?>

<div id="full_Width" class="container_24 clearfix"> <!-- Content -->

  <div id="content" class="grid_24">

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

    <div class="post" id="post-<?php the_ID(); ?>">

      <div class="entry clearfix">

        <?php the_content(); ?>

      </div>

    </div>

    <?php endwhile; ?>

    <?php else :  ?>

    <div class="post">

      <h2>

        <?php _e('Not Found','biznez-lite'); ?>

      </h2>

    </div>

    <?php endif; ?>

    <div class="clear"></div>

 

<div class="our_team_member container_24">

  <h2 class="member_head"><?php echo esc_attr( get_theme_mod('_about_teamhead', __('Our Team member', 'biznez-lite') ) ); ?></h2>



  <div class="row-member clearfix">
	<!--team-container1-->
	<div class="team-container grid_7">

                <div class="member-avatar">
				  <a href="javascript:void(0);" class="teammember-wrap">
					 <img class="memberimg" alt="teammember" src="<?php if(sketch_get_option($shortname.'_tm_img1')){ echo sketch_get_option($shortname.'_tm_img1','biznez-lite'); } ?>" width="180" height="180" />
				  </a>		 
				</div>
				<div class="member-data">
                      <div class="member-name">
                      		<a href="<?php echo esc_url( get_theme_mod('_tm_weblink1', '#') ); ?>"><?php echo esc_attr( get_theme_mod('_tm_name1', __('Member Name', 'biznez-lite') ) ); ?></a>
                       </div>
   						<div class="member-position"><?php echo esc_attr(get_theme_mod('_tm_job1', '') ); ?></div>
						<?php $content1 = wp_kses_post( get_theme_mod('_tm_content1', __('Lorem ipsum dolor sit amet consetteture lap lasefro.', 'biznez-lite') ) ); ?>
						<p><?php echo biznez_lite_slider_limit_words($content1, '20'); ?></p>
						<ul class="teamsocial">
							<?php $fb_url1 = esc_url( get_theme_mod('_tm_fb1', '#') ); ?>
							<?php $tw_url1 = esc_url( get_theme_mod('_tm_tw1', '#') ); ?>
							<?php $drb_url1 = esc_url( get_theme_mod('_tm_drd1', '#') ); ?>
							<?php if( $fb_url1 != '' ) { ?><li><a class="tooltip" title="Facebook" href="<?php echo $fb_url1; ?>"><span class="team-fb"></span></a></li><?php } ?>
							<?php if( $tw_url1 != '' ) { ?><li><a class="tooltip" title="Twitter" href="<?php echo $tw_url1; ?>"><span class="team-tw"></span></a></li><?php } ?>
							<?php if( $drb_url1 != '' ) { ?><li><a class="tooltip" title="Dribble" href="<?php echo $drb_url1; ?>"><span class="team-drb"></span></a></li><?php } ?>
						</ul>
				</div>
	  </div><!--team-container1-->
	  
	  <!--team-container2-->
	<div class="team-container grid_7">

                <div class="member-avatar">
				  <a href="javascript:void(0);" class="teammember-wrap">
					 <img class="memberimg" alt="teammember" src="<?php if(sketch_get_option($shortname.'_tm_img2')){ echo sketch_get_option($shortname.'_tm_img2','biznez-lite'); } ?>" width="180" height="180" />
				  </a>		 
				</div>
				<div class="member-data">
                      <div class="member-name">
                      		<a href="<?php echo esc_url( get_theme_mod('_tm_weblink2', '#') ); ?>"><?php echo esc_attr( get_theme_mod('_tm_name2', __('Member Name', 'biznez-lite') ) ); ?></a>
                       </div>
   						<div class="member-position"><?php echo esc_attr(get_theme_mod('_tm_job2', '') ); ?></div>
						<?php $content2 = wp_kses_post( get_theme_mod('_tm_content2', __('Lorem ipsum dolor sit amet consetteture lap lasefro.', 'biznez-lite') ) ); ?>
						<p><?php echo biznez_lite_slider_limit_words($content2, '20'); ?></p>
						<ul class="teamsocial">
						
							<?php $fb_url2 = esc_url( get_theme_mod('_tm_fb2', '#') ); ?>
							<?php $tw_url2 = esc_url( get_theme_mod('_tm_tw2', '#') ); ?>
							<?php $drb_url2 = esc_url( get_theme_mod('_tm_drd2', '#') ); ?>
							<?php if( $fb_url2 != '' ) { ?><li><a class="tooltip" title="Facebook" href="<?php echo $fb_url2; ?>"><span class="team-fb"></span></a></li><?php } ?>
							<?php if( $tw_url2 != '' ) { ?><li><a class="tooltip" title="Twitter" href="<?php echo $tw_url2; ?>"><span class="team-tw"></span></a></li><?php } ?>
							<?php if( $drb_url2 != '' ) { ?><li><a class="tooltip" title="Dribble" href="<?php echo $drb_url2; ?>"><span class="team-drb"></span></a></li><?php } ?>
						</ul>
				</div>
	  </div><!--team-container2-->
	  
	  <!--team-container3-->
	<div class="team-container grid_7">

                <div class="member-avatar">
				  <a href="javascript:void(0);" class="teammember-wrap">
					 <img class="memberimg" alt="teammember" src="<?php if(sketch_get_option($shortname.'_tm_img3')){ echo sketch_get_option($shortname.'_tm_img3','biznez-lite'); } ?>" width="180" height="180" />
				  </a>		 
				</div>
				<div class="member-data">
                      <div class="member-name">
                      		<a href="<?php echo esc_url( get_theme_mod('_tm_weblink3', '#') ); ?>"><?php echo esc_attr( get_theme_mod('_tm_name3', __('Member Name', 'biznez-lite') ) ); ?></a>
                       </div>
   						<div class="member-position"><?php echo esc_attr(get_theme_mod('_tm_job3', '') ); ?></div>
						<?php  $content3 = wp_kses_post( get_theme_mod('_tm_content3', __('Lorem ipsum dolor sit amet consetteture lap lasefro.', 'biznez-lite') ) ); ?>
						<p><?php echo biznez_lite_slider_limit_words($content3, '20'); ?></p>
						<ul class="teamsocial">
						
							<?php $fb_url3 = esc_url( get_theme_mod('_tm_fb3', '#') ); ?>
							<?php $tw_url3 = esc_url( get_theme_mod('_tm_tw3', '#') ); ?>
							<?php $drb_url3 = esc_url( get_theme_mod('_tm_drd3', '#') ); ?>
							<?php if( $fb_url3 != '' ) { ?><li><a class="tooltip" title="Facebook" href="<?php echo $fb_url3; ?>"><span class="team-fb"></span></a></li><?php } ?>
							<?php if( $tw_url3 != '' ) { ?><li><a class="tooltip" title="Twitter" href="<?php echo $tw_url3; ?>"><span class="team-tw"></span></a></li><?php } ?>
							<?php if( $drb_url3 != '' ) { ?><li><a class="tooltip" title="Dribble" href="<?php echo $drb_url3; ?>"><span class="team-drb"></span></a></li><?php } ?>
						</ul>
				</div>
	  </div><!--team-container3-->

  </div><!--row-member-->



 </div><!-- our_team_member -->

 <?php edit_post_link( __( 'Edit', 'biznez-lite' ) , '<p>', '</p>'); ?>

 </div>

  <div class="clear"></div>

</div>

<!-- content -->



<?php get_footer(); ?>