<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends My_Controller {
	
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
	
	/*public function common_data(){
		$data['online_users']=$this->users->active_guests_num();
		$data['online_members']=$this->users->active_users_num();
		$data['total_visitors']=$this->users->total_visitors();
		
		return $data;
	}*/


	public function index()
	{
		
		$this->data['title']='Control Panel: Category Manager';
		$this->data['page_name']='category';
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
			$this->db->order_by('cat_title');
			$this->db->like('cat_title',$filter_text);
			$this->db->select('*');	
			$q=$this->db->get('category');
			$this->load->category=$q->result_array();
								
			$data['pages_links']=' ';	
	    }else{

			$config['base_url'] = base_url().'index.php/author/category/index';
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
			
			$this->db->order_by('cat_title');
			$this->db->limit($config['per_page'], $limit); 	
			$this->db->select('*');	
			$q1=$this->db->get('category');
			$this->load->category=$q1->result_array();									
						 
			$config['total_rows'] = $this->db->count_all_results('category');
			
			$this->pagination->initialize($config);
			$this->data['pages_links']=$this->pagination->create_links();
		}
				
		$this->layout('category/index');
	}
	
	//-----------add function-----------------s
	
	public  function add(){

		$this->data['title']='Category Manager &rarr; Add New Category';
		$this->data['page_name']='category/add';
		$this->data['parent_page']='category';
		$this->data['page_icon']='<i class="fa fa-book"></i>';		
		$this->data['headline']='';		
		$this->data['date']=date("Y-m-d");
		
		$this->load->css[]="public/css/jquery-ui.min.css";
		$this->load->js[]="public/js/defaultjs.js";
		$this->load->js[]="public/js/jquery-ui.min.js";
		

		$this->db->order_by('cat_title');
		$this->db->where( array('cat_parent'=>'root') );
		$this->db->select('cat_id, cat_title');	
		$q1=$this->db->get('category');
		$this->load->cat=$q1->result_array();	
							
				
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="errormgs" style="color:red;">', '</span>');
				
		if($_POST){
			$this->form_validation->set_rules('date', 'Date', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('alias', 'Alais', 'required');
			$this->form_validation->set_rules('division', 'Division', 'required');
			$this->form_validation->set_rules('description', 'Description');
			$this->form_validation->set_rules('status', 'Status', 'required');
			
			if($this->form_validation->run() == FALSE){
				$this->layout('category/add_new');
			}else{
				
				foreach($this->input->post() as $key=>$value){
					 $$key=$value;
				}
				
				$sql_data=array(
					'cat_title'=>$title, 
					'cat_alias'=>$alias,
					'cat_division'=>$division,
					'cat_parent'=>$parent, 
					'cat_description'=>$description,
					'cat_status'=>$status,
					'cat_date'=>$date,
					
				);

				$insert=$this->db->insert('category', $sql_data);
				
				if($insert){
					$this->session->set_userdata('successmgs', 'Record successfullly added.');
					redirect('author/category/index/'.$this->uri->segment(5));	 
				}else{
				 	$this->data['message']="Records not added. There is problem";
					$this->layout('category/add_new');
				 }
			}
			
		}else{
			$this->layout('category/add_new');
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

		$category_info=$this->elanguage->select('category', '*', 'cat_id='.$id);
		$this->data['cat_info']=$this->elanguage->result[0];


		$this->db->order_by('cat_title');
		$this->db->where( array('cat_parent'=>'root') );
		$this->db->select('cat_id, cat_title');	
		$q1=$this->db->get('category');
		$this->load->cat=$q1->result_array();
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="errormgs" style="color:red;">', '</span>');
				
		if($_POST){
			$this->form_validation->set_rules('date', 'Date', 'required', 'trim');
			$this->form_validation->set_rules('title', 'Title', 'required', 'trim');
			$this->form_validation->set_rules('alias', 'Alais','required', 'trim');
			$this->form_validation->set_rules('division', 'Division', 'required', 'trim');
			$this->form_validation->set_rules('description', 'Description', 'trim');
			$this->form_validation->set_rules('status', 'Status', 'required', 'trim');
			
			if($this->form_validation->run() == FALSE){
					$this->layout('category/edit');
			}else{
				
				foreach($this->input->post() as $key=>$value){
					 $$key=$value;
				}
				
				$sql_data=array(
					'cat_title'=>$title, 
					'cat_alias'=>$alias,
					'cat_division'=>$division,
					'cat_parent'=>$parent, 
					'cat_description'=>$description,
					'cat_status'=>$status,
					'cat_date'=>$date,
					);
				
				$this->db->where('cat_id', $id);
				$update=$this->db->update('category', $sql_data);
				
				if($update){
					$this->session->set_userdata('successmgs', 'Record successfullly Updated.');
					redirect('author/category/index/'.$this->uri->segment(5));
				 }else{
				 	$data['message']="Records not update. There is some problem";
					$this->layout('category/edit');
				 }
			}
		}else{
				$this->layout('category/edit');
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
	

}

