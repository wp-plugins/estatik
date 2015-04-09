

var $ = jQuery;

$(document).ready(function(e) { 
 
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
  
  
});
 