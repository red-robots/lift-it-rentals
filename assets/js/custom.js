/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	/*
	*
	*	Smooth Scroll to Anchor
	*
	------------------------------------*/
	$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
	    if (
	      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
	      && 
	      location.hostname == this.hostname
	    ) {
	      // Figure out element to scroll to
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	      // Does a scroll target exist?
	      if (target.length) {
	        // Only prevent default if animation is actually gonna happen
	        event.preventDefault();
	        $('html, body').animate({
	          scrollTop: target.offset().top
	        }, 1000, function() {
	          // Callback after animation
	          // Must change focus!
	          var $target = $(target);
	          //$target.focus();
	          if ($target.is(":focus")) { // Checking if the target was focused
	            return false;
	          } else {
	            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
	            //$target.focus(); // Set focus again
	          };
	        });
	      }
	    }
	});

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
	/*
	*
	*	Isotope with Images Loaded
	*
	------------------------------------*/
	var $container = $('#container').imagesLoaded( function() {
  	$container.isotope({
    // options
	 itemSelector: '.item',
		  masonry: {
			gutter: 15
			}
 		 });
	});

	
	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

	$(document).on("click",".menu-toggle",function(e){
		e.preventDefault();
		$("body").toggleClass('mobile-menu-open');
	});

	$('.menu a[href*="#"]').not('[href="#"]').not('[href="#0"]').each(function(){
		
		var target = $(this.hash);
		var hash_name = target.selector;
		var pageURL = siteURL + '/about/our-team/' + hash_name;
		$(this).attr('href',pageURL);

	});

	$("#image_map map").imageMapResize();
	$("#svc_map area").hover( 
		function(){
			var id = $(this).attr("id");
			var img = $('.img_' + id).addClass('hover');
			var img_src_hover = $('#img_'+id).attr('data-image');
			$("#main_image").attr('src',img_src_hover);
			$("#canvasdiv").attr('style','background-image:url('+img_src_hover+')');
		
			$(".info_"+id).trigger("mouseover");

		}, function() {
			var id = $(this).attr("id");
			var orig_image = $("#main_image").attr('data-orig');
			$("#main_image").attr('src',orig_image);
			$("#canvasdiv").attr('style','background-image:url('+orig_image+')');

			$(".info_"+id).trigger("mouseout");
		}
	);

	$(".graphic-info").hover(
		function(){
			var id = $(this).attr("data-step");
			var img = $('.img_' + id).addClass('hover');
			var img_src_hover = $('#img_'+id).attr('data-image');
			$("#main_image").attr('src',img_src_hover);
			$("#canvasdiv").attr('style','background-image:url('+img_src_hover+')');
		}, function() {
			var id = $(this).attr("data-step");
			var orig_image = $("#main_image").attr('data-orig');
			$("#main_image").attr('src',orig_image);
			$("#canvasdiv").attr('style','background-image:url('+orig_image+')');
		}
	);

	$('.tooltip').tooltipster({
		interactive: true,
		maxWidth: 300,
		functionReady: function(){
			$('.tooltipster-base').addClass('graph-tooltip');
		}
	});

	
	align_grey_div();

	$(window).resize(function(){
	  align_grey_div();
	});

	function align_grey_div() {
		$(".about-inside-icon").each(function(){
			var h = $(this).outerHeight();
			var heightPx = h + 'px';
			$(".greydivbg").attr('style','height:'+heightPx);
		});
	}

	



});// END #####################################    END