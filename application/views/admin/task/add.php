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
        Add Task
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/all_employee'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> all task</button></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="">
        
        <!-- Cutting -->

          <div class="box box-primary">
            <div class="col-md-12 row">
              <div class="box-header with-border col-md-8">
                <h3 class="box-title">Fill all the field</h3>
              </div>

              <div class="box-header with-border col-md-4">
                <?php if (isset($this->session->message)): ?>
                  
                  <span class="alert alert-success"><?php echo $this->session->message; ?></span>
                <?php endif ?>
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form role="form" action="<?php echo base_url()."admin/add_task"; ?>" method="post" enctype="multipart/form-data">

              <div class="box-body">
                <div class="form-group">
                  <label for="name">Select Employee</label>
                  <select class="form-control" name="employee_id">
                    <option>Select One</option>
                    <?php foreach ($employees->result() as $employee): ?>

                    <option value="<?php echo $employee->employee_id; ?>"><?php echo $employee->employee_name; ?></option>
                      
                    <?php endforeach ?>
                  </select>

                  <span class="text-danger"><?php echo form_error('employee_name'); ?></span>
                </div>

                <div class="form-group">
                  <label for="title">Task Title</label>
                  <input type="text" class="form-control" id="title" placeholder="Enter Employee Task Title" name="task_title">
                  <span class="text-danger"><?php echo form_error('task_title'); ?></span>
                </div>

                <div class="form-group">
                  <div class="col-md-6">
                    <div class="row">
                      <label for="email">Start Time</label>
                      <input type="text" class="form-control" data-date-format="yyyy-mm-dd" id="date" readonly="" name="task_start_date" required="">
                      <span class="text-danger"><?php echo form_error('task_start_date'); ?></span>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <!-- <div class="row"> -->
                      <label for="email">Death Time</label>
                      <input type="text" class="form-control" data-date-format="yyyy-mm-dd" id="date" readonly="" name="task_death_date" required="">
                      <span class="text-danger"><?php echo form_error('task_death_date'); ?></span>
                    <!-- </div> -->
                    <br>
                  </div>

                </div>

                
                
                <div class="form-group">
                  <label for="salary">Task Description</label>
                  <textarea class="form-control" name="task_description" rows="8"></textarea>
                  <span class="text-danger"><?php echo form_error('task_description'); ?></span>
                </div>

                

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
    $this->load->view('admin/layouts/footer');
  ?>