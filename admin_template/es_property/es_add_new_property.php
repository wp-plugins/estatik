<?php

global $wpdb;
 
$es_settings = es_front_settings();
 
if(isset($_POST['prop_id'])){
 
	$agent_id 			= sanitize_text_field($_POST['agent_id']);
	$prop_title 		= sanitize_text_field($_POST['prop_title']);
	$prop_type 			= sanitize_text_field($_POST['prop_type']);
	$prop_category 		= sanitize_text_field($_POST['prop_category']);
	$prop_status 		= sanitize_text_field($_POST['prop_status']);
	$prop_featured 		= sanitize_text_field($_POST['prop_featured']);
	
	$prop_hot 			= sanitize_text_field($_POST['prop_hot']);
	$prop_open_house 	= sanitize_text_field($_POST['prop_open_house']);
	$prop_foreclosure 	= sanitize_text_field($_POST['prop_foreclosure']);
	
	$prop_price 		= sanitize_text_field($_POST['prop_price']);
	$prop_period 		= sanitize_text_field($_POST['prop_period']);
	$prop_bedrooms 		= sanitize_text_field($_POST['prop_bedrooms']);
	$prop_bathrooms 	= sanitize_text_field($_POST['prop_bathrooms']);
	$prop_floors 		= sanitize_text_field($_POST['prop_floors']);
	$prop_area 			= sanitize_text_field($_POST['prop_area']);
	$prop_lotsize 		= sanitize_text_field($_POST['prop_lotsize']);
	$prop_builtin 		= sanitize_text_field($_POST['prop_builtin']);
	$prop_description 	= $_POST['prop_description'];
	
	$country_id 		= sanitize_text_field($_POST['country_id']);
	$state_id 			= sanitize_text_field($_POST['state_id']);
	$city_id 			= sanitize_text_field($_POST['city_id']);
	$prop_zip_postcode 	= sanitize_text_field($_POST['prop_zip_postcode']);
	$prop_street 		= sanitize_text_field($_POST['prop_street']);
	
	if($country_id!="" || $state_id!="" || $city_id!=""){
	
		$prop_address		= sanitize_text_field($_POST['prop_address']);
	
	}else{
		
		$prop_address		= '';
		
	}
	 
	
	$prop_longitude 	= sanitize_text_field($_POST['prop_longitude']);
	$prop_latitude 		= sanitize_text_field($_POST['prop_latitude']);


	$prop_id			= sanitize_text_field($_POST['prop_id']);
 
	if(!isset($_GET['prop_id'])){
		
		 
		$my_post = array(
		  'post_title'    => $prop_title,
		  'post_status'   => 'publish',
		  'post_content'  =>  '[es_single_property]',
		  'post_author'   => $agent_id,
		  'post_type'     => 'properties',
		);
 
		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );
		
		wp_set_object_terms( $post_id, (int)$prop_category, 'property_category');
		wp_set_object_terms( $post_id, (int)$prop_status, 'property_status');
		wp_set_object_terms( $post_id, (int)$prop_type, 'property_type');
 
		$wpdb->insert(
		$wpdb->prefix.'estatik_properties',
		array(
			'prop_id' 			=> $post_id,
			'agent_id' 			=> $agent_id,
			'prop_date_added' 	=> time(),
			'prop_pub_unpub' 	=> 1,
			'prop_title' 		=> $prop_title,
			'prop_type' 		=> $prop_type,
			'prop_category' 	=> $prop_category,
			'prop_status' 		=> $prop_status,
			'prop_featured' 	=> $prop_featured,
			'prop_hot' 			=> $prop_hot,
			'prop_open_house' 	=> $prop_open_house,
			'prop_foreclosure' 	=> $prop_foreclosure,
			'prop_price' 		=> $prop_price,
			'prop_period' 		=> $prop_period,
			'prop_bedrooms' 	=> $prop_bedrooms,
			'prop_bathrooms' 	=> $prop_bathrooms,
			'prop_floors' 		=> $prop_floors,
			'prop_area' 		=> $prop_area,
			'prop_lotsize' 		=> $prop_lotsize,
			'prop_builtin' 		=> $prop_builtin,
			'prop_description' 	=> $prop_description,
			'country_id' 		=> $country_id,
			'state_id' 			=> $state_id,
			'city_id' 			=> $city_id,
			'prop_zip_postcode' => $prop_zip_postcode,
			'prop_street' 		=> $prop_street,
			'prop_address' 		=> $prop_address,
			'prop_longitude' 	=> $prop_longitude,
			'prop_latitude' 	=> $prop_latitude,
		)
	);
		$prop_id = $wpdb->insert_id;
		
	}else{
		
		 $my_post = array(
			  'ID'           => $prop_id,
			  'post_title'    => $prop_title,
			  'post_type'     => 'properties'
		  );
		
		// Update the post into the database
		$post_id = wp_update_post( $my_post );
		   
		wp_set_object_terms( $post_id, (int)$prop_category, 'property_category');
		wp_set_object_terms( $post_id, (int)$prop_status, 'property_status');
		wp_set_object_terms( $post_id, (int)$prop_type, 'property_type');
		
		$wpdb->update(
		$wpdb->prefix.'estatik_properties',
		array(
			'prop_title' 		=> $prop_title,
			'prop_type' 		=> $prop_type,
			'prop_category' 	=> $prop_category,
			'prop_status' 		=> $prop_status,
			'prop_featured' 	=> $prop_featured,
			'prop_hot' 			=> $prop_hot,
			'prop_open_house' 	=> $prop_open_house,
			'prop_foreclosure' 	=> $prop_foreclosure,
			'prop_price' 		=> $prop_price,
			'prop_period' 		=> $prop_period,
			'prop_bedrooms' 	=> $prop_bedrooms,
			'prop_bathrooms' 	=> $prop_bathrooms,
			'prop_floors' 		=> $prop_floors,
			'prop_area' 		=> $prop_area,
			'prop_lotsize' 		=> $prop_lotsize,
			'prop_builtin' 		=> $prop_builtin,
			'prop_description' 	=> $prop_description,
			'country_id' 		=> $country_id,
			'state_id' 			=> $state_id,
			'city_id' 			=> $city_id,
			'prop_zip_postcode' => $prop_zip_postcode,
			'prop_street' 		=> $prop_street,
			'prop_address' 		=> $prop_address,
			'prop_longitude' 	=> $prop_longitude,
			'prop_latitude' 	=> $prop_latitude,
		),
		array( 'prop_id' => $prop_id )
	); 
	
	}
	
	
	$prop_meta = $_POST['prop_data'];
 
	$wpdb->delete( $wpdb->prefix.'estatik_properties_meta', array( 'prop_id' => $prop_id,'prop_meta_key'=>'prop_custom_field') );
 	
	if(!empty($prop_meta)){
		$prop_meta_data = serialize($prop_meta);
		$wpdb->insert(
			$wpdb->prefix.'estatik_properties_meta',
			array(
				'prop_id' 		=> $prop_id,
				'prop_meta_key' => 'prop_custom_field',
				'prop_meta_value' 	=>$prop_meta_data
			)
		);
	}
	
	
	
	$es_image_del_val = $_POST['es_image_del_val'];
	if(!empty($es_image_del_val)){
		for($i=0; $i<count($es_image_del_val); $i++) {
			$upload_dir = wp_upload_dir();
			@unlink($upload_dir['basedir'].$es_image_del_val[$i]);
			
			$list_image_name = end(explode("/",$es_image_del_val[$i]));
			$list_image_path = str_replace($list_image_name,"",$es_image_del_val[$i]);
			$list_image = $list_image_path.'list_'.$list_image_name;
			@unlink($upload_dir['basedir'].$list_image);
			
			$list2_image_name = end(explode("/",$es_image_del_val[$i]));
			$list2_image_path = str_replace($list2_image_name,"",$es_image_del_val[$i]);
			$list2_image = $list2_image_path.'2column_'.$list2_image_name;
			@unlink($upload_dir['basedir'].$list2_image);
			
			$table_image_name = end(explode("/",$es_image_del_val[$i]));
			$table_image_path = str_replace($table_image_name,"",$es_image_del_val[$i]);
			$table_image = $table_image_path.'table_'.$table_image_name;
			@unlink($upload_dir['basedir'].$table_image);
			
			$single_lr_image_name = end(explode("/",$es_image_del_val[$i]));
			$single_lr_image_path = str_replace($single_lr_image_name,"",$es_image_del_val[$i]);
			$single_lr_image = $single_lr_image_path.'single_lr_'.$single_lr_image_name;
			@unlink($upload_dir['basedir'].$single_lr_image);
			
			$single_center_image_name = end(explode("/",$es_image_del_val[$i]));
			$single_center_image_path = str_replace($single_center_image_name,"",$es_image_del_val[$i]);
			$single_center_image = $single_center_image_path.'single_center_'.$single_center_image_name;
			@unlink($upload_dir['basedir'].$single_center_image);
			
			$single_thumb_image_name = end(explode("/",$es_image_del_val[$i]));
			$single_thumb_image_path = str_replace($single_thumb_image_name,"",$es_image_del_val[$i]);
			$single_thumb_image = $single_thumb_image_path.'single_thumb_'.$single_thumb_image_name;
			@unlink($upload_dir['basedir'].$single_thumb_image);
 
		}
	}
 
	$prop_media_images = $_POST['uploaded_images'];
	$wpdb->delete( $wpdb->prefix.'estatik_properties_meta', array( 'prop_id' => $prop_id,'prop_meta_key'=>'images') );
	if(!empty($prop_media_images)){
		$prop_meta_data = serialize($prop_media_images);
		$wpdb->insert(
			$wpdb->prefix.'estatik_properties_meta',
			array(
				'prop_id' 		=> $prop_id,
				'prop_meta_key' => 'images',
				'prop_meta_value' 	=>$prop_meta_data
			)
		);
	}
	
	$es_prop_feature	= $_POST['es_prop_feature'];
	$wpdb->delete( $wpdb->prefix.'estatik_properties_features', array( 'prop_id' => $prop_id ) );
	if(!empty($es_prop_feature)){
		 
		for($i = 0; $i < count($es_prop_feature); $i++){
			$wpdb->insert(
					$wpdb->prefix.'estatik_properties_features',
					array(
						'feature_id' 		=> $es_prop_feature[$i],
						'prop_id' 		=> $prop_id,
					)
				);
		}
	}
	
	
	$es_prop_appliance	= $_POST['es_prop_appliance'];
	$wpdb->delete( $wpdb->prefix.'estatik_properties_appliances', array( 'prop_id' => $prop_id ) );
	if(!empty($es_prop_appliance)){
		for($i = 0; $i < count($es_prop_appliance); $i++){
			$wpdb->insert(
					$wpdb->prefix.'estatik_properties_appliances',
					array(
						'appliance_id' 		=> $es_prop_appliance[$i],
						'prop_id' 		=> $prop_id,
					)
				);
		}
	}
 
	if(isset($_POST['es_prop_save'])){
	
		wp_redirect('?page=es_add_new_property&prop_id='.$prop_id.'&status=1',301); exit;

	} else {
	
		wp_redirect('?page=es_my_listings',301); exit;	
	
	}

} ?>
 
