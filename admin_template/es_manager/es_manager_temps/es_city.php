<?php
	global $wpdb;
  	
	if(isset($_POST['es_state_id'])) {
	
		$es_state_id = sanitize_text_field($_POST['es_state_id']);		
 	
	} 
	
	$sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_cities WHERE state_id = '.$es_state_id;
	 
	$es_city_listing = $wpdb->get_results($sql);
 
	if(!empty($es_city_listing)) {
?>            
<ul>
	<?php foreach($es_city_listing as $list) {	
	
	?>
		<li>
			<label><?php echo $list->city_title?></label>
			<small onclick="es_city_delete(this)"></small>
			<span class="es_field_loader" id="es_city_loader"></span>
			<input type="hidden" value="<?php echo $list->city_id?>" name="es_city_id" id="es_city_id" />
		</li>
		
	<?php } ?>
</ul> 
  
<?php } else { ?>
	
	<p><?php _e( "No record found. Please add new one.", "es-plugin" ); ?></p>
	
<?php } ?>

<input type="hidden" value="<?php echo $es_state_id?>" id="es_ajax_state_id" />
