<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  $this->load->view('user/employee/layouts/head');
?>
<?php
  $this->load->view('user/employee/layouts/header');

  $this->load->view('user/employee/layouts/sidebar');
?>
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="">
        
        <!-- Cutting -->

          
          <div class="box box-primary">
            
            <!-- /.box-header -->
            <!-- form start -->
              <div class=" col-md-12 alert alert-success">
                <?php if (isset($this->session->message)): ?>
                  
                  <span class=""><?php echo $this->session->message; ?></span>
                <?php endif ?>
              </div>

            <fieldset style="padding: 20px;">


              <h3 align="center" style="margin-bottom: 20px;"> Choose Your Attendance Type</h3>

              <?php 
              $emp_user_id = $this->session->emp_user_id;
               ?>
               <?php 
               if ($collections->row()){ 

                ?>
                 
                <div class="form-group" align="center">
                  <?php if ($collections->row()->emp_user_id == $emp_user_id){ ?>
                    
                  <button type="button" style="width: 150px;" class="btn btn-default">Start Time</button>

                  <?php 
                  }else{
                    ?>
                    <a href="<?php echo site_url('employee/office_signin/start_time/'); ?>"><button type="button" style="width: 150px;" class="btn btn-primary">Start Time</button></a>
                    <?php
                  }
                  ?>
                  <?php if ($collections->row()->lunch_start_time != '00:00:00'){ ?>

                  <button type="button" class="btn btn-default">Lunch Start Time</button>

                  <?php 
                  }else{
                    ?>
                    <a href="<?php echo site_url('employee/attendance_store/lunch_start_time/'); ?>""><button type="button" class="btn btn-warning">Lunch Start Time</button></a>
                    <?php
                  }
                  ?>

                  <?php if ($collections->row()->lunch_start_time == '00:00:00' || $collections->row()->lunch_end_time != '00:00:00'){ ?>

                  <button type="button" class="btn btn-default">Lunch End Time</button>

                  <?php 
                  }else{

                  ?>
                  <a href="<?php echo site_url('employee/attendance_store/lunch_end_time/'); ?>""><button type="button" class="btn btn-success">Lunch End Time</button></a>

                  <?php 

                  }

                  ?>

                  <?php if ($collections->row()->emp_user_id == $emp_user_id && $collections->row()->end_time != '00:00:00'){ ?>

                  <button type="button" style="width: 150px;" class="btn btn-default">End Time</button>

                  <?php 

                  }else{

                  ?>

                  <a href="<?php echo site_url('employee/attendance_store/end_time/'); ?>""><button type="button" style="width: 150px;" class="btn btn-info">End Time</button></a>

                  <?php 

                  }

                  ?>

                </div>

                  <?php 
                  // echo "Hello";exit();
                  foreach ($short_breaks->result() as $short_break) {
                    
                  // if ($collections->row()->emp_user_id == $short_break->emp_user_id && $short_break->insert_date == $collections->row()->insert_time) {
                    
                    if ($collections->row()->end_time == '00:00:00'){ 
                      ?>
                      
                      <div class="form-group" align="center">
                        <?php  
                        if ($short_break->emp_user_id == $collections->row()->emp_user_id && $short_break->part_time_signout != '00:00:00' && $short_break->part_time_signin == '00:00:00' && $short_break->insert_date == $collections->row()->insert_time) {
                          ?>
                          <button type="button" style="width: 150px; " class="btn btn-default">Short Break Sign Out</button>
                          <?php
                        }else{

                        ?>

                        <a href="<?php echo site_url('employee/attendance_store/part_time_signout/'); ?>""><button type="button" style="width: 150px; background: #a64dff; color: white;" class="btn btn-secondary">Short Break Sign Out</button></a>

                      <?php } ?>

                      <?php  
                        if ($short_break->emp_user_id == $collections->row()->emp_user_id && $short_break->part_time_signin != '00:00:00' && $short_break->insert_date == $collections->row()->insert_time) {
                          ?>

                          <button type="button" style="width: 150px; " class="btn btn-default">Short Break Sign In</button>

                        <?php 
                        }else{
                          ?>

                          <a href="<?php echo site_url('employee/attendance_store/part_time_signin/'); ?>""><button type="button" style="width: 150px; background: #a64dff; color: white;" class="btn btn-secondary">Short Break Sign In</button></a>

                          <?php
                        }
                        ?>

                      </div>

                      <?php
                      }else{
                        ?>
                          <div class="form-group" align="center">
                            <button type="button" style="width: 150px; " class="btn btn-secondary">Short Break Sign Out</button>

                            <button type="button" style="width: 150px; " class="btn btn-secondary">Short Break Sign In</button>

                          </div>
                        <?php
                      }

                    }

                  // }

                  if(!$short_break){

                      ?>
                      <div class="form-group" align="center">
                        <a href="<?php echo site_url('employee/attendance_store/part_time_signout/'); ?>""><button type="button" style="width: 150px; background: #a64dff; color: white;" class="btn btn-secondary">Short Break Sign Out</button></a>
                        <?php  
                        if($short_break->part_time_signin){
                        ?>
                          <a href="<?php echo site_url('employee/attendance_store/part_time_signin/'); ?>""><button type="button" style="width: 150px; background: #a64dff; color: white;" class="btn btn-secondary">Short Break Sign In</button></a>

                        <?php   
                          } else{
                            ?>
                            <a href="<?php echo site_url('employee/attendance_store/part_time_signin/'); ?>""><button type="button" style="width: 150px;" class="btn btn-secondary">Short Break Sign In</button></a>
                            <?php
                          }
                        ?>

                      </div>

                      <?php
                    }
                  ?>


               <?php  
               }  else{ ?>

                <div class="form-group" align="center">
                 
                  <a href="<?php echo site_url('employee/attendance_store/start_time'); ?>"><button type="button" style="width: 150px;" class="btn btn-primary">Start Time</button></a>
                
                  <button type="button" class="btn btn-default">Lunch Start Time</button>
                    
                  <button type="button" class="btn btn-default">Lunch End Time</button>
                  
                  <button type="button" style="width: 150px;" class="btn btn-default">End Time</button>

                </div>
                <div class="form-group" align="center">
                  <button type="button" style="width: 150px;" class="btn btn-secondary">Short Break Sign Out</button>

                  <button type="button" style="width: 150px; " class="btn btn-secondary">Short Break Sign In</button>

                </div>

                <?php
               }
               ?>
              

            </fieldset>

          </div>
          <!-- /.box -->



        <!-- /Cutting -->

        <!-- ./col -->
      </div>
      <!-- /.row -->
     
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

  <?php
    $this->load->view('user/employee/layouts/footer');
  ?>