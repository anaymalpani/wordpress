<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php global $themeum; ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<?php if(isset($themeum['favicon'])){ ?>
		<link rel="shortcut icon" href="<?php echo $themeum['favicon']; ?>" type="image/x-icon"/>
	<?php }else{ ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri().'/images/plus.png' ?>" type="image/x-icon"/>
	<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
	<div id="page" class="hfeed site">

		<header id="header" class="site-header" role="banner">      
	        <div class="navbar navbar-inverse navbar-fixed-top" role="banner">
	            <div class="container">
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </button>

	                    <a class="navbar-brand" href="<?php echo site_url(); ?>"><h1 class="logo-wrapper">
	                    	<?php
								if (isset($themeum['logo']))
							   {
							   		
									if($themeum['logo_text_en']) {
										echo $themeum['logo_text'];
									}
									else
									{
										if(!empty($themeum['logo'])) {
										?>
											<img class="enter-logo" src="<?php echo $themeum['logo']; ?>" title="">
										<?php
										}else{
											echo get_bloginfo('name');
										}
									}
							   }
								else
							   {
							    	echo get_bloginfo('name');
							   }
							?>
	                    </h1></a>
	                    
	                </div>
	                <div class="collapse navbar-collapse">
	                    <?php if(has_nav_menu('primary')): ?>
							<?php wp_nav_menu( array( 'theme_location' => 'primary','container' => false,'menu_class' => 'nav navbar-nav navbar-right', 'walker' => new Onepage_Walker()) ); ?>
						<?php endif; ?>
	                </div>
	            </div>
	        </div>
	    </header>