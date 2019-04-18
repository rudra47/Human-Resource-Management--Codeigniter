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
        All Task
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/add_employee'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> add Task</button></a></li>
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
                    <th width="15%">Title</th>
                    <th width="30%">Description</th>
                    <th width="7%">Deal Time</th>
                    <th width="7%">Death Time</th>
                    <th width="7%">Status</th>
                    <th width="12%">Manage</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($task->result() as $task): ?>
                    <tr>
                      <td><?php echo $task->task_title; ?></td>
                      <td><?php echo word_limiter($task->task_description, 25); ?></td>
                      <td><?php echo $task->task_start_date; ?></td>
                      <td><?php echo $task->task_death_date; ?></td>
                      <td><?php if($task->task_status == 0) echo "<span class='text-warning'> Pending </span>"; else echo "<span class='text-success'> Complete </span>" ?></td>
                      <td>
                        <a href="<?php echo site_url('employee/view_task/'.$task->task_id)?>" title="View"><button class="btn btn-primary fa fa-eye"></button></a>


                        <!-- <button type="button" class="btn btn-primary fa fa-comments" data-toggle="modal" data-target="#exampleModal" title="Add Report"></button> -->

                        <a href="<?php echo site_url('employee/task_report/'.$task->task_id); ?>"><button class="btn btn-primary fa fa-comments" title="Add Report"></button></a>
                        
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
    $this->load->view('user/employee/layouts/footer');
  ?>