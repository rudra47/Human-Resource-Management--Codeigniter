<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends My_Controller {
	
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

		$this->data['title']='Control Panel: Group Manager';
		$this->data['page_name']='group';
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
			$this->db->order_by('grp_id');
			// $this->db->like('grp_id',$filter_text);
			$this->db->select('*');	
			$q=$this->db->get('tbl_ac_group');
			$this->load->group=$q->result_array();
								
			$data['pages_links']=' ';	

	    }else{

			$config['base_url'] = base_url().'author/group/index';
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
			
			$this->db->order_by('grp_id');
			$this->db->limit($config['per_page'], $limit); 	
			$this->db->select('*');	
			$q1=$this->db->get('tbl_ac_group');
			$this->load->group=$q1->result_array();	

			$this->db->select('*');
			$value=$this->db->get('tbl_ac_group');
			$this->load->group_info=$value;								
						 
			$config['total_rows'] = $this->db->count_all_results('tbl_ac_group');
			
			$this->pagination->initialize($config);
			$this->data['pages_links']=$this->pagination->create_links();
		}
				
		$this->layout('group/index');
	}

	public  function add(){

		$this->data['title']='Group Manager &rarr; Add New Group';
		$this->data['page_name']='group/add';
		$this->data['parent_page']='group';
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
			
			$this->form_validation->set_rules('grp_title', 'Group Title', 'required');
			
			if($this->form_validation->run() == FALSE){
				$this->layout('group/add_new');
			}else{

				foreach($this->input->post() as $key=>$value){
					 $$key=$value;
				}
				
				$sql_data=array(
					'grp_title'=>$grp_title, 
					'grp_parent'=>$grp_parent,
				);

				$insert=$this->db->insert('tbl_ac_group', $sql_data);
				
				if($insert){
					$this->session->set_userdata('successmgs', 'Record successfullly added.');
					redirect('author/group/index/'.$this->uri->segment(5));	 
				}else{
				 	$this->data['message']="Records not added. There is problem";
					$this->layout('group/add_new');
				}
			}
			
		}else{
			$this->layout('group/add_new');
		}
	}

	//edit-function-----------------------

	public  function edit($id=''){

		if(!isset($id) || empty($id) ){
			show_404();
		}
			
		$this->data['title']='Group Manager &rarr; Edit Group';
		$this->data['page_name']='group/edit';
		$this->data['parent_page']='group';
		$this->data['page_icon']='<i class="fa fa-book"></i>';		
		$this->data['headline']='';

		$this->load->css[]="public/css/jquery-ui.min.css";
		$this->load->js[]="public/js/defaultjs.js";
		$this->load->js[]="public/js/jquery-ui.min.js";

		$group_info=$this->db->select('*')->where('grp_id',$id);
		$value=$this->db->get('tbl_ac_group');
		$this->load->grp_info=$value->row();

		// echo "<pre>";
		// print_r($this->load->grp_info);
		// exit();


		$this->db->order_by('grp_id');
		// $this->db->where( array('grp_id'=>$id) );
		$this->db->select('grp_id, grp_title');	
		$q1=$this->db->get('tbl_ac_group');
		$this->load->grp=$q1->result_array();
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="errormgs" style="color:red;">', '</span>');
				
		if($_POST){
			$this->form_validation->set_rules('grp_title', 'Group Title', 'required');
			
			if($this->form_validation->run() == FALSE){
					$this->layout('group/edit');
			}else{
				
				foreach($this->input->post() as $key=>$value){
					 $$key=$value;
				}
				
				$sql_data=array(
					'grp_title'=>$grp_title, 
					'grp_parent'=>$grp_parent,
				);
				
				$this->db->where('grp_id', $id);
				$update=$this->db->update('tbl_ac_group', $sql_data);
				
				if($update){
					$this->session->set_userdata('successmgs', 'Record successfullly Updated.');
					redirect('author/group/index/'.$this->uri->segment(5));
				 }else{
				 	$data['message']="Records not update. There is some problem";
					$this->layout('group/edit');
				 }
			}
		}else{
			$this->layout('group/edit');
		}
	}

	//------------Delete Function-----------------------------

	public  function delete($id=''){					
		if(isset($id) && !empty($id)){	
			if($id!=1){
				$this->data['title']="Delete Category";			
				// $this->elanguage->select('category', 'cat_id', array('cat_id'=>$id));
				// $this->data['idtodel']=$this->elanguage->result;

				$group_info=$this->db->select('*')->where('grp_id',$id);
				$value=$this->db->get('tbl_ac_group');
				$this->load->grp_info=$value->row();
				
				if(isset($this->load->grp_info->grp_id) && !empty($this->load->grp_info->grp_id))
				{
					// echo $this->load->grp_info->grp_id;exit();

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
							redirect('author/group/index/'.$this->uri->segment(5));
						}
					}else{		
						$this->layout('group/delete');
					}
				}else{	 show_404();	 }
			}else { redirect('author/group/index/'.$this->uri->segment(5));  }
		}else{ show_404(); }
	}

}



?>