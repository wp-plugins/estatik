<?php
	global $wpdb;
	$es_currency_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_currency' );		
	if(!empty($es_currency_listing)) {
?>            

	<?php foreach($es_currency_listing as $list) {	
	
		/*$checked = ($list->currency_status==1) ? 'checked="checked"' : "";
		$active = ($list->currency_status==1) ? 'active' : "";*/
		
	?>
		<li id="currency_<?php echo $list->currency_id?>" class="<?php echo $active?>">
			<label><?php echo $list->currency_title?></label>
			<small onclick="es_currency_delete(this)"></small>
			<span class="es_field_loader es_currency_loader"></span>
			<input type="hidden" value="<?php echo $list->currency_id?>" name="es_currency_id" class="es_currency_id" />
		</li>
		
	<?php } ?>

  
<?php } else { ?>
	
	<p><?php _e( "No record found. Please add new one.", "es-plugin" ); ?></p>
	
<?php } ?>