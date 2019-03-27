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