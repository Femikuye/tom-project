<?php
  class user extends Ci_Controller
  {
    var $set;
    var $gm;
  	function __construct()
  	{ 		
  		parent::__construct();
    //   if($this->session->userdata('user')){
    //       redirect(base_url($this->session->userdata('tourl')));
    //     }
      $this->gm = $this->general_model;
      $this->set = $this->gm->initSetting(); 
  	}
    public function index(){
      $data = array();
      $data['styles'] = ['extra-style.css'];
      $data['scripts'] = [];
      $data['title'] = $this->set['title']."- Login";
      $data['site'] = $this->set;
      $this->template->load('user/layout','contents','ui/login-view',$data);
    }
    public function register(){
        
      $data = array();
      $data['styles'] = ['extra-style.css'];
      $data['scripts'] = [];
      $data['title'] = $this->set['title']."- Login";
      $data['site'] = $this->set;
      $this->template->load('user/layout','contents','ui/signup-view',$data);
    }    
    public function confirm($code=null){
        exit;
      $data = array();
      $data['styles'] = ['extra-style.css'];
      $data['title'] = $this->set['title']."- Confirm Account";
      $data['site'] = $this->set;
      if(!is_null($code)){
         if($active = $this->general_model->get_a_table_row('user_activation','code',$code)){
            $user = $this->general_model->get_a_table_row('users','id_user',$active['user_id']);
            if($active['activated'] === '0'){
              $this->session->set_userdata('user',$user);
              $data['msg'] = "<h2>Hi, ".$user['username']."<br> Welcome to <a href=".base_url()." class='text-default'> {$this->set['title']}</a> ! Your account is activated<br> <strong>Thanks and welcome!</strong><h2>";
              $this->general_model->confirm_user($user['id_user']);
            }elseif($active['activated'] === '1'){
              $data['msg'] = "<h2>Hi, ".$user['username']."<br>This account is activated already<h2>";
            }            
          }else{
            $data['msg'] = "<h2>Sorry! we are unable to confirm your email<h2>";
          }
          $this->template->load('user/layout','contents','ui/confirm-signup-view',$data);
      }else{
        redirect(base_url());
      }
    }
    public function pass_recovery(){ 
      $data = array();
      $data['styles'] = ['extra-style.css'];
      $data['scripts'] = [];
      $data['title'] = $this->set['title']."- Recover Your Password";
      $data['site'] = $this->set;
      $this->template->load('user/layout','contents','ui/recover-pass-view',$data);
    }
    public function reset_password($code=null){  
      if(!is_null($code)){
        $data = array();
        $data['error'] = false;
        $data['success'] = false;
        $data['styles'] = ['extra-style.css'];
        $data['scripts'] = [];
        $data['title'] = $this->set['title']."- Reset Your Password";
        $data['site'] = $this->set;
        $this->load->database();
        if($recov = $this->general_model->get_a_table_row('password_recovery','code',$code)){
          if($recov['recovered'] === '0'){
            $exp_time = 60 * 60 * 4;
            $click_time = time() - $exp_time;
            if($recov['sent_time'] > $click_time ){
              $data['success'] = true;
              $data['user_id'] = $recov['user_id'];
              $data['code'] = $code;
            }else{
              $this->db->set('expired','1');
              $this->db->where('code',$code);
              $this->db->update('password_recovery');
              $data['error'] = true;
              $data['msg'] = "Sorry! the limited time of 4 hours have exceed.. We suggest you should Start over <br> <a href=".base_url('account/password-recovery')." class='text-default'>Recover Password</a>";  
            }
          }elseif($recov['recovered'] === '1'){
             $data['error'] = true;
             $data['msg'] = "Sorry we are unable to proccess your password recovery.. We suggest you should request new password<br> <a href=".base_url('account/password-recovery')." class='text-default'>Recover Password</a>";
          }
        }else{
          $data['error'] = true;
          $data['msg'] = "Sorry we are unable to proccess your password recovery.. We suggest you should request new password<a href=".base_url('account/password-recovery')." class='text-default'>Recover Password</a>";
        }
        $this->template->load('user/layout','contents','ui/reset-pass-view',$data);
      }else{
        show_404();
      } 
    }
    public function fb_login(){
      $data = array();
      $data['styles'] = ['extra-style.css'];
      $data['scripts'] = [];
      $data['title'] = $this->set['title']."- Login";
      $data['site'] = $this->set;
      $data['responce'] = $this->general_model->facebook_login();
      $this->template->load('user/layout','contents','ui/facebook-login-view',$data);
    }
    public function twitter_login(){
      $data = array();
      $data['styles'] = ['extra-style.css'];
      $data['scripts'] = [];
      $data['title'] = $this->set['title']."- Login";
      $data['site'] = $this->set;
      $data['responce'] = $this->general_model->facebook_login();
      $this->template->load('user/layout','contents','ui/facebook-login-view',$data);
    }
    public function google_login(){
      $data = array();
      $data['styles'] = ['extra-style.css'];
      $data['scripts'] = [];
      $data['title'] = $this->set['title']."- Login";
      $data['site'] = $this->set;
      $data['responce'] = $this->general_model->google_login();
      $this->template->load('user/layout','contents','ui/facebook-login-view',$data);
    }
    
    public function verify($email_address,$email_code)
    {
         $result = $this->gm->get_hash_value($email_address); //get the hash value which belongs to given email from databas
         if($result){
             
             if($result[0]->email_verification_code==$email_code){  //check whether the input hash value matches the hash value retrieved from the database
                $this->gm->verify_user($email_address); //update the status of the user as verified
				$this->session->set_flashdata('message', 'Congratulation! Your Email Has Been Verified');
                return redirect('/login');
            }
             
         }
         //print_r( $result[0]->email_verification_code );
        
    }
    

}

?>