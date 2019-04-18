<?php
	// foreach ($employee as $val) {
	// 	echo $val->employee_name;
	// }
?>

<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  $this->load->view('admin/layouts/head');
?>
<?php
  $this->load->view('admin/layouts/header');

  $this->load->view('admin/layouts/sidebar');


  $default_start_time = strtotime("10:00:00");  
  $default_end_time = strtotime("18:30:00");
  
?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee Report
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/attendance_today'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> Attendance Today</button></a></li>
      </ol>
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
            
            
            <!-- /.box-header -->
            <div class="box-body">
        	    <?php
                $default_start_time = strtotime("10:00:00");  
                $default_end_time = strtotime("18:30:00"); 
                foreach ($employee->result() as $row): 
                
                ?>
                <div class="col-md-4">
                  <img src="<?php echo base_url('upload/'.$row->employee_image) ; ?>"  alt="" width="300" class="img-rounded">
                </div>

                <?php

        	    	// $start_time = strtotime($row->start_time);
        	    	// $end_time = strtotime($row->end_time);
        	    	// $lunch_start_time = strtotime($row->lunch_start_time);
        	    	// $lunch_end_time = strtotime($row->lunch_end_time);

        	    	// $lunch_time = strtotime('+60 minutes', strtotime($row->lunch_start_time));

        	    	// $difference = $end_time - $start_time;

        	    ?>
        	    	
        	    <div class="col-md-8">
        	      <blockquote>
        	        <p><?php echo $row->employee_name;?></p>
        	        <small><cite title="Source Title">Total Online Solution (TOS)<i class="icon-map-marker"></i></cite></small>
        	      </blockquote>
        	      

        	      <table id="" class="table table-bordered table-striped">
        	        <thead>
        	          <tr>
        	            <th>Option</th>
        	            <th>Data</th>
        	          </tr>
        	        </thead>

        	        <tbody>
        	            <tr>
                         <td><b>Name</b></td>   
                         <td><?php echo $row->employee_name; ?></td>   
                        </tr>

                        <tr>
                         <td><b>Designation</b></td>   
                         <td><?php echo $row->designation_name; ?></td>   
                        </tr>

                        <tr>
                         <td><b>Phone</b></td>   
                         <td><?php echo $row->employee_phone; ?></td>   
                        </tr>

                        <tr>
                         <td><b>Email</b></td>   
                         <td><?php echo $row->employee_email; ?></td>   
                        </tr>

                        <tr>
                         <td><b>Salary</b></td>   
                         <td><?php echo $row->employee_salary; ?></td>   
                        </tr>

                        <tr>
                         <td><b>User Id</b></td>   
                         <td><?php echo $row->user_id; ?></td>   
                        </tr>
        	          

        	        </tbody>  
        	        
        	      </table>

                  <?php 
                    
                  ?>

	        	    <div class="col-md-3 col-md-offset-9">
                  <a href="<?php echo site_url('admin/attendance_single/'.$row->employee_name.'/'.$row->user_id); ?>"><button class="btn btn-primary pull-right" >View Full Month Data</button></a>
                </div>

        	    </div>
        	    <?php endforeach ?>
              

            </div>
            <!-- /.box-body -->


          </div>
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 align="center">Salary Calculation of <?php echo date('F'); ?></h3>
            </div>
            <div class="box-body">

              <?php 

                $total_just_lunch_time = 0; 
                $total_delay_lunch_time = 0; 
                $total_office_early_leave = 0; 
                $total_office_over_time = 0;


                foreach ($attendances->result() as $collection) {
                  
                  $start_time = strtotime($collection->start_time);
                  $end_time = strtotime($collection->end_time);
                  $lunch_start_time = strtotime($collection->lunch_start_time);
                  $lunch_end_time = strtotime($collection->lunch_end_time);

                  $lunch_time = strtotime('+60 minutes', strtotime($collection->lunch_start_time));
                  $office_time = strtotime('+510 minutes', strtotime($collection->start_time));
                  
                  if ($lunch_end_time > $lunch_time) {

                    $difference = date_diff(date_create($collection->lunch_end_time), date_create($collection->lunch_start_time));


                      $total_delay_lunch_time += $difference->format('%i');
                    
                  }

                  if ($collection->end_time != "00:00:00") {
                    
                    if ($end_time < $office_time) {

                      $difference = date_diff(date_create(date('Y-m-d H:i:s',$office_time)), date_create($collection->end_time));

                      $a = $difference->format('%h');
                      $b = $a*60;

                      $total_office_early_leave += $difference->format('%i');
                      $total_office_early_leave = $total_office_early_leave + $b;


                    }

                    elseif ($end_time > $office_time) {
                      $difference = date_diff(date_create($collection->end_time), date_create(date('Y-m-d H:i:s', $office_time)));

                      $a = $difference->format('%h');
                      $b = $a*60;

                      $total_office_over_time += $difference->format('%i');

                      $total_office_over_time = $total_office_over_time + $b;

                    }

                  }

                } 
              ?>

              <?php  

                $total_paid_leave = 0;
                $total_unpaid_leave = 0;

                $daily_salary = $employee->row()->employee_salary / 30;
                $total_leave_amount = 0;

                foreach ($leave->result() as $row) {
                  if ($row->confirmation == 1 && $row->leave_type == 'paid') {
                    $total_paid_leave += $row->total_day;

                    $a = $daily_salary * $row->paid_amount;

                    $c = $row->total_day * $a;

                    $total_leave_amount = $total_leave_amount + $c;

                  }elseif ($row->confirmation == 1 && $row->leave_type == 'unpaid') {
                    $total_unpaid_leave += $row->total_day;
                  }
                }
              ?>

              <div class="col-md-7">
              <table id="" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Option</th>
                    <th>Data</th>
                    <th>Amount</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>Paid Leave</td>
                    <td><?php echo $total_paid_leave; ?> Days</td>
                    <td>
                      <?php echo $total_leave_amount; ?> tk
                    </td>
                  </tr> 
                  
                  <tr>
                    <td>Unpaid Leave</td>
                    <td><?php echo $total_unpaid_leave; ?> Days</td>
                    <td>0 tk</td>
                  </tr>

                  <tr>
                    <td>Lunch Time Delay</td>
                    <td><?php echo $total_delay_lunch_time; ?> mins</td>
                    <td><?php echo $lunch_delay = $total_delay_lunch_time * 2; ?> tk</td>
                  </tr>

                  <tr>
                    <td>Early Leave</td>
                    <td><?php echo $total_office_early_leave; ?> mins</td>
                    <td><?php echo $early_leave = $total_office_early_leave * 3; ?> tk</td>
                  </tr>

                  <tr>
                    <td>Over Time</td>
                    <td><?php echo $total_office_over_time; ?> mins</td>
                    <td><?php echo $over_time = $total_office_over_time * 3; ?> tk</td>
                  </tr>

                </tbody>

              </table>
              </div>
              <div class="col-md-5">
                <table>
                  <thead>
                    <th style="font-size: 20px;" align="center" colspan="1">Total Calculation</th>
                    
                  </thead>
                  <tbody style="font-size: 18px;">
                    
                    <tr>
                      <td>Salary : </td>
                      <td><?php echo $employee->row()->employee_salary; ?> tk</td>
                    </tr>

                    <tr>
                      <td>Over Time : </td>
                      <td><?php echo $over_time; ?> tk</td>
                    </tr>

                    <tr>
                      <td>Early Leave : </td>
                      <td>-<?php echo $early_leave; ?> tk</td>
                    </tr>

                    <tr>
                      <td>Lunch Delay : </td>
                      <td>-<?php echo $lunch_delay; ?> tk</td>
                    </tr>
                  </tbody>
                </table>
                <br>

                <p style="font-size: 18px;"><b>Total Salary :</b> 
                  <?php  
                    $sum = $employee->row()->employee_salary + $over_time;
                    $sub = $early_leave + $lunch_delay;

                    echo $total = $sum - $sub;
                  ?>
                </p>

              </div>

            </div>
          </div>




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