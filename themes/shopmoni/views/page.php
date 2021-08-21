<div class="container">

	<div class="st-default main-wrapper">
		<div class="block block-breadcrumbs clearfix">
			<ul>
				<li class="home">
					<a href="<?=site_url() ?>"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<?php if($page_title):?>
					<li><?php echo $page_title;?></li>
				<?php endif;?>
			</ul>
		</div>
		<div class="row">
			<!-- <div class="col-sm-4 col-md-3">
				<div class="block block-widget">
					<div class="block-head">
						<h5 class="widget-title">Categories</h5>
					</div>
					<div class="block-inner">
						<ul class="list-link">
							<?php $where = ['enabled_1'=>1,'parent_id'=>0, 'is_marketplace'=>0]; ?>
							<?php $categories = \DB\DB::get('categories', $where, 'name', 'ASC');  ?>
							<?php foreach($categories as $row): ?>
							<li><a href="<?=site_url('category/'.$row->slug) ?>"><?=$row->name ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				
			</div> -->
			<div class="col-sm-12 col-md-12">
				<?php if($page_title):?>
					<h1 class="page-title"><?php echo $page_title;?></h1>
				<?php endif;?>
				<div class="main-page">
					<div class="page-content clearfix">
						<?=(new content_filter($page->content))->display() ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>