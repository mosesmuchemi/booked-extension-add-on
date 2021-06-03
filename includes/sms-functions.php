<?php
// Required if your environment does not handle autoloading
require __DIR__ . '/../vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

//Get otions enable/disable value
$options_value = get_option('sms_control');
 //Check if send SMS option is enabled
 if($options_value=='enable'): 


    // Send booked appointment message
    add_action('booked_confirmation_email', 'booked_appointment_sms');

    function booked_appointment_sms(){
        //Date and Time format
        $date_format = get_option('date_format');
        $time_format = get_option('time_format');
        //Get customer phone on profile
        $user_id = wp_get_current_user();
        $customer_phone = get_user_meta($user_id->ID, 'booked_phone', true);
        
        //Get post ID
        $booked_appointments = array(
            'post_type'   =>'booked_appointments',
            'post_status' => 'any',
            'orderby'     => 'ID'
           );

         $get_post = get_posts($booked_appointments);
         $post_id = $get_post['0']->ID;


        //Name
        $name = $user_id->display_name;
        //Date
        $timestamp = get_post_meta($post_id,'_appointment_timestamp', true);
	    $date = date($date_format,$timestamp);
        //Time
        $appointment_timeslot = get_post_meta( $post_id, '_appointment_timeslot', true);
        $time_slot = explode('-',$appointment_timeslot);
        $time = date($time_format, strtotime($time_slot['0']));
        //$time_end = date($time_format, strtotime($time_slot['1']));
        
        //get SMS content
        $sms_content = get_option('booked_appt_confirmation_email_content');
        $filter = array('%name%','%date%','%time%');
        $replace = array($name,$date,$time);
        $message = str_replace($filter, $replace, $sms_content);

        //Your Application SID and Application Token from Bulkgate
        $application_id = get_option('application_id');
        $application_token = get_option('application_token');
        //Use the client to do fun stuff like send text messages!
        $connection = new BulkGate\Message\Connection($application_id, $application_token);
        $sender = new BulkGate\Sms\Sender($connection);
        $send = new BulkGate\Sms\Message($customer_phone, $message);
        $sender->send($send);
        
    }

    // Send booked appointment approved message
    add_action('booked_approved_email', 'appointment_approved_sms');

    function appointment_approved_sms(){
        //Date and Time format
        $date_format = get_option('date_format');
        $time_format = get_option('time_format');
        //Get customer phone on profile
        $user_id = wp_get_current_user();
        $customer_phone = get_user_meta($user_id->ID, 'booked_phone', true);

        //Get post ID
        $appt_id = $_POST['appt_id'];
        
        //Name
        $name = $user_id->display_name;
        //Date
        $timestamp = get_post_meta($appt_id,'_appointment_timestamp', true);
	    $date = date( $date_format,$timestamp);
        //Time
        $appointment_timeslot = get_post_meta($appt_id, '_appointment_timeslot', true);
        $time_slot = explode('-',$appointment_timeslot);
        $time = date($time_format, strtotime($time_slot['0']));

        //get SMS content
        $sms_content = get_option('booked_approval_email_content');
        $filter = array('%name%','%date%','%time%');
        $replace = array($name,$date,$time);
        $message = str_replace($filter, $replace, $sms_content);

       //Your Application SID and Application Token from Bulkgate
       $application_id = get_option('application_id');
       $application_token = get_option('application_token');
       //Use the client to do fun stuff like send text messages!
       $connection = new BulkGate\Message\Connection($application_id, $application_token);
       $sender = new BulkGate\Sms\Sender($connection);
       $send = new BulkGate\Sms\Message($customer_phone, $message);
       $sender->send($send);
    }

    //Send cancelation message
    add_action('booked_appointment_cancelled', 'appointment_cancelled_sms');

    function appointment_cancelled_sms(){

        //Date and Time format
        $date_format = get_option('date_format');
        $time_format = get_option('time_format');

        //Get customer phone on profile
        $user_id = wp_get_current_user();
        $customer_phone = get_user_meta($user_id->ID, 'booked_phone', true);

        //Get post ID
        $appt_id = $_POST['appt_id'];

        //Name
        $name = $user_id->display_name;
        //Date
        $timestamp = get_post_meta($appt_id,'_appointment_timestamp', true);
	    $date = date( $date_format,$timestamp);
        //Time
        $appointment_timeslot = get_post_meta($appt_id, '_appointment_timeslot', true);
        $time_slot = explode('-',$appointment_timeslot);
        $time = date($time_format, strtotime($time_slot['0']));

        //get SMS content
        $sms_content = get_option('booked_cancellation_email_content');
        $filter = array('%name%','%date%','%time%');
        $replace = array($name,$date,$time);
        $message = str_replace($filter, $replace, $sms_content);
        
        //Your Application SID and Application Token from Bulkgate
        $application_id = get_option('application_id');
        $application_token = get_option('application_token');

        //Use the client to do fun stuff like send text messages!
        $connection = new BulkGate\Message\Connection($application_id, $application_token);
        $sender = new BulkGate\Sms\Sender($connection);
        $send = new BulkGate\Sms\Message($customer_phone, $message);
        $sender->send($send);
    }

endif;