<?php
	/**
	 * 
	 */
	class Employee extends My_Controller
	{
		public function index(){
			
			if ($this->session->employee_id) {

				$this->dashboard();

			}else{
				$this->load->view('user/employee/index');
			}

		}

		public function login(){
			
			 $this->load->library('form_validation');

			 $this->form_validation->set_rules('user_id', 'User Id', 'required');
			 $this->form_validation->set_rules('password', 'Password', 'required|max_length[12]|min_length[5]');

			 if ($this->form_validation->run()) {
			 	$emp_user_id = $this->input->post('user_id');
			 	$password = md5($this->input->post('password'));

			 	$this->load->model('EmployeeModel');
			 	$data = $this->EmployeeModel->employee_login($emp_user_id, $password);

			 	if ($data) {
			 		$this->session->set_userdata('employee_id', $data->row()->employee_id);
			 		$this->session->set_userdata('emp_user_id', $data->row()->user_id);
			 		$this->session->set_userdata('employee_name', $data->row()->employee_name);
			 		$this->session->set_userdata('employee_image', $data->row()->employee_image);

			 		// $this->load->view('user/employee/dashboard', $employee_name, $employee_image);
			 		$this->dashboard();

			 	}else{
			 		$this->session->set_flashdata('message', 'Email or Password is not match');
			 		$this->load->view('user/employee/index');
			 	}

			 }else{
			 	$this->load->view('user/employee/index');
			 }
		}

		public function dashboard(){
	 		$this->auth();

	 		$employee_id = $this->session->employee_id;
	 		$today = date('Y-m-d');
	 		$front_day = date('Y-m-d',strtotime('+1440 minutes', strtotime($today)));


	 		$this->load->model('HolidayModel');
	 		$data['holiday'] = $this->HolidayModel->holiday_range_tomorrow($front_day);

	 		$this->load->view('user/employee/dashboard', $data);	

	 	}

 		public function logout(){
 			$this->session->unset_userdata('employee_id');
 			return redirect('employee/');
 		}


		public function attendance_report_today(){
			$this->auth();
			
			$user_id = $this->uri->segment(3);
			$date = $this->uri->segment(4);

			$this->load->model('CollectionModel');
			$data['employee'] = $this->CollectionModel->report_generate($user_id, $date);

			$this->load->view('user/employee/report_generate',$data);
		}

		public function attendance_report_weekly(){
			$this->auth();
			
			$emp_user_id = $this->uri->segment(3);
			$today = $this->uri->segment(4);

			$weekly_date = date('Y-m-d', strtotime('-10080 minutes', strtotime($today)));

			$this->load->model('CollectionModel');
			$data['employee_data'] = $this->CollectionModel->range_single_collection_data( $weekly_date, $today, $emp_user_id);

			$this->load->view('user/employee/single_weekly',$data);
		}

		public function holiday_all(){
			$this->load->model('HolidayModel');
			$data['all_holiday'] = $this->HolidayModel->holiday_all_data();

			$this->load->view('user/employee/holiday_all', $data);
		}

		public function work_report(){

			$id = $this->session->employee_id;
			$this->load->model('EmployeeModel');
			$data['reports'] = $this->EmployeeModel->own_reports($id);

			$this->load->view('user/employee/work_report/work_report', $data);
		}

		public function send_work_report(){
			date_default_timezone_set('Asia/Dhaka');
			// $this->load->model('HolidayModel');
			// $data['all_holiday'] = $this->HolidayModel->holiday_all_data();

			// $this->load->view('user/employee/work_report/work_report');
			// $this->form_validation->set_rules('employee_name', 'Name', 'required');
			$this->form_validation->set_rules('employee_message', 'Message', 'required');

			if ($this->form_validation->run()) {
					$employee_name = $this->input->post('employee_name');
					$employee_message = $this->input->post('employee_message');

				$data = array(
					"employee_name" => $this->input->post('employee_name'),
					"employee_message" => $this->input->post('employee_message'),
					"employee_id" => $this->session->employee_id,
					"insert_date" => date('Y-m-d H:m:s', now()),
				);

				$this->load->model('EmployeeModel');
				$this->EmployeeModel->store_send_message($data);

				// $this->sendEmail($employee_name, $employee_message);
				
			}else{
				$this->load->view('user/employee/work_report/work_report');
			}

		}

		public function sendEmail($employee_name, $employee_message){
			$from_email = "ses@tos.pw";
	        // $to_email = 'asadur.diu33@gmail.com';
	        //Load email library
	        $email = array();

	        $this->load->model('AdminModel');
	        $admin = $this->AdminModel->all_admin();

	        
	        $config = array();
	        $config['protocol'] = 'smtp';
	        $config['smtp_host'] = 'smtp.sparkpostmail.com';
	        $config['smtp_port'] = 2525;
	        $config['smtp_user'] = 'SMTP_Injection';
	        $config['smtp_pass'] = '6f68d7a7fe8c5155fad45c650a2672d986f6200e';
	        $config['mailtype'] = "html";
	        $config['mailtype'] = 'text';
	        $config['validation'] = TRUE;
	        $config['charset'] = 'iso-8859-1';
	        $config['smtp_crypto'] = 'tls';

	        // $this->email->initialize($config);
	        
	        $this->load->library('email', $config);

	        $this->email->set_newline("\r\n");

	        $this->email->from('ses@tos.pw');
	        $this->email->to('rudra1055@gmail.com');

	        foreach ($admin->result() as $row) {

	        	$email_array[] = $row->user_email;
	        	$ccEmail = implode(", ", $email_array);

		        $this->email->cc($ccEmail);
	        	
        	}

        	
	        $this->email->subject('Work Report ('.date('Y-m-d').')');
	        $this->email->message($employee_message);

	        // echo "hello";
	        // echo exit();

	        //Send mail
	        if($this->email->send()){
	            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
				
				redirect('employee/work_report');
	        }

	        else
	            show_error($this->email->print_debugger());
	            

		}

		public function apply_leave(){
			$this->load->view('user/employee/leave/apply_leave');
		}

		public function store_apply_leave(){

			$this->form_validation->set_rules('app_to','Apply To','required');			
			$this->form_validation->set_rules('app_type','Application Type','required');
			$this->form_validation->set_rules('app_date','Application Date','required');
			$this->form_validation->set_rules('app_start_date','Application Start Date','required');			
			$this->form_validation->set_rules('app_end_date','Application End Date','required');			
			$this->form_validation->set_rules('app_reason','Application Reason','required');

			if ($this->form_validation->run()) {
				
				$app_to = $this->input->post('app_to');
				$a = strtotime($this->input->post('app_end_date'));
				$b = strtotime($this->input->post('app_start_date'));
				$day = $a - $b;

                $total_day = ($day/(60*60))/24;
	                

				$data = array(
					"app_type" => $this->input->post('app_type'),
					"app_date" => $this->input->post('app_date'),
					"app_start_date" => $this->input->post('app_start_date'),
					"app_end_date" => $this->input->post('app_end_date'),
					"total_day" => $total_day + 1,
					"app_reason" => $this->input->post('app_reason'),
					"employee_id" => $this->session->employee_id,
					"insert_time" => date('Y-m-d H:m:s'),
				);

			// echo "<pre>";
			// print_r($data);

				$this->load->model('EmployeeModel');
				$this->EmployeeModel->store_apply_leave($data);
				$this->session->set_flashdata('message', 'Leave Submitted Successfully');
				
			}else{
				$this->load->view('user/employee/leave/apply_leave');

			}	

			


			$this->load->view('user/employee/leave/apply_leave');
		}

		public function pending_leave(){
			$employee_id = $this->uri->segment(3);

			$this->load->model('EmployeeModel');
			$data['pending_leave'] = $this->EmployeeModel->pending_leave($employee_id);

			$this->load->view('user/employee/leave/pending_leave', $data);
		}

		public function accepted_leave(){
			$employee_id = $this->uri->segment(3);

			$this->load->model('EmployeeModel');
			$data['accepted_leave'] = $this->EmployeeModel->accepted_leave($employee_id);
			// $data['unconfirmed'] = $this->EmployeeModel->accepted_leave_unconfirmed($employee_id);

			$this->load->view('user/employee/leave/accepted_leave', $data);
		}

		public function rejected_leave(){
			$employee_id = $this->uri->segment(3);

			$this->load->model('EmployeeModel');
			$data['rejected_leave'] = $this->EmployeeModel->rejected_leave($employee_id);

			$this->load->view('user/employee/leave/rejected_leave', $data);
		}

		public function confirmation_leave(){
			$employee_id = $this->uri->segment(3);

			$this->load->model('EmployeeModel');
			$data['confirmation_leave'] = $this->EmployeeModel->confirmation_leave($employee_id);

			$this->load->view('user/employee/leave/confirmation_leave', $data);
		}

		public function view_application(){
			$app_id = $this->uri->segment(3);

			$this->load->model('EmployeeModel');
			$data['requested_applications'] = $this->EmployeeModel->view_application($app_id);

			// echo "<pre>";
			// print_r($data);
			// exit();

			$this->load->view('user/employee/leave/view_application', $data);
		}

		public function agree_application(){
			$app_id = $this->uri->segment(3);

			$data = array(
				
				'confirmation' => 1,
			);

			// echo "<pre>";	
			// print_r($data);
			// exit();

			$this->load->model('EmployeeModel');
			$data = $this->EmployeeModel->agree_application($app_id, $data);

			if ($data) {
				return redirect('employee/confirmation_leave/'.$this->session->employee_id);
			}
 
		}

		public function disagree_application(){
			$app_id = $this->uri->segment(3);

			$data = array(
				
				'confirmation' => 2,
			);

			// echo "<pre>";	
			// print_r($data);
			// exit();

			$this->load->model('EmployeeModel');
			$data = $this->EmployeeModel->agree_application($app_id, $data);

			if ($data) {
				return redirect('employee/confirmation_leave');
			}
 
		}


		// Attendance

		public function employee_attendance(){
			// echo $this->session->emp_user_id;exit();
			$user_id = $this->session->emp_user_id;
			$today = date('Y-m-d');

			$this->load->model('CollectionModel');
			$data['collections'] = $this->CollectionModel->single_employee_collection_data($user_id, $today);
			$data['short_breaks'] = $this->CollectionModel->check_part_time_attendance($user_id, $today);

			$this->load->view('user/employee/attendance/attendance', $data);
		}

		// public function office_signin(){
		// 	// date_default_timezone_set('Asia/Dhaka');
		// 	//     echo date('m d y - g : i : s a');
		// 	$this->load->model('EmployeeModel');
		// 	$data['employees'] = $this->EmployeeModel->all_data();

		// 	$this->load->view('user/employee/attendance/office_signin', $data);
		// }

		// public function lunch_start_time(){
		// 	$this->load->model('EmployeeModel');
		// 	$data['employees'] = $this->EmployeeModel->all_data();

		// 	$this->load->view('user/employee/attendance/lunch_start_time', $data);
		// }

		// public function lunch_end_time(){
		// 	$this->load->model('EmployeeModel');
		// 	$data['employees'] = $this->EmployeeModel->all_data();

		// 	$this->load->view('user/employee/attendance/lunch_end_time', $data);
		// }

		// public function office_signout(){
		// 	$this->load->model('EmployeeModel');
		// 	$data['employees'] = $this->EmployeeModel->all_data();

		// 	$this->load->view('user/employee/attendance/office_signout', $data);
		// }

		// public function part_time_signin(){
		// 	$this->load->model('EmployeeModel');
		// 	$data['employees'] = $this->EmployeeModel->all_data();

		// 	$this->load->view('user/employee/attendance/part_time_signin', $data);
		// }

		// public function part_time_signout(){
		// 	$this->load->model('EmployeeModel');
		// 	$data['employees'] = $this->EmployeeModel->all_data();

		// 	$this->load->view('user/employee/attendance/part_time_signout', $data);
		// }

		public function attendance_store(){

			$from = $this->uri->segment(3);

			
			if ($from == 'start_time') {
				
				date_default_timezone_set('Asia/Dhaka');

				$user_id = $this->session->emp_user_id;
				$date = date('Y-m-d');

				$this->load->model('CollectionModel');
				$check = $this->CollectionModel->check_user_id($user_id, $date);
				$this->load->library('user_agent');

				if ($check == null) {
					$data = array(
						"emp_user_id" => $user_id,	
						"start_time" => date('H:i:s'),	
						"insert_time" => date('Y-m-d'),	
						// "client_browser" => $this->agent->browser(),
						// "browser_version" => $this->agent->version(),
						// "client_os" => $this->agent->platform(),
						"insert_ip_address" => $this->input->ip_address(),
						// "client_ip" => $_SERVER['REMOTE_ADDR'],
					);

					// echo "<pre>";
					// print_r($data); exit();

					$this->load->model('CollectionModel');
					$data['start_time'] = $this->CollectionModel->start_time_store($data);
					$this->session->set_flashdata('message', 'Insert Successfully');

					if ($data) {
						// redirect('main/index', $data);
						// $this->load->model('CollectionModel');
						$employeeData = $this->CollectionModel->single_attendance_data($user_id);
						$employee_name = $employeeData->row()->employee_name;
						$employee_phone = $employeeData->row()->employee_phone;

						$message = "( ".$employee_name." Start Office Time Now)";

						// $this->sendMessage($employee_phone, $message);

						redirect('employee/employee_attendance');
					}

				}else{
					$this->session->set_flashdata('message', 'Today You Already Inserted');
					redirect('employee/employee_attendance');
				}

			}elseif ( $from == 'lunch_start_time' ) {
				
				$user_id = $this->session->emp_user_id;
				$date = date('Y-m-d');

				$this->load->model('CollectionModel');

				$check = $this->CollectionModel->check_user_id($user_id, $date)->lunch_start_time;
				

				if ($check) {
					if ($check == "00:00:00") {

						date_default_timezone_set('Asia/Dhaka');
						$datetime = date('Y-m-d H:i:s');

						$emp_user_id = $user_id;

						$data = array(
							"emp_user_id" => $user_id,	
							"lunch_start_time" => date('H:i:s'),	
							"update_time" => date('Y-m-d H:i:s'),
							"update_ip_address" => $this->input->ip_address(),
						);

						// echo "<pre>";
						// print_r($data);
						// exit();

						$date = date("Y-m-d",strtotime($datetime));

						$this->load->model('CollectionModel');
						$this->CollectionModel->lunch_start_time($data, $emp_user_id, $date);
						$this->session->set_flashdata('message', 'Update Successfully');
						
						if ($data) {
							// redirect('main/index', $data);
							// $this->load->model('CollectionModel');
							$employeeData = $this->CollectionModel->single_attendance_data($user_id);
							$employee_name = $employeeData->row()->employee_name;
							$employee_phone = $employeeData->row()->employee_phone;

							$message = "( ".$employee_name." Start Lunch Time Now)";

							$this->sendMessage($employee_phone, $message);

							redirect('employee/employee_attendance');
						}

					}else{
						$this->session->set_flashdata('message', 'Your Lunch Time Is Running');
						redirect('employee/employee_attendance');
					}
				}else{
					$this->session->set_flashdata('message', 'Office Time Is Not Start');
					redirect('main/index');
				}

			}elseif ($from == 'lunch_end_time') {
				
				$user_id = $this->session->emp_user_id;
				$date = date('Y-m-d');

				$this->load->model('CollectionModel');
				$check_lunch_start_time = $this->CollectionModel->check_user_id($user_id, $date)->lunch_start_time;

				$check_lunch_end_time = $this->CollectionModel->check_user_id($user_id, $date)->lunch_end_time;

				if ($check_lunch_start_time != "00:00:00") {
					if ($check_lunch_end_time == "00:00:00") {

						date_default_timezone_set('Asia/Dhaka');
						$datetime = date('Y-m-d H:i:s');

						$emp_user_id = $this->session->emp_user_id;

						$data = array(
							"emp_user_id" => $this->session->emp_user_id,	
							"lunch_end_time" => date('H:i:s'),	
							"update_time" => date('Y-m-d H:i:s'),	
							"update_ip_address" => $this->input->ip_address(),

						);

						// echo "<pre>";
						// print_r($data);
						// exit();

						$date = date("Y-m-d",strtotime($datetime));

						$this->load->model('CollectionModel');
						$this->CollectionModel->lunch_end_time($data, $emp_user_id, $date);
						$this->session->set_flashdata('message', 'Update Successfully');
						
						if ($data) {
							// redirect('main/index', $data);
							// $this->load->model('CollectionModel');
							$employeeData = $this->CollectionModel->single_attendance_data($user_id);
							$employee_name = $employeeData->row()->employee_name;
							$employee_phone = $employeeData->row()->employee_phone;

							$message = "( ".$employee_name." Just Finished The Lunch)";

							// Send SMS Start

							// $this->sendMessage($employee_phone, $message);

							// Send SMS End

							redirect('employee/employee_attendance');
						}

					}else{
						$this->session->set_flashdata('message', 'Your Lunch Time Is Already Finished');
						redirect('employee/employee_attendance');
					}	
				}else{
					$this->session->set_flashdata('message', 'Your Lunch Time Is Not Started');
					redirect('main/index');
				}	

			}elseif ($from == 'end_time') {
				
				$user_id = $this->session->emp_user_id;
				$date = date('Y-m-d');

				$this->load->model('CollectionModel');
				$check_end_time = $this->CollectionModel->check_user_id($user_id, $date)->end_time;

				if ($check_end_time == "00:00:00") {

					date_default_timezone_set('Asia/Dhaka');
					$datetime = date('Y-m-d H:i:s');

					$emp_user_id = $this->session->emp_user_id;

					$data = array(
						"emp_user_id" => $this->session->emp_user_id,	
						"end_time" => date('H:i:s'),	
						"update_time" => date('Y-m-d H:i:s'),
						"update_ip_address" => $this->input->ip_address(),
					);



					$date = date("Y-m-d",strtotime($datetime));

					$this->load->model('CollectionModel');
					$this->CollectionModel->end_time($data, $emp_user_id, $date);
					$this->session->set_flashdata('message', 'Update Successfully');
					
					if ($data) {
						// redirect('main/index', $data);
						// $this->load->model('CollectionModel');
						$employeeData = $this->CollectionModel->single_attendance_data($user_id);
						$employee_name = $employeeData->row()->employee_name;
						$employee_phone = $employeeData->row()->employee_phone;
						$employee_email = $employeeData->row()->employee_email;

						$start_time = strtotime($employeeData->row()->start_time);
						$lunch_start_time = strtotime($employeeData->row()->lunch_start_time);
						$lunch_end_time = strtotime($employeeData->row()->lunch_end_time);
						$end_time = strtotime($employeeData->row()->end_time);

						$office_lunch_time = strtotime('+60 minutes', strtotime($employeeData->row()->lunch_start_time));

						$office_time = strtotime('+510 minutes', strtotime($employeeData->row()->start_time));

						$your_office_time = $end_time - $start_time;
						$your_lunch_time = $office_lunch_time - $lunch_end_time;

						$emailMessage = $this->email_text($start_time, $office_time, $your_office_time, $your_lunch_time, $employee_name);
						$emailSubject = 'TOS - Attendance Report ('.$date.')';

						$smsMessage = "( ".$employee_name." Just Finished The Office Time)";

						// Email And SMS Start

						// $this->sendMessage($employee_phone, $smsMessage);
						// $this->sendEmail($employee_email, $emailMessage, $emailSubject);

						// Email And SMS End

						redirect('employee/employee_attendance');
					}

				}else{
					$this->session->set_flashdata('message', 'Your Office Time Is Already Finished Or Your Office Time Was Not Start Today');
					redirect('employee/employee_attendance');
				}
				

			}elseif ($from == 'part_time_signout') {
				
				date_default_timezone_set('Asia/Dhaka');

				$user_id = $this->session->emp_user_id;
				$date = date('Y-m-d');


				$this->load->model('CollectionModel');
				$check = $this->CollectionModel->check_part_time_attendance($user_id, $date);

				// echo "<pre>";
				// print_r($check);
				// exit();

				// echo $check->part_time_signin;exit();
				
				if ($check->part_time_signin != '00:00:00') {
					$data = array(
						"employee_id" => $this->session->employee_id,
						"emp_user_id" => $this->session->emp_user_id,	
						"part_time_signout" => date('H:i:s'),	
						"insert_date" => date('Y-m-d'),	
						// "update_ip_address" => $this->input->ip_address(),

					);

					

					$this->load->model('CollectionModel');
					$data['start_time'] = $this->CollectionModel->part_time_signout($data);

					if ($data) {
						
						// $this->sendMessage($employee_phone, $message);

						$this->session->set_flashdata('message', 'Take a Short Break');
						redirect('employee/employee_attendance');
					}
				}else{
					$this->session->set_flashdata('message', 'You are In a Short Break');
						redirect('employee/employee_attendance');
				}

			}elseif ($from == 'part_time_signin') {
				
				date_default_timezone_set('Asia/Dhaka');

				$user_id = $this->session->emp_user_id;
				$date = date('Y-m-d');

				$this->load->model('CollectionModel');
				$check = $this->CollectionModel->check_part_time_attendance($user_id, $date);

				// echo "<pre>";
				// print_r($check);
				// exit();

				if ($check->part_time_signout != '00:00:00') {
					$data = array(	
						"part_time_signin" => date('H:i:s'),
					);

					$this->load->model('CollectionModel');
					$data['start_time'] = $this->CollectionModel->part_time_signin($data, $user_id, $date);

					if ($data) {
						
						// $this->sendMessage($employee_phone, $message);

						$this->session->set_flashdata('message', 'Welcome Back');
						redirect('employee/employee_attendance');
					}
				}else{
					$this->session->set_flashdata('message', 'You Allready Sign In');
						redirect('employee/employee_attendance');
				}

			}

		}



		public function sendMessage($phone, $message){
			
			$sid = "ACdccd38cc3136d6597e263597030ee720"; // Your Account SID from www.twilio.com/console
			$token = "970bd32a87a2b81c752e53abf5b4e8bf"; // Your Auth Token from www.twilio.com/console

			$client = new Twilio\Rest\Client($sid, $token);
			$sms = $client->messages->create(
			  '+8801940683100', // Text this number
			  array(
			    'from' => '+14582219917', // From a valid Twilio number
			    'body' => $message 
			  )
			);

			// print $message->sid;
			// redirect('main/index');
		}


		public function email_text($start_time, $office_time, $your_office_time, $your_lunch_time, $employee_name){

			if ($start_time > 36000 && $your_office_time < $office_time && $your_lunch_time < 0) {
				return 'Dear '.$employee_name.',
						Sorry to say that, Today you are getting late to join our office and you do not complete your office time. 	You take your lunch time more then one hour which is not allowed in our office and you finished your job today before complete your office hour. Please take care about that. ';
				
			}elseif ($your_office_time < $office_time && $your_lunch_time < 0) {
				return 'Dear '.$employee_name.',
						Sorry to say that, Today you do not complete your office time.  
						You take your lunch time more then one hour which is not allowed in our office and you finished your job today before complete your office hour. Please take care about that. ';
			}elseif ($your_office_time < $office_time && $your_lunch_time > 0) {
				return 'Dear '.$employee_name.',
						Sorry to say that, Today you do not complete your office time. you finished your job today before complete your office hour. Please take care about that. ';
			}elseif ($your_office_time > $office_time && $your_lunch_time < 0) {
				return 'Dear '.$employee_name.',
						Today You take your lunch time more then one hour which is not allowed in our office. Please take care about that. ';
			}else{
				return 'Dear '.$employee_name.',
						Today you done everything well. And you are getting a special thanks from TOS. ';
			}
		}





		// ------------------Task--------------------

		public function all_task(){
			$id = $this->session->employee_id;
			// echo $id;
			// exit();

			$this->db->order_by('task_id', 'desc');
			// $this->db->limit($config['per_page'], $limit); 	
			$this->db->select('*');	
			$this->db->join('employee', 'employee.employee_id = tbl_task.employee_id');
			$this->db->where('tbl_task.employee_id', $id);
			$q1=$this->db->get('tbl_task');
			$this->load->task=$q1;	

			$this->load->view('user/employee/task/all', ['task'=>$this->load->task]);
		}

		public function view_task($id=''){
			// $id = $this->session->employee_id;
			// echo $id;
			// exit();

			$this->db->select('*');	
			$this->db->join('employee', 'employee.employee_id = tbl_task.employee_id');
			$this->db->where('task_id', $id);
			
			$q1=$this->db->get('tbl_task');
			$this->load->task=$q1;	

			$this->load->view('user/employee/task/view', ['task'=>$this->load->task]);
		}

		public function task_report($id=''){
			$id = $this->uri->segment(3);
			$date = date('Y-m-d');

			$this->db->select('task_report');	
			$this->db->where('task_id', $id);
			
			$q1=$this->db->get('tbl_task');
			$this->load->report=$q1;

			// echo $this->load->report->row()->task_report;exit();

			if ($_POST) {

				$this->form_validation->set_rules('task_report', 'Task Report', 'required');

				if ($this->form_validation->run()) {
					$data = array(
						"task_report" => $this->load->report->row()->task_report.'<p style="color: green">'.$date.'</p>'.'<p>'.$this->input->post('task_report').'</p>',
					);

					// echo "<pre>";				
					// print_r($data);
					// exit();

					$insert = $this->db->where('task_id', $id)->update('tbl_task', $data);
					
					$this->session->set_flashdata('message', 'Employee Insert Successfully');

					redirect('employee/all_task');
					
				}else{
					$this->load->view('user/employee/task/task_report', compact('id'));
				}

			}else{
				$this->load->view('user/employee/task/task_report', compact('id'));
			}


		}





		

		

		

		

		

		

		
		
		

 		public function auth(){
 			if ($this->session->employee_id) {
	 			return TRUE;
	 		}else{
	 			// $this->load->view('admin');
	 			return redirect('employee/');
	 		}
 		}

	}


?>