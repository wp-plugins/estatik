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
 
if ( !function_exists('create_or_update') ) {
	function create_or_update($table, $fields, $primary) {
	    global $wpdb;
	    $table = $wpdb->prefix . $table;
	    $db_name = DB_NAME;
	    $fields_to_create = '';
	    $fields_to_update = '';
	    foreach ( $fields as $name => $format ) {
	    	$fields_to_create[] = "`$name` $format";
	    	// $fields_to_update[] = "ALTER TABLE `$table` ADD `$name` $format;";
	    	$fields_to_update[] = "IF NOT EXISTS( SELECT NULL
					FROM INFORMATION_SCHEMA.COLUMNS
					WHERE table_name = '$table'
					AND table_schema = '$db_name'
					AND column_name = '$name')  
				THEN
					ALTER TABLE `$table` ADD `$name` $format;
				ELSE 
					ALTER TABLE `$table` CHANGE COLUMN `$name` `$name` $format;
				END IF;";
	    }
	    $fields_to_create = implode(', ', $fields_to_create);
	    $fields_to_update = implode(' ', $fields_to_update);
	    $wpdb->query("DROP PROCEDURE IF EXISTS upgrade_$table");
	    $wpdb->query("CREATE PROCEDURE upgrade_$table()
			BEGIN
			IF NOT EXISTS( SELECT NULL
				FROM INFORMATION_SCHEMA.COLUMNS
				WHERE table_name = '$table'
				AND table_schema = '$db_name')  
			THEN
				CREATE TABLE `$table` ($fields_to_create, PRIMARY KEY (`$primary`)) 
				ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
			ELSE
				$fields_to_update
			END IF;
			
			END");
	   $wpdb->query("CALL upgrade_$table()");
	}
}

function insert_default($setting_name, $values) {
	global $wpdb;
	$table = "{$wpdb->prefix}estatik_manager_$setting_name";
	$rows_number = $wpdb->get_row("SELECT COUNT(*) AS count FROM $table")->count;
	if ( $rows_number > 0 ) {
		return;
	}
	foreach ( $values as $value ) {	
		$wpdb->insert($table, array( "{$setting_name}_title" => $value ));
	}
}
 

