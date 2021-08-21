<div class="container">
	<div class="st-default main-wrapper clearfix">
		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="block block-categories-slider">
					<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="false">
						<a href="#">
							<?php $image = empty($info->banner_images) ? 'default_shop_banner.png' : $info->banner_images ?>
							<img src="<?=base_url('uploads/'.$image) ?>" alt="alt">
						</a>
						<a href="#">
							<?php $image = empty($info->banner_images) ? 'default_shop_banner.png' : $info->banner_images ?>
							<img src="<?=base_url('uploads/'.$image) ?>" alt="alt">
						</a>
			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container" style="background:rgba(0,0,0,0.03); border-radius:5px; padding-top:5px;">
	<div class="row">
		<div class="col-sm-3">
			<?php $image = empty($info->profile_image) ? 'profile.png' : $info->profile_image ?>
			<img src="<?=base_url('uploads/'.$image) ?>" style="max-width:250px; max-height:250px" class="img-responsive img-thumbnail">
		</div>
		<div class="col-sm-6">
			<h2 style="font-weight: bold"><?=$info->shop_name ?></h2>
			<p style="font-size:20px;">
				<a href="#" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> <strong>Follow</strong></a>
				<a href="<?=site_url('store/'.$info->shop_slug) ?>" class="btn btn-sm btn-primary"><i class="fa fa-shopping-cart"></i> <strong>Visit Store</strong></a>
				<a href="javascript:void(0)" onclick="$('.chatbox--tray').toggleClass('chatbox--tray')" class="btn btn-sm btn-default"><i class="fa fa-commenting"></i> <strong>Live Chat</strong></a>
				<span class="pull-right">
					<a href="<?=$info->facebook ?>" target="_blank"><i class="fa fa-facebook-official"></i></a>&nbsp;
					<a href="<?=$info->twitter ?>" target="_blank"><i class="fa fa-twitter-square"></i></a>&nbsp;
				</span>
			</p>
			<p>
				<em><?=trim($info->shop_description) ?></em>
			</p>
			<p><i class="fa fa-address-card-o"></i> <?=trim($info->address) ?></p>
			<p><a href="mailto:vadeshayo@gmail.com"><i class="fa fa-envelope"></i> <?=trim($user->email) ?></a></p>
			<p><a href="#"><i class="fa fa-phone"></i> <?=trim($info->phone_1) ?>, <?=trim($info->phone_2) ?></a></p>
			<p><a href="<?=$info->website ?>" target="_blank"><i class="fa fa-globe"></i> Website</a></p>
			<small class="text-info">
				<em>
					3,034 Followers | 
					Seller since <strong><?=date('F, Y', strtotime($info->created_at)) ?></strong> |
					<?php $zone = \DB\DB::getCell('country_zones', ['country_id'=>$info->country_id, 'id'=>$info->zone_id], 'name') ?>
					<i class="fa fa-map-marker"></i> <?=ucfirst($zone) ?>, <?=$info->country ?>
				</em>
			</small>
		</div>
		<div class="col-sm-3">
			
			
			<div class="block-inner" id="review">
				<div class="block-owl">
					<h4 class="comments-title">Feedback from customers</h4>
					<ul class="kt-owl-carousel list-partners" data-nav="false" data-autoplay="true" data-loop="true" data-items="1">
						<?php for($i = 0; $i<=5; $i++): ?>
							<li class="partner comment">
								<div class="comment-content">
									<div class="comment-meta">
										<a href="#" class="comment-author">jon Conner</a>
										<span class="comment-date">March 14, 2013 at 8:03 am</span>
										<div class="review-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-half-o"></i>
										</div>
									</div>
									<div class="comment-entry">
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
									</div>

								</div>
							</li>
						<?php endfor; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!-- new-arrivals -->
			<div class="block3 block-new-arrivals">
				<div class="block-head clearfix">
					<h3 class="block-title">Collections</h3>
					<ul class="nav-tab default">                                   
						<li class="active"><a data-toggle="tab" href="#tab-1">Best Selling Products by <?=$info->shop_name ?></a></li>
						<li><a data-toggle="tab" href="#tab-2">New Arrivals </a></li>
					</ul>
				</div>
				<div class="block-inner">
					<div class="tab-container">
						<div id="tab-1" class="tab-panel active">
							<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"768":{"items":2},"1000":{"items":3},"1200":{"items":4}}'>
								<?php $products = $trending; ?>
								<?php include(__DIR__.'/includes/homepage_products.php') ?>
							</ul>
						</div>
						<div id="tab-2" class="tab-panel">
							<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"768":{"items":2},"1000":{"items":3},"1200":{"items":4}}'>
								<?php include(__DIR__.'/includes/homepage_products.php') ?>
							</ul>
						</div>
						
					</div>
				</div>
				
			</div>
			<!-- new-arrivals -->
		</div>
	</div>
</div>
<br><br>

<script>
	var merchantId 				= '<?=1 ?>';
	var url 					= '<?=site_url('chat') ?>/';
	var img 					= '<?=theme_url('data/placeholder.png') ?>';
	
</script>

<?=theme_file('js/chat.js', 'js') ?>

<!-- Chat -->
<?php include(__DIR__.'/chat.php') ?>
