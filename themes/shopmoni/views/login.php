<div class="container">
	<div class="st-default main-wrapper clearfix">
		<div class="block block-breadcrumbs clearfix">
			<ul>
				<li class="home">
					<a href="#"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<li><h4 style="font-weight: bolder;">Login or Register</h4></li>
			</ul>
		</div>
		<div class="main-page">
			<br>
			<?php if(\CI::session()->flashdata('message') != ''): ?>
				<div class="col-sm-12" style="padding-left: 0px; ">
					<div class="alert alert-success col-sm-6">
						<?=\CI::session()->flashdata('message') ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="page-content">
				<?php include(__DIR__.'/includes/auth.php') ?>
			</div>
		</div>
	</div>

</div>

