<?php

// function for manager status Insertion

function es_status_insertion(){

	$es_status_title = sanitize_text_field($_POST['es_status_title']);
	global $wpdb;

	$status_obj  = wp_insert_term( $es_status_title, 'property_status', array() );
 
	if (!is_wp_error($status_obj)) {
		$wpdb->insert(
			$wpdb->prefix.'estatik_manager_status',
			array(
				'status_id' => $status_obj['term_id'],
				'status_title' => $es_status_title
			)
		);
		$id = $status_obj['term_id'];
	}
 
	
	include("es_manager_temps/es_status_insert.php"); 

die();

}
add_action('wp_ajax_es_status_insertion', 'es_status_insertion'); 
add_action('wp_ajax_nopriv_es_status_insertion', 'es_status_insertion'); 


// function for manager status delete

function es_status_delete(){
 
	$es_status_id = sanitize_text_field($_POST['es_status_id']);
	
	global $wpdb;
 	wp_delete_term( $es_status_id, 'property_status', array() );
	$wpdb->delete( $wpdb->prefix.'estatik_manager_status', array( 'status_id' => $es_status_id ) );
	
	echo $es_status_id;   
	 
die();

}

add_action('wp_ajax_es_status_delete', 'es_status_delete'); 
add_action('wp_ajax_nopriv_es_status_delete', 'es_status_delete'); 


// function for manager Category Insertion

function es_category_insertion(){

	$es_cat_title = sanitize_text_field($_POST['es_cat_title']);
	global $wpdb;
	
	$cat_obj  = wp_insert_term( $es_cat_title, 'property_category', array() );
 
	if (!is_wp_error($cat_obj)) {
		$wpdb->insert(
			$wpdb->prefix.'estatik_manager_categories',
			array(
				'cat_id' => $cat_obj['term_id'],
				'cat_title' => $es_cat_title
			)
		);
		$id = $cat_obj['term_id'];
	}
 	
	include("es_manager_temps/es_category_insert.php");  

die();

}
add_action('wp_ajax_es_category_insertion', 'es_category_insertion'); 
add_action('wp_ajax_nopriv_es_category_insertion', 'es_category_insertion'); 


// function for manager category delete

function es_category_delete(){
 
	$es_cat_id = sanitize_text_field($_POST['es_cat_id']);
	
	global $wpdb;
	wp_delete_term( $es_cat_id, 'property_category', array() );
	$wpdb->delete( $wpdb->prefix.'estatik_manager_categories', array( 'cat_id' => $es_cat_id ) );
	
	echo $es_cat_id;

die();

}

add_action('wp_ajax_es_category_delete', 'es_category_delete'); 
add_action('wp_ajax_nopriv_es_category_delete', 'es_category_delete'); 

 
// function for manager type Insertion

function es_type_insertion(){

	$es_type_title = sanitize_text_field($_POST['es_type_title']);
	global $wpdb;
 
	$type_obj  = wp_insert_term( $es_type_title, 'property_type', array() );
 
	if (!is_wp_error($type_obj)) {
		$wpdb->insert(
			$wpdb->prefix.'estatik_manager_types',
			array(
				'type_id' => $type_obj['term_id'],
				'type_title' => $es_type_title
			)
		);
		$id = $type_obj['term_id'];
	}
	
	include("es_manager_temps/es_type_insert.php");  

die();

}
add_action('wp_ajax_es_type_insertion', 'es_type_insertion'); 
add_action('wp_ajax_nopriv_es_type_insertion', 'es_type_insertion'); 


// function for manager type delete

function es_type_delete(){
 
	$es_type_id = sanitize_text_field($_POST['es_type_id']);
	
	global $wpdb;
	wp_delete_term( $es_type_id, 'property_type', array() );
	$wpdb->delete( $wpdb->prefix.'estatik_manager_types', array( 'type_id' => $es_type_id ) );
	
	echo $es_type_id;
	 
die();

}

add_action('wp_ajax_es_type_delete', 'es_type_delete'); 
add_action('wp_ajax_nopriv_es_type_delete', 'es_type_delete');


// function for manager Rent Period Insertion

