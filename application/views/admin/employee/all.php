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
        All Employee
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/add_employee'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> add employee</button></a></li>
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
                    <th>Image</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>User Name</th>
                    <th>Salary</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($employees->result() as $employee): ?>
                    
                  <tr>
                    <td><img src="<?php echo base_url('upload/'.$employee->employee_image);?>" width="50" class="img-rounded"></td>
                    <td><?php echo $employee->employee_name; ?></td>
                    <td><?php echo $employee->employee_phone; ?></td>
                    <td><?php echo $employee->employee_email; ?></td>
                    <td><?php echo $employee->user_id; ?></td>
                    <td><?php echo $employee->employee_salary; ?></td>
                    <td>
                      <a href="<?php echo site_url('admin/view_employee/'.$employee->employee_id.'/'.$employee->user_id)?>"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                      <a href="<?php echo site_url('admin/edit_employee/'.$employee->employee_id)?>"><button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                      <a href="<?php echo site_url('admin/delete_employee/'.$employee->employee_id)?>" onclick="return confirm('Are you sure ? ')"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                    </td>
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