<?php
	class Adminhome extends Ci_Controller
	{
		var $set;
		var $gm;
		var $admin;	
		function __construct()
		{
			parent::__construct();
			if(!$this->session->userdata('admin')){
	          redirect(base_url());
	        }else{ 
	          $this->admin = $this->session->userdata('admin'); 
	        }
			$this->gm = $this->general_model;
			$this->set = $this->gm->initSetting();
		}
		public function index(){
			$data = array();
			$data['site'] = $this->set;
			$this->template->load('admin/layout','contents','admin/home-view',$data);
		}
		public function setting(){
			$data = array();
		    $data['site'] = $this->set;
			$this->template->load('admin/layout','contents','admin/setting-view',$data);
		}
		public function users(){
			$data = array();
		    $data['site'] = $this->set;
			$this->template->load('admin/layout','contents','admin/users-list-view',$data);
		}
		public function categories(){
			$data = array();
		    $data['site'] = $this->set;
			$this->template->load('admin/layout','contents','admin/categories-view',$data);
		}
		public function pages(){
			$data = array();
		    $data['site'] = $this->set;
			$this->template->load('admin/layout','contents','admin/pages-list-view',$data);
		}
		public function new_page(){
			$data = array();			
	      $data['styles'] = ['extra-style.css'];
	      $data['scripts'] = ['jquery-ui.js','normal_user.js','jodit/prism.js','jodit/app.js','jodit/jodit.min.js','jodit/init.js'];
		    $data['site'] = $this->set;
			$this->template->load('admin/layout','contents','admin/new-page-view',$data);
		}
		public function new_admin(){
			$data = array();			
	      $data['styles'] = ['extra-style.css'];
	      $data['scripts'] = ['jquery-ui.js','normal_user.js','jodit/prism.js','jodit/app.js','jodit/jodit.min.js','jodit/init.js'];
		    $data['site'] = $this->set;
			$this->template->load('admin/layout','contents','admin/new-admin-view',$data);
		}
		public function edit_page($slug=null){
			if(!is_null($slug)){
				$data = array();			
		      $data['styles'] = ['extra-style.css'];
		      $data['scripts'] = ['jquery-ui.js','normal_user.js','jodit/prism.js','jodit/app.js','jodit/jodit.min.js','jodit/init.js'];
			    $data['site'] = $this->set;
			    $data['page_row'] = $this->gm->get_a_table_row('pages','page_slug',$slug);
				$this->template->load('admin/layout','contents','admin/edit-page-view',$data);
			}else{
				show_404();
			}
		}
	}
?>