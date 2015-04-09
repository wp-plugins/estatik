
jQuery(document).ready(function(e) { 
 
	jQuery('.es_message').click(function(){
		jQuery(this).removeClass('es_error es_success').text('');
	});
 
	
	jQuery('.new_prop_field input[type="radio"]').click(function(){
		if(jQuery(this).prop('checked')==true){
			jQuery(this).parents('.new_prop_field').find('label').removeClass('active');
			jQuery(this).parent('label').addClass('active');	
		}		
	});
	
	
	var type ="";
	var id_url ="";
	
	jQuery('.es_tabs ul li a').click(function(){
		
		jQuery('.es_tabs ul li a').removeClass('active');
		
		jQuery(this).addClass('active');
			
		jQuery('.es_tabs_content_in').hide();
		
		var current_id=jQuery(this).attr('href');
		
		jQuery(current_id).show();
		
		type = current_id.replace("#", ""); 
		
		 if(prop_id!=''){
			 id_url = '&prop_id='+prop_id;
			 //prop_id = '&prop_id='+prop_id;
		 }
		window.history.pushState("", "", "admin.php?page=es_add_new_property&type="+type+""+id_url);
		 
		return false;
		
	});
	
	jQuery('.es_media_tabs ul li a').click(function(){
		
		jQuery('.es_media_tabs ul li a').removeClass('active');
		
		jQuery(this).addClass('active');
		
		var current_id=jQuery(this).attr('href');
		
		jQuery('.es_media_contents').hide();
		
		jQuery(current_id).show();
		
		var media = current_id.replace("#", ""); 
 		
		if(prop_id!=''){
			 id_url = '&prop_id='+prop_id;
			 //prop_id = '&prop_id='+prop_id;
		 }
		
		window.history.pushState("", "", "admin.php?page=es_add_new_property&type="+type+"&media="+media+""+id_url);
		 
		return false;
		
	});
	
	
	if(jQuery('#es_show_period option:selected').text().indexOf("rent")!=-1){
		
		jQuery("#es_period_for_rent").show();
		
	}
	
	jQuery("#es_show_period").change(function(){
 
		if(jQuery('#es_show_period option:selected').text().indexOf("rent")==-1){
		
			jQuery("#es_period_for_rent").hide();
			
		}else{
			
			jQuery("#es_period_for_rent").show();
			
		}
			
	});
	
	
	jQuery("#prop_price").keydown(function (e) {
        
		jQuery(this).siblings('p').text(''); 
		
		// Allow: backspace, delete, tab, escape, enter and .
        if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
  
				 return;
  
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
			
			jQuery(this).siblings('p').text(jQuery('#pleaseNumbersOnly').val());
			
			//console.log('ali');
			
        }
    });
 
 
	jQuery( "#es_media_images_listing ul" ).sortable();	 
	jQuery( "#es_media_images_listing ul, #es_media_images_listing ul li" ).disableSelection();	
 
});
 

function es_neigh_prop_text(obj){
	
	jQuery(obj).parents('.es_manager_lists ul li').find('input[type="checkbox"]').prop('checked',true)
	
	if(obj.value == 'text/number') { obj.value = ''; }
	
}
 
 
function es_media_image_del(obj){
	
	var es_image_del_val = jQuery(obj).parents('#es_media_images_listing ul li').find('input').val();
	 
	jQuery(obj).parents('#es_media_images_listing li').remove();
 	
	jQuery('#es_media_image_del').append("<input type='hidden' value='"+es_image_del_val+"' name='es_image_del_val[]' />");
	
}




// function for Property Country States

function es_media_image_upload(obj){
	
	var es_media_images = jQuery(obj).val();
	var es_prop_id = jQuery('#prop_id').val();
 
	
	jQuery("#es_media_images_loader").show();
  	
	var formData = new FormData(jQuery("#es_prop_insertion")[0]);
	jQuery.ajax({
		type: 'POST',   // Adding Post method
		url: estatik_ajax.ajaxurl+'?action=es_prop_media_images&es_prop_id='+es_prop_id, // Including ajax file
		data: formData,
		processData: false,
    	contentType: false, 
		success: function(data){ // Show returned data using the function.
			jQuery("#es_media_images_loader").hide();
			jQuery("#es_media_images_listing").html(data);
			
			jQuery( "#es_media_images_listing ul" ).sortable();	 
			jQuery( "#es_media_images_listing ul, #es_media_images_listing ul li" ).disableSelection();
			
		}
	});
}



// function for Property Detail New field Insertion

function es_prop_detail_add_new(){
		
		var prop_detail_add_new_title = jQuery("#es_basic_info_Add_new_title").val();

		if((prop_detail_add_new_title=="") || (document.getElementById("es_basic_info_Add_new_title").defaultValue == prop_detail_add_new_title)){
			jQuery("#es_basic_info_Add_new_error").addClass('es_error').text(jQuery("#pleasefillfield").val());
			return false;
		} 
		
		jQuery('.es_message').removeClass('es_error').text('');
		
		jQuery("#es_basic_info_in").append('<div class="new_prop_field clearFix"><span>'+prop_detail_add_new_title+':</span><input type="text" name="prop_data[\''+prop_detail_add_new_title+'\']" value=""><a href="javascript:void(0)" onclick="es_field_del(this)" class="field_del"></a></div>')
		
		jQuery("#es_basic_info_Add_new_title").val(document.getElementById("es_basic_info_Add_new_title").defaultValue);
		
}


function es_field_del(obj){
	
	jQuery(obj).parents('.new_prop_field').remove();
	
}


// function for Property Country States

function es_prop_country_states(obj){
	
	var es_country_id = jQuery(obj).val();
	
	jQuery("#es_states_loader").show();
  
	jQuery.ajax({
		type: 'POST',   // Adding Post method
		url: estatik_ajax.ajaxurl, // Including ajax file
		data: {"action": "es_prop_country_states", "es_country_id":es_country_id}, 
		success: function(data){ // Show returned data using the function.
			
			jQuery("#es_states_loader").hide();
			jQuery("#es_states").html(data);
			jQuery("#es_states").next('.es_select_arow').text(jQuery("#es_states option:first-child").text());

		}
		});
}

// function for Property States Cities

function es_prop_states_cities(obj){
	
	var es_state_id = jQuery(obj).val();
	
	jQuery("#es_cities_loader").show();
  
	jQuery.ajax({
		type: 'POST',   // Adding Post method
		url: estatik_ajax.ajaxurl, // Including ajax file
		data: {"action": "es_prop_states_cities", "es_state_id":es_state_id}, 
		success: function(data){ // Show returned data using the function.
			
			jQuery("#es_cities_loader").hide();
			
			jQuery("#es_cities").html(data);
			
			jQuery("#es_cities").next('.es_select_arow').text(jQuery("#es_cities option:first-child").text());

		}
		});
}

jQuery(function() {
	jQuery( "#es_media_images_listing ul" ).sortable();	 
	jQuery( "#es_media_images_listing ul, #es_media_images_listing ul li" ).disableSelection();
});
 





