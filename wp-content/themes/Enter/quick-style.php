<?php
header('Content-type: text/css');

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

global $themeum;

ob_start();

if (isset($themeum))
{
	?>

	body{
		font-family: "<?php echo $themeum['g_select']; ?>";
		font-weight: <?php echo $themeum['body_font_style']['style']; ?>;
		font-size: <?php echo $themeum['body_font_style']['size']; ?>;
		color: <?php echo $themeum['body_font_style']['color']; ?>;
	} /* body typography */

	h1,h2,h3,h4,h5,h6,.plan-name span{
		font-family: "<?php echo $themeum['head_font']; ?>";
		color: <?php echo $themeum['heading_font_style']['color']; ?>;
	}

	.plan-name span,.plan-price span, .btn-search, .btn-plan, input.btn.btn-primary{
		font-family: "<?php echo $themeum['head_font']; ?>";
	}

	<?php
	if ($themeum['custom_wh']) {
	?>
	.enter-logo{
		width:<?php echo $themeum['logo_width']; ?>px;
		height:<?php echo $themeum['logo_height']; ?>px;
	}
	<?php
	}

	// Menu Style
	if ( $themeum['menu_type'] != '' )
	{
	?>
	#header .navbar{
	<?php 
		if ( $themeum['menu_type'] == 'percent' ) {
			$rgb = hex2rgb( $themeum['menu_color'] );
	?>
		background: rgba(<?php echo $rgb['r']; ?>,<?php echo $rgb['g']; ?>,<?php echo $rgb['b']; ?>,<?php echo $themeum['color_percent']; ?>)
	<?php
		}
		else
		{
	?>
			background: <?php echo $themeum['menu_color']; ?>;
	<?php
		}
	?>
	} /* menu style end */
	<?php
	}
	?>

	#header .navbar-nav.navbar-right >li a{
		font-family: "<?php echo $themeum['menu_font']; ?>";
		font-weight: <?php echo $themeum['menu_font_style']['style']; ?>;
		font-size: <?php echo $themeum['menu_font_style']['size']; ?>;
	}

	<?php

	if ($themeum['menu_font_hover']) {
	?>
	#header .navbar-nav.navbar-right >li a{
		color:<?php echo $themeum['menu_font_color']; ?>;
	}

	#header .navbar-inverse .navbar-nav  .active  > a,  
	#header .navbar-inverse .navbar-nav  .active  > a:focus, 
	#header .navbar-nav.navbar-right li > a:hover,
	.navbar-inverse .navbar-nav > .open > a{
	  color: <?php echo $themeum['menu_hover_color']; ?>;
	  border-color: <?php echo $themeum['menu_hover_color']; ?>;
	}
	<?php
	}
	?>

	#footer{
		background:<?php echo $themeum['footer_bg']; ?>;
	} /* end footer style */
	<?php
	/* custom css */
	if ( $themeum['custom_css'] = '')
	{
		echo $themeum['custom_css'];
	}

	$duration = $themeum['slide_interval'];
	$newduration = $themeum['slide_interval'];
	$total_duration = $duration*count($themeum['fade_slider']);

	?>
		.image-slideshow li span{
			 -webkit-animation: imageAnimation <?php echo $total_duration; ?>s linear infinite 0s;
		    animation: imageAnimation <?php echo $total_duration; ?>s linear infinite 0s;
		}

		.image-slideshow li div{
			-webkit-animation: titleAnimation <?php echo $total_duration; ?>s linear infinite 0s;
			animation: titleAnimation <?php echo $total_duration; ?>s linear infinite 0s;
		}

	<?php

	$key = 2;
	$img = 1;
	if ($themeum['fade_slider'])
	{
		foreach ($themeum['fade_slider'] as $value)
		{
		?>
			.image-slideshow li:nth-child(<?php echo $img; ?>) span{
				background-image: url(<?php echo $value['url']; ?>);
			}
			.image-slideshow li:nth-child(<?php echo $key; ?>) span,
			.image-slideshow li:nth-child(<?php echo $key; ?>) div {
			    -webkit-animation-delay: <?php echo $newduration; ?>s;
			    animation-delay: <?php echo $newduration; ?>s;
			}


		<?php
			$key = $key+1;	
			$img = $img+1;	
			$newduration = $newduration+$duration;	
		}
	}
}

$output = ob_get_contents();
ob_end_clean();

echo $output;

/* convert hex color to rgb */

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array( 'r' => $r, 'g' => $g, 'b' => $b );

   return $rgb; 
}