function es_period_insertion(){

	$es_period_title = sanitize_text_field($_POST['es_period_title']);
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'estatik_manager_rent_period',
		array(
			'period_title' => $es_period_title
		)
	);
	
	$id = $wpdb->insert_id;
 	
	include("es_manager_temps/es_period_insert.php");

die();

}
add_action('wp_ajax_es_period_insertion', 'es_period_insertion'); 
add_action('wp_ajax_nopriv_es_period_insertion', 'es_period_insertion'); 


// function for manager Rent period delete

function es_period_delete(){
 
	$es_period_id = sanitize_text_field($_POST['es_period_id']);
	
	global $wpdb;
	
	$wpdb->delete( $wpdb->prefix.'estatik_manager_rent_period', array( 'period_id' => $es_period_id ) );
	
	echo $es_period_id;
	 
die();

}

add_action('wp_ajax_es_period_delete', 'es_period_delete'); 
add_action('wp_ajax_nopriv_es_period_delete', 'es_period_delete'); 


// function for manager Country Insertion

function es_country_insertion(){

	$es_country_title = sanitize_text_field($_POST['es_country_title']);
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'estatik_manager_countries',
		array(
			'country_title' => $es_country_title
		)
	);
 	
	include("es_manager_temps/es_country.php");

die();

}
add_action('wp_ajax_es_country_insertion', 'es_country_insertion'); 
add_action('wp_ajax_nopriv_es_country_insertion', 'es_country_insertion'); 


// function for manager Country delete

function es_country_delete(){
 
	$es_country_id = sanitize_text_field($_POST['es_country_id']);
	
	global $wpdb;
 
	$sql = 'DELETE FROM '.$wpdb->prefix.'estatik_manager_cities WHERE state_id IN 
	
	(SELECT state_id FROM '.$wpdb->prefix.'estatik_manager_states WHERE country_id = '.$es_country_id.')';
	
	$wpdb->query($sql);
	
	$wpdb->delete( $wpdb->prefix.'estatik_manager_states', array( 'country_id' => $es_country_id ) );
	
	$wpdb->delete( $wpdb->prefix.'estatik_manager_countries', array( 'country_id' => $es_country_id ) );
 
	include("es_manager_temps/es_country.php"); 
	 
die();

}

add_action('wp_ajax_es_country_delete', 'es_country_delete'); 
add_action('wp_ajax_nopriv_es_country_delete', 'es_country_delete'); 


// function for manager Country States

function es_country_states(){
 
	include("es_manager_temps/es_state.php"); 
  
die();

}

add_action('wp_ajax_es_country_states', 'es_country_states'); 
add_action('wp_ajax_nopriv_es_country_states', 'es_country_states'); 


// function for manager State Insertion

function es_state_insertion(){

	$es_state_title = sanitize_text_field($_POST['es_state_title']);
	$es_country_id = sanitize_text_field($_POST['es_country_id']);
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'estatik_manager_states',
		array(
			'state_title' => $es_state_title,
			'country_id' => $es_country_id
		)
	);
 	
	include("es_manager_temps/es_state.php");

die();

}
add_action('wp_ajax_es_state_insertion', 'es_state_insertion'); 
add_action('wp_ajax_nopriv_es_state_insertion', 'es_state_insertion'); 


// function for manager Country delete

function es_state_delete(){
 
	$es_state_id = sanitize_text_field($_POST['es_state_id']);
	
	$es_country_id = sanitize_text_field($_POST['es_country_id']);
	
	global $wpdb;
	
	$wpdb->delete( $wpdb->prefix.'estatik_manager_states', array( 'state_id' => $es_state_id ) );
	
	$wpdb->delete( $wpdb->prefix.'estatik_manager_cities', array( 'state_id' => $es_state_id ) );
	
	include("es_manager_temps/es_state.php"); 
	 
die();

}

add_action('wp_ajax_es_state_delete', 'es_state_delete'); 
add_action('wp_ajax_nopriv_es_state_delete', 'es_state_delete'); 


// function for manager City States

function es_state_city(){
 
	include("es_manager_temps/es_city.php"); 
	 
die();

}

add_action('wp_ajax_es_state_city', 'es_state_city'); 
add_action('wp_ajax_nopriv_es_state_city', 'es_state_city'); 


// function for manager City Insertion

