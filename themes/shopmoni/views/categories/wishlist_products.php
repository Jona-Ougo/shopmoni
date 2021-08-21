<?php $p = isset($cols) ? $cols : 4 ?>
<ul class="products row">
	<?php if(count($products) < 1): ?>
		<h2><?=lang('no_products') ?></h2>
	<?php endif; ?>
<?php \CI::load()->helper('text'); ?>
	<?php foreach($products as $product): ?>
		<?php $url = site_url('product/'.$product->slug) ?>
		<li class="product col-xs-<?=$p ?> col-sm-<?=$p ?> col-md-<?=$p ?>">
			<div class="product-container">
				<div class="inner">
					<div class="product-left">
						<div class="product-thumb">
							<a class="product-img" href="<?=$url ?>">
								<img src="<?=productPrimaryImage($product) ?>" alt="Product">
							</a>
							<a title="Quick View" href="<?=$url ?>" class="btn-quick-view">Quick View</a>
							</div>
						</div>
						<?=productSaleStatus($product) ?>
						<div class="product-right" style="padding-left:5px">
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
								
								<!-- <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a> -->
								<a class="btn-sm button-radius btn-add-cart" title="Add to Cart" href="<?=$url ?>">View<span class="icon"></span></a>
							</div>
						</div>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
