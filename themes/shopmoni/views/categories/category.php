	<div class="container">
		<div class="st-default main-wrapper clearfix">
			<?=CI::breadcrumbs()->generate(); ?>
			<div class="row">
				<?php $sidebar = $category->is_marketplace == 1 ? 'marketplace_sidebar' : 'sidebar' ?>
				<?php include(__DIR__.'/'.$sidebar.'.php') ?>
				<div class="col-xs-12 col-sm-8 col-md-9">
					<?php if(!empty($category->image)): ?>
						<?php $image = base_url('uploads/images/full/'.$category->image) ?>
						<div class="block block-categories-slider">
							<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="false">
								<a href="#">
									<img src="<?=$image ?>" alt="<?=$category->name ?>">
								</a>
								<a href="#">
									<img src="<?=$image ?>" alt="<?=$category->name ?>">
								</a>
							</div>
						</div>
					<?php endif; ?>
					<h3 class="page-title">
						<span><?=$category->name ?></span>
						<!-- <a href="#" class="button-radius compare-link">Compare<span class="icon"></span></a> -->
					</h3>
					<p><?=(new content_filter($category->description))->display();?></p>
					<?php if(count($products) < 1): ?>

						<h2>Welcome!</h2>
						<?php if(\CI::uri()->segment(2) == 'made-in-nigeria-marketplace'): ?>
						<!-- Welcome to ShopMoni Made In Nigeria MarketPlace! -->
							List Your Made In Nigeria Products and Services.<br />
							It’s free and easy to set up your shop and start selling, even to International buyers within minutes.<br>
							Manage all listings from your personalized dashboard.<br>
							For the love of Nigeria, buy made in Nigeria goods.<br>
							<a href="<?=site_url('login') ?>" style="color:#fd7400;">Click Here</a> To Start Selling<br>
							<img src="<?=base_url('assets/images/ng.gif') ?>" class="img-responsive" alt="<?=$category->name ?>">
						<?php else: ?>
							<p>
								We are Glad you are interested in <span style="color:#fd7400;"><?=$category->name ?></span>. But no product is listed at this time, please check back again.
							</p>
							<p>
								We invite You to be the first to list your product(s) under this category and start making money, <a href="<?=site_url('login') ?>" style="color:#fd7400;">Click Here</a> Now to get started.
							</p> 
							<img src="<?=base_url('assets/images/empty_category.png') ?>" class="img-responsive" alt="<?=$category->name ?>">
						<?php endif ?>
						

					<?php else: ?>
						<div class="sortPagiBar">
						<!-- <ul class="display-product-option">
							<li class="view-as-grid selected">
								<span>grid</span>
							</li>
							<li class="view-as-list">
								<span>list</span>
							</li>
						</ul> -->
						<?php 
						$config['first_link']       = '1';  
						$config['first_tag_open']   = '<li>';
						$config['first_tag_close']  = '</li>';   
						$config['last_link']        = 'Last';   
						$config['last_tag_open']    = '<li>';    
						$config['last_tag_close']   = '</li>';
						$config['full_tag_open']    = '<ul class="pagination">';
						$config['full_tag_close']   = '</ul>'; 
						$config['cur_tag_open']     = '<li class="active"><a href="#">';
						$config['cur_tag_close']    = '</a></li>';

						$config['num_tag_open']     = '<li>';    
						$config['num_tag_close']    = '</li>';

						$config['prev_link']        = '<i class="fa fa-angle-double-left"></i>';
						$config['prev_tag_open']    = '<li>';
						$config['prev_tag_close']   = '</li>';    
						$config['next_link']        = '<i class="fa fa-angle-double-right"></i>';
						$config['next_tag_open']    = '<li>';   
						$config['next_tag_close']   = '</li>';
						\CI::pagination()->initialize($config);
						$pagination = CI::pagination()->create_links();
						?>
						<div class="sortPagiBar-inner">
							<nav><?=$pagination ?></nav>
							<!-- <div class="show-product-item">
								<select class="">
									<option value="1">Show 6</option>
									<option value="1">Show 12</option>
								</select>
							</div>
						-->
						<div class="sort-product">
							<select id="sort" onchange="window.location=this.value">
								<?php $selected = $sort == 'name' && $dir == 'ASC' ? 'selected' : '' ?>
								<?php $value    = site_url('category/'.$slug.'/name/ASC/'.$page) ?>
								<?php $text     = lang('sort_by_name_asc') ?>
								<option value="<?=$value ?>"  <?=$selected ?>><?=$text ?></option>

								<?php $selected = $sort == 'name' && $dir == 'DESC' ? 'selected' : '' ?>
								<?php $value    = site_url('category/'.$slug.'/name/DESC/'.$page) ?>
								<?php $text     = lang('sort_by_name_desc') ?>
								<option value="<?=$value ?>"  <?=$selected ?>><?=$text ?></option>

								<?php $selected = $sort == 'price' && $dir == 'ASC' ? 'selected' : '' ?>
								<?php $value    = site_url('category/'.$slug.'/price/ASC/'.$page) ?>
								<?php $text     = lang('sort_by_price_asc') ?>
								<option value="<?=$value ?>"  <?=$selected ?>><?=$text ?></option>

								<?php $selected = $sort == 'price' && $dir == 'DESC' ? 'selected' : '' ?>
								<?php $value    = site_url('category/'.$slug.'/price/DESC/'.$page) ?>
								<?php $text     = lang('sort_by_price_desc') ?>
								<option value="<?=$value ?>"  <?=$selected ?>><?=$text ?></option>
							</select>

						</div>
					</div>
				</div>
				<div class="category-products">
					<?php include(__DIR__.'/products.php') ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
</div>
