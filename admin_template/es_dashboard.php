<div class="es_wrapper"> 
	
    <div class="es_header clearFix">
        <h2><?php _e('Dashboard', 'es-plugin'); ?></h2>
        <h3><img src="<?php echo DIR_URL.'admin_template/';?>images/estatik_simple.png" alt="#" /><small>Ver. <?php echo es_plugin_version(); ?></small></h3>
    </div>

    <div class="es_content_in">
 		
        <div class="es_dashboard_menu clearFix">
        	<ul>
            	<li><a href="<?php echo admin_url()?>admin.php?page=es_my_listings"><span></span><?php _e( "My listings", "es-plugin" ); ?></a></li>
                <li><a href="<?php echo admin_url()?>admin.php?page=es_add_new_property"><span></span><?php _e( "Add New", "es-plugin" ); ?></a></li>
                <li><a href="<?php echo admin_url()?>admin.php?page=es_data_manager"><span></span><?php _e( "Data Manager", "es-plugin" ); ?></a></li>
                <li><a href="<?php echo admin_url()?>admin.php?page=es_settings"><span></span><?php _e( "Settings", "es-plugin" ); ?></a></li>
            </ul>
        </div>
        
        <h2 class="es_dashboard_heading"><?php _e( "Get Support", "es-plugin" ); ?></h2>
        
        <div class="es_dashboard_get_support clearFix">
        	<ul>
            	<li><a href="http://estatik.net/estatik-plugin-documentation/"><span></span><?php _e( "Step-by-step guide", "es-plugin" ); ?></a></li>
                <li><a href="http://estatik.net/video-tutorials/"><span></span><?php _e( "Video Tutorial", "es-plugin" ); ?></a></li>
                <li><a href="http://estatik.net/contact-us/"><span></span><?php _e( "Submit a Ticket", "es-plugin" ); ?></a></li>
            </ul>
        </div>
        
        <h2 class="es_dashboard_heading"><?php _e( "Choose Your Theme", "es-plugin" ); ?></h2>
        
        <div id="es_choose_themes">
            <div id="es_themes_slides">
            	<ul class="slides">
                	<li><a href="http://estatik.net/product/theme-native/"><span><img src="<?php echo DIR_URL?>admin_template/images/es_theme_img1.png" alt="#" /></span></a></li>
                </ul>
            </div>
        </div>
        
    </div>

</div>