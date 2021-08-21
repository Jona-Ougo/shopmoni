<div id="top">
<h3><?=lang('your_addresses') ?></h3>
<button type="button" class=" pull-right btn btn-success btn-sm" id="addAddress">
    <?=lang('add_address') ?>
</button>
<br/><br/>
</div>
<?php if(count($addresses) > 0):?>
    <div class="container">
        <div class="row" id="addressList">
            <?php foreach($addresses as $a):?>
                <div class="col-md-3">
                    <div class="well">
                        <?=format_address($a, true) ?><br/>

                        <?php
                        $checked = (GC::getCart()->billing_address_id == $a['id'])?true:false;
                        echo form_radio(['name'=>'billing_address', 'value'=>$a['id'], 'checked'=>$checked]);
                        ?>

                        <?php echo lang('billing');?>
                        <?php
                        $checked = (GC::getCart()->shipping_address_id == $a['id'])?true:false;
                        echo form_radio(['name'=>'shipping_address', 'value'=>$a['id'], 'checked'=>$checked]);
                        ?>
                        <?php echo lang('shipping');?>
                        <label class="pull-right">
                            <i class="fa fa-pencil" onclick="editAddress(<?=$a['id'];?>)"></i>
                            <i class="fa fa-times text-red" onclick="deleteAddress(<?=$a['id'];?>)"></i>
                        </label>
                        
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-md-6" id="shippingMethod"></div>
            <div class="col-md-6" id="paymentMethod"></div>
        </div>
        <div class="cart_navigation" id="footerLinks">
            <a class="button" href="<?=site_url('checkout') ?>"><i class="fa fa-angle-left"></i> Back To Cart </a>
            <button class="button pull-right" type="button" id="continue-to-payment">
                Contiue to Payment
                <i class="fa fa-angle-right"></i>
            </button>
        </div>
    </div>
<?php else:?>
    <script>
        window.location = "<?=site_url('checkout/address-stage') ?>"
    </script>
<?php endif;?>

<script>

    function closeAddressForm(){
        $('.checkoutAddress').load('<?=site_url('checkout/address-list');?>');
    }

    function editAddress(id)
    {
        $('.checkoutAddress').load('<?=site_url('addresses/form');?>/'+id);
    }

    function deleteAddress(id)
    {
        if( confirm('<?=lang('delete_address_confirmation');?>') )
        {
            $.post('<?=site_url('addresses/delete');?>/'+id, function(){
                closeAddressForm();
            });
        }
    }

    $('#addAddress').click(function(){
        link = "<a href='javascript:void();' onclick='location.reload()'>View your addresses</a>";
        $('#your-addresses').html(link);
        $('.checkoutAddress').load('<?=site_url('addresses/form');?>');
    })

    $('[name="billing_address"]').change(function(){
        $.post('<?=site_url('checkout/address');?>', {'type':'billing', 'id':$(this).val()}, function(data){
            if(data.error != undefined)
            {
                message('error', data.error);
                closeAddressForm();
            }
            else
            {
                //
            }
    });
    });

    $('[name="shipping_address"]').change(function(){
        $.post('<?=site_url('checkout/address');?>', {'type':'shipping', 'id':$(this).val()}, function(data){
            if(data.error != undefined)
            {
                message('error', data.error);
                closeAddressForm();
            }
            else
            {
            //getCartSummary();
            }
    });
    });

    var billingAddresses = $('[name="billing_address"]');
    var shippingAddresses = $('[name="shipping_address"]');

    if(billingAddresses.length == 1)
    {
        billingAddresses.attr('checked', true).change();
    }

    if(shippingAddresses.length == 1)
    {
        shippingAddresses.attr('checked', true).change();
    }

    $('#continue-to-payment').click(function(){
        $('#addressList').html('');
        $('#top').html('');
        $('#footerLinks').html('');
        $('#address').removeClass('current-step');
        $('#payment').addClass('current-step');
        $('#shippingMethod').load('<?php echo site_url('checkout/shipping-methods');?>');
        $('#paymentMethod').load('<?php echo site_url('checkout/payment-methods');?>');
    })
</script>
