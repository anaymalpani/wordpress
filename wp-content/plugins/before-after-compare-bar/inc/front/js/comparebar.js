(function($){$.fn.comparebar=function(options){var defaults={"effect":"fade"};var options=$.extend(defaults,options);var obj=$(this);return this.each(function(){if(obj.find("a.cbar_ref").length>0&&obj.find("a.cbar_ref").is(":visible"))if(obj.find("a.cbar_ref").html()){var hovr_obj=obj.find(".cbar_images .cimg");obj.find("a.cbar_ref").css({"font-size":"10px","color":"black"});hovr_obj.hover(function(){jQuery(this).find(".cbar_hov_desp").stop(true,true).fadeIn(200)},function(){jQuery(this).find(".cbar_hov_desp").stop(true,
true).fadeOut(200)});var txt_objWt=obj.find(".cabr_bt_titles .cbar_comptxt span").innerWidth();var txt_objWt_hlf=txt_objWt/2-4;obj.find(".cbar_images .cbar_fimg .cbar_imgttl").css("right",txt_objWt_hlf);obj.find(".cbar_images .cbar_simg .cbar_imgttl").css("left",txt_objWt_hlf)}else obj.remove();else obj.remove()})}})(jQuery);
