<?php
function es_front_settings(){
	
	global $wpdb;
	$es_settings = new stdClass;
	$es_settings_data = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_settings');
	$es_settings = $es_settings_data[0];
	
	return $es_settings; 
		
}


function estatik_front_scripts() {
	wp_enqueue_style( 'estatik-front-style', DIR_URL . 'front_templates/css/es_front_style.css');
	wp_enqueue_style( 'estatik-front-responsive-style', DIR_URL . 'front_templates/css/es_front_responsive.css');
	wp_enqueue_script('estatik-front-scripts', DIR_URL . 'front_templates/js/es_front_scripts.js' , array( 'jquery' ));
	wp_localize_script( 'estatik-front-scripts', 'estatik_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php'))); 
	
	wp_enqueue_script( 'jquery-ui-autocomplete');
	wp_enqueue_style( 'es-jquery-ui-style', DIR_URL . 'admin_template/css/jquery-ui.css');
	
	wp_enqueue_script('es-jquery-bxslider', DIR_URL . 'front_templates/js/jquery.bxslider.min.js' , array( 'jquery' ));
	
}
add_action( 'wp_enqueue_scripts', 'estatik_front_scripts' );


function es_print_scripts() {
	global $wpdb;
	$sql = 'SELECT prop_address FROM '.$wpdb->prefix.'estatik_properties WHERE prop_pub_unpub = 1 order by prop_id desc';
	$es_addresses 	  = $wpdb->get_results($sql);
	echo "<script type='text/javascript'>\n";
		$es_settings = es_front_settings();
		if(is_singular('properties')){
		
		echo "jQuery(window).load(function(e) { 
			  	var navPos = parseInt($('.es_prop_single_tabs').offset().top);
				$(window).scroll(function(e) { 
					if($(this).scrollTop()>=navPos) $('.es_prop_single_tabs').addClass('fixed');		
					else $('.es_prop_single_tabs').removeClass('fixed');
				});
			  });";
			}
			
			echo "  $(document).ready(function(e) { 
					var pagerWidth = $('#es_prop_single_pager_outer').width()/".$es_settings->prop_singleview_photo_thumb_width.";
					$('.es_prop_single_pics').bxSlider({
					  slideMargin: 0,
					  controls: false,
					  infiniteLoop: false,
					  maxSlides: 1,
					  pagerCustom: '.es_prop_single_pager'
					});
					$('.es_prop_single_pager').bxSlider({
					  slideWidth: ".$es_settings->prop_singleview_photo_thumb_width.",
					  slideMargin: 10,
					  pager: false,
					  infiniteLoop: false,
					  minSlides: parseInt(pagerWidth),
					  maxSlides: parseInt(pagerWidth),
					});
					$('.es_prop_single_pager li a').each(function(index, element) {
						$(this).attr('data-slide-index',index);
					});
				});";
			  	
			echo "jQuery(function() {
				var availableTags = [";
				if(!empty($es_addresses)) {
					foreach($es_addresses as $es_addres) {
						echo "'".$es_addres->prop_address."',";
					}
				 }
				echo "];
				jQuery( '.es_address_auto' ).autocomplete({
					source: availableTags
				});
			});
		";
	echo "\n</script>"; 
}
add_action( 'wp_footer', 'es_print_scripts' );


function es_google_map() {	
	echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>';
	if(is_singular('properties')){
	
		global $wpdb;
		global $post;
		$sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_properties WHERE prop_id = '.get_the_id().' order by prop_id desc';
		$es_prop_single_result = $wpdb->get_results($sql); 
		$es_prop_single = $es_prop_single_result[0];
		
		if($es_prop_single->prop_latitude!='' && $es_prop_single->prop_longitude!='') {
		
		echo "<script type='text/javascript'>
				function initialize() {
				  var myLatlng = new google.maps.LatLng(".$es_prop_single->prop_latitude.",".$es_prop_single->prop_longitude.");
				  var mapOptions = {
					zoom: 16,
					scrollwheel: false,
					center: myLatlng
				  }
				  var map = new google.maps.Map(document.getElementById('es_prop_single_view_map'), mapOptions);
				  var marker = new google.maps.Marker({
					  position: myLatlng,	  
					  map: map,
					  title: '".$es_prop_single->prop_title."'
				  });
				}
				google.maps.event.addDomListener(window, 'load', initialize);
			</script>";
							
		}
	
	}
	
}
add_action( 'wp_footer', 'es_google_map' );

 