function es_city_insertion(){

	$es_city_title = sanitize_text_field($_POST['es_city_title']);
	$es_state_id = sanitize_text_field($_POST['es_state_id']);
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'estatik_manager_cities',
		array(
			'city_title' => $es_city_title,
			'state_id' => $es_state_id
		)
	);
 	
	include("es_manager_temps/es_city.php");

die();

}
add_action('wp_ajax_es_city_insertion', 'es_city_insertion'); 
add_action('wp_ajax_nopriv_es_city_insertion', 'es_city_insertion'); 


// function for manager Country delete

function es_city_delete(){
 
	$es_city_id = sanitize_text_field($_POST['es_city_id']);
	
	$es_state_id = sanitize_text_field($_POST['es_state_id']);
	
	global $wpdb;
	
	$wpdb->delete( $wpdb->prefix.'estatik_manager_cities', array( 'city_id' => $es_city_id ) );
	
	include("es_manager_temps/es_city.php"); 
	 
die();

}

add_action('wp_ajax_es_city_delete', 'es_city_delete'); 
add_action('wp_ajax_nopriv_es_city_delete', 'es_city_delete'); 



// function for manager neigh Insertion

function es_neigh_insertion(){

	$es_neigh_title = sanitize_text_field($_POST['es_neigh_title']);
	$prop_neigh 	= sanitize_text_field($_POST['prop_neigh']);
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'estatik_manager_neighboarhood',
		array(
			'neigh_title' => $es_neigh_title
		)
	);
 	$id = $wpdb->insert_id;
    
	include("es_manager_temps/es_neigh_insert.php"); 
 
die();

}
add_action('wp_ajax_es_neigh_insertion', 'es_neigh_insertion'); 
add_action('wp_ajax_nopriv_es_neigh_insertion', 'es_neigh_insertion'); 


// function for manager Neigh delete

function es_neigh_delete(){
 
	$es_neigh_id = sanitize_text_field($_POST['es_neigh_id']);
 
 	global $wpdb;
	$wpdb->delete( $wpdb->prefix.'estatik_manager_neighboarhood', array( 'neigh_id' => $es_neigh_id ) );
	
	echo $es_neigh_id;
	
die();

}

add_action('wp_ajax_es_neigh_delete', 'es_neigh_delete'); 
add_action('wp_ajax_nopriv_es_neigh_delete', 'es_neigh_delete'); 


// function for manager dimension Insertion

function es_dimension_insertion(){

	$es_dimension_title = sanitize_text_field($_POST['es_dimension_title']);
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'estatik_manager_dimension',
		array(
			'dimension_title' => $es_dimension_title
		)
	);
	
	$id = $wpdb->insert_id;
 	
	include("es_manager_temps/es_dimension_insert.php");
	
	die();
}
add_action('wp_ajax_es_dimension_insertion', 'es_dimension_insertion'); 
add_action('wp_ajax_nopriv_es_dimension_insertion', 'es_dimension_insertion'); 


// function for manager dimension delete

function es_dimension_delete(){
 
	$es_dimension_id = sanitize_text_field($_POST['es_dimension_id']);
	global $wpdb;
	$wpdb->delete( $wpdb->prefix.'estatik_manager_dimension', array( 'dimension_id' => $es_dimension_id ) );
	
	echo $es_dimension_id;
	
	die();

}

add_action('wp_ajax_es_dimension_delete', 'es_dimension_delete'); 
add_action('wp_ajax_nopriv_es_dimension_delete', 'es_dimension_delete'); 


// function for manager dimension Status

function es_dimension_status(){
 
	$es_dimension_id = sanitize_text_field($_POST['es_dimension_id']);
	
	global $wpdb;
	$wpdb->query('update '.$wpdb->prefix.'estatik_manager_dimension set dimension_status = 0');
	$wpdb->update($wpdb->prefix.'estatik_manager_dimension', array( 'dimension_status' => 1), array( 'dimension_id' =>$es_dimension_id) );
	
	include("es_manager_temps/es_dimension.php");
	
	die();
}

add_action('wp_ajax_es_dimension_status', 'es_dimension_status'); 
add_action('wp_ajax_nopriv_es_dimension_status', 'es_dimension_status'); 



