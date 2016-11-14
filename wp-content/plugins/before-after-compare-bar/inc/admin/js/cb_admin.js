jQuery(document).ready(function(){

/*-- Upload image jquery start 
--------------------------------------------*/
	var targetfield= '';
	var cbar_send_to_editor = window.send_to_editor;
	jQuery('.cbar_uploadbtn').click(function(){
		targetfield = jQuery(this).prev('.cbar_uploadimg');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery(targetfield).val(imgurl);
			tb_remove();
			window.send_to_editor = cbar_send_to_editor;
		}
		return false;
	});	
/*-------------------------------------------*/

	if (jQuery("#cbar_editwrap").length){
		jQuery('#cbar_editwrap .cbar_bgcolor').farbtastic('#cbar_bgcolor');
	}
	jQuery('html').click(function() {jQuery("#cbar_editwrap .farbtastic").fadeOut('fast');});
	jQuery('#cbar_editwrap .cbar_colsel').click(function(event){
		jQuery("#cbar_editwrap .farbtastic").hide();
		jQuery(this).find(".farbtastic").fadeIn('fast');event.stopPropagation();
	});


});

function cbar_delconfirm(cbar_item){   
	cbar_item = " '"+cbar_item+"' ";
	var cbar_agree = confirm('Are you sure you want to delete ' + cbar_item + ' Comparebar ?');
	return cbar_agree; 
}  
                                                                                    
	