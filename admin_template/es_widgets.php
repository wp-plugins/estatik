<?php
// Search widget Start
class es_search extends WP_Widget {
	// constructor
	function __construct() {
	        parent::__construct(false, $name = __('Estatik Search', 'es-plugin') );
	}

	private function form_checkbox($title, $property_name, $property_value) {
		?>
	        <li class="wrap" style="margin-top: 15px">
				<label><?php echo $title; ?></label><br />
	            <?php 
	            	$value = (isset($property_value)) ? $property_value : '1'; 
	            	$field_name = $this->get_field_name($property_name);
            	?> 
				<label style="margin-right:10px;">
					<input name="<?php echo $field_name; ?>" 
						   type="radio" value="1" 
						   <?php checked( '1', $value ); ?>/>
						   <?php _e('Yes', 'es-plugin'); ?>
			    </label>
				<label>
					<input name="<?php echo $field_name; ?>" 
						   type="radio" value="0" 
						   <?php checked( '0', $value ); ?>/>
						   <?php _e('No', 'es-plugin'); ?>
			    </label>
			</li> 
		<?php
	}

	// widget form creation
	function form($instance) {

        $defaults = array(
			'search_title' => '',
			'search_address' => '0',
			'search_country' => '0',
			'search_state' => '0',
			'search_city' => '0',
			'search_price' => '0',
			'search_bedrooms' => '0',
			'search_bathrooms' => '0',
			'search_category' => '0',
			'search_type' => '0',
			'search_sqft' => '0',
			'search_lotsize' => '0',
			'search_agent' => '0',
			'search_keywords' => '0',
			'search_layout' => '',
            'search_page' => '',
	 		'show_on_pages' => '',
			'archive_page' => '',
			'single_page' => '',
			'category_page' => '',
			'search_page' => '',
			'author_page' => '',
        );


		$instance = wp_parse_args( (array) $instance, $defaults );

		// Check values
 
		if( $instance) {
			$search_title 		= esc_attr($instance['search_title']);
			$search_address 	= esc_attr($instance['search_address']);
			$search_country		= esc_attr($instance['search_country']);
			$search_state 		= esc_attr($instance['search_state']);
			$search_city 		= esc_attr($instance['search_city']);
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
		<ul>
	        <li>
				<label><?php _e('Search Title:', 'es-plugin'); ?></label>
				<input class="widefat" 
					   name="<?php echo $this->get_field_name('search_title'); ?>" 
					   type="text" 
					   value="<?php echo isset($search_title) ? $search_title : ''; ?>"/>
			</li>
			<?php 
				$this->form_checkbox(__('Address:', 'es-plugin'), 
					'search_address', $search_address);
				$this->form_checkbox(__('Country:', 'es-plugin'), 
					'search_country', $search_country);
				$this->form_checkbox(__('State/Region:', 'es-plugin'), 
					'search_state', $search_state);
				$this->form_checkbox(__('City:', 'es-plugin'), 
					'search_city', $search_city);
				$this->form_checkbox(__('Price:', 'es-plugin'), 
					'search_price', $search_price);
				$this->form_checkbox(__('Bedrooms:', 'es-plugin'), 
					'search_bedrooms', $search_bedrooms);
				$this->form_checkbox(__('Bathrooms:', 'es-plugin'), 
					'search_bathrooms', $search_bathrooms);
				$this->form_checkbox(__('Category:', 'es-plugin'), 
					'search_category', $search_category);
				$this->form_checkbox(__('Type:', 'es-plugin'), 
					'search_type', $search_type);
				$this->form_checkbox(__('Sqft:', 'es-plugin'), 
					'search_sqft', $search_sqft);
				$this->form_checkbox(__('Lot size:', 'es-plugin'), 
					'search_lotsize', $search_lotsize);
				$this->form_checkbox(__('Agent:', 'es-plugin'), 
					'search_agent', $search_agent);
				$this->form_checkbox(__('Keywords:', 'es-plugin'), 
					'search_keywords', $search_keywords);
			?>

			<li class="wrap" style="margin-top: 15px">
				<label for="<?php echo $this->get_field_id('search_layout'); ?>">
					<?php _e('Layout', 'es-plugin'); ?>
				</label>
				<?php $search_layout = (isset($search_layout)) ? $search_layout : 'horizontal'; ?>
	            <select name="<?php echo $this->get_field_name('search_layout'); ?>" id="<?php echo $this->get_field_id('search_layout'); ?>" class="widefat">
					<?php
					$options = array('horizontal', 'vertical');
					foreach ($options as $option) {
						echo '<option value="' . $option . '" id="' . $option . '"', $search_layout == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
					?>
				</select>
			</li>

	        <li class="wrap" style="margin-top: 15px">
	            <label for="<?php echo 'search_page' ?>"><?php _e('Search page', 'es-plugin'); ?></label>
	            <select name="<?php echo $this->get_field_name('search_page'); ?>" id="<?php echo $this->get_field_id('search_page'); ?>" class="widefat">
	                <?php
	                $pages = get_pages($pages_args);
	                foreach ($pages as $page ){ ?>
	                    <option value="<?php echo $page->ID;  ?>" <?php selected($search_page_id, $page->ID); ?>><?php echo get_the_title($page->ID); ?></option>
	                <?php }  ?>

	            </select>
	        </li>
	        
	        <li class="wrap" style="margin-top: 15px">
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
			</li>

        </ul>
		<div style="height: 200px; overflow-x: hidden; margin-bottom:10px; overflow-y: scroll; padding-top: 2px;">
			<label><?php _e('Select Pages', 'es-plugin'); ?></label>
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
                <div class="wrap">
                    <label><input name="<?php echo $this->get_field_name($page_field_name); ?>" type="checkbox" value="<?php echo $page->ID?>" <?php checked( $page->ID, $page_field_val ); ?>/><?php _e($page_title); ?></label>
                </div> 
            <?php } ?>
            
            <div class="wrap">
                <?php $archive_page = (isset($archive_page)) ? $archive_page : '0'; ?>
                <label><input name="<?php echo $this->get_field_name('archive_page'); ?>" type="checkbox" value="archive_page" <?php checked( 'archive_page', $archive_page ); ?>/><?php _e('Archive Page', 'es-plugin'); ?></label>
            </div>
            <div class="wrap">
                <?php $single_page = (isset($single_page)) ? $single_page : '0'; ?>
                <label><input name="<?php echo $this->get_field_name('single_page'); ?>" type="checkbox" value="single_page" <?php checked( 'single_page', $single_page ); ?>/><?php _e('Single Page', 'es-plugin'); ?></label>
            </div>
            <div class="wrap">
                <?php $category_page = (isset($category_page)) ? $category_page : '0'; ?>
                <label><input name="<?php echo $this->get_field_name('category_page'); ?>" type="checkbox" value="category_page" <?php checked( 'category_page', $category_page ); ?>/><?php _e('Category Page', 'es-plugin'); ?></label>
            </div>
            <div class="wrap">
                <?php $search_page = (isset($search_page)) ? $search_page : '0'; ?>
                <label><input name="<?php echo $this->get_field_name('search_page'); ?>" type="checkbox" value="search_page" <?php checked( 'search_page', $search_page ); ?>/><?php _e('Search Page', 'es-plugin'); ?></label>
            </div>
            <div class="wrap">
                <?php $author_page = (isset($author_page)) ? $author_page : '0'; ?>
                <label><input name="<?php echo $this->get_field_name('author_page'); ?>" type="checkbox" value="author_page" <?php checked( 'author_page', $author_page ); ?>/><?php _e('Author Page', 'es-plugin'); ?></label>
            </div>
        
        </div>
                
<?php  }
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
 
		$instance['search_title'] 		= strip_tags($new_instance['search_title']);
		$instance['search_address'] 	= strip_tags($new_instance['search_address']);
		$instance['search_country'] 	= strip_tags($new_instance['search_country']);
		$instance['search_state'] 		= strip_tags($new_instance['search_state']);
		$instance['search_city'] 		= strip_tags($new_instance['search_city']);
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
		$search_country 	= esc_attr($instance['search_country']);
		$search_state 		= esc_attr($instance['search_state']);
		$search_city 		= esc_attr($instance['search_city']);
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
			$page_index = "page_field_{$page->ID}";
			if ( isset($instance[$page_index]) ) {
				$choosed_pages[] = esc_attr($instance[$page_index]);
			}
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