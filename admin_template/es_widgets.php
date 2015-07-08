<?php
// Search widget Start
class es_search extends WP_Widget {
	// constructor
	function es_search() {
	        parent::WP_Widget(false, $name = __('Estatik Search', 'es-plugin') );
	}
	// widget form creation
	function form($instance) {
		// Check values
 
		if( $instance) {
			$search_title 		= esc_attr($instance['search_title']);
			$search_address 	= esc_attr($instance['search_address']);
			$search_price 		= esc_attr($instance['search_price']);
			$search_bedrooms 	= esc_attr($instance['search_bedrooms']);
			$search_bathrooms 	= esc_attr($instance['search_bathrooms']);
			$search_category 	= esc_attr($instance['search_category']);
			$search_type 		= esc_attr($instance['search_type']);
			$search_sqft 		= esc_attr($instance['search_sqft']);
			$search_lotsize 	= esc_attr($instance['search_lotsize']);
			$search_keywords 	= esc_attr($instance['search_keywords']);
			$search_layout 		= esc_attr($instance['search_layout']);
	 
			$show_on_pages 		= esc_attr($instance['show_on_pages']);
			$pages_args = array(
				'sort_order' => 'ASC',
				'sort_column' => 'post_title',
				'post_type' => 'page',
				'post_status' => 'publish'
			); 
			$pages = get_pages($pages_args);
			foreach ($pages as $page ){
				esc_attr($instance["page_field_".$page->ID]);
			}
			
			$archive_page 		= esc_attr($instance['archive_page']);
			$single_page 		= esc_attr($instance['single_page']);
			$category_page 		= esc_attr($instance['category_page']);
			$search_page 		= esc_attr($instance['search_page']);
			$author_page 		= esc_attr($instance['author_page']);
            $search_page_id = get_option('es_search_page');

		} 
		?>
        <p>
			<label><?php _e('Search Title:', 'es-plugin'); ?></label><br />
			<input class="widefat" name="<?php echo $this->get_field_name('search_title'); ?>" type="text" value="<?php if(isset($search_title)) { echo $search_title; }else{ echo ''; } ?>"/>
		</p>  
        <p>
			<label><?php _e('Address:', 'es-plugin'); ?></label><br />
            <?php $search_address = (isset($search_address)) ? $search_address : '1'; ?> 
			<label style="margin-right:10px;"><input name="<?php echo $this->get_field_name('search_address'); ?>" type="radio" value="1" <?php checked( '1', $search_address ); ?>/><?php _e('Yes', 'es-plugin'); ?></label>
			<label><input name="<?php echo $this->get_field_name('search_address'); ?>" type="radio" value="0" <?php checked( '0', $search_address ); ?>/><?php _e('No', 'es-plugin'); ?></label>
		</p> 
		<p>
			<label><?php _e('Price:', 'es-plugin'); ?></label><br />
			<?php $search_price = (isset($search_price)) ? $search_price : '1'; ?> 
            <label style="margin-right:10px;"><input name="<?php echo $this->get_field_name('search_price'); ?>" type="radio" value="1" <?php checked( '1', $search_price ); ?>/><?php _e('Yes', 'es-plugin'); ?></label>
			<label><input name="<?php echo $this->get_field_name('search_price'); ?>" type="radio" value="0" <?php checked( '0', $search_price ); ?>/><?php _e('No', 'es-plugin'); ?></label>
		</p>  
		<p>
			<label><?php _e('Bedrooms:', 'es-plugin'); ?></label><br />
            <?php $search_bedrooms = (isset($search_bedrooms)) ? $search_bedrooms : '1'; ?> 
			<label style="margin-right:10px;"><input name="<?php echo $this->get_field_name('search_bedrooms'); ?>" type="radio" value="1" <?php checked( '1', $search_bedrooms ); ?>/><?php _e('Yes', 'es-plugin'); ?></label>
			<label><input name="<?php echo $this->get_field_name('search_bedrooms'); ?>" type="radio" value="0" <?php checked( '0', $search_bedrooms ); ?>/><?php _e('No', 'es-plugin'); ?></label>
		</p>  
		<p>
			<label><?php _e('Bathrooms:', 'es-plugin'); ?></label><br />
			<?php $search_bathrooms = (isset($search_bathrooms)) ? $search_bathrooms : '1'; ?> 
            <label style="margin-right:10px;"><input name="<?php echo $this->get_field_name('search_bathrooms'); ?>" type="radio" value="1" <?php checked( '1', $search_bathrooms ); ?>/><?php _e('Yes', 'es-plugin'); ?></label>
			<label><input name="<?php echo $this->get_field_name('search_bathrooms'); ?>" type="radio" value="0" <?php checked( '0', $search_bathrooms ); ?>/><?php _e('No', 'es-plugin'); ?></label>
		</p>  
		<p>
			<label><?php _e('Category:', 'es-plugin'); ?></label><br />
			<?php $search_category = (isset($search_category)) ? $search_category : '1'; ?> 
            <label style="margin-right:10px;"><input name="<?php echo $this->get_field_name('search_category'); ?>" type="radio" value="1" <?php checked( '1', $search_category ); ?>/><?php _e('Yes', 'es-plugin'); ?></label>
			<label><input name="<?php echo $this->get_field_name('search_category'); ?>" type="radio" value="0" <?php checked( '0', $search_category ); ?>/><?php _e('No', 'es-plugin'); ?></label>
		</p>  
		<p>
			<label><?php _e('Type:', 'es-plugin'); ?></label><br />
			<?php $search_type = (isset($search_type)) ? $search_type : '1'; ?> 
            <label style="margin-right:10px;"><input name="<?php echo $this->get_field_name('search_type'); ?>" type="radio" value="1" <?php checked( '1', $search_type ); ?>/><?php _e('Yes', 'es-plugin'); ?></label>
			<label><input name="<?php echo $this->get_field_name('search_type'); ?>" type="radio" value="0" <?php checked( '0', $search_type ); ?>/><?php _e('No', 'es-plugin'); ?></label>
		</p> 
		<p>
			<label><?php _e('Sqft:', 'es-plugin'); ?></label><br />
			<?php $search_sqft = (isset($search_sqft)) ? $search_sqft : '1'; ?> 
            <label style="margin-right:10px;"><input name="<?php echo $this->get_field_name('search_sqft'); ?>" type="radio" value="1" <?php checked( '1', $search_sqft ); ?>/><?php _e('Yes', 'es-plugin'); ?></label>
			<label><input name="<?php echo $this->get_field_name('search_sqft'); ?>" type="radio" value="0" <?php checked( '0', $search_sqft ); ?>/><?php _e('No', 'es-plugin'); ?></label>
		</p> 
		<p>
			<label><?php _e('Lot size:', 'es-plugin'); ?></label><br />
			<?php $search_lotsize = (isset($search_lotsize)) ? $search_lotsize : '1'; ?>
            <label style="margin-right:10px;"><input name="<?php echo $this->get_field_name('search_lotsize'); ?>" type="radio" value="1" <?php checked( '1', $search_lotsize ); ?>/><?php _e('Yes', 'es-plugin'); ?></label>
			<label><input name="<?php echo $this->get_field_name('search_lotsize'); ?>" type="radio" value="0" <?php checked( '0', $search_lotsize ); ?>/><?php _e('No', 'es-plugin'); ?></label>
		</p>  
		<p>
			<label><?php _e('Keywords:', 'es-plugin'); ?></label><br />
			<?php $search_keywords = (isset($search_keywords)) ? $search_keywords : '1'; ?>
            <label style="margin-right:10px;"><input name="<?php echo $this->get_field_name('search_keywords'); ?>" type="radio" value="1" <?php checked( '1', $search_keywords ); ?>/><?php _e('Yes', 'es-plugin'); ?></label>
			<label><input name="<?php echo $this->get_field_name('search_keywords'); ?>" type="radio" value="0" <?php checked( '0', $search_keywords ); ?>/><?php _e('No', 'es-plugin'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('search_layout'); ?>"><?php _e('Layout', 'es-plugin'); ?></label>
			<?php $search_layout = (isset($search_layout)) ? $search_layout : 'horizontal'; ?>
            <select name="<?php echo $this->get_field_name('search_layout'); ?>" id="<?php echo $this->get_field_id('search_layout'); ?>" class="widefat">
				<?php
				$options = array('horizontal', 'vertical');
				foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $search_layout == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				?>
			</select>
		</p> 
		
		        <p>
            <label for="<?php echo 'search_page' ?>"><?php _e('Search page', 'es-plugin'); ?></label>
            <select name="<?php echo $this->get_field_name('search_page'); ?>" id="<?php echo $this->get_field_id('search_page'); ?>" class="widefat">
                <?php
                $pages = get_pages($pages_args);
                foreach ($pages as $page ){ ?>
                    <option value="<?php echo $page->ID;  ?>" <?php selected($search_page_id, $page->ID); ?>><?php echo get_the_title($page->ID); ?></option>
                <?php }  ?>

            </select>
        </p>
        
        
        <p>
			<label for="<?php echo $this->get_field_id('show_on_pages'); ?>"><?php _e('Show On Pages', 'es-plugin'); ?></label>
			<?php $show_on_pages = (isset($show_on_pages)) ? $show_on_pages : 'all_pages'; ?>
            <select name="<?php echo $this->get_field_name('show_on_pages'); ?>" id="<?php echo $this->get_field_id('show_on_pages'); ?>" class="widefat">
				<?php
				$options = array('all_pages','show_on_checked_pages', 'hide_on_checked_pages');
				foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $show_on_pages == $option ? ' selected="selected"' : '', '>',  str_replace("_"," ",$option),  '</option>';
				}
				?>
			</select>
		</p> 
        <p> 
			<label><?php _e('Select Pages', 'es-plugin'); ?></label>
        </p>
		<div style="height: 200px; overflow-x: hidden; margin-bottom:10px; overflow-y: scroll; padding-top: 2px;">
			<?php
            $pages_args = array(
                'sort_order' => 'ASC',
                'sort_column' => 'post_title',
                'post_type' => 'page',
                'post_status' => 'publish'
            ); 
            $pages = get_pages($pages_args);
            foreach ($pages as $page ){
                $page_field = esc_attr(@$instance["page_field_".$page->ID]);
                $page_field_val = (isset($page_field)) ? $page_field : '';
                $page_title = $page->post_title;
                $page_field_name = "page_field_".$page->ID;	
            ?>
                <p>
                    <label><input name="<?php echo $this->get_field_name($page_field_name); ?>" type="checkbox" value="<?php echo $page->ID?>" <?php checked( $page->ID, $page_field_val ); ?>/><?php _e($page_title); ?></label>
                </p> 
            <?php } ?>
            
            <p>
                <?php $archive_page = (isset($archive_page)) ? $archive_page : '0'; ?>
                <label><input name="<?php echo $this->get_field_name('archive_page'); ?>" type="checkbox" value="archive_page" <?php checked( 'archive_page', $archive_page ); ?>/><?php _e('Archive Page', 'es-plugin'); ?></label>
            </p>
            <p>
                <?php $single_page = (isset($single_page)) ? $single_page : '0'; ?>
                <label><input name="<?php echo $this->get_field_name('single_page'); ?>" type="checkbox" value="single_page" <?php checked( 'single_page', $single_page ); ?>/><?php _e('Single Page', 'es-plugin'); ?></label>
            </p>
            <p>
                <?php $category_page = (isset($category_page)) ? $category_page : '0'; ?>
                <label><input name="<?php echo $this->get_field_name('category_page'); ?>" type="checkbox" value="category_page" <?php checked( 'category_page', $category_page ); ?>/><?php _e('Category Page', 'es-plugin'); ?></label>
            </p>
            <p>
                <?php $search_page = (isset($search_page)) ? $search_page : '0'; ?>
                <label><input name="<?php echo $this->get_field_name('search_page'); ?>" type="checkbox" value="search_page" <?php checked( 'search_page', $search_page ); ?>/><?php _e('Search Page', 'es-plugin'); ?></label>
            </p>
            <p>
                <?php $author_page = (isset($author_page)) ? $author_page : '0'; ?>
                <label><input name="<?php echo $this->get_field_name('author_page'); ?>" type="checkbox" value="author_page" <?php checked( 'author_page', $author_page ); ?>/><?php _e('Author Page', 'es-plugin'); ?></label>
            </p>
        
        </div>
        
        
<?php  }
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
 
