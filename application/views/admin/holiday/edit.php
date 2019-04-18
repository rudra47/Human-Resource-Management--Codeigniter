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
        Edit Holiday
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/all_holiday'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> all holiday</button></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="">
        
        <!-- Cutting -->

          <div class="box box-primary ">
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
            <?php foreach ($holiday->result() as $row): ?>

            <form role="form" action="<?php echo base_url()."admin/update_holiday/".$row->holiday_id; ?>" method="post">

              <div class="form-group">
                  <label for="holiday_description">Description</label>
                  <input type="text" class="form-control" id="holiday_description" placeholder="Holiday Description" name="holiday_description" value="<?php echo $row->holiday_description ?>">
                  <span class="text-danger"><?php echo form_error('holiday_description'); ?></span>
                </div>

                <div class="form-group">
                  <label for="date">Date</label>
                  <input class="form-control" id="date" name="holiday_date" placeholder="YYYY/MM/DD" type="text"/ value="<?php echo $row->holiday_date ?>">To 
                  <input class="form-control" id="date" name="until_holiday_date" placeholder="YYYY/MM/DD" type="text"/ value="<?php echo $row->until_holiday_date; ?>">
                  <span class="text-danger"><?php echo form_error('holiday_date'); ?></span>
                </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
                
              </div>
              <!-- /.box-body -->



            </form>

            <?php endforeach ?>

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