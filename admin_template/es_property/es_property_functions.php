<?php

// function for Property Country States Insertion

function es_prop_country_states(){
 
	include("es_property_temps/es_property_states.php"); 

die();

}
add_action('wp_ajax_es_prop_country_states', 'es_prop_country_states'); 
add_action('wp_ajax_nopriv_es_prop_country_states', 'es_prop_country_states'); 


// function for Property State Cities Insertion

function es_prop_states_cities(){
 
	include("es_property_temps/es_property_cities.php"); 

die();

}
add_action('wp_ajax_es_prop_states_cities', 'es_prop_states_cities'); 
add_action('wp_ajax_nopriv_es_prop_states_cities', 'es_prop_states_cities'); 


// function for Property Media Images Insertion

require_once(PATH_DIR. 'admin_template/wideimage/WideImage.php');

function es_prop_media_images(){
 
	$es_prop_id = sanitize_text_field($_GET['es_prop_id']);
	$uploadedfile = $_FILES['es_media_images'];
	$upload_dir = wp_upload_dir(); 
	$save_image_array = array();
	
	$es_settings = es_front_settings();
 	
	for($i=0; $i<count($uploadedfile['name']); $i++){
 			
			$es_extention = explode(".",$uploadedfile['name'][$i]);
			$es_extention = strtolower(end($es_extention));
			
			if($es_extention == "zip"){
				$file_name = time()."_".$uploadedfile['name'][$i];
				$sourcePath = $uploadedfile['tmp_name'][$i];  
				$targetPath = $upload_dir['path']."/".$file_name;
				move_uploaded_file($sourcePath,$targetPath) ;
				$zip = new ZipArchive;
				$zip = zip_open($targetPath);
				if ($zip){
					while ($zip_entry = zip_read($zip)){
						$save_image_array[]	=	$upload_dir['subdir']."/".zip_entry_name($zip_entry);
					}
			   }
			   $zip = new ZipArchive;
			   $res = $zip->open($targetPath);
				$zip->extractTo($upload_dir['path']);
				$zip->close();
				@unlink($targetPath);
				
			}else if ($_FILES["es_media_images"]["error"][$i] == 0){
				$image_name = time()."_".$_FILES['es_media_images']['name'][$i];
				$sourcePath = $_FILES['es_media_images']['tmp_name'][$i];  
				$targetPath = $upload_dir['path']."/".$image_name;
				move_uploaded_file($sourcePath,$targetPath) ;
 
				es_crop($targetPath,$upload_dir['path']."/list_".$image_name,$es_settings->prop_listview_list_width, $es_settings->prop_listview_list_height);
				es_crop($targetPath,$upload_dir['path']."/2column_".$image_name,$es_settings->prop_listview_2column_width, $es_settings->prop_listview_2column_height);
				es_crop($targetPath,$upload_dir['path']."/table_".$image_name,$es_settings->prop_listview_table_width, $es_settings->prop_listview_table_height);
				
				es_crop($targetPath,$upload_dir['path']."/single_lr_".$image_name,$es_settings->prop_singleview_photo_lr_width, $es_settings->prop_singleview_photo_lr_height);
				es_crop($targetPath,$upload_dir['path']."/single_center_".$image_name,$es_settings->prop_singleview_photo_center_width, $es_settings->prop_singleview_photo_center_height);
				es_crop($targetPath,$upload_dir['path']."/single_thumb_".$image_name,$es_settings->prop_singleview_photo_thumb_width, $es_settings->prop_singleview_photo_thumb_height);
 
				$save_image_array[]	=	$upload_dir['subdir']."/".$image_name;
			}
	} 	

	
	global $wpdb;
	$old_images = "";
 	$prop_images = $wpdb->get_row( 'SELECT prop_meta_value FROM '.$wpdb->prefix.'estatik_properties_meta WHERE prop_id = '.$es_prop_id." and prop_meta_key = 'images'");
	if(!empty($prop_images)){
		$old_images 	 = $prop_images->prop_meta_value;
	}
	
	$upload_image_data = array();
	if($old_images !=""){
		$old_image_data = unserialize($old_images);
		$upload_image_data = array_merge($old_image_data,$save_image_array);
	}else{
		$upload_image_data  = $save_image_array;
	}
  
 	$wpdb->query('delete from '.$wpdb->prefix.'estatik_properties_meta WHERE prop_id = '.$es_prop_id." and prop_meta_key = 'images'");
	$wpdb->insert(
		$wpdb->prefix.'estatik_properties_meta',
		array(
			'prop_id' => $es_prop_id,
			'prop_meta_key'  => 'images',
			'prop_meta_value' => serialize($upload_image_data),
		)
	);

 
	include("es_property_temps/es_property_images.php"); 

die();

}
add_action('wp_ajax_es_prop_media_images', 'es_prop_media_images'); 
add_action('wp_ajax_nopriv_es_prop_media_images', 'es_prop_media_images'); 