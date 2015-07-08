<?php
function es_my_listing( $atts ) {	 
	ob_start();
	include('includes/es_my_listing.php');
	return ob_get_clean();
}
add_shortcode( 'es_my_listing', 'es_my_listing' );

function es_agent_property_listing() {
	ob_start();
	$author_page = 1;
	include('includes/es_my_listing.php');
	return ob_get_clean();	
}
add_shortcode( 'es_agent_property_listing', 'es_agent_property_listing' );

function es_category_property_listing() {	
	ob_start();
	$category_page = 1;
	include('includes/es_my_listing.php');	
	return ob_get_clean();
}
add_shortcode( 'es_category_property_listing', 'es_category_property_listing' );

function es_search() {
	ob_start();
	$search_page = 1;
	include('includes/es_my_listing.php');
	return ob_get_clean();	
}
add_shortcode( 'es_search', 'es_search' );
 
function es_latest_props() {
 	ob_start();
	include('includes/es_latest_props.php');
	return ob_get_clean();
}
add_shortcode( 'es_latest_props', 'es_latest_props' );


function es_featured_props() {	
	ob_start();
	include('includes/es_featured_props.php');
	return ob_get_clean();		 
}
add_shortcode( 'es_featured_props', 'es_featured_props' );


function es_cheapest_props() {	
	ob_start();
	include('includes/es_cheapest_props.php');	
	return ob_get_clean();	 
}
add_shortcode( 'es_cheapest_props', 'es_cheapest_props' );
 
function es_single_property() {	
	ob_start(); 
	include('includes/es_prop_single.php');		 
	return ob_get_clean();
}
add_shortcode( 'es_single_property', 'es_single_property' );
 
 function es_new_category_shortcode($atts){
    ob_start();
    include('includes/es_category.php');
    return ob_get_clean();
}

add_shortcode('es_category', 'es_new_category_shortcode');