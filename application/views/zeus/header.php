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

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<link href="<?=base_url('assets/css/font-awesome.css');?>" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?=base_url('assets/css/redactor.css');?>" rel="stylesheet" />
<link type="text/css" href="<?=base_url('assets/css/pickadate/default.css');?>" rel="stylesheet" />
<link type="text/css" href="<?=base_url('assets/css/pickadate/default.date.css');?>" rel="stylesheet" />
<script src="<?=base_url() ?>assets/js/modernizr.min.js"></script>
<script src="<?=base_url() ?>assets/js/jquery.min.js"></script>
<style>
    div .checkbox{
        all: none !important;
    }
</style>

</head>
<body style="">
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container">

                <!-- Logo container-->
                <div class="logo">
                    <a href="<?=site_url('zeus/dashboard') ?>" class="logo">
                        <img src="<?=base_url() ?>assets/images/logo.png" alt="" height="30">
                    </a>

                </div>
                <!-- End Logo container-->


                <div class="menu-extras">

                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="navbar-c-items">
                            <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href="#"><i class="fa fa-search"></i></a>
                            </form>
                        </li>


                        <li class="dropdown navbar-c-items">
                            <a href="#" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="<?=base_url() ?>assets/images/users/male.png" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                <li class="text-center">
                                    <h5>Hi, John</h5>
                                </li>
                                <li><a href="<?=site_url('zeus/logout') ?>"><i class="ti-power-off m-r-5"></i> Logout</a></li>
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
        <?php if(\CI::auth()->isZeusLoggedIn(false, false)):?>
            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="">
                                <a href="<?=site_url('zeus/dashboard') ?>">
                                    <i class="fa fa-dashboard"></i>Dashboard
                                </a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-area-chart"></i><?=lang('common_sales'); ?></a>
                                <ul class="submenu">
                                    <?php if(_p('viewcustomers')): ?>
                                        <li>
                                            <a href="<?=site_url('zeus/customers') ?>">
                                                Merchants
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?=site_url('zeus/customers/groups');?>">
                                                <?=lang('common_groups'); ?>
                                            </a>
                                        </li> 
                                    <?php endif; ?>

                                    <?php if(_p('viewreports')): ?>
                                        <li>
                                            <a href="<?=site_url('zeus/reports');?>">
                                                <?=lang('common_reports'); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if(_p('viewcoupons')): ?>
                                        <li>
                                            <a href="<?=site_url('admin/coupons');?>">
                                                <?=lang('common_coupons'); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if(_p('viewgiftcards')): ?>
                                        <!-- <li>
                                            <a href="<?=site_url('admin/gift-cards');?>">
                                                <?=lang('common_gift_cards'); ?>
                                            </a>
                                        </li> -->
                                    <?php endif; ?>
                                </ul>
                            </li>

                            <?php if(_p('vieworders')): ?>
                                <li>
                                    <a href="<?=site_url('zeus/orders') ?>"><i class="fa fa-cart-plus"></i> Orders</a>
                                </li>  
                            <?php endif; ?> 

                            <?php if(_p('viewproducts')): ?>
                                <li class="has-submenu">
                                    <a href="#"><i class="fa fa-cubes"></i><?=lang('common_products'); ?></a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="<?=site_url('admin/category_filters');?>">
                                                Marketplace Filters
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?=site_url('admin/categories');?>">
                                                <?=lang('common_categories'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?=site_url('zeus/products');?>">
                                                <?=lang('common_products'); ?>
                                            </a>
                                        </li> 
                                        <!-- <li>
                                            <a href="<?=site_url('admin/digital_products');?>">
                                                <?=lang('common_digital_products'); ?>
                                            </a>
                                        </li>  -->

                                    </ul>
                                </li> 
                            <?php endif; ?>
                                
                             <?php if(_p('viewbanners') || _p('viewpages')): ?>
                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-newspaper-o"></i><?=lang('common_content'); ?></a>
                                <ul class="submenu">
                                    <?php if(_p('viewbanners')): ?>
                                        <li>
                                            <a href="<?=site_url('zeus/banners');?>">
                                                <?=lang('common_banners'); ?>
                                            </a>
                                        </li> 
                                    <?php endif ?>
                                    <?php if(_p('viewadvertcredits')): ?>
                                        <li>
                                            <a href="<?=site_url('zeus/advert_credits');?>">
                                                <?=lang('common_advert_credits'); ?>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php if(_p('viewbanners')): ?>
                                        <li>
                                            <a href="<?=site_url('zeus/adverts/orders');?>">
                                                <?=lang('banner_orders'); ?>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php if(_p('viewpages')): ?>
                                        <li>
                                            <a href="<?=site_url('admin/pages');?>">
                                                <?=lang('common_pages'); ?>
                                            </a>
                                        </li> 
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                            <?php if(_p('managesettings')): ?>
                                <li class="has-submenu">
                                    <a href="#"><i class="fa fa-user-secret"></i><?=lang('common_administrative'); ?></a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="<?=site_url('admin/settings');?>">
                                                System Configuration
                                            </a>
                                        </li>
                                        <?php if(_p('manageshippingmodules')): ?> 
                                            <li>
                                                <a href="<?=site_url('admin/shipping');?>">
                                                    <?=lang('common_shipping_modules'); ?>
                                                </a>
                                            </li> 
                                        <?php endif; ?>
                                        <?php if(_p('managepaymentmodules')): ?>
                                            <li>
                                                <a href="<?=site_url('admin/payments');?>">
                                                    <?=lang('common_payment_modules'); ?> 
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(_p('managecannedmessages')): ?>
                                            <li>
                                                <a href="<?=site_url('admin/settings/canned_messages');?>">
                                                    <?=lang('common_canned_messages'); ?> 
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <a href="<?=site_url('admin/locations');?>">
                                                <?=lang('common_locations'); ?>
                                            </a>
                                        </li>
                                        <?php if(_p('manageadministrators')): ?>
                                            <li>
                                                <a href="<?=site_url('admin/users');?>">
                                                    <?=lang('common_administrators'); ?> 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=site_url('admin/users/groups');?>">
                                                    Administrator Groups
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=site_url('zeus/customers-login-audit');?>">
                                                    Customer Login Audit
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=site_url('zeus/admin-login-audit');?>">
                                                    Admin Login Audit
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <a href="<?=site_url('admin/sitemap');?>">
                                                <?='Sitemap'; ?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-cogs"></i><?=lang('common_actions');?></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="<?=site_url();?>" target="_blank">
                                            ShopMoni Home
                                        </a>
                                    </li> 

                                    <li>
                                        <a href="<?=site_url('zeus/logout');?>">
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
//lets have the flashdata overright "$message" if it exists
    if(CI::session()->flashdata('message'))
    {
        $message    = CI::session()->flashdata('message');
    }

    if(CI::session()->flashdata('error'))
    {
        $error  = CI::session()->flashdata('error');
    }

    if(function_exists('validation_errors') && validation_errors() != '')
    {
        $error  = validation_errors();
    }
    ?>

    <div class="wrapper" style="background-image: url('<?=base_url('assets/images/bg-pattern.png') ?>') !important">
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