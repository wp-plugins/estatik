<?php

function es_defualt_insertion(){
	
	global $wpdb;
	
	$property_status_count = wp_count_terms( 'property_status' );
		if($property_status_count==0){
		$es_status_title = array("open","closed");
		for($i=0; $i<count($es_status_title); $i++){	
			$status_obj  = wp_insert_term( $es_status_title[$i], 'property_status', array() );
		 
			if (!is_wp_error($status_obj)) {
		 
				$wpdb->insert(
					$wpdb->prefix.'estatik_manager_status',
					array(
						'status_id' => $status_obj['term_id'],
						'status_title' => $es_status_title[$i]
					)
				);
			}
		}
	}
	
	$property_category_count = wp_count_terms( 'property_category' );
	if($property_category_count==0){
	$es_category_title = array("for rent","for sale");
	for($i=0; $i<count($es_category_title); $i++){	
		$category_obj  = wp_insert_term( $es_category_title[$i], 'property_category', array() );
	 
		if (!is_wp_error($category_obj)) {
	 
			$wpdb->insert(
				$wpdb->prefix.'estatik_manager_categories',
				array(
					'cat_id' => $category_obj['term_id'],
					'cat_title' => $es_category_title[$i]
				)
			);
		}
	}
	}
	 
	$property_type_count = wp_count_terms( 'property_type' );
	if($property_type_count==0){
		$es_type_title = array("apartment","house","office");
		for($i=0; $i<count($es_type_title); $i++){	
			$type_obj  = wp_insert_term( $es_type_title[$i], 'property_type', array() );
		 
			if (!is_wp_error($type_obj)) {
		 
				$wpdb->insert(
					$wpdb->prefix.'estatik_manager_types',
					array(
						'type_id' => $type_obj['term_id'],
						'type_title' => $es_type_title[$i]
					)
				);
			}
		}
	}
	
	
	$estatik_settings_count =  $wpdb->query('SELECT setting_id as total FROM '.$wpdb->prefix.'estatik_settings');
	if($estatik_settings_count==0){
		$wpdb->insert( 
			$wpdb->prefix.'estatik_settings', 
			array( 
				'powered_by_link' 						=> '1',
				'no_of_listing' 						=> '3',
				'price' 								=> '1',
				'title' 								=> '1',
				'address' 								=> '1',
				'agent' 								=> '1',
				'labels' 								=> '1',
				'dare_format' 							=> 'd/m/y',
				'listing_layout' 						=> '1',
				'single_property_layout' 				=> '3',
				'resize_method' 						=> 'crop',
				'prop_listview_table_height' 			=> '150',
				'prop_listview_table_width' 			=> '260',
				'prop_listview_2column_height' 			=> '220',
				'prop_listview_2column_width' 			=> '370',
				'prop_listview_list_height' 			=> '220',
				'prop_listview_list_width' 				=> '370',
				'prop_singleview_photo_lr_height' 		=> '285',
				'prop_singleview_photo_lr_width' 		=> '500',
				'prop_singleview_photo_center_height' 	=> '285',
				'prop_singleview_photo_center_width' 	=> '800',
				'prop_singleview_photo_thumb_height' 	=> '48',
				'prop_singleview_photo_thumb_width' 	=> '84',
				'agents_height' 						=> '350',
				'agents_width' 							=> '265',
				'default_currency' 						=> 'USD,$',
				'price_format' 							=> '2|.|,',
				'currency_sign_place' 					=> 'after',
				'twitter_link' 							=> '1',
				'facebook_link' 						=> '1',
				'google_plus_link' 						=> '1',
				'linkedin_link' 						=> '1',
				'pdf_flayer' 							=> '1'
			) 
		);
	}
	
	
	$estatik_rent_period_count =  $wpdb->query('SELECT period_id as total FROM '.$wpdb->prefix.'estatik_manager_rent_period');
	if($estatik_rent_period_count==0){
		$es_rent_period_title = array("per day","per week","per month","per year");
		for($i=0; $i<count($es_rent_period_title); $i++){	
			$wpdb->insert( 
				$wpdb->prefix.'estatik_manager_rent_period', 
				array( 
					'period_title' 	=> $es_rent_period_title[$i],
				) 
			);
		}
	}
	
	$estatik_currency_count =  $wpdb->query('SELECT currency_id as total FROM '.$wpdb->prefix.'estatik_manager_currency');
	if($estatik_currency_count==0){
		$es_currency_title = array("USD,$","Euro,€","GBP,£");
		for($i=0; $i<count($es_currency_title); $i++){	
			$wpdb->insert( 
				$wpdb->prefix.'estatik_manager_currency', 
				array( 
					'currency_title' 	=> $es_currency_title[$i],
				) 
			);
		}
	}
	
	$estatik_dimension_count =  $wpdb->query('SELECT dimension_id as total FROM '.$wpdb->prefix.'estatik_manager_dimension');
	if($estatik_dimension_count==0){
		$es_dimension_title = array("sq ft","m2");
		for($i=0; $i<count($es_dimension_title); $i++){	
			$wpdb->insert( 
				$wpdb->prefix.'estatik_manager_dimension', 
				array( 
					'dimension_title' 	=> $es_dimension_title[$i],
				) 
			);
		}
		$wpdb->query('update '.$wpdb->prefix.'estatik_manager_dimension set dimension_status = 0');
		$wpdb->update($wpdb->prefix.'estatik_manager_dimension', array( 'dimension_status' => 1), array( 'dimension_title' =>$es_dimension_title[0]) );
	}
 
	
	$estatik_features_count =  $wpdb->query('SELECT feature_id as total FROM '.$wpdb->prefix.'estatik_manager_features');
	if($estatik_features_count==0){
		$es_features_title = array("heating","cooling","swimming pool","garden","parking");
		for($i=0; $i<count($es_features_title); $i++){	
			$wpdb->insert( 
				$wpdb->prefix.'estatik_manager_features', 
				array( 
					'feature_title' 	=> $es_features_title[$i],
				) 
			);
		}
	}
	
	
	$estatik_appliances_count =  $wpdb->query('SELECT appliance_id as total FROM '.$wpdb->prefix.'estatik_manager_appliances');
	if($estatik_appliances_count==0){
		$es_appliances_title = array("tv","wifi","dishwasher","microwave","oven","iron");
		for($i=0; $i<count($es_appliances_title); $i++){	
			$wpdb->insert( 
				$wpdb->prefix.'estatik_manager_appliances', 
				array( 
					'appliance_title' 	=> $es_appliances_title[$i],
				) 
			);
		}
	}
	 
}

add_action( 'init', 'es_defualt_insertion' );
