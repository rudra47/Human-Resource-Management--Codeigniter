<?php
	/**
	 * 
	 */
	class CollectionModel extends CI_Model
	{
		function start_time_store($data){
			$this->db->set($data);
			$this->db->insert('collection');
		}

		function lunch_start_time($data, $emp_user_id, $date){
			
			$this->db->set($data);
			$this->db->where('emp_user_id', $emp_user_id)->where('insert_time', $date)->update('collection');
		}

		function lunch_end_time($data, $emp_user_id, $date){
			
			$this->db->set($data);
			$this->db->where('emp_user_id', $emp_user_id)->where('insert_time', $date)->update('collection');
		}

		function end_time($data, $emp_user_id, $date){
			
			$this->db->set($data);
			$this->db->where('emp_user_id', $emp_user_id)->where('insert_time', $date)->update('collection');
		}

		function part_time_signout($data){
			$this->db->set($data);
			$this->db->insert('part_time_attendance');
		}

		function part_time_signin($data, $emp_user_id, $date){
			$this->db->set($data);
			$this->db->where('emp_user_id', $emp_user_id)->where('insert_date', $date)->update('part_time_attendance');
		}

		function all_data()
		{
			$employees = $this->db->get('employee');

			return $employees;
		}

		function today_collection_data($today)
		{
			$this->db->select('*');
			$this->db->from('collection');
			$this->db->join('employee', 'collection.emp_user_id = employee.user_id');
			$this->db->where('insert_time', $today);

			$collections = $this->db->get();

			// $collections = $this->db->where('insert_time', $today)->get('collection');

			return $collections;
		}

		function single_employee_collection_data($user_id, $today)
		{
			$this->db->select('*');
			$this->db->from('collection');
			$this->db->join('employee', 'collection.emp_user_id = employee.user_id');
			$this->db->where('emp_user_id', $user_id);
			$this->db->where('insert_time', $today);

			$collections = $this->db->get();

			// $collections = $this->db->where('insert_time', $today)->get('collection');

			return $collections;
		}

		function all_collection_data()
		{
			$this->db->select('*');
			$this->db->from('collection');
			$this->db->join('employee', 'collection.emp_user_id = employee.user_id');

			$collections = $this->db->get();

			// $collections = $this->db->get('collection');

			return $collections;
		}

		function single_attendance_data($user_id)
		{
			$this->db->select('*');
			$this->db->from('collection');
			$this->db->join('employee', 'collection.emp_user_id = employee.user_id');
			$this->db->where('emp_user_id', $user_id);

			$collections = $this->db->get();

			// $collections = $this->db->get('collection');

			return $collections;
		}

		function single_collection_data($user_id, $start_month, $end_month)
		{
			$this->db->select('*');
			$this->db->from('collection');
			$this->db->join('employee', 'collection.emp_user_id = employee.user_id');
			$this->db->where('emp_user_id', $user_id);
			$this->db->where('insert_time >=',$start_month);
			$this->db->where('insert_time <',$end_month); 

			$collections = $this->db->get();

			// $collections = $this->db->get('collection');

			return $collections;
		}

		function part_time_attendance_date($user_id)
		{
			$this->db->select('*');
			$this->db->from('part_time_attendance');
			$this->db->where('emp_user_id', $user_id);

			$short_break = $this->db->get();

			// $collections = $this->db->get('collection');

			return $short_break;
		}

		function report_generate($user_id, $date){

			$this->db->select('*');
			$this->db->from('collection');
			$this->db->join('employee', 'collection.emp_user_id = employee.user_id');
			$this->db->where('emp_user_id', $user_id);
			$this->db->where('insert_time', $date);

			$employee = $this->db->get();

			return $employee;
		}

		function check_user_id($user_id, $date){
			$this->db->select('*');
			$this->db->from('collection');
			$this->db->where('emp_user_id', $user_id);
			$this->db->where('insert_time', $date);

			$check = $this->db->get();

			// $check = $this->db->get('collection');

			return $check->row();;
		}

		function check_part_time_attendance($user_id, $date){
			$this->db->select('*');
			$this->db->from('part_time_attendance');
			$this->db->where('emp_user_id', $user_id);
			// $this->db->where('insert_date', $date);
			$this->db->order_by('attendance_id',"desc")->limit(1);

			$check = $this->db->get();

			// $check = $this->db->get('collection');

			return $check;
		}

		function range_all_collection_data($range_start_date, $range_end_date){
			$this->db->select('*');
			$this->db->from('collection');
			// $this->db->where('emp_user_id', $user_id);
			$this->db->join('employee', 'collection.emp_user_id = employee.user_id');
			$this->db->where('insert_time >=',$range_start_date);
			$this->db->where('insert_time <=',$range_end_date); 

			$check = $this->db->get();

			// $check = $this->db->get('collection');

			return $check;
		}

		function range_single_collection_data($range_start_date, $range_end_date, $emp_user_id){
			$this->db->select('*');
			$this->db->from('collection');
			$this->db->join('employee', 'collection.emp_user_id = employee.user_id');
			$this->db->where('emp_user_id', $emp_user_id);
			$this->db->where('insert_time >=',$range_start_date);
			$this->db->where('insert_time <=',$range_end_date); 

			$check = $this->db->get();

			// $check = $this->db->get('collection');

			return $check;
		}
	}
?>