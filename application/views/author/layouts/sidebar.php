<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= base_url('upload/'.$this->session->employee_image); ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p></p>
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
      
      <!-- <li >
        <a href="">
          <i class=""></i>
          <span></span>
        </a>
      </li> -->

      <li>
        <a href="<?php echo site_url('employee/employee_attendance/'); ?>">
          <i class="fa fa-tasks"></i>
          <span>Attendance</span>
        </a>
      </li>

      <li class="treeview">
        <a href="<?php echo site_url(''); ?>">
          <i class="fa fa-book"></i> <span>Attendance Report</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class=""><a href="<?php echo site_url('employee/attendance_report_today/'.$this->session->emp_user_id.'/'.date('Y-m-d')); ?>"><i class="fa fa-circle-o"></i> Today's Report</a></li>
          <li><a href="<?php echo site_url('employee/attendance_report_weekly/'.$this->session->emp_user_id.'/'.date('Y-m-d')); ?>"><i class="fa fa-circle-o"></i> Weekly Report</a></li>
          
        </ul>
      </li>

      <li>
        <a href="<?php echo site_url('employee/work_report/') ?>">
          <i class="fa fa-tasks"></i>
          <span>Work Report</span>
        </a>
      </li>

      <li class="treeview">
        <a href="<?php echo site_url(''); ?>">
          <i class="fa fa-book"></i> <span>My Leave</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class=""><a href="<?php echo site_url('employee/apply_leave/'.$this->session->emp_user_id.'/'.date('Y-m-d')); ?>"><i class="fa fa-circle-o"></i> Apply Leave </a></li>
          <li><a href="<?php echo site_url('employee/confirmation_leave/'); ?>"><i class="fa fa-circle-o"></i> Confirmation </a></li>
          <li><a href="<?php echo site_url('employee/accepted_leave/'); ?>"><i class="fa fa-circle-o"></i> Accepted </a></li>
          <li><a href="<?php echo site_url('employee/rejected_leave/'); ?>"><i class="fa fa-circle-o"></i> Rejected </a></li>
          <li><a href="<?php echo site_url('employee/pending_leave/'); ?>"><i class="fa fa-circle-o"></i> Pending </a></li>
          
        </ul>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

