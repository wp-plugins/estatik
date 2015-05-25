
 

function emailValidation(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

jQuery(document).ready(function(e) { 

	jQuery("input[type='reset']").click(function(){
		 
		 window.location = window.location
		 
	});
	
	jQuery(".es_error").click(function(){
		 jQuery(this).hide();
	});
	
	jQuery('.es_prop_single_tabs ul li a').click(function(){
		
		jQuery('.es_prop_single_tabs ul li a').removeClass('active');
		
		jQuery(this).addClass('active');
 
 		var current_id = jQuery(this).attr('href');
		
		var current_id_pos = parseInt(jQuery(current_id).offset().top);
		//alert(jQuery(current_id_pos));
		jQuery('html,body').animate({ scrollTop: current_id_pos-58 });
	  
		return false;
		
	});
	
	
	jQuery(".es_close_pop,.es_request_info_popup_overlay").click(function(){
		 jQuery('#es_request_form_popup').fadeOut(500);
		 return false;
	});
	
	jQuery("#es_request_form input[type='submit']").click(function(){
		 
		 var es_request_form_email = jQuery('#es_request_form input[name="your_email"]').val();
		 var es_request_form_message = jQuery('#es_request_form textrea').val();
		 
		 if (es_request_form_email=='' || es_request_form_message=='') {
			jQuery('#request_form_error').text('Please enter your email.').show();
			return false;
		 }
		 
		 if (!emailValidation(es_request_form_email)) {
			jQuery('#request_form_error').text('Email is not valid.').show();
			return false;
		 } else {
			jQuery('#request_form_error').hide();
			return true;
		 }
 
	});
	 
	jQuery('.es_wrapper select').each(function(index, element) {
		var selText = jQuery(this).find('option:selected').text(); 
		jQuery(this).wrap("<div class='es_select'></div>");
 		jQuery(this).parent('.es_select').append('<div class="es_select_arow"></div>');
		jQuery(this).parent('.es_select').find('.es_select_arow').text(selText);
    });
 
	jQuery('.es_wrapper select').change(function(){
		var selText = jQuery(this).find('option:selected').text();
		jQuery(this).parent('.es_select').find('.es_select_arow').text(selText);
	}); 
 
	jQuery('p').each(function() {
		var jQuerythis = jQuery(this);
		if(jQuerythis.html().replace(/\s|&nbsp;/g, '').length == 0)
			jQuerythis.remove();
	});
	
	
	jQuery("#es_content #es_map_pop_outer a#es_closePop,#es_content #es_overlay").click(function(){

		jQuery('#es_content #es_map_pop_outer').removeClass('esShow');  
		 
	});
	
	jQuery("#es_toTop a").click(function(){
		jQuery('html,body').animate({scrollTop:0},500);  
		return false; 
	});
	
	/*jQuery(".es_search_select input").blur(function(){
		var obj = jQuery(this);
		setTimeout(function(){
			obj.parents('.es_search_select').removeClass('focus')
		},100)
	});*/
	
	jQuery(".es_search_select span, .es_search_select small").click(function(){
		jQuery(this).parents('.es_search_select').addClass('focus')
		//jQuery(this).parents('.es_search_select').find('input').focus();
	});
	
	jQuery(".es_search_select").mouseleave(function(){
		jQuery(".es_search_select").removeClass('focus')
	});

	jQuery(".es_search_select ul li").click(function(){
		jQuery(this).siblings('li').removeClass('selected');
		jQuery(this).addClass('selected');
		var selVal = jQuery(this).attr('value');
		var selText = jQuery(this).text();
		jQuery(this).parents('.es_search_select').find('span').text(selText);
		jQuery(this).parents('.es_search_select').find('input').val(selVal);
		jQuery(this).parents('.es_search_select').removeClass('focus')
		return false; 
	});
	
	
	jQuery(".es_search_select li.selected").each(function(index, element) {
		var selText = jQuery(this).text();
		jQuery(this).parents('.es_search_select').find('span').text(selText); 
    });
 
	jQuery('.es_wrapper select').change(function(){
		var selText = jQuery(this).find('option:selected').text();
		jQuery(this).parent('.es_select').find('.es_select_arow').text(selText);
	}); 
	
 
});  


function es_map_view_click(obj) {
  
	var mapLatLong = jQuery(obj).attr('href');
	if(mapLatLong!=""){
		var arr = mapLatLong.split(",");
		initialize(arr[0],arr[1]);		 
	}else{
		jQuery('#es_content #es_map').text('Not defined.');
	}
	jQuery('#es_content #es_map_pop_outer').addClass('esShow');  
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

jQuery(window).load(function(){
 
	//jQuery('#es_content .es_my_listing ul li .es_my_list_pic').equalHeights('.es_my_list_pic');
	
	jQuery('#es_content .es_my_listing ul li').equalHeights('#es_content .es_my_listing ul li');
 
	remove_listing_style();
	
});   


jQuery(window).resize(function(){
 	
	//jQuery('#es_content .es_my_listing ul li .es_my_list_pic').equalHeights('.es_my_list_pic');
	
	jQuery('#es_content .es_my_listing ul li').equalHeights('#es_content .es_my_listing ul li');
 
	remove_listing_style();
	
});   
 

function remove_listing_style(){
	var winWidth = jQuery(window).width();
	if(winWidth<1025) {
		 jQuery("#es_content").removeClass('es_2_column es_3_column es_single_column ');	  
	}	
} 
 

jQuery.fn.equalHeights = function(group) {
	var currentTallest = 0;
	jQuery(this).each(function(){
		jQuery(this).each(function(i){
			if (jQuery(this).height() > currentTallest) { currentTallest = jQuery(this).height(); }
		}); 
	});
	jQuery(group).css({'height': currentTallest});
	return this;
};
 

 

