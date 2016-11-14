<?php

function ultra_premium_upgrade_content($content){
	$content['premium_title'] = __('Upgrade to Ultra Premium', 'ultra');
	$content['premium_summary'] = __("Hi, my name is Andrew Misplon, the developer of Ultra. If you've enjoyed Ultra Free then I know you're going to love Ultra Premium. Below you'll find an outline of the premium features.", 'ultra');

	$content['buy_url'] = 'http://puro.fetchapp.com/sell/1981f82c';
	$content['premium_video_poster'] = get_template_directory_uri().'/upgrade/poster.jpg';

	$content['features'] = array();

	$content['features'][] = array(
		'heading' => __('Premium Email Support', 'ultra'),
		'content' => __("Ultra Premium comes with priority email support. Let us know if you run into any challenges or simply need a hand getting setup. We're here to help.", 'ultra'),
	);

	$content['features'][] = array(
		'heading' => __('Name the Price', 'ultra'),
		'content' => __("You choose the price, so you can pay what Ultra is worth to you. Choose from one our suggested options or specify your own custom price. Regardless of what you pay you'll receive the same premium upgrade and be supporting the continued development of the theme.", 'ultra'),
	);

	$content['features'][] = array(
		'heading' => __("Retina Logo", 'ultra'),
		'content' => __("Ultra Premium allows you to upload an additional, double-sized logo, to be displayed on Apple Retina and other high pixel density displays.", 'ultra'),
	);

	$content['features'][] = array(
		'heading' => __('Enhanced Customizer Integration', 'ultra'),
		'content' => __("Make Ultra your own with enhanced Customizer integration. Choose from Google's huge selection of fonts; change colors, spacing and more all using the live-updating WordPress Customizer.", 'ultra'),
		'image' => get_template_directory_uri().'/upgrade/teasers/customizer.png',
	);	

	$content['features'][] = array(
		'heading' => __("Ajax Comments", 'ultra'),
		'content' => __("Remove page re-loads from your comment forms. This means that users can submit comments without losing their place in a gallery or interrupting a video.", 'ultra'),
		'image' => get_template_directory_uri().'/upgrade/teasers/ajax-comments.png',
	);

	$content['features'][] = array(
		'heading' => __("Post Sharing", 'ultra'),
		'content' => __("Add sharing icons for Facebook, Twitter, Google Plus and LinkedIn to the bottom of your posts.", 'ultra'),
		'image' => get_template_directory_uri().'/upgrade/teasers/social-sharing.png',
	);

	$content['features'][] = array(
		'heading' => __('Remove Attribution Link', 'ultra'),
		'content' => __('Ultra Premium gives you the option to remove the "Theme by Puro" text from your Footer without editing any code.', 'ultra'),
		'image' => get_template_directory_uri().'/upgrade/teasers/attribution.png',
	);		

	$content['features'][] = array(
		'heading' => __("Continued Updates", 'ultra'),
		'content' => __("Your premium upgrade is a valuable contribution to the future development of Ultra, ensuring it's compatible with future versions of WordPress.", 'ultra'),
		'image' => get_template_directory_uri().'/upgrade/teasers/updates.png',
	);			

	$content['testimonials'] = array(
		array(
			'gravatar' => '07079067e6b88e8d2a2a1fa886e50b98',
			'name' => 'Cloudontap',
			'title' => 'Beautiful Theme, Top-Notch Support!',
			'content' => __("<p>LOVE this theme - so many options, and so gorgeous! I HIGHLY suggest submitting a question on their support forum if you run into any problems - they respond within minutes to my questions! Doesn't get much better than that. Thanks for all of your help, Andrew, and thank you for the awesome theme!</p>", 'ultra'),
		),
		array(
			'gravatar' => '054d90a54412053c65f897b01f367e4b',
			'name' => 'AJR Computing',
			'title' => 'Amazing Responsive Theme, with Awesome Support!',
			'content' => __("<p>The Ultra WordPress theme looks awesome and the best part is it's a free theme, I really love this theme and my site is starting to come together and looks really sharp thanks to this amazing theme also the theme designer Andrew Misplon from Puro themes provided me with great support when I needed assistance in setting up a few things.</p>", 'ultra'),
		),					
		array(
			'gravatar' => '69d81ec04f082b1c3437e8473d78e63b',
			'name' => 'Rob Hope',
			'title' => 'Good Responsive Design and Meta Slider Integration',
			'content' => __("<p>Great to see a solid follow up to Misplon's first theme Puro. Ultra has a good responsive design and that home page slider works lovely even on big resolution screens - not to mention seamless integration into the free MetaSlider plugin.</p>", 'ultra'),
		),
		array(
			'gravatar' => '1bc72295a0b339d59610b7e1ac0bead2',
			'name' => 'Wccwts',
			'title' => 'Responsive',
			'content' => __("<p>Theme is very responsive and so is the support. Highly recommended!.</p>", 'ultra'),
		),				
	);	

	return $content;
}
add_filter('siteorigin_premium_content', 'ultra_premium_upgrade_content');