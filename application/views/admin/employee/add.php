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
        Add Employee
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/all_employee'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> all employee</button></a></li>
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

            <form role="form" action="<?php echo base_url()."admin/store_employee"; ?>" method="post" enctype="multipart/form-data">
              

              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter Employee Name" name="employee_name">
                  <span class="text-danger"><?php echo form_error('employee_name'); ?></span>
                </div>

                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" placeholder="Enter Employee Phone Number" name="employee_phone">
                  <span class="text-danger"><?php echo form_error('employee_phone'); ?></span>
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter Employee Email Address" name="employee_email">
                  <span class="text-danger"><?php echo form_error('employee_email'); ?></span>
                </div>

                <div class="form-group">
                  <label for="phone">Designation</label>
                  <select class="form-control" name="employee_designation">
                    <option>Select One</option>
                    <?php foreach ($designations->result() as $designation): ?>

                    <option value="<?php echo $designation->designation_id; ?>"><?php echo $designation->designation_name; ?></option>
                      
                    <?php endforeach ?>
                  </select>
                  <span class="text-danger"><?php echo form_error('employee_designation'); ?></span>
                </div>
                
                <div class="form-group">
                  <label for="salary">Salary</label>
                  <input type="text" class="form-control" id="salary" placeholder="Enter Employee salary" name="employee_salary">
                  <span class="text-danger"><?php echo form_error('employee_salary'); ?></span>
                </div>

                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" class="" id="image" name="employee_image">
                  <span class="text-danger"><?php echo form_error('employee_image'); ?></span>
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