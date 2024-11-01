<?php

/*
Plugin Name: Wave Admin Theme
Plugin URI: http://git.happybrain.it/wave-admin-theme
Description: Customize the Admin Theme of WordPress.
Author: Happy Brain
Version: 1.0
Author URI: http://www.happybrain.it
*/

require_once( plugin_dir_path( __FILE__ ) . 'settings.php' );

// Left admin footer text
add_filter('admin_footer_text', 'left_admin_footer_text_output');
function left_admin_footer_text_output($text) {
    $options = get_option( 'wat_settings' );
    return $options['wat_text_field_0'];
}

// Right admin footer text 
add_filter('update_footer', 'right_admin_footer_text_output', 11);
function right_admin_footer_text_output($text) {
    $options = get_option( 'wat_settings' );
    return $options['wat_text_field_1'];
}

// Change page title in admin area
add_filter('admin_title', 'wat_admin_title', 10, 2);
function wat_admin_title($admin_title, $title){
    return get_bloginfo('name').' | '.$title;
}

// Remove admin color scheme picker
$options = get_option( 'wat_settings' );
if (isset($options['wat_checkbox_field_6'])) {
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
}

// Hide Help tab
add_action('admin_head', 'hide_help');
function hide_help() {
	$options = get_option( 'wat_settings' );
	if (isset($options['wat_checkbox_field_4'])) {
    	echo '<style type="text/css">#contextual-help-link-wrap { display: none !important; }</style>';
    }
}

// Remove screen options tab
add_filter('screen_options_show_screen', 'remove_screen_options_tab');
function remove_screen_options_tab() {
	$options = get_option( 'wat_settings' );
	if (!isset($options['wat_checkbox_field_5'])){
		return TRUE;
	}
}

// Customize the admin theme style
add_action('admin_enqueue_scripts', 'wat_admin_theme_style');
add_action('login_enqueue_scripts', 'wat_admin_theme_style');
function wat_admin_theme_style() {
    wp_enqueue_style('wave-admin-theme', plugins_url('wp-admin.css', __FILE__));
}

// Changing the sender address of the email system
add_filter('wp_mail_from', 'wat_mail_from');
function wat_mail_from($old){
	return get_option('admin_email');
}

// Changing the sender name of the email system
add_filter('wp_mail_from_name', 'wat_mail_from_name');
function wat_mail_from_name($old){
	return get_bloginfo('name');
}

// Remove the WordPress Logo from the Toolbar
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
function remove_wp_logo( $wp_admin_bar ) {
	$options = get_option( 'wat_settings' );
	if (isset($options['wat_checkbox_field_7'])) {
		$wp_admin_bar->remove_node( 'wp-logo' );
	}
}

?>