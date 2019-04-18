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
        View Application
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/requested_application'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> all requested application </button></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="" style="min-height: 600px;">
        
        <!-- Cutting -->
        <div class="col-md-10 col-md-offset-1">
          <div class="box">

            <?php $total_day = strtotime($requested_applications->app_end_date) - strtotime($requested_applications->app_start_date); ?>


            <p style="padding: 20px; font-size: 17px;">
              To <br>
              Authority <br>
              Total Online Solution(TOS) <br>
              <?php echo date('j F Y', strtotime($requested_applications->app_date)); ?> <br><br>

              <b>Subject : Leave in <?php echo $requested_applications->app_type; ?>. </b> <br><br>


              This is to inform you that I have been working as <?php echo $requested_applications->designation_name; ?> in your company. <?php echo $requested_applications->app_reason; ?> . That's why I need <?php 
                      if ($total_day!=0){
                        $day = ($total_day/(60*60))/24;
                        echo $day+1;
                      }else{
                        echo "1";
                      } 
                      ?> days leave from <?php echo date('j F Y', strtotime($requested_applications->app_start_date)); ?> to <?php echo date('j F Y', strtotime($requested_applications->app_end_date)); ?>. <br> <br>

              Hope you will consider my applcation. I will be very thankful to you for <br> your favor. <br><br>

              Regards <br>
              <?php echo $requested_applications->employee_name; ?> <br>
              <?php echo $requested_applications->designation_name; ?> <br>
              Total Online Solution. <br>
            </p>

            <?php if ($requested_applications->app_status == 1): ?>
              <img src="<?php echo base_url('upload/accepted.png'); ?>" width="200">
            <?php endif ?>

          </div>


          <!-- Modal Start -->
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
                  <form action="<?php echo site_url('admin/accept_application/'.$requested_applications->app_id); ?>" method="post">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Leave Type:</label>


                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                      <select class=" form-control" name="leave_type" id="leave_type" required>
                        <option value="">Please select</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                      </select>
                        
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Paid Amount:</label>
                          
                        <select class="form-control hidden-select" id="leave_type" name="paid_amount"> 
                          <option value="">Select One</option>
                          <option value=".25">25%</option>
                          <option value=".50">50%</option>
                          <option value=".75">75%</option>
                          <option value="1">100%</option>
                        </select>

                      </div>

                      <script type="text/javascript">
                        $('#leave_type').on('change', function() {
                          var changed = this,
                            check = changed.value.toLowerCase() === "paid";

                          $(changed).next().toggle(check).prop('required', check);
                        }).change();
                      </script>

                      <span class="text-danger"><?php echo form_error('employee_name')?></span>
                    </div>
                    

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary" name="send_message" value="Submit">
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>

          <script type="text/javascript"> 
            $(document).ready(function () { 
              $('#selectType').change(function () { 
                var selectOption = $('#selectCountries option:selected'); 
                if (selectOption.val() != 'paid') { $('#selectAmount').html('hidden'); }
              }
            }

          </script>

          <!-- Modal End -->

          <div class="pull-right"> <button  button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Accept</button> <a href="<?php echo site_url('admin/reject_application/'.$requested_applications->app_id); ?>" onclick="return confirm('Are you sure ? ')"><button  class="btn btn-danger">Reject</button></a>
          </div>
        </div>


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