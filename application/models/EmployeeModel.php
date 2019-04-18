<?php
	/**
	 * 
	 */
	class EmployeeModel extends CI_Model
	{

		function employee_login($emp_user_id, $password)
		{
			$employee = $this->db->where(['user_id'=>$emp_user_id, 'employee_password'=>$password])->get('employee');

			if ($employee->num_rows()) {
				return $employee;
			}else{
				return false;
			}
		}



		function store_employee($data){
			
			if($this->db->insert("employee", $data)){
				return true;
			}else{
				return false;
			}

		}

		function all_data()
		{
			$employees = $this->db->get('employee');

			return $employees;
		}

		function fatch_single_data($id)
		{
			$employee = $this->db->select('*')->join('designation', 'designation.designation_id = employee.employee_designation')->where('employee_id', $id)->where('employee_status', 1)->get('employee');

			return $employee;
		}


		function update_employee($id, $data){
			if($this->db->where('employee_id', $id)->update("employee", $data)){
				return true;
			}else{
				return false;
			}
		}

		function delete_data($id){
			$this->db->where('employee_id', $id)->delete('employee');
		}

		function own_reports($id){
			$reports = $this->db->where('employee_id', $id)->get('work_report');


			return $reports;
		}

		function store_send_message($data){
			if($this->db->insert("work_report", $data)){
				return TRUE;
			}else{
				return false;
			}
		}

		function all_employee_designation(){
			$designations = $this->db->where('designation_status', 1)->get('designation');
			return $designations;
		}

		function store_designation($data){
			if($this->db->insert("designation", $data)){
				return TRUE;
			}else{
				return false;
			}
		}
		
		function fatch_single_designation($id)
		{
			$designation = $this->db->where('designation_id', $id)->get('designation');

			return $designation;
		}
		
		function update_designation($id, $data){
			if($this->db->where('designation_id', $id)->update("designation", $data)){
				return true;
			}else{
				return false;
			}
		}

		function soft_delete_designation($id, $data){
			if($this->db->where('designation_id', $id)->update("designation", $data)){
				return true;
			}else{
				return false;
			}
		}

		function store_apply_leave($data){
			if($this->db->insert("leave_application", $data)){
				return TRUE;
			}else{
				return false;
			}
		}

		function pending_leave($employee_id){
			$this->db->select('*');
			$this->db->from('leave_application');
			$this->db->join('employee', 'employee.employee_id = leave_application.employee_id');
			$this->db->where('leave_application.employee_id', $employee_id);
			$this->db->where('app_status', 0);
			
			$pending_leave = $this->db->get();

			return $pending_leave;
		}

		function accepted_leave($employee_id){
			$this->db->select('*');
			$this->db->from('leave_application');
			$this->db->join('employee', 'employee.employee_id = leave_application.employee_id');
			$this->db->where('leave_application.employee_id', $employee_id);
			$this->db->where('app_status', 1);
			// $this->db->where('confirmation', 1);

			$confirmed = $this->db->get();

			return $confirmed;
		}

		function all_accepted_leave($employee_id, $start_month, $end_month){
			$this->db->select('*');
			$this->db->from('leave_application');
			$this->db->join('employee', 'employee.employee_id = leave_application.employee_id');
			$this->db->where('leave_application.employee_id', $employee_id);
			$this->db->where('app_status', 1);
			$this->db->where('insert_time >=',$start_month);
			$this->db->where('insert_time <=',$end_month); 
			// $this->db->where('confirmation', 1);

			$leave = $this->db->get();

			return $leave;
		}

		// function accepted_leave_unconfirmed($employee_id){
		// 	$this->db->select('*');
		// 	$this->db->from('leave_application');
		// 	$this->db->join('employee', 'employee.employee_id = leave_application.employee_id');
		// 	$this->db->where('leave_application.employee_id', $employee_id);
		// 	$this->db->where('app_status', 1);
		// 	// $this->db->where('confirmation', 2);

		// 	$unconfirmed = $this->db->get();

		// 	return $unconfirmed;
		// }

		function confirmation_leave($employee_id){
			$this->db->select('*');
			$this->db->from('leave_application');
			$this->db->join('employee', 'employee.employee_id = leave_application.employee_id');
			$this->db->where('leave_application.employee_id', $employee_id);
			$this->db->where('app_status', 1);
			$this->db->where('confirmation', 0);

			$confirmation_leave = $this->db->get();

			return $confirmation_leave;
		}

		function rejected_leave($employee_id){
			$this->db->select('*');
			$this->db->from('leave_application');
			$this->db->join('employee', 'employee.employee_id = leave_application.employee_id');
			$this->db->where('leave_application.employee_id', $employee_id);
			$this->db->where('app_status', 2);

			$rejected_leave = $this->db->get();

			return $rejected_leave;
		}

		// Leave Application

		function requested_application(){
			$this->db->select('*');
			$this->db->from('leave_application');
			$this->db->join('employee', 'employee.employee_id = leave_application.employee_id');
			$this->db->where('app_status', 0);

			$rejected_leave = $this->db->get();

			return $rejected_leave;
		}

		function view_application($app_id){
			$this->db->select('*');
			$this->db->from('leave_application');
			$this->db->join('employee', 'employee.employee_id = leave_application.employee_id');
			$this->db->join('designation', 'employee.employee_designation = designation.designation_id');
			$this->db->where('app_id', $app_id);

			$leave = $this->db->get();

			return $leave->row();
		}

		function accept_decision($app_id, $data)
		{
			if ($this->db->where('app_id', $app_id)->update("leave_application", $data)) 
			{
				return TRUE;
			}else{
				return false;
			}
		}

		function reject_decision($app_id, $data)
		{
			if($this->db->where('app_id', $app_id)->update("leave_application", $data))
				return true;
			else
				return false;

		}

		function agree_application($app_id, $data)
		{
			if($this->db->where('app_id', $app_id)->update("leave_application", $data))
				return true;
			else
				return false;

		}

		function disagree_application($app_id, $data)
		{
			if($this->db->where('app_id', $app_id)->update("leave_application", $data))
				return true;
			else
				return false;

		}

		function check_employee_leave($app_id, $start_month, $end_month){
			$this->db->select('*');
			$this->db->select('leave_application');
		}


	}
?>