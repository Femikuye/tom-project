<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo isset($site['des']) && !is_null($site['des']) ? $site['des'] : '' ?>">
    <?php $icon = isset($site['icon']) && !is_null($site['icon']) ? base_url().'assets/images/site-images/'.$site['icon'] : "" ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $icon ?>">
	<title><?php echo isset($site['title']) && !is_null($site['title']) ? $site['title'] : "" ?></title>
	<link  media="screen" media="print" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" id="bootstrap-css">
	<link href="<?php echo base_url('assets/css/admin-style.css') ?>" rel="stylesheet">
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
		    height: 350px;
		    background-color: transparent;
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
</head>
<body>
	<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
			MENU
			</button>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				Admin
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
			<form class="navbar-form navbar-left" method="GET" role="search">
				<div class="form-group">
					<input type="text" name="q" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="http://www.pingpong-labs.com" target="_blank">Visit Site</a></li>
				<li class="dropdown ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						Account
						<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="dropdown-header">SETTINGS</li>
							<li class=""><a href="#">Other Link</a></li>
							<li class=""><a href="#">Other Link</a></li>
							<li class=""><a href="#">Other Link</a></li>
							<li class="divider"></li>
							<li><a href="#">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="container-fluid main-container">