<?php
$es_settings = es_front_settings(); 
$price_format = explode("|", $es_settings->price_format);

function get_currency_sign() {
    global $es_settings;
    // $es_settings = es_front_settings(); 
    
    $currency_sign_ex = explode(",", $es_settings->default_currency);

    if (count($currency_sign_ex) == 1) {
        return $currency_sign_ex[0];
    } else {
        return $currency_sign_ex[1];
    }
}

function get_dimension() {
    global $wpdb;

    $dimendion = $wpdb->get_row("SELECT dimension_title FROM {$wpdb->prefix}estatik_manager_dimension WHERE dimension_status=1");
    return $dimendion->dimension_title;
}

function get_images($listing_id) {
    global $wpdb;
    $image_sql = "SELECT prop_meta_value FROM " . $wpdb->prefix 
        . "estatik_properties_meta WHERE prop_id = " . $listing_id 
        . " AND prop_meta_key = 'images'";

    unset($uploaded_images, $image_url);
    $uploaded_images = $wpdb->get_row($image_sql);
    $uploaded_images_count = "0";

    if ( isset($uploaded_images) && !empty($uploaded_images) ) {
        $upload_image_data = unserialize($uploaded_images->prop_meta_value);
        $uploaded_images_count = count($upload_image_data);
    }

    if ( isset($uploaded_images) && !empty($uploaded_images) 
                                 && !empty($upload_image_data) ) {
        $upload_dir = wp_upload_dir();
        $es_settings = es_front_settings();

        $delimiter = array('', 'table_', '2column_', 'list_');

        $list_image_name = explode("/", $upload_image_data[0]);
        $list_image_name = end($list_image_name);
        $list_image_path = str_replace($list_image_name, "", 
                                       $upload_image_data[0]);
        
        return array(
                $upload_dir['baseurl'] 
              . $list_image_path 
              . $delimiter[$es_settings->listing_layout]
              . $list_image_name,
              $uploaded_images_count
          );
    } 

    return array( 
        get_template_directory_uri() 
        . "/images/placeholder_banner.png",
        0
    );
}

function get_order() {
    if ( empty($_GET['order']) ) {
        return 'ORDER BY prop_date_added DESC';
    }

    switch ($_GET['order']) {
        case 'latest':
        return 'ORDER BY prop_date_added DESC';

        case 'cheapest':
        return 'ORDER BY prop_price ASC, prop_date_added DESC';

        case 'featured':
        return 'ORDER BY prop_featured DESC, prop_date_added DESC';

        default;
        break;
    }
}

function get_price($listing_price) {
    global $es_settings, $price_format;
    // $es_settings = es_front_settings(); 
    $currency_sign = get_currency_sign();

    if ( $es_settings->price != 1 ) {
        return '';
    }

    // $price_format = explode("|", $es_settings->price_format);
    
    $price = number_format($listing_price, 
                           $price_format[0], 
                           $price_format[1], 
                           $price_format[2]);

    return ( $es_settings->currency_sign_place == 'before' ) 
            ? "$currency_sign$price"
            : "$price$currency_sign";
}

function get_listing_categories() {
    global $wpdb;

    $sql = 'SELECT * FROM ' . $wpdb->prefix . 'estatik_manager_categories';
    $result = array();
    foreach ( $wpdb->get_results($sql) as $item ) {
        $result[$item->cat_id] = $item->cat_title;
    }
    return $result;
}

