<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="">
			<div class="text-center">
				<h3 class="">Welcome back <?=\CI::Login()->customer()->firstname ?>!</h3>
				<strong style="color:#222">
					We are glad to have you back! Where would you like to get started today?
				</strong>
			</div>

			<div class="">

				<div class="row">

					<div class="col-sm-3">
						<div class="about-features-box text-center">
							<div class="feature-icon">
								<i class="fa fa-dashboard"></i>
							</div>
							<h4>View My Dashboard</h4>

							<p class="text-muted">
								<a href="<?=site_url('admin/dashboard') ?>" class="btn btn-lg btn-primary">
									Dashboard
								</a>
							</p>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="about-features-box text-center">
							<div class="feature-icon">
								<i class="fa fa-cart-plus"></i>
							</div>
							<h4>View My Shop Orders</h4>

							<p class="text-muted">
								<a href="<?=site_url('admin/orders') ?>" class="btn btn-lg btn-success">
									Shop Orders
								</a>
							</p>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="about-features-box text-center">
							<div class="feature-icon">
								<i class="fa fa-cubes"></i>
							</div>
							<h4>View / Upload Products</h4>
							
							<p class="text-muted">
								<a href="<?=site_url('admin/products') ?>" class="btn btn-lg btn-default">
									My Products
								</a>
							</p>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="about-features-box text-center">
							<div class="feature-icon">
								<i class="fa fa-university"></i>
							</div>
							<h4>View My Store</h4>
							<?php $info = \DB\DB::getRow('customers_shop_information', ['customer_id'=>\CI::Login()->customer()->id]) ?>
							<p class="text-muted">
								<a href="<?=site_url('shop/'.$info->shop_slug) ?>" target="_blank" class="btn btn-lg btn-info">
									My Store
								</a>
							</p>
						</div>
					</div>
				</div>
				<!-- end row -->

				<div class="row">
					<div class="col-sm-3">
						<div class="about-features-box text-center">
							<div class="feature-icon">
								<i class="fa fa-shopping-cart"></i>
							</div>
							<h4>Place an Order</h4>

							<p class="text-muted">
								<a href="<?=site_url() ?>" target="_blank" class="btn btn-lg btn-default">
									ShopMoni Home
								</a>
							</p>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="about-features-box text-center">
							<div class="feature-icon">
								<i class="fa fa-cart-arrow-down"></i>
							</div>
							<h4>View My Orders</h4>

							<p class="text-muted">
								<a href="<?=site_url('my-orders') ?>" class="btn btn-lg btn-warning">
									My Orders
								</a>
							</p>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="about-features-box text-center">
							<div class="feature-icon">
								<i class="fa fa-user-secret"></i>
							</div>
							<h4>Update my Profile</h4>

							<p class="text-muted">
								<a href="<?=site_url('my-account') ?>" class="btn btn-lg btn-danger">
									My Account
								</a>
							</p>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="about-features-box text-center">
							<div class="feature-icon">
								<i class="fa fa-money"></i>
							</div>
							<h4>ShopMoni Cash Club</h4>

							<p class="text-muted">
								<a href="<?=site_url('my-orders') ?>" class="btn btn-lg btn-primary">
									Login / Register
								</a>
							</p>
						</div>
					</div>
				</div>
				<!-- end row -->
			</div>
			<!-- end services -->


		</div> <!-- end p-20 -->
	</div> <!-- end col -->
</div>
<!-- end row -->