function create_estatik_tables(){
	global $wpdb;
 
    create_or_update('estatik_settings', array(
		"setting_id" => "int(11) NOT NULL AUTO_INCREMENT",
		"powered_by_link" => "int(11) NOT NULL DEFAULT '1'",
		"no_of_listing" => "int(11) NOT NULL DEFAULT '3'",
		"price" => "int(1) NOT NULL DEFAULT '1'",
		"title" => "int(1) NOT NULL DEFAULT '1'",
		"address" => "int(1) NOT NULL DEFAULT '1'",
		"agent" => "int(1) NOT NULL DEFAULT '1'",
		"labels" => "int(1) NOT NULL DEFAULT '1'",
		"date_format" => "varchar(255) NOT NULL DEFAULT 'd/m/y'",
		"theme_style" => "varchar(255) NOT NULL DEFAULT 'light'",
		"default_currency" => "varchar(255) NOT NULL DEFAULT 'USD,$'",
		"price_format" => "varchar(255) NOT NULL DEFAULT '2|.|,'",
		"currency_sign_place" => "varchar(255) NOT NULL DEFAULT 'after'",
		"resize_method" => "varchar(255) NOT NULL DEFAULT 'crop'",
		"prop_listview_table_height" => "int(11) NOT NULL DEFAULT '150'",
		"prop_listview_table_width" => "int(11) NOT NULL DEFAULT '260'",
		"prop_listview_2column_height" => "int(11) NOT NULL DEFAULT '220'",
		"prop_listview_2column_width" => "int(11) NOT NULL DEFAULT '370'",
		"prop_listview_list_height" => "int(11) NOT NULL",
		"prop_listview_list_width" => "int(11) NOT NULL",
		"prop_singleview_photo_lr_height" => "int(11) NOT NULL DEFAULT '285'",
		"prop_singleview_photo_lr_width" => "int(11) NOT NULL DEFAULT '500'",
		"prop_singleview_photo_center_height" => "int(11) NOT NULL DEFAULT '285'",
		"prop_singleview_photo_center_width" => "int(11) NOT NULL DEFAULT '800'",
		"prop_singleview_photo_thumb_height" => "int(11) NOT NULL DEFAULT '48'",
		"prop_singleview_photo_thumb_width" => "int(11) NOT NULL DEFAULT '84'",
		"agents_height" => "int(11) NOT NULL DEFAULT '350'",
		"agents_width" => "int(11) NOT NULL DEFAULT '265'",
		"listing_layout" => "int(11) NOT NULL DEFAULT '1'",
		"single_property_layout" => "int(11) NOT NULL DEFAULT '3'",
		"twitter_link" => "varchar(255) NOT NULL DEFAULT '1'",
		"facebook_link" => "varchar(255) NOT NULL DEFAULT '1'",
		"google_plus_link" => "varchar(255) NOT NULL DEFAULT '1'",
		"linkedin_link" => "varchar(255) NOT NULL DEFAULT '1'",
		"pdf_player" => "varchar(255) NOT NULL DEFAULT '1'",
		), 'setting_id');
	$date_format = $wpdb->get_row("SELECT date_format FROM {$wpdb->prefix}estatik_settings 
						WHERE `setting_id`='1'");
	if ( empty($date_format->date_format) ) {
		$wpdb->query("UPDATE {$wpdb->prefix}estatik_settings SET `date_format`='d/m/y' 
			WHERE `setting_id`='1'");
	}

    create_or_update('estatik_agents', array(
		'agent_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'agent_name' => 'varchar(255) NOT NULL',
		'agent_user_name' => 'varchar(255) NOT NULL',
		'agent_email' => 'varchar(255) NOT NULL',
		'agent_company' => 'varchar(255) NOT NULL',
		'agent_prop_quantity' => 'int(11) NOT NULL',
		'agent_sold_prop' => 'int(11) NOT NULL',
		'agent_tel' => 'char(20) NOT NULL',
		'agent_web' => 'varchar(255) NOT NULL',
		'agent_rating' => 'varchar(255) NOT NULL',
		'agent_about' => 'TEXT NOT NULL',
		'agent_pic' => 'varchar(255) NOT NULL',
		'agent_meta' => 'varchar(255) NOT NULL',
		'agent_status' => 'int(11) NOT NULL',
    	), 'agent_id');
    $wpdb->query("ALTER TABLE {$wpdb->prefix}estatik_agents 
    	CHANGE `agent_tel` `agent_tel` char(20) NOT NULL");
    $wpdb->query("ALTER TABLE {$wpdb->prefix}estatik_agents 
    	CHANGE `agent_about` `agent_about` TEXT NOT NULL");
	
    create_or_update('estatik_properties', array(
		'prop_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'agent_id' => 'int(11) NOT NULL',
		'prop_number' => 'int(11) NOT NULL',
		'prop_pub_unpub' => 'int(11) NOT NULL',
		'prop_date_added' => 'int(11) NOT NULL',
		'prop_title' => 'varchar(255) NOT NULL',
		'prop_type' => 'varchar(255) NOT NULL',
		'prop_category' => 'varchar(255) NOT NULL',
		'prop_status' => 'int(11) NOT NULL',
		'prop_featured' => 'varchar(255) NOT NULL',
		'prop_hot' => 'int(1) NOT NULL',
		'prop_open_house' => 'int(1) NOT NULL',
		'prop_foreclosure' => 'int(1) NOT NULL',
		'prop_price' => 'DECIMAL( 10, 2 ) NOT NULL ',
		'prop_period' => 'varchar(255) NOT NULL',
		'prop_bedrooms' => 'int(11) NOT NULL',
		'prop_bathrooms' => 'DECIMAL(4,1) NOT NULL',
		'prop_floors' => 'int(11) NOT NULL',
		'prop_area' => 'int(11) NOT NULL',
		'prop_lotsize' => 'int(11) NOT NULL',
		'prop_builtin' => 'varchar(255) NOT NULL',
		'prop_description' => 'text NOT NULL',
		'country_id' => 'int(11) NOT NULL',
		'state_id' => 'int(11) NOT NULL',
		'city_id' => 'int(11) NOT NULL',
		'prop_zip_postcode' => 'int(11) NOT NULL',
		'prop_street' => 'varchar(255) NOT NULL',
		'prop_address' => 'varchar(255) NOT NULL',
		'prop_longitude' => 'varchar(255) NOT NULL',
		'prop_latitude' => 'varchar(255) NOT NULL',
		'prop_meta_keywords' => 'varchar(255) NOT NULL',
		'prop_meta_description' => 'varchar(255) NOT NULL',
		), 'prop_id');
    $wpdb->query("ALTER TABLE {$wpdb->prefix}estatik_properties 
    	CHANGE `prop_bathrooms` `prop_bathrooms` DECIMAL(4,1) NOT NULL");
	
    create_or_update('estatik_properties_meta', array(
		'prop_meta_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'prop_id' => 'int(11) NOT NULL',
		'prop_meta_key' => 'varchar(255) NOT NULL',
		'prop_meta_value' => 'TEXT NOT NULL',
    	), 'prop_meta_id');

    create_or_update('estatik_properties_neighboarhood', array(
		'prop_neigh_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'neigh_id' => 'int(11) NOT NULL',
		'neigh_distance' => 'varchar(255) NOT NULL',
		'prop_id' => 'int(11) NOT NULL',
    	), 'prop_neigh_id');

    create_or_update('estatik_properties_features', array(
		'prop_feature_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'feature_id' => 'int(11) NOT NULL',
		'prop_id' => 'int(11) NOT NULL',
    	), 'prop_feature_id');

    create_or_update('estatik_properties_appliances', array(
		'prop_app_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'appliance_id' => 'int(11) NOT NULL',
		'prop_id' => 'int(11) NOT NULL',
    	), 'prop_app_id');

    create_or_update('estatik_manager_appliances', array(
		'appliance_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'appliance_title' => 'varchar(255) NOT NULL',
    	), 'appliance_id');
	
    create_or_update('estatik_manager_categories', array(
		'cat_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'cat_title' => 'varchar(255) NOT NULL',
    	), 'cat_id');

    create_or_update('estatik_manager_cities', array(
		'city_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'city_title' => 'varchar(255) NOT NULL',
		'state_id' => 'int(11) NOT NULL',
    	), 'city_id');

    create_or_update('estatik_manager_countries', array(
		'country_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'country_title' => 'varchar(255) NOT NULL',
    	), 'country_id');

    create_or_update('estatik_manager_currency', array(
		'currency_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'currency_title' => 'varchar(255) NOT NULL',
		'currency_status' => 'int(11) NOT NULL',
    	), 'currency_id');

    create_or_update('estatik_manager_dimension', array(
		'dimension_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'dimension_title' => 'varchar(255) NOT NULL',
		'dimension_status' => 'int(11) NOT NULL',
    	), 'dimension_id');

    create_or_update('estatik_manager_features', array(
		'feature_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'feature_title' => 'varchar(255) NOT NULL',
    	), 'feature_id');

    create_or_update('estatik_manager_neighboarhood', array(
		'neigh_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'neigh_title' => 'varchar(255) NOT NULL',
    	), 'neigh_id');

    create_or_update('estatik_manager_rent_period', array(
		'period_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'period_title' => 'varchar(255) NOT NULL',
    	), 'period_id');

    create_or_update('estatik_manager_states', array(
		'state_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'state_title' => 'varchar(255) NOT NULL',
		'country_id' => 'int(11) NOT NULL',
    	), 'state_id');

    create_or_update('estatik_manager_status', array(
		'status_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'status_title' => 'varchar(255) NOT NULL',
    	), 'status_id');

    create_or_update('estatik_manager_types', array(
		'type_id' => 'int(11) NOT NULL AUTO_INCREMENT',
		'type_title' => 'varchar(255) NOT NULL',
    	), 'type_id');	
 
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