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
        All Accepted Leave
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> apply new </button></a></li>
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
                    <th>Apply Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Day</th>
                    <th>Type</th>
                    <th>Paid/Unpaid</th>
                    <th>Paid Amount</th>
                    <th>Status</th>
                  </tr>
                </thead>

                <tbody>
                  
                <?php foreach ($accepted_leave->result() as $row): ?>
                <?php 
                  if ($row->confirmation == 1) {
                    $total_day = strtotime($row->app_end_date) - strtotime($row->app_start_date); 
                ?>
                  <tr>
                    
                    <td><?php echo date('M j, Y', strtotime($row->app_date)); ?></td>
                    <td><?php echo date('M j, Y', strtotime($row->app_start_date)); ?></td>
                    <td><?php echo date('M j, Y', strtotime($row->app_end_date)); ?></td>
                    <td>

                      <?php 
                      if ($total_day!=0){
                        $day = ($total_day/(60*60))/24;
                        echo $day+1;
                      }else{
                        echo "1";
                      } 
                      ?>
                      
                    </td>
                    <td><?php echo $row->app_type; ?></td>
                    <td><?php echo $row->leave_type; ?></td>
                    <td>
                      <?php 
                      if ($row->paid_amount == null) {
                        echo 0;
                      }else{
                        if ($row->paid_amount == .25) {
                          echo "25%";
                        }elseif ($row->paid_amount == .50) {
                          echo "50%";
                        }elseif ($row->paid_amount == .75) {
                          echo "75%";
                        }elseif ($row->paid_amount == 100) {
                          echo "100%";
                        }
                      }
                      ?>
                    </td>
                    <td><a href="<?php echo site_url('employee/view_application/'.$row->app_id); ?>"><button class="btn btn-success">Confirmed</button></a></td>
                  </tr>

                <?php 

                }elseif ($row->confirmation == 2){
                  $total_day = strtotime($row->app_end_date) - strtotime($row->app_start_date);
                  ?>
                  
                  <tr>
                    
                    <td><?php echo date('M j, Y', strtotime($row->app_date)); ?></td>
                    <td><?php echo date('M j, Y', strtotime($row->app_start_date)); ?></td>
                    <td><?php echo date('M j, Y', strtotime($row->app_end_date)); ?></td>
                    <td>

                      <?php 
                      if ($total_day!=0){
                        $day = ($total_day/(60*60))/24;
                        echo $day+1;
                      }else{
                        echo "1";
                      } 
                      ?>
                      
                    </td>
                    <td><?php echo $row->app_type; ?></td>
                    <td><?php echo $row->leave_type; ?></td>
                    <td>
                      <?php 
                      if ($row->paid_amount == null) {
                        echo 0;
                      }else{
                        if ($row->paid_amount == .25) {
                          echo "25%";
                        }elseif ($row->paid_amount == .50) {
                          echo "50%";
                        }elseif ($row->paid_amount == .75) {
                          echo "75%";
                        }elseif ($row->paid_amount == 100) {
                          echo "100%";
                        }
                      }
                      ?>
                    </td>
                    <td><a href="<?php echo site_url('employee/view_application/'.$row->app_id); ?>"><button class="btn btn-primary">Unconfirmed</button></a></td>
                  </tr>

                  

                  <?php
                }

                ?>

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