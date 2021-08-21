<script>

    $('.quantityInput').bind('blur keyup', function(e){
        if(e.type == 'blur' || e.which == 13){
            updateItem($(this).attr('data-product-id'), $(this).val(), $(this).attr('data-orig-val'));
        }
    }).bind('focus', function(e){
        lastInput = $(this);
        lastValue = lastInput.val();
    });

    function plus(product_id){
        $('#orderSummary').spin();
        oldQuantity = parseInt($('#qtyInput'+product_id).val());
        newQuantity = oldQuantity+1
        updateItem(product_id, newQuantity,oldQuantity);
    }

    function minus(product_id){
        oldQuantity = parseInt($('#qtyInput'+product_id).val());
        if(oldQuantity == 1){
            updateItem(product_id, 0, oldQuantity);
        }else{
            $('#orderSummary').spin();
            newQuantity = oldQuantity-1;
            updateItem(product_id, newQuantity, oldQuantity);
        }
    }



    function updateItem(id, newQuantity, oldQuantity){
        if(newQuantity != oldQuantity){
            var active = $(document.activeElement).attr('id');

            if(newQuantity == 0){
                if(!confirm('<?=lang('remove_item');?>')){
                    return false;
                }else{
                    if(oldQuantity != undefined){
                        $('#qtyInput'+id).val(oldQuantity);
                    }
                }
            }

            $.post('<?=site_url('cart/update-cart');?>', {'product_id':id, 'quantity':newQuantity}, function(data){
                if(data.error != undefined){
                    message('error', data.error);
                    lastInput.val(lastValue).focus();
                }else{
                    var elem = $(document.activeElement).attr('id');
                    getCartSummary(function(){
                        $('#'+elem).focus();
                    });
                }

            }, 'json');
        }
    }

    function getCartSummary(callback){
        getShippingMethods();

        $('#orderSummary').spin();
        $.post('<?=site_url('cart/summary');?>', function(data) {
            $('#orderSummary').html(data);
            if(callback != undefined){
                callback();
            }
        });
    }

    function getShippingMethods(){
        $('#shippingMethod').load('<?=site_url('checkout/shipping-methods');?>');
    }

    function getPaymentMethods(){
        $('#paymentMethod').load('<?=site_url('checkout/payment-methods');?>');
    }


    $('#coupon').keyup(function(event){
        var code = event.keyCode || event.which;
        if(code == 13){
            submitCoupon();
        }
    });
    $('#giftCard').keyup(function(event){
        var code = event.keyCode || event.which;
        if(code == 13){
            submitGiftCard();
        }
    });

    function submitGiftCard(){
        $.post('<?=site_url('cart/submit-gift-card');?>', {'gift_card':$('#giftCard').val()}, function(data){
            if(data.error != undefined){
                message('error', data.error);
                $('#giftCard')[0].setSelectionRange(0, $('#giftCard').val().length);

            }else{
                getCartSummary(function(){
                    message('success', data.message);
                })
            }

        }, 'json');
    }

    function submitCoupon(){
        $('#cartSummary').spin();
        $.post('<?=site_url('cart/submit-coupon');?>', {'coupon':$('#coupon').val()}, function(data){
            if(data.error != undefined){
                message('error', data.error);
                $('#cartSummary').spin(false);
                $('#coupon')[0].setSelectionRange(0, $('#coupon').val().length);
            }else{
                getCartSummary(function(){
                    message('success', data.message);
                })
            }
        }, 'json');
    }

</script>