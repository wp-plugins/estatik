 
jQuery(document).ready(function(e) { 
 
	
	jQuery('.es_message').click(function(){
		jQuery(this).removeClass('es_error es_success').text('');
	});
	
	jQuery('.es_cancel, .es_close_popup, .es_ok, .es_alert_popup_overlay').click(function(){
		jQuery('.es_alert_popup').fadeOut(500);
	});
	
	
	jQuery('.es_tabs ul li a').click(function(){
		
		jQuery('.es_tabs ul li a').removeClass('active');
		
		jQuery(this).addClass('active');
			
		jQuery('.es_tabs_content_in').hide();
		
		var current_id=jQuery(this).attr('href');
		
		jQuery(current_id).show();
		
		var type = current_id.replace("#", ""); 
		 
		window.history.pushState("", "", "admin.php?page=es_data_manager&type="+type);
		 
		return false;
		
	});
	
	jQuery('#es_country_listing li:first-child, #es_state_listing li:first-child').addClass("active");
	
	jQuery('#es_country_listing li:first-child input, #es_state_listing li:first-child input').prop("checked",true);
 
});



// function for manager status Insertion

function es_status_insertion(){
	
		var es_status_title = jQuery("#es_status_title").val();

			if((es_status_title=="") || (document.getElementById("es_status_title").defaultValue == es_status_title)){
				jQuery("#es_status_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_status_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_status_insertion", "es_status_title":es_status_title}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_status_add_loader").hide();
				
				jQuery("#es_status_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_status_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_status_title").val(document.getElementById("es_status_title").defaultValue);
				
				jQuery("#es_status_listing ul p").remove('p'); 
				
				jQuery("#es_status_listing ul").append(data);
 
			}
		});
		
}


// function for manager status delete

function es_status_delete(obj){
 
		var es_status_id = jQuery(obj).siblings('.es_status_id').val();
 		
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){
		 	 jQuery('#sure_popup').fadeIn(500);	 
			 jQuery('.es_ok').attr('id',"es_status_delete"); 
		 }
 
		 jQuery('#es_status_delete').click(function(){
  			 jQuery('#sure_popup').fadeOut(500);
			 jQuery(obj).siblings(".es_status_loader").show();
		 
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_status_delete", "es_status_id":es_status_id}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery(".es_status_loader").hide();
					
					jQuery("#es_status_message").text(jQuery("#fieldDeleted").val()).addClass('es_success');
					
					setTimeout(function(){
						
						jQuery("#es_status_message").removeClass('es_success').text('');
							
					},2000)
					
					jQuery("#es_status_listing ul li#status_"+data).remove();
			
				}
			});
		 	 
		});	

}



// function for manager Category Insertion

function es_category_insertion(){
	
		var es_cat_title = jQuery("#es_cat_title").val();

			if((es_cat_title=="") || (document.getElementById("es_cat_title").defaultValue == es_cat_title)){
				jQuery("#es_category_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_category_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_category_insertion", "es_cat_title":es_cat_title}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_category_add_loader").hide();
  			 
					
				jQuery("#es_category_listing ul p").remove('p');
				
				jQuery("#es_category_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
			
				setTimeout(function(){
					
					jQuery("#es_category_message").removeClass('es_success').text('');
						
				},2000)
				
				jQuery("#es_cat_title").val(document.getElementById("es_cat_title").defaultValue);
				jQuery("#es_category_listing ul").append(data);
				  
 
			}
		});
		
}


// function for manager Category delete

function es_category_delete(obj){
	
		var es_cat_id = jQuery(obj).siblings('.es_cat_id').val();
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){

		 	 jQuery('#sure_popup').fadeIn(500);
			 jQuery('.es_ok').attr('id',"es_category_delete");
			  	  
		 }
 
		 jQuery('#es_category_delete').click(function(){
 			jQuery('#sure_popup').fadeOut(500);
			 jQuery(obj).siblings(".es_category_loader").show();
		 
				jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_category_delete", "es_cat_id":es_cat_id}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery(".es_category_loader").hide();
					
					jQuery("#es_category_message").text(jQuery("#fieldDeleted").val()).addClass('es_success');
					
					setTimeout(function(){
						
						jQuery("#es_category_message").removeClass('es_success').text('');
							
					},2000)
 					
					jQuery("#es_category_listing ul li#cat_"+data).remove();
		
				}
			});
		 	 
		});	
 
}


