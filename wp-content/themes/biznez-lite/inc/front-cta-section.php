<?php if( get_theme_mod('_hide_frontcontentbox', 'on') == 'on' ) { ?>
	<div class="CallToAction-bg grid_23 skin-border">
		<div class="callaction-opt skin-bg"></div>
		<div class="CallToAction grid_16">
			<h3><?php echo esc_attr( get_theme_mod('_frontmain_content', __('This is beautiful, Clean and easy to customize, unique, reZsponsive Wordpress theme With lot&#39;s of shortcodes and features and perfectly suitable for any kind of business.','biznez-lite') ) ); ?></h3>
		</div>
		<?php if( get_theme_mod('_frontmain_buttonlink', '#') != '' ) { ?>
		<div class="CallToActionbtn skin-bg grid_6">
			<a href="<?php echo esc_url(get_theme_mod('_frontmain_buttonlink')); ?>"><?php echo esc_attr( get_theme_mod('_frontmain_buttontext', __('Download Theme', 'biznez-lite') ) ); ?></a>
		</div>
		<?php } ?>
	</div> <!--#CallToAction-bg-->
<?php } ?>