function print_image($prop_id) {
    global $wpdb, $es_settings;

    $table = $wpdb->prefix . 'estatik_properties_meta';
    $image_sql = "SELECT prop_meta_value FROM $table WHERE prop_id = $prop_id AND prop_meta_key = 'images'";

    unset($uploaded_images, $image_url);
    $uploaded_imagess = $wpdb->get_row($image_sql);
    $uploaded_images_count = "0";

    if ( isset($uploaded_imagess) && !empty($uploaded_imagess) ) {
        $upload_image_data = unserialize($uploaded_imagess->prop_meta_value);
        $uploaded_images_count = count($upload_image_data);
    }


    if ( isset($uploaded_imagess) && !empty($uploaded_imagess) && !empty($upload_image_data) ) {
        $upload_dir = wp_upload_dir();
        $list_image_name = explode("/", $upload_image_data[0]);
        $list_image_name = end($list_image_name);
        $list_image_path = str_replace($list_image_name, "", $upload_image_data[0]);

        switch ( $es_settings->listing_layout ) {
            case 1:
                $prefix = 'table_';
                break;

            case 2:
                $prefix = '2column_';
                break;

            case 3: 
                $prefix = 'list_';
                break;

            default:
            break;
        }
        $image_url = $list_image_path . $prefix . $list_image_name;
    ?>
    <img src="<?php echo $upload_dir['baseurl'], $image_url ?>" alt=""/>
    <?php
    } else {
        echo '<p>' . __("No Image", 'es-plugin') . '</p>';
    } ?>
    <span>
        <small>
            <?php echo (!empty($upload_image_data)) ? $uploaded_images_count : "0"; ?>
        </small>
    </span> 
<?php 
}

function list_property($list) {
    // $es_settings = es_front_settings(); 
    global $es_settings, $price_format;
    $es_dimension = get_dimension();
?>
    <li class="prop_id-<?php echo $list->prop_id ?>">
        <div class="es_my_list_in clearfix">
            <div class="es_my_list_pic">

                <?php if ($es_settings->labels == 1) { ?>
                <div class="prop_labels">
                    <?php if ($list->prop_featured == 1) { ?>
                        <label class="clearfix es_featured">
                            <?php _e("Featured", 'es-plugin'); ?>
                        </label><br/>
                    <?php } ?>
                    <?php if ($list->prop_hot == 1) { ?>
                        <label class="clearfix es_hot">
                            <?php _e("hot", 'es-plugin'); ?>
                        </label><br/>
                    <?php } ?>
                    <?php if ($list->prop_open_house == 1) { ?>
                        <label class="clearfix es_openhouse">
                            <?php _e("openhouse", 'es-plugin'); ?>
                        </label><br/>
                    <?php } ?>
                    <?php if ($list->prop_foreclosure == 1) { ?>
                        <label class="clearfix es_foreclosure">
                            <?php _e("foreclosure", 'es-plugin'); ?>
                        </label>
                    <?php } ?>
                </div>
                <?php } ?>

                <a href="<?php echo get_permalink($list->prop_id); ?>">
                    <?php print_image($list->prop_id); ?>
                </a>

            </div>
            <div class="es_my_list_title">
                <?php $title = $es_settings->title == 1 
                             ? $list->prop_title : $list->prop_address ?>
                <h3>
                    <a href="<?php echo get_permalink($list->prop_id); ?>">
                        <?php 
                            echo substr($title, 0, 30);
                            if (strlen($title) > 30) echo '...'; 
                        ?>
                    </a>
                </h3>

                <?php if ($es_settings->price == 1) {
                    // $price_format = explode("|", $es_settings->price_format);
                ?>
                <h2>
                    <?php echo get_price($list->prop_price); ?>
                </h2>
                <?php } ?>
            </div>

            <div class="es_my_list_specs clearfix">
                <span class="es_dimen">
                    <?php 
                        if ($list->prop_area != 0) { 
                            echo $list->prop_area . ' ' . $es_dimension;
                        } 
                    ?>
                </span>
                <span class="es_bd">
                        <?php 
                            if ($list->prop_bedrooms != 0) { 
                                echo $list->prop_bedrooms;
                                echo _n(" bed", " beds", $list->prop_bedrooms, 'es-plugin'); 
                            } 
                        ?>
                </span>
                <span class="es_bth">
                    <?php 
                        if ( $list->prop_bathrooms != 0 ) { 
                            echo str_replace('.0', '', $list->prop_bathrooms);
                            echo _n(" bath", " baths", $list->prop_bathrooms, 'es-plugin'); 
                        }
                    ?>
                </span>
            </div>
            <div class="es_my_list_more clearfix">
                <a onclick="es_map_view_click(this); return false;"
                   href="<?php 
                       if ($list->prop_latitude != "" && $list->prop_longitude != "") { 
                            echo $list->prop_latitude ?>,<?php echo $list->prop_longitude;
                       } ?>" 
                   class="es_map_view">
                   <?php _e("View on map", 'es-plugin'); ?>
                </a>
                <a href="<?php echo get_permalink($list->prop_id); ?>"
                   class="es_detail_btn">
                   <?php _e("Details", 'es-plugin'); ?>
                </a>
            </div>
        </div>
    </li>

<?php }