// function for manager Category Insertion

function es_type_insertion(){
	
		var es_type_title = jQuery("#es_type_title").val();

			if((es_type_title=="") || (document.getElementById("es_type_title").defaultValue == es_type_title)){
				jQuery("#es_type_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_type_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_type_insertion", "es_type_title":es_type_title}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_type_add_loader").hide();
				
				jQuery("#es_type_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_type_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_type_title").val(document.getElementById("es_type_title").defaultValue);
				
				jQuery("#es_type_listing ul p").remove('p');
				
				jQuery("#es_type_listing ul").append(data);
 
			}
		});
		
}


// function for manager type delete

function es_type_delete(obj){
	
	var es_type_id = jQuery(obj).siblings('.es_type_id').val();
 
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){

		 	 jQuery('#sure_popup').fadeIn(500);	
			 jQuery('.es_ok').attr('id',"es_type_delete");  
		 }
 
		 jQuery('#es_type_delete').click(function(){
 
			 jQuery('#sure_popup').fadeOut(500);
 
			 jQuery(obj).siblings(".es_type_loader").show();
		 
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_type_delete", "es_type_id":es_type_id}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery(".es_type_loader").hide();
					
					jQuery("#es_type_message").text(jQuery("#fieldDeleted").val()).addClass('es_success');
					
					setTimeout(function(){
						
						jQuery("#es_type_message").removeClass('es_success').text('');
							
					},2000)
		 
					jQuery("#es_type_listing ul li#type_"+data).remove();
		
				}
			});
		 	 
		});	 
 
		
}


// function for manager period Insertion

function es_period_insertion(){
	
		var es_period_title = jQuery("#es_period_title").val();

			if((es_period_title=="") || (document.getElementById("es_period_title").defaultValue == es_period_title)){
				jQuery("#es_period_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_period_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_period_insertion", "es_period_title":es_period_title}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_period_add_loader").hide();
				
				jQuery("#es_period_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_period_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_period_title").val(document.getElementById("es_period_title").defaultValue);
 				
				jQuery("#es_period_listing ul p").remove('p');
				
				jQuery("#es_period_listing ul").append(data);
 
			}
		});
		
}


// function for manager period delete

function es_period_delete(obj){
	
	var es_period_id = jQuery(obj).siblings('.es_period_id').val();
 
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){
			
		 	 jQuery('#sure_popup').fadeIn(500);
			 jQuery('.es_ok').attr('id',"es_period_delete");	  
		 }
 
		 jQuery('#es_period_delete').click(function(){
 
			 jQuery('#sure_popup').fadeOut(500);
 
			 jQuery(obj).siblings(".es_period_loader").show();
		 
				jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_period_delete", "es_period_id":es_period_id}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery(".es_period_loader").hide();
					
					jQuery("#es_period_message").text(jQuery("#fieldDeleted").val()).addClass('es_success');
					
					setTimeout(function(){
						
						jQuery("#es_period_message").removeClass('es_success').text('');
							
					},2000)
					
					jQuery("#es_period_listing ul li#period_"+data).remove();
		
				}
			});
		 	 
		});	
 
}


// function for manager Neigh Insertion

function es_neigh_insertion(){
	
		var es_neigh_title = jQuery("#es_neigh_title").val();
		var prop_neigh = jQuery("#prop_neigh").val();
	 
			if((es_neigh_title=="") || (document.getElementById("es_neigh_title").defaultValue == es_neigh_title)){
				jQuery("#es_neigh_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_neigh_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_neigh_insertion", "es_neigh_title":es_neigh_title, "prop_id":prop_id, "prop_neigh":prop_neigh}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_neigh_add_loader").hide();
				
				jQuery("#es_neigh_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_neigh_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_neigh_title").val(document.getElementById("es_neigh_title").defaultValue);
 				
				jQuery("#es_neigh_listing ul p").remove('p');
					
				jQuery("#es_neigh_listing ul").append(data);
 
				var totalLength = jQuery("#es_neigh_listing ul li").length-1;
				
				jQuery("#es_neigh_listing ul li:last-child").find('input[type="checkbox"]').attr('name','es_prop_neigh['+totalLength+']')
				jQuery("#es_neigh_listing ul li:last-child").find('input[type="text"]').attr('name','neigh_distance['+totalLength+']')
 
			}
		});
		
}


// function for manager neigh delete

