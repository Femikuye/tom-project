<?php
	class Admin_model extends Ci_Model
	{		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		public function update_site_settings(){
			$res = array();
			$res['error'] = false;
			$res['success'] = false;
			$site_setting = $this->general_model->initSetting();
			$this->db->set('title',$this->input->post('site-name'));
			$this->db->set('des',$this->input->post('description'));
			$this->db->set('email',$this->input->post('email'));
			$this->db->set('stripe_sk_key',$this->input->post('st_sk_key'));
			$this->db->set('stripe_pk_key',$this->input->post('st_pk_key'));
			$this->db->set('sms_api_key',$this->input->post('sms_api'));
			$this->db->set('phone',$this->input->post('tel'));
			$this->db->where('setting_id','1');
			$this->db->update('site_settings');
			if(isset($_FILES['icon'])){
				$icon_res = $this->upload_site_icon();
				if($icon_res['success']){
					if(!empty($site_setting['site_icon'])){
						$this->general_model->deleteFile('assets/images/site-images/'.$site_setting['site_icon']);
					}
					$res['success'] = true;
				}else{
					$res['error'] = $icon_res['error'];
				}
			}
			if(isset($_FILES['logo'])){
				$logo_res = $this->upload_site_logo();
				if($logo_res['success']){
					if(!empty($site_setting['logo'])){
						$this->general_model->deleteFile('assets/images/site-images/'.$site_setting['logo']);
					}
					$res['success'] = true;
				}else{
					$res['error'] = $logo_res['error'];
				}
			}
			if(isset($_FILES['banner'])){
				$banner_res = $this->upload_site_banner();
				if($banner_res['success']){
					if(!empty($site_setting['home_banner'])){
						$this->general_model->deleteFile('assets/images/site-images/'.$site_setting['home_banner']);
					}
					$res['success'] = true;
				}else{
					$res['error'] = $banner_res['error'];
				}
			}
			return true;
		}
		public function upload_site_icon(){
			$res = array();
			$res['error'] = false;
			$res['success'] = false;
			if($_FILES['icon']['size'] > 0 && $_FILES['icon']['error'] == 0){
				$imgDir = "assets/images/site-images";
				if(!file_exists($imgDir)){
					mkdir($imgDir);
				}
				$allowType = "png|jpg|gif";
				$fileName = $this->general_model->uploadFiles('icon',$imgDir,$allowType);
				if($fileName['success']){
					$this->db->set('icon', $fileName['success']);
					$this->db->where('setting_id','1');
					$this->db->update('site_settings');
					$res['success'] = true;
				}else{
					$res['error'] = $fileName['error'];
				}
			}
			return $res;
		}
		public function upload_site_logo(){
			$res = array();
			$res['error'] = false;
			$res['success'] = false;
			if($_FILES['logo']['size'] > 0 && $_FILES['logo']['error'] == 0){
				$imgDir = "assets/images/site-images";
				if(!file_exists($imgDir)){
					mkdir($imgDir);
				}
				$allowType = "jpg|gif|png";
				$fileName = $this->general_model->uploadFiles('logo',$imgDir,$allowType);
				if($fileName['success']){
					$this->db->set('logo', $fileName['success']);
					$this->db->where('setting_id','1');
					$this->db->update('site_settings');
					$res['success'] = true;
				}else{
					$res['error'] = $fileName['error'];
				}
			}
			return $res;
		}
		public function upload_site_banner(){
			$res = array();
			$res['error'] = false;
			$res['success'] = false;
			if($_FILES['banner']['size'] > 0 && $_FILES['banner']['error'] == 0){
				$imgDir = "assets/images/site-images";
				if(!file_exists($imgDir)){
					mkdir($imgDir);
				}
				$allowType = "jpg|gif|png|jpeg";
				$fileName = $this->general_model->uploadFiles('banner',$imgDir,$allowType);
				if($fileName['success']){
					$this->db->set('home_banner', $fileName['success']);
					$this->db->where('setting_id','1');
					$this->db->update('site_settings');
					$res['success'] = true;
				}else{
					$res['error'] = $fileName['error'];
				}
			}
			return $res;
		}
	}
?>