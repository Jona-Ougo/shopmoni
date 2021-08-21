
<div class="container product-page">
    <div class="st-default main-wrapper clearfix">
        <div class="block block-breadcrumbs clearfix">
            <ul>
                <li class="home">
                    <a href="<?=site_url() ?>"><i class="fa fa-home"></i></a>
                    <span></span>
                </li>
                <li><a href="<?=site_url('account') ?>">Account</a><span></span></li>
                <li>Welcome, <?=$customer['firstname'] ?></li>
            </ul>
        </div>
        <br/>
        <?php if(\CI::session()->userdata('message') != ''): ?>
            <div class="alert alert-info">
                <?=\CI::session()->userdata('message') ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-7">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <?php $c = count(\CI::Customers()->get_address_list(\CI::Login()->customer()->id)); ?>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="<?=$c > 0 ? 'active':'';?>">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                <i class="fa fa-cubes"></i> Order History
                            </a>
                        </li>
                        <?php $wishlistCount = \DB\DB::numRows('customer_wishlist', ['customer_id'=>\CI::Login()->customer()->id]) ?>
                        <?php if($wishlistCount > 0): ?>
                            <li role="presentation">
                                <a href="<?=site_url('/cart/wishlist') ?>">
                                    <i class="fa fa-heart"></i> Wish List
                                </a>
                            </li>
                        <?php else: ?>
                            <li role="presentation">
                                <a href="#wish" aria-controls="wish" role="tab" data-toggle="tab">
                                    <i class="fa fa-heart"></i> Wish List
                                </a>
                            </li>
                        <?php endif; ?>
                        <li role="presentation">
                            <a href="#account" aria-controls="account" role="tab" data-toggle="tab">
                                <i class="fa fa-info-circle"></i> Account Information</a>
                            </li>
                            <li role="presentation">
                                <a href="#address" aria-controls="tab" role="tab" data-toggle="tab">
                                    <i class="fa fa-address-card"></i> Address Manager
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane <?=$c == 0 ? 'active':'';?>" id="homes">
                                <div style="margin: 20px;">
                                    <div class="alert alert-info">
                                        Your account is missing an address, kindly add one <a href='#modal' data-toggle='modal'>here</a>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane <?=$c > 0 ? 'active':''?>" id="home">
                                <br>
                                <?php if($orders): echo $orders_pagination; ?>

                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <th><?=lang('order_date');?></th>
                                                <th><?=lang('order_number');?></th>
                                                <th>Order Total</th>
                                                <th><?=lang('order_status');?></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach($orders as $order): ?>
                                            <tr>
                                                <td>
                                                    <?php $d = format_date($order->ordered_on); 

                                                    $d = explode(' ', $d);
                                                    echo $d[0].' '.$d[1].', '.$d[3];

                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?=site_url('order-complete/'.$order->order_number); ?>" target="_blank">
                                                        <i class="fa fa-eye"></i> <?=$order->order_number; ?>
                                                    </a>
                                                </td>
                                                <td><?=format_currency($order->total) ?></td>
                                                <td><?=$order->status;?></td>
                                            </tr>

                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="alert yellow"><i class="close"></i><?=lang('no_order_history');?></div>
                            <?php endif;?>


                        </div>

                        <div role="tabpanel" class="tab-pane" id="wish">
                            <br>
                            <em>You have no products in your wish list</em>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="account">
                            <br>
                            <fieldset>
                                <?=form_open('my-account'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_firstname"><?=lang('account_firstname');?></label>
                                            <?=form_input(['name'=>'firstname', 'class="form-control"', 'value'=> assign_value('firstname', $customer['firstname'])]);?> 
                                        </div> 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_lastname"><?=lang('account_lastname');?></label>
                                            <?=form_input(['name'=>'lastname', 'class="form-control"', 'value'=> assign_value('lastname', $customer['lastname'])]);?>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_email"><?=lang('account_email');?></label>
                                            <?=form_input(['name'=>'email', 'class="form-control"', 'value'=> assign_value('email', $customer['email'])]);?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_phone"><?=lang('account_phone');?></label>
                                            <?=form_input(['name'=>'phone', 'class="form-control"', 'value'=> assign_value('phone', $customer['phone'])]);?> 
                                        </div>
                                    </div>

                                </div>

                        <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" name="email_subscribe" value="1" <?php if((bool)$customer['email_subscribe']) { ?> checked="checked" <?php } ?>/> <?=lang('account_newsletter_subscribe');?>
                                </div>
                            </div>
                        </div> -->


                        <div class="alert alert-info">
                            <a href="javascript:void(0);" class="btn btn-sm btn-info" onclick="showpass()" type="button">
                                Click here to Change Your Password
                            </a>
                        </div>

                        <div class="row" id="passwords-field" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_password">New Password</label>
                                    <?=form_password(['name'=>'password', 'class="form-control"']);?> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_confirm">Confirm New Password</label>
                                    <?=form_password(['name'=>'confirm', 'class="form-control"']);?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="button btn-primary"><?=lang('form_submit');?></button>
                        <?=form_close() ?>

                    </fieldset>
                </div>
                <div role="tabpanel" class="tab-pane" id="address">
                    <div id="addresses"></div>
                </div>
            </div>
        </div>    
    </div>

    <div class="col-md-5">
        <?php if(\CI::Login()->customer()->use_shop == 0): ?>
            <div class="well">
                <strong>Sell your products on shopmoni.com. It is FREE!<br/ >
                    <a class="btn btn-danger" href="<?=site_url('turn-on-shop') ?>"><i class="fa fa-spin fa-spinner"></i> Start selling now!</a>
                </div>
            <?php endif; ?>
            <hr>
            <?php $customer = \CI::Login()->customer(); ?>
            <?php if($customer->phone_confirmed == 0): ?>
                <div class="alert alert-success">
                    <strong id="notification"><i class="fa fa-spin fa-circle-o-notch"></i> Phone Number Verification Pending!</strong><br>
                    You have not verified your phone number. Click <em><a href="javascript:;">here</a></em> to do that now.
                </div>
            <?php endif; ?>

            <div class="well">
                <strong>Do you Know?</strong><br />
                You can earn residual income and build an online career, leveraging on efforts of our members around the world. <br>
                <a class="sv-btn-default" href="#">Tell me more!</a>
            </div>
        </div>
    </div>

</div>

</div>

<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add New Address</h4>
            </div>
            <div class="modal-body" id="address-form">

            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        loadAddresses();
        $.get("<?=site_url('addresses/address-form') ?>", function(data){
            $('#address-form').html(data);             
        })
    });

    function closeAddressForm()
    {
        $.gumboTray.close();
        loadAddresses();
    }

    function loadAddresses()
    {
        $('#addresses').spin();
        $('#addresses').load('<?=base_url('addresses');?>');
    }

    function showpass()
    {
        $('#passwords-field').toggle();
    }
</script>

