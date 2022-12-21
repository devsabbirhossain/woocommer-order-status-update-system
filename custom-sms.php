<?php
/*
 * Plugin Name: Custom SMS System
 * Plugin URI: https://softtechiit.com
 * Description: Custom SMS Plugin For Tracking Customer Order Updates.
 * Author: Sabbir Hossain
 * Author URI: https://github.com/devsabbirhossain
 * Version: 1.0.0
 * Text Domain: stit
 */

	if ( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly
	}

	if(file_exists(plugin_dir_path( __FILE__ ) . '/include/sms-generator.php')){
		require_once(plugin_dir_path( __FILE__ ) . '/include/sms-generator.php');
	}

	if(file_exists(plugin_dir_path( __FILE__ ) . '/include/admin/sms-template.php')){
		require_once(plugin_dir_path( __FILE__ ) . '/include/admin/sms-template.php');
	}

	add_action( 'admin_enqueue_scripts', 'plugin_admin_init' );
    function plugin_admin_init(){
        wp_enqueue_style( 'bootstrap-plugin', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
        wp_enqueue_style( 'custom-plugin-style', plugins_url( '/assets/css/style.css', __FILE__ ));
        wp_enqueue_script( 'customs-plugin-js', plugins_url( '/assets/js/custom.js', __FILE__ ), array('jquery'), '1.0' );
    }