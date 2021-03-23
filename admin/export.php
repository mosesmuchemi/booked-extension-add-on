<div class="apt-container">
            <div class="apt-panel-head">
               <h3>Export</h3>
            </div>
            <div class="apt-panel-body">
               <div class="export-container">
               <h3>Export appointments</h3>
               <p>Choose dates</p>
                  <form action="options.php" method="post"> 

                  <p>
                  <label for="from">From</label><br>
                  <input type="text" name="from_date" id="from_date" autocomplete="off" required> 
                  </p>
                  <p>
                  <label for="to">To</label><br>
                  <input type="text" name="to_date" id="to_date" autocomplete="off" required>
                  </p>
                      
                  <?php 
                  
                   submit_button ( $text = 'Export to CSV', $type = 'primary', $name = 'submit' );               
                  
                  ?>
                  </form>

               </div>
            </div>
</div>
