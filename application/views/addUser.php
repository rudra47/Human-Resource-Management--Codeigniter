
<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  $this->load->view('layouts/head');
?>

<?php
  $this->load->view('layouts/header');

  $this->load->view('layouts/sidebar');
?>
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <div class="col-md-12">
			<h2 align="center">Add User</h2>
			<br>

			<?php echo form_open_multipart(base_url().'index.php/user/add/store', '', $hidden=array()); ?>

				<?php if ($this->uri->segment(2)=='inserted'): ?>
					<div class="alert alert-success col-md-11 offset-md-1">
						Data insert successfully
					</div>
				<?php endif ?>
				

				<div class="col-md-6 offset-md-2">
					<label>First Name : </label>
					<input type="text" name="firstName" placeholder="First Name" class="form-control">
					<span style="color: red;"><?= form_error('firstName') ?></span>
				</div>

				<div class="col-md-6 offset-md-3">
					<label>Last Name : </label>
					<input type="text" name="lastName" placeholder="Last Name" class="form-control">
					<span style="color: red;"><?= form_error('lastName') ?></span>
				</div>

				<div class="col-md-6 offset-md-3">
					<label>Email : </label>
					<input type="email" name="email" placeholder="Email" class="form-control">
					<span style="color: red;"><?= form_error('email') ?></span>
				</div>

				<div class="col-md-6 offset-md-3">
					<label>Phone : </label>
					<input type="text" name="phone" placeholder="Phone" class="form-control">
					<span style="color: red;"><?= form_error('phone') ?></span>
				</div>

				<div class="col-md-6 offset-md-3">
					<label>Role : </label>
					<select name="role" class="form-control">
						<option>Select One</option>
						<option>Student</option>
						<option>Teacher</option>
						<option>Admin</option>
					</select>
					<span style="color: red;"><?= form_error('role') ?></span>
				</div>

				<div class="col-md-6 offset-md-3">
					<label>Password : </label>
					<input type="password" name="password" placeholder="Password" class="form-control">
					<span style="color: red;"><?= form_error('password') ?></span>
				</div>

				<div class="col-md-12 offset-md-3">
					<label>Address : </label>
					<textarea name="address" rows="3" class="form-control">  </textarea>
					<span style="color: red;"><?= form_error('address') ?></span>
				</div>

				<div class="col-md-7 offset-md-3">
					<label>Gender : </label>
					<br>
					<input type="radio" name="gender" value="male" > Male
					<input type="radio" name="gender" value="female" > female
					<span style="color: red;"><?= form_error('gender') ?></span>
				</div>

				<div class="col-md-6 offset-md-3">
					<label>Image : </label> <br>
					<input type="file" name="image" >
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-5 ">
							

						</div>
						<div class="col-md-4 ">
							<input type="submit" name="insert" value="Submit" class="btn btn-success ">
							<input type="reset" value="Reset" class="btn btn-info ">
						</div>

					</div>

				</div>
				<br><br>
				<?php echo form_close(); ?>
			</div>
      </div>
      <!-- /.row -->
     
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>



  
  <?php
    $this->load->view('layouts/footer');
  ?>