<style>
a{
    cursor:pointer;
}
</style>
<header id="header">
    <div class="top-bar" style="border-bottom: 1px solid #eaeaea;">
        <div class="container">
            <ul class="top-bar-link top-bar-link-left hidden-xs hidden-sm">
                <li id="notification"><a href="#"><i class="fa fa-sitemap"></i> Shopping Cash Club</a></li>
                <li class="only-desktop"><i class="fa fa-phone"></i> Call us: 090 456 7823</li>
                <?php if(!\CI::Login()->isLoggedIn(false, false)): ?>
                    <li class="only-desktop"><i class="fa fa-envelope"></i>mailprovider@mailer.com</li>
                <?php endif; ?>

            </ul>

            <ul class="top-bar-link top-bar-link-right">
                <li>
                    <a href="<?=site_url('/cart/wishlist') ?>">
                        <i class="fa fa-heart"></i> Wishlist
                    </a>
                </li>
                <li>
                    <div class="iner-block-cart">
                        <a href="<?=site_url('checkout') ?>">
                            <small class="total">
                                <span id="itemCount" style="color:#000">
                                    <?php $items = GC::totalItems() ?>
                                    (<?=$items <=1 ? $items.' Item' : $items.' Items' ?>)
                                </span>
                                <span id="cartTotal" style="color:#000">
                                    <?=format_currency(GC::getSubtotal()) ?>
                                </span>
                            </small>&nbsp;
                            - My Cart
                        </a>
                    </div>
                </li>
                

                <?php if(\CI::Login()->isLoggedIn(false, false)): ?>
                    <?php if(\CI::Login()->customer()->use_shop == 1): ?>
                        <li>
                            <a href="<?=site_url('admin/dashboard') ?>">
                                <i class="fa fa-user"></i> My Account
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?=site_url('account') ?>">
                                <i class="fa fa-user"></i> My Account
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?=site_url('logout') ?>">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                    </li>
                <?php else: ?>
                    <li style="color:#FD9033">
                        <a href="<?=site_url('login') ?>">
                            <i class="fa fa-sign-in"></i> Login / Register
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(\CI::Login()->isLoggedIn(false, false)): ?>
                    <!-- <li>
                        <a id="add-adverts" href="#">
                            <i class="fa fa-buysellads"></i> Adverts
                        </a>
                    </li> -->
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <style type="text/css">
    .ll img
    {
        width:40%; 
        height:40%;
        margin-top: 8px;
        margin-left: -110px;
    }

    @media screen and (max-width: 1020px)
    {
        .ll img
        {
            margin-left: -85px;
            margin-top: 4px;
        }
    }

    @media screen and (max-width: 600px)
    {
        .ll img
        {
            margin-left: 0px;
            display: block;
            margin-right: auto;
            margin-left: auto;
        }
    }
</style>
<div class="container">

    <div class="main-header main-header3">

        <div class="row">
            <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 sl">
                <a href="<?=site_url() ?>">
                    <img src="<?=theme_url('data/option3/logo-plain.png') ?>" alt="Logo" class="img-responsive center-block" style="width:30%; height:30%">
                </a>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9 col-xs-12 ll">
                <img src="<?=theme_url('data/option3/click_here_new.png') ?>" class="img-responsive" style="">
            </div>
        </div>

    </div>

</div>

<div class="container">
    <div class="row">

        <div class="col-sm-10 col-md-10 col-lg-10">

            <div class="advanced-search box-radius" style="margin-top:18px;">
                <form class="form-inline" action="<?=site_url('search') ?>" method="post">
                    <div class="form-group search-category">
                        <select id="category-select" class="search-category-select" name="category_id">
                            <option value=" ">All Marketplaces</option>
                            <?php foreach(\DB\DB::get('categories', ['is_marketplace'=>1]) as $row): ?>
                                <option value="<?=$row->id ?>"><?=$row->name ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="form-group search-input">
                        <input type="text" placeholder="What are you looking for?" name="term" >
                    </div>
                    <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2 ">
            <a href="#" style="background:#fd7400; min-height: 42px; padding-top:3px; margin-top:18px;" class="button"><i class="fa fa-arrow-right"></i> Advanced Search</a>
        </div>
    </div>
</div>

<div style="margin-top:30px;"></div>
<div class="container">

    <div class="main-menu">
        <div class="container">
            <div class="row">
                <nav class="navbar" id="main-menu">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="#">MENU</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <?php
                                $customer = \CI::Login()->customer();
                                $where = ['enabled_'.$customer->group_id => 1, 'is_marketplace'=>1];
                                $cat = \DB\DB::getArray('categories', $where, 'sequence', 'ASC');
                                foreach($cat as $row):

                                    ?>
                                    <li class="dropdown" style="margin-left: 35px;">
                                        <a href="<?=site_url('category/'.$row['slug']) ?>" class="dropdown-toggle awtt" data-toggle="dropdown" title='<?=$row['name']?>'>
                                            <?php $icons = ['icon_hot.png', 'icon_new.png', 'icon_sale.png'] ?>
                                            <?php $i = rand(0,2) ?>
                                            <img src="<?=theme_url('data/'.$icons[$i]) ?>">
                                            <?=str_replace("Marketplace","...",$row['name']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="<?=site_url('checkout') ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </div>


</header>