require_once(PATH_DIR . 'front_templates/includes/pagination.php');
function es_pagination($config, $where) {
    global $wpdb, $es_settings;
    
    $table = $wpdb->prefix . 'estatik_properties';
    $es_count_listing = $wpdb->get_row("SELECT count(*) as total_record FROM $table $where");

    $config = array(
        'total_rows' => $es_count_listing->total_record,
        'per_page' => $es_settings->no_of_listing,
        'uri_segment' => 3,
        'num_links' => 1
    ); 

    $path = explode('/', $_SERVER['REQUEST_URI']);
    $config['base_url']  = end($path);

    if ( substr($config['base_url'], 0, strlen('?s&')) === '?s&' ) {
        $config['url_paramenter']  = 'cutom';
    }

    $pagination = new Pagination($config);
    echo $pagination->create_links();
}

function get_list($where, $order) {
    global $wpdb, $es_settings;

    $paged = isset($_GET['page_no']) ? $_GET['page_no'] : 0;
    $es_per_page =  $es_settings->no_of_listing;

    $sql = "SELECT * FROM {$wpdb->prefix}estatik_properties $where $order LIMIT $paged, $es_per_page";
    $es_my_listing = $wpdb->get_results($sql); 
 
?>

<div id="es_content" class="clearfix es_1_column">
    
    <?php include('es_view_first.php'); ?>
    
    <div class="es_my_listing clearfix" id="es_specific_listing">
        <ul>
            <?php
            if ( !empty($es_my_listing) ) {
                foreach ( $es_my_listing as $list ) {
                    list_property($list);  
                }
            } else {            
                echo '<li class="es_no_record">'.__("No record found.", 'es-plugin').'</li>';           
            } 
            ?>
         </ul>
    </div>
    
    <div id="es_map_pop_outer">
        <div id="es_map_pop">
            <h2><?php _e("Map", 'es-plugin'); ?><a id="es_closePop" href="javascript:void(0)">×</a></h2>
            <div id="es_map"></div>
        </div>
    </div>
    
    <div id="es_more_pagi">
        <?php es_pagination(array(), $where); ?>
    </div>
 
    <?php if($es_settings->powered_by_link==1) { ?>
        <div class="es_powred_by">
            <p><?php _e("Powered by", 'es-plugin'); ?> <a href="http://www.estatik.net" target="_blank">Estatik</a></p>
        </div>    
    <?php } ?>
    
</div> 

<?php
}

