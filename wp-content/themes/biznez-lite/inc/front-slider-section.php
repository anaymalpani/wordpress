<div class="slider-full skin-bg">
	<?php if( get_theme_mod('_slider_type', 'normal' ) == 'normal') { ?>
		<div class="container_24 clearfix">
			<div class="grid_24">
				<!-- #Slider -->
				<div id="slider">
					<div id="featuredslider"> 
						 <?php if( get_theme_mod('_slider_img1', '') != '' ) { ?><img src="<?php echo get_theme_mod('_slider_img1'); ?>"  alt="Skt-slide1" data-caption="#slide-content-1" /><?php } ?>
						 <?php if( get_theme_mod('_slider_img2', '') != '' ) { ?><img src="<?php echo get_theme_mod('_slider_img2'); ?>"  alt="Skt-slide2" data-caption="#slide-content-2" /><?php } ?>
						 <?php if( get_theme_mod('_slider_img3', '') != '' ) { ?><img src="<?php echo get_theme_mod('_slider_img3'); ?>"  alt="Skt-slide3" data-caption="#slide-content-3" /><?php } ?>				 
					</div>
					<!-- Captions for Orbit -->	
					<?php if(get_theme_mod('_content_slider1', '') != '' ) { ?>
						<div class="orbit-caption" id="slide-content-1">
							<div class="content">
							<?php if( get_theme_mod('_slider_title1', '') != '' ) { $title1 = esc_attr( get_theme_mod('_slider_title1') ); } ?>
							<?php if( get_theme_mod('_content_slider1', '') != '' ) { $excerpt1 = wp_kses_post( get_theme_mod('_content_slider1') ); } ?>
							<?php if( get_theme_mod('_slider_link1', '#') != '' ) { $link1 = esc_url( get_theme_mod('_slider_link1') ); } ?>
							<?php if(isset($title1)) { ?>	<div class="title"><a href="<?php echo $link1; ?>"><?php  if (strlen($title1) > 20) { $title1 = substr( $title1, 0 , 20 ) . ".."; echo $title1; } else { echo $title1;} ?></a></div> <?php } ?>
							<?php if(isset($excerpt1)) { ?>	<div class="entry"><?php echo biznez_lite_slider_limit_words($excerpt1, '40'); ?></div><?php } ?>
							</div>
						</div>
					<?php }  ?>
					<?php if( get_theme_mod('_content_slider2', '') != '' ) { ?>
						<div class="orbit-caption" id="slide-content-2">
							<div class="content">
							<?php if( get_theme_mod('_slider_title2', '') != '' ) { $title2 = esc_attr( get_theme_mod('_slider_title2') ); } ?>
							<?php if( get_theme_mod('_content_slider2', '') != '' ) { $excerpt2 = wp_kses_post( get_theme_mod('_content_slider2') ); } ?>
							<?php if( get_theme_mod('_slider_link2', '#') != '' ) { $link2 = esc_url( get_theme_mod('_slider_link2') ); } ?>
							<?php if(isset($title2)) { ?>	<div class="title"><a href="<?php echo $link2; ?>"><?php  if (strlen($title2) > 20) { $title2 = substr( $title2, 0 , 20 ) . ".."; echo $title2; } else { echo $title2;} ?></a></div><?php } ?>
							<?php if(isset($excerpt2)) { ?>	<div class="entry"><?php echo biznez_lite_slider_limit_words($excerpt2, '40'); ?></div><?php } ?>
							</div>
						</div>
					<?php }  ?>
					<?php if( get_theme_mod('_content_slider3', '') != '' ) { ?>
						<div class="orbit-caption" id="slide-content-3">
							<div class="content">
							<?php if( get_theme_mod('_slider_title3', '') != '' ) { $title3 = esc_attr( get_theme_mod('_slider_title3') ); } ?>
							<?php if( get_theme_mod('_content_slider3', '') != '' ) { $excerpt3 = wp_kses_post( get_theme_mod('_content_slider3') ); } ?>
							<?php if( get_theme_mod('_slider_link3', '#') != '' ) { $link3 = esc_url( get_theme_mod('_slider_link3') ); } ?>
							<?php if(isset($title3)) { ?> <div class="title"><a href="<?php echo $link3; ?>"><?php  if (strlen($title3) > 20) { $title3 = substr( $title3, 0 , 20 ) . ".."; echo $title3; } else { echo $title3;} ?></a></div><?php } ?>
							<?php if(isset($excerpt3)) { ?> <div class="entry"><?php echo biznez_lite_slider_limit_words($excerpt3, '40'); ?></div><?php } ?>
							</div>
						</div>
					<?php }  ?>
				</div>
				<!--slider -->
			</div>
		</div>

	<?php } else { ?>

		<!-- #Slider -->
		<div id="slider">
			<div id="featuredfullslider"> 
				<?php if( get_theme_mod('_slider_img1', '') != '' ) { ?><img src="<?php echo get_theme_mod('_slider_img1'); ?>"  alt="Skt-slide1" data-caption="#slide-content-1" /><?php } ?>
				<?php if( get_theme_mod('_slider_img2', '') != '' ) { ?><img src="<?php echo get_theme_mod('_slider_img2'); ?>"  alt="Skt-slide2" data-caption="#slide-content-2" /><?php } ?>
				<?php if( get_theme_mod('_slider_img3', '') != '' ) { ?><img src="<?php echo get_theme_mod('_slider_img3'); ?>"  alt="Skt-slide3" data-caption="#slide-content-3" /><?php } ?>
			</div>
			
			<!-- Captions for Orbit -->	
			<?php if( get_theme_mod('_content_slider1', '') != '' ) { ?>
				<div class="orbit-caption" id="slide-content-1">
					<div class="content">
					<?php if( get_theme_mod('_slider_title1', '') != '' ) { $title1 =  esc_attr( get_theme_mod('_slider_title1') ); } ?>
					<?php if( get_theme_mod('_content_slider1', '') != '' ) { $excerpt1 =  wp_kses_post( get_theme_mod('_content_slider1') ); } ?>
					<?php if( get_theme_mod('_slider_link1', '') != '' ) { $link1 = esc_url( get_theme_mod('_slider_link1') ); } ?>
					<?php if(isset($title1)) { ?> <div class="title"><a href="<?php echo $link1; ?>"><?php  if (strlen($title1) > 20) { $title1 = substr( $title1, 0 , 20 ) . ".."; echo $title1; } else { echo $title1;} ?></a></div><?php } ?>
							<div class="entry"><?php echo biznez_lite_slider_limit_words($excerpt1, '40'); ?></div>
					</div>
				</div>
			<?php } ?>
			<?php if( get_theme_mod('_content_slider2', '') != '' ) { ?>
				<div class="orbit-caption" id="slide-content-2">
					<div class="content">
					<?php if( get_theme_mod('_slider_title2', '') != '' ) { $title2 =  esc_attr( get_theme_mod('_slider_title2') ); } ?>
					<?php if( get_theme_mod('_content_slider2', '') != '' ) { $excerpt2 =  wp_kses_post( get_theme_mod('_content_slider2') ); } ?>
					<?php if( get_theme_mod('_slider_link2', '') != '' ) { $link2 = esc_url( get_theme_mod('_slider_link2') ); } ?>
					<?php if(isset($title2)) { ?>	<div class="title"><a href="<?php echo $link2; ?>"><?php  if (strlen($title2) > 20) { $title2 = substr( $title2, 0 , 20 ) . ".."; echo $title2; } else { echo $title2;} ?></a></div><?php } ?>
							<div class="entry"><?php echo biznez_lite_slider_limit_words($excerpt2, '40'); ?></div>
					</div>
				</div>
			<?php } ?>
			<?php if( get_theme_mod('_content_slider3', '') != '' ) { ?>
				<div class="orbit-caption" id="slide-content-3">
					<div class="content">
					<?php if( get_theme_mod('_slider_title3', '') != '' ) { $title3 =  esc_attr( get_theme_mod('_slider_title3') ); } ?>
					<?php if( get_theme_mod('_content_slider3', '') != '' ) { $excerpt3 =  wp_kses_post( get_theme_mod('_content_slider3') ); } ?>
					<?php if( get_theme_mod('_slider_link3', '') != '' ) { $link3 = esc_url( get_theme_mod('_slider_link3') );  } ?>
					<?php if(isset($title3)) { ?>	<div class="title"><a href="<?php echo $link3; ?>"><?php  if (strlen($title3) > 20) { $title3 = substr( $title3, 0 , 20 ) . ".."; echo $title3; } else { echo $title3;} ?></a></div><?php } ?>
							<div class="entry"><?php echo biznez_lite_slider_limit_words($excerpt3, '40'); ?></div>
					</div>
				</div>
		   <?php } ?>
		</div>
		<!--slider -->
		
	<?php } ?>
</div>
<!-- slider-full -->