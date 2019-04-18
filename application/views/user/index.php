  <?php
    $this->load->view('user/layouts/head');
  ?>

  

  <section >
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <?php if ($this->session->message): ?>
          
        <div class="alert alert-primary" style="margin-bottom: -15px; margin-top: 20px;">
          <?php echo $this->session->message; ?>
        </div>

        <?php endif ?>


      </div>
    </div>

    <div class="col-md-6 offset-md-3 border border-primary" style=" margin-top: 40px;">
 
      <form>
        <fieldset style="padding: 20px;">

          <h3 align="center" style="margin-bottom: 20px;"> Welcome To Employee Attendance System</h3>

          <div class="form-group">

            <a href="<?php echo site_url('main/start_time'); ?>"><button type="button" style="width: 150px;" class="btn btn-primary">Start Time</button></a>
            <a href="<?php echo site_url('main/lunch_start_time'); ?>""><button type="button" class="btn btn-warning">Lunch Start Time</button></a>
            <a href="<?php echo site_url('main/lunch_end_time'); ?>""><button type="button" class="btn btn-success">Lunch End Time</button></a>
            <a href="<?php echo site_url('main/end_time'); ?>""><button type="button" style="width: 150px;" class="btn btn-info">End Time</button></a>

          </div>


        </fieldset>
      </form>

    </div>
<!-- 
      <div class="container-fluid">
          <table class="datatable table table-hover table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Class</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>
                  <input type="text" class="form-control input-sm filter-column">
                </th>
                <th>
                  <input type="text" class="form-control input-sm filter-column" />
                </th>
                <th>
                  <select class="form-control input-sm filter-column">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="B">C</option>
                  </select>
                </th>
              </tr>
            </tfoot>
            <tbody>
              <tr>
                <td>1</td>
                <td>Jane</td>
                <td>Address 1</td>
                <td>A</td>
              </tr>
              <tr>
                <td>1</td>
                <td>John</td>
                <td>Address 2</td>
                <td>B</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Jasmin</td>
                <td>Address 3</td>
                <td>A</td>
              </tr>
            </tbody>
          </table>
        </div>
 -->
      <div class="col-md-6 offset-md-3 border border-primary" style=" margin-top: 30px; margin-bottom: 30px;">
        <h2 align="center" style="padding: 10px;">Employers List</h2>
        <div class="container-fluid">
          <table class="datatable table table-hover table-bordered" style="position: relative;">
            <thead>
              <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>User Id</th>
              </tr>
            </thead>
            <!-- <tfoot>
              <tr>
                <th></th>
                <th>
                  <input type="text" class="form-control input-sm filter-column">
                </th>
                <th>
                  <input type="text" class="form-control input-sm filter-column" />
                </th>
                <th>
                  <select class="form-control input-sm filter-column">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="B">C</option>
                  </select>
                </th>
              </tr>
            </tfoot> -->
            <tbody>

              <?php foreach ($employees->result() as $employee): ?>
                
                <tr class="">
                  <th scope="row"><?php echo $employee->employee_name; ?></th>
                  <td><?php echo $employee->employee_phone; ?></td>
                  <td><?php echo $employee->user_id; ?></td>
                </tr>

              <?php endforeach ?>


            </tbody>
          </table>

        </div>
      </div>

    </div>
  </section>

  <?php
    $this->load->view('user/layouts/footer');
  ?>