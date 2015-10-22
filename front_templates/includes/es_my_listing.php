<?php $es_settings = es_front_settings(); ?>

<div id="es_content" class="clearfix <?php if($es_settings->listing_layout=='3'){ echo 'es_3_column'; } else if($es_settings->listing_layout=='2'){ echo 'es_2_column'; } else { echo 'es_1_column'; }  ?>">
    
 
    <?php if (is_search() || isset($_GET['s'])) { ?>
        <div class="es_success"><?php _e("Your search results.", 'es-plugin'); ?></div>
    <?php } ?>

 
    <div class="es_my_listing clearfix">
        <ul>
            <?php
            global $wpdb;

            $address = (isset($_GET['address'])) ? sanitize_text_field($_GET['address']) : "";
            $country = (isset($_GET['country'])) ? sanitize_text_field($_GET['country']) : "";
            $state = (isset($_GET['state'])) ? sanitize_text_field($_GET['state']) : "";
            $city = (isset($_GET['city'])) ? sanitize_text_field($_GET['city']) : "";

            $key_words      = (isset($_GET['key_words'])) ? sanitize_text_field($_GET['key_words']) : "";
            $agent          = (isset($_GET['agent'])) ? sanitize_text_field($_GET['agent']) : "";
            $type           = (isset($_GET['type'])) ? sanitize_text_field($_GET['type']) : "";
            
            $category       = (isset($_GET['category'])) ? sanitize_text_field($_GET['category']) : "";
            $price_min      = (isset($_GET['price_min'])) ? sanitize_text_field($_GET['price_min']) : "";
            $price_max      = (isset($_GET['price_max'])) ? sanitize_text_field($_GET['price_max']) : "";
            $bedrooms_min   = (isset($_GET['bedrooms_min'])) ? sanitize_text_field($_GET['bedrooms_min']) : "";
            $bedrooms_max   = (isset($_GET['bedrooms_max'])) ? sanitize_text_field($_GET['bedrooms_max']) : "";
            $bathrooms_min  = (isset($_GET['bathrooms_min'])) ? sanitize_text_field($_GET['bathrooms_min']) : "";
            $bathrooms_max  = (isset($_GET['bathrooms_max'])) ? sanitize_text_field($_GET['bathrooms_max']) : "";
            
            $area_min       = (isset($_GET['area_min'])) ? sanitize_text_field($_GET['area_min']) : "";
            $area_max       = (isset($_GET['area_max'])) ? sanitize_text_field($_GET['area_max']) : "";
            $lotsize_min    = (isset($_GET['lotsize_min'])) ? sanitize_text_field($_GET['lotsize_min']) : "";
            $lotsize_max    = (isset($_GET['lotsize_max'])) ? sanitize_text_field($_GET['lotsize_max']) : "";
 
    
            $where = "";
            $where_array = array();
            if($address != ''){
                $where_array[]  =   'prop_address   like  "%'.$address.'%"';
            }
            
            if ($country != '') {
                $where_array[] = 'country_id ="' . $country . '"';
            }

            if ($state != '') {
                $where_array[] = 'state_id ="' . $state . '"';
            }

            if ($city != '') {
                $where_array[] = 'city_id ="' . $city . '"';
            }

            //( prop_price >= '.$price_min.' AND prop_price <= '.$price_max.' )';
            
            if($price_min != '' && $price_max == '' ){
                $where_array[]  =   ' prop_price >= '.$price_min.'';
            }
            if($price_max != '' && $price_min == '' ){
                $where_array[]  =   ' prop_price <= '.$price_max.'';
            }
            if($price_min != '' && $price_max != '' ){
                $where_array[]  =   ' prop_price BETWEEN '.$price_min.' AND '.$price_max.'';
            }
            
            if($bedrooms_min != '' && $bedrooms_max == '' ){
                $where_array[]  =   ' prop_bedrooms >= '.$bedrooms_min.'';
            }
            if($bedrooms_max != '' && $bedrooms_min == '' ){
                $where_array[]  =   ' prop_bedrooms <= '.$bedrooms_max.'';
            }
            if($bedrooms_min != '' && $bedrooms_max != '' ){
                $where_array[]  =   ' prop_bedrooms BETWEEN '.$bedrooms_min.' AND '.$bedrooms_max.'';
            }
            
            if($bathrooms_min != '' && $bathrooms_max == '' ){
                $where_array[]  =   ' prop_bathrooms >= '.$bathrooms_min.'';
            }
            if($bathrooms_max != '' && $bathrooms_min == '' ){
                $where_array[]  =   ' prop_bathrooms <= '.$bathrooms_max.'';
            }
            if($bathrooms_min != '' && $bathrooms_max != '' ){
                $where_array[]  =   ' prop_bathrooms BETWEEN '.$bathrooms_min.' AND '.$bathrooms_max.'';
            }
            
            if($area_min != '' && $area_max == '' ){
                $where_array[]  =   ' prop_area >= '.$area_min.'';
            }
            if($area_max != '' && $area_min == '' ){
                $where_array[]  =   ' prop_area <= '.$area_max.'';
            }
            if($area_min != '' && $area_max != '' ){
                $where_array[]  =   ' prop_area BETWEEN '.$area_min.' AND '.$area_max.'';
            }
            
            if($lotsize_min != '' && $lotsize_max == '' ){
                $where_array[]  =   ' prop_lotsize >= '.$lotsize_min.'';
            }
            if($lotsize_max != '' && $lotsize_min == '' ){
                $where_array[]  =   ' prop_lotsize <= '.$lotsize_max.'';
            }
            if($lotsize_min != '' && $lotsize_max != '' ){
                $where_array[]  =   ' prop_lotsize BETWEEN '.$lotsize_min.' AND '.$lotsize_max.'';
            }
            
            if($category != ''){
                $where_array[]  =   'prop_category = "'.$category.'"';
            }
            if($type != ''){
                $where_array[]  =   'prop_type  =  "'.$type.'"';
            }
            if($agent != ''){
                $where_array[]  =   'agent_id   =  "'.$agent.'"';
            }
            if(!empty($_GET['agent'])){
                $where_array[]  =   'agent_id   =  "'.$_GET['agent'].'"';
            }
            
            $keyword_array = array();
            $where_keyword ="";
            if($key_words != ''){
                $keyword_array[]  = 'prop_title             like  "%'.$key_words.'%"';
                $keyword_array[]  = 'prop_description       like  "%'.$key_words.'%"';
                $keyword_array[]  = 'prop_address           like  "%'.$key_words.'%"';
                $keyword_array[]  = 'prop_meta_keywords     like  "%'.$key_words.'%"';
                $keyword_array[]  = 'prop_meta_description  like  "%'.$key_words.'%"';

                $where_keyword =  " AND ( ".implode(" OR ",$keyword_array)." )";
                
            }
            //print($where_keyword);
         
            // if($queried_object->taxonomy == 'property_category'){
            //     $where_array[]  =   'prop_category  =  "'.$queried_object->term_id.'"';
            // }
            
            // if($queried_object->taxonomy == 'property_status'){
            //     $where_array[]  =   'prop_status    =  "'.$queried_object->term_id.'"';
            // }
            
            // if($queried_object->taxonomy == 'property_type'){
            //     $where_array[]  =   'prop_type  =  "'.$queried_object->term_id.'"';
            // }
             
            // if($queried_object->user_login!=""){
            //     $where_array[]  =   'agent_id   =  "'.$queried_object->ID.'"';
            // }
  
            
            $where_array[]  =   'prop_pub_unpub = 1';
            $where =  implode(" AND ",$where_array);

            get_list("WHERE ($where) $where_keyword", "ORDER BY prop_id DESC");
?>