<div class="es_wrapper"> 
 	
    <div class="es_alert_popup" id="sure_popup">
    	<div class="es_alert_popup_overlay"></div>
        <div class="es_alert_popup_in boxSizing">
        	<p>Are you sure you want to delete it?</p>
            <ul>
            	<li><a class="es_ok" href="javascript:void(0)">Ok</a></li>
                <li><a class="es_cancel" href="javascript:void(0)">Cancel</a></li>
            </ul>
            <a href="javascript:void(0)" class="es_close_popup"></a>
        </div>
    </div>
    
    <div class="es_header clearFix">
        <?php if(isset($_GET['prop_id'])) { ?> 
 
 			<h2>Edit Property</h2>
            
        <?php }else { ?>
			
            <h2>New Property</h2>
            
        <?php } ?>
        
        <h3><img src="<?php echo DIR_URL.'admin_template/';?>images/estatik_simple.png" alt="#" /><small>Ver. 1.0</small></h3>
    </div>
    
    <form method="post" id="es_prop_insertion" action="">
    
    <?php if(isset($_GET['prop_id'])) { ?> 
 
        <div class="esHead clearFix">
            <p>Please Edit your property detail and click save to finish.</p>
            <input class="save_close" type="submit" value="Save & Close" name="es_prop_save_close" />
            <input type="submit" value="Save" name="es_prop_save" />
        </div>
 
    <?php }else { ?>
    
    	<div class="esHead clearFix">
            <p class="floatLeft">Please fill up your property detail and click save to finish.</p>
            <input type="submit" class="save_close" value="Save & Close" name="es_prop_save_close" />
            <input type="submit" value="Save" name="es_prop_save" />
        </div>
    
    <?php } ?>
    
    <?php if(isset($_GET['prop_id']) && isset($_GET['status'])) { ?>
        
        <div class="es_success">Property has been updated.</div>	
    
    <?php } ?>
 
    
    <div class="es_content_in addNewProp">
        
        <div class="es_tabs clearFix">
     		<ul>
            	<li><a href="#es_basic_info">Basic information</a></li>
                <li><a href="#es_address">Address</a></li>
                <li><a href="#es_prop_features">Features</a></li>
                <li><a href="#es_media">Media</a></li>
            </ul>
        </div>
        
        <?php 
			$prop_edit = "";
			$prop_meta = "";
			if(isset($_GET['prop_id'])) { 
				$prop_edit = $wpdb->get_row( 'SELECT * FROM '.$wpdb->prefix.'estatik_properties WHERE prop_id = '.$_GET['prop_id']);
				$prop_meta_data = $wpdb->get_row( 'SELECT prop_meta_value FROM '.$wpdb->prefix.'estatik_properties_meta WHERE prop_id = '.$_GET['prop_id']." and prop_meta_key = 'prop_custom_field'");
				if(!empty($prop_meta_data)){
					$prop_meta = $prop_meta_data->prop_meta_value;
				}
			}
		?>
        
        <div class="es_tabs_contents clearFix">
            <input type="hidden" name="agent_id" value="<?php echo get_current_user_id();?>" />
            <div id="es_basic_info" class="es_tabs_content_in clearFix">     
  				<div class="new_prop_fields_wrap clearFix">
                
                    <div id="es_basic_info_in">
                       
                        <div class="new_prop_field clearFix">
                            <span>Property ID:</span>
                            
                            <?php  
								$prop_id = "";
								if(isset($_GET['prop_id'])){
									$prop_id = $_GET['prop_id'];
								}
								else
								{
									$lastid_obj = new stdClass;		
									$sql = "SELECT `AUTO_INCREMENT` as ID
									FROM  INFORMATION_SCHEMA.TABLES
									WHERE TABLE_SCHEMA = '".DB_NAME."'
									AND TABLE_NAME = '".$wpdb->prefix."posts'";
									$lastid_obj = $wpdb->get_row($sql);									
									$prop_id = $lastid_obj->ID;
								}
							 ?>
                            
                            <input type="text" id="prop_id" name="prop_id" readonly="readonly" value="<?php echo $prop_id?>" />
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Title:</span>
                            <input type="text" name="prop_title" value="<?php echo (!empty($prop_edit))?$prop_edit->prop_title:'' ?>" />
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Type:</span>
                            <select name="prop_type">
								<option value="">Type</option>
								<?php
								$selected ="";
								$es_type_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_types' );
                                    if(!empty($es_type_listing)) {
                                        foreach($es_type_listing as $list) {
											if(!empty($prop_edit)){
												$selected = ($prop_edit->prop_type==$list->type_id) ? 'selected="selected"' : "";
											}
											echo'<option '.$selected.' value="'.$list->type_id.'">'.$list->type_title.'</option>';
                                        }
                                    } ?>
                            </select>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Category:</span>
                            <select name="prop_category" id="es_show_period">
                            	<option value="">Category</option>
                            	<?php $es_category_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_categories' );	
                                    $selected ="";
									if(!empty($es_category_listing)) {
                                        foreach($es_category_listing as $list) {	
                                            if(!empty($prop_edit)){
												$selected = ($prop_edit->prop_category==$list->cat_id) ? 'selected="selected"' : "";
											}
											echo'<option '.$selected.' value="'.$list->cat_id.'">'.$list->cat_title.'</option>';
                                        }
                                    } ?>
                            </select>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Status:</span>
                            <select name="prop_status">
                            	<option value="">Status</option>
                            	<?php $es_status_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_status' );	
                                    $selected ="";
									if(!empty($es_status_listing)) {
                                        foreach($es_status_listing as $list) {	
                                            if(!empty($prop_edit)){
												$selected = ($prop_edit->prop_status==$list->status_id) ? 'selected="selected"' : "";
											}
											echo'<option '.$selected.' value="'.$list->status_id.'">'.$list->status_title.'</option>';
                                        }
                                    } ?>
                            </select>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Featured:</span>
                            <?php
							   $yes = "";
							   $no = "";
							   $yesClass = "";
							   $noClass = "";
							   if(!empty($prop_edit)){
								   $yes = ($prop_edit->prop_featured==1) ? 'checked="checked"' : "";
								   $no = ($prop_edit->prop_featured==0) ? 'checked="checked"' : "";	
								   $yesClass = ($prop_edit->prop_featured==1) ? 'active' : "";
								   $noClass = ($prop_edit->prop_featured==0) ? 'active' : "";	
							   }
							 ?>
                            <label class="<?php echo $yesClass?>"><input <?php echo $yes?> type="radio" name="prop_featured" value="1" /> Yes</label>
                            <label class="<?php echo $noClass?>"><input <?php echo $no?> type="radio" name="prop_featured" value="0" /> No</label>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Hot:</span>
                             <?php
							   $yes = "";
							   $no = "";
							   $yesClass = "";
							   $noClass = "";
							   if(!empty($prop_edit)){
								   $yes = ($prop_edit->prop_hot==1) ? 'checked="checked"' : "";
								   $no = ($prop_edit->prop_hot==0) ? 'checked="checked"' : "";	
								   $yesClass = ($prop_edit->prop_hot==1) ? 'active' : "";
								   $noClass = ($prop_edit->prop_hot==0) ? 'active' : "";	
							   }
							 ?>
                            <label class="<?php echo $yesClass?>"><input <?php echo $yes?> type="radio" name="prop_hot" value="1" /> Yes</label>
                            <label class="<?php echo $noClass?>"><input <?php echo $no?> type="radio" name="prop_hot" value="0" /> No</label>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Open house:</span>
                            <?php
							   $yes = "";
							   $no = "";
							   $yesClass = "";
							   $noClass = "";
							   if(!empty($prop_edit)){
								   $yes = ($prop_edit->prop_open_house==1) ? 'checked="checked"' : "";
								   $no = ($prop_edit->prop_open_house==0) ? 'checked="checked"' : "";	
								   $yesClass = ($prop_edit->prop_open_house==1) ? 'active' : "";
								   $noClass = ($prop_edit->prop_open_house==0) ? 'active' : "";	
							   }
							 ?>
                            <label class="<?php echo $yesClass?>"><input <?php echo $yes?> type="radio" name="prop_open_house" value="1" /> Yes</label>
                            <label class="<?php echo $noClass?>"><input <?php echo $no?> type="radio" name="prop_open_house" value="0" /> No</label>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Foreclosure:</span>
                            <?php
							   $yes = "";
							   $no = "";
							   $yesClass = "";
							   $noClass = "";
							   if(!empty($prop_edit)){
								   $yes = ($prop_edit->prop_foreclosure==1) ? 'checked="checked"' : "";
								   $no = ($prop_edit->prop_foreclosure==0) ? 'checked="checked"' : "";	
								   $yesClass = ($prop_edit->prop_foreclosure==1) ? 'active' : "";
								   $noClass = ($prop_edit->prop_foreclosure==0) ? 'active' : "";	
							   }
							 ?>
                            <label class="<?php echo $yesClass?>"><input <?php echo $yes?> type="radio" name="prop_foreclosure" value="1" /> Yes</label>
                            <label class="<?php echo $noClass?>"><input <?php echo $no?> type="radio" name="prop_foreclosure" value="0" /> No</label>
                        </div>
                        
                        
                        <div class="new_prop_field clearFix">
                            <span>Price:</span>
                            <input type="text" id="prop_price" name="prop_price" value="<?php echo (!empty($prop_edit))?$prop_edit->prop_price:'' ?>" />
                            <p class="es_new_prop_error"></p>
                        </div>
                        <div class="new_prop_field clearFix" id="es_period_for_rent" style="display:none;">
                            <span>Period:</span>
                            <select name="prop_period">
                            	<?php $es_period_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_rent_period' );	
                                    if(!empty($es_period_listing)) {
                                        foreach($es_period_listing as $list) {	
                                            if(!empty($prop_edit)){
												$selected = (@$prop_edit->prop_period==$list->period_id) ? 'selected="selected"' : "";
											}
											echo'<option '.$selected.' value="'.$list->period_id.'">'.$list->period_title.'</option>';
                                        }
                                    } ?>
                            </select>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Bedrooms:</span>
                            <div class="es_spinner">
                                <input type="number" id="es_bedrooms" name="prop_bedrooms" value="<?php echo (!empty($prop_edit) && $prop_edit->prop_bedrooms!=0)?$prop_edit->prop_bedrooms:'' ?>" />
                            </div>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Bathrooms:</span>
                            <input type="number" name="prop_bathrooms" value="<?php echo (!empty($prop_edit) && $prop_edit->prop_bathrooms!=0)?$prop_edit->prop_bathrooms:'' ?>" />
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Floors:</span>
                            <input type="number" name="prop_floors" value="<?php echo (!empty($prop_edit) && $prop_edit->prop_floors!=0)?$prop_edit->prop_floors:'' ?>" />
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Area:</span>
                            <input type="text" name="prop_area" value="<?php echo (!empty($prop_edit) && $prop_edit->prop_area!=0)?$prop_edit->prop_area:'' ?>" />
                            <small>
                                <?php $es_dimension = $wpdb->get_row( 'SELECT dimension_title FROM '.$wpdb->prefix.'estatik_manager_dimension WHERE dimension_status=1' ); 
									echo $es_dimension->dimension_title;
								?>
                            </small> 
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Lot size:</span>
                            <input type="text" name="prop_lotsize" value="<?php echo (!empty($prop_edit) && $prop_edit->prop_lotsize!=0)?$prop_edit->prop_lotsize:'' ?>" />
                            <small>
                            	<?php $es_dimension = $wpdb->get_row( 'SELECT dimension_title FROM '.$wpdb->prefix.'estatik_manager_dimension WHERE dimension_status=1' ); 
									echo $es_dimension->dimension_title;
								?>
                            </small> 
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Built in:</span>
                            <input type="text" name="prop_builtin" value="<?php echo (!empty($prop_edit))?$prop_edit->prop_builtin:'' ?>" />
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Description:</span>
                             <textarea name="prop_description"><?php echo (!empty($prop_edit))?$prop_edit->prop_description:'' ?></textarea>
                        </div>
                        
                        <?php 
						
						//echo $prop_meta;
						
						if($prop_meta != ""){ 
							$meta_value = unserialize($prop_meta);
							foreach($meta_value as $key=>$val){
								$key_val = str_replace("'","",$key);
						?>
								<div class="new_prop_field clearFix">
									<span><?php echo $key_val?>:</span>
									<input type="text" name="prop_data['<?php echo $key_val?>']" value="<?php echo $val?>" />
									<a href="javascript:void(0)" onclick="es_field_del(this)" class="field_del"></a>
								</div>
						<?php }
						
						} ?>
       
                    </div> 
                    
                    <div class="addnew_prop_add_btom">
                        <div id="es_basic_info_Add_new_error" class="es_message"></div>
                        <div class="clearfix"></div>	
                        <div class="es_add_newfield full clearFix">
                            <input type="text" onblur="if(this.value == '') { this.value = 'text/number'; }" onfocus="if(this.value == 'text/number') { this.value = ''; }" value="text/number" id="es_basic_info_Add_new_title" name="es_basic_info_Add_new_title"  />
                            <a onclick="es_prop_detail_add_new()" class="es_add_newfield_btn" href="javascript:void(0)">Add new field</a>
                        </div>
                    </div>
 
                </div>
            </div>
            
            <div id="es_address" class="es_tabs_content_in clearFix">     
  				<div class="new_prop_fields_wrap clearFix">
                
                    <div id="es_address">

                        <div class="new_prop_field clearFix">
                            <span>Country:</span>
                            <?php 
							global $wpdb;
							$es_country_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_countries' );	 ?>
                            <select onchange="es_prop_country_states(this); myGeocodeFirst()" id="es_country" name="country_id">
                            	<option value="0">Choose Country</option>
                            	<?php
								$selected="";
								foreach($es_country_listing as $list) {
									if(!empty($prop_edit)){
										$selected = (@$prop_edit->country_id==$list->country_id) ? 'selected="selected"' : "";
									}
									if(!empty($prop_edit) && $prop_edit->country_id==$list->country_id){
										$es_country_id =@$prop_edit->country_id;
									}
								?>
                                    <option <?php echo $selected?> value="<?php echo $list->country_id?>"><?php echo $list->country_title?></option>
                                <?php } ?>    
                            </select>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>State/Region:</span>
                            <select onchange="es_prop_states_cities(this); myGeocodeFirst()" id="es_states" name="state_id">
                                <?php if(isset($_GET['prop_id'])) { 
									include('es_property_temps/es_property_states.php');
								} else {
								?>
                                	<option value=""></option>
                                <?php } ?>
                            </select>
                            <div id="es_states_loader" class="new_prop_loader"></div>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>City:</span>
                            <select id="es_cities" onchange="myGeocodeFirst()" name="city_id">
                                <?php if(isset($_GET['prop_id'])) {  
									include('es_property_temps/es_property_cities.php');
								} else {
								?>
                                	<option value=""></option>
                                <?php } ?>
                            </select>
                            <div id="es_cities_loader" class="new_prop_loader"></div>
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>ZIP/Postcode:</span>
                            <input type="text" name="prop_zip_postcode" value="<?php echo (!empty($prop_edit) && $prop_edit->prop_zip_postcode!=0)?$prop_edit->prop_zip_postcode:'' ?>" />
                        </div>
                         
                        <div class="new_prop_field clearFix">
                            <span>Street:</span>
                            <input type="text" id="prop_street" name="prop_street" onblur="myGeocodeFirst()" value="<?php echo (!empty($prop_edit))?$prop_edit->prop_street:'' ?>" />
                            
                            <input type="hidden" value="<?php echo (!empty($prop_edit))?$prop_edit->prop_address:'' ?>" id="prop_address" name="prop_address" />
                            
                        </div>
                        
                        <hr />
                        
                        <div class="new_prop_field clearFix">
                            <span>Longtitude:</span>
                            <input id="prop_longitude" type="text" name="prop_longitude" value="" />
                        </div>
                        <div class="new_prop_field clearFix">
                            <span>Latitude:</span>
                            <input type="text" id="prop_latitude" name="prop_latitude" value="" />
                        </div>
 
                        <div id="es_address_map">
                        	 
                        </div>
 
                    </div> 	
              
                </div>
            </div>
            
            <div id="es_prop_features" class="es_tabs_content_in clearFix">     
  				
                <div class="boxSizing es_manager_lists">
                    <h2>Features</h2>
                    <div id="es_feature_listing"> 
 						<ul>	
                         <?php  
						 $prop_feature=1;
						 $prop_id = (isset($_GET['prop_id']))?$_GET['prop_id']:'';
						 include(PATH_DIR.'admin_template/es_manager/es_manager_temps/es_feature.php'); ?>
                    	</ul>
                    </div> 

                    <div class="es_message" id="es_feature_message"></div>
                    <div class="es_add_newfield full clearFix">
                        <input type="text" name="es_feature_title" id="es_feature_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_feature_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_feature_insertion()">Add new field</a>
                         <input type="hidden" value="1" id="prop_feature" />
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2>Appliances</h2>
                    <div id="es_appliance_listing"> 
						 <ul>
							 <?php  
                             $prop_appliance=1;
							 $prop_id = (isset($_GET['prop_id']))?$_GET['prop_id']:'';
                             include(PATH_DIR.'admin_template/es_manager/es_manager_temps/es_appliance.php'); ?>
                    	</ul>
                    </div> 
                    
                    <div class="es_message" id="es_appliance_message"></div>
                    <div class="es_add_newfield full clearFix">
                        <input type="text" name="es_appliance_title" id="es_appliance_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_appliance_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_appliance_insertion()">Add new field</a>
                        <input type="hidden" value="1" id="prop_appliance" />
                    </div>
                </div>
                
            </div>
 
            <div id="es_media" class="es_tabs_content_in clearFix">     
                 
                 <div id="es_media_images" style="display:block;" class="es_media_contents clearFix">
                 	<p>Select files or upload images in a zip-file.</p>
                    <div class="es_media_images_field clearFix">
                    	<input type="file" onchange="es_media_image_upload(this)" multiple="multiple" name="es_media_images[]" />
                        <a href="javascript:void(0)">Upload</a>
                        <span id="es_media_images_loader"></span>
                    </div>
                    <p>The first image will be default image. You can drag and drop images to change their order.</p>
                    
                    <div id="es_media_images_listing" class="clearFix">
 
                         <?php  
						 $prop_images=1;
						 $prop_id = (isset($_GET['prop_id']))?$_GET['prop_id']:'';
						 include('es_property_temps/es_property_images.php'); ?>
                         
                    </div>
                     
                    <div id="es_media_image_del"></div>
                    
                 </div>
                
            </div>
 
        </div>
 
    </div>
    
    </form>

</div>
	
 