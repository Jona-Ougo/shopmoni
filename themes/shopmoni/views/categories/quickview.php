<?php page_partial('_head') ?>
<div class="container product-page">

	<div class="st-default main-wrapper clearfix">
		<div class="quick-view-product">
			<div class="row">
				<div class="col-sm-7">
					<div class="block block-product-image">
						<div class="product-image easyzoom easyzoom--overlay easyzoom--with-thumbnails">
							<a href="<?=theme_url('data/zoom/full.jpg') ?>">
								<img src="<?=theme_url('data/zoom/standard.jpg') ?>" alt="Product" width="450" height="450" />
							</a>
						</div>
						<div class="text">Hover on the image to zoom</div>
						<div class="product-list-thumb">
							<ul class="thumbnails kt-owl-carousel" data-margin="10" data-nav="true" data-responsive='{"0":{"items":2},"600":{"items":3},"1000":{"items":4}}'>
								<li>
									<a class="selected" href="data/zoom/full.jpg" data-standard="data/zoom/standard.jpg">
										<img src="<?=theme_url('data/zoom/thumb.jpg') ?>" alt="" />
									</a>
								</li>
								<li>
									<a href="<?=theme_url('data/zoom/full2.jpg') ?>" data-standard="<?=theme_url('data/zoom/standard2.jpg') ?>">
										<img src="<?=theme_url('data/zoom/thumb2.jpg') ?>" alt="" />
									</a>
								</li>
								<li>
									<a href="<?=theme_url('data/zoom/full3.jpg') ?>" data-standard="<?=theme_url('data/zoom/standard3.jpg') ?>">
										<img src="<?=theme_url('data/zoom/thumb3.jpg') ?>" alt="" />
									</a>
								</li>
								<li>
									<a href="<?=theme_url('data/zoom/full4.jpg') ?>" data-standard="<?=theme_url('data/zoom/standard4.jpg') ?>">
										<img src="<?=theme_url('data/zoom/thumb4.jpg') ?>" alt="" />
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="block-product-info">
						<h2 class="product-name">Cotton Lycra Leggings</h2>
						<div class="price-box">
							<span class="product-price">$139.98</span>
							<span class="product-price-old">$169.00</span>
						</div>
						<div class="product-star">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-half-o"></i>
						</div>
						<div class="desc">Top zipper closure, two pockets in the front, Slit patch pocket in the back. Detachable, adjustable shoulder strap. Interior</div>
						<div class="variations-box">
							<table class="variations-table">
								<tr>
									<td class="table-label">Color</td>
									<td class="table-value">
										<ul class="list-check-box color">
											<li><a class="selected" href="#"><span style="background:#4d6dbd;">Blue</span></a></li>
											<li><a href="#"><span style="background:#fb5d5d;">Blue</span></a></li>
											<li><a href="#"><span style="background:#2fbcda;">Blue</span></a></li>
											<li><a href="#"><span style="background:#ffe00c;">Blue</span></a></li>
											<li><a href="#"><span style="background:#72b226;">Blue</span></a></li>
										</ul>
									</td>
								</tr>
								<tr>
									<td class="table-label">Size</td>
									<td class="table-value">
										<ul class="list-check-box">
											<li><a href="#">XL</a></li>
											<li><a href="#">X</a></li>
											<li><a href="#">S</a></li>
											<li><a href="#">XS</a></li>
										</ul>
									</td>
								</tr>
								<tr>
									<td class="table-label">Qty</td>
									<td class="table-value">
										<div class="box-qty">
											<a href="#" class="quantity-minus">-</a>
											<input type="text" class="quantity" value="1">
											<a href="#" class="quantity-plus">+</a>
										</div>
										<a href="#" class="button-radius btn-add-cart">Buy<span class="icon"></span></a>
									</td>
								</tr>
							</table>
						</div>
						<div class="box-control-button">
							<a class="link-wishlist" href="#">wishlist</a>
							<a class="link-compare" href="#">Compare</a>
							<a class="link-sendmail" href="#">Email to a Friend</a>
							<a class="link-print" href="#">Print</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<?php page_partial('footer') ?>