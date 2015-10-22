<?php
global $post, $wpdb;
 
wp_reset_query();
wp_reset_postdata();

$current_id = get_post( $post );
if(!empty($current_id)){
	$current_id = $current_id->ID;
}
$queried_object = get_queried_object();
 
$current_page = "";
$single_page  = "";
$author_page  = "";
$archive_page = "";
$search_page  = "";
$category_page= "";
$current_page = "";

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


    $search_page_id = get_option('es_search_page');
    $search_page_url = get_permalink($search_page_id);
?>

<div id="es_search">

    <div class="es_my_listing_search clearfix" id="search_<?php echo $search_layout?>">
        <?php if ( $search_title != "" ) { ?>
        	<h3>
                <i class="fa fa-search"></i> 
                <div class="arrow_down"></div> 
                <div class="header">
                    <?php echo $search_title?>
                </div>
            </h3>
        <?php } ?>

        <form method="get" action="<?php echo $search_page_url; //home_url(); ?>/">
        
        	<input type="hidden" value="<?php the_search_query(); ?>" name="s" id="s" />
            <input type="hidden" value="<?php echo $search_page_id; ?>" name="page_id" />
            
            <div class="es_my_listing_search_upper clearfix">
                <?php if ( $search_address == 1 ) { ?>
                	<input type="text" class="es_address_auto" name="address" 
                        value="<?php echo isset($_GET['address']) ? $_GET["address"]:'';?>" 
                        placeholder="<?php _e("Address, City, ZIP", 'es-plugin'); ?>" />
                <?php } ?>
                <input type="reset" 
                       value="<?php _e("Reset", 'es-plugin'); ?>" name="reset" />
                <input type="submit" value="<?php _e("Search", 'es-plugin'); ?>" />
            </div>
             
            <div class="es_my_listing_search_lower clearfix">

                <?php 
                    if ( $search_country == 1 ) {
                        input_select(__("Country", 'es-plugin'), 
                            'country', 'estatik_manager_countries');
                    }

                    if ( $search_state == 1 ) {
                        $table = ( $search_country == 1 ) ? '' : 'estatik_manager_states';
                        input_select(__("State/Region", 'es-plugin'), 
                            'state', $table);
                    }

                    if ( $search_city == 1 ) {
                        $table = ( $search_state == 1 ) ? '' : 'estatik_manager_cities';
                        input_select(__("City", 'es-plugin'), 
                            'city', $table);
                    }

                    if ( $search_price == 1 ) { 
                        input_min_max(__("Price", 'es-plugin'), 'price'); 
                    }

                    if ( $search_bedrooms == 1 ) {
                        input_min_max(__("Bedrooms", 'es-plugin'), 'bedrooms'); 
                    } 

                    if ( $search_bathrooms == 1 ) {
                        input_min_max(__("Bathrooms", 'es-plugin'), 'bathrooms'); 
                    } 

                    if ( $search_sqft == 1 ) {
                        $es_dimension = $wpdb->get_row( 'SELECT dimension_title FROM '.$wpdb->prefix.'estatik_manager_dimension WHERE dimension_status=1' );
                        $title = empty($es_dimension) ? '':$es_dimension->dimension_title;
                        input_min_max($title, 'area'); 
                    } 

                    if ( $search_lotsize == 1 ) {
                        input_min_max(__("Lot size", 'es-plugin'), 'lotsize'); 
                    }

                    if ( $search_category == 1 ) {
                        input_select(__("Category", 'es-plugin'), 
                            'category', 'estatik_manager_categories');
                    }

                    if ( $search_type == 1 ) {
                        input_select(__("Type", 'es-plugin'), 
                            'type', 'estatik_manager_types');
                    }

                    if ( $search_agent == 1 ) {
                        input_select(__("Agent", 'es-plugin'), 
                            'agent', 'estatik_agents');
                    }

                ?>


                <?php if ( $search_keywords == 1 ) { ?> 
                <div class="es_my_listing_search_field">
                    <label><?php _e("Key words", 'es-plugin'); ?></label>          
                    <input type="text" name="key_words" 
                           value="<?php echo isset($_GET['key_words']) 
                                                 ? $_GET["key_words"] : '' ?>" />
                </div>
                <?php } ?>
            </div>
            
        </form> 
    </div>

</div>

<?php } 

function input_min_max($title, $name) {
    $min = $name . '_min';
    $max = $name . '_max';
?>
    <div class="es_my_listing_search_field">
        <label><?php echo $title ?></label>
        <input type="text" name="<?php echo $min?>" 
               value="<?php echo isset($_GET[$min]) ? $_GET[$min] : '' ?>" 
               placeholder="<?php _e("min", 'es-plugin'); ?>" />
        <i>-</i>
        <input type="text" name="<?php echo $max?>" 
               value="<?php echo isset($_GET[$max]) ? $_GET[$max] : '' ?>" 
               placeholder="<?php _e("max", 'es-plugin'); ?>"  />
    </div>
<?php
}

function input_select($title, $name, $table) {
    global $wpdb;

    $value = isset($_GET[$name]) ? $_GET[$name] : '';
?>
<div class="es_my_listing_search_field search_<?php echo $name ?>">
    <label><?php echo $title; ?></label>          
    <div class="es_search_select">
        <span><?php echo $title; ?></span>
        <small></small>
        <ul>
            <?php 
            if ( !empty($table) ) {
                $items = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}$table" );
                $keys = array_keys((array)$items[0]);
                foreach ( $items as $item ) {
                    $item = (array) $item;
                    $id = $item[$keys[0]];
                    $title = $item[$keys[1]];
                    $selected = ($value == $id) ? 'selected' : "";
                ?>
                    <li class="<?php echo $selected?>" value="<?php echo $id ?>">
                        <?php echo $title ?>
                    </li>
            <?php
                } 
            } 
            ?>
        </ul>
        <input type="hidden" name="<?php echo $name?>" value="<?php echo $value ?>" />
    </div>
</div>
<?php } ?>