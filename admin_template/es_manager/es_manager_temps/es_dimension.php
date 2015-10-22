<?php
	global $wpdb;
	$es_dimension_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_dimension' );		
	if(!empty($es_dimension_listing)) {
?>            
 
	<?php foreach($es_dimension_listing as $list) {	
		$checked = ($list->dimension_status==1) ? 'checked="checked"' : "";
		$active = ($list->dimension_status==1) ? 'active' : "";
	?>
		<li id="dimension_<?php echo $list->dimension_id?>" class="<?php echo $active?>">
			<label>
			<input <?php echo $checked?> type="radio" name="dimension_status" onclick="es_dimension_status(this)" />
			<?php echo $list->dimension_title?></label>
			<small onclick="es_dimension_delete(this)"></small>
			<span class="es_field_loader es_dimension_loader"></span>
			<input type="hidden" value="<?php echo $list->dimension_id?>" name="es_dimension_id" class="es_dimension_id" />
		</li>
		
	<?php } ?>
 

<?php } else { ?>

	<p><?php _e( "No record found. Please add new one.", "es-plugin" ); ?></p>

<?php } ?>
                    
                     