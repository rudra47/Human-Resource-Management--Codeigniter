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
        Your Work
      </h1>
      <ol class="breadcrumb">
        <li style="margin-top: -10px;"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Send Work Report </button> </li>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo site_url('employee/send_work_report'); ?>" method="post">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Your Name:</label>
                    <input type="text" class="form-control " readonly="readonly"  id="recipient-name" name="employee_name" value="<?php echo $this->session->employee_name; ?>"><span class="text-danger"><?php echo form_error('employee_name')?></span>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control" id="message-text" rows="4" name="employee_message"></textarea><span class="text-danger"><?php echo form_error('employee_message')?></span>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="send_message" value="Send Message">
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="">
        
        <!-- Cutting -->

          <div class="box">
            
            <?php if ($this->session->email_sent): ?>
              
            <div class="alert alert-success" style="">
              <?php echo $this->session->email_sent; ?>
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
                    <th>Sending Date</th>
                    <th>Message</th>
                    <th>Menage</th>
                  </tr>
                </thead>


                <tbody>
                  
                  <?php foreach ($reports->result() as $report): ?>
                    
                  <tr>
                    <td><?php echo date('M j, Y - h:m:s a', strtotime($report->insert_date)); ?></td>
                    <td><?php echo $report->employee_message; ?></td>
                    <td>
                      <a href=""><button class="btn btn-primary">View</button></a>
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