/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	/*
        FAQ dropdowns
	__________________________________________
	*/
	$('.question').click(function() {
	 
	    $(this).next('.answer').slideToggle(500);
	    $(this).toggleClass('close');
	    $(this).find('.plus-minus-toggle').toggleClass('collapsed');
	    $(this).parent().toggleClass('active');
	 
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


});// END #####################################    END
jQuery(document).ready(function ($) {
	
	/* LOAD NEXT POSTS (NEWS) */
	$(document).on("click","#more-posts",function(e){
		e.preventDefault();
		var target = $(this);
		var contentDiv = $("#news_entries");
		var divheight = contentDiv.outerHeight();
		var c_height = parseInt(divheight);
		var currentpage = target.attr('data-currentpage');
		var limit = target.attr('data-perpage');
		var expand = target.attr('data-expand');
		$.ajax({
			type : "post",
			dataType : "json",
			url : myAjax.ajaxurl,
			data : {
				action: "load_more_news", 
				page : currentpage,
				perpage: limit
			},
			success: function(obj) {
				var content = obj.content;
				var pagenext = obj.pagenext;
				var total = obj.total_pages;
				if(content) {
					contentDiv.append(content);
					var page_class = ".page__" + pagenext; 
					var pageHeight = $(page_class).outerHeight();
					var new_height = c_height + parseInt(pageHeight);
					var target_new = '<a id="more-posts" data-expand="true" data-perpage="'+limit+'" data-currentpage="'+pagenext+'" href="#"><i></i></a>';
					$(".scrolldowndiv").html(target_new);
					if(expand=='false'){
						contentDiv.css('height',new_height+'px');
					} else {
						contentDiv.animate({ scrollTop: contentDiv.prop("scrollHeight")}, 1000);
					}
					if(total==pagenext) {
						$('.scrolldowndiv').hide();
					}
				} 
				
			}
		});   

	});

});