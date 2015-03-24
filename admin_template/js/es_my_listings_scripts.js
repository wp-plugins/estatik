var $ = jQuery;

$(document).ready(function(e) { 
 
	$('#es_selcted_copy,#es_selcted_del,#es_selcted_publish,#es_selcted_unpublish').val('no');
	
	$('.es_prop_address').each(function(index, element) {
		if($(this).text().indexOf("Choose Country")!=-1){
			$(this).text('');
		}		
    });
	
	
 
	$('.es_all_listing input[type="checkbox"], .es_all_listing_head input[type="checkbox"]').prop("checked",false)
	 	
	$('.es_all_listing_head input[type="checkbox"]').click(function(){
		
		if($(this).prop("checked")==true){
			
			$('.es_all_listing input[type="checkbox"]').prop("checked",true)
			$('.es_all_listing li').addClass('active');
			
		} else {
			
			$('.es_all_listing input[type="checkbox"]').prop("checked",false)
			$('.es_all_listing li').removeClass('active');
				
		}
	});	
	
	$('.es_all_listing input[type="checkbox"]').click(function(){
		
		if($(this).prop("checked")==true){
		
			$(this).parents('.es_all_listing li').addClass('active');
			
		} else {
			
			$(this).parents('.es_all_listing li').removeClass('active');
				
		}
	});	
	
	
	$('#es_listing_select_all').click(function(){
		
		$('.es_all_listing_head input[type="checkbox"], .es_all_listing input[type="checkbox"]').prop("checked",true)
		$('.es_all_listing li').addClass('active');
		
	});
	
	$('#es_listing_undo_selection').click(function(){
		
		$('.es_all_listing_head input[type="checkbox"], .es_all_listing input[type="checkbox"]').prop("checked",false)
		$('.es_all_listing li').removeClass('active');
		
	});
	
	$('.es_cancel, .es_close_popup, .es_ok').click(function(){
		$('.es_alert_popup').fadeOut(500)
	});	
	
	
	$('#es_listing_copy').click(function(){
		 
		 var es_select_list = "";
		 
		 $('.es_all_listing li input[type="checkbox"]').each(function(){
			if($(this).prop('checked')==true){
				es_select_list = "1";	
			}
		 })
		 
		 if(es_select_list==''){
			
			$('#select_popup').find('p').text('Please select properties you want to copy.');
			$('#select_popup').fadeIn(500);
			return false;	 
		 }
		 
		 $('#sure_popup').find('p').text('Are you sure you want to Copy it?');
		 $('#sure_popup').fadeIn(500);
		 
		 $('.es_ok').click(function(){
			$('#es_selcted_copy,#es_selcted_del,#es_selcted_publish,#es_selcted_unpublish').val('no');
			$("#es_selcted_copy").val('yes');
		 	$("#listing_actions").submit();
		});	
		 
	});
	
	
	$('.es_list_edit_del a:last-child').click(function(){
		
		 $('#sure_popup').find('p').text('Are you sure you want to delete it?');
		  $('#sure_popup').find('a.es_ok').attr('href',$(this).attr('href'));
		 $('#sure_popup').fadeIn(500);
		 
		 $('.es_ok').click(function(){
		 	$("#listing_actions").submit();
			return true;
		});	
	 	
		return false;
		
	});
	
	
	$('#es_listing_del').click(function(){
		 
		 
		 var es_select_list = "";
		 
		 $('.es_all_listing li input[type="checkbox"]').each(function(){
			if($(this).prop('checked')==true){
				es_select_list = "1";	
			}
		 })
		 
		 if(es_select_list==''){
			$('#select_popup').find('p').text('Please select properties you want to delete.');
			$('#select_popup').fadeIn(500);
			return false;	 
		 }
		 
		 $('#sure_popup').find('p').text('Are you sure you want to delete it?');
		 $('#sure_popup').fadeIn(500);
		 
		 $('.es_ok').click(function(){
			$('#es_selcted_copy,#es_selcted_del,#es_selcted_publish,#es_selcted_unpublish').val('no');
			$("#es_selcted_del").val('yes');
		 	$("#listing_actions").submit();
		});	
		 
	});
	
	$('#es_listing_publish').click(function(){
		
		 
		 var es_select_list = "";
		 
		 $('.es_all_listing li input[type="checkbox"]').each(function(){
			if($(this).prop('checked')==true){
				es_select_list = "1";	
			}
		 })
		 
		 if(es_select_list==''){
			$('#select_popup').find('p').text('Please select properties you want to publish.');
			$('#select_popup').fadeIn(500);
			return false;	 
		 }
		 
		 $('#sure_popup').find('p').text('Are you sure you want to publish it?');
		 $('#sure_popup').fadeIn(500);
		 
		 $('.es_ok').click(function(){
			$('#es_selcted_copy,#es_selcted_del,#es_selcted_publish,#es_selcted_unpublish').val('no');
			$("#es_selcted_publish").val('yes');
		 	$("#listing_actions").submit();
		});	
		 
	});
	
	$('#es_listing_unpublish').click(function(){
			
		 
		 var es_select_list = "";
		 
		 $('.es_all_listing li input[type="checkbox"]').each(function(){
			if($(this).prop('checked')==true){
				es_select_list = "1";	
			}
		 })
		 
		 if(es_select_list==''){
			$('#select_popup').find('p').text('Please select properties you want to unpublish.');
			$('#select_popup').fadeIn(500);
			return false;	 
		 }
		 
		 $('#sure_popup').find('p').text('Are you sure you want to unpublish it?');
		 $('#sure_popup').fadeIn(500);
		 
		 $('.es_ok').click(function(){
			$('#es_selcted_copy,#es_selcted_del,#es_selcted_publish,#es_selcted_unpublish').val('no');
			$("#es_selcted_unpublish").val('yes');
		 	$("#listing_actions").submit();
		});	
		 
	});	
 
	 
});
 

