<div class="block block-products-owl">

	<div class="block-head">
		<div class="block-title">
			<div class="block-title-text text-lg"><?=lang('related_products_title')?></div>
		</div>
	</div>
	<div class="block-inner">
		<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
			<?php if(count($products) == 0): ?>
				<h2><?=lang('no_products') ?></h2>
			<?php endif; ?>
			<?php foreach($products as $product): ?>
				<?php $url = site_url('product/'.$product->slug) ?>
				<li class="product">
					<div class="product-container">
						<div class="product-left">
							<div class="product-thumb">
								<a class="product-img" href="<?=$url ?>">
									<img src="<?=productPrimaryImage($product, 'medium') ?>" alt="<?=$product->name ?>">
								</a>
								<a title="Quick View" href="<?=$url ?>" class="btn-quick-view">View</a>
							</div>
						</div>
						<?=productSaleStatus($product) ?>
						<div class="product-right">
							<div class="product-name">
								<a href="<?=$url ?>"><?=$product->name ?></a>
							</div>
							<div class="price-box">
								<span class="product-price"><?=productPrice($product) ?></span>
								<!-- <span class="product-price-old">$169.00</span> -->
							</div>
							<div class="product-star">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-half-o"></i>
							</div>
							<div class="product-button">
								<a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
								<a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
								<a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
							</div>
						</div>
					</div>

				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

