var $ = jQuery;

$(document).ready(function(e) { 
 
	$('.es_message').click(function(){
		$(this).removeClass('es_error es_success').text('');
	});
 
	
	$('.new_prop_field input[type="radio"]').click(function(){
		if($(this).prop('checked')==true){
			$(this).parents('.new_prop_field').find('label').removeClass('active');
			$(this).parent('label').addClass('active');	
		}		
	});
	
	
	var type ="";
	var id_url ="";
	
	$('.es_tabs ul li a').click(function(){
		
		$('.es_tabs ul li a').removeClass('active');
		
		$(this).addClass('active');
			
		$('.es_tabs_content_in').hide();
		
		var current_id=$(this).attr('href');
		
		$(current_id).show();
		
		type = current_id.replace("#", ""); 
		
		 if(prop_id!=''){
			 id_url = '&prop_id='+prop_id;
			 //prop_id = '&prop_id='+prop_id;
		 }
		window.history.pushState("", "", "admin.php?page=es_add_new_property&type="+type+""+id_url);
		 
		return false;
		
	});
	
	$('.es_media_tabs ul li a').click(function(){
		
		$('.es_media_tabs ul li a').removeClass('active');
		
		$(this).addClass('active');
		
		var current_id=$(this).attr('href');
		
		$('.es_media_contents').hide();
		
		$(current_id).show();
		
		var media = current_id.replace("#", ""); 
 		
		if(prop_id!=''){
			 id_url = '&prop_id='+prop_id;
			 //prop_id = '&prop_id='+prop_id;
		 }
		
		window.history.pushState("", "", "admin.php?page=es_add_new_property&type="+type+"&media="+media+""+id_url);
		 
		return false;
		
	});
	
	
	if($('#es_show_period option:selected').text().indexOf("rent")!=-1){
		
		$("#es_period_for_rent").show();
		
	}
	
	$("#es_show_period").change(function(){
 
		if($('#es_show_period option:selected').text().indexOf("rent")==-1){
		
			$("#es_period_for_rent").hide();
			
		}else{
			
			$("#es_period_for_rent").show();
			
		}
			
	});
	
	
	$("#prop_price").keydown(function (e) {
        
		$(this).siblings('p').text(''); 
		
		// Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
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
			
			$(this).siblings('p').text('Please enter numbers only.');
			
			//console.log('ali');
			
        }
    });
 
 
	$( "#es_media_images_listing ul" ).sortable();	 
	$( "#es_media_images_listing ul, #es_media_images_listing ul li" ).disableSelection();	
 
});
 

function es_neigh_prop_text(obj){
	
	$(obj).parents('.es_manager_lists ul li').find('input[type="checkbox"]').prop('checked',true)
	
	if(obj.value == 'text/number') { obj.value = ''; }
	
}
 
 
function es_media_image_del(obj){
	
	var es_image_del_val = $(obj).parents('#es_media_images_listing ul li').find('input').val();
	 
	$(obj).parents('#es_media_images_listing li').remove();
 	
	$('#es_media_image_del').append("<input type='hidden' value='"+es_image_del_val+"' name='es_image_del_val[]' />");
	
}




// function for Property Country States

function es_media_image_upload(obj){
	
	var es_media_images = $(obj).val();
	var es_prop_id = $('#prop_id').val();
 
	
	$("#es_media_images_loader").show();
  	
	var formData = new FormData($("#es_prop_insertion")[0]);
	jQuery.ajax({
		type: 'POST',   // Adding Post method
		url: estatik_ajax.ajaxurl+'?action=es_prop_media_images&es_prop_id='+es_prop_id, // Including ajax file
		data: formData,
		processData: false,
    	contentType: false, 
		success: function(data){ // Show returned data using the function.
			$("#es_media_images_loader").hide();
			$("#es_media_images_listing").html(data);
			
			$( "#es_media_images_listing ul" ).sortable();	 
			$( "#es_media_images_listing ul, #es_media_images_listing ul li" ).disableSelection();
			
		}
	});
}



// function for Property Detail New field Insertion

function es_prop_detail_add_new(){
		
		var prop_detail_add_new_title = $("#es_basic_info_Add_new_title").val();

		if((prop_detail_add_new_title=="") || (document.getElementById("es_basic_info_Add_new_title").defaultValue == prop_detail_add_new_title)){
			$("#es_basic_info_Add_new_error").addClass('es_error').text('pleae fill your field.');
			return false;
		} 
		
		$('.es_message').removeClass('es_error').text('');
		
		$("#es_basic_info_in").append('<div class="new_prop_field clearFix"><span>'+prop_detail_add_new_title+':</span><input type="text" name="prop_data[\''+prop_detail_add_new_title+'\']" value=""><a href="javascript:void(0)" onclick="es_field_del(this)" class="field_del"></a></div>')
		
		$("#es_basic_info_Add_new_title").val(document.getElementById("es_basic_info_Add_new_title").defaultValue);
		
}


function es_field_del(obj){
	
	$(obj).parents('.new_prop_field').remove();
	
}


// function for Property Country States

function es_prop_country_states(obj){
	
	var es_country_id = $(obj).val();
	
	$("#es_states_loader").show();
  
	jQuery.ajax({
		type: 'POST',   // Adding Post method
		url: estatik_ajax.ajaxurl, // Including ajax file
		data: {"action": "es_prop_country_states", "es_country_id":es_country_id}, 
		success: function(data){ // Show returned data using the function.
			
			$("#es_states_loader").hide();
			$("#es_states").html(data);
			$("#es_states").next('.es_select_arow').text($("#es_states option:first-child").text());

		}
		});
}

// function for Property States Cities

function es_prop_states_cities(obj){
	
	var es_state_id = $(obj).val();
	
	$("#es_cities_loader").show();
  
	jQuery.ajax({
		type: 'POST',   // Adding Post method
		url: estatik_ajax.ajaxurl, // Including ajax file
		data: {"action": "es_prop_states_cities", "es_state_id":es_state_id}, 
		success: function(data){ // Show returned data using the function.
			
			$("#es_cities_loader").hide();
			
			$("#es_cities").html(data);
			
			$("#es_cities").next('.es_select_arow').text($("#es_cities option:first-child").text());

		}
		});
}

$(function() {
	$( "#es_media_images_listing ul" ).sortable();	 
	$( "#es_media_images_listing ul, #es_media_images_listing ul li" ).disableSelection();
});
 





