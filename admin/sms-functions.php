<?php

//require mailer functions to hook the sms notifications into
require_once plugin_dir_path(__FILE__) .'../../booked/includes/mailer_functions.php';


//this function fetches the phone field based on user_id
function get_booked_custom_fields($user_id = 16 ){

  //add code to check for existing number or any other
  //extra clean up here
  $custom_fields_html_string = get_post_meta( $user_id, '_cf_meta_value', true );
  

  //remove the html rendering and render the fields into an array
  //step 1 remove all HTML elements except strong
  $custom_fields_html_string = strip_tags($custom_fields_html_string, '<strong>');
  $custom_fields_html_string = str_replace('</strong>', '<strong>', $custom_fields_html_string);
  $custom_fields_array =  explode('<strong>', trim($custom_fields_html_string));
 
  //for some reason a space appears as first element
  //we remove and discard it
  array_shift($custom_fields_array);

  //display the custom fields
  //convert to associative array e.g phone as key and 0722730064 as value
$custom_fields_associative_array = array();

//define the keys and values of ass array
$key = '';
$value = '';

for($i = 0; $i < count($custom_fields_array); $i++){
  $i % 2 == 0 ? $key = $custom_fields_array[$i] : $value = $custom_fields_array[$i];
  $custom_fields_associative_array[$key] = $value;
}

print_r($custom_fields_associative_array['Phone']);
return $custom_fields_associative_array;

}


//hook into the user and admin email notifications for sms notifications
//found at booked/includes/mailer_functions.php
add_action('booked_confirmation_email', 'booked_user_confirmation_sms');
add_action('booked_admin_confirmation_email', 'booked_admin_confirmation_sms');
add_action('booked_reminder_email', 'booked_user_reminder_sms');
add_action('booked_admin_reminder_email', 'booked_admin_reminder_sms');
add_action('booked_cancellation_email','booked_user_cancellation_sms');
add_action('booked_admin_cancellation_email','booked_admin_cancellation_sms');
add_action('booked_approved_email','booked_user_approved_email');




//test action with save post hook
add_action('save_post','send_saved_post_notifictation');

function booked_user_confirmation_sms() { 
  $post_sms_log = $post_sms_log = plugin_dir_path(__FILE__) . 'sms-log.txt';
  $message = ' user confirmation sms notification sent';

  if(file_exists($post_sms_log)) {

    $file = fopen($post_sms_log, 'a');
    fwrite($file, $message . "\n");

  } else {
    $file = fopen($post_sms_log, 'w');
    fwrite($file, $message . "\n");
  }
}

function booked_admin_confirmation_sms() { 
  $post_sms_log =  plugin_dir_path(__FILE__) . 'sms-log.txt';
  $message = ' admin confirmation sms notification sent';

  if(file_exists($post_sms_log)) {

    $file = fopen($post_sms_log, 'a');
    fwrite($file, $message . "\n");

  } else {
    $file = fopen($post_sms_log, 'w');
    fwrite($file, $message . "\n");
  }
}

function booked_user_reminder_sms() { 
  $post_sms_log =  plugin_dir_path(__FILE__) . 'sms-log.txt';
  $message = ' user reminder sms notification sent';

  if(file_exists($post_sms_log)) {

    $file = fopen($post_sms_log, 'a');
    fwrite($file, $message . "\n");

  } else {
    $file = fopen($post_sms_log, 'w');
    fwrite($file, $message . "\n");
  }
}

function booked_admin_reminder_sms() { 
  $post_sms_log =  plugin_dir_path(__FILE__) . 'sms-log.txt';
  $message = ' admin reminder sms notification sent';

  if(file_exists($post_sms_log)) {

    $file = fopen($post_sms_log, 'a');
    fwrite($file, $message . "\n");

  } else {
    $file = fopen($post_sms_log, 'w');
    fwrite($file, $message . "\n");
  }
}

function booked_user_cancellation_sms() { 
  $post_sms_log =  plugin_dir_path(__FILE__) . 'sms-log.txt';
  $message = ' user cancellation sms notification sent';

  if(file_exists($post_sms_log)) {

    $file = fopen($post_sms_log, 'a');
    fwrite($file, $message . "\n");

  } else {
    $file = fopen($post_sms_log, 'w');
    fwrite($file, $message . "\n");
  }
}

function booked_admin_cancellation_sms() { 
  $post_sms_log =  plugin_dir_path(__FILE__) . 'sms-log.txt';
  $message = ' admin cancellation sms notification sent';

  if(file_exists($post_sms_log)) {

    $file = fopen($post_sms_log, 'a');
    fwrite($file, $message . "\n");

  } else {
    $file = fopen($post_sms_log, 'w');
    fwrite($file, $message . "\n");
  }
}

function booked_user_approved_email() { 
  $post_sms_log =  plugin_dir_path(__FILE__) . 'sms-log.txt';
  $message = ' user approved sms notification sent';

  if(file_exists($post_sms_log)) {

    $file = fopen($post_sms_log, 'a');
    fwrite($file, $message . "\n");

  } else {
    $file = fopen($post_sms_log, 'w');
    fwrite($file, $message . "\n");
  }
}



function send_saved_post_notifictation() { 
  $post_sms_log =  plugin_dir_path(__FILE__) . 'sms-log.txt';
  $message = ' saved post notification sent <==> mailer functions at: ';

  if(file_exists($post_sms_log)) {

    $file = fopen($post_sms_log, 'a');
    fwrite($file, $message . "\n");
    

  } else {
    $file = fopen($post_sms_log, 'w');
    fwrite($file, $message . "\n");
  }

  
}

