<?php
	class Api extends Ci_Controller

	{	

		var $user;
		var $session_exp = null;
		var $gm;
		var $api;
		function __construct()
		{
			parent::__construct();
	      if(!$this->session->userdata('user')){
	          $this->user = false;
	         $this->session_exp = "Session Expired.. Please <a href='".base_url('login')."'>Login Here</a>";
	        }else{
	          $this->user = $this->session->userdata('user'); 
	        }
	        $this->gm = $this->general_model;
	        $this->load->model('api_model');
	        $this->api = $this->api_model;		

		}
		public function signin(){

	      $msg = array();

	       $email = $this->input->post('email');

	       $password = $this->input->post('password');

	        $redirect_link = base_url('account');

	        if($user = $this->gm->get_a_table_row('users','email',$email)){

	            if($this->gm->passwordVerify($password,$user['password'],$email)){

	              $this->session->set_userdata('user',$user);

	              $this->gm->update_user_last_login($user['id_user']);

	              $msg['link'] = $redirect_link;

	              $msg['success'] = true;

	              $msg['msg'] = "Successful Login";

	            }else{

	              $msg['error'] = true;

	              $msg['msg'] = "Incorrect Password";

	            }

	        }else{

	          $msg['msg'] = "This Email does not exist";

	          $msg['error'] = true;

	        }

	      header("Content-type:application/json");

	      echo json_encode($msg);

	    }

	    public function register(){
	        
	        
          
	      $msg = array();
          $rand = uniqid();
	       $email = $this->input->post('email');

	        if(!$this->gm->get_a_table_row('users','email',$email)){

	            if($id = $this->gm->register_new_user($rand)){

	            	$user = $this->gm->get_a_table_row('users','id_user',$id);

	              //$this->session->set_userdata('user',$user);

	              $msg['link'] = $this->session->userdata('tourl');
	              
                $to =  $email;
                $subject = 'Email Activation';
                $from = 'tormami.reply@gmail.com';
                $website_name = "Tormami";
                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                 
                // Create email headers
                $headers .= 'From: Tormami'."\r\n".
                    'Reply-To: '.$from.'<tormami.reply@gmail.com>'."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                 
                // Compose a simple HTML email message
                $message = '<html><body>';
                $message .= '<h1 style="color:##33409A;">Verify Your Email Address</h1>';
                 $message .= '<p>Hi <br>
                 You are almost ready to start enjoying <b>Tormami</b>.<br>
                 Simplay click the button to verify your email
                 
                 </p>';
                $message .= ' <a href="'. base_url().'user/User/verify/'.$to.'/'.$rand.'" style="background-color: #33409A;border:none;color:white;padding:15px 32px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;">Verify Email</a>';
                $message .= '</body></html>';
                 
                // Sending email
                mail($to, $subject, $message, $headers);

        
         

	              $msg['success'] = true;

	              $msg['msg'] = 'Hi<br>
	              Activation email has been sent to your email <b>'.$email.'</b> . Please verify  Your email
	              ';

	            }else{

	              $msg['error'] = true;

	              $msg['msg'] = "Password Is Incorrect";

	            }

	        }else{

	          $msg['msg'] = "This Email Already exist";

	          $msg['error'] = true;

	        }
	        
	        

	      header("Content-type:application/json");

	      echo json_encode($msg);

	    }

	    public function recover_password(){

	    	$msg = array();

	       $email = $this->input->post('email');

	        if($user = $this->gm->get_a_table_row('users','email',$email)){

	            if($this->gm->send_user_recovery_mail($user['id_user'],$user['username'])){

	              $msg['success'] = true;

	              $msg['msg'] = "An instruction on how to reset your password was sent to your email. please check your mailbox and follow the instruction thanks";

	            }

	        }else{

	          $msg['msg'] = "This Email does not exist";

	          $msg['error'] = true;

	        }

	      header("Content-type:application/json");

	      echo json_encode($msg);

	    }

	    public function reset_password(){

	    	$msg = array();

	    	$password = $this->input->post('password');

	       $user_id = $this->my_encrypt->decode($this->input->post('user_id'));

	       $code = $this->input->post('code');

	       $this->load->database();

	       $this->db->set('password',$this->gm->passwordhash($password));

	       $this->db->where('id_user',$user_id);

	       if($this->db->update('users')){

	       	$this->db->set('recovered','1');

	       	$this->db->where('code',$code);

	       	$this->db->update('password_recovery');

	       	$msg['success'] = true;

	       	$msg['msg'] = "Password Recovered Successfully! <br> <a href=".base_url('login')." class='text-default'>Login Here </a>";

	       }else{

	       	$msg['error'] = true;

	       	$msg['msg'] = "Error!";

	       }

	      header("Content-type:application/json");

	      echo json_encode($msg);

	    }

	    public function update_profile(){

	    	$msg = array();

	    	if(is_null($this->session_exp)){

	    		$this->session->set_userdata('msg','Profile Updated Successfully!');

	    		if($this->gm->get_a_table_row('user_profiles','user_id',$this->user['id_user'])){

	    			$this->api->update_user_profile();

	    		}else{

	    			$this->api->save_user_profile();

	    		}

	    		$msg['success'] = true;

	    		$msg['msg'] = "Profile Updated Successfully";

	    	}else{

	    		$msg['error'] = true;

	    		$msg['msg'] = $this->session_exp;

	    	}

	    	header("Content-type:application/json");

	      	echo json_encode($msg);			

		}

		public function upload_profile(){

			$msg = array();

	    	if(is_null($this->session_exp)){

	    		$upload_dir = 'assets/images/user-images/'.$this->user['id_user'];

	    		$res = $this->gm->uploadFiles('photo',$upload_dir,'jpg|png|gif');

	    		$profile = $this->gm->get_a_table_row('user_profiles','user_id',$this->user['id_user']);

	    		if($res['success']){

	    			$this->load->database();

	    			$this->db->set('user_image',$res['success']);

	    			$this->db->where('user_id',$this->user['id_user']);

	    			$this->db->update('user_profiles'); 

	    			$this->gm->deleteFile($upload_dir.'/'.$profile['user_image']); 

	    			$msg['success'] = true;

	    			$msg['link'] = base_url().$upload_dir.'/'.$res['success'];

	    			$msg['msg'] = "Success";

	    		}else{

	    			$msg['error'] = true;

	    			$msg['msg'] = $res['error'];

	    		}	    		

	    	}else{

	    		$msg['error'] = true;

	    		$msg['msg'] = $this->session_exp;

	    	}

	    	header("Content-type:application/json");

	      	echo json_encode($msg);	

		}

		public function get_sub_cat(){

			$msg = array();

			$cat_id = $this->my_encrypt->decode($this->input->get('cat'));

	    	if(is_null($this->session_exp)){

	    		if($rows = $this->gm->get_table_rows_by_a_field('aid_categories','parent_id',$cat_id)){

	    			$msg['success'] = true;

	    			$msg['rows'] =$rows;

	    		}else{

	    			$msg['error'] = true;

	    		}	    		

	    	}else{

	    		$msg['error'] = true;

	    		$msg['msg'] = $this->session_exp;

	    	}

	    	header("Content-type:application/json");

	      	echo json_encode($msg);	    		

		}

		public function get_p_city(){

			$msg = array();

			$p_name = $this->input->get('p');

			$p_id = $this->gm->get_a_table_row('ghana_province','p_name',$p_name);

	    	if(is_null($this->session_exp)){

	    		if($rows = $this->gm->get_table_rows_by_a_field('ghana_province','p_state_id',$p_id['id_province'])){

	    			$msg['success'] = true;

	    			$msg['rows'] =$rows;

	    		}else{

	    			$msg['error'] = true;

	    		}	    		

	    	}else{

	    		$msg['error'] = true;

	    		$msg['msg'] = $this->session_exp;

	    	}
	    	header("Content-type:application/json");
	      	echo json_encode($msg);

		}
		public function add_new_ad(){
			$msg = array();
	    	if(is_null($this->session_exp)){
	    		$this->form_validation->set_rules('aid_title','Aid Title','required');
	    		$this->form_validation->set_rules('cat','category','required');
	    		$this->form_validation->set_rules('sub_cat','Sub Category','required');
	    		$this->form_validation->set_rules('city','City','required');
	    		$this->form_validation->set_rules('state','State','required');
	    		$this->form_validation->set_rules('des','Description','required');
	    		$this->form_validation->set_rules('price','Price','required');
	    		if($this->form_validation->run() === FALSE){
					$msg['error'] = true;
					$msg['msg'] = validation_errors();
				}else{
					$profile = $this->gm->get_sms_verified($this->user['id_user']);
					//$count_num = strlen($profile['user_tel_number']);
					  if($profile->sms_verified==1){
						if($res = $this->api->create_new_ad()){
							
							$msg['success'] = true;
					    	$msg['msg'] = "Posted!";
					    	$msg['link'] = base_url()."account/my-ads";
						}else{
							$msg['error'] = true;
					    	$msg['msg'] = "Error";			    	

						}
					}else{
						$msg['error'] = true;
					    $msg['msg'] = "Please Verify Your Number";	
					} 
				}
	    	}else{
	    		$msg['error'] = true;
	    		$msg['msg'] = $this->session_exp;
	    	}
	    	header("Content-type:application/json");
	      	echo json_encode($msg);
		}
		public function delete_ad(){
			$msg = array();
			if(is_null($this->session_exp)){
				$dec_id = $this->my_encrypt->decode($this->input->post('ad_id'));
				$ad_row = $this->general_model->get_a_table_row('aids','id_aid',$dec_id);
				if($ad_row['poster_id'] !== $this->user['id_user']){
					$msg['error'] = true;
		    		$msg['msg'] = "You are not authorized!";
				}else{
					$this->load->database();
					$this->db->where('id_aid',$dec_id);
					if($this->db->delete('aids')){
						$this->db->where('aid_id',$dec_id);
						if($this->db->delete('aid_images')){
							$dirname = 'assets/images/aid-images/'.$dec_id;
							$this->general_model->deleteDirectory($dirname);
							$msg['success'] = true;
	    					$msg['msg'] = "Deleted";
	    					$msg['uid'] = $ad_row['uid'];
						}
						$msg['success'] = true;
	    				$msg['msg'] = "Deleted";
	    				$msg['uid'] = $ad_row['uid'];
					}
				}
			}else{
				$msg['error'] = true;
	    		$msg['msg'] = $this->session_exp;
			}
			header("Content-type:application/json");
	      	echo json_encode($msg); 
		}
		public function publish_aid(){

			$msg = array();

			$aid_id = $this->my_encrypt->decode($this->input->get('aid_id'));

	    	if(is_null($this->session_exp)){

	    		$this->load->database();

	    		$this->db->set('published','1');

	    		$this->db->where('id_aid',$aid_id);

	    		if($this->db->update('aids')){

	    			$msg['success'] = true;

	    			$msg['link'] = base_url('account/my-ads');

	    		}else{

	    			$msg['error'] = true;

	    			$msg['msg'] = "Database Error";

	    		}

	    	}else{

	    		$msg['error'] = true;

	    		$msg['msg'] = $this->session_exp;

	    	}

	    	header("Content-type:application/json");

	      	echo json_encode($msg);	

		}

		public function add_aid_image(){

			$msg = array();

			$aid_id = $this->my_encrypt->decode($this->input->post('id'));

	    	if(is_null($this->session_exp)){

	    		$imgPath = 'assets/images/aid-images/'.$aid_id;

	    		$allowType = 'jpg|jpeg|png|gif';

	    		$upload_res = $this->gm->uploadFiles('file',$imgPath,$allowType);

	    		$featured = '0';

	    		if(!$this->general_model->get_aid_featured_images($aid_id)){

	    			$featured = '1';

	    		}

	    		if($upload_res['success']){

	    			$this->load->database();

	    			$dbData = array(

	    				'aid_id' => $aid_id,

	    				'image_name' => $upload_res['success'],

	    				'featured' => $featured,

	    				'img_uid' => $this->gm->generateUid()

	    			);

		    		if($this->db->insert('aid_images',$dbData)){

		    			$msg['success'] = true;

		    			$last_id = $this->db->insert_id();

		    			$msg['row'] =  $this->general_model->get_a_table_row('aid_images','id',$last_id);

		    		}else{

		    			$msg['error'] = true;

		    			$msg['msg'] = "Database Error";

		    		}

	    		}else{

	    			$msg['error'] = true;

	    			$msg['msg'] = $upload_res['error'];

	    		} 

	    	}else{

	    		$msg['error'] = true;

	    		$msg['msg'] = $this->session_exp;

	    	}

	    	header("Content-type:application/json");

	      	echo json_encode($msg);	

		}

		public function delete_aid_image(){

			$msg = array();

			$image_uid = $this->input->post('img_uid');

			$img_row = $this->gm->get_a_table_row('aid_images','img_uid',$image_uid);

			$f_img_id = $this->input->post('f_img');

	    	if(is_null($this->session_exp)){

	    		$this->load->database();

	    		$this->db->where('img_uid',$image_uid);

	    		if($this->db->delete('aid_images')){

	    			$this->gm->deleteFile('assets/images/aid-images/'.$img_row['id'].'/'.$img_row['image_name']);

	    			$this->db->set('featured','1');

	    			$this->db->where('img_uid',$f_img_id);

	    			$this->db->update('aid_images');

	    			$msg['success'] = true;

	    		}else{

	    			$msg['error'] = true;

	    			$msg['msg'] = "Database Error";

	    		}

	    	}else{

	    		$msg['error'] = true;

	    		$msg['msg'] = $this->session_exp;

	    	}

	    	header("Content-type:application/json");

	      	echo json_encode($msg);	

		}

		public function arrange_aid_images(){

			$msg = array();

			$list = $this->input->post('list');

	    	if(is_null($this->session_exp)){

	    		$this->load->database();

	    		for($i=0;$i<count($list);$i++){

	    			if($i === 0){

	    				$this->db->set('featured','1');

	    			}else{

	    				$this->db->set('featured','0');

	    			}

		    		$this->db->where('img_uid',$list[$i]);

		    		$this->db->update('aid_images');

	    		}

	    		$msg['success'] = true;

	    		

	    	}else{

	    		$msg['error'] = true;

	    		$msg['msg'] = $this->session_exp;

	    	}

	    	header("Content-type:application/json");

	      	echo json_encode($msg);	

		}

		public function update_ad(){

			$msg = array();
	    	if(is_null($this->session_exp)){
	    		$this->form_validation->set_rules('aid_title','Aid Title','required');
	    		$this->form_validation->set_rules('cat','category','required');
	    		$this->form_validation->set_rules('city','City','required');
	    		$this->form_validation->set_rules('state','State','required');
	    		$this->form_validation->set_rules('des','Description','required');
	    		$this->form_validation->set_rules('price','Price','required');
	    		$this->form_validation->set_rules('tel','Telephone Number','required');
	    		if($this->form_validation->run() === FALSE){
					$msg['error'] = true;
					$msg['msg'] = validation_errors();
				}else{
					$profile = $this->gm->get_sms_verified($this->user['id_user']);
					if($profile->sms_verified==1){
						if($res = $this->api->update_ad()){
							$msg['success'] = true;
					    	$msg['msg'] = "Updated!";
					    	$msg['link'] = base_url()."account/my-ads";
						}else{
							$msg['error'] = true;
					    	$msg['msg'] = "Error";		    	

						}
					}else{
						$msg['error'] = true;
						$msg['msg'] = "Please Verify Your Number";	
					} 
				}
	    	}else{
	    		$msg['error'] = true;
	    		$msg['msg'] = $this->session_exp;
	    	}
	    	header("Content-type:application/json");
	      	echo json_encode($msg); 
		}

	public function send_ver_sms(){
		$id = "ACab0d409d57e3c8869ea93455dd4324b8";
		$token = "5a3fc0c7aad3ed05f1c535793b27736c";
		$ver_code =  $ver_code = mt_rand(100000,999999); //generate 6 digit code
		$url = "https://api.twilio.com/2010-04-01/Accounts/$id/Messages.json";
		$from = "+1 607 269 4096";
		$to = $_POST['number'] ; // twilio trial verified number  +13107384726 $_POST['mobile']
		//$to =  "(310)7384726" ; // twilio trial verified number  +13107384726 $_POST['mobile']
		$body = 'Hello '.$this->user['username'].'.Your verification code is : '.$ver_code;
		$data = array (
			'From' => $from,
			'To' => $to,
			'Body' => $body,
		);
		$post = http_build_query($data);
		$x = curl_init($url );
		curl_setopt($x, CURLOPT_POST, true);
		curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
		curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
		curl_setopt($x, CURLOPT_POSTFIELDS, $post);
		$y = curl_exec($x);
		curl_close($x);
		$json =json_decode($y);
		if($json->status=="queued"){
			$this->session->set_userdata('ver_code',$ver_code);
			$this->load->database();
			$data = [
				'sms_verification' => $ver_code,
				'phone'=>$_POST['number']
			];
		    $this->db->where('id_user',$this->user['id_user']);
			if($this->db->update('users',$data)){						
		    	$msg['success'] = true;
		    	$msg['msg'] = "Number Verified";
			}
		}else{
	    	$msg['error'] = true;
	    	$msg['msg'] = "SmS Unable to send";
		} 
	   	header("Content-type:application/json");
	    echo json_encode($msg);
	}
		
		
		public function verifySms()
		{
			$digit = $_POST['digit_1'].$_POST['digit_2'].$_POST['digit_3'].$_POST['digit_4'].$_POST['digit_5'].$_POST['digit_6'];
			$user_id=$this->user['id_user'];
			$result = $this->gm->sms_verification_code($user_id); 
			 if($result[0]->sms_verification==$digit){
				 $result = $this->gm->is_sms_verify($user_id); 
				 echo "Congratulation Your Phone Number is verified";
		}
		else
		{
			     echo "Please Try Again";
		}
		}
		public function update_user_num(){

            $number = $this->input->post('num');

            $code = $this->input->post('code');

			$msg = array();

	    	if(is_null($this->session_exp)){

	    		if($code === $this->session->userdata('ver_code')){

	    			$this->load->database();

		    		$this->db->set('user_tel_number',$number);

		    		$this->db->where('user_id',$this->user['id_user']);	    		

					if($this->db->update('user_profiles')){

		    			$msg['success'] = true;

		    			$msg['msg'] = "Number Verified";

					}else{

		    			$msg['error'] = true;

		    			$msg['msg'] = $response;

					}

	    		}else{

	    			$msg['fail'] = true;

		    		$msg['msg'] = 'Failed';

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