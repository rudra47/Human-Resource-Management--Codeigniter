<?php
	// foreach ($employee as $val) {
	// 	echo $val->employee_name;
	// }
?>

<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  $this->load->view('user/employee/layouts/head');
?>
<?php
  $this->load->view('user/employee/layouts/header');

  $this->load->view('user/employee/layouts/sidebar');


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
        <li><a href="<?php echo site_url('admin/all_task'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> All Task</button></a></li>
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
                foreach ($task->result() as $row): 
                
                ?>

                <?php

        	    	// $start_time = strtotime($row->start_time);
        	    	// $end_time = strtotime($row->end_time);
        	    	// $lunch_start_time = strtotime($row->lunch_start_time);
        	    	// $lunch_end_time = strtotime($row->lunch_end_time);

        	    	// $lunch_time = strtotime('+60 minutes', strtotime($row->lunch_start_time));

        	    	// $difference = $end_time - $start_time;

        	    ?>
        	    	
        	    <div class="col-md-10">
        	      
        	      <table id="" class="table table-bordered table-striped">
        	        <thead>
        	          <tr>
        	            <th width="20%">Option</th>
        	            <th width="80%">Data</th>
        	          </tr>
        	        </thead>

        	        <tbody>
        	            <tr>
                         <td><b>Name</b></td>   
                         <td><?php echo $row->employee_name; ?></td>   
                        </tr>

                        <tr>
                         <td><b>Task Title</b></td>   
                         <td><?php echo $row->task_title; ?></td>   
                        </tr>

                        <tr>
                         <td><b>Task Description</b></td>   
                         <td><?php echo $row->task_description; ?></td>   
                        </tr>

                        <tr>
                         <td><b>Deal Time</b></td>   
                         <td><?php echo $row->task_start_date; ?></td>   
                        </tr>

                        <tr>
                         <td><b>Death Time</b></td>   
                         <td><?php echo $row->task_death_date; ?></td>   
                        </tr>

                        <tr>
                         <td><b>Status</b></td>   
                         <td><?php if($row->task_status == 0) echo "<span class='text-warning'> Pending </span>"; else echo "<span class='text-success'> Complete </span>" ?></td>   
                        </tr>


        	          

        	        </tbody>  
        	        
        	      </table>

                  <?php 
                    
                  ?>

	        	    

        	    </div>
        	    <?php endforeach ?>
              

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
    $this->load->view('user/employee/layouts/footer');
  ?>