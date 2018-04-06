<?php



function es_restrict_admin() {

    global $current_user;

	if ( @$current_user->roles[0]=="agent_role" ) {

        if(!isset($_REQUEST['action'])) {

	    	wp_redirect( site_url() );

		}

    }

}

add_action( 'admin_init', 'es_restrict_admin', 1 ); 	

 

 

function es_app_output_buffer() {

	ob_start();

} // soi_output_buffer

add_action('init', 'es_app_output_buffer');





function es_remove_admin_bar() {

	if (!current_user_can('administrator') && !is_admin()) {

	  show_admin_bar(false);

	}

}

add_action('after_setup_theme', 'es_remove_admin_bar'); 

 





function esproperties() {

  $labels = array(

    'name'               => _x( 'Properties', 'post type general name' ),

    'singular_name'      => _x( 'Properties', 'post type singular name' ),

    'add_new'            => _x( 'Add New', 'Property' ),

    'add_new_item'       => __( 'Add New Property' ),

    'edit_item'          => __( 'Edit Property' ),

    'new_item'           => __( 'New Property' ),

    'all_items'          => __( 'All Properties' ),

    'view_item'          => __( 'View Properties' ),

    'search_items'       => __( 'Search Properties' ),

    'not_found'          => __( 'No Properties found' ),

    'not_found_in_trash' => __( 'No Properties found in the Trash' ), 

    'parent_item_colon'  => '',

    'menu_name'          => 'Estatik properties'

  );

  $args = array(

    'labels'        => $labels,

    'description'   => 'Holds our Properties and Property specific data',

    'public'        => true,

    'menu_position' => 5,

    'supports'      => array( 'title', 'editor'),

    'has_archive'   => true,

  );

  register_post_type( 'properties', $args ); 

}

add_action( 'init', 'esproperties' );





function es_categories_property() {

  $labels = array(

    'name'              => _x( 'Property Categories', 'taxonomy general name' ),

    'singular_name'     => _x( 'Property Category', 'taxonomy singular name' ),

    'search_items'      => __( 'Search Property Categories' ),

    'all_items'         => __( 'All Property Categories' ),

    'parent_item'       => __( 'Parent Property Category' ),

    'parent_item_colon' => __( 'Parent Property Category:' ),

    'edit_item'         => __( 'Edit Property Category' ), 

    'update_item'       => __( 'Update Property Category' ),

    'add_new_item'      => __( 'Add New Property Category' ),

    'new_item_name'     => __( 'New Property Category' ),

    'menu_name'         => __( 'Property Categories' ),

  );

  $args = array(

    'labels' => $labels,

    'hierarchical' => true,

	    'show_in_nav_menus' => false,



  );

  register_taxonomy( 'property_category', 'properties', $args );

}

add_action( 'init', 'es_categories_property', 0 );





function es_status_property() {

  $labels = array(

    'name'              => _x( 'Property Status', 'taxonomy general name' ),

    'singular_name'     => _x( 'Property Status', 'taxonomy singular name' ),

    'search_items'      => __( 'Search Status Categories' ),

    'all_items'         => __( 'All Status Categories' ),

    'parent_item'       => __( 'Parent Status Category' ),

    'parent_item_colon' => __( 'Parent Status Category:' ),

    'edit_item'         => __( 'Edit Status Category' ), 

    'update_item'       => __( 'Update Status Category' ),

    'add_new_item'      => __( 'Add New Status Category' ),

    'new_item_name'     => __( 'New Status Category' ),

    'menu_name'         => __( 'Status Categories' ),

  );

  $args = array(

    'labels' => $labels,

    'hierarchical' => true,

	    'show_in_nav_menus' => false,



  );

  register_taxonomy( 'property_status', 'properties', $args );

}

add_action( 'init', 'es_status_property', 0 );





function es_type_property() {

  $labels = array(

    'name'              => _x( 'Property Types', 'taxonomy general name' ),

    'singular_name'     => _x( 'Property Types', 'taxonomy singular name' ),

    'search_items'      => __( 'Search Types Categories' ),

    'all_items'         => __( 'All Types Categories' ),

    'parent_item'       => __( 'Parent Type Category' ),

    'parent_item_colon' => __( 'Parent Type Category:' ),

    'edit_item'         => __( 'Edit Type Category' ), 

    'update_item'       => __( 'Update Type Category' ),

    'add_new_item'      => __( 'Add New Type Category' ),

    'new_item_name'     => __( 'New Type Category' ),

    'menu_name'         => __( 'Type Categories' ),

  );

  $args = array(

    'labels' => $labels,

    'hierarchical' => true,

	    'show_in_nav_menus' => false,



  );

  register_taxonomy( 'property_type', 'properties', $args );

}

