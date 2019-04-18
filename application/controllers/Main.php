<?php
	use Twilio\Rest\Client;

	class Main extends My_Controller
	{
		public function index(){

			$this->load->model('CollectionModel');
			$data['employees'] = $this->CollectionModel->all_data();

			$this->load->view('user/index', $data);
			
		}
		
		public function start_time(){
			// date_default_timezone_set('Asia/Dhaka');
			//     echo date('m d y - g : i : s a');
			$this->load->model('EmployeeModel');
			$data['employees'] = $this->EmployeeModel->all_data();

			$this->load->view('user/start_time', $data);
		}

		public function lunch_start_time(){
			$this->load->model('EmployeeModel');
			$data['employees'] = $this->EmployeeModel->all_data();

			$this->load->view('user/lunch_start_time', $data);
		}

		public function lunch_end_time(){
			$this->load->model('EmployeeModel');
			$data['employees'] = $this->EmployeeModel->all_data();

			$this->load->view('user/lunch_end_time', $data);
		}

		public function end_time(){
			$this->load->model('EmployeeModel');
			$data['employees'] = $this->EmployeeModel->all_data();

			$this->load->view('user/end_time', $data);
		}

		public function store(){
			
			if ($this->input->post('start_time')) {
				$this->form_validation->set_rules('emp_user_id', 'Employee Username', 'required');
				if ($this->form_validation->run()) {
					date_default_timezone_set('Asia/Dhaka');

					$user_id = $this->input->post('emp_user_id');
					$date = date('Y-m-d');

					$this->load->model('CollectionModel');
					$check = $this->CollectionModel->check_user_id($user_id, $date);

					if ($check == null) {
						$data = array(
							"emp_user_id" => $this->input->post('emp_user_id'),	
							"start_time" => date('H:i:s'),	
							"insert_time" => date('Y-m-d'),	
						);

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

							redirect('main/index');
						}

					}else{
						$this->session->set_flashdata('message', 'Today You Already Inserted');
						redirect('main/index');
					}
				}
			}elseif ($this->input->post('lunch_start_time')) {
				$this->form_validation->set_rules('emp_user_id', 'Employee Username', 'required');
				if ($this->form_validation->run()) {
					$user_id = $this->input->post('emp_user_id');
					$date = date('Y-m-d');

					$this->load->model('CollectionModel');

					$check = $this->CollectionModel->check_user_id($user_id, $date)->lunch_start_time;
					

					if ($check) {
						if ($check == "00:00:00") {

							date_default_timezone_set('Asia/Dhaka');
							$datetime = date('Y-m-d H:i:s');

							$emp_user_id = $this->input->post('emp_user_id');

							$data = array(
								"emp_user_id" => $this->input->post('emp_user_id'),	
								"lunch_start_time" => date('H:i:s'),	
								"update_time" => date('Y-m-d H:i:s'),	
							);

							$date = date("Y-m-d",strtotime($datetime));

							$this->load->model('CollectionModel');
							$this->CollectionModel->lunch_start_time($data, $emp_user_id, $date);
							$this->session->set_flashdata('message', 'Update Successfully');
							
							if ($data) {
								// redirect('main/index', $data);
								// $this->load->model('CollectionModel');
								$employeeData = $this->CollectionModel->single_collection_data($user_id);
								$employee_name = $employeeData->row()->employee_name;
								$employee_phone = $employeeData->row()->employee_phone;

								$message = "( ".$employee_name." Start Lunch Time Now)";

								$this->sendMessage($employee_phone, $message);

								redirect('main/index');
							}

						}else{
							$this->session->set_flashdata('message', 'Your Lunch Time Is Running');
							redirect('main/index');
						}
					}else{
						$this->session->set_flashdata('message', 'Office Time Is Not Start');
						redirect('main/index');
					}
					
				}

			}elseif ($this->input->post('lunch_end_time')) {
				$this->form_validation->set_rules('emp_user_id', 'Employee Username', 'required');
				if ($this->form_validation->run()) {
					$user_id = $this->input->post('emp_user_id');
					$date = date('Y-m-d');

					$this->load->model('CollectionModel');
					$check_lunch_start_time = $this->CollectionModel->check_user_id($user_id, $date)->lunch_start_time;

					$check_lunch_end_time = $this->CollectionModel->check_user_id($user_id, $date)->lunch_end_time;

					if ($check_lunch_start_time != "00:00:00") {
						if ($check_lunch_end_time == "00:00:00") {

							date_default_timezone_set('Asia/Dhaka');
							$datetime = date('Y-m-d H:i:s');

							$emp_user_id = $this->input->post('emp_user_id');

							$data = array(
								"emp_user_id" => $this->input->post('emp_user_id'),	
								"lunch_end_time" => date('H:i:s'),	
								"update_time" => date('Y-m-d H:i:s'),	
							);

							$date = date("Y-m-d",strtotime($datetime));

							$this->load->model('CollectionModel');
							$this->CollectionModel->lunch_end_time($data, $emp_user_id, $date);
							$this->session->set_flashdata('message', 'Update Successfully');
							
							if ($data) {
								// redirect('main/index', $data);
								// $this->load->model('CollectionModel');
								$employeeData = $this->CollectionModel->single_collection_data($user_id);
								$employee_name = $employeeData->row()->employee_name;
								$employee_phone = $employeeData->row()->employee_phone;

								$message = "( ".$employee_name." Just Finished The Lunch)";

								$this->sendMessage($employee_phone, $message);

								redirect('main/index');
							}

						}else{
							$this->session->set_flashdata('message', 'Your Lunch Time Is Already Finished');
							redirect('main/index');
						}	
					}else{
						$this->session->set_flashdata('message', 'Your Lunch Time Is Not Started');
						redirect('main/index');
					}	
				}
			}elseif ($this->input->post('end_time')) {
				$this->form_validation->set_rules('emp_user_id', 'Employee Username', 'required');
				if ($this->form_validation->run()) {
					$user_id = $this->input->post('emp_user_id');
					$date = date('Y-m-d');

					$this->load->model('CollectionModel');
					$check_end_time = $this->CollectionModel->check_user_id($user_id, $date)->end_time;

					if ($check_end_time == "00:00:00") {

						date_default_timezone_set('Asia/Dhaka');
						$datetime = date('Y-m-d H:i:s');

						$emp_user_id = $this->input->post('emp_user_id');

						$data = array(
							"emp_user_id" => $this->input->post('emp_user_id'),	
							"end_time" => date('H:i:s'),	
							"update_time" => date('Y-m-d H:i:s'),	
						);

						$date = date("Y-m-d",strtotime($datetime));

						$this->load->model('CollectionModel');
						$this->CollectionModel->end_time($data, $emp_user_id, $date);
						$this->session->set_flashdata('message', 'Update Successfully');
						
						if ($data) {
							// redirect('main/index', $data);
							// $this->load->model('CollectionModel');
							$employeeData = $this->CollectionModel->single_collection_data($user_id);
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

							// $this->sendMessage($employee_phone, $smsMessage);
							$this->sendEmail($employee_email, $emailMessage, $emailSubject);

							redirect('main/index');
						}

					}else{
						$this->session->set_flashdata('message', 'Your Office Time Is Already Finished Or Your Office Time Was Not Start Today');
						redirect('main/index');
					}
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

		public function sendEmail($toEmail, $message, $subject){
			$from_email = "rudrasenr@gmail.com";
	        // $to_email = 'asadur.diu33@gmail.com';
	        //Load email library
	        
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

	        $this->email->from('ses@tos.tw');
	        $this->email->to($toEmail);
	        $this->email->subject($subject);
	        $this->email->message($message);

	        // echo "hello";
	        // echo exit();

	        //Send mail
	        if($this->email->send()){
	            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
				
				// redirect('main/index');
	        }

	        else
	            show_error($this->email->print_debugger());
	            // echo "fuckkk";

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

	}
?>