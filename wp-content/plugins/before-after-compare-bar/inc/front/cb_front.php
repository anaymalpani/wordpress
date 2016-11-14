<?php
function compareBar($option='comparebar_options'){
	global $wpdb;
	$table_name = $wpdb->prefix . "comparebar"; 
    $cbar_data = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = '".$option."'",ARRAY_A);
	
	if($cbar_data[0]['active'])
	{
		$options = get_option($option);
		$cb_bgcolor = $options['bgcolor'];
		$cb_title = $options['title'];
		$cb_img_width = $options['img_width'];
		$cb_img_height = $options['img_height'];
		$cb_image1_title = $options['image1_title'];
		$cb_image1_path = $options['image1_path'];
		$cb_image1_hoverDes = $options['image1_hoverDes'];
		$cb_image2_title = $options['image2_title'];
		$cb_image2_path = $options['image2_path'];
		$cb_image2_hoverDes = $options['image2_hoverDes'];
		$cb_compare_txt = $options['compare_txt'];
		
		if(empty($cb_img_width) || $cb_img_width==0)$cb_img_width=155;
		if(empty($cb_img_height) || $cb_img_height==0)$cb_img_height=220;
		
		$cbar_wrapWdth = ($cb_img_width*2) + 5;
		
		?>
		<!-- CompareBar Starts Here -->
			<style type="text/css">
				#comparebar.<?php echo $option; ?>{width:<?php echo $cbar_wrapWdth; ?>px}
				#comparebar.<?php echo $option; ?>,#comparebar.<?php echo $option; ?> .cabr_bt_titles .cbar_comptxt span{background:<?php echo $cb_bgcolor; ?>}
				#comparebar.<?php echo $option; ?> .cbar_images .cimg,#comparebar.<?php echo $option; ?> .cbar_images img{width:<?php echo $cb_img_width; ?>px;height:<?php echo $cb_img_height; ?>px;}
			</style>
			
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#comparebar.<?php echo $option; ?>").comparebar();
			});
			</script>
			
			<div id="comparebar" class="<?php echo $option; ?>">
				<?php if($cb_title) { ?><div class="cbar_title"><?php echo $cb_title; ?></div><?php } ?>
				<div class="cbar_images">
					<div class="cbar_fimg cimg">
						<?php if($cb_image1_path) { ?><img src="<?php echo $cb_image1_path; ?>" /><?php } ?>
						<?php if($cb_image1_title) { ?><div class="cbar_imgttl"><?php echo $cb_image1_title; ?></div><?php } ?>
						<?php if($cb_image1_hoverDes) { ?><div class="cbar_hov_desp"><?php echo $cb_image1_hoverDes; ?></div><?php } ?>
					</div>
					<div class="cbar_simg cimg">
						<?php if($cb_image2_path) { ?><img src="<?php echo $cb_image2_path; ?>" /><?php } ?>
						<?php if($cb_image2_title) { ?><div class="cbar_imgttl"><?php echo $cb_image2_title; ?></div><?php } ?>
						<?php if($cb_image2_hoverDes) { ?><div class="cbar_hov_desp"><?php echo $cb_image2_hoverDes; ?></div><?php } ?>
					</div>
					<div class="cbar_clear"></div>
				</div>
				<div class="cabr_bt_titles">
					<?php if($cb_compare_txt) { ?><div class="cbar_comptxt"><span><?php echo $cb_compare_txt; ?></span></div><?php } ?>
					<div class="cbar_clear"></div>
				</div>
				<?php $from_this = "http://www.wpfruits.com/downloads/wp-plugins/compare-bar-before-after-wordpress-plugin/?cbar_refs=".$_SERVER['SERVER_NAME']; ?>
				<a class="cbar_ref" style="background: none repeat scroll 0 0 #EEEEEE !important; border: 1px solid #CCCCCC !important; bottom: -14px !important; color: #000000; display: block !important; font-family: arial !important;outline:none; font-size: 10px !important; height: 8px !important; line-height: 9px !important; padding: 2px !important; position: absolute !important; right: 0 !important; text-decoration: none !important; text-indent: 0 !important; visibility: visible !important;" target="_blank" href="<?php echo $from_this; ?>"><?php _e('CB','cbar'); ?></a> </div> 	
		<!-- CompareBar Ends Here -->
		
		<?php
	}
	else{
		 _e('This <b>'.$option.'</b> Coamparebar is deactivated, please activate it from Comparebar admin panel.','cbar');
	}
}
	
// Add shortcode use [comparebar name='comparebar_options']
function cbar_short_code($atts) {
	ob_start();
    extract(shortcode_atts(array(
		"name" => ''
	), $atts));
	compareBar($name);
	$output = ob_get_clean();
	return $output;
}
add_shortcode('comparebar', 'cbar_short_code');
?>