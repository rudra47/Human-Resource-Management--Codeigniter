  <?php
    $this->load->view('user/layouts/head');
  ?>

 

  <section >
    <div class="col-md-12">
      <div class="col-md-6 offset-md-3 border border-primary" style=" margin-top: 40px;">
   
        <form action="<?php echo base_url()."main/store";?>" method="post">
          <fieldset style="padding: 20px;">
            <div class="form-group">

              <a href="<?php echo site_url('main/start_time'); ?>"><button type="button" style="width: 150px;" class="btn btn-primary">Start Time</button></a>
              <a href="<?php echo site_url('main/lunch_start_time'); ?>""><button type="button" class="btn btn-warning">Lunch Start Time</button></a>
              <a href="<?php echo site_url('main/lunch_end_time'); ?>""><button type="button" class="btn btn-success">Lunch End Time</button></a>
              <a href="<?php echo site_url('main/end_time'); ?>""><button type="button" style="width: 150px;" class="btn btn-info">End Time</button></a>

            </div>

            <div class="form-group">
              <label for="emp_user_id"><b>Lunch Starting Time</b></label>
              <select class="form-control" name="emp_user_id">
                <option>Select One</option>
                <?php foreach ($employees->result() as $employee): ?>
                  <option value="<?php echo $employee->user_id; ?>"><?php echo $employee->employee_name.' ('.$employee->user_id.')'; ?></option>
                <?php endforeach ?>
              </select>
            </div>
            
            <input type="submit" name="lunch_start_time" value="submit" class="btn btn-primary">
            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
          </fieldset>
        </form>

      </div>
    </div>
  </section>

  <?php
    $this->load->view('user/layouts/footer');
  ?>