<div class="page-header">
    <?=lang('charge_on_delivery');?>
</div>

<div class="cart_navigation">

</div>
<button class="button pull-right" id="btn_cod" onclick="CodSubmitOrder()">
    <?=lang('submit_order');?>
    <i class="fa fa-angle-right"></i> 
</button>

<script>
    function CodSubmitOrder()
    {
        $('#btn_cod').attr('disabled', true).addClass('disabled');

        $.post('<?=base_url('/cod/process-payment');?>', function(data){
            console.log(data);
            if(data.errors != undefined){
                var error = '';
                $.each(data.errors, function(index, value)
                {
                    error += '<p>'+value+'</p>';
                });

                message('error', error);
            }else if(data.orderId != undefined){
                console.log(data);
                window.location = '<?=site_url('order-complete/');?>/'+data.orderId;
            }else{
                console.log(data)
                message('error', 'An unexpected error has occured');
            }
        }, 'json');

        $('#btn_cod').attr('disabled', false).removeClass('disabled');

    }
</script>
