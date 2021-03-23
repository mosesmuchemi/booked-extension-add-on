<div class="apt-container">
            <div class="apt-panel-head">
               <h3>SMS Notification</h3>
            </div>
            <div class="apt-panel-body">
             <div id="disable-sms">
               
             <form action="options.php" method="post">
             <?php settings_fields( 'sms_options_group' ); ?>
             <?php
               

             // Get the value of this option.
             $options_value = get_option( 'sms_control' );            
            ?>
            <br>
            <b><label for="">Enabled</label></b>
            <input type="radio" name="sms_control" value="enable" id="<?php $options_value ?>"
            <?php checked( $options_value, 'enable' ); ?> />
            <b><label for="">Disabled</label></b>
             <input type="radio" name="sms_control" value="disable" id="<?php $options_value ?>"
             <?php checked( $options_value, 'disable' ); ?>/>
             <br><br>
            <div class="sms-fieds">
            <table>
          <?php if($options_value=='enable'): ?>
          <tr>
          <th>
          <label for="">Account SID</label>
          </th>
           <td>
              <input type="text" name="account_sid" value="<?php echo get_option('account_sid'); ?>"><br>
          </td>
          </tr>
          <tr>
          
          <th>
          <label for="">Auth Token </label>
          </th>
          <td>
              <input type="text" name="auth_token" value="<?php echo get_option('auth_token'); ?>"><br>
          </td>
          </tr>
         <?php endif;?>
          </table>
            </div>
            
          

             
               <?php 
               
               submit_button();
               
               ?>

             </form>
             
             

            
             </div> 
            </div>
</div>