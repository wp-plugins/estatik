 

jQuery(document).ready(function(e) { 
 
	jQuery('#es_selcted_copy,#es_selcted_del,#es_selcted_publish,#es_selcted_unpublish').val('no');
	
	jQuery('.es_prop_address').each(function(index, element) {
		if(jQuery(this).text().indexOf("Choose Country")!=-1){
			jQuery(this).text('');
		}		
    });
	
	
 
	jQuery('.es_all_listing input[type="checkbox"], .es_all_listing_head input[type="checkbox"]').prop("checked",false)
	 	
	jQuery('.es_all_listing_head input[type="checkbox"]').click(function(){
		
		if(jQuery(this).prop("checked")==true){
			
			jQuery('.es_all_listing input[type="checkbox"]').prop("checked",true)
			jQuery('.es_all_listing li').addClass('active');
			
		} else {
			
			jQuery('.es_all_listing input[type="checkbox"]').prop("checked",false)
			jQuery('.es_all_listing li').removeClass('active');
				
		}
	});	
	
	jQuery('.es_all_listing input[type="checkbox"]').click(function(){
		
		if(jQuery(this).prop("checked")==true){
		
			jQuery(this).parents('.es_all_listing li').addClass('active');
			
		} else {
			
			jQuery(this).parents('.es_all_listing li').removeClass('active');
				
		}
	});	
	
	
	jQuery('#es_listing_select_all').click(function(){
		
		jQuery('.es_all_listing_head input[type="checkbox"], .es_all_listing input[type="checkbox"]').prop("checked",true)
		jQuery('.es_all_listing li').addClass('active');
		
	});
	
	jQuery('#es_listing_undo_selection').click(function(){
		
		jQuery('.es_all_listing_head input[type="checkbox"], .es_all_listing input[type="checkbox"]').prop("checked",false)
		jQuery('.es_all_listing li').removeClass('active');
		
	});
	
	jQuery('.es_cancel, .es_close_popup, .es_ok').click(function(){
		jQuery('.es_alert_popup').fadeOut(500)
	});	
	
	
	jQuery('#es_listing_copy').click(function(){
		 
		 var es_select_list = "";
		 
		 jQuery('.es_all_listing li input[type="checkbox"]').each(function(){
			if(jQuery(this).prop('checked')==true){
				es_select_list = "1";	
			}
		 })
		 
		 if(es_select_list==''){
			
			jQuery('#select_popup').find('p').text(jQuery("#selPropertiesToCopy").val());
			jQuery('#select_popup').fadeIn(500);
			return false;	 
		 }
		 
		 jQuery('#sure_popup').find('p').text(jQuery("#sureToCopy").val());
		 jQuery('#sure_popup').fadeIn(500);
		 
		 jQuery('.es_ok').click(function(){
			jQuery('#es_selcted_copy,#es_selcted_del,#es_selcted_publish,#es_selcted_unpublish').val('no');
			jQuery("#es_selcted_copy").val('yes');
		 	jQuery("#listing_actions").submit();
		});	
		 
	});
	
	
	jQuery('.es_list_edit_del a:last-child').click(function(){
		
		 jQuery('#sure_popup').find('p').text(jQuery("#sureToDelete").val());
		  jQuery('#sure_popup').find('a.es_ok').attr('href',jQuery(this).attr('href'));
		 jQuery('#sure_popup').fadeIn(500);
		 
		 jQuery('.es_ok').click(function(){
		 	jQuery("#listing_actions").submit();
			return true;
		});	
	 	
		return false;
		
	});
	
	
	jQuery('#es_listing_del').click(function(){
		 
		 
		 var es_select_list = "";
		 
		 jQuery('.es_all_listing li input[type="checkbox"]').each(function(){
			if(jQuery(this).prop('checked')==true){
				es_select_list = "1";	
			}
		 })
		 
		 if(es_select_list==''){
			jQuery('#select_popup').find('p').text(jQuery("#selPropertiesToDelete").val());
			jQuery('#select_popup').fadeIn(500);
			return false;	 
		 }
		 
		 jQuery('#sure_popup').find('p').text(jQuery("#sureToDelete").val());
		 jQuery('#sure_popup').fadeIn(500);
		 
		 jQuery('.es_ok').click(function(){
			jQuery('#es_selcted_copy,#es_selcted_del,#es_selcted_publish,#es_selcted_unpublish').val('no');
			jQuery("#es_selcted_del").val('yes');
		 	jQuery("#listing_actions").submit();
		});	
		 
	});
	
	jQuery('#es_listing_publish').click(function(){
		
		 
		 var es_select_list = "";
		 
		 jQuery('.es_all_listing li input[type="checkbox"]').each(function(){
			if(jQuery(this).prop('checked')==true){
				es_select_list = "1";	
			}
		 })
		 
		 if(es_select_list==''){
			jQuery('#select_popup').find('p').text(jQuery("#selPropertiesToPublish").val());
			jQuery('#select_popup').fadeIn(500);
			return false;	 
		 }
		 
		 jQuery('#sure_popup').find('p').text(jQuery("#sureToPublish").val());
		 jQuery('#sure_popup').fadeIn(500);
		 
		 jQuery('.es_ok').click(function(){
			jQuery('#es_selcted_copy,#es_selcted_del,#es_selcted_publish,#es_selcted_unpublish').val('no');
			jQuery("#es_selcted_publish").val('yes');
		 	jQuery("#listing_actions").submit();
		});	
		 
	});
	
	jQuery('#es_listing_unpublish').click(function(){
			
		 
		 var es_select_list = "";
		 
		 jQuery('.es_all_listing li input[type="checkbox"]').each(function(){
			if(jQuery(this).prop('checked')==true){
				es_select_list = "1";	
			}
		 })
		 
		 if(es_select_list==''){
			jQuery('#select_popup').find('p').text(jQuery("#selPropertiesToUnPublish").val());
			jQuery('#select_popup').fadeIn(500);
			return false;	 
		 }
		 
		 jQuery('#sure_popup').find('p').text(jQuery("#sureToUnPublish").val());
		 jQuery('#sure_popup').fadeIn(500);
		 
		 jQuery('.es_ok').click(function(){
			jQuery('#es_selcted_copy,#es_selcted_del,#es_selcted_publish,#es_selcted_unpublish').val('no');
			jQuery("#es_selcted_unpublish").val('yes');
		 	jQuery("#listing_actions").submit();
		});	
		 
	});	
 
	 
});
 

