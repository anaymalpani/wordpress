<?php
//-- Updated Comparebar options -----------------------------------------------
//-----------------------------------------------------------------------------
if (isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated']=="true") {
    $cbar_message = '<div class="cbar_updated" id="cbar_message">Settings Saved</div>';
}

//-- Edit Comparebar (Function) -----------------------------------------------
//-----------------------------------------------------------------------------
function edit_comparebar(){
    global $cbar_message; 
    $option=$_GET['edit'];
	?>
	<div id="cbar_editwrap" class="wrap cbar_wrap">
		<div class="icon32 cbar_icon"><br /></div>
		<?php 
		if($_GET["edit"]){$option=$_GET['edit'];}
		else{$option='comparebar_options';}
		?>
		<h2><?php _e('Edit','cbar') ?><b style="color:#125E7C"> <?php _e($option); ?> </b><?php _e('Comparebar Options','cbar'); ?></h2>
		
		<?php _e($cbar_message) ?>

		<form class="cbar_editform" method="post" action="options.php">
			<?php 
			wp_nonce_field('update-options'); 
			$options = get_option($option);
			?>
			<div class="metabox-holder">
				<div class="postbox">
				<h3><?php _e("Edit Settings",'cbar'); ?></h3>
					<div id="general" class="inside" style="padding: 15px;margin: 0;">

						<table style="width: 100%" class="cbar_edittbl" >
							<tbody>
								<tr>
									<td><?php _e("BG-Color:",'cbar'); ?></td>
									<td><div class="cbar_colwrap"><input type="text" id="cbar_bgcolor" class="cbar_color_inp" value="<?php if($options['bgcolor']) echo $options['bgcolor']; ?>" name="<?php echo $option; ?>[bgcolor]" /><div class="cbar_colsel cbar_bgcolor"></div></div>
								<tr>
									<td><?php _e("Title:",'cbar'); ?></td>
									<td><input type="text" name="<?php echo $option; ?>[title]" value="<?php echo stripslashes($options['title']); ?>"  /></td>
								</tr>
								
								<tr>
									<td><?php _e("Image Width:",'cbar'); ?></td>
									<td><input type="text" name="<?php echo $option; ?>[img_width]" value="<?php echo $options['img_width']; ?>" size="5"  />&nbsp;<small>(<?php _e('in Pixel','cbar') ?>)</small></td>
								</tr>
								
  							    <tr>
									<td><?php _e("Image Height:",'cbar'); ?></td>
									<td><input type="text" name="<?php echo $option; ?>[img_height]" value="<?php echo $options['img_height']; ?>" size="5" />&nbsp;<small>(<?php _e('in Pixel','cbar') ?>)</small></td>
								</tr>
								
								
								<tr>
									<td><?php _e("Image 1 Title:",'cbar'); ?></td>
									<td><input type="text" name="<?php echo $option; ?>[image1_title]" value="<?php echo stripslashes($options['image1_title']); ?>"  /></td>
								</tr>
								<tr>
									<td><?php _e("Image 1 URL/Path:",'cbar'); ?></td>
									<td>										
										<input type="text" name="<?php echo $option; ?>[image1_path]" class="cbar_uploadimg" value="<?php echo $options['image1_path'] ?>" /><input class="cbar_uploadbtn button" type="button" value="Upload Image" />
									</td>
								</tr>
								<?php if($options['image1_path']){ ?>
								<tr>
									<td></td><td><img class="cbar_disimg" src="<?php echo $options['image1_path'] ?>" /></td>
								</tr>
								<?php } ?>
								
								<tr>
									<td><?php _e("Image 1 Hover Text:",'cbar'); ?></td>
									<td><textarea name="<?php echo $option; ?>[image1_hoverDes]"><?php echo stripslashes($options['image1_hoverDes']); ?></textarea></td>
								</tr>
		
								<tr>
									<td><?php _e("Image 2 Title:",'cbar'); ?></td>
									<td><input type="text" name="<?php echo $option; ?>[image2_title]" value="<?php echo stripslashes($options['image2_title']); ?>"  /></td>
								</tr>
								<tr>
									<td><?php _e("Image 2 URL/Path:",'cbar'); ?></td>
									<td>
										<input type="text" name="<?php echo $option; ?>[image2_path]" class="cbar_uploadimg" value="<?php echo $options['image2_path'] ?>" /><input class="cbar_uploadbtn button" type="button" value="Upload Image" />
									</td>
								</tr>
								<?php if($options['image2_path']){ ?>
								<tr>
									<td></td><td><img class="cbar_disimg"  src="<?php echo $options['image2_path'] ?>" /></td>
								</tr>
								<?php } ?>
								
								<tr>
									<td><?php _e("Image 2 Hover Text:",'cbar'); ?></td>
									<td><textarea name="<?php echo $option; ?>[image2_hoverDes]"><?php echo stripslashes($options['image2_hoverDes']); ?></textarea></td>
								</tr>
								<tr>
									<td><?php _e("Compare Keyword:",'cbar'); ?></td>
									<td><input type="text" name="<?php echo $option; ?>[compare_txt]" value="<?php echo stripslashes($options['compare_txt']); ?>" /></td>
								</tr>
							</tbody>
						</table>
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="<?php echo $option; ?>" />
						<p style="margin:20px 0px 5px 0px;"><input type="submit" class="button button-primary" name="cbar_updated" value="<?php _e('Save Settings') ?>" /></p>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php 
}
?>