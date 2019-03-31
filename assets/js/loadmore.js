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


	/* LOAD STAFF DETAILS */
	$(document).on("click",".staff-info-link,.click-photo",function(e){
		e.preventDefault();
		var id = $(this).attr('data-pageid');
		$.ajax({
			type : "post",
			dataType : "json",
			url : myAjax.ajaxurl,
			data : {
				action: "staff_details", 
				post_id : id,
			},
			beforeSend: function(){
				$(".ml-loader-wrap").show();
			},
			success: function(obj) {
				var content = obj.content;
				if(content) {
					$('body').prepend(content);
					$('#popUp').fadeIn('normal');;
					$('body').addClass('open-modal');
				} 
				$(".ml-loader-wrap").hide();
			}
		}); 

	});

	/* Close pop-up */
	$(document).on("click","#close-modal,#popUpBg",function(e){
		e.preventDefault();
		$('body').removeClass('open-modal');
		$("#popUp").fadeOut('normal',function(){
			$(this).remove();
		});
	});

	$(document).keyup(function(e) {
	    if (e.key === "Escape") { // escape key maps to keycode `27`
			if( $("#popUp").length>0 ) {
				$('body').removeClass('open-modal');
				$("#popUp").fadeOut("fast",function(){
					$(this).remove();
				});
			}
	    }
	});

});