		$instance['search_title'] 		= strip_tags($new_instance['search_title']);
		$instance['search_address'] 	= strip_tags($new_instance['search_address']);
		$instance['search_price'] 		= strip_tags($new_instance['search_price']);
		$instance['search_bedrooms'] 	= strip_tags($new_instance['search_bedrooms']);
		$instance['search_bathrooms']	= strip_tags($new_instance['search_bathrooms']);
		$instance['search_category'] 	= strip_tags($new_instance['search_category']);
		$instance['search_type'] 		= strip_tags($new_instance['search_type']);
		$instance['search_sqft'] 		= strip_tags($new_instance['search_sqft']);
		$instance['search_lotsize'] 	= strip_tags($new_instance['search_lotsize']);
		$instance['search_keywords'] 	= strip_tags($new_instance['search_keywords']);
		$instance['search_layout'] 		= strip_tags($new_instance['search_layout']);
		
		$instance['show_on_pages'] 		= strip_tags($new_instance['show_on_pages']);
		$pages_args = array(
			'sort_order' => 'ASC',
			'sort_column' => 'post_title',
			'post_type' => 'page',
			'post_status' => 'publish'
		); 
		$pages = get_pages($pages_args);
		foreach ($pages as $page ){
			$instance["page_field_".$page->ID] = strip_tags($new_instance["page_field_".$page->ID]);
		}
		
