<?php 	
 	$es_settings = es_front_settings();
	if(isset($prop_images) && isset($es_prop_id)==""){
			
		$sql = "SELECT prop_meta_value FROM ".$wpdb->prefix."estatik_properties_meta WHERE prop_id = '".$prop_id."' AND prop_meta_key = 'images'";
	 
		$uploaded_images_obj = $wpdb->get_row($sql);
 		 
		$upload_image_data = (!empty($uploaded_images_obj))?unserialize($uploaded_images_obj->prop_meta_value):"";
		
		//print_r($upload_image_data);
	
	}
	
	if(!empty($upload_image_data)) {
		$upload_dir = wp_upload_dir(); 
?>            
<ul>
	<?php foreach($upload_image_data as $list) {
		
		$image_name = explode("/",$list);
		$image_name = end($image_name);
		$image_path = str_replace($image_name,"",$list);
		$latest_image = $image_path.'list_'.$image_name;
		
	?>
		<li>
        	<div class="es_media_image">
                  <img src="<?php echo $upload_dir['baseurl']?><?php echo $latest_image?>" alt="" />
                  <input type="hidden" value="<?php echo $list?>" name="uploaded_images[]"  />
                  <div class="es_media_image_hover">
                      <small onclick="es_media_image_del(this)"></small>
                      <span></span>
                  </div>
            </div>
        </li>
		
	<?php } ?>
</ul> 

<?php } else { ?>

	<p>No record found. please add new one.</p>

<?php } ?>