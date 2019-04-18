<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  $this->load->view('admin/layouts/head');
?>
<?php
  $this->load->view('admin/layouts/header');

  $this->load->view('admin/layouts/sidebar');
?>

  <style type="text/css">
    #report {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: lightblue;
      margin-top: 20px;
    }
  </style>
  
  
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
                    <th width="12%">Employee Name</th>
                    <th width="12%">Employee Email</th>
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
                      <td><?php echo $task->employee_name; ?></td>
                      <td><?php echo $task->employee_email; ?></td>
                      <td><?php echo $task->task_title; ?></td>
                      <td><?php echo word_limiter($task->task_description, 25); ?></td>
                      <td><?php echo $task->task_start_date; ?></td>
                      <td><?php echo $task->task_death_date; ?></td>
                      <td><?php if($task->task_status == 0) echo '<a href="'.site_url('admin/task_status/'.$task->task_id).'" onclick="return confirm(\'Are you sure ?\')"><button class="btn btn-warning">Pending</button></a>'; else echo "<span class='btn btn-success'> Complete </span>" ?></td>
                      <td>
                        <a href="<?php echo site_url('admin/view_task/'.$task->task_id)?>"><button class="btn btn-primary fa fa-eye"></button></a>
                        <a href="<?php echo site_url('admin/delete_task/'.$task->task_id)?>"><button class="btn btn-primary fa fa-trash"></button></a>

                      </td>
                    </tr>

                    <!-- tr >
                      <td><button class="btn btn-primary" onclick="myFunction()">View Report</button></td>

                      <td id="report" cols="5"></td>
                    </tr> -->

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

  <script>
  function myFunction() {
    var x = document.getElementById("report");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
  </script>


  <?php
    $this->load->view('admin/layouts/footer');
  ?>