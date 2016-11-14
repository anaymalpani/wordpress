<?php global $shortname; ?>

<script type="text/javascript">

//Jcarousel jQuery
(function($){
	$.fn.sketchslider = function(config){
	
		var defaults = {
			'autoscroll': 0,
			'slides'    : '3',
			'delay'     : '6000',
			'tspeed'    : '1000',
			'hoverpause': 1
		};
		
		var base = this,
		sktslider = {},
		startCycle,
		obj = $(this),
		objWrap = obj.find('ul.skt-slider-wrap');
		
		this.sktslider_initShow = function()
		{
			sktslider.options = $.extend({}, defaults, config);
			
			//Declare required vb's
				var slide = obj.find('li.skt-slide'),
				count = slide.length,
				slideWidth = obj.find('li.skt-slide:first').outerWidth(true),
				slideHeight = obj.find('li.skt-slide:first').outerHeight(true),
				tSlidesW = (count*slideWidth),
				vSlides = sktslider.options.slides * slideWidth,
				stopPosition = tSlidesW - vSlides,
				startSlider,nextnav,prevnav;

			//set css for obj's element
			obj.css({'position':'relative','overflow':'hidden','width':vSlides,'height':slideHeight,'text-align':'center'});
			objWrap.css({'height':slideHeight,'position':'relative','left':0,'width':tSlidesW,'visibility':'visible'});
			
			
			// auto play function
			function startSlider(){
				startCycle = setInterval(function(){
						if(objWrap.position().left > -stopPosition && !objWrap.is(":animated"))
							objWrap.animate({left: "-=" + slideWidth},sktslider.options.tspeed);
						else
							objWrap.animate({left: 0},sktslider.options.tspeed);
				}, sktslider.options.delay);
			}

			controlSlider = function(){
				clearInterval(startCycle);
				if(sktslider.options.autoscroll){
					startSlider();
				}
			}
			
			//bulid navigation
			if(count > 1){
				obj.after('<div class="skt-slide-controls"><a href="javascript:void(0)" class="skt-prev-slide">Prev Slide</a><a href="javascript:void(0)" class="skt-next-slide">Next Slide</a></div>')
				obj.next('div.skt-slide-controls').css({'margin':'0 auto','width':vSlides});
				
				nextnav = obj.next('div.skt-slide-controls').find('a.skt-next-slide');
				prevnav = obj.next('div.skt-slide-controls').find('a.skt-prev-slide');
				
				prevnav.on('click',function(){
					if(objWrap.position().left < 0 && !objWrap.is(":animated"))
						objWrap.stop().animate({left: "+=" + slideWidth},sktslider.options.tspeed);
					else
						objWrap.stop().animate({left: -stopPosition},sktslider.options.tspeed);
					controlSlider();
				});
				
				nextnav.on('click',function(){
					if(objWrap.position().left > -stopPosition && !objWrap.is(":animated"))
						objWrap.stop().animate({left: "-=" + slideWidth},sktslider.options.tspeed);
					else
						objWrap.stop().animate({left: 0},sktslider.options.tspeed);
					controlSlider();
				});
				
				if(sktslider.options.autoscroll){
					startSlider();
				}
			}
			
			//pause on hover
			if(count > 1 && sktslider.options.hoverpause){
				objWrap.hover(function(){
					clearInterval(startCycle);
					},function(){ 
					startSlider();
				});
			}
		}	
		
		//Reload the current slideshow
		this.reloadShow = function(options){
			if (options != undefined) config = options;
			base.sktslider_destroyShow();
			base.sktslider_initShow();
		}
		
		
		//Destroy the current slideshow
		this.sktslider_destroyShow = function(){			
			// stop the auto show
			clearInterval(startCycle);
			// remove any controls / pagers that have been appended
			$('.skt-slide-controls').remove();
			$('.skt-slide-controls',obj,objWrap).removeAttr('style');
		}
	
		return this.each(function(){
			base.sktslider_initShow();
		});
	};

})(jQuery);

var sktslider;

jQuery(document).ready(function(){

//call Jcarousel jQuery
	sktslider = jQuery('#skt-slider').sketchslider({
			'autoscroll':<?php echo esc_attr( get_theme_mod('_show_auto', '0') ); ?>,
			'slides':'4',
			'delay':  <?php echo esc_attr( get_theme_mod('_janimation', '1000') ); ?>,
			'tspeed'    : <?php echo esc_attr( get_theme_mod('_tspeed', '1000') ); ?>,
			'hoverpause': <?php echo esc_attr( get_theme_mod('_hide_jcnavigation', '0') ); ?>
		});	

});


jQuery(window).bind('orientationchange', function(event) {
//call Jcarousel jQuery
		sktslider.reloadShow({
			'autoscroll':<?php echo esc_attr( get_theme_mod('_show_auto', '0') ); ?>,
			'slides':'4',
			'delay':  <?php echo esc_attr( get_theme_mod('_janimation', '1000') ); ?>,
			'tspeed'    : <?php echo esc_attr( get_theme_mod('_tspeed', '1000') ); ?>,
			'hoverpause': <?php echo esc_attr( get_theme_mod('_hide_jcnavigation', '0') ); ?>
		});	

});

</script>