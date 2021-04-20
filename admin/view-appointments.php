
<div class="apt-container">
    <div class="apt-panel-head">
        <h3>All Appointments</h3>
    </div>
    <div class="apt-panel-body">
    
      <?php 

      $paged = isset( $_GET['paged'] ) ? $_GET['paged'] : 1; 
      $prevpage = max( ($paged - 1), 0 );
      $nextpage = $paged + 1;


      $booked_appointments = new WP_Query(array(
          'post_type'      =>'booked_appointments',
          'posts_per_page' => 10,
          'paged'          => $paged,
          'order'          => 'ASC',
          'meta_key'       => '_appointment_timestamp',
          'orderby'        => 'meta_value_num'
      ));

      if(!empty($booked_appointments) ):
      ?>

      <table class="apt-table">
            <div>
            <form action="" method="post">        
              <button class="apt-export-btn">Export to CSV</button>
            <input type="hidden" name="booked_addon_csv" value="1">
            </form>
            </div>
      <thead>
      <tr>
          <th>Person</th>
          <th>Date</th>
          <th>Time</th>
          <th>Status</th>
      </tr>
      </thead>
      <tr>
      <?php
      // Appointment list table 
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
              if($registered_user):
              $first_name = get_user_meta($registered_user->ID, 'first_name', true);
              $last_name = get_user_meta($registered_user->ID, 'last_name', true);
              endif;
              $guest_name = get_post_meta( $post->ID,'_appointment_guest_name',true);
              $guest_surname = get_post_meta( $post->ID,'_appointment_guest_surname',true);



              if(!$guest_name):
                if($first_name || $last_name):
                    echo '<td>'.$first_name. ' ' .$last_name.'</td>';
                elseif($registered_user->display_name):
                  echo '<td>'.$registered_user->display_name.'</td>';
                else:
                  echo '<td>'.$registered_user->user_login.'</td>';
                endif;
                
              else:
                echo '<td>'.$guest_name.' '.$guest_surname.'</td>';
              endif;
                
              
              echo '<td>'.$timestamp.'</td>';
              echo '<td>'.$time_start.'-'.$time_end.'</td>';
              if($post->post_status=='publish'):
              echo '<td>Approved</td>';
              else:
              echo '<td>Pending</td>';
              endif;
              echo '</tr>';
            
              endwhile;
              endif;
              
      ?>
        
      <!-- Appointment table pagination -->
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination">
        <?php if ($prevpage !== 0) { ?>
          <li class="page-item">
            <a class="page-link" href="<?php echo 'admin.php?page=all-appointments&paged='.$prevpage ?>" >
            <span aria-hidden="true">&laquo;</span>
            Previous
            </a>
          </li>
      <?php } 
        if ($booked_appointments->max_num_pages  > $paged) {
      ?>
          <li class="page-item">
            <a class="page-link" href="<?php echo 'admin.php?page=all-appointments&paged='.$nextpage ?>">
            Next
            <span aria-hidden="true">&raquo;</span> 
            </a>
          </li>
      <?php } ?>
        </ul>
      </nav>
      <?php else: ?>
      <div class="no-apt">
      <h3>There are no appointments</h3>
      </div>
      <?php endif; ?>
  </div>
</div>


