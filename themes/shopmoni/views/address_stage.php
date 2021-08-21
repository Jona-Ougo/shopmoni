<div class="container">
	<div class="st-default main-wrapper clearfix">
		<div class="block block-breadcrumbs clearfix">
			<ul>
				<li class="home">
					<a href="<?=site_url() ?>"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<li>Checkout Process</li>
			</ul>
		</div>
		<div class="main-page">
			<h1 class="page-title">Shopping Cart Summary</h1>
			<div class="page-content page-order">
				<ul class="step">
					<li id="summary"><span><a href="<?=site_url('checkout') ?>">01. Summary</a></span></li>
					<li id="sign-in"><span>02. Sign in</span></li>
					<li class="current-step" id="address"><span><a href="<?=site_url('checkout/address-stage') ?>">03. Address</a></span></li>
					<li id="shipping"><span>04. Shipping</span></li>
					<li id="payment"><span>05. Payment</span></li>
				</ul>
				
				<div class="heading-counter warning">Your shopping cart contains:
					<?php $count = GC::totalItems();?>
					<span><?=$count ?> <?=$count > 1 ? 'Products' : 'Product' ?></span>
					<span class="pull-right" id="your-addresses"></span>
				</div>
				<div class="checkoutAddress">
					<?php 
					if(!empty($addresses)){
						$this->show('checkout/address_list', ['addresses'=>$addresses]);
					}else{ 
						?>
						<script>
							$('.checkoutAddress').load("<?=site_url('addresses/form') ?>");
						</script>
						<?php } ?>
					</div>
					
				</div>
			</div>
		</div>	
	</div>


	<script> 
		$(function(){
			$('#country_id').change(function(){
				$('#zone_id').load('<?=site_url('addresses/get-zone-options');?>/'+$('#country_id').val());
			});

			$('#addressForm').on('submit', function(event){
				event.preventDefault();
				$.post($(this).attr('action'), $(this).serialize(), function(data){
					if(data == 1)
					{
						closeAddressForm();
					}
					else
					{
						$('#addressFormWrapper').html(data);
						//console.log(data);
					}
				});
			})
		});
	</script>