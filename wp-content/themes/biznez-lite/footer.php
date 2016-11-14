<!-- #Footer Area -->
<div id="footer-area">
	<div class="container_24 clearfix">
		<div class="grid_24">
			<div id="footer" class="page">
				<div id="foot-sidebar">
					<?php get_sidebar('footer'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="bottom_wrapper container_24 clearfix">
		<div id="site-info" class="grid_10"><?php echo wp_kses_post( get_theme_mod('_copyright', __('Proudly Powered by WordPress', 'biznez-lite') ) ); ?></div>
		<div class="owner grid_12"><?php printf( __( '%s Theme By %s', 'biznez-lite' ), 'Biznez', '<a href="'.esc_url('https://sketchthemes.com').'" title="SketchThemes">SketchThemes</a>' ); ?></a></div>
	 </div><!-- #bottom_wrapper -->
</div>
<a href="JavaScript:void(0);" title="<?php _e('Back To Top', 'biznez-lite'); ?>" id="backtop"></a>
<!-- #Footer Area -->
<?php wp_footer(); ?>
</body>
</html>