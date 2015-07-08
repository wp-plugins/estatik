<?php
global $wpdb, $paged;

extract(shortcode_atts(array(
    'category' => 'all',
    'type' => '',
    'status' => ''
), $atts));

$es_settings = es_front_settings();
$es_per_page = 	$es_settings->no_of_listing;
$property_table = $wpdb->prefix . 'estatik_properties';

if($status && !empty($status)){
    $status_table_name = $wpdb->prefix . 'estatik_manager_status';
    $status = strtolower($status);
    $status_sql = $wpdb->prepare("SELECT status_id FROM $status_table_name WHERE status_title = %s", $status);
    $status_result = $wpdb->get_var($status_sql);

    if($status_result && !empty($status_result)){
        $status_prop_sql = $wpdb->prepare("SELECT prop_id FROM $property_table WHERE prop_status = %d", $status_result);
        $status_prop_res = $wpdb->get_results($status_prop_sql);
    }

}

if($type && !empty($type)){
    $type = strtolower($type);
    $type_table_name = $wpdb->prefix . 'estatik_manager_types';
    $type_sql = $wpdb->prepare("SELECT type_id FROM $type_table_name WHERE type_title = %s", $type);
    $type_result = $wpdb->get_var($type_sql);

    if($type_result && !empty($type_result)){
        $type_prop_sql = $wpdb->prepare("SELECT prop_id FROM $property_table WHERE prop_type = %d", $type_result);
        $type_res = $wpdb->get_results($type_prop_sql);
    }
}

$post_in = array();
$type_prop_array = array();
$status_prop_array = array();

if(isset($type_res) && !empty($type_res) && isset($status_prop_res) && !empty($status_prop_res)){
    foreach($type_res as $prop_id){
        $type_prop_array[] = $prop_id->prop_id;
    }
    foreach($status_prop_res as $prop_id){
        $status_prop_array[] = $prop_id->prop_id;
    }

    foreach($type_prop_array as $prop_id){
        if(in_array($prop_id, $status_prop_array)){
            $post_in[] = $prop_id;
        }
    }

    foreach($status_prop_array as $prop_id){
        if(in_array($prop_id, $type_prop_array) && !in_array($prop_id, $post_in)){
            $post_in[] = $prop_id;
        }
    }
}
elseif( isset($type) && !empty($type) && isset($status) && !empty($status)){
    if(!isset($type_res) || empty($type_res) || !isset($status_prop_res) || empty($status_prop_res)){
        $empty = true;
    }
}
elseif(isset($type_res) && !empty($type_res)){
    foreach($type_res as $prop_id){
        $post_in[] = $prop_id->prop_id;
    }
}
elseif(isset($status_prop_res) && !empty($status_prop_res)){
    foreach($status_prop_res as $prop_id){
        $post_in[] = $prop_id->prop_id;
    }
}
elseif(isset($status_prop_res) && (!isset($type))){
    $empty = true;
}
elseif(isset($type_res) && !isset($status)){
    $empty = true;
}
elseif(isset($type) && !empty($type)){
    if(!isset($type_res) || empty($type_res)){
        $empty = true;
    }
}
elseif(isset($status) && !empty($status)){
    if(!isset($status_prop_res) || empty($status_prop_res)){
        $empty = true;
    }
}
else{
    unset($post_in);
}



if ($category != 'all') {
    if(isset($post_in) && !empty($post_in)){
        $args = array(
            'post_type' => 'properties',
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'property_category',
                    'field' => 'slug',
                    'terms' => $category
                )
            ),
            'posts_per_page' => $es_per_page,
            'paged' => $paged,
            'post__in' => $post_in
        );
    }
    else{
        $args = array(
            'post_type' => 'properties',
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'property_category',
                    'field' => 'slug',
                    'terms' => $category
                )
            ),
            'posts_per_page' => $es_per_page,
            'paged' => $paged
        );
    }
} else {
    if(isset($post_in) && !empty($post_in)){
        $args = array(
            'post_type' => 'properties',
            'post_status' => 'publish',
            'posts_per_page' => $es_per_page,
            'paged' => $paged,
            'post__in' => $post_in
        );
    }
    else{
        $args = array(
            'post_type' => 'properties',
            'post_status' => 'publish',
            'posts_per_page' => $es_per_page,
            'paged' => $paged
        );
    }
}

$properties_query = new WP_Query($args);

$dimension_sql = "SELECT dimension_title FROM ".$wpdb->prefix."estatik_manager_dimension WHERE dimension_status = 1";
$es_dimension = $wpdb->get_row($dimension_sql);

$currency_sign_ex = explode(",", $es_settings->default_currency);
if(count($currency_sign_ex)==1){
    $currency_sign = $currency_sign_ex[0];
}else {
    $currency_sign = $currency_sign_ex[1];
}

