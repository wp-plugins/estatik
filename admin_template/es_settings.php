<?php 
global $wpdb;
  
 
if(isset($_POST['es_settings_submit'])){
	
	$powered_by_link						= sanitize_text_field($_POST['powered_by_link']);
	$no_of_listing							= sanitize_text_field($_POST['no_of_listing']);
	$price									= sanitize_text_field($_POST['price']);
	$title									= sanitize_text_field($_POST['title']);
	$address								= sanitize_text_field($_POST['address']);
	$dare_format							= sanitize_text_field($_POST['dare_format']);
	$resize_method							= sanitize_text_field($_POST['resize_method']);
	$prop_listview_list_height				= sanitize_text_field($_POST['prop_listview_list_height']);
	$prop_listview_list_width				= sanitize_text_field($_POST['prop_listview_list_width']);
	$prop_singleview_photo_lr_height		= sanitize_text_field($_POST['prop_singleview_photo_lr_height']);
	$prop_singleview_photo_lr_width			= sanitize_text_field($_POST['prop_singleview_photo_lr_width']);
	$prop_singleview_photo_thumb_height		= sanitize_text_field($_POST['prop_singleview_photo_thumb_height']);
	$prop_singleview_photo_thumb_width		= sanitize_text_field($_POST['prop_singleview_photo_thumb_width']);
 	
	$default_currency						= sanitize_text_field($_POST['default_currency']);
	$price_format							= sanitize_text_field($_POST['price_format']);
	$currency_sign_place					= sanitize_text_field($_POST['currency_sign_place']);
 
	$wpdb->update( 
		$wpdb->prefix.'estatik_settings', 
		array( 
			'powered_by_link' 						=> $powered_by_link,
			'no_of_listing' 						=> $no_of_listing,
			'price' 								=> $price,
			'title' 								=> $title,
			'address' 								=> $address,
			'dare_format' 							=> $dare_format,
			'resize_method' 						=> $resize_method,
			'prop_listview_list_height' 			=> $prop_listview_list_height,
			'prop_listview_list_width' 				=> $prop_listview_list_width,
			'prop_singleview_photo_lr_height' 		=> $prop_singleview_photo_lr_height,
			'prop_singleview_photo_lr_width' 		=> $prop_singleview_photo_lr_width,
			'prop_singleview_photo_thumb_height' 	=> $prop_singleview_photo_thumb_height,
			'prop_singleview_photo_thumb_width' 	=> $prop_singleview_photo_thumb_width,
			'default_currency' 						=> $default_currency,
			'price_format' 							=> $price_format,
			'currency_sign_place' 					=> $currency_sign_place
		), 
		array( 'setting_id' => 1 ) 
		);
 
} ?>
<div class="es_wrapper"> 
 	
    <div class="es_header clearFix">
 		<h2>Settings</h2>
        <h3><img src="<?php echo DIR_URL.'admin_template/';?>images/estatik_simple.png" alt="#" /><small>Ver. 1.0</small></h3>
    </div>
    
    <form method="post" id="es_settings_form" action="">
        
        <div class="esHead clearFix">
            <p>Please fill up your Settings detail and click save to finish.</p>
            <input type="submit" value="Save" name="es_settings_submit" />
        </div>
        
        <?php if(isset($_POST['es_settings_submit'])) { ?>
            
            <div class="es_success">Settings has been updated.</div>	
        
        <?php } ?>
 
        <div class="es_content_in">
            
            <div class="es_tabs clearFix">
                <ul>
                    <li><a href="#es_general_settings">General Settings</a></li>
                    <li><a href="#es_layout">Layout</a></li>
                    <li><a href="#es_images">Images</a></li>
                    <li><a href="#es_currency">Currency</a></li>
                    <li><a href="#es_sharing">Sharing</a></li>
                </ul>
            </div>
            
            <?php 
                $es_settings = new stdClass;
                $es_settings_data = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_settings');
                $es_settings = $es_settings_data[0];
				
				//print_r($es_settings);
     
            ?>
            
            <div id="es_settings" class="es_tabs_contents  clearFix">
     
                <div id="es_general_settings" class="es_tabs_content_in clearFix">     
                    <div class="es_settings_field clearFix">
                        <span>Powered by link:</span>
                        <label class="<?php if($es_settings->powered_by_link=='1'){ echo 'active'; } ?>"><input type="radio" value="1" <?php if($es_settings->powered_by_link=='1'){ echo 'checked="checked"'; } ?> name="powered_by_link" />Yes</label>
                        <label class="<?php if($es_settings->powered_by_link=='0'){ echo 'active'; } ?>"><input type="radio" value="0" <?php if($es_settings->powered_by_link=='0'){ echo 'checked="checked"'; } ?> name="powered_by_link" />No</label>
                    </div>
                    <div class="es_settings_field clearFix">
                        <span>Number of listings per page:</span>
                        <input type="number" name="no_of_listing" value="<?php echo $es_settings->no_of_listing?>" />
                    </div>
                    <div class="es_settings_field clearFix">
                        <span>Price:</span>
                        <label class="<?php if($es_settings->price=='1'){ echo 'active'; } ?>"><input type="radio" value="1" <?php if($es_settings->price=='1'){ echo 'checked="checked"'; } ?> name="price" />Yes</label>
                        <label class="<?php if($es_settings->price=='0'){ echo 'active'; } ?>"><input type="radio" value="0" <?php if($es_settings->price=='0'){ echo 'checked="checked"'; } ?> name="price" />No</label>
                    </div>
                    <div class="es_settings_field clearFix">
                        <span>Title/Address:</span>                       
                        <label class="<?php if($es_settings->title=='1'){ echo 'active'; } ?>"><input type="radio" value="1" <?php if($es_settings->title=='1'){ echo 'checked="checked"'; } ?> name="title" />Title</label>
                        <label class="<?php if($es_settings->title=='0'){ echo 'active'; } ?>"><input type="radio" value="0" <?php if($es_settings->title=='0'){ echo 'checked="checked"'; } ?> name="title" />Address</label>
                    </div>
                    <div class="es_settings_field clearFix">
                        <span>Address:</span>
                        <label class="<?php if($es_settings->address=='1'){ echo 'active'; } ?>"><input type="radio" value="1" <?php if($es_settings->address=='1'){ echo 'checked="checked"'; } ?> name="address" />Yes</label>
                        <label class="<?php if($es_settings->address=='0'){ echo 'active'; } ?>"><input type="radio" value="0" <?php if($es_settings->address=='0'){ echo 'checked="checked"'; } ?> name="address" />No</label>
                    </div>
                    <div class="es_settings_field clearFix">
                        <span>Date format:</span>
                        <select name="dare_format">
                            <option value="">Date Format</option>
                            <option <?php if($es_settings->dare_format=='d/m/y'){ echo 'selected="selected"'; } ?> value="<?php echo "d/m/y"?>"><?php echo date("d/m/y");?></option>
                            <option <?php if($es_settings->dare_format=='m/d/y'){ echo 'selected="selected"'; } ?> value="<?php echo "m/d/y"?>"><?php echo date("m/d/y");?></option>
                            <option <?php if($es_settings->dare_format=='d.m.y'){ echo 'selected="selected"'; } ?> value="<?php echo "d.m.y"?>"><?php echo date("d.m.y");?></option>
                        </select>
                    </div>
                </div>
      
                <div id="es_layout" class="es_tabs_content_in clearFix">     
                    <div class="es_layout es_list_view clearFix">
                        <span>Listings layout:</span>
                        <label class="disabled"><small></small><input type="radio" disabled="disabled" value="" /></label>
                        <label class="disabled"><small></small><input type="radio" disabled="disabled" value="" /></label>
                        <label class="<?php if($es_settings->listing_layout=='1'){ echo 'active'; } ?>"><small></small><input type="radio" name="listing_layout" <?php if($es_settings->listing_layout=='1'){ echo 'checked="checked"'; } ?> value="1" /></label>
                    </div>
                    <div class="es_layout es_single_view clearFix">
                        <span>Single property:</span>
                        <label class="<?php if($es_settings->single_property_layout=='3'){ echo 'active'; } ?>"><small></small><input type="radio" name="single_property_layout" <?php if($es_settings->single_property_layout=='3'){ echo 'checked="checked"'; } ?> value="3" /></label>
                        <label class="disabled"><small></small><input type="radio" disabled="disabled" value="" /></label>
                        <label class="disabled"><small></small><input type="radio" disabled="disabled" value="" /></label>
                    </div>
                    
                    <div>
                    	<p>Disabled Layouts are available in <a href="http://estatik.net/product/estatik-professional/" target="_blank">Estatik Pro</a> version.</p>
                    </div>
                    
                </div>
                
                <div id="es_images" class="es_tabs_content_in clearFix">     
                    <div class="es_images_setting_head clearFix">
                        <h2>Properties</h2>
                        <div class="es_images_setting_resize">
                            <span>Resize method:</span>
                            <label class="<?php if($es_settings->resize_method=='crop_shrink'){ echo 'active'; } ?>"><input type="radio" value="crop_shrink" <?php if($es_settings->resize_method=='crop_shrink'){ echo 'checked="checked"'; } ?> name="resize_method" />Crop &amp; shrink</label>
                            <label class="<?php if($es_settings->resize_method=='crop'){ echo 'active'; } ?>"><input type="radio" value="crop" <?php if($es_settings->resize_method=='crop'){ echo 'checked="checked"'; } ?> name="resize_method" />Crop</label>
                        </div>
                    </div>
                    <div class="es_images_setting clearFix">
                        <ul>
                            <li class="clearFix">
                                <div><span>Listings view:</span></div>
                                <div><label>Table</label></div>
                                <div><label>2 colums</label></div>
                                <div><label>list</label></div>
                            </li>
                            <li class="clearFix">
                                <div><span>Height, px</span></div>
                                <div><input type="text" disabled="disabled" /></div>
                                <div><input type="text" disabled="disabled" /></div>
                                <div><input type="text" value="<?php echo $es_settings->prop_listview_list_height;?>" name="prop_listview_list_height" /></div>
                            </li>
                            <li class="clearFix">
                                <div><span>Widht, px</span></div>
                                <div><input type="text" disabled="disabled" /></div>
                                <div><input type="text" disabled="disabled" /></div>
                                <div><input type="text" value="<?php echo $es_settings->prop_listview_list_width;?>" name="prop_listview_list_width" /></div>
                            </li>
                        </ul>
                    </div>
 
                    <div class="es_images_setting clearFix">
                        <ul>
                            <li class="clearFix">
                                <div><span>Single property:</span></div>
                                <div><label>Photo on<br />the left/right</label></div>
                                <div><label>Photo <br />in center</label></div>
                                <div><label>Photo <br /> Thumb</label></div>
                            </li>
                            <li class="clearFix">
                                <div><span>Height, px</span></div>
                                <div><input type="text" value="<?php echo $es_settings->prop_singleview_photo_lr_height;?>" name="prop_singleview_photo_lr_height" /></div>
                                <div><input type="text" disabled="disabled" /></div>
                                <div><input type="text" value="<?php echo $es_settings->prop_singleview_photo_thumb_height;?>" name="prop_singleview_photo_thumb_height" /></div>
                            </li>
                            <li class="clearFix">
                                <div><span>Widht, px</span></div>
                                <div><input type="text" value="<?php echo $es_settings->prop_singleview_photo_lr_width;?>" name="prop_singleview_photo_lr_width" /></div>
                                <div><input type="text" disabled="disabled" /></div>
                                <div><input type="text" value="<?php echo $es_settings->prop_singleview_photo_thumb_width;?>" name="prop_singleview_photo_thumb_width" /></div>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="">
                    	<p>Disabled fields are available in <a href="http://estatik.net/product/estatik-professional/" target="_blank">Estatik Pro</a> version.</p>
                    </div>
                </div>
                
                <div id="es_currency" class="es_tabs_content_in clearFix">     
                    <div class="es_settings_field clearFix">
                        <span>Default currency:</span>
                        <select name="default_currency">
                            <option value="">Dollar, Euro, etc.</option>
							<?php global $wpdb;
                                $es_currency_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_currency' );		
                                if(!empty($es_currency_listing)) {
									foreach($es_currency_listing as $list) {	
										$selected = ($es_settings->default_currency==$list->currency_title) ? 'selected="selected"' : "";
										echo '<option '.$selected.' value="'.$list->currency_title.'">'.$list->currency_title.'</option>';
									}
								}
							?>
                        </select>
                    </div>
                    <div class="es_settings_field clearFix">
                        <span>Price format:</span>
                        <select name="price_format">
                            <option <?php if($es_settings->price_format=='2|.|,'){ echo 'selected="selected"'; } ?> value="2|.|,">19,999.00</option>
                            <option <?php if($es_settings->price_format=='2|,|.'){ echo 'selected="selected"'; } ?> value="2|,|.">19.999,00</option>
                            <option <?php if($es_settings->price_format=='0|| '){ echo 'selected="selected"'; } ?> value="0|| ">19 999</option>
                        </select>
                    </div>
                    <div class="es_settings_field clearFix">
                        <span>Currency sign place:</span>
                        <label class="<?php if($es_settings->currency_sign_place=='before'){ echo 'active'; } ?>"><input type="radio" value="before" <?php if($es_settings->currency_sign_place=='before'){ echo 'checked="checked"'; } ?> name="currency_sign_place" />Before price</label>
                        <label class="<?php if($es_settings->currency_sign_place=='after'){ echo 'active'; } ?>"><input type="radio" value="after" <?php if($es_settings->currency_sign_place=='after'){ echo 'checked="checked"'; } ?> name="currency_sign_place" />After price</label>
                    </div>
                </div>
                
                <div id="es_sharing" class="es_tabs_content_in clearFix">     
                     <div class="es_settings_field clearFix">
                        <small></small>
                        <span>Twitter</span>
                        <label><input type="radio" disabled="disabled" value="" />Yes</label>
                        <label><input type="radio" disabled="disabled" value="" />NO</label>
                     </div>
                     <div class="es_settings_field clearFix">
                        <small></small>
                        <span>Facebook</span>
                        <label><input type="radio" disabled="disabled" value="" />Yes</label>
                        <label><input type="radio" disabled="disabled" value="" />NO</label>
                     </div>
                     <div class="es_settings_field clearFix">
                        <small></small>
                        <span>Google+</span>
                        <label><input type="radio" disabled="disabled" value="" />Yes</label>
                        <label><input type="radio" disabled="disabled" value="" />NO</label>
                     </div>
                     <div class="es_settings_field clearFix">
                        <small></small>
                        <span>LinkedIn</span>
                        <label><input type="radio" disabled="disabled" value="" />Yes</label>
                        <label><input type="radio" disabled="disabled" value="" />NO</label>
                     </div>
                     <div class="es_settings_field clearFix">
                     	<small></small>
                        <span>PDF flayer:</span>
                        <label><input type="radio" disabled="disabled" value="" />Yes</label>
                        <label><input type="radio" disabled="disabled" value="" />NO</label>
                     </div>
                     
                     <p>Sharing Feature is available in <a href="http://estatik.net/product/estatik-professional/" target="_blank">Estatik Pro</a> version only.</p>
                     
                </div>
  
             </div>
 
        </div>
        
	</form>

</div>