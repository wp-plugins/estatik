<?php
 
wp_reset_query();
wp_reset_postdata();
global $post;
$current_id = get_post( $post )->ID;
$queried_object = get_queried_object();
 
if(is_single() && $show_on_pages=="show_on_checked_pages"){
 
	$single_page = in_array('single_page',$choosed_pages);
	
}else if(isset($queried_object->user_login) && $queried_object->user_login!="" && $show_on_pages=="show_on_checked_pages") {
	
	$author_page = in_array('author_page',$choosed_pages);
 
}else if(is_tax() && $show_on_pages=="show_on_checked_pages") {
	
	$archive_page = in_array('archive_page',$choosed_pages);
	
}else if(is_category() && $show_on_pages=="show_on_checked_pages") {
	
	$category_page = in_array('category_page',$choosed_pages);
	
}else if(is_search() && $show_on_pages=="show_on_checked_pages") {
	
	$search_page = in_array('search_page',$choosed_pages);
	
} else if($show_on_pages=="show_on_checked_pages") {
	
	$current_page = in_array($current_id,$choosed_pages); 
	
}


if(is_single() && $show_on_pages=="hide_on_checked_pages"){
	
	$single_page = in_array('single_page',$choosed_pages);
	$author_page=true;
	$archive_page=true;
	$search_page=true;
	$category_page=true;
	$current_page = true;
	
}else if(isset($queried_object->user_login) && $queried_object->user_login!="" && $show_on_pages=="hide_on_checked_pages") {
	
	$author_page = in_array('author_page',$choosed_pages);
	$single_page=true;
	$archive_page=true;
	$search_page=true;
	$category_page=true;
	$current_page = true;
	
}else if(is_tax() && $show_on_pages=="hide_on_checked_pages") {
	
	$archive_page = in_array('archive_page',$choosed_pages);
	$$author_page=true;
	$single_page=true;
	$search_page=true;
	$category_page=true;
	$current_page = true;
	
}else if(is_category() && $show_on_pages=="hide_on_checked_pages") {
	
	$category_page = in_array('category_page',$choosed_pages);
	$$author_page=true;
	$single_page=true;
	$archive_page=true;
	$search_page=true;
	$current_page = true;
	
}else if(is_search() && $show_on_pages=="hide_on_checked_pages") {
	
	$search_page = in_array('search_page',$choosed_pages);
	$author_page=true;
	$single_page=true;
	$archive_page=true;
	$category_page=true;
	$current_page = true;
	
} else if($show_on_pages=="hide_on_checked_pages") {
	
	$current_page = in_array($current_id,$choosed_pages); 
	
	$author_page=true;
	$single_page=true;
	$archive_page=true;
	$search_page=true;
	$category_page=true;
	
}
  
