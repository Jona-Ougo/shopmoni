	<div class="container">
		<div class="st-default main-wrapper clearfix">
			<?=CI::breadcrumbs()->generate(); ?>
			<div class="row">
				<?php include(__DIR__.'/categories/sidebar.php') ?>
				<div class="col-xs-12 col-sm-8 col-md-9">
					<br>
					<div class="alert alert-danger">
						<?=lang('search_error');?>
					</div>
				</div>
			</div>
		</div>
	</div>
