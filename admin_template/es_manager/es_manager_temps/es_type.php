<?php
	global $wpdb;
	$es_type_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_types' );		
	if(!empty($es_type_listing)) {
?>            
	<?php foreach($es_type_listing as $list) {	
	?>
		<li id="type_<?php echo $list->type_id?>">
			<label><?php echo $list->type_title?></label>
			<small onclick="es_type_delete(this)"></small>
			<span class="es_field_loader es_type_loader"></span>
			<input type="hidden" value="<?php echo $list->type_id?>" name="es_type_id" class="es_type_id" />
		</li>
		
	<?php } ?>

<?php } else { ?>

	<p><?php _e( "No record found. Please add new one.", "es-plugin" ); ?></p>

<?php } ?>