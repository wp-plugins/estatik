<?php
	global $wpdb;
	
	 $selected_appliance = array();
	 
	 if(isset($_POST['prop_appliance']) && $_POST['prop_appliance']==1){
		$prop_appliance=1;		 
	 }
	 
	 if(isset($_POST['prop_id']) && $_POST['prop_id']!=""){
		$prop_id = $_POST['prop_id'];
		$prop_appliance=1;		 
	 }
	 
	 if(isset($prop_id)){
 
		 $es_appliance_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_properties_appliances WHERE prop_id="'.$prop_id.'"' );	
		 foreach($es_appliance_listing as $list) {	
			$selected_appliance[] = $list->appliance_id;
		 }
		 //print_r($selected_appliance); 
		 //exit;
	 }
	
	
	$es_appliance_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_appliances' );	
		
	if(!empty($es_appliance_listing)) {
		 	
?>            
 
	<?php foreach($es_appliance_listing as $list) {	
	?>
		<li id="appliance_<?php echo $list->appliance_id?>" class="<?php if(in_array($list->appliance_id,$selected_appliance)) { echo 'active'; } ?>">
			<label>
            <?php if(isset($prop_appliance)==1) { ?>
            	<input type="checkbox" name="es_prop_appliance[]" <?php if(in_array($list->appliance_id,$selected_appliance)) { echo 'checked="checked"'; } ?> value="<?php echo $list->appliance_id?>" />
            <?php } ?>
			<?php echo $list->appliance_title?></label>
			<small onclick="es_appliance_delete(this)"></small>
			<span class="es_field_loader es_appliance_loader"></span>
			<input type="hidden" value="<?php echo $list->appliance_id?>" name="es_appliance_id" class="es_appliance_id" />
		</li>
		
	<?php } ?>
 
  
<?php } else { ?>
	
	<p><?php _e( "No record found. Please add new one.", "es-plugin" ); ?></p>
	
<?php } ?>