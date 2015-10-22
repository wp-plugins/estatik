<?php
	global $wpdb;
	$es_country_id = "";
	$es_country_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_countries' );		
	if(!empty($es_country_listing)) {
?>            
<ul>
	<?php 
	$i = 0;
	foreach($es_country_listing as $list) {
		if($i == 0){
			$es_country_id = $list->country_id;
		}
		$i++;
	?>
		<li>
			<label>
			<input type="radio" name="es_country_states" onclick="es_country_states(this)" />
			<?php echo $list->country_title?></label>
			<small onclick="es_country_delete(this)"></small>
			<span class="es_field_loader" id="es_country_loader"></span>
			<input type="hidden" value="<?php echo $list->country_id?>" name="es_country_id" id="es_country_id" />
		</li>
		
	<?php } ?>
</ul> 
  
<?php } else { ?>
	
	<p><?php _e( "No record found. Please add new one.", "es-plugin" ); ?></p>
	
<?php } ?>