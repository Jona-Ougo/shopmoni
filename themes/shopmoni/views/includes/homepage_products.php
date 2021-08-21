<?php \CI::load()->helper('text'); ?>
<?php foreach($products as $product): ?>
	<?php $url = site_url('product/'.$product->slug) ?>
	<li class="product">

		<div class="product-container">
			<div class="product-left">
				<div class="product-thumb">
					<a class="product-img" href="<?=$url ?>">
						<img src="<?=productPrimaryImage($product) ?>" alt="Product">
					</a>
					<a title="Quick View" href="<?=$url ?>" class="btn-quick-view">Quick View</a>
				</div>
			</div>
			<?=productSaleStatus($product) ?>
			<div class="product-right">
				<div class="product-name">
					<a href="<?=$url ?>" style="font-size:13px;">
						<?=character_limiter($product->name, 30) ?>
					</a>
				</div>
				<?php if(!$product->is_giftcard): ?>
					<div class="price-box">
						<span class="product-price"><?=productPrice($product) ?></span>
						<!-- <span class="product-price-old">$169.00</span> -->
					</div>
				<?php endif; ?>
				<div class="product-star">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
				</div>
				<div class="product-button">
					<a class="btn-add-wishlist" title="Add to Wishlist" href="javascript:void(0)" onclick="addToWishList(<?=$product->id ?>)">Add Wishlist</a>
					<!-- <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a> -->
					<a class="button-radius btn-add-cart" title="Add to Cart" href="<?=$url ?>">View<span class="icon"></span></a>
				</div>
			</div>
		</div>

	</li>
<?php endforeach; ?>

<script>
	
</script>