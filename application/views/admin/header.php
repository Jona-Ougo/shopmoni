<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Shop Moni Ecommerce Application">
	<meta name="author" content="Think First Technologies">
	<title>ShopMoni<?=(isset($page_title))?' :: '.$page_title:''; ?></title>
	<link rel="shortcut icon" href="<?=base_url() ?>assets/images/favicon.png">

	<!-- App css -->
	<link href="<?=base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url() ?>assets/css/core.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url() ?>assets/css/components.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url() ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url() ?>assets/css/pages.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url() ?>assets/css/menu.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url() ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?=base_url() ?>assets/plugins/switchery/switchery.min.css">
	<link rel="stylesheet" href="<?=base_url() ?>assets/plugins/toastr/toastr.min.css">
	<link href="<?=base_url() ?>assets/plugins/dropzone/dropzone.min.css" rel="stylesheet" />
	<link href="<?=base_url() ?>assets/plugins/dropzone/basic.min.css" rel="stylesheet" />
	<link href="<?=base_url('assets/css/font-awesome.css');?>" rel="stylesheet" type="text/css" />
	<link type="text/css" href="<?=base_url('assets/css/redactor.css');?>" rel="stylesheet" />
	<link type="text/css" href="<?=base_url('assets/css/pickadate/default.css');?>" rel="stylesheet" />
	<link type="text/css" href="<?=base_url('assets/css/pickadate/default.date.css');?>" rel="stylesheet" />
	<link rel="stylesheet" href="<?=base_url('assets/plugins/wizard/prettify.css') ?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/loading.css') ?>">
	<script src="<?=base_url() ?>assets/js/modernizr.min.js"></script>
	<script src="<?=base_url() ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="https://mattboldt.com/typed.js/lib/typed.min.js"></script>
	<style>
	div .checkbox{
		all: none !important;
	}

	.notification{
		animation: blinker 2s linear infinite;
	}
	@keyframes blinker{
		50% {opacity : 0;}
	}
</style>

