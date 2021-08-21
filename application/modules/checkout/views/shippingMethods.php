<div class="page-header">
    <h3><?=lang('shipping');?></h3>
</div>
<?php if($requiresShipping):?>
    <table class="table">
    <?php
    $selectedShippingMethod = \GC::getShippingMethod();
    foreach ($rates as $key => $rate):
        $hash = md5(json_encode(['key'=>$key, 'rate'=>$rate]));?>

        <tr onclick="$(this).find('input').prop('checked', true).trigger('change');">
            <td style="width:20px;"><input type="radio" name="shippingMethod" value="<?=$hash;?>" <?=(is_object($selectedShippingMethod) && $hash == $selectedShippingMethod->description)?'checked':'';?>></td>
            <td><?=$key;?></td>
            <td><?=format_currency($rate);?>
        </tr>

    <?php endforeach;?>
    </table>

    <script>
        $('[name="shippingMethod"]').change(function(){
            $('.shippingError').html('');

            $.post('<?=site_url('checkout/set-shipping-method');?>', {'method':$(this).val()}, function(data){
                if(data.error)
                {
                    message('error', data.error);
                }
                else
                {
                    //successful, refresh the summary
                    //getCartSummary();
                }
            });
        }).click(function(e) {
            //stop the event from bubbling up to the row and doubling
            e.stopPropagation();
        });
        
        function showShippingError(error)
        {
            message.error('error', error);
        }
    </script>
<?php else: ?>
    <div class="alert alert-info">
        <?=lang('no_shipping_needed');?>
    </div>
<?php endif;?>