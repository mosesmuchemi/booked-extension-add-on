<?php

/*
Plugin Name: Booked Plugin Addon
Plugin URI: https://yourcodingmentor.com
Description: This plugin tests data access to Booked plugin fields..
Version: 1.0.0
Author: Moses Migwi
Author URI: https://yourcodingmentor.com
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

//check if Booked plugin is active
if ( ! in_array( 'booked/booked.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
return;

//Enqueue scripts
function add_plugin_scripts() {
    wp_enqueue_style( 'css-style', plugin_dir_url( __FILE__ ) .'assets/css/css.css' );
   
    wp_enqueue_script( 'script', plugin_dir_url( __FILE__ ) .'assets/js/js.js' );

    wp_enqueue_script('jquery-ui-datepicker');
    
    wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

  }
  add_action( 'admin_enqueue_scripts', 'add_plugin_scripts' );

//Require booked plugin main file
require_once plugin_dir_path(__FILE__) .'../booked/booked.php';
// Require booked addon SMS functions
require_once plugin_dir_path(__FILE__) .'includes/sms-functions.php';


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

//Export all appointments
add_action( 'admin_init','export_file');

function export_file(){
if (isset($_POST['booked_addon_csv']) || isset($_POST['from_date']) && isset($_POST['to_date'])):
    include('includes/addon-export-csv.php');
endif;
}

add_action( 'admin_init', 'addonsms_register_settings' );

function addonsms_register_settings() {
    $sms_enable = $_POST['sms_control'] ;
    $sid = $_POST['account_sid'];
    $auth = $_POST['auth_token'];
    
    add_option('sms_control',$sms_enable);
    add_option('account_sid',$sid);
    add_option('auth_token',$auth);
    register_setting( 'sms_options_group', 'sms_control', 'myplugin_callback' );
    register_setting( 'sms_options_group', 'account_sid', 'myplugin_callback' );
    register_setting( 'sms_options_group', 'auth_token', 'myplugin_callback' );
 }
