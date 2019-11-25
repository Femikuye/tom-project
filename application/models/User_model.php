<?php
	class User_model extends Ci_model
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
	}
?>