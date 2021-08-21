<?php if(!empty($breadcrumbs)): ?>
	<div class="block block-breadcrumbs clearfix">
		<ul>
			<li class="home">
				<a href="<?=site_url() ?>"><i class="fa fa-home"></i></a>
				<span></span>
			</li>
			<?php for($i = 0; $i<count($breadcrumbs); $i++): ?>
				<?php if($i != count($breadcrumbs)-1): ?>
					<li><a href="<?=$breadcrumbs[$i]['link'];?>"><?=$breadcrumbs[$i]['name'];?></a><span></span></li>
				<?php else: ?>
					<li><?=$breadcrumbs[$i]['name'];?></li>
				<?php endif; ?>
			<?php endfor; ?>

		</ul>
	</div>
<?php endif; ?>

