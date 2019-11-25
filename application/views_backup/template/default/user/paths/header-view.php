<!DOCTYPE html>
<html>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134354802-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-134354802-1');
	</script>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo isset($site['des']) && !is_null($site['des']) ? $site['des'] : '' ?>">
    <?php $icon = isset($site['icon']) && !is_null($site['icon']) ? base_url().'assets/images/site-images/'.$site['icon'] : "" ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $icon ?>">
	<title><?php echo isset($title) && !is_null($title) ? $title : "" ?></title>
	<link  media="screen" media="print" href="<?php echo base_url('assets/css/bootstrap-4.min.css') ?>" rel="stylesheet" id="bootstrap-css">
	<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/fontawesome/css/all.min.css') ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/w3.css') ?>">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Karla&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Red+Hat+Text&display=swap" rel="stylesheet">
	<?php 
		if(isset($styles)){
			foreach($styles as $style){
	?>
	<link href="<?php echo base_url('assets/css/'.$style) ?>" rel="stylesheet" id="bootstrap-css">
	<?php } } ?>
	<style>
	body{
		color: #888;
		font-family: 'Raleway', sans-serif;
	}
	h1,h2,h3,h4,h5,h6{
		font-family: 'Red Hat Text', sans-serif;
	}
	nav a{
		font-family: 'Red Hat Text', sans-serif;
	}
	.container{
		max-width: 985px;
	}
	.btn-danger{
		background-color: <?php echo $site['default_color'] ?> !important;
	}
	.btn-info , .label.label-default.rank-label{
		background-color: <?php echo $site['featured_color'] ?> !important;
	}
		.bg-featured{
			background-color: <?php echo $site['featured_color'] ?> !important;
			color: #ffffff;
		}
		.bg-default{
			background-color: <?php echo $site['default_color'] ?> !important;
			color: #ffffff;
		}
		.text-featured{
			color: <?php echo $site['featured_color'] ?> !important;
		}
		.text-default{
			color: <?php echo $site['default_color'] ?> !important;
		}
		body section a{
			color: #094da2 !important;
			text-decoration: none;
		}
		body section a:hover{
			color: <?php echo $site['default_color'] ?> !important;
			text-decoration: none;
		}
		.footers-logo img{
			background-color: <?php echo $site['featured_color'] ?> !important;
		}
		.nav-link:hover{
			color: <?php echo $site['default_color'] ?> !important;
		}
		.bg-danger{
		    background-image: url(<?php echo base_url('assets/images/site-images/'.$site['home_banner']) ?>);
		    height: 400px;
		    background-color: transparent !important;
		    background-size: cover;
		    background-position: center;
		    margin-top: 60px;
		}
		.btn:hover{
			opacity: 0.6;
		}
		.content_accordion{
        margin: 20px;
    }
    /*a:focus{
    	color: <?php //echo $site['default_color'] ?> !important;
    }*/
    .responce{
    	color: <?php echo $site['default_color'] ?> !important;
    }
    .form-control[readonly]{
    	background-color: #fff;
    }
    /*.regions .list-unstyled li .region-link{
    	color: #03618c !important;
    	font-size: 15px;
    }
    a.region-link::hover {
    	color: <?php echo $site['featured_color'] ?> !important;
    }*/
	</style>
	<script type="text/javascript">
		let loading = '<div class="circle loader" id="circle"> <div class="loader"></div></div>';
		let currency = 'GH₵ ';
	</script>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-featured navbar-light  fixed-top">
	  <div class="container">
	  <?php $logo = isset($site['logo']) && !is_null($site['logo']) ? base_url().'assets/images/site-images/'.$site['logo'] : "" ?>
	  <a class="navbar-brand" href="<?php echo base_url(); ?>">
	      <img src="<?php echo $logo ?>" alt="<?php echo $site['logo'] ?> - Logo">
	  </a>
	   <!-- Toggler/collapsibe Button -->
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	<!-- Navbar links -->
	  <div class="collapse navbar-collapse" id="collapsibleNavbar">
	    <ul class="navbar-nav ml-auto">
	     <!--  <li class="nav-item">
	        <a class="nav-link" href="index.html">Home</a>
	      </li> -->
	      <li class="nav-item">
	        <a class="nav-link" href="<?php echo base_url('account') ?>">My Account</a>
	      </li>
	      <?php if($this->session->userdata('user')){ ?>
	      	<li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url('account/logout') ?>">Logout</a>
		    </li>
		  <?php } ?>
	      <!--<li class="nav-item">-->
	        <!--<a class="nav-link" href="#!<?php //echo base_url('page/help') ?>">Help</a>-->
	      <!--</li>-->
	      <a href="<?php echo base_url('account/post-ad') ?>"><button type="button" class="btn bg-default"><i style="color: #fff" class="fa fa-plus"></i> Post Ad</button></a>
	  
	    </ul>
	  </div>
	 </div>
	</nav>