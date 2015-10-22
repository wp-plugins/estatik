<?php 
global $wpdb;
 
if(isset($_POST['es_pro_submit'])){
 
	$estatik_pro	= $_FILES['estatik_pro'];
 	
	$pluginPath = explode("plugins",PATH_DIR); 
	$pluginPath = $pluginPath[0]."plugins/";
 
	$es_extention = strtolower(end(explode(".",$estatik_pro['name'])));
	if($es_extention == "zip"){
		$file_name = "estatik.zip";
		$sourcePath = $estatik_pro['tmp_name']; 
		$targetPath = $pluginPath.$file_name;
		move_uploaded_file($sourcePath,$targetPath) ;
		$zip = new ZipArchive;
		$res = $zip->open($targetPath);
		$zip->extractTo($pluginPath);
		$zip->close();
		@unlink($targetPath);
	}
	
	wp_redirect('?page=es_dashboard',301); exit;
 
} ?>
<div class="es_wrapper"> 
 	
    <div class="es_header clearFix">
 		<h2><?php _e('Upload Downloaded Estatik Pro', 'es-plugin'); ?></h2>
        <h3><img src="<?php echo DIR_URL.'admin_template/';?>images/estatik_simple.png" alt="#" /><small>Ver. <?php echo es_plugin_version(); ?></small></h3>
    </div>
    
    <form method="post" action="" enctype="multipart/form-data">
        
        <div class="esHead clearFix">
            <p><a href="http://estatik.net/product/estatik-professional/" target="_blank">Estatik Pro</a> <?php _e('Full advanced version with extra portal management option, social sharing, additional widgets support, etc.', 'es-plugin'); ?> <br />
            <?php _e('Please upload your', 'es-plugin'); ?> <a href="http://estatik.net/product/estatik-professional/" target="_blank">Estatik Pro</a> <?php _e('version in zip format and click upload to finish for update to pro Version.', 'es-plugin'); ?></p>
            <input type="submit" value="<?php _e('Upload', 'es-plugin'); ?>" name="es_pro_submit" />
        </div>
        
        <div class="es_content_in addNewProp">
   
        
        <div class="es_tabs_contents clearFix">
 
            <div class="new_prop_csv clearFix">
                <span><?php _e('Upload Zip', 'es-plugin'); ?>:</span>
                <input type="file" name="estatik_pro" value="" />
            </div>
 
        </div>
 
    </div>
        
	</form>

</div>