add_action( 'init', 'es_type_property', 0 );

 

 

function es_remove_properties_menu(){

  remove_menu_page( 'edit.php?post_type=properties' );    //properties

}

add_action( 'admin_menu', 'es_remove_properties_menu' );





function estatik_scripts(){

	

	wp_enqueue_style( 'estatik-style', DIR_URL . 'admin_template/css/es_admin_style.css');

	wp_enqueue_style( 'estatik-responsive-style', DIR_URL . 'admin_template/css/es_admin_responsive.css');

	

	wp_enqueue_script('flexslider_script', DIR_URL . 'admin_template/js/jquery.flexslider-min.js' , array( 'jquery' ));

	wp_enqueue_script('estatik_scripts', DIR_URL . 'admin_template/js/es_admin_scripts.js' , array( 'jquery', 'flexslider_script' ));

	wp_localize_script( 'estatik_scripts', 'estatik_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php'))); 

	

	if(isset($_GET['page']) && $_GET['page']=='es_settings'){

		wp_enqueue_script('es_settings_scripts', DIR_URL . 'admin_template/js/es_settings_scripts.js' , array( 'jquery' ));

	}

	if(isset($_GET['page']) && $_GET['page']=='es_my_listings'){

		wp_enqueue_script('es-my-listings-scripts', DIR_URL . 'admin_template/js/es_my_listings_scripts.js' , array( 'jquery' ));

		wp_enqueue_script( 'jquery-ui-datepicker');

		wp_enqueue_style( 'es-jquery-ui-style', DIR_URL . 'admin_template/css/jquery-ui.css');

	}

	if(isset($_GET['page']) && $_GET['page']=='es_add_new_property'){

		wp_enqueue_script('es_manager_scripts', DIR_URL . 'admin_template/js/es_manager_scripts.js' , array( 'jquery' ));

		wp_enqueue_script('es_property_scripts', DIR_URL . 'admin_template/js/es_property_scripts.js' , array( 'jquery' ));

		wp_enqueue_script( 'jquery-ui-sortable');

		wp_enqueue_script('es-google-maps', 'http://maps.googleapis.com/maps/api/js?sensor=false' , array( 'jquery' ));

	}

	if(isset($_GET['page']) && $_GET['page']=='es_data_manager'){

		wp_enqueue_script('es_manager_scripts', DIR_URL . 'admin_template/js/es_manager_scripts.js' , array( 'jquery' ));

	}

 

}

add_action( 'admin_enqueue_scripts', 'estatik_scripts' );





function es_admin_inline_head_js(){

	echo "<script type='text/javascript'>\n";

		if(isset($_GET['page']) && $_GET['page']=='es_add_new_property' && isset($_GET['prop_id'])){

			echo "var prop_id = ".@$_GET['prop_id'].";";

		}else{

			echo "var prop_id = ''";

		}

	echo "\n</script>";

}

add_action( 'admin_print_scripts', 'es_admin_inline_head_js' );





