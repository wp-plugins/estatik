<?php
 
global $wpdb;
if(isset($_POST['es_state_id'])) {

	$es_state_id = sanitize_text_field($_POST['es_state_id']);		

}else if(@$prop_edit->state_id!="") { 
	$es_state_id = $prop_edit->state_id;		
}  
 
$sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_cities WHERE state_id = '.$es_state_id;
 
$es_cities_listing = $wpdb->get_results($sql); 	
$i = 0;
if(!empty($es_cities_listing)) {
	echo '<option value="">Choose City</option>';
	foreach($es_cities_listing as $list) {
		$selected = (@$prop_edit->city_id==$list->city_id) ? 'selected="selected"' : "";
		echo '<option '.$selected.' value="'.$list->city_id.'">'.$list->city_title.'</option>';	
	}
}else{
	echo '<option value="">No City</option>';
}
	 
	 

 