<?php

//this function returns an associative array of the custom fields.

//Require booked plugin main file
require_once plugin_dir_path(__FILE__) .'../../booked/booked.php';


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


//hook into the user and admin email notifications
add_action('booked_send_admin_reminders','send_admin_sms_notifictation');
add_action('booked_send_user_reminders','send_user_sms_notifictation');

function send_admin_sms_notifictation() { 
  $post_sms_log = $post_sms_log =  plugin_dir_path(__FILE__) . 'sms-log.txt';
  $message = ' admin sms notification sent';

  if(file_exists($post_sms_log)) {

    $file = fopen($post_sms_log, 'a');
    fwrite($file, $message);

  } else {
    $file = fopen($post_sms_log, 'w');
    fwrite($file, $message);
  }
}

function send_user_sms_notifictation() { 
  $post_sms_log =  plugin_dir_path(__FILE__) . 'sms-log.txt';
  $message = ' user sms notification sent';

  if(file_exists($post_sms_log)) {

    $file = fopen($post_sms_log, 'a');
    fwrite($file, $message);

  } else {
    $file = fopen($post_sms_log, 'w');
    fwrite($file, $message);
  }
}