if(!$empty || empty($empty)) {
    if ($properties_query->have_posts()): ?>
        <div id="es_content" class="clearfix <?php
        if ($es_settings->listing_layout == '3') {
            echo 'es_3_column';
        } elseif ($es_settings->listing_layout == '2') {
            echo 'es_2_column';
        } else {
            echo 'es_single_column';
        }  ?>
    ">
            <div class="es_view_list_outer clearfix">
                <?php if ($category != 'all'): ?>
                    <?php
                    $term_object = get_term_by('slug', $category, 'property_category');
                    ?>
                    <div class="queriedHead">
                        <h1><?php echo $term_object->name; ?> <?php _e("Properties", 'es-plugin'); ?></h1>
                    </div>
                <?php endif; ?>
                <?php if (is_active_sidebar('es-toppage-sidebar')) : ?>

                    <?php dynamic_sidebar('es-toppage-sidebar'); ?>

                <?php endif; ?>
                <div class="es_my_listing clearfix">
                    <ul>
                        <?php
                        while ($properties_query->have_posts()):$properties_query->the_post(); ?>
                            <?php
                            $prop_id = get_the_ID();
                            $prop_title = get_the_title();

                            $sql = 'SELECT * FROM ' . $wpdb->prefix . 'estatik_properties WHERE prop_id = ' . $prop_id;
                            $list = $wpdb->get_results($sql);
                            ?>
                            <li class="prop_id-<?php echo $prop_id; ?>">
                                <div class="es_my_list_in clearfix">
                                    <div class="es_my_list_pic">
                                        <?php if ($es_settings->labels == 1) { ?>
                                            <div class="prop_labels">
                                                <?php if ($list->prop_featured == 1) { ?>
                                                    <label
                                                        class="clearfix es_featured"><?php _e("Featured", 'es-plugin'); ?></label>
                                                    <br/>
                                                <?php } ?>
                                                <?php if ($list->prop_hot == 1) { ?>
                                                    <label
                                                        class="clearfix es_hot"><?php _e("hot", 'es-plugin'); ?></label>
                                                    <br/>
                                                <?php } ?>
                                                <?php if ($list->prop_open_house == 1) { ?>
                                                    <label
                                                        class="clearfix es_openhouse"><?php _e("openhouse", 'es-plugin'); ?></label>
                                                    <br/>
                                                <?php } ?>
                                                <?php if ($list->prop_foreclosure == 1) { ?>
                                                    <label
                                                        class="clearfix es_foreclosure"><?php _e("foreclosure", 'es-plugin'); ?></label>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <a href="<?php echo get_permalink($prop_id); ?>">
                                            <?php
                                            $image_sql = "SELECT prop_meta_value FROM " . $wpdb->prefix . "estatik_properties_meta WHERE prop_id = " . $prop_id . " AND prop_meta_key = 'images'";
                                            $uploaded_images = $wpdb->get_row($image_sql);

                                            $uploaded_images_count = "0";
                                            if (!empty($uploaded_images)) {
                                                $upload_image_data = unserialize($uploaded_images->prop_meta_value);
                                                $uploaded_images_count = count($upload_image_data);
                                            }

                                            if (!empty($upload_image_data)) {
                                                $upload_dir = wp_upload_dir();

                                                if ($es_settings->listing_layout == 3) {
                                                    $list_image_name = explode("/", $upload_image_data[0]);
                                                    $list_image_name = end($list_image_name);
                                                    $list_image_path = str_replace($list_image_name, "", $upload_image_data[0]);
                                                    $image_url = $list_image_path . 'list_' . $list_image_name;
                                                } else if ($es_settings->listing_layout == 2) {
                                                    $list2_image_name = explode("/", $upload_image_data[0]);
                                                    $list2_image_name = end($list2_image_name);
                                                    $list2_image_path = str_replace($list2_image_name, "", $upload_image_data[0]);
                                                    $image_url = $list2_image_path . '2column_' . $list2_image_name;
                                                } else if ($es_settings->listing_layout == 1) {
                                                    $table_image_name = explode("/", $upload_image_data[0]);
                                                    $table_image_name = end($table_image_name);
                                                    $table_image_path = str_replace($table_image_name, "", $upload_image_data[0]);
                                                    $image_url = $table_image_path . 'table_' . $table_image_name;
                                                }
                                                ?>
                                                <img src="<?php echo $upload_dir['baseurl'] ?><?php echo $image_url ?>"
                                                     alt=""/>
                                            <?php
                                            } else {
                                                echo '<p>' . __("No Image", 'es-plugin') . '</p>';
                                            } ?>
                                            <span><small>
                                                    <?php if (!empty($upload_image_data)) { ?>
                                                        <?php echo $uploaded_images_count ?>
                                                    <?php
                                                    } else {
                                                        echo "0";
                                                    } ?>
                                                </small></span>
                                        </a>
                                    </div>
                                    <div class="es_my_list_title">
                                        <?php if ($es_settings->title == 1) { ?>
                                            <h3>
                                                <a href="<?php echo get_permalink($prop_id); ?>"><?php echo substr($prop_title, 0, 30);
                                                    if (strlen($prop_title) > 30) echo '...'; ?></a></h3>
                                        <?php } else { ?>
                                            <h3>
                                                <a href="<?php echo get_permalink($prop_id); ?>"><?php echo substr($list[0]->prop_address, 0, 30);
                                                    if (strlen($list[0]->prop_address) > 30) echo '...'; ?></a></h3>
                                        <?php } ?>

                                        <?php if ($es_settings->price == 1) {
                                            $price_format = explode("|", $es_settings->price_format);
                                            ?>
                                            <h2><?php if ($es_settings->currency_sign_place == 'before') {
                                                    echo $currency_sign;
                                                } ?><?php echo number_format($list[0]->prop_price, $price_format[0], $price_format[1], $price_format[2]); ?><?php if ($es_settings->currency_sign_place == 'after') {
                                                    echo $currency_sign;
                                                } ?></h2>
                                        <?php } ?>
                                    </div>
                                    <div class="es_my_list_specs clearfix">
                                        <span
                                            class="es_dimen"><?php if ($list[0]->prop_area != 0) { ?><?php echo $list[0]->prop_area ?><?php } ?> <?php if (!empty($es_dimension)) {
                                                echo $es_dimension->dimension_title;
                                            } ?></span>
                                        <span
                                            class="es_bd"><?php if ($list[0]->prop_bedrooms != 0) { ?><?php echo $list[0]->prop_bedrooms ?><?php } ?> <?php _e("beds", 'es-plugin'); ?></span>
                                        <span
                                            class="es_bth"><?php if ($list[0]->prop_bathrooms != 0) { ?><?php echo $list[0]->prop_bathrooms ?><?php } ?> <?php _e("bath", 'es-plugin'); ?></span>
                                    </div>
                                    <div class="es_my_list_more clearfix">
                                        <a onclick="es_map_view_click(this); return false;"
                                           href="<?php if ($list[0]->prop_latitude != "" && $list[0]->prop_longitude != "") { ?><?php echo $list[0]->prop_latitude ?>,<?php echo $list[0]->prop_longitude;
                                           } ?>" class="es_map_view"><?php _e("View on map", 'es-plugin'); ?></a>
                                        <a href="<?php echo get_permalink($list[0]->prop_id); ?>"
                                           class="es_detail_btn"><?php _e("Details", 'es-plugin'); ?></a>
                                    </div>
                                </div>
                            </li>
                        <?php
                        endwhile;
                        ?>
                    </ul>
                </div>
                <div class="es_pagination">
                    <?php
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $properties_query->max_num_pages //custom query
                    ));
