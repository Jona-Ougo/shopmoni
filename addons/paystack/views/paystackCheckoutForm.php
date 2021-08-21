<div class="page-header">
    <?php echo lang('paystack');?>
</div>


<button class="button pull-right" id="submit_paystack_payment_form" onclick="PaystackSubmitOrder(); return false;">
    Pay via Paystack
    <i class="fa fa-angle-right"></i>
</button>
	
	<script>
		function PaystackSubmitOrder()
		{
			$('#submit_paystack_payment_form').attr('disabled', true).addClass('disabled');
		
			$.post('<?php echo base_url('/paystack/process-payment');?>', function(data){
				if(data.errors != undefined)
				{
					var error = '<div class="alert red">';
                    $.each(data.errors, function(index, value)
                    {
                        error += '<p>'+value+'</p>';
                    });

                    message('error', error);
					$('#submit_paystack_payment_form').attr('disabled', false).addClass('disabled');
				}
				else
				{
					if(data.uniqueRef != undefined) {
                        window.location = data.gateway_url;
					}
				}
			}, 'json');
		
		}
	</script>
