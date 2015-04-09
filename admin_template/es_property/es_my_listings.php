<?php 
global $wpdb;

$es_settings = es_front_settings();  
	
if(isset($_GET['del'])){
	wp_delete_post( $_GET['del'], true );
	$wpdb->delete( $wpdb->prefix.'estatik_properties', array( 'prop_id' => $_GET['del'] ) );
}

if(isset($_POST['prop_id'])){
 
	$prop_ids = array_reverse($_POST['prop_id']);
		
	if(!empty($_POST['prop_id'])){
 
		for($i=0; $i<count($prop_ids); $i++){
			
			$select_result = new stdClass;
				
			$select_result = $wpdb->get_row('SELECT * FROM '.$wpdb->prefix.'estatik_properties WHERE prop_id = '.$prop_ids[$i] );	
 
			if($_POST['es_selcted_del']=='yes'){
				
				wp_delete_post( $prop_ids[$i], true );
				
				$wpdb->delete( $wpdb->prefix.'estatik_properties', array( 'prop_id' => $prop_ids[$i] ) );
				
				$prop_count = $wpdb->get_var( "SELECT COUNT(agent_id) FROM ".$wpdb->prefix."estatik_properties WHERE agent_id = ".$select_result->agent_id );
				$wpdb->update(
				$wpdb->prefix.'estatik_agents',
					array(
							'agent_prop_quantity' 	=> $prop_count,
						),
						array( 'agent_id' => $select_result->agent_id )
					); 
					
			}
			
			if($_POST['es_selcted_publish']=='yes'){ 
				
				$wpdb->update( $wpdb->prefix.'estatik_properties', array( 'prop_pub_unpub' => 1 ), array( 'prop_id' => $prop_ids[$i] ) );
				
				 $my_post = array(
					  'ID'           => $prop_ids[$i],
					  'post_status'   => 'publish',
					  'post_type'     => 'properties'
				  );
				
				// Update the post into the database
				wp_update_post( $my_post );
				
					
			}
			
			if($_POST['es_selcted_unpublish']=='yes'){
				$wpdb->update( $wpdb->prefix.'estatik_properties', array( 'prop_pub_unpub' => 0 ), array( 'prop_id' => $prop_ids[$i] ) );	
				
				$my_post = array(
					  'ID'           => $prop_ids[$i],
					  'post_status'   => 'draft',
					  'post_type'     => 'properties'
				  );
				
				// Update the post into the database
				wp_update_post( $my_post );
				
			}
			
			
			if($_POST['es_selcted_copy']=='yes'){
			
 
				$lastid_obj = new stdClass;
												
				$sql = "SELECT `AUTO_INCREMENT` as ID
				FROM  INFORMATION_SCHEMA.TABLES
				WHERE TABLE_SCHEMA = '".DB_NAME."'
				AND TABLE_NAME = '".$wpdb->prefix."posts'";
		
				$lastid_sql = $wpdb->get_results($sql);
		
				$lastid_obj = $lastid_sql[0];	
				
				$lastid = $lastid_obj->ID;
				
				//echo $lastid;
				//print_r($select_result);
				
				$my_post = array(
				  'post_title'    => $select_result->prop_title,
				  'post_status'   => 'publish',
				  'post_content'  => '[es_single_property]',
				  'post_author'   => $select_result->agent_id,
				  'post_type'     => 'properties',
				);
		 
				// Insert the post into the database
				$post_id = wp_insert_post( $my_post );
				
				wp_set_object_terms( $post_id, (int)$select_result->prop_category, 'property_category');
				wp_set_object_terms( $post_id, (int)$select_result->prop_status, 'property_status');
				wp_set_object_terms( $post_id, (int)$select_result->prop_type, 'property_type');
 
				$wpdb->insert(
				$wpdb->prefix.'estatik_properties',
				array(
						'prop_id' 			=> $post_id,
						'agent_id' 			=> $select_result->agent_id,
						'prop_date_added' 	=> time(),
						'prop_pub_unpub' 	=> 1,
						'prop_title' 		=> $select_result->prop_title,
						'prop_type' 		=> $select_result->prop_type,
						'prop_category' 	=> $select_result->prop_category,
						'prop_status' 		=> $select_result->prop_status,
						'prop_featured' 	=> $select_result->prop_featured,
						'prop_hot' 			=> $select_result->prop_hot,
						'prop_open_house' 	=> $select_result->prop_open_house,
						'prop_foreclosure' 	=> $select_result->prop_foreclosure,
						'prop_price' 		=> $select_result->prop_price,
						'prop_period' 		=> $select_result->prop_period,
						'prop_bedrooms' 	=> $select_result->prop_bedrooms,
						'prop_bathrooms' 	=> $select_result->prop_bathrooms,
						'prop_floors' 		=> $select_result->prop_floors,
						'prop_area' 		=> $select_result->prop_area,
						'prop_lotsize' 		=> $select_result->prop_lotsize,
						'prop_builtin' 		=> $select_result->prop_builtin,
						'prop_description' 	=> $select_result->prop_description,
						'country_id' 		=> $select_result->country_id,
						'state_id' 			=> $select_result->state_id,
						'city_id' 			=> $select_result->city_id,
						'prop_zip_postcode' => $select_result->prop_zip_postcode,
						'prop_street' 		=> $select_result->prop_street,
						'prop_address' 		=> $select_result->prop_address,
						'prop_longitude' 	=> $select_result->prop_longitude,
						'prop_latitude' 	=> $select_result->prop_latitude,
						'prop_meta_keywords' 		=> $select_result->prop_meta_keywords,
						'prop_meta_description' 	=> $select_result->prop_meta_description
					)
				);
				
				$prop_count = $wpdb->get_var( "SELECT COUNT(agent_id) FROM ".$wpdb->prefix."estatik_properties WHERE agent_id = ".$select_result->agent_id );
				$wpdb->update(
				$wpdb->prefix.'estatik_agents',
					array(
							'agent_prop_quantity' 	=> $prop_count,
						),
						array( 'agent_id' => $select_result->agent_id )
					); 
				
				$select_features = new stdClass;
				$select_features_arr = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'estatik_properties_features WHERE prop_id = '.$prop_ids[$i] );	
				foreach($select_features_arr as $feature_copy ){ 
					$wpdb->insert(
					$wpdb->prefix.'estatik_properties_features',
					array(
							'feature_id' 		=> $feature_copy->feature_id,
							'prop_id' 	=> $lastid
						)
					);
				}
				
				$select_appliances = new stdClass;
				$select_appliances_arr = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'estatik_properties_appliances WHERE prop_id = '.$prop_ids[$i] );	
				foreach($select_appliances_arr as $appliance_copy ){ 
					$wpdb->insert(
					$wpdb->prefix.'estatik_properties_appliances',
					array(
							'appliance_id' 		=> $appliance_copy->appliance_id,
							'prop_id' 	=> $lastid
						)
					);
				}
 
				$select_images = new stdClass;
				$select_images_arr = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'estatik_properties_meta WHERE prop_id = '.$prop_ids[$i].' AND prop_meta_key = "images"' );	
				$select_images = $select_images_arr[0];
				$wpdb->insert(
				$wpdb->prefix.'estatik_properties_meta',
				array(	
						'prop_meta_key' 		=> $select_images->prop_meta_key,
						'prop_meta_value' 		=> $select_images->prop_meta_value,
						'prop_id' 	=> $lastid
					)
				);
				
				
			}	
 
		}
	
	}
}
?>
<div class="es_wrapper"> 
 
    <input type="hidden" value="<?php _e( "Please select properties you want to copy.", "es-plugin" ); ?>" id="selPropertiesToCopy"  />
    <input type="hidden" value="<?php _e( "Please select properties you want to delete.", "es-plugin" ); ?>" id="selPropertiesToDelete"  />
    <input type="hidden" value="<?php _e( "Please select properties you want to publish.", "es-plugin" ); ?>" id="selPropertiesToPublish"  />
    <input type="hidden" value="<?php _e( "Please select properties you want to unpublish.", "es-plugin" ); ?>" id="selPropertiesToUnPublish"  />
    
    <input type="hidden" value="<?php _e( "Are you sure you want to Copy it?", "es-plugin" ); ?>" id="sureToCopy"  />
    <input type="hidden" value="<?php _e( "Are you sure you want to delete it?", "es-plugin" ); ?>" id="sureToDelete"  />
    <input type="hidden" value="<?php _e( "Are you sure you want to publish it?", "es-plugin" ); ?>" id="sureToPublish"  />
    <input type="hidden" value="<?php _e( "Are you sure you want to unpublish it?", "es-plugin" ); ?>" id="sureToUnPublish"  />
    
    <div class="es_alert_popup" id="select_popup">
    	<div class="es_alert_popup_overlay"></div>
        <div class="es_alert_popup_in boxSizing">
        	<p></p>
            <ul>
            	<li><a class="es_ok" href="javascript:void(0)"><?php _e( "OK", "es-plugin" ); ?></a></li>
            </ul>
            <a href="javascript:void(0)" class="es_close_popup"></a>
        </div>
    </div>
    
    <div class="es_alert_popup" id="sure_popup">
    	<div class="es_alert_popup_overlay"></div>
        <div class="es_alert_popup_in boxSizing">
        	<p></p>
            <ul>
            	<li><a class="es_ok" href="javascript:void(0)"><?php _e( "OK", "es-plugin" ); ?></a></li>
                <li><a class="es_cancel" href="javascript:void(0)"><?php _e( "Cancel", "es-plugin" ); ?></a></li>
            </ul>
            <a href="javascript:void(0)" class="es_close_popup"></a>
        </div>
    </div>
    
    <div class="es_header clearFix">
        <h2><?php _e( "My Listings", "es-plugin" ); ?></h2>
        <h3><img src="<?php echo DIR_URL.'admin_template/';?>images/estatik_simple.png" alt="#" /><small>Ver. <?php echo es_plugin_version(); ?></small></h3>
    </div>
    
    <div class="es_all_listing_search clearFix">
    	
        <div class="es_all_listing_search_upper">
        	<form method="post" action="<?php echo admin_url()?>admin.php?page=es_my_listings">
                <div class="es_search_filter clearFix">
                    <label><?php _e( "Filter by", "es-plugin" ); ?>:</label>
                    <select name="es_cat">
                            <option value=""><?php _e( "Category", "es-plugin" ); ?></option>
							<?php $sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_categories';
								$es_category_listing = $wpdb->get_results($sql);
								if(!empty($es_category_listing)) {	
									foreach($es_category_listing as $list) {
										$selected = (isset($_POST['es_cat']) && $_POST['es_cat']==$list->cat_id) ? 'selected="selected"' : "";
										echo '<option '.$selected.' value="'.$list->cat_id.'">'.$list->cat_title.'</option>';		
									}
								}
							 ?>
                    </select>
                    <select name="es_status">
                             <option value=""><?php _e( "Status", "es-plugin" ); ?></option>
							<?php $sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_status';
								$es_state_listing = $wpdb->get_results($sql);
								if(!empty($es_state_listing)) {	
									foreach($es_state_listing as $list) {
										$selected = (isset($_POST['es_status']) && $_POST['es_status']==$list->status_id) ? 'selected="selected"' : "";
										echo '<option '.$selected.' value="'.$list->status_id.'">'.$list->status_title.'</option>';		
									}
								}
							 ?>
                    </select>
                    <select name="es_type">
                            <option value=""><?php _e( "Type", "es-plugin" ); ?></option>
							<?php $sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_types';
								$es_type_listing = $wpdb->get_results($sql);
								if(!empty($es_type_listing)) {	
									foreach($es_type_listing as $list) {
										$selected = (isset($_POST['es_type']) && $_POST['es_type']==$list->type_id) ? 'selected="selected"' : "";
										echo '<option '.$selected.' value="'.$list->type_id.'">'.$list->type_title.'</option>';		
									}
								}
							 ?>
                    </select>
                </div>
                <div class="es_search_prop clearFix">
                    <label><?php _e( "Property ID", "es-plugin" ); ?>:</label>
                    <input name="es_prop_id" value="<?php if (isset($_POST['es_prop_id'])) { echo $_POST["es_prop_id"]; } ?>" type="text" />
                    <label><?php _e( "Address", "es-plugin" ); ?>:</label>
                    <input name="es_address" value="<?php if (isset($_POST['es_address'])) { echo $_POST["es_address"]; } ?>" type="text" />
                    <label><?php _e( "Date added", "es-plugin" ); ?>:</label>
                    <input name="es_date_added" id="es_date_added" value="<?php if (isset($_POST['es_date_added'])) { echo $_POST["es_date_added"]; } ?>" type="text" /> 
                    <input type="submit" name="search_list" value="Search" />
                    <input type="button" value="Reset" onclick="window.location='admin.php?page=es_my_listings'" />
                </div>
            </form>
        </div>
        
        <div class="es_manage_listing clearFix">
        	<label><?php _e( "Manage", "es-plugin" ); ?>:</label>
            <ul>
                <li><a href="javascript:void(0)" id="es_listing_select_all"><?php _e( "Select all", "es-plugin" ); ?></a></li>
                <li><a href="javascript:void(0)" id="es_listing_undo_selection"><?php _e( "Undo selection", "es-plugin" ); ?></a></li>
                <li><a href="javascript:void(0)" id="es_listing_copy"><?php _e( "Copy", "es-plugin" ); ?></a></li>
                <li><a href="javascript:void(0)" id="es_listing_del"><?php _e( "Delete", "es-plugin" ); ?></a></li>
                <li><a href="javascript:void(0)" id="es_listing_publish"><?php _e( "Publish", "es-plugin" ); ?></a></li>
                <li><a href="javascript:void(0)" id="es_listing_unpublish"><?php _e( "Unpublish", "es-plugin" ); ?></a></li>
            </ul>
        </div>
        
    </div>
    
    <?php if(isset($_GET['del']) && !isset($_POST['es_selcted_copy']) && !isset($_POST['es_selcted_del']) && !isset($_POST['es_selcted_publish']) && !isset($_POST['es_selcted_unpublish'])){ ?>
        <div class="es_success"><?php _e( "Property has been deleted.", "es-plugin" ); ?></div>	 	 
	<?php } ?>
    
    <?php if(isset($_POST['es_selcted_copy']) && ($_POST['es_selcted_copy']=='yes')){ ?>
        <div class="es_success"><?php _e( "Selected properties have been copied.", "es-plugin" ); ?></div>	 
	<?php } ?>
	
    <?php if(isset($_POST['es_selcted_del']) && ($_POST['es_selcted_del']=='yes')){ ?>
        <div class="es_success"><?php _e( "Selected properties have been deleted.", "es-plugin" ); ?></div>	 
	<?php } ?>
    
    <?php if(isset($_POST['es_selcted_publish']) && ($_POST['es_selcted_publish']=='yes')){ ?>
        <div class="es_success"><?php _e( "Selected properties have been published.", "es-plugin" ); ?></div>	 
	<?php } ?>
    
    <?php if(isset($_POST['es_selcted_unpublish']) && ($_POST['es_selcted_unpublish']=='yes')){ ?>
        <div class="es_success"><?php _e( "Selected properties have been unpublished.", "es-plugin" ); ?></div>	 
	<?php } ?>
    
	<?php if(isset($_POST['search_list'])){ ?>
        <div class="es_success"><?php _e( "Your search results.", "es-plugin" ); ?></div>	 
	<?php } ?>
    
    
    <div class="es_content_in clearFix">
 		
        <div class="es_all_listing_head clearFix">
        	<div>
            	<input type="checkbox" value=""  />
            </div>
            <div>
            	<?php _e( "Property ID", "es-plugin" ); ?>
            </div>
            <div class="hide-ipad hide-phone">
            	<?php _e( "Image", "es-plugin" ); ?>
            </div>
            <div>
            	<?php _e( "Title", "es-plugin" ); ?>
            </div>
            <div class="hide-phone">
            	<?php _e( "Date added", "es-plugin" ); ?>
            </div>
            <div class="hide-ipad hide-phone">
            	<?php _e( "Address", "es-plugin" ); ?>
            </div>
            <div class="hide-phone">
            	<?php _e( "Category", "es-plugin" ); ?>
            </div>
            <div class="hide-phone">
            	<?php _e( "Type", "es-plugin" ); ?>
            </div>
            <div class="hide-phone">
            	<?php _e( "Status", "es-plugin" ); ?>
            </div>
        </div>
        
        <div class="es_all_listing clearFix">
        	<form id="listing_actions" action="" method="post">
            	
                <input type="hidden" id="es_selcted_copy" name="es_selcted_copy" value="no" />
                <input type="hidden" id="es_selcted_del" name="es_selcted_del" value="no" />
                <input type="hidden" id="es_selcted_publish" name="es_selcted_publish" value="no" />
                <input type="hidden" id="es_selcted_unpublish" name="es_selcted_unpublish" value="no" />
                
                <ul>
                    <?php  
                        
						$es_cat 		= (isset($_POST['es_cat'])) ? sanitize_text_field($_POST['es_cat']) : "";
						$es_status 		= (isset($_POST['es_status'])) ? sanitize_text_field($_POST['es_status']) : "";
						$es_type 		= (isset($_POST['es_type'])) ? sanitize_text_field($_POST['es_type']) : "";
						$es_prop_id 	= (isset($_POST['es_prop_id'])) ? sanitize_text_field($_POST['es_prop_id']) : "";
						$es_address 	= (isset($_POST['es_address'])) ? sanitize_text_field($_POST['es_address']) : "";
                        $es_date_added 	= (isset($_POST['es_date_added'])) ? sanitize_text_field($_POST['es_date_added']) : ""; 
                
                        //echo $es_date_added."Aliiiiii";
                        
                        $where = "";
                        $where_array = array();
                        if($es_cat != ''){
                            $where_array[]  =	'prop_category 	=  '.$es_cat.'';
                        }
                        if($es_status != ''){
                            $where_array[]  =	'prop_status 	=  '.$es_status.'';
                        }
                        if($es_type != ''){
                            $where_array[]  =	'prop_type 	=  '.$es_type.'';
                        }
                        if($es_prop_id != ''){
                            $where_array[]  =	'prop_id 	=  '.$es_prop_id.'';
                        }
                        if($es_address != ''){
                            $where_array[]  =	'prop_address like "%'.$es_address.'%"';
                        }
						
						if($es_date_added != ''){ 
							$s_date = strtotime($es_date_added." 00:00");
							$e_date = strtotime($es_date_added." 23:59");
							$where_array[]  =	'(prop_date_added >= '.$s_date.' and prop_date_added <= '.$e_date.')';
                        }
                        
                        $where =  implode(" AND ",$where_array);
                        
                        if(!empty($where_array)){
                        
                            $sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_properties WHERE '.$where.' order by prop_id desc';
                        }
                         
                        else
                        {
                            $sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_properties order by prop_id desc'; 		
                        }
                        $es_my_listing = $wpdb->get_results($sql); 
                        if(!empty($es_my_listing)) {
                            foreach($es_my_listing as $list) {
                    ?>			
                     
                                <li class="clearFix <?php if($list->prop_pub_unpub==0) {  echo 'es_unpublish'; } ?>">
                                    <div>
                                        <p><input type="checkbox" name="prop_id[]" value="<?php echo $list->prop_id?>"  /></p>
                                    </div>
                                    <div>
                                        <p><?php echo $list->prop_id?></p>
                                    </div>
                                    <div class="hide-ipad hide-phone">
                                    	
                                        <?php 
											$image_sql = "SELECT prop_meta_value FROM ".$wpdb->prefix."estatik_properties_meta WHERE prop_id = ".$list->prop_id." AND prop_meta_key = 'images'";
	 
											$uploaded_images_obj = $wpdb->get_row($image_sql);
											
											$upload_image_data = (!empty($uploaded_images_obj))?unserialize($uploaded_images_obj->prop_meta_value):'';
											 
											if(!empty($upload_image_data)) {
 											$list_image_name = explode("/",$upload_image_data[0]);
											$list_image_name = end($list_image_name);
											$list_image_path = str_replace($list_image_name,"",$upload_image_data[0]);
											$image_url = $list_image_path.'list_'.$list_image_name;		
												
											$upload_dir = wp_upload_dir(); ?>
                                        		<img src="<?php echo $upload_dir['baseurl']?><?php echo $image_url?>" alt="" />
                                        	<?php } else{
												echo '<p>'.__( "No Image", "es-plugin" ).'</p>';
											} ?>
                                        
                                    </div>
                                    <div>
                                        <p><a href="<?php echo admin_url();?>admin.php?page=es_add_new_property&prop_id=<?php echo $list->prop_id?>"><?php echo $list->prop_title?></a></p>
                                    </div>
                                    <div class="hide-phone">
                                        <p><?php echo date("d/m/Y",$list->prop_date_added)?></p>
                                    </div>
                                    <div class="es_prop_address hide-ipad hide-phone">
                                        <p><?php echo $list->prop_address?></p>
                                    </div>
                                    <div class="hide-phone">
                                        <?php
                                        $prop_cat = new stdClass;
                                        $prop_cat = $wpdb->get_row( 'SELECT cat_title FROM '.$wpdb->prefix.'estatik_manager_categories WHERE cat_id = "'.$list->prop_category.'"');
                                        ?>
                                        <p><?php if(!empty($prop_cat)) { echo $prop_cat->cat_title; }?></p>
                                    </div>
                                    <div class="hide-phone">
                                        <?php
                                        $prop_type = new stdClass;
                                        $prop_type = $wpdb->get_row( 'SELECT type_title FROM '.$wpdb->prefix.'estatik_manager_types WHERE type_id = "'.$list->prop_type.'"');
                                        ?>
                                        <p><?php if(!empty($prop_type)) { echo $prop_type->type_title; }?></p>
                                    </div>
                                    <div class="hide-phone">
                                        <?php
											$prop_status = new stdClass;
											$prop_status = $wpdb->get_row( 'SELECT status_title FROM '.$wpdb->prefix.'estatik_manager_status WHERE status_id = '.$list->prop_status);
										?>
                                        <p><?php if(!empty($prop_status)) { echo $prop_status->status_title; }?></p>
                                    </div>
                                    
                                    <span class="es_list_edit_del">
                                        <a href="<?php echo admin_url();?>admin.php?page=es_add_new_property&prop_id=<?php echo $list->prop_id?>"><?php _e( "Edit", "es-plugin" ); ?></a>
                                        <a href="<?php echo admin_url();?>admin.php?page=es_my_listings&del=<?php echo $list->prop_id?>"><?php _e( "Delete", "es-plugin" ); ?></a>
                                    </span>
                                    
                                </li>
                    
                        <?php 
                            }
                            
                        } else {
                    
                        	echo '<li class="es_no_record">'.__( "No record found.", "es-plugin" ).'</li>';	
                    
                        } 
                        ?> 
                </ul>
            
            </form>
        </div>
        
    </div>
 
</div>