function es_neigh_delete(obj){
 
	var es_neigh_id = jQuery(obj).siblings('.es_neigh_id').val();
 	var prop_neigh = jQuery("#prop_neigh").val(); 
 
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){
			 
		 	 jQuery('#sure_popup').fadeIn(500);	
			 jQuery('.es_ok').attr('id',"es_neigh_delete");  
		 }
 
		 jQuery('#es_neigh_delete').click(function(){
 			
			jQuery('#sure_popup').fadeOut(500);
			
			jQuery(obj).siblings(".es_neigh_loader").show();
		 
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_neigh_delete", "es_neigh_id":es_neigh_id, "prop_id":prop_id, "prop_neigh":prop_neigh}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery(".es_neigh_loader").hide();
					
					jQuery("#es_neigh_message").addClass('es_success').text(jQuery("#fieldDeleted").val());
					
					console.log(data)
					
					setTimeout(function(){
						
						jQuery("#es_neigh_message").removeClass('es_success').text('');
							
					},2000)
		
					jQuery("#es_neigh_listing ul li#neigh_"+data).remove();
		
				}
			});
		 	 
		});	
}
 

// function for Country Insertion

function es_country_insertion(obj){
  
		var es_country_title = jQuery("#es_country_title").val();

			if((es_country_title=="") || (document.getElementById("es_country_title").defaultValue == es_country_title)){
				jQuery("#es_country_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_country_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_country_insertion", "es_country_title":es_country_title}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_country_add_loader").hide();
				
				jQuery("#es_country_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_country_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_country_title").val(document.getElementById("es_country_title").defaultValue);
				
				jQuery("#es_country_listing").html(data);
				
				jQuery("#es_country_listing ul li:first-child input").click();
				
 
			}
		});
		
}


// function for manager country delete

function es_country_delete(obj){
	
	var es_country_id = jQuery(obj).siblings('#es_country_id').val();
 		
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click'); 
		if(es_row_del==''){

		 	 jQuery('#sure_popup').fadeIn(500);
			 jQuery('.es_ok').attr('id',"es_country_delete"); 	  
		 }
 
		 jQuery('#es_country_delete').click(function(){
 
			 jQuery('#sure_popup').fadeOut(500);
 
			 jQuery(obj).siblings("#es_country_loader").show();
		 
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_country_delete", "es_country_id":es_country_id}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery("#es_country_loader").hide();
					
					jQuery("#es_country_message").addClass('es_success').text(jQuery("#fieldDeleted").val());
					
					setTimeout(function(){
						
						jQuery("#es_country_message").removeClass('es_success').text('');
							
					},2000)
		
					jQuery("#es_country_listing").html(data);
					
					if(jQuery("#es_country_listing p").hasClass('es_no_record')){
					
						jQuery("#es_state_listing").html('<p>No record found. Please add new one.</p>');
						jQuery("#es_city_listing").html('<p>No record found. Please add new one.</p>');
		 
					}else {
						
						jQuery("#es_country_listing ul li:first-child input").click();
							
					}
		
				}
			});
		 	 
		});

}


// function for manager country delete

function es_country_states(obj){
		
		jQuery('#es_country_listing ul li').removeClass('active');
		
		jQuery(obj).parents('#es_country_listing ul li').addClass('active');
		
		var es_country_id = jQuery(obj).parent('label').siblings('#es_country_id').val();
  
		jQuery(obj).parent('label').siblings("#es_country_loader").show();
 	 
		jQuery.ajax({
		type: 'POST',   // Adding Post method
		url: estatik_ajax.ajaxurl, // Including ajax file
		data: {"action": "es_country_states", "es_country_id":es_country_id}, 
		success: function(data){ // Show returned data using the function.
			
			jQuery(obj).parent('label').siblings("#es_country_loader").hide();
 
			jQuery("#es_state_listing").html(data);
			
			if(jQuery("#es_state_listing p").hasClass('es_no_record')){
			
				jQuery("#es_city_listing").html('<p>No record found. Please add new one.</p>');
 
			}else {
				
				jQuery("#es_state_listing ul li:first-child input").click();
					
			}
			
		}
	});
		
}



// function for state Insertion