// function for manager feature Insertion

function es_feature_insertion(){

	$es_feature_title = sanitize_text_field($_POST['es_feature_title']);
	
	$prop_feature 	= (isset($_POST['prop_feature']))?sanitize_text_field($_POST['prop_feature']):"";
	
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'estatik_manager_features',
		array(
			'feature_title' => $es_feature_title
		)
	);
 	
	$feature_id = $wpdb->insert_id;
	
	include("es_manager_temps/es_feature_insert.php");
	
	die();
}
add_action('wp_ajax_es_feature_insertion', 'es_feature_insertion'); 
add_action('wp_ajax_nopriv_es_feature_insertion', 'es_feature_insertion'); 


// function for manager feature delete

function es_feature_delete(){
 
	$es_feature_id = sanitize_text_field($_POST['es_feature_id']);
	global $wpdb;
	$wpdb->delete( $wpdb->prefix.'estatik_manager_features', array( 'feature_id' => $es_feature_id ) );
	
	echo $es_feature_id; 
	
	die();

}

add_action('wp_ajax_es_feature_delete', 'es_feature_delete'); 
add_action('wp_ajax_nopriv_es_feature_delete', 'es_feature_delete'); 


// function for manager appliance Insertion

function es_appliance_insertion(){

	$es_appliance_title = sanitize_text_field($_POST['es_appliance_title']);
	
	$prop_appliance 	= (isset($_POST['prop_appliance']))?sanitize_text_field($_POST['prop_appliance']):"";
	
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'estatik_manager_appliances',
		array(
			'appliance_title' => $es_appliance_title
		)
	);
	$appliance_id = $wpdb->insert_id;
	
	include("es_manager_temps/es_appliance_insert.php");
	
	die();
}
add_action('wp_ajax_es_appliance_insertion', 'es_appliance_insertion'); 
add_action('wp_ajax_nopriv_es_appliance_insertion', 'es_appliance_insertion'); 


// function for manager appliance delete

function es_appliance_delete(){
 
	$es_appliance_id = sanitize_text_field($_POST['es_appliance_id']);
	global $wpdb;
	$wpdb->delete( $wpdb->prefix.'estatik_manager_appliances', array( 'appliance_id' => $es_appliance_id ) );
 	
	echo $es_appliance_id;
	
	die();

}

add_action('wp_ajax_es_appliance_delete', 'es_appliance_delete'); 
add_action('wp_ajax_nopriv_es_appliance_delete', 'es_appliance_delete'); 



// function for manager currency Insertion

function es_currency_insertion(){

	$es_currency_title = sanitize_text_field($_POST['es_currency_title']);
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'estatik_manager_currency',
		array(
			'currency_title' => $es_currency_title
		)
	);
 	
	$id = $wpdb->insert_id;
	
	include("es_manager_temps/es_currency_insert.php");
	
	die();
}
add_action('wp_ajax_es_currency_insertion', 'es_currency_insertion'); 
add_action('wp_ajax_nopriv_es_currency_insertion', 'es_currency_insertion'); 


// function for manager currency delete

function es_currency_delete(){
 
	$es_currency_id = sanitize_text_field($_POST['es_currency_id']);
	
	global $wpdb;
	$wpdb->delete( $wpdb->prefix.'estatik_manager_currency', array( 'currency_id' => $es_currency_id ) );
	
	echo $es_currency_id;
	
	die();

}

add_action('wp_ajax_es_currency_delete', 'es_currency_delete'); 
add_action('wp_ajax_nopriv_es_currency_delete', 'es_currency_delete'); 


// function for manager currency Status

function es_currency_status(){
 
	$es_currency_id = sanitize_text_field($_POST['es_currency_id']);
	
	global $wpdb;
	$wpdb->query('update '.$wpdb->prefix.'estatik_manager_currency set currency_status = 0');
	$wpdb->update($wpdb->prefix.'estatik_manager_currency', array( 'currency_status' => 1), array( 'currency_id' =>$es_currency_id) );
	
	include("es_manager_temps/es_currency.php");
	
	die();
}

add_action('wp_ajax_es_currency_status', 'es_currency_status'); 
add_action('wp_ajax_nopriv_es_currency_status', 'es_currency_status'); 


  