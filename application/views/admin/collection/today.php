<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  $this->load->view('admin/layouts/head');
?>
<?php
  $this->load->view('admin/layouts/header');

  $this->load->view('admin/layouts/sidebar');
?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Today's Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/attendance_all'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default">Attendance All</button></a></li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Employee Name</th>
                    <th>Employee User Id</th>
                    <th>Date</th>
                    <th>Starting Time</th>
                    <th>Lunch Time</th>
                    <th>Lunch End Time</th>
                    <th>End Time</th>
                    <th>Report</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($collections->result() as $collection): ?>
                    
                  <tr>
                    <td><?php echo $collection->employee_name; ?></td>
                    <td><?php echo $collection->emp_user_id; ?></td>
                    <td><?php echo date('M j, Y', strtotime($collection->insert_time)); ?></td>
                    <td><?php echo date('h:i:s a', strtotime($collection->start_time)); ?></td>
                    <td>
                      <?php 
                        if ($collection->lunch_start_time == "00:00:00") {
                          echo "00:00:00";
                        }else{
                          echo date('h:i:s a', strtotime($collection->lunch_start_time)); 
                        }
                      ?>
                    </td>
                    <td>
                      <?php 
                        if ($collection->lunch_end_time == "00:00:00") {
                          echo "00:00:00";
                        }else{
                          echo date('h:i:s a', strtotime($collection->lunch_end_time)); 
                        }
                      ?>
                    </td>

                    <td>
                      <?php
                        if ($collection->end_time == "00:00:00") {
                          echo "00:00:00";
                        }else{
                          echo date('h:i:s a', strtotime($collection->end_time)); 
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