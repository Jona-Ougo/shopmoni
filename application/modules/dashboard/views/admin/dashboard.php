<?php echo pageHeader($customer->shop_name." - Dashboard");?>

<?php if(!$payment_module_installed):?>

    <div class="alert alert-warning">
        <a class="close" data-dismiss="alert">×</a>
        <strong><?php echo lang('common_note') ?>:</strong> <?php echo lang('no_payment_module_installed'); ?>
    </div>

<?php endif;?>

<?php if(!$shipping_module_installed):?>
    <div class="alert alert-warning">
        <a class="close" data-dismiss="alert">×</a>
        <strong><?php echo lang('common_note') ?>:</strong> <?php echo lang('no_shipping_module_installed'); ?>
    </div>

<?php endif;?>


<?php if(\CI::Login()->customer()->scc_member == 0):?>

    <p id="typed-strings">
        <strong>
            Do You know about our cashMoneyClub?
            Join hundreds of other buyers and sells all over the world to take advantage of our promotions and offers avaliable to only our members! for more details.
        </strong>
    </p>
    <span id="typed"></span>

<?php endif;?>



<?php if(\CI::session()->userdata('reloaded_dashboard') == ''):?>
    <div class="alert alert-info">
        <strong><i class="fa fa-certificate"></i></strong> <?=$welcome_message; ?>
        <?php \CI::session()->set_userdata('reloaded_dashboard', 1) ?>
    </div>
<?php endif;?>

<div class="row">

<!--  <div class="row">
    <div class="col-sm-4 col-md-4"></div>
    <div class="col-sm-4 col-md-4">
        <video style="width:100%" controls>
          <source src="<?=base_url('assets/dashboard.mov') ?>" type="video/mp4">
              <source src="<?=base_url('assets/mdashboard.mov') ?>" type="video/mov">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="col-sm-4 col-md-4"></div>
    </div> -->
    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-box-two widget-two-primary">
            <i class="fa fa-cart-plus widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                    Shop Orders
                </p>
                <h2><span data-plugin="counterup"><?=number_format($shopOrdersCount) ?></span></h2>
                <p class="text-muted m-0"><b>All Orders</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-success">
                <i class="fa fa-shopping-cart widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">
                        My Orders
                    </p>
                    <h2><span data-plugin="counterup"><?=number_format($myOrdersCount) ?></span> </h2>
                    <p class="text-muted m-0"><b>Orders you placed</p>
                    </div>
                </div>
            </div><!-- end col -->


            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-box-two widget-two-warning">
                    <i class="fa fa-cubes widget-two-icon"></i>
                    <div class="wigdet-two-content">
                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">
                            Products
                        </p>
                        <h2><span data-plugin="counterup"><?=number_format($productsCount) ?></span> </h2>
                        <p class="text-muted m-0"><b>Your uploaded products</b></p>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-box-two widget-two-danger">
                    <i class="mdi mdi-account-plus widget-two-icon"></i>
                    <div class="wigdet-two-content">
                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                            Customers
                        </p>
                        <h2><span data-plugin="counterup"><?=number_format($customersCount) ?></span> </h2>
                        <p class="text-muted m-0"><b>Your Customers</p>
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <h2><?php echo lang('recent_orders') ?></h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo lang('order'); ?></th>
                        <th><?php echo lang('bill_to');?></th>
                        <th><?php echo lang('ship_to');?></th>
                        <th><?php echo lang('status'); ?></th>
                        <th><?php echo lang('total'); ?></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php echo (count($orders) < 1)?'<tr><td style="text-align:center;" colspan="8">'.lang('no_orders') .'</td></tr>':''?>
                    <?php foreach($orders as $order): ?>
                        <tr>
                            <td style="white-space:nowrap">
                                <strong><a href="<?php echo site_url('admin/orders/order/'.$order->order_number);?>"><?php echo $order->order_number; ?></a></strong>
                                <div style="font-size:11px;">@ <?php echo date('m/d/y h:i a', strtotime($order->ordered_on)); ?></div>
                            </td>
                            <td style="white-space:nowrap">
                                <?php echo format_address([
                                    'company'=>$order->billing_company,
                                    'firstname'=>$order->billing_firstname,
                                    'lastname'=>$order->billing_lastname,
                                    'phone'=>$order->billing_phone,
                                    'email'=>$order->billing_email,
                                    'address1'=>$order->billing_address1,
                                    'address2'=>$order->billing_address2,
                                    'city'=>$order->billing_city,
                                    'zone'=>$order->billing_zone,
                                    'zip'=>$order->billing_zip,
                                    'country_id'=>$order->billing_country_id
                                    ]);?>
                                </td>
                                <td style="white-space:nowrap">
                                    <?php echo format_address([
                                        'company'=>$order->shipping_company,
                                        'firstname'=>$order->shipping_firstname,
                                        'lastname'=>$order->shipping_lastname,
                                        'phone'=>$order->shipping_phone,
                                        'email'=>$order->shipping_email,
                                        'address1'=>$order->shipping_address1,
                                        'address2'=>$order->shipping_address2,
                                        'city'=>$order->shipping_city,
                                        'zone'=>$order->shipping_zone,
                                        'zip'=>$order->shipping_zip,
                                        'country_id'=>$order->shipping_country_id
                                        ]);?>
                                    </td>
                                    <td>
                                        <?php echo $order->status; ?>
                                    </td>
                                    <td><div><?php echo format_currency($order->customer_total); ?></div></td>
                                    <td>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-12" style="text-align:center;">
                            <a class="btn btn-primary btn-lg" href="<?php echo site_url('admin/orders');?>"><?php echo lang('view_all_orders');?></a>
                        </div>
                    </div>

                    <script type="text/javascript">
                        var typed = new Typed("#typed", {
                            stringsElement: '#typed-strings',
                            typeSpeed: 10,
                            backSpeed: 10,
                            backDelay: 2000,
                            startDelay: 1000,
                            loop: true,
                        });
                    </script>
