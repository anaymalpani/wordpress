<div class="container_24 clearfix">
	<!-- Content -->
	<div id="content" class="grid_24">
	
		<?php if( get_theme_mod('_hide_testclientbox', 'on') == 'on' ) { ?>
		
		<div id="content_row">
			<div class="front_testimonials grid_11 omega">
				<h3><span class="testmonial-icon titleimg"></span><?php echo esc_attr( get_theme_mod('_front_testmonialheadtxt', __('Testimonials','biznez-lite') ) ); ?></h3>
				<ul id="testimonials_wrap">
					<li>
						<div class="testimonialWraper">
							<div class="testimonial">
								<p><?php echo wp_kses_post( get_theme_mod('_testi1_content', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi imperdiet tortor id ligula vulputate volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.','biznez-lite') ) ); ?></p>
							</div>
							<div class="testifier">
								<p><?php echo wp_kses_post( get_theme_mod('_testau1_name', __('Jack Dowd','biznez-lite') ) ); ?></p>
								<p><a href="<?php echo esc_url( get_theme_mod('_testau1_link', '#') ); ?>" rel="external" target="blank"><?php echo esc_attr( get_theme_mod('_testau1_link_text', __('Stocker','biznez-lite') ) ); ?></a></p>
							</div><!-- end .testimonial -->
						</div><!-- end .testimonialWraper -->
					</li>
					<li>
						<div class="testimonialWraper">
							<div class="testimonial">
								<p><?php echo wp_kses_post( get_theme_mod('_testi2_content', __('In non mollis tortor. Sed libero augue, venenatis vitae lobortis vel, lobortis id dolor. Curabitur iaculis varius elit, accumsan malesuada urna vulputate eget,lobortis id dolor.','biznez-lite') ) ); ?></p>
							</div>
							<div class="testifier">
								<p><?php echo wp_kses_post( get_theme_mod('_testau2_name', __('Rene Merino','biznez-lite') )  ); ?></p>
								<p><a href="<?php echo esc_url( get_theme_mod('_testau2_link', '#') ); ?>" rel="external" target="blank"><?php echo esc_attr( get_theme_mod('_testau2_link_text', __('Amaya Media','biznez-lite') ) ); ?></a></p>
							</div><!-- end .testimonial -->
						</div><!-- end .testimonialWraper -->
					</li>
				</ul>
			</div>

			<!-- Client Section -->
			<div id="clients" class="clients grid_12 omega">
				<div class="clients-right">
					<h3><span class="client-icon titleimg"></span><?php echo get_theme_mod('_client_title', __('Our Clients', 'biznez-lite') ); ?></h3>
					<div class="clients-logo">
						<ul>
							<li>
								<a href="<?php echo esc_url( get_theme_mod('_ourclient_link1', '#') ); ?>">
								<img src="<?php echo esc_url( get_theme_mod('_ourclient_icon1', get_template_directory_uri().'/images/feedburner-3-64.jpg') ) ; ?>" alt=""/>
								</a>
							</li>
							<li>
								<a href="<?php echo esc_url( get_theme_mod('_ourclient_link2', '#') ); ?>">
								<img src="<?php echo esc_url( get_theme_mod('_ourclient_icon2', get_template_directory_uri().'/images/stackoverflow-64.jpg') ); ?>" alt=""/>
								</a>
							</li>
							<li>
								<a href="<?php echo esc_url( get_theme_mod('_ourclient_link3', '#') ); ?>">
								<img src="<?php echo esc_url( get_theme_mod('_ourclient_icon3', get_template_directory_uri().'/images/wordpress-3-64.jpg') ); ?>" alt=""/>
								</a>
							</li>
							<li>
								<a href="<?php echo esc_url( get_theme_mod('_ourclient_link4', '#') ); ?>">
								<img src="<?php echo esc_url( get_theme_mod('_ourclient_icon4', get_template_directory_uri().'/images/github-8-64.png') ); ?>" alt=""/>
								</a>
							</li>
							<li>
								<a href="<?php echo esc_url( get_theme_mod('_ourclient_link5', '#') ); ?>">
								<img src="<?php echo esc_url( get_theme_mod('_ourclient_icon5', get_template_directory_uri().'/images/coroflot-64.jpg') ); ?>" alt=""/>
								</a>
							</li>
							<li>
								<a href="<?php echo esc_url( get_theme_mod('_ourclient_link6', '#') ); ?>">
								<img src="<?php echo esc_url( get_theme_mod('_ourclient_icon6', get_template_directory_uri().'/images/amazon-64.jpg') ); ?>" alt=""/>
								</a>
							</li>
						</ul>
					</div><!-- clients-logo -->
				</div><!-- clients_right -->
			</div><!--clients-->
			<div class="clear"></div>
		</div><!-- content_row -->
<?php } ?>