<?php

/****
Helper file for handling action and deaction of plugins.
On activation we have to create database tables and on deactivation we to drops the created tables
*/


function estatik_activate(){ 

	create_estatik_tables();
	
	add_role( 'agent_role', 'Agent', array( 'read' => true) );
	
	$menu_name = 'view_first';		
	$menu_exists = wp_get_nav_menu_object( $menu_name );
	if( !$menu_exists){
		wp_create_nav_menu($menu_name);
	}
	
	es_reset_permalinks(); 
}

function es_reset_permalinks() {
	global $wp_rewrite;
	$wp_rewrite->set_permalink_structure( '/%postname%/' );
	$wp_rewrite->flush_rules();
}

function estatik_de_activate(){ 
 
	//remove_estatik_tables();
	//remove_estatik_posts_cats_user();
 
}


function estatik_uninstall(){ 

//	remove_estatik_tables();
//	remove_estatik_posts_cats_user();
 
}


function remove_estatik_posts_cats_user(){ 
 
	global $wpdb;
 
	$term_del_query = "delete from ".$wpdb->prefix."terms where term_id in (select term_id from ".$wpdb->prefix."term_taxonomy where 
			taxonomy = 'property_category' or taxonomy = 'property_category' or taxonomy = 'property_status' or taxonomy = 'property_type')";
	$wpdb->query($term_del_query);
	
	$wpdb->delete( $wpdb->prefix.'posts', array( 'post_type' => 'properties' ) );
	$wpdb->delete( $wpdb->prefix.'term_taxonomy', array( 'taxonomy' => 'property_category' ) );
	$wpdb->delete( $wpdb->prefix.'term_taxonomy', array( 'taxonomy' => 'property_status' ) );
	$wpdb->delete( $wpdb->prefix.'term_taxonomy', array( 'taxonomy' => 'property_type' ) );
 
	$args = array(
			'role'         => 'agent_role',
		 ); 
	
	$wp_users = get_users( $args );
	foreach($wp_users as $user){
		wp_delete_user( $user->ID );
	}
	remove_role( 'agent_role' );	
		
}
 
 