function es_admin_inline_js(){

	echo "<script type='text/javascript'>\n

			jQuery(window).load(function(e) {

		";

		

	if(isset($_GET['page']) && $_GET['page']=='es_dashboard'){

		echo "jQuery('#es_themes_slides').flexslider({

				animation: 'slide',

				animationLoop: false,

				controlNav: false,

				itemWidth: 238,

				itemMargin: 5

			  })";

	}

	

	if(isset($_GET['page']) && ($_GET['page']=='es_settings' || $_GET['page']=='es_data_manager' || $_GET['page']=='es_add_new_property')){

		if(isset($_GET['type'])){ 

			$href =  $_GET['type'];

			echo "var type =''; 

				var media =''; 

				jQuery('.es_tabs ul li a').each(function(index, element) {

					var href = jQuery(this).attr('href');

					type = href.replace('#', '');

					if(type=='".$href."'){

						jQuery(this).trigger('click');

					}

				});";

		 } else { 

			echo "jQuery('.es_tabs ul li:first-child a').click();";

		 } 

	}

	

	if(isset($_GET['page']) && $_GET['page']=='es_my_listings'){

		echo "jQuery(function() {

				jQuery('#es_date_added').datepicker({

					showOn: 'button',

					buttonImage: '".DIR_URL."admin_template/images/es_calender_icon.jpg',

					buttonImageOnly: true,

				});

			});";

	}

	

	if(isset($_GET['page']) && $_GET['page']=='es_add_new_property'){

		echo "jQuery('.es_tabs ul li a').click(function(){			 

			myGeocodeFirst();

		});";

	}

	

 

	echo "

		})

	\n</script>";

	

	

	echo "<script type='text/javascript'>\n";

	if(isset($_GET['page']) && $_GET['page']=='es_add_new_property'){

		echo "

			  var map;

			  var geocoder;

			  var markers = new Array();

			  var firstLoc;

			  function myGeocodeFirst() {

				geocoder = new google.maps.Geocoder();

				var es_adress = jQuery('#prop_street').val()+', '+ jQuery('#es_cities option:selected').text()+', '+ jQuery('#es_states option:selected').text()+', '+ jQuery('#es_country option:selected').text();

				if(jQuery('#es_cities option:selected').val()!=''){

					jQuery('#prop_address').val(es_adress);

				}

				//console.log(es_adress);

				geocoder.geocode( {'address': es_adress },

				  function(results, status) {

					if (status == google.maps.GeocoderStatus.OK) {

					  firstLoc = results[0].geometry.location;

					  //console.log(firstLoc);

					  document.getElementById('prop_longitude').value = results[0].geometry.location.lng();

					  document.getElementById('prop_latitude').value = results[0].geometry.location.lat();

					  map = new google.maps.Map(document.getElementById('es_address_map'),

					  {

						center: firstLoc,

						zoom: 16,

						mapTypeId: google.maps.MapTypeId.ROADMAP

					  });

				var marker = new google.maps.Marker({

                            position: firstLoc,

                            draggable: true,

                            map: map,

                            title: 'It\'s here!'

                          });

                          marker.addListener('dragend', function(pos) {
                              document.getElementById('prop_longitude').value = pos.latLng.lng();
                              document.getElementById('prop_latitude').value = pos.latLng.lat();
                          });

					} 

					else {

					  document.getElementById('es_address_map').value = status;

					}

				  }

				);

			  }

			window.onload=myGeocodeFirst;";

	}	

	echo " \n</script>";	

	

}

add_action( 'admin_print_footer_scripts', 'es_admin_inline_js' );





function es_crop($file,$saveAs=NULL,$width=100,$height=100)

{

	if (!class_exists('WideImage'))

		die('"smart_crop" requires "WideImage Library" to be included.');

	if ($saveAs == NULL)

		$saveAs = $file;

	list($w, $h) = getimagesize($file);

	$wpercent = ($w/$width)*100;

	$hpercent = ($h/$height)*100;

	$img = WideImage::load($file);

	if ($wpercent >= 100 && $hpercent >= 100) {

		// Both is over 100% of the allowed size, then resize so the smalle side match.

		if ($wpercent > $hpercent) {

			// height is smallest

			$remove_percent = $hpercent - 100;

		}else{

			// width is smallest

			$remove_percent = $wpercent - 100;

		}

		$new_h_percent = $hpercent - $remove_percent;

		$new_w_percent = $wpercent - $remove_percent;

		$new_w = $width*(1+($new_w_percent-100));

		$new_h = $height*(1+($new_h_percent-100));

		$img = $img->resize($new_w, $new_h, 'inside');

		$img = $img->crop("center", "middle", $width, $height);

	}else {

		// One of them is smaller than 100% of the allowed size

		if ($wpercent > $hpercent) {

			// height is smallest

			$add_percent = 100 - $hpercent;

		}else{

			// width is smallest

			$add_percent = 100 - $wpercent;

		}

		$new_h_percent = $hpercent + $add_percent;

		$new_w_percent = $wpercent + $add_percent;

		$new_w = $width*(1+($new_w_percent-100));

		$new_h = $height*(1+($new_h_percent-100));

		$img = $img->resize($new_w, $new_h, 'inside');

		$img = $img->crop("center", "middle", $width, $height);

	}

	$img->saveToFile($saveAs);

}



require_once("es_manager/es_manager_functions.php");



require_once("es_property/es_property_functions.php");



require_once("es_widgets.php");



require_once("es_default_insertion.php");