<?php

/*
Plugin Name: Booked Plugin Addon
Plugin URI: https://yourcodingmentor.com
Description: This plugin tests data access to Booked plugin fields..
Version: 1.0.0
Author: Moses Migwi
Author URI: https://yourcodingmentor.com
*/

//Enqueue scripts
function add_plugin_scripts() {
    wp_enqueue_style( 'css-style', plugin_dir_url( __FILE__ ) .'assets/css/css.css' );
    wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) .'assets/bootstrap/css/bootstrap.min.css' );
   
    wp_enqueue_script( 'script', plugin_dir_url( __FILE__ ) .'assets/js/js.js' );
  }
  add_action( 'admin_enqueue_scripts', 'add_plugin_scripts' );

//Require booked plugin main file
require_once plugin_dir_path(__FILE__) .'../booked/booked.php';


add_action( 'admin_menu', 'booked_addon_topmenu' );

function booked_addon_topmenu() {

    //Top menu
    // add_menu_page(
    //     'Booked AddOn',
    //     'Booked AddOn',
    //     'manage_options',
    //     'addon_top_menu',
    //     'top_menu_callback'
    // );


    add_submenu_page(
        'booked-appointments',
        'All Appointments',
        'All Appointments',
        'manage_options',
        'all-appointments',
        'all_appointments'
    );

    add_submenu_page(
        'booked-appointments',
        'Export',
        'Export',
        'manage_options',
        'export',
        'export'
    );

    add_submenu_page(
        'booked-appointments',
        'SMS Notifications',
        'SMS Notifications',
        'manage_options',
        'sms-notifications',
        'sms_notifications'
    );
}

function all_appointments(){
    require plugin_dir_path(__FILE__) . 'admin/view-appointments.php';
}

function export(){
    require plugin_dir_path(__FILE__) . 'admin/export.php';
}

function sms_notifications(){
    require plugin_dir_path(__FILE__) . 'admin/sms-notifications.php';
}

