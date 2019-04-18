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
        All Holiday
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/add_holiday'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> add holiday</button></a></li>
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
                    <th>Holiday Description</th>
                    <th>Holiday Date</th>
                    <th>Admin</th>
                    <th>Manage</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($all_holiday->result() as $row): ?>
                    
                  <tr>
                    <td><?php echo $row->holiday_description; ?></td>
                    <td><?php echo date('M j, Y', strtotime($row->holiday_date)); ?> <?php if($row->until_holiday_date) echo " <b> - </b> ".date('M j, Y', strtotime($row->until_holiday_date)); ?></td>
                    <td><?php echo $row->user_name; ?></td>
                    <td>
                      <a href="<?php echo site_url('admin/edit_holiday/'.$row->holiday_id)?>"><i class="fa fa-pencil"></i></a>
                      <a href="<?php echo site_url('admin/delete_holiday/'.$row->holiday_id)?>" onclick="return confirm('Are you sure ? ')"><i class="fa fa-trash"></i></a>
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