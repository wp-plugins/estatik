 

jQuery(document).ready(function(e) { 
 
	var type ="";
	var id_url ="";
	
	jQuery('.es_tabs ul li a').click(function(){
		
		jQuery('.es_tabs ul li a').removeClass('active');
		
		jQuery(this).addClass('active');
			
		jQuery('.es_tabs_content_in').hide();
		
		var current_id=jQuery(this).attr('href');
		
		jQuery(current_id).show();
		
		type = current_id.replace("#", ""); 
		 
		window.history.pushState("", "", "admin.php?page=es_settings&type="+type);
		 
		return false;
		
	});
	
	
	jQuery('.es_layout input').click(function(){
		
		jQuery(this).parents('.es_layout').find('label').removeClass('active');
		
		jQuery(this).parent('label').addClass('active');
			
	});
	
	
	jQuery('.es_settings_field input').click(function(){
		
		jQuery(this).parents('.es_settings_field').find('label').removeClass('active');
		
		jQuery(this).parent('label').addClass('active');
			
	});
	
	jQuery('.es_images_setting_resize input').click(function(){
		
		jQuery(this).parents('.es_images_setting_resize').find('label').removeClass('active');
		
		jQuery(this).parent('label').addClass('active');
			
	});
 
 
});
 
 
 
 





