<?php
	class Api_model extends Ci_model
	{	
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		public function update_user_profile(){
			$this->db->set('first_name',$this->input->post('first_name'));
	    	$this->db->set('last_name',$this->input->post('last_name'));
	    	$this->db->set('city',$this->input->post('city'));
	    	$this->db->set('address',$this->input->post('address'));
	    	$this->db->set('state',$this->input->post('state'));
	    	$this->db->set('about_user',$this->input->post('about'));
	    	$this->db->set('date_updated',time());
	    	$this->db->where('user_id',$this->user['id_user']);
	    	if($this->db->update('user_profiles')){
	    		return true;
	    	}else{
	    		return false;
	    	}
		}
		public function save_user_profile(){
			$dbData = array(
				'user_id' => $this->user['id_user'],
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'city' => $this->input->post('city'),
				'address' => $this->input->post('address'),
				'state' => $this->input->post('state'),
				'about_user' => $this->input->post('about'),
				'date_created' => time(),
				'date_updated' => time()
			);
	    	if($this->db->insert('user_profiles',$dbData)){
	    		return true;
	    	}else{
	    		return false;
	    	}
		}
		public function create_new_ad(){			
			$user = $this->session->userdata('user');
			$slug = $this->general_model->create_unique_slug($this->input->post('aid_title'),'aids','aid_slug');
			$cat_row = $this->general_model->get_a_table_row('aid_categories','cat_slug',$this->input->post('sub_cat'));
			$main_cat_id = $this->my_encrypt->decode($this->input->post('cat'));
			$dbData = array(
				'poster_id' => $user['id_user'],
				'uid' => $this->general_model->generateUid(),
				'aid_title' => $this->input->post('aid_title'),
				'aid_des' => $this->input->post('des'),
				'aid_city' => $this->input->post('city'),
				'aid_state' => $this->input->post('state'),
				'aid_category_id' => $main_cat_id,
				'aid_subcategory_id' => $cat_row['id_cat'],
				'aid_price' => $this->input->post('price'),
				'poster_phone'=>   $this->input->post('tel') ? $this->input->post('tel') : $user['phone'] ,
				'aid_slug' => $slug,
				'date_created' => time(),
				'date_updated' => time(),
				
			);
			if($this->db->insert('aids',$dbData)){
				$last_id = $this->db->insert_id();
				$this->update_cat_count($main_cat_id);
				$this->update_cat_count($cat_row['id_cat']);
				$imgs = $this->upload_aid_images($last_id);
				//$this->upload_aid_doc($last_id);
				return $imgs; 
			}else{
				return false;
			}
		}
		public function update_cat_count($cat){
			$this->db->set('aid_count','aid_count + '. 1 , false);
			$this->db->where('id_cat',$cat);
			$this->db->update('aid_categories');
		}
		public function deduct_cat_count($cat){
			$this->db->set('aid_count','aid_count - '. 1 , false);
			$this->db->where('id_cat',$cat);
			$this->db->update('aid_categories');
		}
		public function update_ad(){
			$aid_id = $this->my_encrypt->decode($this->input->post('aid-id'));
			$slug = $this->general_model->create_unique_slug($this->input->post('aid_title'),'aids','aid_slug');
			$cat_id = $this->my_encrypt->decode($this->input->post('cat'));
			$prev_aid_cat = $this->general_model->get_a_table_row('aids','id_aid',$aid_id);
			$this->db->set('aid_title' , $this->input->post('aid_title'));
			$this->db->set('aid_des' , $this->input->post('des'));
			$this->db->set('aid_city' , $this->input->post('city'));
			$this->db->set('aid_state' , $this->input->post('state'));
			$this->db->set('aid_subcategory_id' , $cat_id);
			$this->db->set('aid_price' , $this->input->post('price'));
			$this->db->set('aid_slug' , $slug);
			$this->db->set('date_updated' , time());
			$this->db->set('poster_phone' , $this->input->post('tel'));
			$this->db->where('id_aid',$aid_id);
			if($this->db->update('aids')){
				if($prev_aid_cat['aid_subcategory_id'] !== $cat_id){
					$this->update_cat_count($cat_id);
					$this->deduct_cat_count($prev_aid_cat['aid_subcategory_id']);
				}
				return true; 
			}else{
				return false;
			}
		}
		public function upload_aid_images($aid_id){			
			$images = $_FILES['images']['name'];
			$img_array = array();
			$imgPath = 'assets/images/aid-images/'.$aid_id;
			$allowType = 'jpeg|gif|png|jpg';
			$uploaded = $this->general_model->upload_multiple_files('images',$imgPath,$allowType);
			if(count($uploaded) > 0){
				for($i=0;$i<count($uploaded);$i++){
					$dbData = array(
						'aid_id' => $aid_id,
						'image_name' => $uploaded[$i],
						'featured' => $i === 0 ? '1' : '0',
						'img_uid' => $this->general_model->generateUid()
					);
					$this->db->insert('aid_images',$dbData);
					array_push($img_array, $uploaded[$i]);
				}
				$this->db->set('published','1');
				$this->db->where('id_aid',$aid_id);
				$this->db->update('aids');
				
			}
			return $img_array;
		}
		public function upload_aid_doc($aid_id){
			$img_array = array();
			$Path = 'assets/documents/aid-docs/'.$aid_id;
			$allowType = 'pdf|docx|txt|xls';
			$uploaded = $this->general_model->uploadFiles('aid-doc',$Path,$allowType);
			if($uploaded['success']){
				$this->db->set('aid_doc',$uploaded['success']);
				$this->db->where('id_aid',$aid_id);
				$this->db->update('aids');			
			}else{
				print_r($uploaded['error']) ;
			}

		}
	}
?>