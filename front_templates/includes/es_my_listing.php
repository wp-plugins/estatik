
<?php $es_settings = es_front_settings(); ?>

<div id="es_content" class="clearfix <?php if($es_settings->listing_layout=='3'){ echo 'es_3_column'; } else if($es_settings->listing_layout=='2'){ echo 'es_2_column'; } else { echo 'es_single_column'; }  ?>">
 	
    <div class="es_listing_change">
    	<?php include('es_view_first.php'); ?>
    </div>
 		
        <?php if ( is_active_sidebar( 'es-toppage-sidebar' ) ) : ?>

			<?php dynamic_sidebar( 'es-toppage-sidebar' ); ?>
        
        <?php endif; ?>
 
	<?php if (is_search() || isset($_GET['s'])) { ?>
		<div class="es_success"><?php _e("Your search results.", 'es-plugin'); ?></div>
	<?php } ?>

 
    <div class="es_my_listing clearfix">
        <ul>
            <?php
            global $wpdb;
 			
			$address 		= (isset($_GET['address'])) ? sanitize_text_field($_GET['address']) : "";
			$key_words 		= (isset($_GET['key_words'])) ? sanitize_text_field($_GET['key_words']) : "";
			$agent 			= (isset($_GET['agent'])) ? sanitize_text_field($_GET['agent']) : "";
			$type 			= (isset($_GET['type'])) ? sanitize_text_field($_GET['type']) : "";
			
			$category 		= (isset($_GET['category'])) ? sanitize_text_field($_GET['category']) : "";
			$price_min 		= (isset($_GET['price_min'])) ? sanitize_text_field($_GET['price_min']) : "";
			$price_max 		= (isset($_GET['price_max'])) ? sanitize_text_field($_GET['price_max']) : "";
			$bedrooms_min 	= (isset($_GET['bedrooms_min'])) ? sanitize_text_field($_GET['bedrooms_min']) : "";
			$bedrooms_max 	= (isset($_GET['bedrooms_max'])) ? sanitize_text_field($_GET['bedrooms_max']) : "";
			$bathrooms_min 	= (isset($_GET['bathrooms_min'])) ? sanitize_text_field($_GET['bathrooms_min']) : "";
			$bathrooms_max 	= (isset($_GET['bathrooms_max'])) ? sanitize_text_field($_GET['bathrooms_max']) : "";
			
			$area_min 		= (isset($_GET['area_min'])) ? sanitize_text_field($_GET['area_min']) : "";
			$area_max 		= (isset($_GET['area_max'])) ? sanitize_text_field($_GET['area_max']) : "";
			$lotsize_min 	= (isset($_GET['lotsize_min'])) ? sanitize_text_field($_GET['lotsize_min']) : "";
			$lotsize_max 	= (isset($_GET['lotsize_max'])) ? sanitize_text_field($_GET['lotsize_max']) : "";
 
    
            $where = "";
            $where_array = array();
            if($address != ''){
                $where_array[]  =	'prop_address 	like  "%'.$address.'%"';
            }
            
            //( prop_price >= '.$price_min.' AND prop_price <= '.$price_max.' )';
            
            if($price_min != '' && $price_max == '' ){
                $where_array[]  =	' prop_price >= '.$price_min.'';
            }
            if($price_max != '' && $price_min == '' ){
                $where_array[]  =	' prop_price <= '.$price_max.'';
            }
            if($price_min != '' && $price_max != '' ){
                $where_array[]  =	' prop_price BETWEEN '.$price_min.' AND '.$price_max.'';
            }
            
            if($bedrooms_min != '' && $bedrooms_max == '' ){
                $where_array[]  =	' prop_bedrooms >= '.$bedrooms_min.'';
            }
            if($bedrooms_max != '' && $bedrooms_min == '' ){
                $where_array[]  =	' prop_bedrooms <= '.$bedrooms_max.'';
            }
            if($bedrooms_min != '' && $bedrooms_max != '' ){
                $where_array[]  =	' prop_bedrooms BETWEEN '.$bedrooms_min.' AND '.$bedrooms_max.'';
            }
            
            if($bathrooms_min != '' && $bathrooms_max == '' ){
                $where_array[]  =	' prop_bathrooms >= '.$bathrooms_min.'';
            }
            if($bathrooms_max != '' && $bathrooms_min == '' ){
                $where_array[]  =	' prop_bathrooms <= '.$bathrooms_max.'';
            }
            if($bathrooms_min != '' && $bathrooms_max != '' ){
                $where_array[]  =	' prop_bathrooms BETWEEN '.$bathrooms_min.' AND '.$bathrooms_max.'';
            }
            
            if($area_min != '' && $area_max == '' ){
                $where_array[]  =	' prop_area >= '.$area_min.'';
            }
            if($area_max != '' && $area_min == '' ){
                $where_array[]  =	' prop_area <= '.$area_max.'';
            }
            if($area_min != '' && $area_max != '' ){
                $where_array[]  =	' prop_area BETWEEN '.$area_min.' AND '.$area_max.'';
            }
            
            if($lotsize_min != '' && $lotsize_max == '' ){
                $where_array[]  =	' prop_lotsize >= '.$lotsize_min.'';
            }
            if($lotsize_max != '' && $lotsize_min == '' ){
                $where_array[]  =	' prop_lotsize <= '.$lotsize_max.'';
            }
            if($lotsize_min != '' && $lotsize_max != '' ){
                $where_array[]  =	' prop_lotsize BETWEEN '.$lotsize_min.' AND '.$lotsize_max.'';
            }
            
            if($category != ''){
                $where_array[]  =	'prop_category 	=  "'.$category.'"';
            }
            if($type != ''){
                $where_array[]  =	'prop_type 	=  "'.$type.'"';
            }
            if($agent != ''){
                $where_array[]  =	'agent_id 	=  "'.$agent.'"';
            }
            if(isset($_GET['agent'])){
                $where_array[]  =	'agent_id 	=  "'.$_GET['agent'].'"';
            }
			
			$keyword_array = array();
            $where_keyword ="";
			if($key_words != ''){
                $keyword_array[]  =	'prop_title 			like  "%'.$key_words.'%"';
				$keyword_array[]  =	'prop_description 		like  "%'.$key_words.'%"';
				$keyword_array[]  =	'prop_address 			like  "%'.$key_words.'%"';
				$keyword_array[]  =	'prop_meta_keywords 	like  "%'.$key_words.'%"';
				$keyword_array[]  =	'prop_meta_description 	like  "%'.$key_words.'%"';

            	$where_keyword =  " AND ( ".implode(" OR ",$keyword_array)." )";
				
            }
			//print($where_keyword);
		 
			if($queried_object->taxonomy == 'property_category'){
                $where_array[]  =	'prop_category 	=  "'.$queried_object->term_id.'"';
            }
			
			if($queried_object->taxonomy == 'property_status'){
                $where_array[]  =	'prop_status 	=  "'.$queried_object->term_id.'"';
            }
			
			if($queried_object->taxonomy == 'property_type'){
                $where_array[]  =	'prop_type 	=  "'.$queried_object->term_id.'"';
            }
			 
			if($queried_object->user_login!=""){
				$where_array[]  =	'agent_id 	=  "'.$queried_object->ID.'"';
            }
  
			
            $where_array[]  =	'prop_pub_unpub	= 1';
            $where =  implode(" AND ",$where_array);
			
			 
            //print($where);
            $paged = (isset($_GET['page_no']))?$_GET['page_no']:0;
            $es_settings = es_front_settings();
            $es_per_page = 	$es_settings->no_of_listing;
            
            if(!empty($where_array)){
                
                $sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_properties WHERE ('.$where.') '.$where_keyword.' order by prop_id desc limit '.$paged.",".$es_per_page;
                $count = 'SELECT count(*) as total_record FROM '.$wpdb->prefix.'estatik_properties WHERE ('.$where.') '.$where_keyword;
      
            }
			//print($sql);
			
            $es_my_listing 	  = $wpdb->get_results($sql); 
            $es_count_listing = $wpdb->get_results($count);
            $total_record 	  = $es_count_listing[0];
            
     
            require_once(PATH_DIR . 'front_templates/includes/pagination.php');
             
            $config['base_url']  = '?';
			if (is_search() || isset($_GET['s'])) {
				$config['suffix'] .= (isset($_GET['address'])) ? '&address=' . sanitize_text_field($_GET['address']) : "&address=";
				$config['suffix'] .= (isset($_GET['key_words'])) ? '&key_words=' . sanitize_text_field($_GET['key_words']) : "&key_words=";
				$config['suffix'] .= (isset($_GET['agent'])) ? '&agent=' . sanitize_text_field($_GET['agent']) : "&agent=";
				$config['suffix'] .= (isset($_GET['type'])) ? '&type=' . sanitize_text_field($_GET['type']) : "&type=";

				$config['suffix'] .= (isset($_GET['category'])) ? '&category=' . sanitize_text_field($_GET['category']) : "&category=";
				$config['suffix'] .= (isset($_GET['price_min'])) ? '&price_min=' . sanitize_text_field($_GET['price_min']) : "&price_min=";
				$config['suffix'] .= (isset($_GET['price_max'])) ? '&price_max=' . sanitize_text_field($_GET['price_max']) : "&price_max=";
				$config['suffix'] .= (isset($_GET['bedrooms_min'])) ? '&bedrooms_min=' . sanitize_text_field($_GET['bedrooms_min']) : "&bedrooms_min=";
				$config['suffix'] .= (isset($_GET['bedrooms_max'])) ? '&bedrooms_max=' . sanitize_text_field($_GET['bedrooms_max']) : "&bedrooms_max=";
				$config['suffix'] .= (isset($_GET['bathrooms_min'])) ? '&bathrooms_min=' . sanitize_text_field($_GET['bathrooms_min']) : "&bathrooms_min=";
				$config['suffix'] .= (isset($_GET['bathrooms_max'])) ? '&bathrooms_max=' . sanitize_text_field($_GET['bathrooms_max']) : "&bathrooms_max=";

				$config['suffix'] .= (isset($_GET['area_min'])) ? '&area_min=' . sanitize_text_field($_GET['area_min']) : "&area_min=";
				$config['suffix'] .= (isset($_GET['area_max'])) ? '&area_max=' . sanitize_text_field($_GET['area_max']) : "&area_max=";
				$config['suffix'] .= (isset($_GET['lotsize_min'])) ? '&lotsize_min=' . sanitize_text_field($_GET['lotsize_min']) : "&lotsize_min=";
				$config['suffix'] .= (isset($_GET['lotsize_max'])) ? '&lotsize_max=' . sanitize_text_field($_GET['lotsize_max']) : "&lotsize_max=";
			}

            $config['total_rows'] = $total_record->total_record;
            $config['per_page']  = $es_per_page;
            $config['uri_segment'] = 3;
            $config['num_links']  = 1; 
            $pagination = new Pagination();
            $pagination->initialize($config); 
            $es_pagination = $pagination->create_links();
            
            $es_settings = es_front_settings();
			$currency_sign_ex = explode(",", $es_settings->default_currency);
			if(count($currency_sign_ex)==1){
				$currency_sign = $currency_sign_ex[0];
			}else {
				$currency_sign = $currency_sign_ex[1];	
			}
             
     		
			$es_dimension = $wpdb->get_row( 'SELECT dimension_title FROM '.$wpdb->prefix.'estatik_manager_dimension WHERE dimension_status=1' ); 
 
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
                            <span class="es_dimen"><?php if($list->prop_area!=0) { ?><?php echo $list->prop_area?><?php } ?> <?php if(!empty($es_dimension)) { echo $es_dimension->dimension_title; } ?></span>
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
    <?php echo $es_pagination; ?>
    
    <?php if($es_settings->powered_by_link==1) { ?>
        <div class="es_powred_by">
            <p><?php _e("Powered by", 'es-plugin'); ?> <a href="http://www.estatik.net" target="_blank">Estatik</a></p>
        </div>    
    <?php } ?>
    
    <div id="es_map_pop_outer">
    	<div id="es_map_pop">
        	<h2><?php _e("Map", 'es-plugin'); ?><a id="es_closePop" href="javascript:void(0)">×</a></h2>
            <div id="es_map"></div>
        </div>
    </div>
    
</div> 