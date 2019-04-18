<?php
	/**
	 * 
	 */
	class Admin extends My_Controller
	{
		public function index(){
			if ($this->session->user_id) {

				$this->dashboard();

			}else{
				$this->load->view('admin/index');
			}
		}

		public function login(){
			
			 $this->load->library('form_validation');

			 $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			 $this->form_validation->set_rules('password', 'Password', 'required|max_length[12]|min_length[5]');

			 if ($this->form_validation->run()) {
			 	$email = $this->input->post('email');
			 	$password = md5($this->input->post('password'));

			 	$this->load->model('AdminModel');
			 	$admin = $this->AdminModel->login($email, $password);

			 	if ($admin) {
			 		$this->session->set_userdata('user_id', $admin->user_id);
			 		$this->session->set_userdata('user_name', $admin->user_name);

			 		return $this->dashboard();

			 	}else{
			 		$this->session->set_flashdata('message', 'Email or Password is not match');
			 		$this->load->view('admin/index');
			 	}
			 }else{
			 	$this->load->view('admin/index');
			 }
		}

		public function logout(){
			// $this->auth();
			$this->session->unset_userdata('user_id');
			return redirect('admin/');
		}

	 	public function dashboard(){
	 		$this->auth();

	 		date_default_timezone_set('Asia/Dhaka');
	 		$today = date('Y-m-d');

	 		$this->load->model('CollectionModel');
	 		$data['employees'] = $this->CollectionModel->today_collection_data($today);

	 		$this->load->view('admin/dashboard', $data);	

	 	}


	 	public function all_employee(){
	 		$this->auth();
	 		$this->load->model('EmployeeModel');
	 		$data['employees'] = $this->EmployeeModel->all_data();

	 		$this->load->view('admin/employee/all', $data);
	 	}

	 	public function add_employee(){
			$this->auth();
			$this->load->model('EmployeeModel');
			$data['designations'] = $this->EmployeeModel->all_employee_designation();

			// echo "<pre>";
			// print_r($emp_designation);exit();

			$this->load->view('admin/employee/add', $data);
		}

		public function store_employee(){
			$this->auth();
			$this->load->helper('string');

			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['file_name'] = "img-".random_string('alnum',8);

			$this->load->library('upload', $config);
			$this->load->library('form_validation');

			$this->form_validation->set_rules('employee_name', 'Name', 'required');
			$this->form_validation->set_rules('employee_phone', 'Phone', 'required|is_unique[employee.employee_phone]');
			$this->form_validation->set_rules('employee_email','Email','required');
			$this->form_validation->set_rules('employee_designation','Designation','required');

			if (empty($_FILES['employee_image']['name']))
			{
			    $this->form_validation->set_rules('employee_image', 'Image', 'required');
			}


			// $this->form_validation->set_rules('employee_userid', 'User Id', 'required');

			if ($this->form_validation->run() && $this->upload->do_upload('employee_image')) {
				
				$data = array(
					"employee_name" => $this->input->post('employee_name'),
					"employee_phone" => $this->input->post('employee_phone'),
					"employee_email" => $this->input->post('employee_email'),
					"user_id" => "EM-".random_string('alnum',4),
					"employee_password" => md5('123456'),
					"employee_designation" => $this->input->post('employee_designation'),
					"employee_salary" => $this->input->post('employee_salary'),
				);

				echo "<pre>";				

					print_r($this->upload->data());
					exit();

				$image = $this->upload->data();

				$data['employee_image'] = $image['file_name'];

				// echo "<pre>";
				// print_r($data);
				// exit();

				$this->load->model('EmployeeModel');
				$this->EmployeeModel->store_employee($data);
				$this->session->set_flashdata('message', 'Employee Insert Successfully');

				redirect('admin/add_employee');

			}else{
				$this->load->view('admin/employee/add');
			}
			
		}

		public function edit_employee(){
			$this->auth();

			$id = $this->uri->segment(3);
			
			$this->load->model('EmployeeModel');
			$data['employee'] = $this->EmployeeModel->fatch_single_data($id);
			$data['designations'] = $this->EmployeeModel->all_employee_designation();

			$this->load->view('admin/employee/edit', $data);
		}

		public function view_employee(){
			$this->auth();

			$id = $this->uri->segment(3);
			$user_id = $this->uri->segment(4);
			
			$this->load->model('EmployeeModel');
			$data['employee'] = $this->EmployeeModel->fatch_single_data($id);

			$start_month = date('Y-m-1'); 
			
			$end_month = date('Y-m-d', strtotime('+1 months', strtotime($start_month)));

			$data['leave'] = $this->EmployeeModel->all_accepted_leave($id, $start_month, $end_month);

			$this->load->model('CollectionModel');
			$data['attendances'] = $this->CollectionModel->single_collection_data($user_id, $start_month, $end_month);

			// echo "<pre>";
			// print_r($dat);
			// exit();
			

			$this->load->view('admin/employee/view', $data);
		}

		public function update_employee(){
			$this->auth();

			$id = $this->uri->segment(3);

			$data = array(
				"employee_name" => $this->input->post('employee_name'),
				"employee_phone" => $this->input->post('employee_phone'),
				"employee_email" => $this->input->post('employee_email'),
				"employee_designation" => $this->input->post('employee_designation'),
				"employee_salary" => $this->input->post('employee_salary'),
			);

			$this->load->model('EmployeeModel');
			$this->EmployeeModel->update_employee($id, $data);

			$this->session->set_flashdata('message', 'Employee updated Successfully');

			redirect('admin/all_employee');

		}

		public function delete_employee($id){
			$this->auth();

			$id = $this->uri->segment(3);
			$this->load->model('EmployeeModel');
			$this->EmployeeModel->delete_data($id);

			$this->session->set_flashdata('message', 'Employee Delete Successfully');
			redirect('admin/all_employee');
		}

		public function attendance_today(){
			$this->auth();

			date_default_timezone_set('Asia/Dhaka');
			$today = date('Y-m-d');
			$this->load->model('CollectionModel');
			$data['collections'] = $this->CollectionModel->today_collection_data($today);

			$this->load->view('admin/collection/today', $data);
		}

		public function attendance_all(){
			$this->auth();

			if ($this->input->post('range_submit')) {

				$range_start_date = $this->input->post('range_start_date');
				$range_end_date = $this->input->post('range_end_date');
				

				$this->load->model('CollectionModel');
				$data['collections'] = $this->CollectionModel->range_all_collection_data($range_start_date, $range_end_date);

				$this->load->view('admin/collection/allday', $data);

			}elseif($this->input->post('range_single_submit')){

				$range_start_date = $this->input->post('range_start_date');
				$range_end_date = $this->input->post('range_end_date');
				
				$emp_user_id = $this->session->emp_user_id;

				$this->load->model('CollectionModel');
				$data['collections'] = $this->CollectionModel->range_single_collection_data($range_start_date, $range_end_date, $emp_user_id);

				$this->load->view('admin/collection/single_allday', $data);

			}else{
				$this->load->model('CollectionModel');
				$data['collections'] = $this->CollectionModel->all_collection_data();

				$this->load->view('admin/collection/allday', $data);
			}
		}

		public function attendance_single(){
			$this->auth();

			$data['employee_name'] = $this->uri->segment(3);
			$data['emp_user_id'] = $this->uri->segment(4);

			$emp_user_id = $this->uri->segment(4);

			if ($this->input->post('range_single_submit')) {
				$start_month = $this->input->post('date'); 
				$data['input_date'] = $this->input->post('date'); 
			}else{
				$start_month = date('Y-m-1'); 
			}
			$end_month = date('Y-m-d', strtotime('+1 months', strtotime($start_month)));

			$this->session->set_flashdata('emp_user_id', $emp_user_id);

			$this->load->model('CollectionModel');
			$data['collections'] = $this->CollectionModel->single_collection_data($emp_user_id, $start_month, $end_month);
			
			$data['short_break'] = $this->CollectionModel->part_time_attendance_date($emp_user_id);

			$this->load->view('admin/collection/single_allday', $data);
		}

		public function attendance_report(){
			$this->auth();
			
			$user_id = $this->uri->segment(3);
			$date = $this->uri->segment(4);

			$this->load->model('CollectionModel');
			$data['employee'] = $this->CollectionModel->report_generate($user_id, $date);

			$this->load->view('admin/collection/report',$data);
		}


		// Office Holiday CRUD

		public function all_holiday(){
			$this->load->model('HolidayModel');
			$data['all_holiday'] = $this->HolidayModel->holiday_all_data();

			$this->load->view('admin/holiday/all', $data);
		}

		public function add_holiday(){
			$this->load->view('admin/holiday/add');
		}

		public function store_holiday(){
			$this->auth();

			$this->form_validation->set_rules('holiday_description', 'Description', 'required');
			$this->form_validation->set_rules('holiday_date', 'Date', 'required');

			if ($this->form_validation->run()) {
				$data = array(
					"holiday_description" => $this->input->post('holiday_description'),
					"holiday_date" => $this->input->post('holiday_date'),
					"until_holiday_date" => $this->input->post('until_holiday_date'),
					"insert_date" => date('Y-m-d'),
					"admin_id" => $this->session->user_id
				);

				// if ($this->input->post('until_holiday_date')) {
				// 	$data['until_holiday_date'] = $this->input->post('until_holiday_date');
				// }

				// echo "<pre>";
				// print_r( $data );
				// echo "</pre>";

				$this->load->model('HolidayModel');
				$this->HolidayModel->store_holiday($data);

				$this->session->set_flashdata('message', 'Add Holiday Successfully');

				return redirect('admin/add_holiday');

			}

			// $this->load->view('admin/holiday/add');
		}

		public function edit_holiday(){
			$this->auth();

			$id = $this->uri->segment(3);
			
			$this->load->model('HolidayModel');
			$data['holiday'] = $this->HolidayModel->fatch_single_data_holiday($id);

			$this->load->view('admin/holiday/edit', $data);
		}

		public function update_holiday(){
			$this->auth();

			$id = $this->uri->segment(3);

			$data = array(
				"holiday_description" => $this->input->post('holiday_description'),
				"holiday_date" => $this->input->post('holiday_date'),
				"until_holiday_date" => $this->input->post('until_holiday_date'),
			);

			$this->load->model('HolidayModel');
			$this->HolidayModel->update_holiday($id, $data);

			$this->session->set_flashdata('message', 'Holiday updated Successfully');

			redirect('admin/all_holiday');

		}

		public function delete_holiday($id){
			$this->auth();

			$id = $this->uri->segment(3);
			$this->load->model('HolidayModel');
			$this->HolidayModel->delete_holiday($id);

			$this->session->set_flashdata('message', 'Holiday Delete Successfully');
			redirect('admin/all_holiday');
		}

		
		// Designation CRUD Start


		public function all_designation(){
	 		$this->auth();
	 		$this->load->model('EmployeeModel');
	 		$data['designations'] = $this->EmployeeModel->all_employee_designation();

	 		$this->load->view('admin/designation/all', $data);
	 	}

	 	public function add_designation(){
			$this->auth();
			// $this->load->model('EmployeeModel');
			// $data['designations'] = $this->EmployeeModel->employee_designation();

			// echo "<pre>";
			// print_r($emp_designation);exit();

			$this->load->view('admin/designation/add');
		}

		public function store_designation(){
			$this->auth();
			$this->load->helper('string');

			$this->load->library('form_validation');

			$this->form_validation->set_rules('designation_name', 'Name', 'required');
			

			if ($this->form_validation->run() ) {
				
				$data = array(
					"designation_name" => $this->input->post('designation_name'),
					"added_by" => $this->session->user_name,
					
				);


				// echo "<pre>";
				// print_r($data);
				// exit();

				$this->load->model('EmployeeModel');
				$this->EmployeeModel->store_designation($data);
				$this->session->set_flashdata('message', 'Designation Insert Successfully');

				redirect('admin/add_designation');

			}else{
				$this->load->view('admin/designation/add');
			}
			
		}

		public function edit_designation(){
			$this->auth();

			$id = $this->uri->segment(3);
			
			$this->load->model('EmployeeModel');
			$data['designation'] = $this->EmployeeModel->fatch_single_designation($id);
			// $data['designations'] = $this->EmployeeModel->employee_designation();


			$this->load->view('admin/designation/edit', $data);
		}

		public function update_designation(){
			$this->auth();

			$id = $this->uri->segment(3);

			$data = array(
				"designation_name" => $this->input->post('designation_name'),
				"edited_by" => $this->session->user_name,
			);

			$this->load->model('EmployeeModel');
			$this->EmployeeModel->update_designation($id, $data);

			$this->session->set_flashdata('message', 'Employee updated Successfully');

			redirect('admin/all_designation');

		}

		public function delete_designation($id){
			$this->auth();

			$id = $this->uri->segment(3);

			$data = array(
				'designation_status' => 0,
				"edited_by" => $this->session->user_name,
			);

			$this->load->model('EmployeeModel');
			$this->EmployeeModel->soft_delete_designation($id, $data);

			$this->session->set_flashdata('message', 'Designation Delete Successfully');
			redirect('admin/all_designation');
		}

		// Requested For Leave

		public function requested_application(){
			$this->load->model('EmployeeModel');
			$data['requested_applications'] = $this->EmployeeModel->requested_application();

			$this->load->view('admin/leave_app/requested_application', $data);
		}

		public function view_application(){
			$app_id = $this->uri->segment(3);

			$start_month = date('Y-m-1'); 
			
			$end_month = date('Y-m-d', strtotime('+1 months', strtotime($start_month)));



			$this->load->model('EmployeeModel');
			$data['requested_applications'] = $this->EmployeeModel->view_application($app_id);

			$data['check_employee_leave'] = $this->EmployeeModel->check_employee_leave($app_id, $start_month, $end_month);

			// echo "<pre>";
			// print_r($data);
			// exit();

			$this->load->view('admin/leave_app/view_application', $data);
		}

		public function accept_application(){
			$app_id = $this->uri->segment(3);

			$data = array(
				'leave_type' => $this->input->post('leave_type'),
				'paid_amount' => $this->input->post('paid_amount'),
				'update_time' => date('Y-m-d H:m:s'),
				'app_status' => 1,
			);

			// echo "<pre>";	
			// print_r($data);
			// exit();

			$this->load->model('EmployeeModel');
			$data = $this->EmployeeModel->accept_decision($app_id, $data);

			if ($data) {
				return redirect('admin/requested_application');
			}
 
		}

		public function reject_application(){
			$app_id = $this->uri->segment(3);

			$data = array(
				'update_time' => date('Y-m-d H:m:s'),
				'app_status' => 2,
			);

			// echo "<pre>";	
			// print_r($data);
			// exit();

			$this->load->model('EmployeeModel');
			$data = $this->EmployeeModel->reject_decision($app_id, $data);

			if ($data) {
				return redirect('admin/requested_application');
			}


		}


		// ------------------- Task -------------------

		public function add_task(){
			// $this->session->unset_userdata('message');
			$this->load->model('EmployeeModel');
			$employees = $this->EmployeeModel->all_data();

			if ($_POST) {

				$this->form_validation->set_rules('employee_id', 'Name', 'required');
				$this->form_validation->set_rules('task_title', 'Task Title', 'required');
				$this->form_validation->set_rules('task_start_date', 'Task Start Date', 'required');
				$this->form_validation->set_rules('task_death_date', 'Task Death Date', 'required');
				$this->form_validation->set_rules('task_description', 'Task Description', 'required');

				if($this->form_validation->run() == FALSE){
					redirect('admin/add_task');
				}else{
					foreach($this->input->post() as $key=>$value){
						$$key=$value;
					}

					$sql_data = array(
						'employee_id' => $employee_id,
						'task_title' => $task_title,
						'task_start_date' => $task_start_date,
						'task_death_date' => $task_death_date,
						'task_description' => $task_description,
					);

					// echo "<pre>";
					// print_r($sql_data);
					// exit();

					$insert=$this->db->insert('tbl_task', $sql_data);

					if($insert){
						$this->session->set_flashdata('message', 'Record successfullly added.');
						redirect('admin/all_task');	 
					}else{
					 	$this->session->set_flashdata('message', 'Records not added. There is problem.');
						$this->load->view('admin/task/all');
					}

				}

			}else{
				$this->load->view('admin/task/add',['employees'=> $employees]);
			}
		}

		public function all_task(){
			// $limit=filter_var(trim($this->uri->segment(4, 0)), FILTER_VALIDATE_INT);
			
			$this->db->order_by('task_id', 'desc');
			// $this->db->limit($config['per_page'], $limit); 	
			$this->db->select('*');	
			$this->db->join('employee', 'employee.employee_id = tbl_task.employee_id');
			$q1=$this->db->get('tbl_task');
			$this->load->task=$q1;	

			// echo "<pre>";
			// print_r($this->load->task);
			// exit();

			$this->load->view('admin/task/all', ['task'=>$this->load->task]);
		}

		public function view_task($id=''){
			$this->db->select('*');	
			$this->db->join('employee', 'employee.employee_id = tbl_task.employee_id');
			$this->db->where('task_id', $id);	
			$q1=$this->db->get('tbl_task');
			$this->load->task=$q1;	

			// echo "<pre>";
			// print_r($this->load->task);
			// exit();

			$this->load->view('admin/task/view', ['task'=>$this->load->task]);
		}

		public function delete_task($id=''){
			$this->db->where('task_id', $id);
			$this->db->delete('tbl_task');
			
			redirect('admin/all_task');
		}


		public function task_status($id=''){
			$data = array(
				'task_status'=>1
			);
			$this->db->where('task_id', $id);
			$this->db->update('tbl_task', $data);

			$this->session->flashdata('message', 'Successfully Done');
			
			redirect('admin/all_task');
		}
		
















	 	public function auth(){
 			if ($this->session->user_id) {
	 			return TRUE;
	 		}else{
	 			// $this->load->view('admin');
	 			return redirect('admin/');
	 		}
 		}


	}
?>