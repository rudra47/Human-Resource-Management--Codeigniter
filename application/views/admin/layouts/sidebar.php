<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->user_name; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      
      <li >
        <a href="<?php echo site_url('admin/all_employee') ?>">
          <i class="fa fa-users"></i>
          <span>All Employee</span>
        </a>
      </li>

      <li >
        <a href="<?php echo site_url('admin/attendance_today') ?>">
          <i class="fa fa-users"></i>
          <span>Employee Attendance</span>
        </a>
      </li>

      <li >
        <a href="<?php echo site_url('admin/all_holiday'); ?>">
          <i class="fa fa-users"></i>
          <span>Office Holiday</span>
        </a>
      </li>

      <li >
        <a href="<?php echo site_url('admin/all_designation'); ?>">
          <i class="fa fa-suitcase"></i>
          <span>Designation</span>
        </a>
      </li>

      <li >
        <a href="<?php echo site_url('admin/requested_application'); ?>">
          <i class="fa fa-suitcase"></i>
          <span>Requested Application</span>
        </a>
      </li>

      <li >
        <a href="<?php echo site_url('admin/all_task'); ?>">
          <i class="fa fa-suitcase"></i>
          <span>Task Management</span>
        </a>
      </li>

      
      
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>