<?php
	global $wpdb;
  	
	if(isset($_POST['es_country_id'])) {
		$es_country_id = sanitize_text_field($_POST['es_country_id']);		
		$where = " WHERE country_id = '".$es_country_id."'";
	}else{
		$where = "";	
	} 
	
	$sql = 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_states'.$where;
	 
	$es_state_listing = $wpdb->get_results($sql);
 
	if(!empty($es_state_listing)) {
?>            
<ul>
	<?php $i = 0;
		foreach($es_state_listing as $list) {
		if($i == 0){
			
			$es_state_id = $list->state_id;
		}
		$i++;	
	
	?>
		<li>
			<label>
			<input type="radio" name="es_state_city" onclick="es_state_city(this)" />
			<?php echo $list->state_title?></label>
			<small onclick="es_state_delete(this)"></small>
			<span class="es_field_loader" id="es_state_loader"></span>
			<input type="hidden" value="<?php echo $list->state_id?>" name="es_state_id" id="es_state_id" />
		</li>
		
	<?php } ?>
</ul> 
  
<?php } else { 
	
	$es_state_id = 0;

?>
	
	<p class="es_no_record">No record found. Please add new one.</p>
	
<?php } ?>

<input type="hidden" value="<?php echo $es_country_id?>" id="es_ajax_country_id" />