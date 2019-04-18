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
        Part Time Sign Out
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('employee/employee_attendance'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> Attendance</button></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="">
        
        <!-- Cutting -->

          
          <div class="box box-primary">
            <div class="col-md-12 row">
              

              <div class="box-header with-border col-md-4">
                <?php if (isset($this->session->message)): ?>
                  
                  <span class="alert alert-success"><?php echo $this->session->message; ?></span>
                <?php endif ?>
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form role="form" action="<?php echo base_url()."employee/attendance_store"; ?>" method="post" enctype="multipart/form-data">
              
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Sign In</label>
                  <input type="text" class="form-control" name="emp_user_id" value="<?php echo $this->session->emp_user_id; ?>" readonly> 
                  <span class="text-danger"><?php echo form_error('app_to'); ?></span>
                </div>

                



              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" class="btn btn-primary" name="part_time_signin" value="Submit" name="start_time">
                
              </div>

            </form>

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