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
      <div class="row" style="margin-bottom: -15px;">
        <div class="col-md-6">
          <p style="font-size: 25px;">Weekly Attendance Data</p>          
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
                  <?php foreach ($employee_data->result() as $row): ?>
                    
                  <tr>
                    <td><?php echo $row->employee_name; ?></td>
                    <td><?php echo $row->emp_user_id; ?></td>
                    <td><?php echo date('M j, Y', strtotime($row->insert_time)); ?></td>
                    <td><?php echo date('h:i:s a', strtotime($row->start_time)); ?></td>
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
                        if ($row->lunch_end_time == "00:00:00") {
                          echo "00:00:00";
                        }else{
                          echo date('h:i:s a', strtotime($row->lunch_end_time)); 
                        }
                      ?>
                    </td>

                    <td>
                      <?php
                        if ($row->end_time == "00:00:00") {
                          echo "00:00:00";
                        }else{
                          echo date('h:i:s a', strtotime($row->end_time)); 
                        }  
                      ?>
                    </td>

                    <td><a href="<?php echo site_url('employee/attendance_report_today/'.$row->emp_user_id.'/'.$row->insert_time);?>"><button class="btn btn-success">View</button></a></td>
                    
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
    $this->load->view('user/employee/layouts/footer');
  ?>