function es_state_insertion(){
	
		var es_state_title = jQuery("#es_state_title").val();
		var es_country_id = jQuery("#es_ajax_country_id").val();
 
			if((es_state_title=="") || (document.getElementById("es_state_title").defaultValue == es_state_title)){
				jQuery("#es_state_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_state_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_state_insertion", "es_state_title":es_state_title, "es_country_id":es_country_id}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_state_add_loader").hide();
				
				jQuery("#es_state_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_state_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_state_title").val(document.getElementById("es_state_title").defaultValue);
				
				jQuery("#es_state_listing").html(data);
 
				jQuery("#es_state_listing ul li:first-child input").click();
 
			}
		});
		
}


// function for manager state delete

function es_state_delete(obj){
	
	var es_state_id = jQuery(obj).siblings('#es_state_id').val();
	var es_country_id = jQuery("#es_ajax_country_id").val();
 
		var es_row_del = "";
		jQuery('.es_ok').attr('id',""); 
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){

		 	 jQuery('#sure_popup').fadeIn(500);	
			 jQuery('.es_ok').attr('id',"es_state_delete");   
		 }
 
		 jQuery('#es_state_delete').click(function(){
 
			 jQuery('#sure_popup').fadeOut(500);
 
			 jQuery(obj).siblings("#es_state_loader").show();
		 
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_state_delete", "es_state_id":es_state_id, "es_country_id":es_country_id}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery("#es_state_loader").hide();
					
					jQuery("#es_state_message").addClass('es_success').text(jQuery("#fieldDeleted").val());
					
					setTimeout(function(){
						
						jQuery("#es_state_message").removeClass('es_success').text('');
							
					},2000)
		
					jQuery("#es_state_listing").html(data);
					
					jQuery("#es_state_listing ul li:first-child input").click();
		
				}
			});
		 	 
		});
 
}

 

// function for manager country delete

function es_state_city(obj){
	
	jQuery('#es_state_listing li').removeClass('active');
	
	jQuery(obj).parents('#es_state_listing li').addClass('active');
	
	var es_state_id = jQuery(obj).parent('label').siblings('#es_state_id').val();
  
		jQuery(obj).parent('label').siblings("#es_state_loader").show();
 	 
		jQuery.ajax({
		type: 'POST',   // Adding Post method
		url: estatik_ajax.ajaxurl, // Including ajax file
		data: {"action": "es_state_city", "es_state_id":es_state_id}, 
		success: function(data){ // Show returned data using the function.
			
			jQuery(obj).parent('label').siblings("#es_state_loader").hide();
 
			jQuery("#es_city_listing").html(data);

		}
	});
		
}



// function for City Insertion

function es_city_insertion(){
	
		var es_city_title = jQuery("#es_city_title").val();
		var es_state_id = jQuery("#es_ajax_state_id").val();
 
			if((es_city_title=="") || (document.getElementById("es_city_title").defaultValue == es_city_title)){
				jQuery("#es_city_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_city_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_city_insertion", "es_city_title":es_city_title, "es_state_id":es_state_id}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_city_add_loader").hide();
				
				jQuery("#es_city_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_city_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_city_title").val(document.getElementById("es_city_title").defaultValue);
				
				jQuery("#es_city_listing").html(data);
 
			}
		});
		
}


// function for manager city delete

function es_city_delete(obj){
	
	var es_city_id = jQuery(obj).siblings('#es_city_id').val();
	var es_state_id = jQuery("#es_ajax_state_id").val();
 
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){
		 	 jQuery('#sure_popup').fadeIn(500);
			 jQuery('.es_ok').attr('id',"es_city_delete");	  
		 }
 
		 jQuery('#es_city_delete').click(function(){
 
			 jQuery('#sure_popup').fadeOut(500);
 
			 jQuery(obj).siblings("#es_city_loader").show();
		 
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_city_delete", "es_city_id":es_city_id, "es_state_id":es_state_id}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery("#es_city_loader").hide();
					
					jQuery("#es_city_message").addClass('es_success').text(jQuery("#fieldDeleted").val());
					
					setTimeout(function(){
						
						jQuery("#es_city_message").removeClass('es_success').text('');
							
					},2000)
		
					jQuery("#es_city_listing").html(data);
		
				}
			});
		 	 
		});
 
}


// function for manager dimension Insertion

