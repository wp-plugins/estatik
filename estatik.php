<?php
/*
Plugin Name: Estatik
Description: A simple version of Estatik Real Estate plugin for Wordpress.
Version: 1.0
Author: Estatik
Author URI: http://www.estatik.net/
License: GPL2
*/
 
ini_set('max_execution_time', 600);
ini_set('memory_limit', '128M');
define("DIR_URL",plugins_url().'/estatik/');
define("PATH_DIR",plugin_dir_path( __FILE__ ));
 
 
add_action( 'admin_menu', 'register_estatik' );
function register_estatik(){
 
	add_menu_page( 'Estatik', 'Estatik', 'manage_options', 'es_dashboard', 'es_dashboard', DIR_URL.'admin_template/images/es_menu_icon.png', 16 );
	add_submenu_page( 'es_dashboard', 'Dashboard', 'Dashboard', 'manage_options', 'es_dashboard', 'es_dashboard');
	add_submenu_page( 'es_dashboard', 'My Listings', 'My Listings', 'manage_options', 'es_my_listings', 'es_my_listings');
	add_submenu_page( 'es_dashboard', 'Add New Property', 'Add New Property', 'manage_options', 'es_add_new_property', 'es_add_new_property');
	add_submenu_page( 'es_dashboard', 'Data Manager', 'Data Manager', 'manage_options', 'es_data_manager', 'es_data_manager'); 
	add_submenu_page( 'es_dashboard', 'Settings', 'Settings', 'manage_options', 'es_settings', 'es_settings');
	add_submenu_page( 'es_dashboard', 'Estatik Pro', 'Estatik Pro', 'manage_options', 'es_pro', 'es_pro');

}
 
 
include("activtion_deaction_hook.php");

register_activation_hook( __FILE__, 'estatik_activate' );
register_deactivation_hook( __FILE__, 'estatik_de_activate' );
register_uninstall_hook( __FILE__, 'estatik_uninstall' );
 
 
function es_dashboard(){
	include("admin_template/es_dashboard.php");
}

function es_my_listings(){
	include("admin_template/es_property/es_my_listings.php");
}

function es_add_new_property(){
	include("admin_template/es_property/es_add_new_property.php");
}

function es_import_csv_property(){
	include("admin_template/es_property/es_import_csv_property.php");
}

function es_data_manager(){
	include("admin_template/es_manager/es_data_manager.php");
}
 
function es_settings(){
	include("admin_template/es_settings.php");
}

function es_pro(){
	include("admin_template/es_pro.php");
}

 
require_once('admin_template/es_admin_functions.php');

require_once('front_templates/es_front_functions.php');

require_once('front_templates/es_shortcodes.php');




 