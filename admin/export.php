
<div class="apt-container">
            <div class="apt-panel-head">
               <h3>Export</h3>
            </div>
            <div class="apt-panel-body">
               <div class="export-container">
               <h3>Export appointments</h3>
               <p>Choose dates to export appointments within specified range</p>
                  <form action="options.php" method="post"> 
                  <?php
                  $calendars = get_terms('booked_custom_calendars','orderby=slug&hide_empty=0');
                  if (!empty($calendars)): 
                  ?>
                  <p>
                  <b><label for="appointment_label">Calendar</label></b><br>
                  <select name="calendar_id">
                  <option value="all">All Calendars</option>
                  <?php
                  foreach($calendars as $calendar):
                     ?><option value="<?php echo $calendar->term_id; ?>"><?php echo $calendar->name; ?></option><?php
                  endforeach;
                  ?>
                  </select>
                  </p>
                  <?php endif; ?>
                  <p>
                  <b><label for="appointment_label">Approved and/or Pending</label></b><br>
                  <select name="appointment_type">
                  <option value="any">Approved and Pending</option>
                  <option value="publish">Approved</option>
                  <option value="draft">Pending</option>
                  </select>
                  </p>
                  <p>
                  <b><label for="from">From Date</label></b><br>
                  <input type="text" name="from_date" id="from_date" autocomplete="off" required> 
                  </p>
                  <p>
                  <b><label for="to">To Date</label></b><br>
                  <input type="text" name="to_date" id="to_date" autocomplete="off" required>
                  </p>
                      
                  <?php 
                  
                   submit_button($text = 'Export to CSV', $type = 'primary', $name = 'submit');               
                  
                  ?>
                  </form>

               </div>
            </div>
</div>