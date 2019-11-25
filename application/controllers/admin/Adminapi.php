<?php
	class Adminapi extends Ci_Controller
	{
		var $admin;
		var $session_exp = null;
		var $gm;
		var $api;		
		function __construct()
		{
			parent::__construct();
			if($this->session->userdata('admin')){
	          //$this->session_exp = true;
	         //$this->session_exp = "Session Expired.. Please <a href='".base_url('admin/login')."'>Login Here</a>";
	        }else{
	        	//$this->session_exp = true;
	          //$this->admin = $this->session->userdata('admin'); 
	        }
			$this->load->model('admin_model');
			$this->gm = $this->general_model;
	        $this->api = $this->admin_model;	
		}
		public function site_setting(){
		   	$msg = array();
			//$update_res = $this->admin_model->update_site_settings();
			if($this->admin_model->update_site_settings()){
				$msg['success'] = true;
			}else{
				$msg['msg'] = "Error";
				$msg['error'] = true;
			}
			header("Content-type:application/json");
			echo json_encode($msg);
		}
		public function add_category(){
		   	$msg = array();
		   	if($this->session_exp){
		   		$this->load->database();
		   		$dbData = array(
		   			'cat_name' => $this->input->post('title'),
		   			'cat_info' => $this->input->post('info'),
		   			'parent_id' => $this->input->post('parent'),
		   		);
		   		if($this->db->insert('aid_categories',$dbData)){
		   			$msg['success'] = true;
		   			$msg['rows'] = $this->gm->get_table_rows_by_a_field('aid_categories');
		   			$msg['msg'] = "Successful";
		   		}
		   	}else{
		   		$msg['error'] = true;
		   		$msg['msg'] = $this->session_exp;
		   	} 
			header("Content-type:application/json");
			echo json_encode($msg);
		}
		public function add_page(){
		   	$msg = array();
		   	if(is_null($this->session_exp)){
		   		$this->load->database();
		   		$dbData = array(
		   			'page_name' => $this->input->post('title'),
		   			'page_content' => $this->input->post('content'),
		   			'date_created' => time(),
		   			'date_updated' => time(),
		   			'page_slug' => $this->gm->create_unique_slug($this->input->post('title'),'pages','page_slug')
		   		);
		   		if($this->db->insert('pages',$dbData)){
		   			$msg['success'] = true;
		   			$msg['msg'] = "Successful";
		   		}
		   	}else{
		   		$msg['error'] = true;
		   		$msg['msg'] = $this->session_exp;
		   	} 
			header("Content-type:application/json");
			echo json_encode($msg);
		}
		public function update_page(){
		   	$msg = array();
		   	if(is_null($this->session_exp)){
		   		$this->load->database();
		   		$page_id = $this->my_encrypt->decode($this->input->post('page_id'));
		   		$this->db->set('page_name', $this->input->post('title'));
		   		$this->db->set('page_content', $this->input->post('content'));
		   		$this->db->set('date_updated', time());
		   		$this->db->set('page_slug', $this->gm->create_unique_slug($this->input->post('title'),'pages','page_slug'));
		   		$this->db->where('id_page',$page_id);
		   		if($this->db->update('pages')){
		   			$msg['success'] = true;
		   			$msg['msg'] = "Successful";
		   		}
		   	}else{
		   		$msg['error'] = true;
		   		$msg['msg'] = $this->session_exp;
		   	} 
			header("Content-type:application/json");
			echo json_encode($msg);
		}
		public function delete_page(){
		   	$msg = array();
		   	if(is_null($this->session_exp)){
		   		$this->load->database();
		   		$page_id = $this->my_encrypt->decode($this->input->get('pid'));
		   		$this->db->where('id_page',$page_id);
		   		if($this->db->delete('pages')){
		   			$msg['success'] = true;
		   			$msg['msg'] = "Successful";
		   		}
		   	}else{
		   		$msg['error'] = true;
		   		$msg['msg'] = $this->session_exp;
		   	} 
			header("Content-type:application/json");
			echo json_encode($msg);
		}
		public function delete_category(){
			$msg = array();
		   	if($this->session_exp){
		   		$this->load->database();
		   		$dec_id = $this->my_encrypt->decode($this->input->get('id')); 
		   		$this->db->where('id_cat',$dec_id);
		   		if($this->db->delete('aid_categories')){
		   			$msg['success'] = true;
		   			$msg['rows'] = $this->gm->get_table_rows_by_a_field('aid_categories');
		   			$msg['msg'] = $dec_id;
		   		}
		   	}else{
		   		$msg['error'] = true;
		   		$msg['msg'] = $this->session_exp;
		   	} 
			header("Content-type:application/json");
			echo json_encode($msg);
		}
		public function add_admin(){
			$msg = array();
		   	if($this->session_exp){
		   		$this->load->database();
		   		$code = $this->gm->$this->generateUid();
		   		$dbData = array(
		   			'username' => $this->input->post('name'),
		   			'email' => $this->input->post('email'),
		   			'confirme_code' =>  $code
		   		);
		   		if($this->db->insert('admins',$dbData)){
		   			$msg['success'] = true;
		   			$msg['rows'] = $this->gm->get_table_rows_by_a_field('aid_categories');
		   			$msg['msg'] = $dec_id;
		   		}
		   	}else{
		   		$msg['error'] = true;
		   		$msg['msg'] = $this->session_exp;
		   	} 
			header("Content-type:application/json");
			echo json_encode($msg);
		}
	}
?>