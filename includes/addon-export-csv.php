<?php  

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


    //Export to excell
      global $wpdb;
 
          $filename = 'addon-export-csv.csv';
          //$date = date("Y-m-d H:i:s");
          $output = fopen('php://output', 'w');

          $result = $wpdb->get_results('SELECT * FROM     wp_users', ARRAY_A);
          fputcsv( $output, array('ID', 'Name', 'Email'));
          foreach ( $result as $key => $value ) {
              $modified_values = array(
                              $value['ID'],
                              $value['user_nicename'],
                              $value['user_email']
              );
              
          fputcsv( $output, $modified_values );
          }
        
          fclose( $output );

          exit;


        
      