
	<?php
	  $es_settings = es_front_settings();
	  $upload_dir = wp_upload_dir();
	?>
 
    <div id="es_content" class="clearfix es_single_left">
 
        <div class="es_single_in">		
 			
            <?php
	  
			global $wpdb;
			$sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_properties WHERE prop_id = '.get_the_id().' order by prop_id desc';
			$es_prop_single = $wpdb->get_row($sql); 
			
			//print_r($es_prop_single);
			
			
			$prop_cat = $wpdb->get_row( 'SELECT cat_title FROM '.$wpdb->prefix.'estatik_manager_categories WHERE cat_id = "'.$es_prop_single->prop_category.'"');
			
			$prop_rent = $wpdb->get_row( 'SELECT period_title FROM '.$wpdb->prefix.'estatik_manager_rent_period WHERE period_id = "'.$es_prop_single->prop_period.'"');
 
			$prop_type = $wpdb->get_row( 'SELECT type_title FROM '.$wpdb->prefix.'estatik_manager_types WHERE type_id = "'.$es_prop_single->prop_type.'"');
			
			$prop_status = $wpdb->get_row( 'SELECT status_title FROM '.$wpdb->prefix.'estatik_manager_status WHERE status_id = "'.$es_prop_single->prop_status.'"');
			
			
			$es_settings = es_front_settings();
			$currency_sign_ex = explode(",", $es_settings->default_currency);
			if(count($currency_sign_ex)==1){
				$currency_sign = $currency_sign_ex[0];
			}else {
				$currency_sign = $currency_sign_ex[1];	
			}
		 
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
				$es_prop_features = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_properties_features WHERE prop_id='.$es_prop_single->prop_id );	
				$es_prop_appliances = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_properties_appliances WHERE prop_id='.$es_prop_single->prop_id );	
				$dimension_sql = "SELECT dimension_title FROM ".$wpdb->prefix."estatik_manager_dimension WHERE dimension_status = 1";
				$dimension = $wpdb->get_row($dimension_sql);
			?>
            
            <div class="es_prop_single_tabs_outer"> 
                <div class="es_prop_single_tabs clearfix">
                    <div class="es_prop_single_tabs_in clearfix">
                        <ul>
                            <li><a class="active" href="#es_single_basic_facts">Basic facts</a></li>
                            <?php if($es_prop_single->prop_latitude!='') { ?>
                            	<li><a href="#es_single_neigh">View on map</a></li>
                            <?php } ?>
                            <?php if(!empty($es_prop_features) || !empty($es_prop_appliances)){ ?>
                            	<li><a href="#es_single_features">Features</a></li>
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
                                    <strong>Date added:</strong>
                                    <span><?php echo date($es_settings->dare_format,$es_prop_single->prop_date_added)?></span>
                                </li>
                                <?php } ?> 
                                
								<?php if($es_prop_single->prop_area!=0){ ?>
                                <li>
                                    <strong>Area size:</strong>
                                    <span><?php echo $es_prop_single->prop_area?> <?php echo $dimension->dimension_title?></span>
                                </li>
                                <?php } ?> 
                                
                                <?php if($es_prop_single->prop_lotsize!=0){ ?>
                                <li>
                                    <strong>Lot size:</strong>
                                    <span><?php echo $es_prop_single->prop_lotsize?> <?php echo $dimension->dimension_title?></span>
                                </li>
                                <?php } ?>
                                
								<?php if(!empty($prop_cat) && $prop_cat->cat_title!="" && strpos($prop_cat->cat_title,"rent")!=""){ ?>
                                <li>
                                    <strong>Rent Period:</strong>
                                    <span><?php echo $prop_rent->period_title?></span>
                                </li>
                                <?php } ?>
                                
                                
                                <?php 
								if(isset($prop_type->type_title)){ ?>
                                <li>
                                    <strong>Type:</strong>
                                    <span><?php echo $prop_type->type_title?></span>
                                </li>
                                <?php } ?>
 								
                                <?php
								if(isset($prop_status->status_title)){ ?>
                                <li>
                                    <strong>Status:</strong>
                                    <span><?php echo $prop_status->status_title?></span>
                                </li>
                                <?php } ?>
                                
                                <?php if($es_prop_single->prop_bedrooms!=0){ ?>
                                <li>
                                    <strong>Bedrooms </strong>
                                    <span><?php echo $es_prop_single->prop_bedrooms?></span>
                                </li>
                                <?php } ?>
 								
                                <?php if($es_prop_single->prop_bathrooms!=0){ ?>
                                <li>
                                    <strong>Bathrooms:</strong>
                                    <span><?php echo $es_prop_single->prop_bathrooms?></span>
                                </li>
                                <?php } ?>
                                
                                <?php if($es_prop_single->prop_floors!=0){ ?>
                                <li>
                                    <strong>Floors:</strong>
                                    <span><?php echo $es_prop_single->prop_floors?></span>
                                </li>
                                <?php } ?>
                                
                                <?php if(isset($es_prop_single->prop_builtin) && $es_prop_single->prop_builtin!=""){ ?>
                                <li>
                                    <strong>Built in</strong>
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
                	<h3>Description</h3>
                    <p><?php echo $es_prop_single->prop_description?></p>
                </div>
                <?php } ?>
                
            </div>
            
            <?php 
			   if($es_prop_single->prop_latitude!='') {	
			?>
                <div class="es_prop_single_view_map_neigh " id="es_single_neigh">
                    <h3>View on map</h3>
                    
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
                    <h3>Features</h3>
                    
                    <?php if(!empty($es_prop_features)){ ?>
                        <div class="es_prop_single_features_in">
                            <label>Features:</label>
                            <ul>
                                <?php
                                foreach($es_prop_features as $es_prop_feature) {
                                    $es_prop_feature_val = $wpdb->get_row( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_features WHERE feature_id="'.$es_prop_feature->feature_id.'"');			
								?>
                                    <li><?php echo $es_prop_feature_val->feature_title?></li>
                                <?php } ?> 
                            </ul>
                        </div>
                    <?php } ?> 
                    
                    <?php if(!empty($es_prop_appliances)){ ?>
                        <div class="es_prop_single_features_in">
                            <label>Amenities:</label>
                            <ul>
                                <?php
                                foreach($es_prop_appliances as $es_prop_appliance) {
                                    $es_prop_appliance_val = $wpdb->get_row( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_appliances WHERE appliance_id="'.$es_prop_appliance->appliance_id.'"');		
                                ?>
                                    <li><?php echo $es_prop_appliance_val->appliance_title?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                    
                </div>
            <?php } ?> 
 
		
        <div id="es_toTop" class="clearfix"> 
        	<a href="javascript:void(0)">To top</a>
        </div>
        
		<?php if($es_settings->powered_by_link==1) { ?>
            <div class="es_powred_by">
                <p>Powered by <a href="http://www.estatik.net" target="_blank">Estatik</a></p>
            </div>    
        <?php } ?>
        
     </div>
    </div> 
  
 