if(
$show_on_pages=="all_pages"
|| 
$show_on_pages=="show_on_checked_pages" && ($current_page==true || $author_page==true || $single_page==true || $archive_page==true || $search_page==true || $category_page==true )
||
$show_on_pages=="hide_on_checked_pages" && ( $current_page==false || $author_page==false || $single_page==false || $archive_page==false || $search_page==false || $category_page==false )
&&
in_array($widget_id,$choosed_pages)
){

?>

<div id="es_search">

    <div class="es_my_listing_search clearfix" id="search_<?php echo $search_layout?>">
        <?php if ( $search_title != "" ) { ?>
        	<h3><?php echo $search_title?></h3>
        <?php } ?>
		<?php
		global $wpdb;
 
        ?>
   
        <form method="post" action="<?php bloginfo('home'); ?>/">
        
        	<input type="hidden" value="<?php the_search_query(); ?>" name="s" id="s" />
            
            <div class="es_my_listing_search_upper clearfix">
                <?php if ( $search_address == 1 ) { ?>
                	<input type="text" class="es_address_auto" name="address" value="<?php if (isset($_POST['address'])) { echo $_POST["address"]; } ?>" placeholder="<?php _e('Address, City, ZIP', 'es-plugin'); ?>" />
                <?php } ?>
                <input type="reset" value="<?php _e('Reset', 'es-plugin'); ?>" name="reset" />
                <input type="submit" value="<?php _e('Search', 'es-plugin'); ?>" name="es_search" />
            </div>
             
            <?php if ( $search_price == 1 || $search_bedrooms == 1 || $search_bathrooms == 1 || $search_sqft == 1 || $search_lotsize == 1 || $search_category == 1 || $search_type == 1 || $search_agent == 1 || $search_keywords == 1 ) { ?>
                                        
            <div class="es_my_listing_search_lower clearfix">
                <?php if ( $search_price == 1 ) { ?>
                <div class="es_my_listing_search_field">
                    <label><?php _e('Price', 'es-plugin'); ?></label>          
                    <input type="text" name="price_min" value="<?php if (isset($_POST['price_min'])) { echo $_POST["price_min"]; } ?>" placeholder="<?php _e('min', 'es-plugin'); ?>" />
                    <i>-</i>
                    <input type="text" name="price_max" value="<?php if (isset($_POST['price_min'])) { echo $_POST["price_max"]; } ?>" placeholder="<?php _e('max', 'es-plugin'); ?>"  />
                </div>
                <?php } ?>
                <?php if ( $search_bedrooms == 1 ) { ?>
                <div class="es_my_listing_search_field">
                    <label><?php _e('Bedrooms', 'es-plugin'); ?></label>          
                    <input type="text" name="bedrooms_min" value="<?php if (isset($_POST['price_min'])) { echo $_POST["bedrooms_min"]; } ?>" placeholder="<?php _e('min', 'es-plugin'); ?>" />
                    <i>-</i>
                    <input type="text" name="bedrooms_max" value="<?php if (isset($_POST['price_min'])) { echo $_POST["bedrooms_max"]; } ?>" placeholder="<?php _e('max', 'es-plugin'); ?>"  />
                </div>
                <?php } ?>
                <?php if ( $search_bathrooms == 1 ) { ?>
                <div class="es_my_listing_search_field">
                    <label><?php _e('Bathrooms', 'es-plugin'); ?></label>          
                    <input type="text" name="bathrooms_min" value="<?php if (isset($_POST['price_min'])) { echo $_POST["bathrooms_min"]; } ?>" placeholder="<?php _e('min', 'es-plugin'); ?>" />
                    <i>-</i>
                    <input type="text" name="bathrooms_max" value="<?php if (isset($_POST['price_min'])) { echo $_POST["bathrooms_max"]; } ?>" placeholder="<?php _e('max', 'es-plugin'); ?>"  />
                </div>
                <?php } ?>
                
                <?php if ( $search_sqft == 1 ) { ?>
                <div class="es_my_listing_search_field">
                    <label><?php _e('Sq ft', 'es-plugin'); ?></label>          
                    <input type="text" name="area_min" value="<?php if (isset($_POST['price_min'])) { echo $_POST["area_min"]; } ?>" placeholder="<?php _e('min', 'es-plugin'); ?>" />
                    <i>-</i>
                    <input type="text" name="area_max" value="<?php if (isset($_POST['price_min'])) { echo $_POST["area_max"]; } ?>" placeholder="<?php _e('max', 'es-plugin'); ?>"  />
                </div>
                <?php } ?>
                <?php if ( $search_lotsize == 1 ) { ?>
                <div class="es_my_listing_search_field">
                    <label><?php _e('Lot size', 'es-plugin'); ?></label>          
                    <input type="text" name="lotsize_min" value="<?php if (isset($_POST['price_min'])) { echo $_POST["lotsize_min"]; } ?>" placeholder="<?php _e('min', 'es-plugin'); ?>" />
                    <i>-</i>
                    <input type="text" name="lotsize_max" value="<?php if (isset($_POST['price_min'])) { echo $_POST["lotsize_max"]; } ?>" placeholder="<?php _e('max', 'es-plugin'); ?>"  />
                </div>
                <?php } ?> 
                <?php if ( $search_category == 1 ) { ?>
                <div class="es_my_listing_search_field">
                    <label><?php _e('Category', 'es-plugin'); ?></label>          
                    <div class="es_search_select">
                    	<span><?php _e('Category', 'es-plugin'); ?></span>
                        <small></small>
                        <ul>
                        	<?php $es_category_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_categories' );	
							if(!empty($es_category_listing)) {
								foreach($es_category_listing as $list) {	
									$selected = (isset($_POST['category']) && $_POST['category']==$list->cat_id) ? 'selected' : "";
									echo'<li class="'.$selected.'" value="'.$list->cat_id.'">'.$list->cat_title.'</li>';
								}
							} ?>
                        </ul>
                        <input type="hidden" name="category" value="<?php if(isset($_POST['category'])){ echo $_POST['category']; }?>" />
                    </div>
                </div>
                <?php } ?> 
                
                <?php if ( $search_type == 1 ) { ?>
                <div class="es_my_listing_search_field">
                    <label><?php _e('Type', 'es-plugin'); ?></label>          
                    <div class="es_search_select">
                    	<span><?php _e('Type', 'es-plugin'); ?></span>
                        <small></small>
                        <ul>
                        	<?php $es_type_listing = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'estatik_manager_types' );
                            if(!empty($es_type_listing)) {
                                foreach($es_type_listing as $list) {	
									$selected = (isset($_POST['type']) && $_POST['type']==$list->type_id) ? 'selected' : "";
									echo'<li class="'.$selected.'" value="'.$list->type_id.'">'.$list->type_title.'</li>';
								}
							} ?>
                        </ul>
                        <input type="hidden" name="type" value="<?php if(isset($_POST['type'])){ echo $_POST['type']; }?>" />
                    </div>
                </div>
                <?php } ?>
                <?php if ( $search_keywords == 1 ) { ?> 
                <div class="es_my_listing_search_field">
                    <label><?php _e('Key words', 'es-plugin'); ?></label>          
                    <input type="text" name="key_words" value="<?php if (isset($_POST['key_words'])) { echo $_POST["key_words"]; } ?>" />
                </div>
                <?php } ?>
            </div>
            
            <?php } ?>
        
        </form> 
    </div>

</div>

<?php } ?>
