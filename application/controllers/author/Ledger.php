<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ledger extends My_Controller {
	
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

		$this->data['title']='Control Panel: Ledger Manager';
		$this->data['page_name']='ledger';
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
		$this->load->css[]="maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css";		

		$filter=$this->input->post();
		if(isset($filter['filter_text']))
		$filter_text=$filter['filter_text'];

		if($_POST){
			$this->db->order_by('aca_id');
			// $this->db->like('grp_id',$filter_text);
			$this->db->select('*');	
			$q=$this->db->get('tbl_ac_accounts');
			$this->load->ledger=$q->result_array();
								
			$data['pages_links']=' ';	

	    }else{

			$config['base_url'] = base_url().'author/ledger/index';
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
			
			$this->db->order_by('aca_id');
			$this->db->limit($config['per_page'], $limit); 	
			$this->db->select('*');	
			$q1=$this->db->get('tbl_ac_accounts');
			$this->load->ledger=$q1->result_array();	

			$this->db->select('*');
			$value=$this->db->get('tbl_ac_group');
			$this->load->group_info=$value;								
						 
			$config['total_rows'] = $this->db->count_all_results('tbl_ac_accounts');
			
			$this->pagination->initialize($config);
			$this->data['pages_links']=$this->pagination->create_links();
		}
				
		$this->layout('ledger/index');
	}

	//-----------add function-----------------s
	
	public  function add(){

		$this->data['title']='Ledger Manager &rarr; Add New Ledger';
		$this->data['page_name']='ledger/add';
		$this->data['parent_page']='ledger';
		$this->data['page_icon']='<i class="fa fa-book"></i>';		
		$this->data['headline']='';		
		$this->data['date']=date("Y-m-d");
		
		$this->load->css[]="public/css/jquery-ui.min.css";
		$this->load->js[]="public/js/defaultjs.js";
		$this->load->js[]="public/js/jquery-ui.min.js";
		

		$this->db->order_by('grp_id');
		// $this->db->where( array('grp_parent'=>'root') );
		$this->db->select('grp_id, grp_title');	
		$q1=$this->db->get('tbl_ac_group');
		$this->load->grp=$q1->result_array();	
							
				
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="errormgs" style="color:red;">', '</span>');
				
		if($_POST){
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('p_grp', 'Parent Group', 'required');
			$this->form_validation->set_rules('drcr', 'Dr/Cr', 'required');
			$this->form_validation->set_rules('balance', 'Opening Balance', 'required');
			$this->form_validation->set_rules('description', 'Description');
			$this->form_validation->set_rules('aca_bank_cash', 'accept');
			$this->form_validation->set_rules('aca_reconciliation', 'accept');
			
			if($this->form_validation->run() == FALSE){
				$this->layout('ledger/add_new');
			}else{

				foreach($this->input->post() as $key=>$value){
					 $$key=$value;
				}
				
				$sql_data=array(
					'aca_title'=>$name, 
					'aca_grp_id'=>$p_grp,
					'aca_type'=>$drcr,
					'aca_balance'=>$balance, 
					'aca_bank_cash'=>$aca_bank_cash,
					'aca_reconciliation'=>$aca_reconciliation,
					'aca_note'=>$description,
					'aca_date'=>date('Y-m-d'),
				);

				$insert=$this->db->insert('tbl_ac_accounts', $sql_data);
				
				if($insert){
					$this->session->set_userdata('successmgs', 'Record successfullly added.');
					redirect('author/ledger/index/'.$this->uri->segment(5));	 
				}else{
				 	$this->data['message']="Records not added. There is problem";
					$this->layout('ledger/add_new');
				 }
			}
			
		}else{
			$this->layout('ledger/add_new');
		}
	}
	
	//edit-function-----------------------
	public  function edit($id=''){

		if(!isset($id) || empty($id) ){
			show_404();
		}
			
		$this->data['title']='Category Manager &rarr; Edit Category';
		$this->data['page_name']='category/edit';
		$this->data['parent_page']='category';
		$this->data['page_icon']='<i class="fa fa-book"></i>';		
		$this->data['headline']='';

		$this->load->css[]="public/css/jquery-ui.min.css";
		$this->load->js[]="public/js/defaultjs.js";
		$this->load->js[]="public/js/jquery-ui.min.js";

		$this->db->select('*')->where('aca_id',$id);
		$value=$this->db->get('tbl_ac_accounts');
		$this->load->ledger_info=$value->row();


		$this->db->order_by('grp_id');
		// $this->db->where( array('grp_id'=>$id) );
		$this->db->select('grp_id, grp_title');	
		$q1=$this->db->get('tbl_ac_group');
		$this->load->grp=$q1->result_array();
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="errormgs" style="color:red;">', '</span>');
				
		if($_POST){
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('p_grp', 'Parent Group', 'required');
			$this->form_validation->set_rules('drcr', 'Dr/Cr', 'required');
			$this->form_validation->set_rules('balance', 'Opening Balance', 'required');
			$this->form_validation->set_rules('description', 'Description');
			$this->form_validation->set_rules('aca_bank_cash', 'accept');
			$this->form_validation->set_rules('aca_reconciliation', 'accept');
			
			
			if($this->form_validation->run() == FALSE){
					$this->layout('ledger/edit');
			}else{
				
				foreach($this->input->post() as $key=>$value){
					 $$key=$value;
				}
				
				$sql_data=array(
					'aca_title'=>$name, 
					'aca_grp_id'=>$p_grp,
					'aca_type'=>$drcr,
					'aca_balance'=>$balance, 
					'aca_bank_cash'=>$aca_bank_cash,
					'aca_reconciliation'=>$aca_reconciliation,
					'aca_note'=>$description,
				);
				
				$this->db->where('aca_id', $id);
				$update=$this->db->update('tbl_ac_accounts', $sql_data);
				
				if($update){
					$this->session->set_userdata('successmgs', 'Record successfullly Updated.');
					redirect('author/ledger/index/'.$this->uri->segment(5));
				 }else{
				 	$data['message']="Records not update. There is some problem";
					$this->layout('ledger/edit');
				 }
			}
		}else{
				$this->layout('ledger/edit');
		}
	}
	

	
	
	//------------Delete Function-----------------------------

	public  function delete($id=''){					
		if(isset($id) && !empty($id)){	
		 if($id!=1){
			$this->data['title']="Delete Category";			
			$this->elanguage->select('category', 'cat_id', array('cat_id'=>$id));
			$this->data['idtodel']=$this->elanguage->result;
			if(isset($this->data['idtodel'][0]) && !empty($this->data['idtodel'][0]))
			{
			
				if($_POST){
					$getid=$this->input->post('id');
					$delete=$this->elanguage->delete('category', 'cat_id', $getid);
					
					$data = array(
							'r_catid' => 1,
					);				
					$this->db->where('r_catid', $getid);
					$this->db->update('category_article', $data);
					
					if($delete){										
						$this->session->set_userdata('successmgs', 'Category Deletion Successfull.');
						redirect('author/category/index/'.$this->uri->segment(5));
					}
				 }else{		
					$this->layout('category/delete');
				 }
			 }else{	 show_404();	 }
		   }else { redirect('author/category/index/'.$this->uri->segment(5));  }
		 }else{ show_404(); }
	}


	// ----------------View-----------------

	public function view($id=""){

		if(!isset($id) || empty($id) ){
			show_404();
		}
			
		$this->data['title']='Ledger Manager &rarr; View Ledger';
		$this->data['page_name']='ledger/view';
		$this->data['parent_page']='ledger';
		$this->data['page_icon']='<i class="fa fa-book"></i>';		
		$this->data['headline']='';

		$this->load->css[]="public/css/jquery-ui.min.css";
		$this->load->js[]="public/js/defaultjs.js";
		$this->load->js[]="public/js/jquery-ui.min.js";

		$this->db->select('*')->where('aca_id',$id);
		$value=$this->db->get('tbl_ac_accounts');
		$this->load->ledger_info=$value->row();

		$this->db->select('*');
		$value=$this->db->get('tbl_ac_group');
		$this->load->group_info=$value;

		// echo "<pre>";
		// print_r($value); exit();

		$this->layout('ledger/view');
	}

}



?>