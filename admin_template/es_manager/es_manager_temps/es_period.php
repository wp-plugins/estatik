<?php
	global $wpdb;
	$es_period_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_rent_period' );		
	if(!empty($es_period_listing)) {
?>            
	<?php foreach($es_period_listing as $list) {	
	?>
		<li id="period_<?php echo $list->period_id?>">
			<label><?php echo $list->period_title?></label>
			<small onclick="es_period_delete(this)"></small>
			<span class="es_field_loader es_period_loader"></span>
			<input type="hidden" value="<?php echo $list->period_id?>" name="es_period_id" class="es_period_id" />
		</li>
		
	<?php } ?>
  
<?php } else { ?>
	
	<p><?php _e( "No record found. Please add new one.", "es-plugin" ); ?></p>
	
<?php } ?>