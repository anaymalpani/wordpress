<?php
/*
 * The Sidebar containing the primary and secondary widget areas.
 */
?>	 
	<!-- #primary .widget-area -->
	<div id="primary" class="widget widget-area" role="complementary">
		<ul class="xoxo">
		<?php dynamic_sidebar( 'primary-widget-area' ); ?>
		</ul>
	</div>
	<!-- #primary .widget-area -->

	<!-- #secondary .widget-area -->
	<div id="secondary" class="widget widget-area" role="complementary">
		<ul class="xoxo">
			<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
		</ul>
	</div>
	<!-- #secondary .widget-area -->