		$instance['archive_page'] 		= strip_tags($new_instance['archive_page']);
		$instance['single_page'] 		= strip_tags($new_instance['single_page']);
		$instance['category_page'] 		= strip_tags($new_instance['category_page']);
		        $instance['search_page']        = strip_tags($new_instance['search_page']);
        update_option('es_search_page', $instance['search_page']);

		$instance['author_page'] 		= strip_tags($new_instance['author_page']);
 
		return $instance;
	}
   // display widget
	function widget($args, $instance) {
		extract( $args );
		// these are the widget options
		$search_title 		= esc_attr($instance['search_title']);
		$search_address 	= esc_attr($instance['search_address']);
		$search_price 		= esc_attr($instance['search_price']);
		$search_bedrooms 	= esc_attr($instance['search_bedrooms']);
		$search_bathrooms 	= esc_attr($instance['search_bathrooms']);
		$search_category 	= esc_attr($instance['search_category']);
		$search_type 		= esc_attr($instance['search_type']);
		$search_sqft 		= esc_attr($instance['search_sqft']);
		$search_lotsize 	= esc_attr($instance['search_lotsize']);
		$search_keywords 	= esc_attr($instance['search_keywords']);
		$search_layout 		= esc_attr($instance['search_layout']);
		
		$show_on_pages 		= esc_attr($instance['show_on_pages']);
		$pages_args = array(
			'sort_order' => 'ASC',
			'sort_column' => 'post_title',
			'post_type' => 'page',
			'post_status' => 'publish'
		); 
		$pages = get_pages($pages_args);
		$choosed_pages = array();
		foreach ($pages as $page ){
			$choosed_pages[] = esc_attr($instance["page_field_".$page->ID]);
		}
		
		$choosed_pages[]  	= esc_attr($instance['archive_page']);
		$choosed_pages[]  	= esc_attr($instance['single_page']);
		$choosed_pages[] 	= esc_attr($instance['category_page']);
		$choosed_pages[]   	= esc_attr($instance['search_page']);
		$choosed_pages[]   	= esc_attr($instance['author_page']);
 
		$widget_id 			= $args['widget_id'];
		
		$choosed_pages['widget_id'] = $widget_id;
		
		$before_widget 		= $args['before_widget'] = '<div class="widget '.$args['widget_id'].'">';
		$after_widget 		= $args['after_widget'] = '</div>';
		
		echo $before_widget;
		include(PATH_DIR.'front_templates/widgets/es_search.php');		
		echo $after_widget;
	}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("es_search");')); 
 