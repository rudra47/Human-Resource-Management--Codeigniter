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
        All Holiday
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('user/employee/add_holiday'); ?>"><button style="margin-top: -10px; border: 1px solid gray;" class="btn btn-default"> add holiday</button></a></li>
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

            <form role="form" action="<?php echo base_url()."employee/store_apply_leave"; ?>" method="post" enctype="multipart/form-data">
              
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Application To</label>
                  <select class="form-control" name="app_to">
                    <option>Select One</option>
                    <option value="authority">Authority</option>
                  </select> 
                  <span class="text-danger"><?php echo form_error('app_to'); ?></span>
                </div>

                <div class="form-group col col-md-5">
                  <div class="row">
                    <label for="phone">Application Type</label>
                    <select class="form-control" name="app_type">
                      <option>Select One</option>
                      <option value="advance">Advance</option>
                      <option value="adsence">Absence</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('app_type'); ?></span>
                  </div>
                </div>

                <div class="form-group col col-md-5 pull-right">
                  <div class="row">
                    <label for="email">Apply Date</label>
                    <input class="form-control" id="date" name="app_date" placeholder="YYY/MM/DD" type="text"/>
                    <span class="text-danger"><?php echo form_error('app_date'); ?></span>
                  </div>
                </div>

                <div class="form-group col col-md-5">
                  <div class="row">
                    <label for="email">Start Date</label>
                    <input class="form-control" id="date" name="app_start_date" placeholder="YYY/MM/DD" type="text"/>
                    <span class="text-danger"><?php echo form_error('app_start_date'); ?></span>
                  </div>
                </div>

                <div class="form-group col col-md-5 pull-right">
                  <div class="row">
                    <label for="email">End Date</label>
                    <input class="form-control" id="date" name="app_end_date" placeholder="YYY/MM/DD" type="text"/>
                    <span class="text-danger"><?php echo form_error('app_end_date'); ?></span>
                  </div>
                </div>

                <div class="form-group col-md-12">
                  <div class="row">
                    <label for="email">Apply Reason</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Your Apply Reason" name="app_reason"></textarea>
                    <span class="text-danger"><?php echo form_error('app_reason'); ?></span>
                  </div>
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
    $this->load->view('user/employee/layouts/footer');
  ?>