//                    echo paginate_links(); ?>
                </div>

                <div id="es_map_pop_outer">
                    <div id="es_map_pop">
                        <h2><?php _e("Map", 'es-plugin'); ?><a id="es_closePop" href="javascript:void(0)">×</a></h2>

                        <div id="es_map"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    else:
        ?>
    <div id="es_content" class="clearfix <?php
    if ($es_settings->listing_layout == '3') {
        echo 'es_3_column';
    } elseif ($es_settings->listing_layout == '2') {
        echo 'es_2_column';
    } else {
        echo 'es_single_column';
    }  ?>
    ">
        <div class="es_view_list_outer clearfix">
        <?php if ($category != 'all'): ?>
        <?php
        $term_object = get_term_by('slug', $category, 'property_category');
        ?>
        <div class="queriedHead">
            <h1><?php echo $term_object->name; ?> <?php _e("Properties", 'es-plugin'); ?></h1>
        </div>
        <?php if (is_active_sidebar('es-toppage-sidebar')) : ?>

            <?php dynamic_sidebar('es-toppage-sidebar'); ?>

        <?php endif; ?>
    <?php endif; ?>
        <div class="es_my_listing clearfix">
            <ul>
                <li class="es_no_record"><?php _e("No record found.", 'es-plugin'); ?></li>
            </ul>
        </div>
    <?php
    endif;
}
else{
    ?>
<div id="es_content" class="clearfix <?php
if ($es_settings->listing_layout == '3') {
    echo 'es_3_column';
} elseif ($es_settings->listing_layout == '2') {
    echo 'es_2_column';
} else {
    echo 'es_single_column';
}  ?>
    ">
    <div class="es_view_list_outer clearfix">
    <?php if ($category != 'all'): ?>
        <?php
        $term_object = get_term_by('slug', $category, 'property_category');
        ?>
        <div class="queriedHead">
            <h1><?php echo $term_object->name; ?> <?php _e("Properties", 'es-plugin'); ?></h1>
        </div>

    <?php endif; ?>
    <?php if (is_active_sidebar('es-toppage-sidebar')) : ?>

        <?php dynamic_sidebar('es-toppage-sidebar'); ?>

    <?php endif; ?>
    <div class="es_my_listing clearfix">
        <ul>
            <li class="es_no_record"><?php _e("No record found.", 'es-plugin'); ?></li>
        </ul>
    </div>
<?php
}