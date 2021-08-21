<?=pageHeader(lang('dashboard'));?>

<?php if(_p('managepaymentmodules')): ?>
    <?php if(!$payment_module_installed):?>

        <div class="alert alert-warning">
            <a class="close" data-dismiss="alert">×</a>
            <strong><?=lang('common_note') ?>:</strong> <?=lang('no_payment_module_installed'); ?>
        </div>

    <?php endif;?>
<?php endif; ?>

<?php if(_p('manageshippingmodules')): ?>
    <?php if(!$shipping_module_installed):?>
        <div class="alert alert-warning">
            <a class="close" data-dismiss="alert">×</a>
            <strong><?=lang('common_note') ?>:</strong> <?=lang('no_shipping_module_installed'); ?>
        </div>

    <?php endif;?>
<?php endif; ?>

<?php if(\CI::session()->flashdata('admin_welcome') != ''): ?>

        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <?=\CI::session()->flashdata('admin_welcome') ?>
        </div>

<?php endif;?>

<?php if(_p('vieworders')): ?>
    <div class="row">


        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-primary">
                <i class="fa  fa-money widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                        Completed Orders
                    </p>
                    <h2><span data-plugin="counterup">34,578</span></h2>
                    <p class="text-muted m-0"><b>In Value (&#8358;)</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-warning">
                <i class="fa  fa-credit-card widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">
                        Uncompleted Orders
                    </p>
                    <h2><span data-plugin="counterup">52,410 </span> </h2>
                    <p class="text-muted m-0"><b>In Value (&#8358;)</b></p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-danger">
                <i class="fa  fa-hourglass-3 widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                        Total Completed Orders
                    </p>
                    <h2><span data-plugin="counterup">62</span> </h2>
                    <p class="text-muted m-0"><b>Count</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-success">
                <i class="fa  fa-hourglass-1 widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">
                        Total Uncompleted Orders
                    </p>
                    <h2><span data-plugin="counterup">89</span> </h2>
                    <p class="text-muted m-0"><b>Count</p>
                </div>
            </div>
        </div>


    </div>

    <div class="row">



        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-primary">
                <i class="fa fa-institution widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">
                        Active Shops
                    </p>
                    <h2><span data-plugin="counterup"><?=number_format($activeshops) ?></span></h2>
                    <p class="text-muted m-0"><b>Count</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-warning">
                <i class="fa fa-users widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">
                        Customers
                    </p>
                    <h2><span data-plugin="counterup"><?=number_format($customerscount) ?></span> </h2>
                    <p class="text-muted m-0"><b>Count</b></p>
                </div>
            </div>
        </div><!-- end col -->


        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-success">
                <i class="fa fa-gift widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">
                        Coupons
                    </p>
                    <h2><span data-plugin="counterup"><?=number_format($couponscount) ?></span> </h2>
                    <p class="text-muted m-0"><b>Count</p>
                </div>
            </div>
        </div><!-- end col -->

    </div>

    <h2><?=lang('recent_orders') ?></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?=lang('order'); ?></th>
                <th><?=lang('bill_to');?></th>
                <th><?=lang('ship_to');?></th>
                <th><?=lang('status'); ?></th>
                <th><?=lang('total'); ?></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?=(count($orders) < 1)?'<tr><td style="text-align:center;" colspan="8">'.lang('no_orders') .'</td></tr>':''?>
            <?php foreach($orders as $order): ?>
                <tr>
                    <td style="white-space:nowrap">
                        <strong><a href="<?=site_url('zeus/orders/order/'.$order->order_number);?>"><?=$order->order_number; ?></a></strong>
                        <div style="font-size:11px;">@ <?=date('m/d/y h:i a', strtotime($order->ordered_on)); ?></div>
                    </td>
                    <td style="white-space:nowrap">
                        <?=format_address([
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
                            <?=format_address([
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
                                <?=$order->status; ?>
                            </td>
                            <td><div><?=format_currency($order->total); ?></div></td>
                            <td>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-12" style="text-align:center;">
                    <a class="btn btn-primary btn-lg" href="<?=site_url('zeus/orders');?>"><?=lang('view_all_orders');?></a>
                </div>
            </div>

        <?php endif; ?>

        <?php if(_p('viewcustomers')): ?>
            <h2>Recent Merchants</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <?php /*<th>ID</th> uncomment this if you want it*/ ?>
                        <th class="gc_cell_left"><?=lang('firstname') ?></th>
                        <th><?=lang('lastname') ?></th>
                        <th><?=lang('email') ?></th>
                        <th class="gc_cell_right"><?=lang('active') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer):?>
                        <tr>
                            <?php /*<td style="width:16px;"><?= $customer->id; ?></td>*/?>
                            <td class="gc_cell_left"><?= $customer->firstname; ?></td>
                            <td><?= $customer->lastname; ?></td>
                            <td><a href="mailto:<?= $customer->email;?>"><?= $customer->email; ?></a></td>
                            <td>
                                <?php if($customer->active == 1)
                                {
                                    echo lang('yes');
                                }
                                else
                                {
                                    echo lang('no');
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <div class="row">
                <div class="col-md-12" style="text-align:center;">
                    <a class="btn btn-primary btn-lg" href="<?=site_url('zeus/customers');?>"><?=lang('view_all_customers');?></a>
                </div>
            </div>
        <?php endif; ?>