function get_list_trendy($where, $order, $esLayout) {
    global $es_settings, $wpdb;

    $paged = isset($_GET['page_no']) ? $_GET['page_no'] : 0;

    if ( empty($order) ) {
        $order = get_order();
    }

    $sql = "SELECT * FROM {$wpdb->prefix}estatik_properties $where $order LIMIT $paged, {$es_settings->no_of_listing}";
    $es_my_listing = $wpdb->get_results($sql);

    $columns = $es_settings->listing_layout;
    $es_dimension = get_dimension();
    $theme_url = get_template_directory_uri();

    if (!empty($es_my_listing)) {
    ?>

    <div class="es_listing_change">
        <?php include('es_view_first.php'); ?>
        <?php //get_template_part('es_includes/es_view_first'); ?>
    </div>
    <div class="es_my_listing">

        <ul class="clearfix <?php echo "es_columns_$columns"?>">
        <?php 
            foreach ($es_my_listing as $list) { 
                $photo_info = get_images($list->prop_id);
                $image_url = $photo_info[0];
                $uploaded_images_count = $photo_info[1];
        ?>
            <li class="es_listing_item prop_id-<?php echo $list->prop_id ?>">
                <a href="<?php echo get_permalink($list->prop_id); ?>"
                   class="es_my_list_in"
                   style="background-image: url(<?php echo $image_url ?>)">
                </a>

                <div class="es_my_list_title">
                    <h3>
                        <a href="<?php echo get_permalink($list->prop_id); ?>">
                            <?php 
                                echo substr($list->prop_address, 0, 90);
                                if (strlen($list->prop_address) > 90) echo '...'; 
                            ?>
                        </a>
                    </h3>
                    <h2><?php echo get_price($list->prop_price) ?></h2>

                    <div class="clearfix"></div>
                    <?php if ($es_settings->labels == 1) { ?>
                        <ul class="prop_labels">
                            <?php if ($list->prop_foreclosure == 1) { ?>
                                <li class="es_foreclosure">
                                    <?php _e("Foreclosure", 'es-plugin'); ?>
                                </label>
                            <?php } ?>
                            <?php if ($list->prop_open_house == 1) { ?>
                                <li class="es_openhouse">
                                    <?php _e("Openhouse", 'es-plugin'); ?>
                                </li>
                            <?php } ?>
                            <?php if ($list->prop_featured == 1) { ?>
                                <li class="es_featured_prop">
                                    <?php _e("Featured", 'es-plugin'); ?>
                                </li>
                            <?php } ?>
                            <?php if ($list->prop_hot == 1) { ?>
                                <li class="es_hot">
                                    <?php _e("Hot", 'es-plugin'); ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>

                <div class="hover">
                    <div class="overlay">
                        <div class="es_my_list_more clearfix">
                            <a href="<?php 
                               if ($list->prop_latitude != "" && $list->prop_longitude != "") { 
                                echo $list->prop_latitude . ' ' . $list->prop_longitude;
                               } ?>" class="es_button es_map_view">
                               <?php _e("View on map", 'es-plugin'); ?>
                            </a>
                            <a href="<?php echo get_permalink($list->prop_id); ?>"
                               class="es_button es_detail_btn">
                               <?php _e("Details", 'es-plugin'); ?>
                            </a>
                        </div>

                        <ul class="es_my_list_specs clearfix">
                            <li class="es_photo">
                                <div class="slide_up">
                                    <img src="<?php echo $theme_url?>/images/photo.png"/><br/>
                                    <?php 
                                        echo sprintf (_n("%s photo", "%s photos", $uploaded_images_count, 'es-plugin'), $uploaded_images_count); 
                                    ?>                                    
                                </div>
                            </li>
                            <li class="es_bd">
                                <div class="slide_up">
                                    <img src="<?php echo $theme_url?>/images/bed.png"/><br/>
                                    <?php 
                                        echo sprintf (_n("%s bed", "%s beds", $list->prop_bedrooms, 'es-plugin'), $list->prop_bedrooms); 
                                    ?>
                                </div>
                            </li>
                            <li class="es_dimen">
                                <div class="slide_up">
                                    <img src="<?php echo $theme_url?>/images/area.png"/><br/>
                                    <?php 
                                        echo $list->prop_area . ' ' . $es_dimension;
                                    ?>
                                </div>
                            </li>
                            <li class="es_bth">
                                <div class="slide_up">
                                    <img src="<?php echo $theme_url?>/images/shower.png"/><br/>
                                    <?php 
                                        if ( $list->prop_bathrooms != 0 ) { 
                                            echo str_replace('.0', '', $list->prop_bathrooms);
                                            echo _n(" bath", " baths", $list->prop_bathrooms, 'es-plugin'); 
                                        }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="bottom"></div>
                </div>
            </li>

        <?php
            }
        } else {
            echo '<li class="es_no_record">' . __("No record found.", 'es-plugin') . '</li>';
        }
        ?>
        </ul>
        <div id="es_more_pagi">
            <?php es_pagination(array(), $where); ?>
        </div>
    </div>

<?php } ?>