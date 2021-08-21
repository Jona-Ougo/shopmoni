<div class="container">
	<div class="st-default main-wrapper clearfix">
		<div class="block block-breadcrumbs clearfix">
			<ul>
				<li class="home">
					<a href="<?=site_url() ?>"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<li>Authentication</li>
			</ul>
		</div>
		<div class="main-page">
			<h1 class="page-title">Shopping Cart Summary</h1>
			<div class="page-content page-order">
				<ul class="step">
					<li id="summary"><span>01. Summary</span></li>
					<li class="current-step"  id="sign-in"><span>02. Sign in</span></li>
					<li id="address"><span>03. Address</span></li>
					<li id="shipping"><span>04. Shipping</span></li>
					<li id="payment"><span>05. Payment</span></li>
				</ul>
				
				<div class="heading-counter warning">Your shopping cart contains:
					<?php $count = GC::totalItems();?>
					<span><?=$count ?> <?=$count > 1 ? 'Products' : 'Product' ?></span>
					<span class="pull-right" id="your-addresses"></span>
				</div>
					
					<?php include(__DIR__.'/includes/auth.php') ?>
					
				</div>
			</div>
		</div>	
	</div>
