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

define( 'BOOKED_ADDON_URL', plugin_dir_url( __FILE__ ) );
define( 'BOOKED_ADDON_DIR', plugin_dir_path( __FILE__ ) );

//Require booked plugin main file
require_once BOOKED_ADDON_DIR .'../booked/booked.php';


if(!class_exists('booked_addon_extension')) {
	class booked_addon_extension {

        public function __construct() {

            add_action( 'admin_menu', array( $this,'booked_addon_topmenu' ) );

            add_action( 'admin_enqueue_scripts', array( $this, 'add_plugin_scripts' ) );

            add_action( 'admin_init', array( $this,'export_file' ) );

            add_action( 'admin_init', array( $this,'addonsms_register_settings' ) );
            
            add_action( 'admin_init', array( $this, 'sms_file' ) );

        }


        //Enqueue scripts
        public function add_plugin_scripts() {
            wp_enqueue_style( 'css-style', BOOKED_ADDON_URL .'assets/css/css.css' );
        
            wp_enqueue_script( 'script', BOOKED_ADDON_URL .'assets/js/js.js' );

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
            require BOOKED_ADDON_DIR . 'admin/view-appointments.php';
        }

        public function export(){
            require BOOKED_ADDON_DIR . 'admin/export.php';
        }

        public function sms_notifications(){
            require BOOKED_ADDON_DIR . 'admin/sms-notifications.php';
        }

        //Require booked addon SMS functions
        public function sms_file(){
            if ( isset( $_POST['application_id'] ) && isset( $_POST['application_token'] ) ):
                include('includes/sms-functions.php');
            endif;
        }

    }

}

$booked_addon = new booked_addon_extension();









