<div class="page-header">
    <h3><?=lang('payment_methods');?></h3>
</div>

<?php if(count($modules) == 0):?>
    <div class="alert alert-danger">
        <?=lang('error_no_payment_method');?>
    </div>
<?php elseif(GC::getGrandTotal() == 0):?>
    <div class="alert alert-info">
        <?=lang('no_payment_needed');?>
    </div>
    <div class="cart_navigation">
       <button class="button pull-right" onclick="SubmitNoPaymentOrder()">
        <?=lang('submit_order');?>
        <i class="fa fa-angle-right"></i>  
    </button> 
</div>


<script>

    function SubmitNoPaymentOrder()
    {

        $.post('<?=base_url('/checkout/submit-order');?>', function(data){
            if(data.errors != undefined){
                var error = '';
                $.each(data.errors, function(index, value){
                    error += '<p>'+value+'</p>';
                });

                message('error', error);
            }else{
                if(data.orderId != undefined){
                    window.location = '<?=site_url('order-complete/');?>/'+data.orderId;
                }
            }
        }, 'json');

    }
</script>

<?php else: ?>
    
    <div class="row" id="paymentModules">
        <table class="table table-stripped">
            <?php foreach ($modules as $key => $module):?>
                <?php if($module['class']->isEnabled()):?>
                    <tr onclick="$(this).find('input').prop('checked', true).trigger('change');">
                        <td style="width:20px;">
                            <input type="radio" name="paymentMethod" value="payment-<?=$key;?>">
                        </td>
                        <td><?=$module['class']->getName();?></td>
                    </tr>
                <?php endif;?>
            <?php endforeach;?>
        </table>

        <?php foreach ($modules as $key => $module):?>
            <?php if($module['class']->isEnabled()):?>
                <div id="payment-<?=$key;?>" class="paymentMethod" class="well">
                    <?=$module['class']->checkoutForm();?>
                </div>
            <?php endif;?>
        <?php endforeach;?>

        <script>
            $('.paymentMethod').hide();
            $('[name="paymentMethod"]').change(function(){
                $('#paymentModules').spin();
                var paymentMethod = $(this);
                $('#'+paymentMethod.val()).fadeIn(100);
                $('#paymentModules').spin(false);
            });
        </script>
    <?php endif;?>
