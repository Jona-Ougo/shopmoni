
<div class="container">
	<div class="block block-breadcrumbs clearfix">
		<ul>
			<li class="home">
				<a href="<?=site_url() ?>"><i class="fa fa-home"></i></a>
				<span></span>
			</li>
			<li>Products by <?=$info->shop_name ?></li>
		</ul>
	</div>

	<div class="row">

		<?php //include(__DIR__.'categories/sidebar.php') ?>
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
	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12">
			<div class="st-default main-wrapper clearfix">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<h3 class="page-title">
							<span>Products by <?=$info->shop_name ?></span>
						</h3>

						<?php if(count($products) < 1): ?>
							<h2>This seller currently has no products uploaded. <i class="fa fa-frown-o"></i></h2>
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
							<div class="icon"><i class="fa fa-sort-alpha-asc"></i></div>
						</div>
					</div>
				</div>
				<div class="category-products">
					<?php $cols = 3; ?>
					<?php include(__DIR__.'/products.php') ?>
				</div>

			<?php endif; ?>
		</div>
	</div>
</div>
</div>
</div>

</div>