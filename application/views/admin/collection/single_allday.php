<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  $this->load->view('admin/layouts/head');
?>
<?php
  $this->load->view('admin/layouts/header');

  $this->load->view('admin/layouts/sidebar');

  
  $default_start_time = strtotime("10:00:00");  
  $default_end_time = strtotime("18:30:00");
  

  $total_just_lunch_time = 0; 
  $total_delay_lunch_time = 0; 
  $total_office_early_leave = 0; 
  $total_office_over_time = 0;

?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row" style="margin-bottom: -15px;">
        <div class="col-md-6" style="padding-bottom: 5px; font-size: 17px; ">
          <p style=""> <b>Employee Name : </b> <?php echo $employee_name; ?></p>          
          <p style=""> <b>Month : </b> <?php if(isset($input_date)) echo date('F Y', strtotime($input_date)); else  echo date('F Y') ?></p>  

          <p>
            <?php
              foreach ($collections->result() as $collection){

                $start_time = strtotime($collection->start_time);
                $end_time = strtotime($collection->end_time);
                $lunch_start_time = strtotime($collection->lunch_start_time);
                $lunch_end_time = strtotime($collection->lunch_end_time);

                $lunch_time = strtotime('+60 minutes', strtotime($collection->lunch_start_time));
                $office_time = strtotime('+510 minutes', strtotime($collection->start_time));
                // $office_time = date_add($start_time,date_interval_create_from_date_string("510 minutes"));


                // $office_time = date($collection->start_time, strtotime('+510 minutes'));


                // echo $office_time; die();



                if ($lunch_end_time > $lunch_time) {

                  $difference = date_diff(date_create($collection->lunch_end_time), date_create($collection->lunch_start_time));


                    $total_delay_lunch_time += $difference->format('%i');
                  


                   // $total_delay_lunch_time = $total_delay_lunch_time + $b;
                }

                if ($collection->end_time != "00:00:00") {
                  
                  if ($end_time < $office_time) {

                    // echo date_create($office_time);die();
                    $difference = date_diff(date_create(date('Y-m-d H:i:s',$office_time)), date_create($collection->end_time));
                    // $difference = $office_time - $end_time;

                    $a = $difference->format('%h');
                    $b = $a*60;

                    $total_office_early_leave += $difference->format('%i');
                    // $diff = $office_time - $end_time;
                    $total_office_early_leave = $total_office_early_leave + $b;


                  }

                  elseif ($end_time > $office_time) {
                    $difference = date_diff(date_create($collection->end_time), date_create(date('Y-m-d H:i:s', $office_time)));

                    $a = $difference->format('%h');
                    $b = $a*60;

                    $total_office_over_time += $difference->format('%i');

                    $total_office_over_time = $total_office_over_time + $b;

                  }
                    // $total_office_early_leave = floor($diff/60);

                }

              }

              ?>

              <b class="text-warning">Total Lunch Delay : <?php echo  $total_delay_lunch_time; ?> min</b> 

          </p> 
          <p>
            <b class="text-danger">Total Office Early Leave : <?php echo $total_office_early_leave;  ?> min</b>
            
          </p> 

          <p>
            <b class="text-primary">Total Office Over Time : <?php echo $total_office_over_time;  ?> min</b>
            
          </p>        
        </div>


        <div class="col-md-6 form-group" style="padding-top: 15px;">
          <form action="<?php echo base_url('admin/attendance_single/'.$employee_name.'/'.$emp_user_id); ?>" method="post">
            

            <div class="col-md-7 col-md-offset-2">
              <select class="form-control" name="date">
                <option value="">Select One</option>
                <option value="<?php echo date('Y-1-1'); ?>">January</option>
                <option value="<?php echo date('Y-2-1'); ?>">February</option>
                <option value="<?php echo date('Y-3-1'); ?>">March</option>
                <option value="<?php echo date('Y-4-1'); ?>">April</option>
                <option value="<?php echo date('Y-5-1'); ?>">May</option>
                <option value="<?php echo date('Y-6-1'); ?>">June</option>
                <option value="<?php echo date('Y-7-1'); ?>">July</option>
                <option value="<?php echo date('Y-8-1'); ?>">August</option>
                <option value="<?php echo date('Y-9-1'); ?>">September</option>
                <option value="<?php echo date('Y-10-1'); ?>">October</option>
                <option value="<?php echo date('Y-11-1'); ?>">November</option>
                <option value="<?php echo date('Y-12-1'); ?>">December</option>
              </select>
            </div>

            <div class="col-md-3">
              <input type="submit" name="range_single_submit" class="form-control btn btn-primary" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </section>

    

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="">
        
        <!-- Cutting -->

          <div class="box">
            <?php if ($this->session->message): ?>
              
            <div class="alert alert-success" style="">
              <?php echo $this->session->message; ?>
            </div>

            <?php endif ?>
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Starting Time</th>
                    <th>Lunch Time</th>
                    <th>Lunch End Time</th>
                    <th>End Time</th>
                    <th>Short Break</th>
                    <th>Lunch Report</th>
                    <th>Office Report</th>
                    <th>Report</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($collections->result() as $collection): ?>

                    <?php  
                      $start_time = strtotime($collection->start_time);
                      $end_time = strtotime($collection->end_time);
                      $lunch_start_time = strtotime($collection->lunch_start_time);
                      $lunch_end_time = strtotime($collection->lunch_end_time);

                      $lunch_time = strtotime('+60 minutes', strtotime($collection->lunch_start_time));

                    ?>
                    
                  <tr>
                    <td>
                      <?php echo date('M j, Y', strtotime($collection->insert_time)); ?> 

                    </td>
                    <td>
                      <?php echo date('h:i:s a', strtotime($collection->start_time)); ?>

                      (
                        <?php
                        if ($start_time > $default_start_time) {
                          ?>
                          <b class="text-danger">Delay</b>
                          <?php
                        }else{
                          ?>
                          <b class="text-success">Right Time</b>
                          <?php
                        }
                        ?> 
                      ) 
                    </td>
                    <td>
                      <?php 
                        if ($collection->lunch_start_time == "00:00:00") {
                          echo "00:00:00";
                        }else{
                          echo date('h:i:s a', strtotime($collection->lunch_start_time)); 
                        }
                      ?>
                      (
                        <?php 
                          if ($collection->lunch_start_time > "14:00:00") {
                            ?>
                            <b class="text-info">late Lunch</b>
                            <?php
                          }elseif($collection->lunch_start_time < "13:00:00" && $collection->lunch_start_time > "12:00:00"){
                            ?>
                            <b class="text-danger">Early Lunch</b>
                            <?php
                          }elseif($collection->lunch_start_time > "13:00:00"){
                            ?>
                            <b class="text-primary">Perfect Lunch</b>

                            <?php
                          }else{
                            ?>
                            <b class="text-dark">No Entry</b>
                            <?php 
                          }
                        ?>
                      )
                    </td>
                    <td>
                      <?php 
                        if ($collection->lunch_end_time == "00:00:00") {
                          echo "00:00:00";
                        }else{
                          echo date('h:i:s a', strtotime($collection->lunch_end_time)); 
                        }
                      ?>
                      (
                        <?php 
                        if ($collection->lunch_end_time == "00:00:00") {
                          ?>
                          <b class="text-dark">No Entry</b>
                        <?php 
                        }elseif ($lunch_end_time < $lunch_time && $lunch_end_time > $lunch_start_time) {
                          ?>
                          <b class="text-success">Just Time</b>
                          <?php
                        }else{
                          ?>
                          <b class="text-danger">Delay</b>
                          <?php
                        }
                        ?> 
                      )
                    </td>

                    <td>
                      <?php
                        if ($collection->end_time == "00:00:00") {
                          echo "00:00:00";
                        }else{
                          echo date('h:i:s a', strtotime($collection->end_time)); 
                        }  
                      ?>
                      (
                        <?php
                        $office_time = strtotime('+510 minutes', strtotime($collection->start_time));

                        if ($collection->end_time == "00:00:00") {
                          ?>
                          <b class="text-dark">No Entry</b>
                        <?php 
                        }elseif ($end_time < $office_time) {
                          ?>
                          <b class="text-danger">Early Leave</b>
                          <?php
                        }elseif($end_time == $office_time){
                          ?>
                          <b class="text-success">Right Time</b>
                          <?php
                        }else{
                          ?>
                          <b class="text-primary">Over Time</b>
                          <?php
                        }
                        ?> 
                      )
                    </td>
                    <td>
                      <?php  
                        $br_mins = 0;
                        $small_break = 0;
                        foreach ($short_break->result() as $sh_break) {
                          if ($sh_break->insert_date == $collection->insert_time) {

                            $difference = date_diff(date_create($sh_break->part_time_signin), date_create($sh_break->part_time_signout));

                            $a = $difference->format('%h');
                            $b = $a*60;

                            $br_mins += $difference->format('%i');

                            $small_break = $b + $br_mins;

                          }
                        }

                        echo $small_break;
                      ?> mins
                    </td>

                    <td>
                      <?php

                        if ($collection->lunch_end_time == "00:00:00") {
                          ?>
                          <b class="text-dark">No Entry</b>
                        <?php 

                        }elseif ($lunch_end_time < $lunch_time) {

                          $diff = $lunch_time - $lunch_end_time;

                          $total_just_lunch_time = $total_just_lunch_time + $diff;

                          ?>
                          <b class="text-success">Just Time - <?php echo floor($diff/60);  ?> min ago</b>
                          
                          <?php

                        }elseif($lunch_end_time == $lunch_time){
                          ?>
                          <b class="text-success">Right Time</b>
                          <?php
                        }else{
                          $diff = $lunch_end_time - $lunch_time;

                          if ($diff < 3600) {
                          
                            ?>
                            <b class="text-warning">Delay <?php echo floor($diff/60);  ?> min</b>
                            
                            <?php
                          }else{
                            ?>
                            <b class="text-danger">Delay More Then <?php echo floor($diff/(60*60));  ?> hour</b>
                            
                            <?php
                          }
                        } 
                        ?>
                    </td>
                    <td>
                      <?php

                        if ($collection->end_time == "00:00:00") {
                          ?>
                          <b class="text-dark">No Entry</b>
                        <?php 
                        }elseif ($end_time < $office_time) {

                          $diff = $office_time - $end_time;

                          if ($diff < 3600) {
                          
                            ?>
                            <b class="text-danger">Early Leave <?php echo floor($diff/60);  ?> min ago</b>
                            
                            <?php
                          }else{
                            ?>
                            <b class="text-danger">Early Leave More Then <?php echo floor($diff/(60*60));  ?> hour ago</b>
                            
                            <?php
                          }

                          ?>
                          <?php
                        }elseif($end_time == $office_time){
                          ?>
                          <b class="text-success">Right Time</b>
                          <?php
                        }else{
                          $diff = $end_time - $office_time;

                          if ($diff < 3600) {
                          
                            ?>
                            <b class="text-primary">Over Time <?php echo floor($diff/60);  ?> min</b>
                            
                            <?php
                          }else{
                            ?>
                            <b class="text-primary">Over Time More Then <?php echo floor($diff/(60*60));  ?> hour</b>
                            
                            <?php
                          }
                        } 
                        ?>
                    </td>

                    <td><a href="<?php echo site_url('admin/attendance_report/'.$collection->emp_user_id.'/'.$collection->insert_time);?>"><button class="btn btn-success">View</button></a></td>
                    
                  </tr>

                  <?php endforeach ?>

                </tbody>  
                
              </table>
            </div>
            <!-- /.box-body -->
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
    $this->load->view('admin/layouts/footer');
  ?>