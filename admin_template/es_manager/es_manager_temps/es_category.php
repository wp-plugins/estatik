<?php
	global $wpdb;
	$es_category_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_categories' );		
	if(!empty($es_category_listing)) {
?>            

	<?php foreach($es_category_listing as $list) {	
	?>
		<li id="cat_<?php echo $list->cat_id?>">
			<label><?php echo $list->cat_title?></label>
			<small onclick="es_category_delete(this)"></small>
			<span class="es_field_loader es_category_loader" ></span>
			<input type="hidden" value="<?php echo $list->cat_id?>" name="es_cat_id" class="es_cat_id" />
		</li>
		
	<?php } ?>
  
<?php } else { ?>
	
	<p><?php _e( "No record found. Please add new one.", "es-plugin" ); ?></p>
	
<?php } ?>