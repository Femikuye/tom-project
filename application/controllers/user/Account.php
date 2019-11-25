<?php
	class Account extends Ci_Controller
	{	
		var $user;
		var $set;
    	var $gm;
    	var $profile;	
		function __construct()
		{
			parent::__construct();
			if(!$this->session->userdata('user')){
				$this->session->set_userdata('tourl','account');
				redirect(base_url('login'));
			}else{
				$this->user = $this->session->userdata('user'); 
			}
			$this->gm = $this->general_model;
      		$this->set = $this->gm->initSetting();
      		$this->profile = $this->gm->get_a_table_row('user_profiles','user_id',$this->user['id_user']);
		}
		public function index(){
		  $data = array();
	      $data['styles'] = ['extra-style.css'];
	      $data['scripts'] = [];
	      $data['title'] = $this->set['title']."- ".$this->user['username'];
	      $data['site'] = $this->set;
	      $this->template->load('user/layout','contents','ui/account-home-view',$data);
		}
		public function profile_update(){
		  $data = array();
	      $data['styles'] = ['extra-style.css'];
	      $data['scripts'] = [];
	      $data['profile'] = $this->profile;
	      $data['title'] = $this->set['title']."- ".$this->user['username']." - Update Profile";
	      $data['site'] = $this->set;
	      $this->template->load('user/layout','contents','ui/update-profile-view',$data);
		}
		public function post_aid(){
		  $data = array();
	      $data['styles'] = ['extra-style.css'];
	      $data['scripts'] = ['jquery-ui.js','normal_user.js','jodit/prism.js','jodit/app.js','jodit/jodit.min.js','jodit/init.js'];
	      $data['profile'] = $this->profile;
	      $data['title'] = $this->set['title']."- ".$this->user['username']." - Post New Aid";
	      $data['site'] = $this->set;		  		  $user_id = $this->user['id_user'];		  		  $data['user']=$this->gm->get_sms_verified($user_id);
	      $this->template->load('user/layout','contents','ui/new-aid-view',$data);
		}
		public function edit_aid($slug=null){
			if(!is_null($slug)){
				$aid_row = $this->general_model->get_a_table_row('aids','aid_slug',$slug);
				if($aid_row['poster_id'] === $this->user['id_user']){
					$data = array();
			      $data['styles'] = ['extra-style.css'];
			      $data['scripts'] = ['jquery-ui.js','normal_user.js','jodit/prism.js','jodit/app.js','jodit/jodit.min.js','jodit/init.js'];
			      $data['profile'] = $this->profile;
			      $data['title'] = $this->set['title']."- ".$this->user['username']." - Edit Aid";
			      $data['aid_row'] = $aid_row;
			      $data['images'] = $this->gm->get_aid_images($data['aid_row']['id_aid']);
			      $data['site'] = $this->set;
			      $this->template->load('user/layout','contents','ui/edit-aid-view',$data);
				}else{
					show_404();
				} 
			}else{
				show_404();
			} 
		}
		public function preview_aid($slug=null){
			if(!is_null($slug)){
			  $data = array();
		      $data['styles'] = ['extra-style.css','img-shuffle-style.css'];
		      $data['scripts'] = ['jquery-ui.js','normal_user.js'];
		      $data['profile'] = $this->profile;
		      $data['aid_row'] = $this->general_model->get_a_table_row('aids','aid_slug',$slug);
		      $data['title'] = $this->set['title']."- ".$this->user['username']." - Preview Aid";
		      $data['site'] = $this->set;
			 
		      $this->template->load('user/layout','contents','ui/preview-aid-view',$data);
			}else{
				show_404();
			} 
		}
		public function my_aids(){
			$data = array();
		    $data['styles'] = ['extra-style.css','img-shuffle-style.css'];
		    $data['scripts'] = ['jquery-ui.js','normal_user.js'];
		    $data['profile'] = $this->profile;
		    $data['aid_rows'] = $this->gm->get_table_rows_by_a_field('aids','poster_id',$this->user['id_user']);
		    $data['title'] = $this->set['title']."- ".$this->user['username']." - Aid List";
		    $data['site'] = $this->set;
		    $this->template->load('user/layout','contents','ui/user-aid-list-view',$data);
		}
	}
?>