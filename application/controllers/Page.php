<?php
	class Page extends Ci_controller
	{
		var $user;
		var $set;
    	var $gm;
		function __construct()
		{
			parent::__construct();
			$this->gm = $this->general_model;
      		$this->set = $this->gm->initSetting();
			
		}
		public function terms(){
		  $data = array();
	      $data['styles'] = ['extra-style.css'];
	      $data['title'] = $this->set['title']."- Terms And Condition";
	      $data['site'] = $this->set;
	      $this->template->load('user/layout','contents','ui/pages/terms-and-condition-view',$data);
		} 
		public function safety_tips(){
		  $data = array();
	      $data['styles'] = ['extra-style.css'];
	      $data['title'] = $this->set['title']."- Terms And Condition";
	      $data['site'] = $this->set;
	      $this->template->load('user/layout','contents','ui/pages/safety-tips-view',$data);
		}
		public function privacy(){
		  $data = array();
	      $data['styles'] = ['extra-style.css'];
	      $data['title'] = $this->set['title']."- Terms And Condition";
	      $data['site'] = $this->set;
	      $this->template->load('user/layout','contents','ui/pages/privacy-policy-view',$data);
		}
	}
?>