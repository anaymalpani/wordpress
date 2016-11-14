jQuery(document).ready(function() {
	var div = jQuery('#skenav');
	var start = jQuery(div).offset().top;
	jQuery.event.add(window, "scroll", function() {
		var p = jQuery(window).scrollTop();
		var position_st = ((p)>start) ? 'fixed' : 'static';
		if(jQuery('#notificationbar .nbar_wrapper.top:visible').length)
		var pos_top = ((p)>start) ? '43px' : 'auto';
		else
		var pos_top = ((p)>start) ? '0px' : 'auto';
		var wdth = jQuery(window).width() + "px";
		var fullwidth = ((p)>start) ? wdth : '';
		var bg = ((p)>start) ? '#FFFFFF' : 'transparent';
		var pos_left = ((p)>start) ? '0px' : 'auto';
		var remove_class = ((p)>start) ? 'normal-menu' : 'fixed-menu';
		var add_class = ((p)>start) ? 'fixed-menu' : 'normal-menu';
		
		
		
		jQuery(div).removeClass(remove_class).addClass(add_class);
		jQuery(div).css({
			'position' : position_st,
			'width' : fullwidth,
			'top' : pos_top,
			'background-color' : bg,
			'left' : pos_left,
			'margin' : '0 0 0px 0',
			'z-index' : '999'
		});
		jQuery('#floating_logo').css('display',((p)>start) ? 'block' : 'none');
		jQuery('#menu-container').css({'float':'right','padding-top':'0px','width': ((p)>start) ? '816px' : ''});
		jQuery('#menu-container #menu-main').css({'float':'right'});
		jQuery('.fixed-menu').css({'padding-top':'10px'});
		jQuery('.normal-menu').css({'padding-top':'0px'});
	});
});

jQuery(document).ready(function() {
	var div = jQuery('.skenav-mid');
	var start = jQuery(div).offset().top;
	jQuery.event.add(window, "scroll", function() {
		var p = jQuery(window).scrollTop();
		var wdth = "1008px";
		var fullwidth = ((p)>start) ? wdth : '';
		jQuery(div).css({
			'width' : fullwidth,
			'margin' : '0 auto',
			'z-index' : '99',
			'position' : 'relative'
		});
		jQuery('#main').css('margin-top',((p)>start) ? '0px' : 'auto');
	});
});