function create_estatik_tables(){
	global $wpdb;
 
	$create_estatik_settings = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_settings (
						`setting_id` int(11) NOT NULL AUTO_INCREMENT,
						`powered_by_link` int(11) NOT NULL,
						`no_of_listing` int(11) NOT NULL,
						`price` int(1) NOT NULL,
						`title` int(1) NOT NULL,
						`address` int(1) NOT NULL,
						`agent` int(1) NOT NULL,
						`labels` int(1) NOT NULL,
						`dare_format` varchar(255) NOT NULL,
						`default_currency` varchar(255) NOT NULL,
						`price_format` varchar(255) NOT NULL,
						`currency_sign_place` varchar(255) NOT NULL,
						`resize_method` varchar(255) NOT NULL,
						`prop_listview_table_height` int(11) NOT NULL,
						`prop_listview_table_width` int(11) NOT NULL,
						`prop_listview_2column_height` int(11) NOT NULL,
						`prop_listview_2column_width` int(11) NOT NULL,
						`prop_listview_list_height` int(11) NOT NULL,
						`prop_listview_list_width` int(11) NOT NULL,
						`prop_singleview_photo_lr_height` int(11) NOT NULL,
						`prop_singleview_photo_lr_width` int(11) NOT NULL,
						`prop_singleview_photo_center_height` int(11) NOT NULL,
						`prop_singleview_photo_center_width` int(11) NOT NULL,
						`prop_singleview_photo_thumb_height` int(11) NOT NULL,
						`prop_singleview_photo_thumb_width` int(11) NOT NULL,
						`agents_height` int(11) NOT NULL,
						`agents_width` int(11) NOT NULL,
						`listing_layout` int(11) NOT NULL,
						`single_property_layout` int(11) NOT NULL,
						`twitter_link` varchar(255) NOT NULL,
						`facebook_link` varchar(255) NOT NULL,
						`google_plus_link` varchar(255) NOT NULL,
						`linkedin_link` varchar(255) NOT NULL,
						`pdf_flayer` varchar(255) NOT NULL,
						PRIMARY KEY (`setting_id`)
					  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_settings);
	 
	$create_estatik_agents = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_agents (
								  `agent_id` int(11) NOT NULL AUTO_INCREMENT,
								  `agent_name` varchar(255) NOT NULL,
								  `agent_user_name` varchar(255) NOT NULL,
								  `agent_email` varchar(255) NOT NULL,
								  `agent_company` varchar(255) NOT NULL,
								  `agent_prop_quantity` int(11) NOT NULL,
								  `agent_sold_prop` int(11) NOT NULL,
								  `agent_tel` int(11) NOT NULL,
								  `agent_web` varchar(255) NOT NULL,
								  `agent_rating` varchar(255) NOT NULL,
								  `agent_about` varchar(255) NOT NULL,
								  `agent_pic` varchar(255) NOT NULL,
								  `agent_meta` varchar(255) NOT NULL,
								  `agent_status` int(11) NOT NULL,
								  PRIMARY KEY (`agent_id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_agents);
	
 
	
	$create_estatik_properties = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_properties (
										  `prop_id` int(11) NOT NULL AUTO_INCREMENT,
										  `agent_id` int(11) NOT NULL,
										  `prop_number` int(11) NOT NULL,
										  `prop_pub_unpub` int(11) NOT NULL,
										  `prop_date_added` int(11) NOT NULL,
										  `prop_title` varchar(255) NOT NULL,
										  `prop_type` varchar(255) NOT NULL,
										  `prop_category` varchar(255) NOT NULL,
										  `prop_status` int(11) NOT NULL,
										  `prop_featured` varchar(255) NOT NULL,
										  `prop_hot` int(1) NOT NULL,
										  `prop_open_house` int(1) NOT NULL,
										  `prop_foreclosure` int(1) NOT NULL,
										  `prop_price` DECIMAL( 10, 2 ) NOT NULL ,
										  `prop_period` varchar(255) NOT NULL,
										  `prop_bedrooms` int(11) NOT NULL,
										  `prop_bathrooms` int(11) NOT NULL,
										  `prop_floors` int(11) NOT NULL,
										  `prop_area` int(11) NOT NULL,
										  `prop_lotsize` int(11) NOT NULL,
										  `prop_builtin` varchar(255) NOT NULL,
										  `prop_description` text NOT NULL,
										  `country_id` int(11) NOT NULL,
										  `state_id` int(11) NOT NULL,
										  `city_id` int(11) NOT NULL,
										  `prop_zip_postcode` int(11) NOT NULL,
										  `prop_street` varchar(255) NOT NULL,
										  `prop_address` varchar(255) NOT NULL,
										  `prop_longitude` varchar(255) NOT NULL,
										  `prop_latitude` varchar(255) NOT NULL,
										  `prop_meta_keywords` varchar(255) NOT NULL,
										  `prop_meta_description` varchar(255) NOT NULL,
										  PRIMARY KEY (`prop_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_properties);
	
	
	$create_estatik_properties_meta = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_properties_meta (
										  `prop_meta_id` int(11) NOT NULL AUTO_INCREMENT,
										  `prop_id` int(11) NOT NULL,
										  `prop_meta_key` varchar(255) NOT NULL,
										  `prop_meta_value` TEXT NOT NULL,
										  PRIMARY KEY (`prop_meta_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_properties_meta);
	
	
	$create_estatik_properties_neighboarhood = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_properties_neighboarhood (
												  `prop_neigh_id` int(11) NOT NULL AUTO_INCREMENT,
												  `neigh_id` int(11) NOT NULL,
												  `neigh_distance` varchar(255) NOT NULL,
												  `prop_id` int(11) NOT NULL,
												   PRIMARY KEY (`prop_neigh_id`)
												) ENGINE=MyISAM DEFAULT CHARSET=utf8';
	
	$wpdb->query($create_estatik_properties_neighboarhood);
	
	
	$create_estatik_properties_features = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_properties_features (
										  `prop_feature_id` int(11) NOT NULL AUTO_INCREMENT,
										  `feature_id` int(11) NOT NULL,
										  `prop_id` int(11) NOT NULL,
										  PRIMARY KEY (`prop_feature_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_properties_features);
	
	
	$create_estatik_properties_appliances = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_properties_appliances (
											  `prop_app_id` int(11) NOT NULL AUTO_INCREMENT,
											  `appliance_id` int(11) NOT NULL,
											  `prop_id` int(11) NOT NULL,
											  PRIMARY KEY (`prop_app_id`)
											) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_properties_appliances);
	
	
	
	
	$create_estatik_manager_appliances = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_appliances (
										  `appliance_id` int(11) NOT NULL AUTO_INCREMENT,
										  `appliance_title` varchar(255) NOT NULL,
										  PRIMARY KEY (`appliance_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_appliances);
	
	
	$create_estatik_manager_categories = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_categories (
										  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
										  `cat_title` varchar(255) NOT NULL,
										  PRIMARY KEY (`cat_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_categories);
	
	
	$create_estatik_manager_cities = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_cities (
										  `city_id` int(11) NOT NULL AUTO_INCREMENT,
										  `city_title` varchar(255) NOT NULL,
										  `state_id` int(11) NOT NULL,
										  PRIMARY KEY (`city_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_cities);
	
	
	$create_estatik_manager_countries = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_countries (
										  `country_id` int(11) NOT NULL AUTO_INCREMENT,
										  `country_title` varchar(255) NOT NULL,
										  PRIMARY KEY (`country_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_countries);
	
	
	$create_estatik_manager_currency = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_currency (
										  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
										  `currency_title` varchar(255) NOT NULL,
										 `currency_status` int(11) NOT NULL,
										  PRIMARY KEY (`currency_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_currency);
	
	
	$create_estatik_manager_dimension = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_dimension (
										  `dimension_id` int(11) NOT NULL AUTO_INCREMENT,
										  `dimension_title` varchar(255) NOT NULL,
										  `dimension_status` int(11) NOT NULL,
										  PRIMARY KEY (`dimension_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_dimension);
	
	
	$create_estatik_manager_features = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_features (
										  `feature_id` int(11) NOT NULL AUTO_INCREMENT,
										  `feature_title` varchar(255) NOT NULL,
										  PRIMARY KEY (`feature_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_features);
	
	
	$create_estatik_manager_neighboarhood = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_neighboarhood (
										  `neigh_id` int(11) NOT NULL AUTO_INCREMENT,
										  `neigh_title` varchar(255) NOT NULL,
										  PRIMARY KEY (`neigh_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_neighboarhood);
	
	
	$create_estatik_manager_rent_period = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_rent_period (
										  `period_id` int(11) NOT NULL AUTO_INCREMENT,
										  `period_title` varchar(255) NOT NULL,
										  PRIMARY KEY (`period_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_rent_period);
	
	
	$create_estatik_manager_states = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_states (
										  `state_id` int(11) NOT NULL AUTO_INCREMENT,
										  `state_title` varchar(255) NOT NULL,
										  `country_id` int(11) NOT NULL,
										  PRIMARY KEY (`state_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_states);
	
	
	$create_estatik_manager_status = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_status (
										  `status_id` int(11) NOT NULL AUTO_INCREMENT,
										  `status_title` varchar(255) NOT NULL,
										  PRIMARY KEY (`status_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_status);
	
	
	$create_estatik_manager_types = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'estatik_manager_types (
										  `type_id` int(11) NOT NULL AUTO_INCREMENT,
										  `type_title` varchar(255) NOT NULL,
										  PRIMARY KEY (`type_id`)
										) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
	
	$wpdb->query($create_estatik_manager_types);
	
 
}


function remove_estatik_tables(){
	global $wpdb;
	$drop_estatik_settings					= 'DROP TABLE '.$wpdb->prefix.'estatik_settings';
	$wpdb->query($drop_estatik_settings);
	
	$drop_estatik_agents					= 'DROP TABLE '.$wpdb->prefix.'estatik_agents';
	$wpdb->query($drop_estatik_agents);
	
	
	$drop_estatik_properties 				= 'DROP TABLE '.$wpdb->prefix.'estatik_properties';
	$wpdb->query($drop_estatik_properties);
	
	$drop_estatik_properties_meta 			= 'DROP TABLE '.$wpdb->prefix.'estatik_properties_meta';
	$wpdb->query($drop_estatik_properties_meta);
	
	$drop_estatik_properties_neighboarhood 	= 'DROP TABLE '.$wpdb->prefix.'estatik_properties_neighboarhood';
	$wpdb->query($drop_estatik_properties_neighboarhood);

	
	$drop_estatik_properties_features 		= 'DROP TABLE '.$wpdb->prefix.'estatik_properties_features';
	$wpdb->query($drop_estatik_properties_features);
	
	$drop_estatik_properties_appliances 	= 'DROP TABLE '.$wpdb->prefix.'estatik_properties_appliances';
	$wpdb->query($drop_estatik_properties_appliances);
	
	
	
	$drop_estatik_manager_appliances 		= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_appliances';
	$wpdb->query($drop_estatik_manager_appliances);
	
	$drop_estatik_manager_categories 		= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_categories';
	$wpdb->query($drop_estatik_manager_categories);
	
	$drop_estatik_manager_cities 			= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_cities';
	$wpdb->query($drop_estatik_manager_cities);
	
	$drop_estatik_manager_countries 		= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_countries';
	$wpdb->query($drop_estatik_manager_countries);
	
	$drop_estatik_manager_currency 			= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_currency';
	$wpdb->query($drop_estatik_manager_currency);
	
	$drop_estatik_manager_dimension 		= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_dimension';
	$wpdb->query($drop_estatik_manager_dimension);
	
	$drop_estatik_manager_features 			= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_features';
	$wpdb->query($drop_estatik_manager_features);
	
	$drop_estatik_manager_neighboarhood 	= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_neighboarhood';
	$wpdb->query($drop_estatik_manager_neighboarhood);
	
	$drop_estatik_manager_rent_period 		= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_rent_period';
	$wpdb->query($drop_estatik_manager_rent_period);
	
	$drop_estatik_manager_states 			= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_states';
	$wpdb->query($drop_estatik_manager_states);
	
	$drop_estatik_manager_status 			= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_status';
	$wpdb->query($drop_estatik_manager_status);
	
	$drop_estatik_manager_types 			= 'DROP TABLE '.$wpdb->prefix.'estatik_manager_types';
	$wpdb->query($drop_estatik_manager_types);
 
}