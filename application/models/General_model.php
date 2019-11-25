<?php
 
	 class General_model extends Ci_model
	 {	 
	     var $fbid;
	     var $fbsecret;
	 	function __construct()
	 	{
	 		parent::__construct();
	 		$this->load->database(); 
	 		$this->fbid = '415238819108119';
	 		$this->fbsecret = '97fdeb0ba6dee0bae29535a7360b0ca3';
	 	}
	 	public function get_a_table_row($table,$field,$fieldValue){
			$query = $this->db->get_where($table, array($field=>$fieldValue));
			if($query->num_rows() > 0){
				return $query->row_array();
			}else{
				return false;
			}			
		}
		public function get_a_table_row_raw_query($table,$field,$fieldValue){
			$sql = "SELECT * FROM $table WHERE $field = '$fieldValue'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row_array();
			}else{
				return false;
			}			
		}
		public function get_table_rows_by_a_field($table,$field=null,$data=null,$limit=null){
			if(!is_null($field)){
				$this->db->where($field,$data);
			}
            if(!is_null($limit)){
                $this->db->limit($limit);
            }
			$query = $this->db->get($table);
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}
		public function get_aid_images($aid_id){
			$this->db->where('aid_id',$aid_id);
			$this->db->order_by('featured','desc');
			$query = $this->db->get('aid_images');
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}
		public function count_search_result($cat_row,$p_row){
			$keyword = $this->input->get('search_data');
	        $category = $this->input->get('cat-name');
	        $city = $this->input->get('SearchCity');
	        if($category !== '' && $category !== 'All-Categories'){       
		        if($cat_row['parent_id'] === '0'){
		          $this->db->where('aid_category_id',$cat_row['id_cat']);
		        }else{
		          $this->db->where('aid_subcategory_id',$cat_row['id_cat']);
		        }
		      }
	      if($city !== '' && $city !== 'All-Ghana'){
	        if($p_row['p_status'] === 'State'){
	          $this->db->where('aid_state',$p_row['p_name']);
	        }else{
	          $this->db->where('aid_city',$p_row['p_name']);
	        }
	      }
	      if($keyword !== ''){
	        $this->db->like('aid_title',$keyword);
	        $this->db->or_like('aid_des',$keyword);
	      } 
	      $this->db->where('published','1');
	      $query = $this->db->get('aids');
	      return $query->num_rows();
		}
		public function get_url_search_query(){
			$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$output = explode("?", $url);
			return $output[1];
		}
		public function get_search_result_heading($cat_row,$p_row){
			$keyword = $this->input->get('search_data');
	        $category = $this->input->get('cat-name');
	        $city = $this->input->get('SearchCity');
			$heading = "<h3 class='mt-4'>";
			if($city !== '' ){
		        if($city === 'All-Ghana'){
		          $heading .= "<strong class='text-featured'>All Ghana</strong>";
		        }else{
		          $heading .= "<a  href='".base_url('ads/p/'.$p_row['p_slug'])."' class='text-featured'>".$p_row['p_name']."</a>";
		        }
		        $heading .= "<span class='text-default'> > </span>";
		      }
		      if($category !== '' ){
		        if($category === 'All-Categories'){
		          $heading .= "<strong class='text-featured'>All Categories</strong>";
		        }else{
		          $heading .= "<a  href='".base_url('ads/cat/'.$cat_row['cat_slug'])."' class='text-featured'>".$cat_row['cat_name']."</a>";
		        }
		        $heading .= "<span class='text-default'> > </span>";
		      }
		    if($keyword !== ''){
		       $heading .= $keyword;
		    } 
			//$heading = '';
			$heading .= "</h3>";
			return $heading;
		}
		public function get_aid_featured_images($aid_id){
			$this->db->where('aid_id',$aid_id);
			$this->db->where('featured','1');
			$query = $this->db->get('aid_images');
			if($query->num_rows() > 0){
				return $query->row_array();
			}else{
				return false;
			}
		}
		public function define_price($price){
			return '<span style="font-size:15px;">GH₵ </span> <span style="font-size:25px;" class="text-info">'.$price.'</span>';
		}
		public function define_aid_slug($aid_id,$aid_title){
			$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($aid_title)));
			return $slug."-".$aid_id;

		}
		public function increase_ad_view($ad_id){
			$this->db->set('aid_views', 'aid_views + '. 1 , false);
			$this->db->where('id_aid',$ad_id);
			$this->db->update('aids');
		}
		public function get_slug_id($slug){
			$arr = explode('-', $slug);
			return $arr[count($arr) - 1];
		}
		public function getSiteSettings(){
			$this->db->where('setting_id','1');			
			$query = $this->db->get('site_settings');
			if($query->num_rows() > 0){
				return $query->row_array();
			}else{
				return false;
			}
		}		
		public function initSetting(){
			// $sets = array();
			// if($settings = $this->getSiteSettings()){
			// 	foreach($settings as $setting){
			// 		$sets[$setting['_key']] = $setting['content'];
			// 	}
			// }
			return $this->getSiteSettings();
		}
		public function passwordVerify($password, $old_password,$email){
		   $this->db->select('is_verified'); 
            $this->db->from('users');   
            $this->db->where('email', $email);
            $q= $this->db->get()->result();
          	//if(password_verify($password, $old_password) && $q[0]->is_verified==1){
            if(password_verify($password, $old_password)){
                return true;
            }else{
                return false;
            }
        }
        public function customUrl($id,$name){
        	$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($name))).'-'.$id;
        	return $slug;
        }
	    public function passwordhash($password){
	        return password_hash($password, PASSWORD_DEFAULT);
	    }
	    public function set_session($data,$name){
	     	$this->session->set_userdata($name,$data);
	     }
	     public function update_user_last_login($user_id){
	     	$this->db->set('last_login',time());
	     	$this->db->where('id_user',$user_id);
	     	$this->db->update('users');
	     }
	     public function register_new_user($rand){
			$code = $this->generateUid();
			//$rand = uniqid();
	     		$dbData = array(
		     		'uid' => $this->generateUid(),
		     		'username' => $this->input->post('username'),
		     		'email' => $this->input->post('email'),
		     		'email_verification_code' =>$rand,
		     		'password' => $this->passwordhash($this->input->post('password')),
		     		'last_login' => time(),
		     		'date_registered' => time()
		     	);
		     	if($this->db->insert('users',$dbData)){
		     		$last_id = $this->db->insert_id();
		     		$this->insert_user_profile($last_id);
		     		$this->insert_user_activation($last_id);
		     		return $last_id;
		     	}else{
		     		return false;
		     	}
	     }
	     public function insert_user_activation($user_id){
	     	$code = $this->generateUid();
	     	$dbData = array(
	     		'user_id' => $user_id,
	     		'code' => $code,
	     		'action_type' => 'verify_email'

	     	);
	     	if($this->db->insert('user_activation',$dbData)){
	     		//$this->send_confirmation_mail($code);
	     	}
	     }
	     public function insert_user_profile($user_id){
	     	$dbData = array(
	     		'user_id' => $user_id

	     	);
	     	$this->db->insert('user_profiles',$dbData);
	     }
	     public function send_confirmation_mail($code){
	     	$res = array();
	     	$data = array();
	     	$site_setting = $this->initSetting();
	     	$data['site'] = $site_setting ;
	     	$res['success'] = false;
	     	$res['error'] = false;
	     	$data['link'] = base_url().'account/confirm/'.$code;
	     	$data['name'] = $this->input->post('username');
				$mailData = array(
						'from' => 'contact@phemrise.com',
						'from_name' => $site_setting['title'],
						'to' => $this->input->post('email'),
						'subject' => 'Confirmation Email',
						'body' => $this->load->view('emails/user-verification',$data,true),
						'receiver_name' => $this->input->post('username'),
						'sender_name' => $site_setting['title'],
						'reply_to' => null,
						'file' => null,
						'file_name' => null,
					);
				$this->load->model('email_model');
				$mailRes = $this->email_model->myMailSender($mailData);
				if($mailRes['success']){
					$res['success'] = true;
				}else{
					$res['error'] = $mailRes['error'];
				}
	     }
	     public function confirm_user($user_id){
	     	$this->db->set('activated','1');
	     	$this->db->where('user_id',$user_id);
	     	$this->db->update('user_activation');
	     }
	     public function send_user_recovery_mail($user_id,$name){
	     	$code = $this->generateUid();
	     		$dbData = array(
		     		'user_id' => $user_id,
		     		'code' => $code,
		     		'sent_time' => time()
		     	);
		     	if($this->db->insert('password_recovery',$dbData)){
		     		$this->send_password_recovery_mail($code,$name);
		     		return true;
		     	}else{
		     		return false;
		     	}
	     }
	     public function send_password_recovery_mail($code,$name){
	     	$res = array();
	     	$data = array();
	     	$site_setting = $this->initSetting();
	     	$data['site'] = $site_setting ;
	     	$res['success'] = false;
	     	$res['error'] = false;
	     	$data['link'] = base_url().'account/reset-password/'.$code;
	     	$data['name'] = $name;
				$mailData = array(
						'from' => $site_setting['email'],
						'from_name' => $site_setting['title'],
						'to' => $this->input->post('email'),
						'subject' => 'Password Recovery',
						'body' => $this->load->view('emails/password_recovery_mail',$data,true),
						'receiver_name' => $this->input->post('username'),
						'sender_name' => $site_setting['title'],
						'reply_to' => null,
						'file' => null,
						'file_name' => null,
					);
				$this->load->model('email_model');
				$mailRes = $this->email_model->myMailSender($mailData);
				if($mailRes['success']){
					$res['success'] = true;
				}else{
					$res['error'] = $mailRes['error'];
				}
	     }
	     public function uploadFiles($fileName,$imgPath,$allowType){
			$res = array();
			$res['success'] = false;
			$res['error'] = false;
			if(isset($_FILES[$fileName])){
	            $original_image = $_FILES[$fileName]['name'];
	            $imageconfig = array(
	                  'upload_path' => $imgPath,
	                  'allowed_types' => $allowType,
	                  'overwrite' => TRUE,
	                  'max_size' => "10000",
	                  'encrypt_name' => TRUE
	              );
	            if(!is_dir($imgPath)){
	                mkdir($imgPath,0777);
	            }
	            $this->load->library('upload',$imageconfig);
	            $this->upload->initialize($imageconfig);
	            if($this->upload->do_upload($fileName)){
                    $uploaddata = $this->upload->data();
                    $media_name = $uploaddata['file_name'];
                    $res['success'] = $media_name;
                }else{
                   $res['error'] = array('error' => $this->upload->display_errors());
                }
			}else{
				$res['error'] = "No File Imputed";
			}
			return $res;
		}
		public function upload_multiple_files($fileName,$imgPath,$allowType){
			$fileCount = isset($_FILES[$fileName]['name']) ? count($_FILES[$fileName]['name']) : 0;
			$uploaded_files = array();
			if($fileCount > 0 && $_FILES[$fileName]['size'][0] > 0 && $_FILES[$fileName]['error'][0] == 0){
				$imgDir = $imgPath;
				if(!file_exists($imgDir)){
					mkdir($imgDir);
				}
				for($i=0;$i<$fileCount;$i++){
					$_FILES['file']['name']     = $_FILES[$fileName]['name'][$i];
	                $_FILES['file']['type']     = $_FILES[$fileName]['type'][$i];
	                $_FILES['file']['tmp_name'] = $_FILES[$fileName]['tmp_name'][$i];
	                $_FILES['file']['error']     = $_FILES[$fileName]['error'][$i];
	                $_FILES['file']['size']     = $_FILES[$fileName]['size'][$i];
	                $imageconfig = array(
	                  'upload_path' => $imgDir,
	                  'allowed_types' => $allowType,
	                  'overwrite' => TRUE,
	                  'max_size' => "10000",
	                  'encrypt_name' => TRUE
	              );      
	                $this->load->library('upload', $imageconfig);
	                $this->upload->initialize($imageconfig);	                
	                // Upload file to server
	                if($this->upload->do_upload('file')){
	                    // Uploaded file data
	                    $fileData = $this->upload->data();
	                    $uploadData[$i]['file_name'] = $fileData['file_name'];
	                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
	                    array_push($uploaded_files, $uploadData[$i]['file_name']);
	                }
				}
			}
			return $uploaded_files;
		}
		public function deleteDirectory($dirname) {
		         if (is_dir($dirname))
		           $dir_handle = opendir($dirname);
		     if (!$dir_handle)
		          return false;
		     while($file = readdir($dir_handle)) {
		           if ($file != "." && $file != "..") {
		                if (!is_dir($dirname."/".$file))
		                     unlink($dirname."/".$file);
		                else
		                     delete_directory($dirname.'/'.$file);
		           }
		     }
		     closedir($dir_handle);
		     rmdir($dirname);
		     return true;
		}
		public function deleteFile($dirname) {
		    if(file_exists($dirname)){
		    	unlink($dirname);
		    }
		}
		public function generateUid() {
	       $n = 10;
	      mt_srand((double)microtime()*1000000);
	      $id = "";
	      while(strlen($id)<$n){
	        switch(mt_rand(1,3)){
	          case 1: $id.=chr(mt_rand(48,57)); break;  // 0-9
	          case 2: $id.=chr(mt_rand(65,90)); break;  // A-Z
	          case 3: $id.=chr(mt_rand(97,122)); break; // a-z
	        }
	      } 
	      return $id.bin2hex(openssl_random_pseudo_bytes(16));
	    }
	    public function create_unique_slug($data,$table,$field){
	     	$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($data)));
	     	$this->db->select('*');
			$this->db->from($table);
			$this->db->like($field, $slug);
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $slug."-".$query->num_rows();
			}else{
				return $slug;
			}
	     }
	     public function get_related_advert($aid_id,$aid_cat){
	     	$sql = "SELECT * FROM aids WHERE aid_category_id = '$aid_cat' AND id_aid != '$aid_id' AND published = '1' ORDER BY date_created DESC  LIMIT 8";
	     	$query = $this->db->query($sql);
	     	if($query->num_rows() > 0){
	     		return $query->result_array();
	     	}else{
	     		return;
	     	}
	     }
	     public function get_latest_advert($limit=null){
//	     	$sql = "SELECT * FROM aids ORDER BY date_created DESC  LIMIT $limit";
	         $this->db->select('*');
	         $this->db->from('aids');
	         $this->db->order_by('id_aid','DESC');
             if(!is_null($limit)){
                 $this->db->limit($limit);
             }
             $query = $this->db->get();
//	     	$query = $this->db->query($sql);
	     	if($query->num_rows() > 0){
	     		return $query->result_array();
	     	}else{
	     		return;
	     	}
	     }
	     public function get_ghana_states($limit=null){
	     	$this->db->select('*');
	     	$this->db->from('ghana_province');
	     	if(!is_null($limit)){
	     		$this->db->limit($limit);
	     	}
	     	$query = $this->db->get();
	     	if($query->num_rows() > 0){
	     		return $query->result_array();
	     	}else{
	     		return;
	     	}
	     } 
	     public function get_ghana_cities($state_id,$limit=null){
	     	$this->db->select('*');
	     	$this->db->from('ghana_province');
	     	$this->db->where('p_state_id',$state_id);
	     	if(!is_null($limit)){
	     		$this->db->limit($limit);
	     	}
	     	$query = $this->db->get();
	     	if($query->num_rows() > 0){
	     		return $query->result_array();
	     	}else{
	     		return;
	     	}
	     }
	     public function  get_top_catigories($limit){
	     	$this->db->select('*');
	     	$this->db->from('aid_categories');
	     	$this->db->where('parent_id','0');
	     	$this->db->order_by('aid_count', 'desc');
	     	$this->db->limit($limit);
	     	$query = $this->db->get();
	     	if($query->num_rows() > 0){
	     		return $query->result_array();
	     	}else{
	     		return;
	     	}
	     }
	     public function  get_popular_ads($limit){
	     	$this->db->select('*');
	     	$this->db->from('aid_categories');
	     	$this->db->where('parent_id','0');
	     	$this->db->order_by('aid_count', 'desc');
	     	$this->db->limit($limit);
	     	$query = $this->db->get();
	     	if($query->num_rows() > 0){
	     		return $query->result_array();
	     	}else{
	     		return;
	     	}
	     }
	     public function facebook_login(){
			$msg = array();
			$msg['error'] = false;
			$msg['success'] = false;
			// init app with app id and secret
			$fb = new Facebook\Facebook([
              'app_id' => $this->fbid, // Replace {app-id} with your app id
              'app_secret' => $this->fbsecret,
              'default_graph_version' => 'v3.2',
              ]);
              $helper = $fb->getRedirectLoginHelper();
              $accessToken = null;
              $response = null;
              try {
                  $accessToken = $helper->getAccessToken();
                } catch(Facebook\Exceptions\FacebookResponseException $e) {
                  $msg['error'] = true;
			      $msg['msg'] = 'Graph returned an error: ' . $e->getMessage();
                } catch(Facebook\Exceptions\FacebookSDKException $e) {
                  $msg['error'] = true;
			      $msg['msg'] = 'Facebook SDK returned an error: ' . $e->getMessage();
                }
                if (is_null($accessToken)) {
                  if ($helper->getError()) {
                    $msg['error'] = true;
			        $msg['msg'] = "Error: " . $helper->getError() . "\n";
                  } else {
                    $msg['error'] = true;
			        $msg['msg'] = 'Bad request';
                  }
                }
                try {
                      $response = $fb->get('/me', $accessToken);
                    } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                      $msg['error'] = true;
			  		  $msg['msg'] = 'Graph returned an error: ' . $e->getMessage();
                    } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                      $msg['error'] = true;
			  		  $msg['msg'] = 'Facebook SDK returned an error: ' . $e->getMessage();
                    }
                    $me = $response->getGraphUser();
			  $fbid = $me->getId();              // To Get Facebook ID
			  $fbfullname = $me->getName(); // To Get Facebook full name
			  $femail = !is_null($me->getEmail()) ? $me->getEmail() : '';    // To Get Facebook email ID
			  if($user = $this->get_a_table_row('users','fb_id',$fbid)){
			  	$this->session->set_userdata('user',$user);
			  	$msg['success'] = true;
			  	$msg['msg'] = 'Login Successfull <a class="text-default" href="'.base_url('account').'"> Go To Your Account </a>';
			  }else{
			  	$dbData = array(
				  	'username' => $fbfullname,
				  	'email' => $femail !== '' ? $femail : '',
				  	'fb_id' => $fbid
				  );
				 if($this->db->insert('users',$dbData)){
			     		$last_id = $this->db->insert_id();
			     		//$this->insert_user_activation($last_id);
			     		$this->insert_user_profile($last_id);
			     		$user = $this->get_a_table_row('users','fb_id',$fbid);
			     		$this->session->set_userdata('user',$user);
					  	$msg['success'] = true;
					  	$msg['msg'] = 'Login Successfull <a class="text-default" href="'.base_url('account').'"> Go To Your Account </a>';
			     }else{
			     	$msg['error'] = true;
			  		$msg['msg'] = 'Login Not Successful';
			     }
			  }
			return $msg;
	     }
	     public function google_login(){
	     	$msg = array();
	     	$msg['success'] = false;
	     	$msg['error'] = false;
	     	$clientID = '555083656324-t8dp26jnjubc6bustit3u1lfqgh87jh8.apps.googleusercontent.com';
			$clientSecret = '47z_F6Lc6lW0ow_yCS3r5pnr';
			$redirectUri = base_url('login/google');
			$client = new Google_Client();
			$client->setClientId($clientID);
			$client->setClientSecret($clientSecret);
			$client->setRedirectUri($redirectUri);
			$client->addScope("email");
			$client->addScope("profile");
			if (isset($_GET['code'])) {
			  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
			  $client->setAccessToken($token['access_token']);
			  $google_oauth = new Google_Service_Oauth2($client);
			  $google_account_info = $google_oauth->userinfo->get();
			  $email =  $google_account_info->email;
			  $name =  $google_account_info->name;
			  if($user = $this->get_a_table_row('users','g_id',$email)){
			  	$this->session->set_userdata('user',$user);
			  	$msg['success'] = true;
			  	$msg['msg'] = 'Login Successfull <a class="text-default" href="'.base_url('account').'"> Go To Your Account </a>';
			  }else{
			  	$dbData = array(
				  	'username' => $name,
				  	'email' => $email !== '' ? $email : '',
				  	'g_id' => $email
				  );
				 if($this->db->insert('users',$dbData)){
			     		$last_id = $this->db->insert_id();
			     		//$this->insert_user_activation($last_id);
			     		$this->insert_user_profile($last_id);
			     		$user = $this->get_a_table_row('users','g_id',$email);
			     		$this->session->set_userdata('user',$user);
					  	$msg['success'] = true;
					  	$msg['msg'] = 'Login Successfull <a class="text-default" href="'.base_url('account').'"> Go To Your Account </a>';
			     }else{
			     	$msg['error'] = true;
			  		$msg['msg'] = 'Login Not Successful';
			     }
			  }
			}else{
			  $msg['error'] = true;
			  $msg['msg'] = 'Error';
			}
			return $msg;
	     }
	     public function facebook_login_url(){
// 			// init app with app id and secret
// 			FacebookSession::setDefaultApplication( '415238819108119','97fdeb0ba6dee0bae29535a7360b0ca3' );
// 			// login helper with redirect_uri
// 			$helper = new FacebookRedirectLoginHelper(base_url('login/facebook'));			
// 			$loginUrl = $helper->getLoginUrl();
// 			return $loginUrl;
			//session_start();
            $fb = new Facebook\Facebook([
              'app_id' => $this->fbid, // Replace {app-id} with your app id
              'app_secret' => $this->fbsecret,
              'default_graph_version' => 'v3.2',
              ]);
            
            $helper = $fb->getRedirectLoginHelper();
            
            $permissions = ['email']; // Optional permissions
            $loginUrl = $helper->getLoginUrl(base_url('login/facebook'),$permissions);
            
            return  htmlspecialchars($loginUrl);
	     }
	     public function google_login_url(){
	     	$clientID = '555083656324-t8dp26jnjubc6bustit3u1lfqgh87jh8.apps.googleusercontent.com';
			$clientSecret = '47z_F6Lc6lW0ow_yCS3r5pnr';
			$redirectUri = base_url('login/google');
			  
			// create Client Request to access Google API
			$client = new Google_Client();
			$client->setClientId($clientID);
			$client->setClientSecret($clientSecret);
			$client->setRedirectUri($redirectUri);
			$client->addScope("email");
			$client->addScope("profile"); 
			$login_url =  $client->createAuthUrl();
			return $login_url;
	     }
	     
	     public function get_hash_value($email_address)
	     {
	        
            $this->db->select('email_verification_code'); 
            $this->db->from('users');   
            $this->db->where('email', $email_address);
            return $this->db->get()->result();
           
	     }
		 
		  public function sms_verification_code($id)
	     {
	        
            $this->db->select('sms_verification'); 
            $this->db->from('users');   
            $this->db->where('id_user',$id);
            return $this->db->get()->result();
           
	     }
		 
		  public function is_sms_verify($id)
	     {
	        
           $data = array(
				'sms_verified' => 1	
		   );
		   
		   $this->db->where('id_user', $id);
           $this->db->update('users', $data);
           
	     }
	     
	     public function verify_user($email)
	     {
	          $data = array('is_verified' => 1);
              $this->db->where('email', $email);
              $this->db->update('users', $data);
	         
	     }
		 
		 public function get_sms_verified($id)
		 {
			
			   $this->db->where('id_user',$id);
			   $user=$this->db->get('users');
			   return $user->row();
		 }
		 
		  public function get_phone($id)
		 {
			
			   $this->db->where('user_id',$id);
			   $user=$this->db->get('user_profiles');
			   return $user->row();
		 }
	     
	    
	     
	     
	     
	 }
?>