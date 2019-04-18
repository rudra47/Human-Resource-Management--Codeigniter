
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
      
        <div class="box">
          <div class="box-header">
              <div class="col-md-9">
                <h3 class="box-title">All User</h3>
              </div>

            <?php if ($this->uri->segment(2)=='deleted'): ?>
              <div class="alert alert-success col-md-3 offset-md-3" >
                User Deleted
              </div>
            <?php endif ?>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Manage</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($users->result() as $user): ?>
                  <tr>
                    <td><?= $user->firstName; ?></td>
                    <td><?= $user->lastName; ?></td>
                    <td><?= $user->email; ?></td>
                    <td><?= $user->phone; ?></td>
                    <td><?= $user->role; ?></td>
                    <td><?= $user->address; ?></td>
                    <td><?= $user->gender; ?></td>

                    <td>
                      <a href="<?= site_url('user/edit-user/'.$user->id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                      <a href="<?= site_url('user/delete-user/'.$user->id) ?>" onclick="return confirm('Are you sure ? ')"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                  </tr>
                <?php endforeach ?>
              
            </table>
          </div>
          <!-- /.box-body -->
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