function es_dimension_insertion(){
	
		var es_dimension_title = jQuery("#es_dimension_title").val();

			if((es_dimension_title=="") || (document.getElementById("es_dimension_title").defaultValue == es_dimension_title)){
				jQuery("#es_dimension_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_dimension_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_dimension_insertion", "es_dimension_title":es_dimension_title}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_dimension_add_loader").hide();
				
				jQuery("#es_dimension_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_dimension_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_dimension_title").val(document.getElementById("es_dimension_title").defaultValue);
				
				jQuery("#es_dimension_listing ul p").remove('p');
				
				jQuery("#es_dimension_listing ul").append(data);
 
			}
		});
		
}


// function for manager dimension delete

function es_dimension_delete(obj){
	
	var es_dimension_id = jQuery(obj).siblings('.es_dimension_id').val();
 
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){
			 
		 	 jQuery('#sure_popup').fadeIn(500);
			 jQuery('.es_ok').attr('id',"es_dimension_delete");	  
		 }
 
		 jQuery('#es_dimension_delete').click(function(){
 
			jQuery('#sure_popup').fadeOut(500);
 
			jQuery(obj).siblings(".es_dimension_loader").show();
			
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_dimension_delete", "es_dimension_id":es_dimension_id}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery(".es_dimension_loader").hide();
				
				jQuery("#es_dimension_message").addClass('es_success').text(jQuery("#fieldDeleted").val());
				
				setTimeout(function(){
					
					jQuery("#es_dimension_message").removeClass('es_success').text('');
						
				},2000)

				jQuery("#es_dimension_listing ul li#dimension_"+data).remove();
			
			}
			});
		 	 
		});
 
}


// function for manager dimension Status

function es_dimension_status(obj){
	
	var es_dimension_id = jQuery(obj).parent('label').siblings('.es_dimension_id').val();
  
		jQuery(obj).parent('label').siblings(".es_dimension_loader").show();
		 
		jQuery.ajax({
		type: 'POST',   // Adding Post method
		url: estatik_ajax.ajaxurl, // Including ajax file
		data: {"action": "es_dimension_status", "es_dimension_id":es_dimension_id}, 
		success: function(data){ // Show returned data using the function.
			
			jQuery(".es_dimension_loader").hide();
			
			jQuery("#es_dimension_message").addClass('es_success').text('Dimension has been selecetd.');
			
			setTimeout(function(){
				
				jQuery("#es_dimension_message").removeClass('es_success').text('');
					
			},2000)
			
			jQuery("#es_dimension_listing ul p").remove('p');
				
			jQuery("#es_dimension_listing ul").html(data);

		}
	});
		
}



// function for manager feature Insertion

function es_feature_insertion(){
	
		var es_feature_title = jQuery("#es_feature_title").val();
		var prop_feature = jQuery("#prop_feature").val();
	 

			if((es_feature_title=="") || (document.getElementById("es_feature_title").defaultValue == es_feature_title)){
				jQuery("#es_feature_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_feature_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_feature_insertion", "es_feature_title":es_feature_title, "prop_feature":prop_feature, "prop_id":prop_id}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_feature_add_loader").hide();
				
				jQuery("#es_feature_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_feature_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_feature_title").val(document.getElementById("es_feature_title").defaultValue);
				
				jQuery("#es_feature_listing ul p").remove('p');
				
				jQuery("#es_feature_listing ul").append(data);
 
			}
		});
		
}


// function for manager feature delete

function es_feature_delete(obj){
	
	var es_feature_id = jQuery(obj).siblings('.es_feature_id').val();
	var prop_feature = jQuery("#prop_feature").val();
 
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){
		 	 jQuery('#sure_popup').fadeIn(500);	
			 jQuery('.es_ok').attr('id',"es_feature_delete");  
		 }
 
		 jQuery('#es_feature_delete').click(function(){
 
			jQuery('#sure_popup').fadeOut(500);
 
			jQuery(obj).siblings(".es_feature_loader").show();
		 
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_feature_delete", "es_feature_id":es_feature_id, "prop_id":prop_id, "prop_feature":prop_feature}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery(".es_feature_loader").hide();
					
					jQuery("#es_feature_message").addClass('es_success').text(jQuery("#fieldDeleted").val());
					
					setTimeout(function(){
						
						jQuery("#es_feature_message").removeClass('es_success').text('');
							
					},2000)
					
					jQuery("#es_feature_listing ul li#feature_"+data).remove();
		
				}
			});
		 	 
		});
 
}


// function for manager appliance Insertion

