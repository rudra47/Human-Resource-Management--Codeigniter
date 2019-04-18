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
        Dashboard
        <!-- <small>Control panel</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <div class="row">
        
        <!-- Cutting -->

        
        

        
        

        <?php if ($holiday) { ?>
        <div class="col-md-12 row" style="height: 50px;">
          <div class="col-md-11" style="">
            <marquee style="border: 1px solid #5850c7; ">
              <p style=" font-size: 25px;">
                  
                <?php 
                // $today = date('Y-m-d');
                // $front_day = strtotime('+1440 minutes', strtotime($today));

                // foreach ($holiday as $row) {
                //   if ($front_day == strtotime($row->holiday_date)) {
                //     echo $row->holiday_description.' '.$row->until_holiday_date;
                //   }
                // }
                
                  echo $holiday->holiday_description.' and holiday for '. date('M j, Y',strtotime($holiday->holiday_date));
                  if ($holiday->until_holiday_date) {
                    echo " - ". date('M j, Y',strtotime($holiday->until_holiday_date));
                  }
                

                ?>

              </p>
            </marquee>
          </div>
          <div class="col-md-1" style="background: #5850c7; padding: 13px; text-align: center; "> <a href="<?php echo site_url('employee/holiday_all'); ?>" style="color: white;">see all</a></div>
        </div>

      <?php } ?>

       <!-- /Cutting -->

        <!-- ./col -->
      </div>
      <!-- /.row -->
      
      <br>


      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

  <?php
    $this->load->view('user/employee/layouts/footer');
  ?>