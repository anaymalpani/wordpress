jQuery.noConflict();	

//full width slider height	
 jQuery(document).ready(function() {
  jQuery("#featuredfullslider").css({'visibility':'hidden'});
  jQuery(window).resize(function(){
	  var wrap = jQuery("#featuredfullslider").height();
	  var ww = jQuery(window).width();
	  var wh = jQuery(window).width()/3.26;
	 jQuery('#featuredfullslider').attr('style', 'height:'+wh+'px !important');
   });

	jQuery(window).load(function(){
		jQuery("#featuredfullslider").css({'visibility':'visible'});
	});

});


//front Testimonial
(function ($) {
    $.fn.skt_testimonial = function (speed, delay) {
        if (!speed) speed = 500;
        if (!delay) delay = 6E3;
        var sktspeed = speed * 4;
        if (sktspeed > delay) delay = sktspeed;
        var sktquote = $(this),
            sktfirstquo = $(this).filter(":first"),
            sktlastquo = $(this).filter(":last"),
            sktwrapElem = '<div id="quote_wrap"></div>';
        $(this).wrapAll(sktwrapElem);
        $(this).hide();
        $(sktfirstquo).show();
        $(this).parent().css({
            height: $(sktfirstquo).height()
        });
        setInterval(function () {
            if ($(sktlastquo).is(":visible")) {
                var sktnextElem = $(sktfirstquo);
                var sktwrapHeight = $(sktnextElem).height()
            } else {
                var sktnextElem =
                    $(sktquote).filter(":visible").next();
                var sktwrapHeight = $(sktnextElem).height()
            }
            $(sktquote).filter(":visible").fadeOut(speed);
            setTimeout(function () {
                $(sktquote).parent().animate({
                    height: sktwrapHeight
                }, speed)
            }, speed);
            if ($(sktlastquo).is(":visible")) setTimeout(function () {
                $(sktfirstquo).fadeIn(speed * 2)
            }, speed * 2);
            else setTimeout(function () {
                $(sktnextElem).fadeIn(speed)
            }, speed * 2)
        }, delay)
    }
})(jQuery);

 jQuery(document).ready(function() {
	jQuery('#testimonials_wrap li').skt_testimonial();
	jQuery('.menu ul li ul').hover(
		function(){jQuery(this).parent('li').addClass('item_hover');},
		function(){jQuery(this).parent('li').removeClass('item_hover');
	});

});

	

//project link and zoom

jQuery(document).ready(function($){
		jQuery("#mycarousel,.project_wrap").delegate(".project_image", "mouseenter", function(){
		jQuery(this).find("img").stop().animate({ opacity: 0.3 }, 550);
		jQuery(this).find(".link-box").css({"top":"0px","opacity":"0"});
		jQuery(this).find(".link-box").stop().animate({
			top: '+=45%',
			opacity: 1
			}, 700, function() {
			// Animation complete.
			});
	});

	

	jQuery("#mycarousel,.project_wrap").delegate(".project_image", "mouseleave", function(){

		jQuery(this).find("img").stop().animate({ opacity: 1 }, 550);

		jQuery(this).find(".link-box").stop().animate({
			top: '-=45%',
			opacity: 0
			}, 700, function() {
			// Animation complete.
		});
	});
 });


//mobile menu

jQuery(document).ready(function(){
	jQuery('#mainnav').prepend('<div id="menu-icon" class="close">Navigation Menu<ul id="mini-menu"></ul></div>');
	jQuery('#menu-main>li').clone().appendTo('#mini-menu');
	jQuery("#menu-icon").on("click", function(){
		jQuery(this).toggleClass("close", "open").toggleClass("open");
		jQuery("#mini-menu").slideToggle();
	});



});



jQuery(document).ready(function(){

	// Blur images on mouse over

	jQuery(".feature_image a,.post-image a,.lightbox a").hover( function(){ 
		jQuery(this).children("span").stop().animate({ opacity: 0.6 }, "slow"); 
	}, function(){ 
		jQuery(this).children("span").stop().animate({ opacity: 0 }, "slow"); 
	});
});



jQuery(document).ready(function(){

	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed:'normal',
		theme:'facebook',
		slideshow:3000,
		show_title:false,
		autoplay_slideshow: false	

	});

	jQuery("a[rel^='biznezvdo']").prettyPhoto({
		animation_speed:'normal',
		theme:'facebook',
		slideshow:3000,
		show_title:false,
		autoplay_slideshow: false	

	});
	
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		animation_speed:'normal',
		theme:'facebook',
		slideshow:3000,
		show_title:false,
		autoplay_slideshow: false	

	});

});

//add span in widget title

jQuery(document).ready(function(){

	jQuery('.widget-title').wrapInner('<span class="title-border"></span>');

});

//Post title easing effect

jQuery(document).ready( function() {
				jQuery(".widget-area .widget-container:not(.SktFollowContact) li a").hover( function(){ 
					jQuery(this).stop().animate({paddingLeft:18}, 'slow')
				}, function(){ 
					jQuery(this).stop().animate({paddingLeft:12}, 'slow')
				});

				jQuery("#site_map .sitemap-rows ul li a").hover( function(){ 
					jQuery(this).stop().animate({marginLeft:10}, 'slow')
				}, function(){ 
					jQuery(this).stop().animate({marginLeft:0}, 'slow')
				});
			});



//Black abd White effect
jQuery(window).load(function(){
	jQuery('.teammember-wrap,.memberimg').BlackAndWhite({hoverEffect:true,webworkerPath:false});
});

// jQuery Tool Tip 
jQuery(document).ready( function() {
	jQuery('.tooltip').tipTip();
});
//Back to top
jQuery(document).ready( function() {
	jQuery('#back-to-top,#backtop').hide();
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > 100) {
			jQuery('#back-to-top,#backtop').fadeIn();
		} else {
			jQuery('#back-to-top,#backtop').fadeOut();
		}
	});
	jQuery('#back-to-top,#backtop').click(function(){
		jQuery('html, body').animate({scrollTop:0}, 'slow');
	});
});


jQuery(window).load(function() {
	jQuery('#notificationbar').css('background-color','#000');
			
	jQuery('#header').prepend('<div class="noti-push"></div>');
	jQuery("#notificationbar").delay(1000).slideDown(500);
	var height = jQuery("#notificationbar").height();
	jQuery('.noti-push').css('height',height).delay(1000).slideDown(500);
		
	jQuery('.notification-close').click(function() {
		jQuery("#notificationbar").slideUp(500);
		jQuery('.noti-push').css('height',height).slideUp(500);
	});

});