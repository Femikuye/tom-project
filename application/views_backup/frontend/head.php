<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Tormami</title>
<!-- for-mobile-apps -->
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Tormami Ads Classified platform allow you to List your adverts, what you want to sale within the Ghana Territory.">
<link rel="shortcut icon" type="image/x-icon" href="https://tormami.com/dev/assets/images/site-images/56742331c8c74ba25505c07498598c50.png">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="<?php echo base_url('assets/frontend_assets/css/bootstrap.css');?>" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?php echo base_url('assets/frontend_assets/css/style.css');?>" rel='stylesheet' type='text/css' />
<!-- js -->
   <script src="<?php echo base_url('assets/frontend_assets/js/jquery-1.11.1.min.js');?>"</script>
<!-- //js -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo base_url('assets/frontend_assets/js/move-top.js');?>"</script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend_assets/js/easing.js');?>"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<link href="<?php echo base_url('assets/frontend_assets/css/font-awesome.css');?>" rel="stylesheet"> 
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
<!--- start-rate---->
<script src="<?php echo base_url('assets/frontend_assets/js/jstarbox.js');?>"></script>
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend_assets/css/jstarbox.css');?>" type="text/css" media="screen" charset="utf-8" />
		<script type="text/javascript">
			jQuery(function() {
			jQuery('.starbox').each(function() {
				var starbox = jQuery(this);
					starbox.starbox({
					average: starbox.attr('data-start-value'),
					changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
					ghosting: starbox.hasClass('ghosting'),
					autoUpdateAverage: starbox.hasClass('autoupdate'),
					buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
					stars: starbox.attr('data-star-count') || 5
					}).bind('starbox-value-changed', function(event, value) {
					if(starbox.hasClass('random')) {
					var val = Math.random();
					starbox.next().text(' '+val);
					return val;
					} 
				})
			});
		});
		</script>
<!---//End-rate---->

