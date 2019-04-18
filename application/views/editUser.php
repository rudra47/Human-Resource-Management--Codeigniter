
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
			<h2 align="center">Edit User</h2>
			<br>

			<?php echo form_open_multipart(base_url().'index.php/user/user/update', '', $hidden=array()); ?>

				<?php if ($this->uri->segment(2)=='inserted'): ?>
					<div class="alert alert-success col-md-11 offset-md-1">
						Data insert successfully
					</div>
				<?php endif ?>
				
				<?php foreach ($user->result() as $row): ?>

				<?php
					$error = $this->session->error;	
				?>
					

				<div class="col-md-6 offset-md-2">
					<label>First Name : </label>
					<input type="text" name="firstName" value="<?= $row->firstName; ?>" placeholder="First Name" class="form-control">
					<span style="color: red;"><?= form_error('firstName') ?></span>
				</div>

				<div class="col-md-6 offset-md-3">
					<label>Last Name : </label>
					<input type="text" name="lastName" value="<?= $row->lastName; ?>" placeholder="Last Name" class="form-control">
					<span style="color: red;"><?= form_error('lastName') ?></span>
				</div>

				<div class="col-md-6 offset-md-3">
					<label>Email : </label>
					<input type="email" name="email" value="<?= $row->email; ?>" placeholder="Email" class="form-control">
					<span style="color: red;"><?= form_error('email') ?></span>
				</div>

				<div class="col-md-6 offset-md-3">
					<label>Phone : </label>
					<input type="text" name="phone" value="<?= $row->phone; ?>" placeholder="Phone" class="form-control">
					<span style="color: red;"><?= form_error('phone') ?></span>
				</div>

				<div class="col-md-6 offset-md-3">
					<label>Role : </label>
					<select name="role" class="form-control">
						<option>Select One</option>
						<option <?php if($row->role=="Student"){echo "selected";} ?>>Student</option>
						<option <?php if($row->role=="Teacher"){echo "selected";} ?>>Teacher</option>
						<option <?php if($row->role=="Admin"){echo "selected";} ?>>Admin</option>
					</select>
					<span style="color: red;"><?= form_error('role') ?></span>
				</div>

				<div class="col-md-12 offset-md-3">
					<label>Address : </label>
					<textarea name="address" rows="3" class="form-control"><?php echo $row->address ?></textarea>
					<span style="color: red;"><?= form_error('address') ?></span>
				</div>

				<div class="col-md-7 offset-md-3">
					<label>Gender : </label>
					<br>
					<input type="radio" name="gender" <?php if($row->gender=='male'){echo "active";} ?> value="male" > Male
					<input type="radio" name="gender" <?php if($row->role=='female'){echo "active";} ?> value="female" > female

					<span style="color: red;"><?php echo $error; ?></span>

				</div>

				<div class="col-md-6 offset-md-3">
					<label>Image : </label> <br>
					<?php echo form_upload(['name'=>'image']); ?>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-5 ">
							
						</div>
						<div class="col-md-4 ">
							<input type="hidden" name="hidden_id" value="<?= $row->id ?>" class="btn btn-success ">
							<input type="submit" name="update" value="Update" class="btn btn-success ">
							<input type="reset" value="Reset" class="btn btn-info ">
						</div>

					</div>

				</div>
				<br><br>

				<?php endforeach ?>

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