<?php  
	/**
	 * 
	 */
	class SendReport extends My_Controller
	{
		public function report_sending(){
			$today = date('Y-m-d');
			$emp_id = $this->session->userdata('employee_id');

			$this->db->select('*');	
			$this->db->where('insert_date', $today);	
			$this->db->where('employee_id', $emp_id);	
			$q1=$this->db->get('work_report');
			$this->load->report=$q1->result_array();

			for($i=0; $i<count($this->load->report); $i++){
				$rep_id[]=$this->load->report[$i]['report_id'];
				$rep_message[]=$this->load->report[$i]['employee_message'];
			}
			// $report=array_combine($rep_id, $rep_message);

			echo "<pre>";
			// echo $this->session->userdata('employee_id');
			// echo count($this->load->report);
			print_r($this->load->report);

			exit();

		}

		public function sendEmailProcess($employee_name, $employee_message){
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

	}

?>