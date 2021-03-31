<?php  

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


    //Export all appointments to excell
if (isset($_POST['booked_addon_csv'])):
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=all_appointments_export.csv');
$output = fopen('php://output', 'w');

$export_titles = array(
	'First name',
    'Last name',
    'Email',
	'Date',
	'Start Time',
    'End time',
    'Status'
);

fputcsv( $output, $export_titles );


$booked_appointments = new WP_Query(array(
    'post_type' =>'booked_appointments',
    'posts_per_page' => 500,
    'order' => 'ASC',
    'meta_key' => '_appointment_timestamp',
    'orderby' => 'meta_value_num'
 ));

 if(!empty($booked_appointments) ):

if ($booked_appointments->have_posts()) :
 while ($booked_appointments->have_posts()) :
    $booked_appointments->the_post();
    global $post;  
    
    $time_format = get_option('time_format');
    $date_format = get_option('date_format');

    $appointment_timestamp = get_post_meta( $post->ID,'_appointment_timestamp',false);
    $appointment_timeslot = get_post_meta( $post->ID,'_appointment_timeslot',false);

    $timestamp = date($date_format,$appointment_timestamp['0']);

    $time_slot = explode('-',$appointment_timeslot['0']);
    $time_start = date($time_format, strtotime($time_slot['0']));
    $time_end = date($time_format, strtotime($time_slot['1']));

    $registered_user_id = get_post_meta( $post->ID,'_appointment_user',true);
    $registered_user = get_userdata($registered_user_id);
    $first_name = get_user_meta($registered_user->ID, 'first_name', true);
    $last_name = get_user_meta($registered_user->ID, 'last_name', true);
    $guest_name = get_post_meta( $post->ID,'_appointment_guest_name',true);
    $guest_surname = get_post_meta( $post->ID,'_appointment_guest_surname',true);
    $registered_user_email = $registered_user->user_email;
    $guest_email = get_post_meta($post->ID, '_appointment_guest_email',true);


    if($post->post_status=='publish'):
      $appointment_status = 'Approved';
    else:
      $appointment_status = 'Pending';
    endif;
    $output = fopen('php://output', 'w');

    if($first_name || $last_name):
    $appointments_array[$post->ID]['first_name'] =  $first_name;
    $appointments_array[$post->ID]['last_name'] = $last_name;
    else:
    $appointments_array[$post->ID]['guest_name'] = $guest_name;
    $appointments_array[$post->ID]['guest_surname'] = $guest_surname;
    endif;
    if($registered_user_email):
    $appointments_array[$post->ID]['user_email'] =  $registered_user_email;
    else:
    $appointments_array[$post->ID]['guest_email'] =  $guest_email;
    endif;
    $appointments_array[$post->ID]['appointment_date'] = $timestamp;
    $appointments_array[$post->ID]['start_time'] = $time_start;
    $appointments_array[$post->ID]['end_time'] = $time_end;
    $appointments_array[$post->ID]['post_status'] = $appointment_status;

    endwhile;
    endif;

    foreach($appointments_array as $appointment):
        fputcsv( $output, $appointment );
    endforeach;

    die;

endif;
endif;

//Export filtered appointments to excell
if (isset($_POST['from_date']) && isset($_POST['to_date'])):

    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    $date_format = get_option('date_format');                            

    $meta_query = array(
        array(
           'key'     => '_appointment_timestamp',
           'value'   => array(strtotime($from_date),strtotime($to_date)),
           'compare' => 'BETWEEN'
        )
     );


    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=filtered_appointments_export.csv');
    $output = fopen('php://output', 'w');
    
    $export_titles = array(
        'First name',
        'Last name',
        'Email',
        'Date',
        'Start Time',
        'End time',
        'Status'
    );
    
    fputcsv( $output, $export_titles );


    $booked_appointments = new WP_Query(array(
        'post_type' => 'booked_appointments',
        'post_status' => $_POST['appointment_type'],
        'posts_per_page' => 500,
        'meta_key'   => '_appointment_timestamp',
        'orderby'    => 'meta_value_num',
        'order'      => 'ASC',
        'meta_query' => $meta_query
    ));


 if ($booked_appointments->have_posts()) :
    while ($booked_appointments->have_posts()) :
        
        $booked_appointments->the_post();
        global $post;  
        
        $time_format = get_option('time_format');
        $date_format = get_option('date_format');

        $appointment_timestamp = get_post_meta( $post->ID,'_appointment_timestamp',false);
        $appointment_timeslot = get_post_meta( $post->ID,'_appointment_timeslot',false);

        $timestamp = date($date_format,$appointment_timestamp['0']);

        $time_slot = explode('-',$appointment_timeslot['0']);
        $time_start = date($time_format, strtotime($time_slot['0']));
        $time_end = date($time_format, strtotime($time_slot['1']));

        $registered_user_id = get_post_meta( $post->ID,'_appointment_user',true);
        $registered_user = get_userdata($registered_user_id);
        $display_name = $registered_user->display_name;
        $user_login = $registered_user->user_login;
        $first_name = get_user_meta($registered_user->ID, 'first_name', true);
        $last_name = get_user_meta($registered_user->ID, 'last_name', true);
        $guest_name = get_post_meta( $post->ID,'_appointment_guest_name',true);
        $guest_surname = get_post_meta( $post->ID,'_appointment_guest_surname',true);
        $registered_user_email = $registered_user->user_email;
        $guest_email = get_post_meta($post->ID, '_appointment_guest_email',true);

        if($post->post_status=='publish'):
        $appointment_status = 'Approved';
        else:
        $appointment_status = 'Pending';
        endif;
        $output = fopen('php://output', 'w');

        if(!$guest_name):
        if($first_name || $last_name):
        $appointments_array[$post->ID]['first_name'] =  $first_name;
        $appointments_array[$post->ID]['last_name'] = $last_name;
        elseif($display_name || $user_login):
        $appointments_array[$post->ID]['display_name'] =  $display_name;
        endif;
        else:
        $appointments_array[$post->ID]['guest_name'] = $guest_name;
        $appointments_array[$post->ID]['guest_surname'] = $guest_surname;
        endif;
        if($registered_user_email):
        $appointments_array[$post->ID]['user_email'] =  $registered_user_email;
        else:
        $appointments_array[$post->ID]['guest_email'] =  $guest_email;
        endif;
        $appointments_array[$post->ID]['appointment_date'] = $timestamp;
        $appointments_array[$post->ID]['start_time'] = $time_start;
        $appointments_array[$post->ID]['end_time'] = $time_end;
        $appointments_array[$post->ID]['post_status'] = $appointment_status;
        
    endwhile;
    
        foreach($appointments_array as $appointment):
                fputcsv( $output, $appointment );
        endforeach;
        die;

 endif;
 echo 'No appointents for selected dates.';
 die;

endif;



