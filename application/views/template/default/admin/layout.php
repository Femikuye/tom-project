<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('template/default/admin/paths/header-view');
	$this->load->view('template/default/admin/paths/left-view');
		echo $contents;
	 $this->load->view('template/default/admin/paths/footer-view');
 ?>