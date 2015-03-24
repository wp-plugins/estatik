<div class="es_wrapper"> 
 	
    <div class="es_alert_popup" id="sure_popup">
    	<div class="es_alert_popup_overlay"></div>
        <div class="es_alert_popup_in boxSizing">
        	<p>Are you sure you want to delete it?</p>
            <ul>
            	<li><a class="es_ok" href="javascript:void(0)">Ok</a></li>
                <li><a class="es_cancel" href="javascript:void(0)">Cancel</a></li>
            </ul>
            <a href="javascript:void(0)" class="es_close_popup"></a>
        </div>
    </div>
    
    <div class="es_header clearFix">
        <h2>DATA MANAGER</h2>
        <h3><img src="<?php echo DIR_URL.'admin_template/';?>images/estatik_simple.png" alt="#" /><small>Ver. 1.0</small></h3>
    </div>

    <div class="es_content_in">
        
        <div class="es_tabs clearFix">
     		<ul>
            	<li><a href="#esm_propert_detail" >Properties details</a></li>
                <li><a href="#esm_location">Location</a></li>
                <li><a href="#esm_dimensions"  >Dimensions</a></li>
                <li><a href="#esm_features" >Features</a></li>
                <li><a href="#esm_currency"  >Currency</a></li>
            </ul>
        </div>
        <div class="es_tabs_contents clearFix">
            
            <div id="esm_propert_detail" class="es_tabs_content_in clearFix">
                <div class="boxSizing es_manager_lists">
                    <h2>Status</h2>
                    <div id="es_status_listing"> 
						<ul>
                        <?php include("es_manager_temps/es_status.php"); ?>
						</ul>
                    </div> 
                    
                    <div class="es_message" id="es_status_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_status_title" id="es_status_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_status_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_status_insertion()">Add new field</a>
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2>Category</h2>
                    <div id="es_category_listing"> 
						<ul>
                        <?php include("es_manager_temps/es_category.php"); ?>
						 </ul>
                    </div> 
                    
                    <div class="es_message" id="es_category_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_cat_title" id="es_cat_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_category_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_category_insertion()">Add new field</a>
                    </div>
                </div>
                
                <div class="clearFix hide-desktop show-ipad"></div>
                
                <div class="boxSizing es_manager_lists">
                    <h2>Type</h2>
                    <div id="es_type_listing"> 
						<ul>
                        	<?php include("es_manager_temps/es_type.php"); ?>
						</ul> 
                    </div> 
                    
                    <div class="es_message" id="es_type_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_type_title" id="es_type_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_type_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_type_insertion()">Add new field</a>
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2>Rent period</h2>
                    <div id="es_period_listing"> 
						<ul>
                        <?php include("es_manager_temps/es_period.php");  ?>
						</ul>
                    </div> 
                    
                    <div class="es_message" id="es_period_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_period_title" id="es_period_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_period_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_period_insertion()">Add new field</a>
                    </div>
                </div>
               
                
            </div>
            
            <div id="esm_location" class="es_tabs_content_in clearFix">
            	
                <div class="boxSizing es_manager_lists">
                    <h2>Country</h2>
                    <div id="es_country_listing"> 
						
                        <?php include("es_manager_temps/es_country.php");  ?>
 
                    </div> 
                    
                    <div class="es_message" id="es_country_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_country_title" id="es_country_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_country_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_country_insertion()">Add new field</a>
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2>States/Regions</h2>
                    <div id="es_state_listing"> 
						
                        <?php include("es_manager_temps/es_state.php");  ?>
 
                    </div> 
                    
                    <div class="es_message" id="es_state_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_state_title" id="es_state_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_state_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_state_insertion()">Add new field</a>
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2>Cities</h2>
                    <div id="es_city_listing"> 
						
                        <?php include("es_manager_temps/es_city.php");  ?>
 
                    </div> 
                    
                    <div class="es_message" id="es_city_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_city_title" id="es_city_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_city_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_city_insertion()">Add new field</a>
                    </div>
                </div>
 	
            </div>
            
            
            <div id="esm_dimensions" class="es_tabs_content_in clearFix">
            	
                <div class="boxSizing es_manager_lists">
                    <h2>Area &amp; lot size</h2>
                    <div id="es_dimension_listing"> 
						 <ul>
                         	<?php include("es_manager_temps/es_dimension.php"); ?>
                    	 </ul>
                    </div> 
                    
                    <div class="es_message" id="es_dimension_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_dimension_title" id="es_dimension_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_dimension_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_dimension_insertion()">Add new field</a>
                    </div>
                </div>
                	
            </div>
            
            <div id="esm_features" class="es_tabs_content_in clearFix">
            	
                <div class="boxSizing es_manager_lists">
                    <h2>Features</h2>
                    <div id="es_feature_listing"> 
						 <ul>
                         <?php include("es_manager_temps/es_feature.php"); ?>
                    	 </ul>
                    </div> 
                    
                    <div class="es_message" id="es_feature_message"></div>
                    <div class="es_add_newfield full clearFix">
                        <input type="text" name="es_feature_title" id="es_feature_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_feature_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_feature_insertion()">Add new field</a>
                    </div>
                </div>
                
                <div class="boxSizing es_manager_lists">
                    <h2>Appliances</h2>
                    <div id="es_appliance_listing"> 
						 <ul>
                         <?php include("es_manager_temps/es_appliance.php"); ?>
                    	 </ul>
                    </div> 
                    
                    <div class="es_message" id="es_appliance_message"></div>
                    <div class="es_add_newfield full clearFix">
                        <input type="text" name="es_appliance_title" id="es_appliance_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_appliance_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_appliance_insertion()">Add new field</a>
                    </div>
                </div>
                	
            </div>
            
            
            <div id="esm_currency" class="es_tabs_content_in clearFix">
            	
                <div class="boxSizing es_manager_lists">
                    <h2>Currency</h2>
                    <div id="es_currency_listing"> 
						 <ul>
                         	<?php include("es_manager_temps/es_currency.php"); ?>
                    	</ul>	
                    </div> 
                    
                    <div class="es_message" id="es_currency_message"></div>
                    <div class="es_add_newfield">
                        <input type="text" name="es_currency_title" id="es_currency_title" value="text/number" onFocus="if(this.value == 'text/number') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'text/number'; }" />
                        <span class="es_field_loader" id="es_currency_add_loader">&nbsp;</span>
                        <a href="javascript:void(0)" class="es_add_newfield_btn" onclick="es_currency_insertion()">Add new field</a>
                    </div>
                </div>
                	
            </div>
            
        </div>
        
    </div>

</div>
	