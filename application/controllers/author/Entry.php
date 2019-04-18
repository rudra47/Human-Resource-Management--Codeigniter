<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Entry extends My_Controller
{
	public function __construct(){
		parent::__construct();
		
		/*if($this->users->user_validate('9') == false)
		redirect('author/auth/warning');*/
		
		//date_default_timezone_set('Asia/dhaka');
		
	}

	public function layout($page_name){
  		$this->load->view('author/layouts/head', $this->data);
  		$this->load->view('author/layouts/sidebar', $this->data);
  		$this->load->view('author/layouts/header', $this->data);
		$this->load->view('author/'.$page_name, $this->data);
		$this->load->view('author/layouts/footer');		
	}

	public function index()
	{
		
		$this->data['title']='Control Panel: Entry Manager';
		$this->data['page_name']='entry';
		$this->data['page_icon']='<i class="fa fa-book"></i>';

		$this->data['headline']='';
		$this->data['successmgs']=$this->session->userdata('successmgs');
		$this->session->unset_userdata('successmgs');
					
		$this->load->js[]="public/css/fonts.css";
		$this->load->js[]="public/js/default.js";
		$this->load->js[]="public/js/checkall.js";
		$this->load->js[]="public/js/sorttable.js";
		$this->load->js[]="third_party/facebox/facebox.js";
		$this->load->css[]="third_party/facebox/facebox.css";		

		$filter=$this->input->post();
		if(isset($filter['filter_text']))
		$filter_text=$filter['filter_text'];
	
		if($_POST){
			$this->db->order_by('en_id');
			$this->db->like('en_id',$filter_text);
			$this->db->select('*');	
			$q=$this->db->get('tbl_ac_entry');
			$this->load->category=$q->result_array();
								
			$data['pages_links']=' ';	
	    }else{

			$config['base_url'] = base_url().'index.php/author/entry/index';
			$config['per_page'] = 20;
			//$config['display_pages']=FALSE;
			$config['num_links'] =5;
			$config['uri_segment'] = 4;
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			//$config['use_page_numbers'] = FALSE;
			//$config['page_query_string'] = FALSE;
			$config['last_link'] = 'Last';
			$config['first_link'] = 'First';
			$config['cur_tag_open'] = '<span class=current>';
			$config['cur_tag_close'] = '</span>';
			//$config['next_link'] = '&gt;';

			$limit=filter_var(trim($this->uri->segment(4, 0)), FILTER_VALIDATE_INT);
			
			$this->db->order_by('en_id');
			$this->db->limit($config['per_page'], $limit); 	
			$this->db->select('*');	
			$q1=$this->db->get('tbl_ac_entry');
			$this->load->entry=$q1->result_array();									
						 
			$config['total_rows'] = $this->db->count_all_results('tbl_ac_entry');
			
			$this->pagination->initialize($config);
			$this->data['pages_links']=$this->pagination->create_links();
		}
				
		$this->layout('entry/index');
	}

	//-----------add function-----------------s
	
	public  function add(){

		$this->data['title']='Entry Manager &rarr; Add New Entry';
		$this->data['page_name']='entry/add';
		$this->data['parent_page']='entry';
		$this->data['page_icon']='<i class="fa fa-book"></i>';		
		$this->data['headline']='';		
		$this->data['date']=date("Y-m-d");
		
		$this->load->css[]="public/css/jquery-ui.min.css";
		$this->load->js[]="public/js/defaultjs.js";
		$this->load->js[]="public/js/jquery-ui.min.js";
		

		$this->db->order_by('aca_id');
		// $this->db->where( array('cat_parent'=>'root') );
		$this->db->select('aca_id, aca_title');	
		$q1=$this->db->get('tbl_ac_accounts');
		$this->load->ledger=$q1->result_array();	
							
				
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="errormgs" style="color:red;">', '</span>');
				
		if($_POST){
			$this->form_validation->set_rules('en_num', 'Number', 'required');
			$this->form_validation->set_rules('date', 'Date');
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('ledger', 'Ledger', 'required');
			$this->form_validation->set_rules('description', 'Description');
			// $this->form_validation->set_rules('tag', 'Tag', 'required');
			
			if($this->form_validation->run() == FALSE){
				$this->layout('entry/add_new');
			}else{

				foreach($this->input->post() as $key=>$value){
					 $$key=$value;
				}
				
				$sql_data=array(
					'en_num'=>$en_num,
					'en_date'=>$date,
					'en_dr_cr'=>$type,
					'en_aca_id'=>$ledger, 
					'en_description'=>$description,
					// 'cat_date'=>$tag,
					
				);

				$insert=$this->db->insert('tbl_ac_entry', $sql_data);
				
				if($insert){
					$this->session->set_userdata('successmgs', 'Record successfullly added.');
					redirect('author/entry/index/'.$this->uri->segment(5));	 
				}else{
				 	$this->data['message']="Records not added. There is problem";
					$this->layout('entry/add_new');
				 }
			}
			
		}else{
			$this->layout('entry/add_new');
		}
	}

	//edit-function-----------------------

	public  function edit($id=''){

		if(!isset($id) || empty($id) ){
			show_404();
		}
			
		$this->data['title']='Entry Manager &rarr; Edit Entry';
		$this->data['page_name']='entry/edit';
		$this->data['parent_page']='entry';
		$this->data['page_icon']='<i class="fa fa-book"></i>';		
		$this->data['headline']='';
		$this->data['date']=date("Y-m-d");

		$this->load->css[]="public/css/jquery-ui.min.css";
		$this->load->js[]="public/js/defaultjs.js";
		$this->load->js[]="public/js/jquery-ui.min.js";

		$this->db->select('*')->where('en_id',$id);
		$value=$this->db->get('tbl_ac_entry');
		$this->load->entry_info=$value->row();


		$this->db->order_by('aca_id');
		// $this->db->where( array('cat_parent'=>'root') );
		$this->db->select('aca_id, aca_title');	
		$q1=$this->db->get('tbl_ac_accounts');
		$this->load->ledger=$q1->result_array();
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="errormgs" style="color:red;">', '</span>');
				
		if($_POST){
			$this->form_validation->set_rules('en_num', 'Number', 'required');
			$this->form_validation->set_rules('date', 'Date');
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('ledger', 'Ledger', 'required');
			$this->form_validation->set_rules('description', 'Description');
			
			if($this->form_validation->run() == FALSE){
					$this->layout('entry/edit');
			}else{
				
				foreach($this->input->post() as $key=>$value){
					 $$key=$value;
				}
				
				$sql_data=array(
					'en_num'=>$en_num,
					'en_date'=>$date,
					'en_dr_cr'=>$type,
					'en_aca_id'=>$ledger, 
					'en_description'=>$description,
				);
				
				$this->db->where('en_id', $id);
				$update=$this->db->update('tbl_ac_entry', $sql_data);
				
				if($update){
					$this->session->set_userdata('successmgs', 'Record successfullly Updated.');
					redirect('author/entry/index/'.$this->uri->segment(5));
				 }else{
				 	$data['message']="Records not update. There is some problem";
					$this->layout('entry/edit');
				 }
			}
		}else{
				$this->layout('entry/edit');
		}
	}
	

	//------------View Function-----------------------------


	public function view($id=""){

		if(!isset($id) || empty($id) ){
			show_404();
		}
			
		$this->data['title']='Entry Manager &rarr; View Entry';
		$this->data['page_name']='entry/view';
		$this->data['parent_page']='entry';
		$this->data['page_icon']='<i class="fa fa-book"></i>';		
		$this->data['headline']='';

		$this->load->css[]="public/css/jquery-ui.min.css";
		$this->load->js[]="public/js/defaultjs.js";
		$this->load->js[]="public/js/jquery-ui.min.js";

		$this->db->select('*')->where('en_id',$id);
		$value=$this->db->get('tbl_ac_entry');
		$this->load->entry_info=$value->row();

		$this->db->select('*');
		$value=$this->db->get('tbl_ac_accounts');
		$this->load->ledger_info=$value;

		// echo "<pre>";
		// print_r($value); exit();

		$this->layout('entry/view');
	}


}


?>