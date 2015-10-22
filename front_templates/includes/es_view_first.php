<div class="es_view_list_outer clearfix">
    <?php
	
	$queried_object = get_queried_object();
	
	if(isset($search_page) && $search_page==1){?>
    	
        <h1><?php _e("Search", 'es-plugin'); ?></h1>
        
	<?php } else if(isset($category_page) && $category_page==1){ ?>
    	
        <?php if($queried_object->name!=""){ ?>
			<div class="queriedHead"><h1><?php echo $queried_object->name?> <?php _e("Properties", 'es-plugin'); ?></h1></div>
		<?php } ?>
        
    <?php } else if(isset($author_page) && $author_page==1){ ?>
    	 
		<?php if($queried_object->user_login!=""){ ?>
			<div class="queriedHead"><h1><?php _e("Properties by Agent", 'es-plugin'); ?> <?php echo $queried_object->user_login?></h1></div>
		<?php } ?>
        
    <?php } else { ?>
    
    	<h1><?php the_title(); ?></h1>
    
    <?php } ?>
    
    <div class="es_view_list clearfix">
        <label><?php _e("View first", 'es-plugin'); ?>:</label>
        <div class="es_view_list_links clearfix">
            <?php
				$menu = wp_nav_menu(
					array (
					'echo' => FALSE,
					'menu'            => 'view_first', 
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => '',
					'menu_id'         => '',
					'fallback_cb' => false,
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				
				if (!empty($menu))
				{
					echo $menu;
				}else{
					echo "<p>".__("Menu is empty.", 'es-plugin')."</p>";
				}
				 
			 ?>
        </div>
    </div>
</div>