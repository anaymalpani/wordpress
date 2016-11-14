/*global $:false */

jQuery(document).ready(function($){'use strict';
	$("a[data-rel]").prettyPhoto();

	$('.portfolio-items').on('click','.folio-read-more',function(event){
		event.preventDefault();

		var project_url = $(this).data('project_url');

		var link = $(this).data('single_url');
		var full_url = '#portfolio-single-wrap',
			parts = full_url.split("#"),
			trgt = parts[1],
			target_top = $("#"+trgt).offset().top-90;

		$('html, body').animate({scrollTop:target_top}, 900);

		$('#portfolio-single').slideUp(900, function(){
			$(this).load(project_url,function(){
				$(this).slideDown(900);
			});
		});

		return false;
	});

	$('#portfolio-single-wrap').on('click','.close-folio-item',function(){
		
		$("#portfolio-single").slideUp(900);

		return false;
	});
});

jQuery(window).load(function(){

	jQuery(document).ready(function($){'use strict';

		var container 	= $('.portfolio-items'),
			filterItem	= $('.portfolio-filter a');

		// set container
		container.isotope({
			animationEngine: 'jquery',
			animationOptions: {
				duration: 400,
				queue: false
			},
			itemSelector : '.portfolio-item',
			layoutMode: 'fitRows'
		});

		reloadProjects();

		// filter items
		filterItem.on('click',function(){
			var $this = $(this);
			filterItem.removeClass('active');
			$this.addClass('active');

			var selector = $this.attr('data-filter');
			container.isotope({
				filter: selector,
				animationEngine: 'jquery',
				animationOptions: {
					duration: 400,
					queue: false
				}
			});
			reloadProjects();
			return false;
		});

		// return column number
		function columnsNumber() {
			var winWidth = $(window).width(),
				column = 1;

			if ( winWidth > 991 ){
				column = 4;
			}else if ( winWidth > 767 ){
				column = 3;
			}else if ( winWidth > 480 ){
				column = 2;
			}else if ( winWidth < 480 ){
				column = 1;
			}

			return column;
		}

		// set column width
		function resetColumnWidth(){
			var wrapperWidth = $('.portfolio-items').width(),
				columnNumber = columnsNumber(),
				columnWidth = Math.floor(wrapperWidth/columnNumber);

			container.find('.portfolio-item').each(function(){
				$(this).css('width', columnWidth + 'px');
			});
		}

		// relayout items
		function reloadProjects() {
			resetColumnWidth();
			container.isotope('reLayout');
			$("a[data-rel]").prettyPhoto();
		}

		// load more 
		$('.load-more').on('click',function(e){

			var $this = $(this);
			if($this.hasClass('disable')){
				return false;
			}
			$this.addClass('disable');
			$('.ajax-loader').fadeIn(100);

			e.stopImmediatePropagation();

			var href 			= $(this).attr('href'),
				perPage 		= $(this).data('perpage'), // post per page
				totalProject 	= $(this).data('totalproject'); // total page number

			var item 			= $('.portfolio-items').find('.portfolio-item'),
				itemLength 		= item.length,
				pagedNo 		= ( itemLength / perPage ) + 1; // page number

			// ajax 
			$.get(href+'?perpage='+perPage+'&paged='+pagedNo,function(data){
				$('.ajax-loader').fadeOut(200);
				var $newItems = $(data);
				container.isotope('insert', $newItems,function(){
					reloadProjects();
					var newLenght  = $('.portfolio-items').find('.portfolio-item').length;
					if(totalProject == newLenght){
						$('.load-wrap').fadeOut(400,function(){
							$('.load-wrap').remove();
						});
					}
					$this.removeClass('disable');
				});
			});

			return false;
		});
		
		$(window).resize(function () { 
			reloadProjects();			
		});
	});
});