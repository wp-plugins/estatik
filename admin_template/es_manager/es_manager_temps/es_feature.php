<?php
	global $wpdb;
	
	 $selected_feature = array();
	 
	 if(isset($_POST['prop_feature']) && $_POST['prop_feature']==1){
		$prop_feature=1;
	 }
	 
	 if(isset($_POST['prop_id']) && $_POST['prop_id']!=""){
		$prop_id = $_POST['prop_id'];
		$prop_feature=1;	 
	 }
	 
	 if(isset($prop_id)){
 
		 $es_feature_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_properties_features WHERE prop_id="'.$prop_id.'"' );	
		 foreach($es_feature_listing as $list) {	
			$selected_feature[] = $list->feature_id;
		 }
		 //print_r($selected_feature); 
	 
	 }
 
	
	$es_feature_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_features' );		
	if(!empty($es_feature_listing)) {
		
?>            
 
	<?php foreach($es_feature_listing as $list) {	
	?>
		<li id="feature_<?php echo $list->feature_id?>" class="<?php if(in_array($list->feature_id,$selected_feature)) { echo 'active'; } ?>">
			<label>
			<?php if(isset($prop_feature)==1) { ?>
            <input type="checkbox" name="es_prop_feature[]" <?php if(in_array($list->feature_id,$selected_feature)) { echo 'checked="checked"'; } ?> value="<?php echo $list->feature_id?>" />
            <?php } ?>
			<?php echo $list->feature_title?></label>
			<small onclick="es_feature_delete(this)"></small>
			<span class="es_field_loader es_feature_loader" ></span>
			<input type="hidden" value="<?php echo $list->feature_id?>" name="es_feature_id[]" class="es_feature_id" />
		</li>
		
	<?php } ?>
 
  
<?php } else { ?>
	
	<p><?php _e( "No record found. Please add new one.", "es-plugin" ); ?></p>
	
<?php } ?>