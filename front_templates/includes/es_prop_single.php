<?php
	  $es_settings = es_front_settings();
	  $upload_dir = wp_upload_dir();
	?>
 
    <div id="es_content" class="clearfix es_single_left">
 
        <div class="es_single_in">		
 			
            <?php
	  
			global $wpdb;
			$sql = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}estatik_properties WHERE prop_id = '%d' order by prop_id desc", get_the_id());
			$es_prop_single = $wpdb->get_row($sql); 
			
			//print_r($es_prop_single);
			
			
			$prop_cat = $wpdb->get_row( "SELECT cat_title FROM {$wpdb->prefix}estatik_manager_categories WHERE cat_id = '{$es_prop_single->prop_category}'");
			
			$prop_rent = $wpdb->get_row( "SELECT period_title FROM {$wpdb->prefix}estatik_manager_rent_period WHERE period_id = '{$es_prop_single->prop_period}'");
 
			$prop_type = $wpdb->get_row( "SELECT type_title FROM {$wpdb->prefix}estatik_manager_types WHERE type_id = '{$es_prop_single->prop_type}'");
			
			$prop_status = $wpdb->get_row( "SELECT status_title FROM {$wpdb->prefix}estatik_manager_status WHERE status_id = '{$es_prop_single->prop_status}'");
			
			
			$es_settings = es_front_settings();
			$currency_sign_ex = explode(",", $es_settings->default_currency);
			if(count($currency_sign_ex)==1){
				$currency_sign = $currency_sign_ex[0];
			}else {
				$currency_sign = $currency_sign_ex[1];	
			}
            $dimension_sql = "SELECT dimension_title FROM ".$wpdb->prefix."estatik_manager_dimension WHERE dimension_status = 1";
            $es_dimension = $wpdb->get_row($dimension_sql);
		 
			?>

            <div class="es_prop_single_head clearfix">
                <?php if($es_settings->title==1) { ?>
                	<h1><?php echo $es_prop_single->prop_title?></h1>            
                 <?php } else{ ?>
                 	<h1><?php echo $es_prop_single->prop_address?></h1>
                 <?php } ?>
                <?php if($es_settings->price==1) {
					$price_format = explode("|",$es_settings->price_format);
				?>
                	<strong><?php if($es_settings->currency_sign_place=='before'){ echo $currency_sign ; }?><?php echo number_format($es_prop_single->prop_price,$price_format[0],$price_format[1],$price_format[2]);?><?php if($es_settings->currency_sign_place=='after'){ echo $currency_sign; }?></strong>
                <?php } ?>
				<?php if(!empty($prop_cat) && $prop_cat->cat_title!=""){ ?>
                	<span><?php echo $prop_cat->cat_title?></span>
                <?php } ?>
            </div>
            
            <?php
				
				$es_prop_features = es_join("b.feature_title","estatik_properties_features a","estatik_manager_features b","b.feature_id = a.feature_id and a.prop_id=".$es_prop_single->prop_id);
			 
				$es_prop_appliances = es_join("b.appliance_title","estatik_properties_appliances a","estatik_manager_appliances b","b.appliance_id = a.appliance_id and a.prop_id=".$es_prop_single->prop_id);
 
				$dimension_sql = "SELECT dimension_title FROM ".$wpdb->prefix."estatik_manager_dimension WHERE dimension_status = 1";
				$dimension = $wpdb->get_row($dimension_sql);
			?>
            
            <div class="es_prop_single_tabs_outer"> 
                <div class="es_prop_single_tabs clearfix">
                    <div class="es_prop_single_tabs_in clearfix">
                        <ul>
                            <li><a class="active" href="#es_single_basic_facts"><?php _e("Basic facts", 'es-plugin'); ?></a></li>
                            <?php if($es_prop_single->prop_latitude!='') { ?>
                            	<li><a href="#es_single_neigh"><?php _e("View on map", 'es-plugin'); ?></a></li>
                            <?php } ?>
                            <?php if(!empty($es_prop_features) || !empty($es_prop_appliances)){ ?>
                            	<li><a href="#es_single_features"><?php _e("Features", 'es-plugin'); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="es_prop_single_basic_facts clearfix" id="es_single_basic_facts" style="display:block;">
                <div class="es_prop_single_basic_facts_upper clearfix">
                    <?php
					$image_sql = "SELECT prop_meta_value FROM ".$wpdb->prefix."estatik_properties_meta WHERE prop_id = ".$es_prop_single->prop_id." AND prop_meta_key = 'images'";
					$uploaded_images = $wpdb->get_row($image_sql);           	
					if(!empty($uploaded_images)){
						$upload_image_data = unserialize($uploaded_images->prop_meta_value);
					}
					if(!empty($upload_image_data)) {
							
					?>
                    
                    <div id="es_prop_single_slider_outer" class="clearfix">
                    	<div id="es_prop_single_slider_in">
                        <ul class="es_prop_single_pics">	
                        	<?php
								foreach($upload_image_data as $prop_image) {
								
									$single_right_image_name = explode("/",$prop_image);
									$single_right_image_name = end($single_right_image_name);
									$single_right_image_path = str_replace($single_right_image_name,"",$prop_image);
									$image_url = $single_right_image_path.'single_lr_'.$single_right_image_name;
									$img_dimensions = 'width:'.$es_settings->prop_singleview_photo_lr_width.'px;';	
								 	
							?>
								<li><img style=" <?php echo $img_dimensions?> " src="<?php echo $upload_dir['baseurl']?><?php echo $image_url?>" alt="" /></li>
                                
							<?php } ?>
							
                    	</ul>
                        <div id="es_prop_single_pager_outer">
                            <ul class="es_prop_single_pager">	
                                <?php 
								$upload_dir = wp_upload_dir();
								foreach($upload_image_data as $prop_image) {
									
									$list_image_name = explode("/",$prop_image);
									$list_image_name = end($list_image_name);
									$list_image_path = str_replace($list_image_name,"",$prop_image);
									$list_image_url = $list_image_path.'single_thumb_'.$list_image_name;
									
								?>
                                    <li><a data-slide-index="" href=""><img style="width:<?php echo $es_settings->prop_singleview_photo_thumb_width?>px; height:<?php echo $es_settings->prop_singleview_photo_thumb_height?>px;" src="<?php echo $upload_dir['baseurl']?><?php echo $list_image_url?>" alt="" /></a></li>
									
								<?php } ?>
                            </ul>	
                        </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                    <div class="es_prop_single_basic_facts_right clearfix">
                        <div class="es_prop_single_basic_info">
                            <ul>
                               
                                <?php if($es_prop_single->prop_date_added!=0){ ?>
                                <li>
                                    <strong><?php _e("Date added", 'es-plugin'); ?>:</strong>
                                    <span><?php echo date($es_settings->date_format,$es_prop_single->prop_date_added)?></span>
                                </li>
                                <?php } ?> 
                                
								<?php if($es_prop_single->prop_area!=0){ ?>
                                <li>
                                    <strong><?php _e("Area size", 'es-plugin'); ?>:</strong>
                                    <span><?php echo $es_prop_single->prop_area?> <?php if(!empty($es_dimension)) { echo $es_dimension->dimension_title; } ?></span>
                                </li>
                                <?php } ?> 
                                
                                <?php if($es_prop_single->prop_lotsize!=0){ ?>
                                <li>
                                    <strong><?php _e("Lot size", 'es-plugin'); ?>:</strong>
                                    <span><?php echo $es_prop_single->prop_lotsize?> <?php if(!empty($es_dimension)) { echo $es_dimension->dimension_title; } ?></span>
                                </li>
                                <?php } ?>
                                
                                
								<?php if(!empty($prop_cat) && $prop_cat->cat_title!="" && strpos($prop_cat->cat_title,"rent")!=""){ ?>
                                <li>
                                    <strong><?php _e("Rent Period", 'es-plugin'); ?>:</strong>
                                    <span><?php echo $prop_rent->period_title?></span>
                                </li>
                                <?php } ?>
                                
                                
                                <?php 
								if(isset($prop_type->type_title)){ ?>
                                <li>
                                    <strong><?php _e("Type", 'es-plugin'); ?>:</strong>
                                    <span><?php echo $prop_type->type_title?></span>
                                </li>
                                <?php } ?>
 								
                                <?php
								if(isset($prop_status->status_title)){ ?>
                                <li>
                                    <strong><?php _e("Status", 'es-plugin'); ?>:</strong>
                                    <span><?php echo $prop_status->status_title?></span>
                                </li>
                                <?php } ?>
                                
                                <?php if($es_prop_single->prop_bedrooms!=0){ ?>
                                <li>
                                    <strong><?php _e("Bedrooms", 'es-plugin'); ?> </strong>
                                    <span><?php echo $es_prop_single->prop_bedrooms?></span>
                                </li>
                                <?php } ?>
 								
                                <?php if($es_prop_single->prop_bathrooms!=0){ ?>
                                <li>
                                    <strong><?php _e("Bathrooms", 'es-plugin'); ?>:</strong>
                                    <span><?php echo str_replace('.0', '', $es_prop_single->prop_bathrooms)?></span>
                                </li>
                                <?php } ?>
                                
                                <?php if($es_prop_single->prop_floors!=0){ ?>
                                <li>
                                    <strong><?php _e("Floors", 'es-plugin'); ?>:</strong>
                                    <span><?php echo $es_prop_single->prop_floors?></span>
                                </li>
                                <?php } ?>
                                
                                <?php if(isset($es_prop_single->prop_builtin) && $es_prop_single->prop_builtin!=""){ ?>
                                <li>
                                    <strong><?php _e("Built in", 'es-plugin'); ?></strong>
                                    <span><?php echo $es_prop_single->prop_builtin?></span>
                                </li>
                                <?php } ?>
                                
								<?php
                                $prop_meta = "";
                                $edit_pro_meta = $wpdb->get_row( 'SELECT prop_meta_value FROM '.$wpdb->prefix.'estatik_properties_meta WHERE prop_id = '.$es_prop_single->prop_id." and prop_meta_key = 'prop_custom_field'");
                                if(!empty($edit_pro_meta)){
                                    $prop_meta = $edit_pro_meta->prop_meta_value;
                                }
                                if($prop_meta != ""){ 
                                    $meta_value = unserialize($prop_meta);
                                    foreach($meta_value as $key=>$val){
                                        $key_val = str_replace("'","",$key);
                                ?>
                                        <li>
                                            <strong><?php echo $key_val?></strong>
                                            <span><?php echo $val?></span>
                                        </li>
                                <?php }
                                
                                } ?>
 
                            </ul>
                        </div>
                    </div>
                </div>
                
                <?php if(isset($es_prop_single->prop_description) && $es_prop_single->prop_description!=""){ ?>
                <div class="es_prop_single_basic_facts_desc">
                	<h3><?php _e("Description", 'es-plugin'); ?></h3>
                    <p><?php echo $es_prop_single->prop_description?></p>
                </div>
                <?php } ?>
                
            </div>
            
            <?php 
			   if($es_prop_single->prop_latitude!='') {	
			?>
                <div class="es_prop_single_view_map_neigh " id="es_single_neigh">
                    <h3><?php _e("View on map", 'es-plugin'); ?></h3>
                    
                    <?php if($es_prop_single->prop_latitude!='' && $es_prop_single->prop_longitude!='') { ?> 
 						 
                         <div id="es_prop_single_view_map">
                             
                        </div>
                    
                    <?php } ?> 
                </div>
            <?php } ?>
            
            <?php
			if(!empty($es_prop_features) || !empty($es_prop_appliances)){			
			?>
            
                <div class="es_prop_single_features  clearfix" id="es_single_features">
                    <h3><?php _e("Features", 'es-plugin'); ?></h3>
                    
                    <?php if(!empty($es_prop_features)){ ?>
                        <div class="es_prop_single_features_in">
                            <label><?php _e("Features", 'es-plugin'); ?>:</label>
                            <ul>
                                <?php
                                foreach($es_prop_features as $es_prop_feature) {
								?>
                                    <li><?php echo $es_prop_feature->feature_title?></li>
                                <?php } ?> 
                            </ul>
                        </div>
                    <?php } ?> 
                    
                    <?php if(!empty($es_prop_appliances)){ ?>
                        <div class="es_prop_single_features_in">
                            <label><?php _e("Amenities", 'es-plugin'); ?>:</label>
                            <ul>
                                <?php
                                foreach($es_prop_appliances as $es_prop_appliance) {
                                ?>
                                    <li><?php echo $es_prop_appliance->appliance_title?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                    
                </div>
            <?php } ?> 
 
		
        <div id="es_toTop" class="clearfix"> 
        	<a href="javascript:void(0)"><?php _e("To top", 'es-plugin'); ?></a>
        </div>
        
		<?php if($es_settings->powered_by_link==1) { ?>
            <div class="es_powred_by">
                <p><?php _e("Powered by", 'es-plugin'); ?> <a href="http://www.estatik.net" target="_blank">Estatik</a></p>
            </div>    
        <?php } ?>
        
     </div>
    </div>