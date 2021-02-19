
<div class="container">
   <div class="row"> 
      <div class="col-md-12 col-lg-12">
         <div class="panel">
            <div class="text-left panel-head">
               <h3 class="text-tight">All Appointments</h3>
            </div>
            <div class="panel-body">
    <div class=" custyle">
    
<?php 

$paged = ( $_GET['paged'] ) ? $_GET['paged'] : 1; 
$prevpage = max( ($paged - 1), 0 );
$nextpage = $paged + 1;

$booked_appointments = new WP_Query(array(
    'post_type' =>'booked_appointments',
    'posts_per_page' => 3,
    'paged' => $paged,
    'post_status' => 'publish'
));


?>

<table class="table table-striped custab">
<thead>
<tr>
    <th>Person</th>
    <th>Day</th>
    <th>Time</th>
    <th></th>
 </tr>
</thead>
<tr>
<?php
// Appointment list table 
if ($booked_appointments->have_posts()) :
    while ($booked_appointments->have_posts()) :
        $booked_appointments->the_post();
        global $post;     

        $appointment_timestamp = get_post_meta( $post->ID,'_appointment_timestamp',false);
        $appointment_timeslot = get_post_meta( $post->ID,'_appointment_timeslot',false);

        $timestamp = date('d-m-y',$appointment_timestamp['0']);
        $time = $appointment_timeslot['0'];

        $guest_name = get_post_meta( $post->ID,'_appointment_guest_name',true);
        $registered_user_id = get_post_meta( $post->ID,'_appointment_user',true);
        if($registered_user_id){
            $registered_user = get_userdata($registered_user_id);

        }

        if($guest_name){
            echo '<td>'.$guest_name.'</td>';
        }else{
            echo '<td>'.$registered_user->user_login.'</td>';
        }
        echo '<td>'.$timestamp.'</td>';
        echo '<td>'.$time.'</td>';
        echo '<td class="text-right"><a class=\'btn btn-info btn-xs\' href="#"><span class="glyphicon glyphicon-edit"></span> Change</a> <a href="'.$post->ID.'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span>Remove</a></td>';
       /* echo '<td class="apt-buttons">';
        echo '<form type="post" action="<?php echo admin_url(admin-ajax.php); ?>">';
        echo '<input type="hidden" id="ajaxchange_id" name="ajaxchange_id" value ="'.$post->ID.'">';
        echo '<input type="button" id="change" value ="Change">';
        echo '</form>';
        echo '<form type="post">';
        echo '<input type="hidden" id="ajaxcancel_id" name="ajaxcancel_id" value ="ajaxtestdel">';
        echo '<input type="button" id="cancel" value ="Cancel">';
        echo '</form>';
        echo '</td>'; */
        echo '</tr>';
       
        

        endwhile;
        endif;


?>
  

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
    </div>
</div>
</div>

<?php

function testdel( $post ) { // note the $post varaible as argument
    wp_nonce_field('testdel', 'ajaxsecurity'); // is a good practise adding nonces

}

function ajaxtestdel() {
    $postid = isset($_POST['cancel']) ? $_POST['cancel'] : '';
    $nonce = isset($_POST['ajaxcancel_id']) ? $_POST['ajaxcancel_id'] : '';
    if ( $postid && $nonce && wp_verify_nonce($nonce, 'testdel') ) {
      $status = delete_post_meta($postid, '_appointment_guest_name') ? 'Error' : 'Success';
    } else {
       $status = 'Error';
    }
    die($status);
  }
  
  add_action('wp_ajax_ajaxtestdel', 'ajaxtestdel');

?>

<script>
jQuery('#cancel').on('click', function(){
    var $this = jQuery(this);
    var post = jQuery('#ajaxcancel_id').val(); // get post id from hidded field
    var nonce = jQuery('input[name="ajaxcancel_id"]').val(); // get nonce from hidden field
    jQuery.ajax({
      url: '/wp-admin/admin-ajax.php', // in backend you should pass the ajax url using this variable
      type: 'POST',
      data: { action : 'ajaxtestdel', 
      postid: post, 
      ajaxsecurity: nonce },
      success: function(data){
        console.log(data);
        $this.val('deleted');
      }
    });
  });
</script>


