<?php

  class Home extends Ci_Controller

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

  	public function index(){

  	$data = array();

      $data['styles'] = ['extra-style.css','listing-style.css'];

      $data['scripts'] = ['normal_user.js'];

      $data['title'] = $this->set['title']."- Home Page";

      $data['site'] = $this->set;

  		$this->template->load('user/layout','contents','ui/home-view',$data);

  	}
    public function logout(){
      if($this->session->userdata('user')){
        $this->session->sess_destroy('user');
        redirect(base_url());
      }
    }
    public function page($slug=null){

      if(!is_null($slug)){

        if($page = $this->gm->get_a_table_row('pages','page_slug',$slug)){

          $data = array();

          $data['styles'] = ['extra-style.css'];

          $data['scripts'] = ['normal_user.js'];

          $data['title'] = $this->set['title']."- ".$page['page_name'];

          $data['site'] = $this->set;

          $data['page'] = $page;

          $this->template->load('user/layout','contents','ui/pages/site-page-view',$data);

        }else{

          show_404();

        } 

      }else{

        show_404();

      } 

    }    

    public function search($slug1=null,$slug2=null,$slug3=null){
      $data = array();     

      $data['styles'] = ['extra-style.css','img-shuffle-style.css','listing-style.css'];
      $data['scripts'] = ['jquery-ui.js','normal_user.js'];
      $data['title'] = $this->set['title']."- Home Page";
      $data['site'] = $this->set;
      $data['heading'] = '';
      $page_title = '';
      $paging_url = '';
      $curr_pagin_page = 0;
      $url_slug = null;

      $limit = 20;

      $count_results = 0;

      $start = 0;

      $this->load->database();

      $this->db->select('*');

      //$this->db->from('aids');

      if($slug1 === 'cat'){

        $cat_row = $this->gm->get_a_table_row('aid_categories','cat_slug',$slug2);

        $url_slug = 'cat';

        if($cat_row){

          $cat_id = $cat_row['id_cat'];

          if($cat_row['parent_id'] === '0'){

            $data['heading'] .= $cat_row['cat_name'];

            $this->db->where('aid_category_id',$cat_id);

          }else{

            $m_cat_row = $this->gm->get_a_table_row('aid_categories','id_cat',$cat_row['parent_id']);            

            $data['heading'] .= $m_cat_row['cat_name']." > ". $cat_row['cat_name'];

            //$url_slug .= $cat_row['cat_slug'];

            $this->db->where('aid_subcategory_id',$cat_id);

          }

        }

        $paging_url = base_url('ads/'.$slug1.'/'.$slug2);

      }elseif($slug1 === 'p'){

        $p_row = $this->gm->get_a_table_row('ghana_province','p_slug',$slug2);

        $url_slug = 'p';

        if($p_row){

          $p_name = $p_row['p_name'];

          if($p_row['p_status'] === 'State'){

            $data['heading'] = $p_name;

            $this->db->like('aid_state',$p_name);

          }elseif($p_row['p_status'] === 'City'){

            $m_p_row = $this->gm->get_a_table_row('ghana_province','id_province',$p_row['p_state_id']);

            $data['heading'] = $m_p_row['p_name']." > ".$p_row['p_name'];

            $this->db->like('aid_city',$p_name);

          }

          //$count_results = count(); 

        }

        $paging_url = base_url('ads/'.$slug1.'/'.$slug2);

      }else{

        if(ctype_digit($slug1)){

          $count_results = $this->db->get('aids')->num_rows();

          $start = $limit * ((int)$slug1 - 1);

          $curr_pagin_page = (int)$slug1;

          $data['heading'] = 'All ads';

          $paging_url = base_url('ads');

        }else{

          if($p_row = $this->gm->get_a_table_row('ghana_province','p_slug',$slug1)){

            if($p_row['p_state_id'] === '0'){

              $data['heading'] .= $p_row['p_name'];

              $this->db->like('aid_state',$p_row['p_name']);

            }else{

              if($c_row = $this->gm->get_a_table_row('ghana_province','id_province',$p_row['p_state_id'])){

                $data['heading'] .= $p_row['p_name']." > ".$c_row['p_name'];

                $this->db->like('aid_state',$p_row['p_name']);

                $this->db->like('aid_city',$c_row['p_name']);

              }

            }

          }

          if($cat = $this->gm->get_a_table_row_raw_query('aid_categories','cat_slug',$slug2)){

            if($cat['parent_id'] === '0'){

              $data['heading'] .= ' > '.$cat['cat_name'];

              $this->db->where('aid_category_id',$cat['id_cat']);

            }else{

              if($main_cat = $this->gm->get_a_table_row_raw_query('aid_categories','id_cat',$cat['parent_id'])){                

                $data['heading'] .= ' > '.$main_cat['cat_name'].' > '.$cat['cat_name'];

                $this->db->where('aid_subcategory_id',$cat['id_cat']);

              }

            }

          }

          //$count_results = $this->db->get('aids')->num_rows();

          $paging_url = base_url('ads/'.$slug1.'/'.$slug2);

        }

      }

      if($this->input->get('keyword') !== ''){

        $this->db->like('aids.aid_title',$this->input->get('keyword'));

        $keyword = $this->input->post('keyword');

      }

      if(!is_null($this->input->get('price-start'))){

        $this->db->where('aids.aid_price >=',$this->input->get('price-start'));

      }

      if(!is_null($this->input->get('price-end'))){

        $this->db->where('aids.aid_price <=',$this->input->get('price-end'));

      }

      if(!is_null($slug3)){

        $curr_pagin_page = $slug3;

        $paging_url = base_url('ads/'.$slug1.'/'.$slug2);

      }

      $this->db->where('published','1');

      $this->db->order_by('date_created','desc');

      $this->db->limit($limit,$start);

      $query = $this->db->get('aids');

      $data['aid_rows'] = $query->result_array();

      $data['seg'] = $url_slug;

      $data['slug'] = $slug2;

      $data['pages'] = $count_results / $limit;

      $data['paging_url'] = $paging_url;

      $data['cpp'] = $curr_pagin_page;

      $this->template->load('user/layout','contents','ui/category-aid-view',$data);

    }

    public function search_query($page=null){
      $data = array();     
      $keyword = trim($this->input->get('search_data'));
      $category = trim($this->input->get('cat-name'));
      $city = $this->input->get('SearchCity');
      $data['styles'] = ['extra-style.css','img-shuffle-style.css','listing-style.css'];
      $data['scripts'] = ['jquery-ui.js','normal_user.js'];
      $data['title'] = $this->set['title']."- Search-terms - City- ".$city." Category: ".$category." Keyword:".$keyword;;
      $data['site'] = $this->set;
      $limit = 30;
      $url_search_query = $this->gm->get_url_search_query(); 
      $paging_url = base_url('advert/searches');
      $count_results = 0;
      if($page !== null){
        $start = $page * $limit;
        $curr_pagin_page = $page;
        //$paging_url = base_url('advert/searches/'.$page.'?'.$url_search_query);
      }else{
        $start = 0;        
        $curr_pagin_page = 0;
      }
      $cat_row = $this->gm->get_a_table_row('aid_categories','cat_name',$category);
      $p_row = $this->gm->get_a_table_row('ghana_province','p_name',$city);
      $count_results = $this->gm->count_search_result($cat_row,$p_row);
      $data['heading'] = $this->gm->get_search_result_heading($cat_row,$p_row);
      $this->load->database();
      if($category !== '' && $category !== 'All-Categories'){       
        if($cat_row['parent_id'] === '0'){
          $this->db->where('aid_category_id',$cat_row['id_cat']);
        }else{
          $this->db->where('aid_subcategory_id',$cat_row['id_cat']);
        }
        //$data['heading'] .= $category;
      }
      if($city !== '' && $city !== 'All-Ghana'){
        if($p_row['p_status'] === 'State'){
          $this->db->where('aid_state',$p_row['p_name']);
        }else{
          $this->db->where('aid_city',$p_row['p_name']);
        }
        //$data['heading'] .= " -> ".$city;
      }
      if($keyword !== ''){
        $this->db->like('aid_title',$keyword);
        $this->db->or_like('aid_des',$keyword);
        //$data['heading'] .= " -> ".$keyword;
      } 
      $this->db->where('published','1');
      $this->db->limit($limit,$start);
      $this->db->order_by('id_aid','desc');
      $query = $this->db->get('aids');
      $data['paging_url'] = $paging_url;
      $data['s_query'] = $url_search_query;
      $data['aid_rows'] = $query->result_array();
      $data['pages'] = $count_results / $limit;
      $data['cpp'] = $curr_pagin_page;
      $this->template->load('user/layout','contents','ui/search-result-view',$data);
    }
    public function ad($slug){
      $data = array();

      $aid_id = $this->gm->get_slug_id($slug) ;

      $data['styles'] = ['extra-style.css','img-shuffle-style.css'];

      $data['scripts'] = ['jquery-ui.js','normal_user.js'];
      $data['site'] = $this->set;
      $data['user_id']=$this->session->userdata('user');
      $data['aid_row'] = $this->gm->get_a_table_row('aids','id_aid',$aid_id);
      $data['title'] = $this->set['title']." - ".$data['aid_row']['aid_title'];
      $this->template->load('user/layout','contents','ui/aid-single-view',$data);

    }    

    public function contact_advertiser(){
      $msg = array();
      $poster_id = $this->my_encrypt->decode($this->input->post('advertiser'));
      $advertiser = $this->gm->get_a_table_row('users','id_user',$poster_id);
      $mailData = array(
            'from' => $this->set['email'],
            'from_name' => $this->set['title'],
            'to' => $advertiser['email'],
            'subject' => 'A Message On Your Advertisment',
            'body' => $this->input->post('message'),
            'receiver_name' => $advertiser['username'],
            'sender_name' => $this->input->post('name'),
            'reply_to' => $this->input->post('email'),
            'file' => null,//$uploader['success'] != false ? $imgPath.'/'.$uploader['success'] : null,
            'file_name' => null//$uploader['success'] != false ? $_FILES['file']['name'] : null,
          );
        $this->load->model('email_model');
        $mailRes = $this->email_model->myMailSender($mailData);
        if($mailRes['success']){
          $msg['success'] = true;
        }else{
          $msg['error'] = true;
        }
      header("Content-type:application/json");
      echo json_encode($msg);
    }

    public function search_aids(){
      $msg = array();
      //$head_title = '<h3 class="mt-4">';
      $province = '';
      $cat = '';
      $keyword = '';
      $this->load->database();
      $this->db->select('*');
      $this->db->from('aids');
      $this->db->join('aid_images','aid_images.aid_id = aids.id_aid');
      if($this->input->post('keyword') !== ''){
        $this->db->like('aids.aid_title',$this->input->post('keyword'));
        $keyword = $this->input->post('keyword');
      }
      if($this->input->post('province') !== ''){
        $this->db->like('aids.aid_city',$this->input->post('province'));
        $this->db->like('aids.aid_state',$this->input->post('province'));
        $province =  $this->input->post('province').'<span class="text-default"> > </span>' ;
      }
      if($this->input->post('category') !== '0'){
        $cat_id = $this->my_encrypt->decode($this->input->post('category'));
        $this->db->where('aids.aid_category_id',$cat_id);
        $cat = $cat_id;//
      }
      if($this->input->post('price-start') !== ''){
        $this->db->where('aids.aid_price >=',$this->input->post('price-start'));
      }
      if($this->input->post('price-end') !== ''){
        $this->db->where('aids.aid_price <=',$this->input->post('price-end'));
      }
      $this->db->where('aid_images.featured','1');
      $this->db->order_by('aids.date_created');
      $this->db->limit('24');
      $query = $this->db->get();
      $cat = $this->gm->get_a_table_row('aid_categories','id_cat',$cat);
      $cat_txt = $cat !== false ? $cat['cat_name'].'<span class="text-default"> > </span>' : '';
      $msg['rowhead'] = '<h3 class="mt-4">'.$province . $cat_txt . $keyword.'</h3>';
      if($query->num_rows() > 0){
        $msg['success'] = true;
        $msg['rows'] = $query->result_array();
      }else{
        $msg['error'] = true;
        $msg['msg'] = "No result found for your search term";
      }
      header("Content-type:application/json");
      echo json_encode($msg);
    }
  }



?>