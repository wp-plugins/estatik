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
 	get_list('WHERE prop_pub_unpub=1', 'ORDER BY prop_id DESC');
	// include('includes/es_latest_props.php');
	return ob_get_clean();
}
add_shortcode( 'es_latest_props', 'es_latest_props' );


function es_featured_props() {	
	ob_start();
	get_list('WHERE prop_pub_unpub=1 AND prop_featured=1', 'ORDER BY prop_id DESC');
	// include('includes/es_featured_props.php');
	return ob_get_clean();		 
}
add_shortcode( 'es_featured_props', 'es_featured_props' );


function es_cheapest_props() {	
	ob_start();
	get_list('WHERE prop_pub_unpub = 1', 'ORDER BY prop_price ASC');
	// include('includes/es_cheapest_props.php');	
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
	global $wpdb;

    ob_start();
	if ( !empty($atts['category']) ) {
	    $category_title = strtolower($atts['category']);

	    $sql = $wpdb->prepare(
	    	"SELECT `cat_id` FROM {$wpdb->prefix}estatik_manager_categories WHERE `cat_title`='%s'", 
	    	$category_title);
	    $category_id = $wpdb->get_row($sql);

		$where = "WHERE `prop_category` LIKE '%{$category_id->cat_id}%' AND `prop_pub_unpub`=1";
		// $properties = $wpdb->get_results("SELECT prop_id, prop_category 
		// 	FROM {$wpdb->prefix}estatik_properties WHERE `prop_category` 
		// 	LIKE '%$category_id%' AND `prop_pub_unpub`=1");

		// if ($properties) {
		// 	foreach ($properties as $prop) {
		// 		if ($prop_cat = unserialize($prop->prop_category)) {
		// 			if (in_array($category_id, $prop_cat)) {
		// 				$ids[] = $prop->prop_id;
		// 			}
		// 		}
		// 	}
		// 	if ($ids) {
		// 		$where = "WHERE `prop_id` IN (".implode(',', $ids).") AND `prop_pub_unpub`=1";
		// 	}
		// }

	} else if (!empty($atts['type'])){
	    $type = strtolower($atts['type']);

	    $sql = $wpdb->prepare(
	    	"SELECT `type_id` FROM {$wpdb->prefix}estatik_manager_types WHERE `type_title`='%s'", 
	    	$type);
	    $type_id = $wpdb->get_row($sql);

		$where = "WHERE `prop_type`='{$type_id->type_id}' AND `prop_pub_unpub`=1";
	} else if (!empty($atts['status'])){
		$category_title = strtolower($atts['status']);

		$sql = $wpdb->prepare(
			"SELECT `status_id` FROM {$wpdb->prefix}estatik_manager_status WHERE `status_title`='%s'",
			$category_title);
		$category_id = $wpdb->get_row($sql)->status_id;

		$where = "WHERE `prop_status` LIKE '%$category_id%' AND `prop_pub_unpub`=1";
	} else if (!empty($atts['type'])){
		$category_title = strtolower($atts['type']);

		$sql = $wpdb->prepare(
			"SELECT `type_id` FROM {$wpdb->prefix}estatik_manager_type WHERE `type_title`='%s'",
			$category_title);
		$category_id = $wpdb->get_row($sql)->type_id;

		$where = "WHERE `prop_type` LIKE '%$category_id%' AND `prop_pub_unpub`=1";
	}

	get_list($where, 'ORDER BY prop_id DESC');
    // include('includes/es_category.php');
    return ob_get_clean();
}
add_shortcode('es_category', 'es_new_category_shortcode');

function es_my_listing_trendy( $atts ) {
	global $wpdb;

	ob_start();

	$where = isset($atts['where']) ? $atts['where'] : '';
	$order = isset($atts['order']) ? $atts['order'] : '';
	$layout = isset($atts['layout']) ? $atts['layout'] : '';

	get_list_trendy($where, $order, $layout);
	return ob_get_clean();
}
add_shortcode( 'es_my_listing_trendy', 'es_my_listing_trendy' );