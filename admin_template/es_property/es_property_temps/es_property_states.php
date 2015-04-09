<?php
 
global $wpdb;


if(isset($_POST['es_country_id'])) {

	$es_country_id = sanitize_text_field($_POST['es_country_id']);		

} 

$sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_states WHERE country_id = '.$es_country_id;
 
$es_state_listing = $wpdb->get_results($sql); 	
$i = 0;

if(!empty($es_state_listing)) {
	echo '<option value="">Choose State</option>';
	foreach($es_state_listing as $list) {
		if($i == 0){
			$es_state_id = $list->state_id;
		}
		$i++;	
		$selected = (@$prop_edit->state_id==$list->state_id) ? 'selected="selected"' : "";
		echo '<option '.$selected.' value="'.$list->state_id.'">'.$list->state_title.'</option>';	
	}

}else{
	
	echo '<option value="">'.__( "No State", "es-plugin" ).'</option>';
		
}
	 
	 

 