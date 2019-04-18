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
        Dashboard
        <!-- <small>Control panel</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <!-- Cutting -->



        <!-- kata hoyeche ekhan theke ache dash_opt.php file e -->





        <div class="col-md-1" ></div>
        <div class="col-md-12" style="margin-top: 25px;">
          <div class="box" >
            <div class="box-header">
              <h3  style="text-align: center;">Who is available now ?</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($employees->result() as $row): 

                    $start_time = strtotime($row->start_time);
                    $end_time = strtotime($row->end_time);
                    $lunch_start_time = strtotime($row->lunch_start_time);
                    $lunch_end_time = strtotime($row->lunch_end_time);

                    $lunch_time = strtotime('+60 minutes', strtotime($row->lunch_start_time));
                    $office_time = strtotime('+510 minutes', strtotime($row->start_time));

                    ?>
                    
                    <tr>
                      <td><?php echo $row->employee_name; ?></td>
                      <td> <?php echo $row->employee_phone; ?> </td>
                      <td> 
                      
                        <?php

                        if ($row->end_time == "00:00:00" && $row->lunch_start_time == "00:00:00") {
                          ?>
                          <b class="text-success">Available</b>
                          <?php 
                        }elseif ($row->lunch_start_time != "00:00:00" && $row->lunch_end_time == "00:00:00") {
                          $update_time = strtotime(date('H:i:s'));

                          $diff = $update_time - $lunch_start_time;

                          if ($diff < 3600) {
                          
                            ?>
                            <b class="text-primary">Going for lunch <?php echo floor($diff/60);  ?> min ago</b>
                            
                            <?php
                          }else{
                            ?>
                            <b class="text-danger">Going for lunch more then <?php echo floor($diff/(60*60));  ?> hour ago</b>
                            
                            <?php
                          }

                          ?>
                          <?php
                        }elseif ($row->start_time != "00:00:00" && $row->lunch_end_time != "00:00:00" && $row->end_time == "00:00:00"){
                          ?>
                          <b class="text-success">Available</b>
                          <?php
                        }else{
                          ?>
                            
                            <b class="text-primary"> Not Available </b>
                            
                          <?php
                        } 
                        ?>

                      </td>
                    </tr>
                  <?php endforeach ?>
                
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

       <!-- /Cutting -->

        <!-- ./col -->
      </div>
      <!-- /.row -->
      
      <br>


      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

  <?php
    $this->load->view('admin/layouts/footer');
  ?>