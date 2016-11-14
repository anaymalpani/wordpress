<?php if ( 'page' == get_option( 'show_on_front' ) ) { ?>

	<?php get_header(); ?>

	<?php get_template_part('inc/front', 'slider-section'); ?>

	<!-- #Container Area -->
	<div id="container" class="clearfix">

		<?php get_template_part('inc/front', 'feature-box-section'); ?>

		<?php get_template_part('inc/front', 'testimonial-section'); ?>

		<?php get_template_part('inc/front', 'cta-section'); ?>

		<div class="clear"></div>

		</div>
		<!--#Content -->
	</div>
	<!-- container_24 -->
	</div>
	<!-- #Container Area -->

	<?php get_footer(); ?>

<?php } else {

	include( get_home_template() );
	
} ?>