<?php
	/**
	 * 
	 */
	class DashboardController extends CI_Controller
	{
		public function available(){
			date_default_timezone_set('Asia/Dhaka');
			$date = date('Y-m-d');

			$this->load->model('CollectionModel');
			$data['employees'] = $this->CollectionModel->today_collection_data($today);

			$this->load->view('admin/dashboard', $data);
		}
	}
?>