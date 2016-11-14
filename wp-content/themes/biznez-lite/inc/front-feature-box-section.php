<?php if( get_theme_mod('_hide_frontboxes', 'on') == 'on' ) { ?>
	<?php if( get_theme_mod('_feature_type', 'normal') == 'normal') { ?>
		<div class="front-page-box clearfix">
			<div class="container_24 clearfix">
				<div class="box-container box-container1 grid_5">
				  <div class="box-img clearfix">
				<?php if( get_theme_mod('_fb1_icon') != '' ) { ?>
					<img class="skin-bg" src="<?php  echo esc_url( get_theme_mod('_fb1_icon') ); ?>" alt="boximg"/>
					<?php } else { ?> <span class="font-icon-first skin-bg"></span> <?php  } ?>
					<div class="box-title"><?php if( get_theme_mod('_fb1_heading', '') != '' ) { echo esc_attr( get_theme_mod('_fb1_heading') ); } else { ?><?php _e('creative','biznez-lite'); } ?></div> 
				  </div>
				  <div class="box-text"><?php if( get_theme_mod('_fb1_content', '') != '' ){ echo wp_kses_post( get_theme_mod('_fb1_content') ); } else { _e('We have the most talented people in house that are excited to start with your new project. It is the drive that makes them creative.','biznez-lite'); } ?></div>
				  <div class="readmorebtn"><a href="<?php if( get_theme_mod('_fb1_link', '#') != '' ){ echo esc_url( get_theme_mod('_fb1_link') ); } ?>"><?php _e('Read more','biznez-lite'); ?></a></div>
				</div><!-- box-container -->

				<div class="box-container box-container2 grid_5">
				  <div class="box-img clearfix">
					<?php if( get_theme_mod('_fb2_icon') != '' ) { ?>
					  <img class="skin-bg" src="<?php  echo esc_url( get_theme_mod('_fb2_icon') ); ?>" alt="boximg"/>
					<?php } else { ?> <span class="font-icon-second skin-bg"></span> <?php  } ?>
					  <div class="box-title"><?php if( get_theme_mod('_fb2_heading', '') != '' ) { echo esc_attr( get_theme_mod('_fb2_heading') ); } else { ?><?php _e('creative','biznez-lite'); } ?></div>
				  </div>
				  <div class="box-text"><?php if( get_theme_mod('_fb2_content', '') != '' ){ echo wp_kses_post( get_theme_mod('_fb2_content') ); } else { _e('We have the most talented people in house that are excited to start with your new project. It is the drive that makes them creative.','biznez-lite'); } ?></div>
				  <div class="readmorebtn"><a href="<?php if( get_theme_mod('_fb2_link', '#') != '' ){ echo esc_url( get_theme_mod('_fb2_link') ); } ?>"><?php _e('Read more','biznez-lite'); ?></a></div>
				</div><!-- box-container -->

				<div class="box-container box-container3 grid_5">
				  <div class="box-img clearfix">
					<?php if( get_theme_mod('_fb3_icon') != '' ) { ?>
					  <img class="skin-bg" src="<?php  echo esc_url( get_theme_mod('_fb3_icon') ); ?>" alt="boximg"/>
					<?php } else { ?> <span class="font-icon-third skin-bg"></span> <?php  } ?>
					  <div class="box-title"><?php if( get_theme_mod('_fb3_heading', '') != '' ) { echo esc_attr( get_theme_mod('_fb3_heading') ); } else { ?><?php _e('creative','biznez-lite'); } ?></div>
				  </div>
				  <div class="box-text"><?php if( get_theme_mod('_fb3_content', '') != '' ){ echo wp_kses_post( get_theme_mod('_fb3_content') ); } else { _e('We have the most talented people in house that are excited to start with your new project. It is the drive that makes them creative.','biznez-lite'); } ?></div>
				  <div class="readmorebtn"><a href="<?php if( get_theme_mod('_fb3_link', '#') != '' ){ echo esc_url( get_theme_mod('_fb3_link') ); } ?>"><?php _e('Read more','biznez-lite'); ?></a></div>
				</div><!-- box-container -->

				<div class="box-container box-container4 grid_5">
				  <div class="box-img clearfix">
					<?php if( get_theme_mod('_fb4_icon') != '' ) { ?>
						<img class="skin-bg" src="<?php  echo esc_url( get_theme_mod('_fb4_icon') ); ?>" alt="boximg"/>
					<?php } else { ?> <span class="font-icon-fourth skin-bg"></span> <?php  } ?>
					<div class="box-title"><?php if( get_theme_mod('_fb4_heading', '') != '' ) { echo esc_attr( get_theme_mod('_fb4_heading') ); } else { ?><?php _e('creative','biznez-lite'); } ?></div>
				  </div>
				  <div class="box-text"><?php if( get_theme_mod('_fb4_content', '') != '' ){ echo wp_kses_post( get_theme_mod('_fb4_content') ); } else { _e('We have the most talented people in house that are excited to start with your new project. It is the drive that makes them creative.','biznez-lite'); } ?></div>
				  <div class="readmorebtn"><a href="<?php if( get_theme_mod('_fb4_link', '#') != '' ){ echo esc_url( get_theme_mod('_fb4_link') ); } ?>"><?php _e('Read more','biznez-lite'); ?></a></div>
				</div><!-- box-container -->
			</div>
		</div>
		
	<?php } else { ?>
	
		<div class="front-page-box clearfix">

			<div class="container_24 clearfix">

				<div class="box-container box-container1 grid_5">

				  <div class="box-img icon-center clearfix">

				  <?php if( get_theme_mod('_fb1_icon', '') != '' ) { ?>

						<div class="front-img-wrap clearfix">

							<img class="skin-bg" src="<?php echo esc_url( get_theme_mod('_fb1_icon') ); ?>" alt="boximg"/>

						</div><!-- front-img-wrap -->

					<?php } else { ?>

						<div class="front-icon-wrap clearfix"><span class="center-font-icon-first skin-bg"></span></div>

					<?php  } ?>

				    <!-- front-icon-wrap -->

					<div class="box-title-center"><?php if( get_theme_mod('_fb1_heading', '') != '' ){ echo esc_attr( get_theme_mod('_fb1_heading') ); } else { ?><?php _e('creative','biznez-lite'); } ?></div> 

				  </div>

				  <div class="box-text-center"><?php if( get_theme_mod('_fb1_content', '') != '' ){ echo wp_kses_post( get_theme_mod('_fb1_content') ); } else { _e('We have the most talented people in house that are excited to start with your new project. It is the drive that makes them creative.','biznez-lite'); } ?></div>

				  <div class="readmorebtn-center"><a href="<?php if( get_theme_mod('_fb1_link', '#') != '' ){ echo esc_url( get_theme_mod('_fb1_link') ); } ?>"><?php _e('Read more','biznez-lite'); ?></a></div>

				</div><!-- box-container -->

				<div class="box-container box-container2 grid_5">

				  <div class="box-img icon-center clearfix">

					<?php if( get_theme_mod('_fb2_icon', '') != '' ) { ?>

						 <div class="front-img-wrap clearfix">

						  <img class="skin-bg" src="<?php  echo esc_url( get_theme_mod('_fb2_icon') ); ?>" alt="boximg"/>

						 </div><!-- front-img-wrap -->

					<?php } else { ?> 

						<div class="front-icon-wrap clearfix"> <span class="center-font-icon-second skin-bg"></span></div><!--front-icon-wrap--> 

					<?php  } ?>

					  <div class="box-title-center"><?php if( get_theme_mod('_fb2_heading', '') != '' ){ echo esc_attr( get_theme_mod('_fb2_heading') ); } else { ?><?php _e('creative','biznez-lite'); } ?></div>

				  </div>

				  <div class="box-text-center"><?php if( get_theme_mod('_fb2_content', '') != '' ){ echo wp_kses_post( get_theme_mod('_fb2_content') ); } else { _e('We have the most talented people in house that are excited to start with your new project. It is the drive that makes them creative.','biznez-lite'); } ?></div>

				  <div class="readmorebtn-center"><a href="<?php if( get_theme_mod('_fb2_link', '#') != '' ){ echo esc_url( get_theme_mod('_fb2_link') ); } ?>"><?php _e('Read more','biznez-lite'); ?></a></div>

				</div><!-- box-container -->

				<div class="box-container box-container3 grid_5">

				  <div class="box-img icon-center clearfix">

					<?php if( get_theme_mod('_fb3_icon', '') != '' ) { ?>

						<div class="front-img-wrap clearfix">

						  <img class="skin-bg" src="<?php  echo esc_url( get_theme_mod('_fb3_icon') ); ?>" alt="boximg"/>

						</div><!-- front-img-wrap -->

					<?php } else { ?> 

					 <div class="front-icon-wrap clearfix">	<span class="center-font-icon-third skin-bg"></span> </div><!--front-icon-wrap-->

					<?php  } ?>

					  <div class="box-title-center"><?php if( get_theme_mod('_fb3_heading', '') != '' ){ echo esc_attr( get_theme_mod('_fb3_heading') ); } else { ?><?php _e('creative','biznez-lite'); } ?></div>

				  </div>

				  <div class="box-text-center"><?php if( get_theme_mod('_fb3_content', '') != '' ){ echo wp_kses_post( get_theme_mod('_fb3_content') ); } else { _e('We have the most talented people in house that are excited to start with your new project. It is the drive that makes them creative.','biznez-lite'); } ?></div>

				  <div class="readmorebtn-center"><a href="<?php if( get_theme_mod('_fb3_link', '#') != '' ){ echo esc_url( get_theme_mod('_fb3_link') ); } ?>"><?php _e('Read more','biznez-lite'); ?></a></div>

				</div><!-- box-container -->

				<div class="box-container box-container4 grid_5">

				  <div class="box-img icon-center clearfix">

					<?php if( get_theme_mod('_fb4_icon', '') != '' ) { ?>

				      	<div class="front-img-wrap clearfix">

						 <img class="skin-bg" src="<?php  echo esc_url( get_theme_mod('_fb4_icon') ); ?>" alt="boximg"/>

						</div><!-- front-img-wrap -->

					<?php } else { ?>

						<div class="front-icon-wrap clearfix"> <span class="center-font-icon-fourth skin-bg"></span> </div><!--front-icon-wrap-->

					<?php  } ?>	

					<div class="box-title-center"><?php if( get_theme_mod('_fb4_heading', '') != '' ){ echo esc_attr( get_theme_mod('_fb4_heading') ); } else { ?><?php _e('creative','biznez-lite'); } ?></div>

				  </div>

				  <div class="box-text-center"><?php if( get_theme_mod('_fb4_content', '') != '' ){ echo wp_kses_post( get_theme_mod('_fb4_content') ); } else { _e('We have the most talented people in house that are excited to start with your new project. It is the drive that makes them creative.','biznez-lite'); } ?></div>

				  <div class="readmorebtn-center"><a href="<?php if( get_theme_mod('_fb4_link', '#') != '' ){ echo esc_url( get_theme_mod('_fb4_link') ); } ?>"><?php _e('Read more','biznez-lite'); ?></a></div>

				 </div><!-- box-container -->

			</div>
		</div>
	<?php }
} ?>