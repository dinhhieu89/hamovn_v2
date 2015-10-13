<?php
/*
Plugin Name: Creativ Shortcodes
Plugin URI: http://pixelatedminds.com/plugins
Description: A powerful yet easy to use shortcodes plugin.
Version: 1.0.2
Author: Jonathan Atkinson
Author URI: http://cr3ativ.com
*/

/* Variables */
$ja_creativ_shortcodes_path = dirname(__FILE__);
$ja_creativ_shortcodes_main_file = dirname(__FILE__).'/creativ-shortcodes.php';
$ja_creativ_shortcodes_directory = plugin_dir_url($ja_creativ_shortcodes_main_file);
$ja_creativ_shortcodes_name = "creativ Shortcodes";

/* Add shortcodes scripts file */
function creativ_shortcodes_add_scripts() {
	global $ja_creativ_shortcodes_directory, $ja_creativ_shortcodes_path;
	if(!is_admin()) {
		
		/* Includes */
		include($ja_creativ_shortcodes_path.'/includes/shortcodes.php');

		wp_enqueue_style('creativ_shortcodes', $ja_creativ_shortcodes_directory.'/includes/shortcodes.css');
		
		wp_enqueue_script('jquery');
		wp_register_script('creativ_shortcodes_js', $ja_creativ_shortcodes_directory.'/includes/shortcodes.js', 'jquery');
		wp_enqueue_script('creativ_shortcodes_js');
		
	} else {
		
		wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script( 'wp-color-picker' );
	    		
	}
	
	/* Font Awesome */
	wp_enqueue_style('creativ_shortcodes_fontawesome', $ja_creativ_shortcodes_directory.'/fonts/fontawesome/css/font-awesome.min.css');
	wp_enqueue_style('creativ_shortcodes_fontello', $ja_creativ_shortcodes_directory.'/fonts/fontello/css/fontello.css');
	
}
add_filter('init', 'creativ_shortcodes_add_scripts');

/* Add button to TinyMCE */
function creativ_shortcodes_addbuttons() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_creativ_shortcodes_tinymce_plugin");
     add_filter('mce_buttons', 'register_creativ_shortcodes_button');
   }
}
 
function register_creativ_shortcodes_button($buttons) {
   array_push($buttons, "|", "creativ_shortcodes_button");
   return $buttons;
}
 
function add_creativ_shortcodes_tinymce_plugin($plugin_array) {
	global $ja_creativ_shortcodes_directory;
	$plugin_array['creativ_shortcodes'] = $ja_creativ_shortcodes_directory.'includes/tinymce_button.js';
	return $plugin_array;
}
 
add_action('init', 'creativ_shortcodes_addbuttons');

