<div class="es_wrapper"> 
 	
    <div class="es_alert_popup" id="sure_popup">
    	<div class="es_alert_popup_overlay"></div>
        <div class="es_alert_popup_in boxSizing">
        	<p><?php _e( "Are you sure you want to delete it?", "es-plugin" ); ?></p>
            <ul>
            	<li><a class="es_ok" href="javascript:void(0)"><?php _e( "Ok", "es-plugin" ); ?></a></li>
                <li><a class="es_cancel" href="javascript:void(0)"><?php _e( "Cancel", "es-plugin" ); ?></a></li>
            </ul>
            <a href="javascript:void(0)" class="es_close_popup"></a>
        </div>
    </div>
    
    <div class="es_header clearFix">
        <h2><?php _e( "Data Manager", "es-plugin" ); ?></h2>
        <h3><img src="<?php echo DIR_URL.'admin_template/';?>images/estatik_simple.png" alt="#" /><small>Ver. <?php echo es_plugin_version(); ?></small></h3>
    </div>

    <div class="es_content_in">
        
        <input type="hidden" value="<?php _e( "Please fill your field.", "es-plugin" ); ?>" id="pleasefillfield" />
        <input type="hidden" value="<?php _e( "field has been added.", "es-plugin" ); ?>" id="fieldAdded" />
        <input type="hidden" value="<?php _e( "field has been deleted.", "es-plugin" ); ?>" id="fieldDeleted" />
        
        <div class="es_tabs clearFix">
     		<ul>
            	<li><a href="#esm_propert_detail" ><?php _e( "Properties details", "es-plugin" ); ?></a></li>
                <li><a href="#esm_location"><?php _e( "Location", "es-plugin" ); ?></a></li>
                <li><a href="#esm_dimensions"><?php _e( "Dimensions", "es-plugin" ); ?></a></li>
                <li><a href="#esm_features"><?php _e( "Features", "es-plugin" ); ?></a></li>
                <li><a href="#esm_currency"><?php _e( "Currency", "es-plugin" ); ?></a></li>
            </ul>
        </div>
        <div class="es_tabs_contents clearFix">
            
            <div id="esm_propert_detail" class="es_tabs_content_in clearFix">
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "Status", "es-plugin" ); ?></h2>
                    <div id="es_status_listing"> 
						<ul>
                        <?php include("es_manager_temps/es_status.php"); ?>
						</ul>
                    </div> 
                    
                    <div class="es_message" id="es_status_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_status_title" id="es_status_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_status_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_status_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "Category", "es-plugin" ); ?></h2>
                    <div id="es_category_listing"> 
						<ul>
                        <?php include("es_manager_temps/es_category.php"); ?>
						 </ul>
                    </div> 
                    
                    <div class="es_message" id="es_category_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_cat_title" id="es_cat_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_category_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_category_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>
                
                <div class="clearFix hide-desktop show-ipad"></div>
                
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "Type", "es-plugin" ); ?></h2>
                    <div id="es_type_listing"> 
						<ul>
                        	<?php include("es_manager_temps/es_type.php"); ?>
						</ul> 
                    </div> 
                    
                    <div class="es_message" id="es_type_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_type_title" id="es_type_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_type_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_type_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "Rent period", "es-plugin" ); ?></h2>
                    <div id="es_period_listing"> 
						<ul>
                        <?php include("es_manager_temps/es_period.php");  ?>
						</ul>
                    </div> 
                    
                    <div class="es_message" id="es_period_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_period_title" id="es_period_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_period_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_period_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>
               
                
            </div>
            
            <div id="esm_location" class="es_tabs_content_in clearFix">
            	
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "Country", "es-plugin" ); ?></h2>
                    <div id="es_country_listing"> 
						
                        <?php include("es_manager_temps/es_country.php");  ?>
 
                    </div> 
                    
                    <div class="es_message" id="es_country_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_country_title" id="es_country_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_country_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_country_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "States/Regions", "es-plugin" ); ?></h2>
                    <div id="es_state_listing"> 
						
                        <?php include("es_manager_temps/es_state.php");  ?>
 
                    </div> 
                    
                    <div class="es_message" id="es_state_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_state_title" id="es_state_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_state_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_state_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "Cities", "es-plugin" ); ?></h2>
                    <div id="es_city_listing"> 
						
                        <?php include("es_manager_temps/es_city.php");  ?>
 
                    </div> 
                    
                    <div class="es_message" id="es_city_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_city_title" id="es_city_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_city_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_city_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>
 	
            </div>
            
            
            <div id="esm_dimensions" class="es_tabs_content_in clearFix">
            	
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "Area & lot size", "es-plugin" ); ?></h2>
                    <div id="es_dimension_listing"> 
						 <ul>
                         	<?php include("es_manager_temps/es_dimension.php"); ?>
                    	 </ul>
                    </div> 
                    
                    <div class="es_message" id="es_dimension_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_dimension_title" id="es_dimension_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_dimension_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_dimension_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>
                	
            </div>
            
            <div id="esm_features" class="es_tabs_content_in clearFix">
            	
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "Features", "es-plugin" ); ?></h2>
                    <div id="es_feature_listing"> 
						 <ul>
                         <?php include("es_manager_temps/es_feature.php"); ?>
                    	 </ul>
                    </div> 
                    
                    <div class="es_message" id="es_feature_message"></div>
                    <div class="es_add_newfield full clearFix">
                        <input type="text" name="es_feature_title" id="es_feature_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_feature_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_feature_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "Appliances", "es-plugin" ); ?></h2>
                    <div id="es_appliance_listing"> 
						 <ul>
                         <?php include("es_manager_temps/es_appliance.php"); ?>
                    	 </ul>
                    </div> 
                    
                    <div class="es_message" id="es_appliance_message"></div>
                    <div class="es_add_newfield full clearFix">
                        <input type="text" name="es_appliance_title" id="es_appliance_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_appliance_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_appliance_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>    	
            </div>
            
            <div id="esm_currency" class="es_tabs_content_in clearFix">
            	
                <div class="boxSizing es_manager_lists">
                    <h2><?php _e( "Currency", "es-plugin" ); ?></h2>
                    <div id="es_currency_listing"> 
						 <ul>
                         	<?php include("es_manager_temps/es_currency.php"); ?>
                    	</ul>	
                    </div> 
                    <div class="es_message" id="es_currency_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_currency_title" id="es_currency_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_currency_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_currency_insertion()"><?php _e( "Add new field", "es-plugin" ); ?></a>
                    </div>
                </div>
                	
            </div>
            
        </div>
        
    </div>

</div>
	