<?php $es_settings = es_front_settings(); ?>

<div id="es_content" class="clearfix <?php if($es_settings->listing_layout=='3'){ echo 'es_3_column'; } else if($es_settings->listing_layout=='2'){ echo 'es_2_column'; } else { echo 'es_single_column'; }  ?>">
	
    <?php include('es_view_first.php'); ?>
    
    <div class="es_my_listing clearfix" id="es_specific_listing">
        <ul>
            <?
            global $wpdb;
  
            $es_settings = es_front_settings();
			$currency_sign_ex = explode(",", $es_settings->default_currency);
			if(count($currency_sign_ex)==1){
				$currency_sign = $currency_sign_ex[0];
			}else {
				$currency_sign = $currency_sign_ex[1];	
			}
 
            $where = "";
            $where_array = array();
          
            $where_array[]  =	'prop_pub_unpub	= 1';
            
            $where =  implode(" AND ",$where_array);
     
            //print($where);
            $paged = (isset($_GET['page_no']))?$_GET['page_no']:0;
            $es_settings = es_front_settings();
            $es_per_page = 	$es_settings->no_of_listing;
            
            if(!empty($where_array)){
                
                $sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_properties WHERE '.$where.' order by prop_id desc limit '.$paged.",".$es_per_page;
                $count = 'SELECT count(*) as total_record FROM '.$wpdb->prefix.'estatik_properties WHERE '.$where;
      
            }
 
         
            $es_my_listing 	  = $wpdb->get_results($sql); 
    		$es_count_listing = $wpdb->get_results($count);
            $total_record 	  = $es_count_listing[0];
			
			 
			require_once(PATH_DIR . 'front_templates/includes/pagination.php');
		 
			$config['base_url']  = '?';
            $config['total_rows'] = $total_record->total_record;
            $config['per_page']  = $es_per_page;
            $config['uri_segment'] = 3;
            $config['num_links']  = 1; 
            $pagination = new Pagination();
            $pagination->initialize($config); 
            $es_pagination = $pagination->create_links();
			
			
			$es_dimension_val = $wpdb->get_results( 'SELECT dimension_title FROM '.$wpdb->prefix.'estatik_manager_dimension WHERE dimension_status=1' ); 
			$es_dimension = new stdClass; 
			$es_dimension = $es_dimension_val[0];
			
            if(!empty($es_my_listing)) {
                foreach($es_my_listing as $list) {
                    
                //print_r($list);	
                    
            ?>
        
                <li class="prop_id-<?php echo $list->prop_id?>">
                    <div class="es_my_list_in clearfix">
                        <div class="es_my_list_pic">
                            <?php if($es_settings->labels==1){ ?>
                                <div class="prop_labels">
                                   <?php if($list->prop_featured==1){ ?>
                                        <label class="clearfix es_featured"><?php _e("Featured", 'es-plugin'); ?></label><br />
                                    <?php } ?>
                                    <?php if($list->prop_hot==1){ ?>
                                        <label class="clearfix es_hot"><?php _e("hot", 'es-plugin'); ?></label><br />
                                    <?php } ?>
                                    <?php if($list->prop_open_house==1){ ?>
                                        <label class="clearfix es_openhouse"><?php _e("openhouse", 'es-plugin'); ?></label><br />
                                    <?php } ?>
                                    <?php if($list->prop_foreclosure==1){ ?>
                                        <label class="clearfix es_foreclosure"><?php _e("foreclosure", 'es-plugin'); ?></label>
                                    <?php } ?>
                                </div>    
                            <?php } ?>
                            <a href="<?php echo get_permalink($list->prop_id);?>">
                                <?php 
                                $image_sql = "SELECT prop_meta_value FROM ".$wpdb->prefix."estatik_properties_meta WHERE prop_id = ".$list->prop_id." AND prop_meta_key = 'images'";
    
                                $uploaded_images = $wpdb->get_row($image_sql);
                            
								$uploaded_images_count ="0";
								if(!empty($uploaded_images)){
									$upload_image_data = unserialize($uploaded_images->prop_meta_value);
									$uploaded_images_count = count($upload_image_data); 
								}
								 
                                if(!empty($upload_image_data)) {
                                $upload_dir = wp_upload_dir(); 
                                
                               if($es_settings->listing_layout==3){
									$list_image_name = explode("/",$upload_image_data[0]);
									$list_image_name = end($list_image_name);
									$list_image_path = str_replace($list_image_name,"",$upload_image_data[0]);
									$image_url = $list_image_path.'list_'.$list_image_name;
								} else if($es_settings->listing_layout==2) {
									$list2_image_name = explode("/",$upload_image_data[0]);
									$list2_image_name = end($list2_image_name);
									$list2_image_path = str_replace($list2_image_name,"",$upload_image_data[0]);
									$image_url = $list2_image_path.'2column_'.$list2_image_name;
								} else if($es_settings->listing_layout==1) {
									$table_image_name = explode("/",$upload_image_data[0]);
									$table_image_name = end($table_image_name);
									$table_image_path = str_replace($table_image_name,"",$upload_image_data[0]);
									$image_url = $table_image_path.'table_'.$table_image_name;
								}
                                
                                ?>
                                    <img src="<?php echo $upload_dir['baseurl']?><?php echo $image_url?>" alt="" />
                                <?php } else{
                                    echo '<p>'.__("No Image", 'es-plugin').'</p>';
                                } ?>
                                <span><small>
                                <?php if(!empty($upload_image_data)) { ?>
                                    <?php echo $uploaded_images_count?>
                                <?php } else{ echo "0"; } ?>
                                </small></span>
                            </a>
                        </div>
                        <div class="es_my_list_title">
                            <?php if($es_settings->title==1) { ?>
                               <h3><a href="<?php echo get_permalink($list->prop_id);?>"><?php echo substr($list->prop_title,0,30); if(strlen($list->prop_title)>30) echo '...'; ?></a></h3>           
                             <?php } else{ ?>
                                <h3><a href="<?php echo get_permalink($list->prop_id);?>"><?php echo substr($list->prop_address,0,30); if(strlen($list->prop_address)>30) echo '...'; ?></a></h3>
                             <?php } ?>
                            <?php if($es_settings->price==1) {
                               $price_format = explode("|",$es_settings->price_format);	
                            ?>
                                <h2><?php if($es_settings->currency_sign_place=='before'){ echo $currency_sign ; }?><?php echo number_format($list->prop_price,$price_format[0],$price_format[1],$price_format[2]);?><?php if($es_settings->currency_sign_place=='after'){ echo $currency_sign; }?></h2>
                            <?php } ?>
                        </div>
                         
                        <div class="es_my_list_specs clearfix">
                            <span class="es_dimen"><?php if($list->prop_area!=0) { ?><?php echo $list->prop_area?><?php } ?> <?php echo $es_dimension->dimension_title;?></span>
                            <span class="es_bd"><?php if($list->prop_bedrooms!=0) { ?><?php echo $list->prop_bedrooms?><?php } ?> <?php _e("beds", 'es-plugin'); ?></span>
                            <span class="es_bth"><?php if($list->prop_bathrooms!=0) { ?><?php echo $list->prop_bathrooms?><?php } ?> <?php _e("bath", 'es-plugin'); ?></span>
                        </div>
                        <div class="es_my_list_more clearfix"> 
                            <a onclick="es_map_view_click(this); return false;" href="<?php if($list->prop_latitude!="" && $list->prop_longitude!="") { ?><?php echo $list->prop_latitude?>,<?php echo $list->prop_longitude; }?>" class="es_map_view"><?php _e("View on map", 'es-plugin'); ?></a>
                            <a href="<?php echo get_permalink($list->prop_id);?>" class="es_detail_btn"><?php _e("Details", 'es-plugin'); ?></a>
                        </div>
                    </div>
                </li>
            
            <?php
                }
            }
            else
            {
            
                echo '<li class="es_no_record">'.__("No record found.", 'es-plugin').'</li>';
        
            } 
            ?>
         </ul>
    </div>
    
    <div id="es_map_pop_outer">
    	<div id="es_map_pop">
        	<h2><?php _e("Map", 'es-plugin'); ?><a id="es_closePop" href="javascript:void(0)">×</a></h2>
            <div id="es_map"></div>
        </div>
    </div>
    
    <div id="es_more_pagi">
    	<?php echo $es_pagination; ?>
 	</div>
 
    <?php if($es_settings->powered_by_link==1) { ?>
        <div class="es_powred_by">
            <p><?php _e("Powered by", 'es-plugin'); ?> <a href="http://www.estatik.net" target="_blank">Estatik</a></p>
        </div>    
    <?php } ?>
    
</div> 