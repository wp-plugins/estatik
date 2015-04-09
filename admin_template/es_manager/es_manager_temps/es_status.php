<?php
	global $wpdb;
	$es_status_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_status' );		
	if(!empty($es_status_listing)) {
?>            
    
        <?php foreach($es_status_listing as $list) {	
        ?>
            <li id="status_<?php echo $list->status_id?>">
                <label><?php echo $list->status_title?></label>
                <small onclick="es_status_delete(this)"></small>
                <span class="es_field_loader es_status_loader"></span>
                <input type="hidden" value="<?php echo $list->status_id?>" name="es_status_id" class="es_status_id" />
            </li>
        <?php } ?>
 

<?php } else { ?>

<p><?php _e( "No record found. Please add new one.", "es-plugin" ); ?></p>

<?php } ?>