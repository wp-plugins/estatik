<?php
/*
Plugin Name: Estatik
Description: A simple version of Estatik Real Estate plugin for Wordpress.
Version: 1.1.1 
Author: Estatik
Author URI: http://www.estatik.net/
License: GPL2
Text Domain: es-plugin
Domain Path: /languages/
*/
 
ini_set('max_execution_time', 600);
ini_set('memory_limit', '128M');
define("DIR_URL",plugins_url().'/estatik/');
define("PATH_DIR",plugin_dir_path( __FILE__ ));
 
 
add_action( 'admin_menu', 'register_estatik' );
function register_estatik(){
 
	add_menu_page( 'Estatik', 'Estatik', 'manage_options', 'es_dashboard', 'es_dashboard', DIR_URL.'admin_template/images/es_menu_icon.png', '20.7' );
	add_submenu_page( 'es_dashboard', __( "Dashboard", "es-plugin" ), __( "Dashboard", "es-plugin" ), 'manage_options', 'es_dashboard', 'es_dashboard');
	add_submenu_page( 'es_dashboard', __( "My listings", "es-plugin" ), __( "My listings", "es-plugin" ), 'manage_options', 'es_my_listings', 'es_my_listings');
	add_submenu_page( 'es_dashboard', __( "Add New Property", "es-plugin" ), __( "Add New Property", "es-plugin" ), 'manage_options', 'es_add_new_property', 'es_add_new_property');
	add_submenu_page( 'es_dashboard', __( "Data Manager", "es-plugin" ), __( "Data Manager", "es-plugin" ), 'manage_options', 'es_data_manager', 'es_data_manager');
	add_submenu_page( 'es_dashboard', __( "Settings", "es-plugin" ), __( "Settings", "es-plugin" ), 'manage_options', 'es_settings', 'es_settings');
	add_submenu_page( 'es_dashboard', __( "Estatik Pro", "es-plugin" ), __( "Estatik Pro", "es-plugin" ), 'manage_options', 'es_pro', 'es_pro');

}
 
 
include("activation_deactivation_hook.php");

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


function es_plugin_version() {
	if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}

function es_load_plugin_textdomain(){
	load_plugin_textdomain( 'es-plugin', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' ); 
}
add_action( 'plugins_loaded', 'es_load_plugin_textdomain' );
