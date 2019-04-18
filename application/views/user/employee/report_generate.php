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
?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee Report
      </h1>
      
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

        	    	$start_time = strtotime($row->start_time);
        	    	$end_time = strtotime($row->end_time);
        	    	$lunch_start_time = strtotime($row->lunch_start_time);
        	    	$lunch_end_time = strtotime($row->lunch_end_time);

        	    	$lunch_time = strtotime('+60 minutes', strtotime($row->lunch_start_time));

        	    	$difference = $end_time - $start_time;

        	    ?>
        	    	
        	    <div class="col-md-8">
        	      <blockquote>
        	        <p><?php echo $row->employee_name;?></p>
        	        <small><cite title="Source Title">Total Online Solution (TOS)<i class="icon-map-marker"></i></cite></small>
        	      </blockquote>
        	      <h3><b>Report of : <?php echo date('M j, Y', strtotime($row->insert_time)); ?></b> </h3><br>

        	      <table id="" class="table table-bordered table-striped">
        	        <thead>
        	          <tr>
        	            <th>Option</th>
        	            <th>Time</th>
        	            <th>Report</th>
        	          </tr>
        	        </thead>

        	        <tbody>
        	            
        	          <tr>
        	            <th>Start Time </th>
        	            <td>
        	            	<?php 
        	            		if ($row->start_time == "00:00:00") {
        	            		  echo "00:00:00";
        	            		}else{
        	            		  echo date('h:i:s a', strtotime($row->start_time)); 
        	            		}
        	            	?>
        	            </td>
        	            <td>
        	            	<?php
        	            	if ($start_time > $default_start_time) {
        	            		?>
        	            		<b class="text-danger">Delay</b>
        	            		<?php
        	            	}else{
        	            		?>
        	            		<b class="text-danger">Right Time</b>
        	            		<?php
        	            	}
        	            	?> 
        	            </td>
        	          </tr>

        	          <tr>
        	            <th>Lunch Start Time </th>
        	            <td>
        	            	<?php 
        	            		if ($row->lunch_start_time == "00:00:00") {
        	            		  echo "00:00:00";
        	            		}else{
        	            		  echo date('h:i:s a', strtotime($row->lunch_start_time)); 
        	            		}
        	            	?>
        	            </td>
        	            <td>
        	            	<?php 
        	            		if ($row->lunch_start_time > "14:00:00") {
        	            		  ?>
        	            		  <b class="text-info">late Lunch</b>
        	            		  <?php
        	            		}elseif($row->lunch_start_time < "13:00:00" && $row->lunch_start_time > "12:00:00"){
        	            			?>
        	            			<b class="text-danger">Early Lunch</b>
        	            			<?php
        	            		}elseif($row->lunch_start_time > "13:00:00"){
        	            			?>
	        	            		<b class="text-primary">Perfect Lunch</b>

        	            			<?php
        	            		}else{
        	            		  ?>
        	            			<b class="text-dark">No Entry</b>
        	            		  <?php 
        	            		}
        	            	?> 
        	            </td>
        	          </tr>

        	          <tr>
        	            <th>Lunch End Time </th>
        	            <td>
        	            	<?php 
        	            		if ($row->lunch_end_time == "00:00:00") {
        	            		  echo "00:00:00";
        	            		}else{
        	            		  echo date('h:i:s a', strtotime($row->lunch_end_time)); 
        	            		}
        	            	?>
        	            </td>
        	            <td>
        	            	<?php 
        	            	if ($row->lunch_end_time == "00:00:00") {
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
        	            </td>
        	          </tr>

        	          <tr>
        	            <th>End Time </th>
        	            <td>
        	            	<?php 
        	            		if ($row->end_time == "00:00:00") {
        	            		  echo "00:00:00";
        	            		}else{
        	            		  echo date('h:i:s a', strtotime($row->end_time)); 
        	            		}
        	            	?>
        	            </td>
        	            <td>
        	            	<?php
        	            	$office_time = strtotime('+510 minutes', strtotime($row->start_time));

        	            	if ($row->end_time == "00:00:00") {
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
        	            </td>
        	          </tr>

        	          <br>

        	          <tr class="active">
        	          	<th>Lunch Time Report</th>
        	          	<td colspan="2"> 
        	          		<?php

        	          		if ($row->lunch_end_time == "00:00:00") {
        	            		?>
								<b class="text-dark">No Entry</b>
								<?php 
        	            	}elseif ($lunch_end_time < $lunch_time) {

        	          			$diff = $lunch_time - $lunch_end_time;

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
        	          </tr>

        	          <tr class="active">
        	          	<th>Office Time Report</th>
        	          	<td colspan="2">
        	          		<?php

        	          		if ($row->end_time == "00:00:00") {
        	            		?>
								<b class="text-dark">No Entry</b>
								<?php 
        	            	}elseif ($end_time < $office_time) {

        	          			$diff = $office_time - $end_time;

        	          			if ($diff < 3600) {
        	            		
	        	            		?>
	        	            		<b class="text-warning">Early Leave <?php echo floor($diff/60);  ?> min ago</b>
	        	            		
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
        	          </tr>

        	        </tbody>  
        	        
        	      </table>

	        	    <div class="col-md-3 col-md-offset-9">
	        	    	<a href="<?php echo site_url('user/employee/attendance_single/'.$row->emp_user_id); ?>"><button class="btn btn-primary pull-right" >View Previous Data</button></a>
	        	    </div>

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