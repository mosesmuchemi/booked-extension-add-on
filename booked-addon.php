<?php

/*
Plugin Name: Booked Extension Add-on
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

//Require booked plugin main file
require_once plugin_dir_path(__FILE__) .'../booked/booked.php';
require_once plugin_dir_path(__FILE__) .'includes/sms-functions.php';


if(!class_exists('booked_addon_extension')) {
	class booked_addon_extension {

        public function __construct() {

            add_action( 'admin_menu', array( $this,'booked_addon_topmenu' ) );

            add_action( 'admin_enqueue_scripts', array( $this, 'add_plugin_scripts' ) );

            add_action( 'admin_init', array( $this,'export_file' ) );

            add_action( 'admin_init', array( $this,'addonsms_register_settings' ) );

        }

        //Enqueue scripts
        public function add_plugin_scripts() {
            wp_enqueue_style( 'css-style', plugin_dir_url( __FILE__ ) .'assets/css/css.css' );
        
            wp_enqueue_script( 'script', plugin_dir_url( __FILE__ ) .'assets/js/js.js' );

            wp_enqueue_script('jquery-ui-datepicker');
            
            wp_enqueue_style('jquery-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

        }

        //Add admin menu
        public function booked_addon_topmenu() {

            add_submenu_page(
                'booked-appointments',
                'All Appointments',
                'All Appointments',
                'manage_options',
                'all-appointments',
                array($this, 'all_appointments' )
            );
        
            add_submenu_page(
                'booked-appointments',
                'Export',
                'Export',
                'manage_options',
                'export',
                array( $this, 'export' )
            );
        
            add_submenu_page(
                'booked-appointments',
                'SMS Notifications',
                'SMS Notifications',
                'manage_options',
                'sms-notifications',
                array( $this, 'sms_notifications')
            );
        }

        //Export all appointments
        public function export_file(){
        if (isset($_POST['booked_addon_csv']) || isset($_POST['from_date']) && isset($_POST['to_date'])):
            include('includes/addon-export-csv.php');
        endif;
        }

        public function addonsms_register_settings() {
            $sms_enable = isset($_POST['sms_control']) ? $_POST['sms_control'] : "";
            $application_token = isset($_POST['application_id']) ? $_POST['application_id'] : "";
            $auth = isset($_POST['application_token']) ? $_POST['application_token'] : "";
            
            add_option('sms_control',$sms_enable);
            add_option('application_id',$application_token);
            add_option('application_token',$auth);
        
            register_setting( 'sms_options_group', 'sms_control', 'myplugin_callback' );
            register_setting( 'sms_options_group', 'application_id', 'myplugin_callback' );
            register_setting( 'sms_options_group', 'application_token', 'myplugin_callback' );
        
         }

         
        public function all_appointments(){
            require plugin_dir_path(__FILE__) . 'admin/view-appointments.php';
        }

        public function export(){
            require plugin_dir_path(__FILE__) . 'admin/export.php';
        }

        public function sms_notifications(){
            require plugin_dir_path(__FILE__) . 'admin/sms-notifications.php';
        }

    }

}

$booked_addon = new booked_addon_extension();









// // Require booked addon SMS functions
// add_action( 'admin_init','sms_file');

// function sms_file(){
// if ( isset( $_POST['application_id'] ) && isset( $_POST['application_token'] ) ):
//     include('includes/sms-functions.php');
// endif;
// }





