
var $ = jQuery; 

function emailValidation(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

$(document).ready(function(e) { 

	$("input[type='reset']").click(function(){
		 
		 window.location = window.location
		 
	});
	
	$(".es_error").click(function(){
		 $(this).hide();
	});
	
	$('.es_prop_single_tabs ul li a').click(function(){
		
		$('.es_prop_single_tabs ul li a').removeClass('active');
		
		$(this).addClass('active');
 
 		var current_id = $(this).attr('href');
		
		var current_id_pos = parseInt($(current_id).offset().top);
		//alert($(current_id_pos));
		$('html,body').animate({ scrollTop: current_id_pos-58 });
	  
		return false;
		
	});
	
	
	$(".es_close_pop,.es_request_info_popup_overlay").click(function(){
		 $('#es_request_form_popup').fadeOut(500);
		 return false;
	});
	
	$("#es_request_form input[type='submit']").click(function(){
		 
		 var es_request_form_email = $('#es_request_form input[name="your_email"]').val();
		 var es_request_form_message = $('#es_request_form textrea').val();
		 
		 if (es_request_form_email=='' || es_request_form_message=='') {
			$('#request_form_error').text('Please enter your email.').show();
			return false;
		 }
		 
		 if (!emailValidation(es_request_form_email)) {
			$('#request_form_error').text('Email is not valid.').show();
			return false;
		 } else {
			$('#request_form_error').hide();
			return true;
		 }
 
	});
	 
	$('.es_wrapper select').each(function(index, element) {
		var selText = $(this).find('option:selected').text(); 
		$(this).wrap("<div class='es_select'></div>");
 		$(this).parent('.es_select').append('<div class="es_select_arow"></div>');
		$(this).parent('.es_select').find('.es_select_arow').text(selText);
    });
 
	$('.es_wrapper select').change(function(){
		var selText = $(this).find('option:selected').text();
		$(this).parent('.es_select').find('.es_select_arow').text(selText);
	}); 
 
	$('p').each(function() {
		var $this = $(this);
		if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
			$this.remove();
	});
	
	
	$("#es_content #es_map_pop_outer a#es_closePop,#es_content #es_overlay").click(function(){

		$('#es_content #es_map_pop_outer').removeClass('esShow');  
		 
	});
	
	$("#es_toTop a").click(function(){
		$('html,body').animate({scrollTop:0},500);  
		return false; 
	});
	
	/*$(".es_search_select input").blur(function(){
		var obj = $(this);
		setTimeout(function(){
			obj.parents('.es_search_select').removeClass('focus')
		},100)
	});*/
	
	$(".es_search_select span, .es_search_select small").click(function(){
		$(this).parents('.es_search_select').addClass('focus')
		//$(this).parents('.es_search_select').find('input').focus();
	});
	
	$(".es_search_select").mouseleave(function(){
		$(".es_search_select").removeClass('focus')
	});

	$(".es_search_select ul li").click(function(){
		$(this).siblings('li').removeClass('selected');
		$(this).addClass('selected');
		var selVal = $(this).attr('value');
		var selText = $(this).text();
		$(this).parents('.es_search_select').find('span').text(selText);
		$(this).parents('.es_search_select').find('input').val(selVal);
		$(this).parents('.es_search_select').removeClass('focus')
		return false; 
	});
	
	
	$(".es_search_select li.selected").each(function(index, element) {
		var selText = $(this).text();
		$(this).parents('.es_search_select').find('span').text(selText); 
    });
 
	$('.es_wrapper select').change(function(){
		var selText = $(this).find('option:selected').text();
		$(this).parent('.es_select').find('.es_select_arow').text(selText);
	}); 
	
 
});  


function es_map_view_click(obj) {
  
	var mapLatLong = $(obj).attr('href');
	if(mapLatLong!=""){
		var arr = mapLatLong.split(",");
		initialize(arr[0],arr[1]);		 
	}else{
		$('#es_content #es_map').text('Not defined.');
	}
	$('#es_content #es_map_pop_outer').addClass('esShow');  
	return false; 
  
}



function initialize(lat,long) {
  var myLatlng = new google.maps.LatLng(lat,long);
  var mapOptions = {
	zoom: 16,
	scrollwheel: false,
	center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('es_map'), mapOptions);

  var marker = new google.maps.Marker({
	  position: myLatlng,
	  map: map,
  });
}

$(window).load(function(){
 
	$('#es_content .es_my_listing ul li .es_my_list_pic').equalHeights('.es_my_list_pic');
	
	$('#es_content .es_my_listing ul li').equalHeights('#es_content .es_my_listing ul li');
 
	remove_listing_style();
	
});   


$(window).resize(function(){
 	
	$('#es_content .es_my_listing ul li .es_my_list_pic').equalHeights('.es_my_list_pic');
	
	$('#es_content .es_my_listing ul li').equalHeights('#es_content .es_my_listing ul li');
 
	remove_listing_style();
	
});   
 

function remove_listing_style(){
	var winWidth = $(window).width();
	if(winWidth<1025) {
		 $("#es_content").removeClass('es_2_column es_3_column es_single_column ');	  
	}	
} 
 

$.fn.equalHeights = function(group) {
	var currentTallest = 0;
	$(this).each(function(){
		$(this).each(function(i){
			if ($(this).height() > currentTallest) { currentTallest = $(this).height(); }
		}); 
	});
	$(group).css({'height': currentTallest});
	return this;
};
 

 

