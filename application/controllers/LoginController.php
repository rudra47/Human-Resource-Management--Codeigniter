<?php 
	
	/**
	 * 
	 */
	class LoginController extends CI_Controller
	{
		
		public function login(){
			
			 $this->load->library('form_validation');

			 $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			 $this->form_validation->set_rules('password', 'Password', 'required|max_length[12]|min_length[5]');

			 if ($this->form_validation->run()) {
			 	$email = $this->input->post('email');
			 	$password = md5($this->input->post('password'));

			 	$this->load->model('AdminModel');
			 	$id = $this->AdminModel->login($email, $password);

			 	if ($id) {
			 		$this->session->set_userdata('user_id', $id);

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
			session_destroy();
			return redirect('admin/');
		}
	}

 ?>