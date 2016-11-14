jQuery( document ).ready( function( $ ) 
{	
	$( 'div' ).each(function()
	{
		if( $(this).hasClass("progress"))
		{
			var currentId = $(this).attr('id');
			var el = document.getElementById(currentId); // get canvas

			var options = {
			    percent:  el.getAttribute('data-percent') || 25,
			    size: el.getAttribute('data-size') || 110,
			    lineWidth: el.getAttribute('data-line') || 15,
			    rotate: el.getAttribute('data-rotate') || 0,
			    colorProgress: el.getAttribute('color-Progress') || '#232323',
			    colorBackground: el.getAttribute('color-Background') || '#e5e5e5'
			}

			var canvas = document.createElement('canvas');
			canvas.className = "canvas";

			var span = document.createElement('span');
			span.className = "span";
			span.textContent = options.percent + '%';

			var titre = document.createElement('span');
			titre.className = "titre";
			titre.textContent = el.getAttribute('title');

			    
			if (typeof(G_vmlCanvasManager) !== 'undefined') {
			    G_vmlCanvasManager.initElement(canvas);
			}

			var ctx = canvas.getContext('2d');
			canvas.width = canvas.height = options.size;

			el.appendChild(span);
			el.appendChild(canvas);
			el.appendChild(titre);

			ctx.translate(options.size / 2, options.size / 2); // change center
			ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

			//imd = ctx.getImageData(0, 0, 240, 240);
			var radius = (options.size - options.lineWidth) / 2;

			var drawCircle = function(color, lineWidth, percent) {
					percent = Math.min(Math.max(0, percent || 1), 1);
					ctx.beginPath();
					ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
					ctx.strokeStyle = color;
			        ctx.lineCap = 'round'; // butt, round or square
					ctx.lineWidth = lineWidth
					ctx.stroke();
			};

			drawCircle(options.colorProgress, options.lineWidth, 100 / 100);
			drawCircle(options.colorBackground, options.lineWidth, options.percent / 100);			
		}

	});

});