</head>
<body><a href="offer.html"><img src="images/download.png" class="img-head" alt=""></a><div class="header">		<div class="container">						<div class="logo">				<h1 ><a href="index.html"><b>T<br>H<br>E</b>Big Store<span>The Best Supermarket</span></a></h1>			</div>			<div class="head-t">				<ul class="card">					<!--<li><a href="wishlist.html" ><i class="fa fa-heart" aria-hidden="true"></i>Wishlist</a></li>-->										 <?php if($this->session->userdata('user')){ ?>																				<li><a href="<?php echo base_url('account/logout')?>"><i class="fa fa-user" aria-hidden="true"></i>Logout</a></li>							  <?php }else{ ?>					    <li><a href="<?php echo base_url('/login')?>"><i class="fa fa-user" aria-hidden="true"></i>Login</a></li>					  <?php } ?>					<li><a href="<?php echo base_url('/register')?>" ><i class="fa fa-arrow-right" aria-hidden="true"></i>Register</a></li>					<li><a href="<?php echo base_url('account') ?>" ><i class="fa fa-file-text-o" aria-hidden="true"></i>My Account</a></li>				    <li><a href="<?php echo base_url('account/post-ad') ?>" ><i class="fa fa-ship" aria-hidden="true"></i>Post Ad</a></li> 				</ul>				</div>						<div class="header-ri">				<ul class="social-top">					<li><a href="#" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span></span></a></li>					<li><a href="#" class="icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span></span></a></li>					<li><a href="#" class="icon pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i><span></span></a></li>					<li><a href="#" class="icon dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i><span></span></a></li>				</ul>				</div>						<div class="nav-top">					<nav class="navbar navbar-default">										<div class="navbar-header nav_2">						<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">							<span class="sr-only">Toggle navigation</span>							<span class="icon-bar"></span>							<span class="icon-bar"></span>							<span class="icon-bar"></span>						</button>											</div> 					<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">						<ul class="nav navbar-nav ">							<li class=" active"><a href="index.html" class="hyper "><span>Home</span></a></li>															<li class="dropdown ">								<a href="#" class="dropdown-toggle  hyper" data-toggle="dropdown" ><span>Kitchen<b class="caret"></b></span></a>								<ul class="dropdown-menu multi">									<div class="row">										<div class="col-sm-3">											<ul class="multi-column-dropdown">															<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Water & Beverages</a></li>												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Fruits & Vegetables</a></li>												<li><a href="kitchen.html"> <i class="fa fa-angle-right" aria-hidden="true"></i>Staples</a></li>												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Branded Food</a></li>																					</ul>																				</div>										<div class="col-sm-3">																					<ul class="multi-column-dropdown">												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Breakfast &amp; Cereal</a></li>												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Snacks</a></li>												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Spices</a></li>												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Biscuit &amp; Cookie</a></li>												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Sweets</a></li>																					</ul>																				</div>										<div class="col-sm-3">																					<ul class="multi-column-dropdown">												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Pickle & Condiment</a></li>												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Instant Food</a></li>												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Dry Fruit</a></li>												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Tea &amp; Coffee</a></li>																					</ul>										</div>										<div class="col-sm-3 w3l">											<a href="kitchen.html"><img src="images/me.png" class="img-responsive" alt=""></a>										</div>										<div class="clearfix"></div>									</div>									</ul>							</li>							<li class="dropdown">															<a href="#" class="dropdown-toggle hyper" data-toggle="dropdown" ><span> Personal Care <b class="caret"></b></span></a>								<ul class="dropdown-menu multi multi1">									<div class="row">										<div class="col-sm-3">											<ul class="multi-column-dropdown">												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Ayurvedic </a></li>												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Baby Care</a></li>												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Cosmetics</a></li>												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Deo & Purfumes</a></li>																					</ul>																					</div>										<div class="col-sm-3">																						<ul class="multi-column-dropdown">												<li><a href="care.html"> <i class="fa fa-angle-right" aria-hidden="true"></i>Hair Care </a></li>												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Oral Care</a></li>												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Personal Hygiene</a></li>												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Skin care</a></li>																					</ul>																					</div>										<div class="col-sm-3">																						<ul class="multi-column-dropdown">												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Fashion Accessories </a></li>												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Grooming Tools</a></li>												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Shaving Need</a></li>												<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Sanitary Needs</a></li>																					</ul>										</div>										<div class="col-sm-3 w3l">											<a href="care.html"><img src="images/me1.png" class="img-responsive" alt=""></a>										</div>										<div class="clearfix"></div>									</div>									</ul>							</li>							<li class="dropdown">								<a href="#" class="dropdown-toggle hyper" data-toggle="dropdown" ><span>Household<b class="caret"></b></span></a>								<ul class="dropdown-menu multi multi2">									<div class="row">										<div class="col-sm-3">											<ul class="multi-column-dropdown">												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Cleaning Accessories</a></li>												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>CookWear</a></li>												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Detergents</a></li>												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Gardening Needs</a></li>																					</ul>																				</div>										<div class="col-sm-3">																						<ul class="multi-column-dropdown">												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Kitchen & Dining</a></li>												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>KitchenWear</a></li>												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Pet Care</a></li>												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Plastic Wear</a></li>																					</ul>																				</div>										<div class="col-sm-3">																					<ul class="multi-column-dropdown">												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Pooja Needs</a></li>												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Serveware</a></li>												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Safety Accessories</a></li>												<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Festive Decoratives </a></li>																					</ul>										</div>										<div class="col-sm-3 w3l">											<a href="hold.html"><img src="images/me2.png" class="img-responsive" alt=""></a>										</div>										<div class="clearfix"></div>									</div>									</ul>							</li>														<li><a href="codes.html" class="hyper"> <span>Codes</span></a></li>							<li><a href="contact.html" class="hyper"><span>Contact Us</span></a></li>						</ul>					</div>					</nav>					 <div class="cart" >											<span class="fa fa-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>					</div>					<div class="clearfix"></div>				</div>									</div>			</div>  <!---->