function es_appliance_insertion(){
	
		var es_appliance_title = jQuery("#es_appliance_title").val();
		var prop_appliance = jQuery("#prop_appliance").val();

			if((es_appliance_title=="") || (document.getElementById("es_appliance_title").defaultValue == es_appliance_title)){
				jQuery("#es_appliance_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_appliance_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_appliance_insertion", "es_appliance_title":es_appliance_title, "prop_id":prop_id, "prop_appliance":prop_appliance}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_appliance_add_loader").hide();
				
				jQuery("#es_appliance_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_appliance_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_appliance_title").val(document.getElementById("es_appliance_title").defaultValue);
				 
				jQuery("#es_appliance_listing ul p").remove('p'); 
				 
				jQuery("#es_appliance_listing ul").append(data);
			}
		});
		
}


// function for manager appliance delete

function es_appliance_delete(obj){
	
	var es_appliance_id = jQuery(obj).siblings('.es_appliance_id').val();
	var prop_appliance = jQuery("#prop_appliance").val();
 
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){
			
		 	 jQuery('#sure_popup').fadeIn(500);
			 jQuery('.es_ok').attr('id',"es_appliance_delete");	  
		 }
 
		 jQuery('#es_appliance_delete').click(function(){
 
			 jQuery('#sure_popup').fadeOut(500);
 
			jQuery(obj).siblings(".es_appliance_loader").show();
		 
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_appliance_delete", "es_appliance_id":es_appliance_id, "prop_id":prop_id, "prop_appliance":prop_appliance}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery(".es_appliance_loader").hide();
					
					jQuery("#es_appliance_message").addClass('es_success').text(jQuery("#fieldDeleted").val());
					
					setTimeout(function(){
						
						jQuery("#es_appliance_message").removeClass('es_success').text('');
							
					},2000)
					
					jQuery("#es_appliance_listing ul li#appliance_"+data).remove();
		
				}
			});
		 	 
		});
		
}


// function for manager Currency Insertion

function es_currency_insertion(){
	
		var es_currency_title = jQuery("#es_currency_title").val();

			if((es_currency_title=="") || (document.getElementById("es_currency_title").defaultValue == es_currency_title)){
				jQuery("#es_currency_message").addClass('es_error').text(jQuery("#pleasefillfield").val());
				return false;
			}
			
			jQuery("#es_currency_add_loader").show();
			 
			jQuery.ajax({
			type: 'POST',   // Adding Post method
			url: estatik_ajax.ajaxurl, // Including ajax file
			data: {"action": "es_currency_insertion", "es_currency_title":es_currency_title}, 
			success: function(data){ // Show returned data using the function.
				
				jQuery("#es_currency_add_loader").hide();
				
				jQuery("#es_currency_message").removeClass('es_error').addClass('es_success').text(jQuery("#fieldAdded").val());
				
				setTimeout(function(){
					
					jQuery("#es_currency_message").removeClass('es_success').text('');
						
				},2000)
		 
				jQuery("#es_currency_title").val(document.getElementById("es_currency_title").defaultValue);
				
				jQuery("#es_currency_listing ul p").remove('p'); 
				
				jQuery("#es_currency_listing ul").append(data);

			}
		});
		
}


// function for manager currency delete

function es_currency_delete(obj){
	
	var es_currency_id = jQuery(obj).siblings('.es_currency_id').val();
 
		var es_row_del = "";
		jQuery('.es_ok').attr('id',"");
		jQuery('.es_ok').unbind('click');
		if(es_row_del==''){
			 
		 	 jQuery('#sure_popup').fadeIn(500);
			 jQuery('.es_ok').attr('id',"es_currency_delete");	  
		 }
 
		 jQuery('#es_currency_delete').click(function(){
 			
			jQuery('#sure_popup').fadeOut(500);
			
			jQuery(obj).siblings(".es_currency_loader").show();
		 
			jQuery.ajax({
				type: 'POST',   // Adding Post method
				url: estatik_ajax.ajaxurl, // Including ajax file
				data: {"action": "es_currency_delete", "es_currency_id":es_currency_id}, 
				success: function(data){ // Show returned data using the function.
					
					jQuery(".es_currency_loader").hide();
					
					jQuery("#es_currency_message").addClass('es_success').text(jQuery("#fieldDeleted").val());
					
					setTimeout(function(){
						
						jQuery("#es_currency_message").removeClass('es_success').text('');
							
					},2000)
					
					jQuery("#es_currency_listing ul li#currency_"+data).remove();
		
				}
			});
		 	 
		});
}

 