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
                <b class="text-warning">You have to pay : <?php if ($requested_applications->paid_amount == null) {
                        echo "0%";
                      } ?>

              <?php if ($requested_applications->paid_amount != null): ?>
                    <?php 
                      if ($requested_applications->paid_amount == null) {
                        echo "0";
                      }else{
                        if ($requested_applications->paid_amount == .25) {
                          echo "25%";
                        }elseif ($requested_applications->paid_amount == .50) {
                          echo "50%";
                        }elseif ($requested_applications->paid_amount == .75) {
                          echo "75%";
                        }elseif ($requested_applications->paid_amount == 100) {
                          echo "100%";
                        }
                      }
                    ?>
                        
                      </b>
              <?php endif ?>
            <?php endif ?>

            <!-- Confirmation -->


            <?php if ($requested_applications->app_status == 2): ?>
              <img src="<?php echo base_url('upload/rejected.png'); ?>" width="200">
              
            <?php endif ?>

          </div>

          <?php 
          if ($requested_applications->app_status == 1 && $requested_applications->confirmation == 0) {
          ?>

            
            <div class="pull-right"> 
              <a href="<?php echo site_url('employee/agree_application/'.$requested_applications->app_id); ?>" onclick="return confirm('Are you sure ? ')">
                <button  class="btn btn-success">Agree</button> 
              </a>

              <a href="<?php echo site_url('employee/disagree_application/'.$requested_applications->app_id); ?>" onclick="return confirm('Are you sure ? ')"><button  class="btn btn-danger">Disagree</button>
              </a>
            </div>

          <?php
          }
          ?>

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
    $this->load->view('user/employee/layouts/footer');
  ?>