</head>
<body>
	<!-- Navigation Bar-->
	<header id="topnav">
		<div class="topbar-main">
			<div class="container">

				<!-- Logo container-->
				<div class="logo">
					<!-- Text Logo -->
					<!--<a href="" class="logo">-->
						<!--Zircos-->
						<!--</a>-->
						<!-- Image Logo -->
						<a href="<?=site_url() ?>" class="logo">
							<img src="<?=base_url() ?>assets/images/logo.png" alt="" height="30">
						</a>

					</div>
					<!-- End Logo container-->
					<?php 

					$where = ['customer_id'=>\CI::Login()->customer()->id, 'type'=>'notification', 'status'=>0];
					$_notifications = \DB\DB::get('notifications', $where);

					$where = ['customer_id'=>\CI::Login()->customer()->id, 'type'=>'payment', 'status'=>0];
					$_payments = \DB\DB::get('notifications', $where);

					$where = ['customer_id'=>\CI::Login()->customer()->id, 'type'=>'order', 'status'=>0];
					$_orders = \DB\DB::get('notifications', $where);

					$where = ['customer_id'=>\CI::Login()->customer()->id, 'type'=>'review', 'status'=>0];
					$_reviews = \DB\DB::get('notifications', $where);

					?>

					<div class="menu-extras">

						<ul class="nav navbar-nav navbar-right pull-right">

							<li class="dropdown navbar-c-items">
								<a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-bell"></i>
									<?php if(count($_notifications) > 0): ?>
										<span class="badge up bg-warning notification"><?=count($_notifications) ?></span>
									<?php else: ?>
										<span class="badge up bg-warning"><?=count($_notifications) ?></span>
									<?php endif; ?>
								</a>

								<ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
									<li class="text-center">
										<h5>ShopMoni Notifications</h5>
									</li>
									<?php foreach($_notifications as $row): ?>
										<li>
											<a href="<?=$row->link ?>" class="user-list-item">
												<div class="icon bg-info">
													<i class="mdi mdi-account"></i>
												</div>
												<div class="user-desc">
													<span class="name"><?=$row->notification ?></span>
													<span class="time"><?=dateAgo($row->created_at) ?></span>
												</div>
											</a>
										</li>
									<?php endforeach; ?>

									<li class="all-msgs text-center">
										<p class="m-0"><a href="<?=site_url('admin/notifications') ?>">See all Notification</a></p>
									</li>
								</ul>
							</li>

							<li class="dropdown navbar-c-items">
								<a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<i class="fa fa-credit-card"></i>
									<?php if(count($_payments) > 0): ?>
										<span class="badge up bg-success notification"><?=count($_payments) ?></span>
									<?php else: ?>
										<span class="badge up bg-success"><?=count($_payments) ?></span>
									<?php endif; ?>
								</a>

								<ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
									<li class="text-center">
										<h5>Payment Notifications</h5>
									</li>
									<?php foreach($_payments as $row): ?>
										<li>
											<a href="<?=$row->link ?>" class="user-list-item">
												<div class="icon bg-info">
													<i class="mdi mdi-account"></i>
												</div>
												<div class="user-desc">
													<span class="name"><?=$row->notification ?></span>
													<span class="time"><?=dateAgo($row->created_at) ?></span>
												</div>
											</a>
										</li>
									<?php endforeach; ?>

									<li class="all-msgs text-center">
										<p class="m-0"><a href="<?=site_url('admin/orders') ?>">See all Orders</a></p>
									</li>
								</ul>
							</li>

							<li class="dropdown navbar-c-items">
								<a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<i class="fa fa-shopping-cart"></i>
									<?php if(count($_orders) > 0): ?>
										<span class="badge up bg-primary notification"><?=count($_orders) ?></span>
									<?php else: ?>
										<span class="badge up bg-primary"><?=count($_orders) ?></span>
									<?php endif; ?>
								</a>

								<ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
									<li class="text-center">
										<h5>Order Notifications</h5>
									</li>
									<?php foreach($_orders as $row): ?>
										<li>
											<a href="<?=$row->link ?>" class="user-list-item">
												<div class="icon bg-info">
													<i class="mdi mdi-account"></i>
												</div>
												<div class="user-desc">
													<span class="name"><?=$row->notification ?></span>
													<span class="time"><?=dateAgo($row->created_at) ?></span>
												</div>
											</a>
										</li>
									<?php endforeach; ?>

									<li class="all-msgs text-center">
										<p class="m-0"><a href="<?=site_url('admin/orders') ?>">See all Orders</a></p>
									</li>
								</ul>
							</li>

							<li class="dropdown navbar-c-items">
								<a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-email"></i>
									<?php if(count($_reviews) > 0): ?>
										<span class="badge up bg-danger notification"><?=count($_reviews) ?></span>
									<?php else: ?>
										<span class="badge up bg-danger"><?=count($_reviews) ?></span>
									<?php endif; ?>
								</a>

								<ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
									<li class="text-center">
										<h5>Customer Reviews</h5>
									</li>
									<?php foreach($_reviews as $row): ?>
										<li>
											<a href="<?=$row->link ?>" class="user-list-item">
												<div class="icon bg-info">
													<i class="mdi mdi-account"></i>
												</div>
												<div class="user-desc">
													<span class="name"><?=$row->notification ?></span>
													<span class="time"><?=dateAgo($row->created_at) ?></span>
												</div>
											</a>
										</li>
									<?php endforeach; ?>

									<li class="all-msgs text-center">
										<p class="m-0"><a href="#">See all Reviews</a></p>
									</li>
								</ul>
							</li>



							<li class="dropdown navbar-c-items">
								<a href="#" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="<?=base_url() ?>assets/images/users/male.png" alt="user-img" class="img-circle"> </a>
								<ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
									<li class="text-center">
										<h5>Hi, John</h5>
									</li>
									<li><a href="<?=site_url('logout') ?>"><i class="ti-power-off m-r-5"></i> Logout</a></li>
								</ul>

							</li>
						</ul>
						<div class="menu-item">
							<!-- Mobile menu toggle-->
							<a class="navbar-toggle">
								<div class="lines">
									<span></span>
									<span></span>
									<span></span>
								</div>
							</a>
							<!-- End mobile menu toggle-->
						</div>
					</div>
					<!-- end menu-extras -->

				</div> <!-- end container -->
			</div>
			<!-- end topbar-main -->
			<?php if(\CI::Login()->isLoggedIn(false, false)):?>
				<div class="navbar-custom">
					<div class="container">
						<div id="navigation">
							<!-- Navigation Menu-->
							<ul class="navigation-menu">

								<li class="">
									<a href="<?=site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>Dashboard</a>
								</li>
								<?php if(CI::auth()->check_access('Admin')) : ?>
									<li class="has-submenu">
										<a href="#"><i class="fa fa-area-chart"></i><?=lang('common_sales'); ?></a>
										<ul class="submenu">

											<li>
												<a href="<?=site_url('admin/my-customers');?>">
													<?=lang('common_customers'); ?>
												</a>
											</li> 

											<li>
												<a href="<?=site_url('admin/reports');?>">
													<?=lang('common_reports'); ?>
												</a>
											</li>

										</ul>
									</li>
									<li class="has-submenu">
										<a href="#"><i class="fa fa-cart-plus"></i> Orders</a>
										<ul class="submenu">
											<li>
												<a href="<?=site_url('my-orders');?>">
													My Orders
												</a>
											</li> 
											<li>
												<a href="<?=site_url('admin/orders');?>">
													My Store Orders
												</a>
											</li> 

										</ul>
									</li>   
									<li class="">
										<a href="<?=site_url('admin/products');?>"><i class="fa fa-cubes"></i><?=lang('common_products'); ?></a>
									</li> 

									<li class="has-submenu">
										<a href="#"><i class="fa fa-user"></i>Account</a>

										<ul class="submenu">
											<li>
												<a href="<?=site_url('my-account');?>">
													Personal Details
												</a>
											</li> 
											<li>
												<a href="<?=site_url('shop-update');?>">
													Store Information
												</a>
											</li> 

										</ul>
										
									</li>  

								<?php endif; ?>   

								<li>
									<a href="<?=site_url('my-conversations') ?>"><i class="fa fa-comments"></i>Messages <span class="badge badge-danger">
										<?=\DB\DB::numRows('conversations', ['customer_id' => \CI::Login()->customer()->id]) ?>
									</span></a>
								</li> 

								<li class="has-submenu">
									<a href="#"><i class="fa fa-cogs"></i><?=lang('common_actions');?></a>
									<ul class="submenu">
										<?php $info = \DB\DB::getRow('customers_shop_information', ['customer_id'=>\CI::Login()->customer()->id]) ?>
										<li>
											<a href="<?=site_url('shop/'.$info->shop_slug);?>" target="_blank">
												My Store
											</a>
										</li> 
										<li>
											<a href="<?=site_url();?>" target="_blank">
												ShopMoni Home
											</a>
										</li> 

										<li>
											<a href="<?=site_url('logout');?>">
												<?=lang('common_log_out'); ?>
											</a>
										</li>

									</ul>
								</li>
							</ul>
							<!-- End navigation menu -->
						</div> <!-- end #navigation -->
					</div> <!-- end container -->
				</div> <!-- end navbar-custom -->
			<?php endif; ?>
		</header>
		<!-- End Navigation Bar-->
		<br>
		<?php
//lets have the flashdata override "$message" if it exists
		if(CI::session()->flashdata('message')){
			$message    = CI::session()->flashdata('message');
		}

		if(CI::session()->flashdata('error')){
			$error  = CI::session()->flashdata('error');
		}

		if(function_exists('validation_errors') && validation_errors() != ''){
			$error  = validation_errors();
		}

		?>

		<div class="wrapper" id="loading" style="background-image: url('<?=base_url('assets/images/bg-pattern.png') ?>') !important">
			<div class="container">

				<div id="js_error_container" class="alert alert-error" style="display:none;">
					<p id="js_error"></p>
				</div>

				<div id="js_note_container" class="alert alert-note" style="display:none;">

				</div>

				<?php if (!empty($message)): ?>
					<br/>
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?=$message; ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($error)): ?>
					<br/>
					<div class="alert alert-danger" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?=$error; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="container">
				<div class="row">
					<div class="card-box table-responsive">