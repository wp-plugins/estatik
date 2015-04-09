var $ = jQuery;

$(document).ready(function(e) { 
 
	 
	
	var type ="";
	var id_url ="";
	
	$('.es_tabs ul li a').click(function(){
		
		$('.es_tabs ul li a').removeClass('active');
		
		$(this).addClass('active');
			
		$('.es_tabs_content_in').hide();
		
		var current_id=$(this).attr('href');
		
		$(current_id).show();
		
		type = current_id.replace("#", ""); 
		 
		window.history.pushState("", "", "admin.php?page=es_settings&type="+type);
		 
		return false;
		
	});
	
	
	$('.es_layout input').click(function(){
		
		$(this).parents('.es_layout').find('label').removeClass('active');
		
		$(this).parent('label').addClass('active');
			
	});
	
	
	$('.es_settings_field input').click(function(){
		
		$(this).parents('.es_settings_field').find('label').removeClass('active');
		
		$(this).parent('label').addClass('active');
			
	});
	
	$('.es_images_setting_resize input').click(function(){
		
		$(this).parents('.es_images_setting_resize').find('label').removeClass('active');
		
		$(this).parent('label').addClass('active');
			
	});
 
 
});
 
 
 
 





