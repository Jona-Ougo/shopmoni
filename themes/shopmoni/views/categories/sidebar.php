<div class="col-xs-12 col-sm-4 col-md-3">
	<style>
	.category-list{

		color: #333 !important;
	}

</style>
<div class="block block-sidebar">
	<div class="block-head">
		<h5 class="widget-title">Filters</h5>
	</div>
	<div class="block-inner">
		<div class="block-filter">
			<div class="block-sub-title" style="font-size:20px;">
				Related Categories
			</div>
			<div class="block-filter-inner">
				<?php if(isset($category->id)): ?>
					<?php print_r($category); ?>
					<?php $categories = \DB\DB::get('categories', ['parent_id'=>$category->id],  'sequence') ?>
					<ul class="tree-menu">
						<li class="active">
							<ul>
								<?php foreach($categories as $row): ?>
									<li>
										<a href="<?=site_url('category/'.$row->slug) ?>" onclick="window.location = $(this).attr('href')" class="category-list">
											<?=$row->name ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</li>
					</ul>
				<?php endif; ?>
			</div>
		</div>
		<div class="block-filter">
			<div class="block-sub-title">Price</div>
			<div class="block-filter-inner">
				<input type="text" placeholder="minimum">
				<br>
				<input type="text" placeholder="maximum">
				<br>
				<input type="submit" class="button btn-primary" value="Filter">
			</div>
		</div>
			<!-- <div class="block-filter">
				<div class="block-sub-title">Year</div>
				<div class="block-filter-inner">
					<ul class="tree-menu">
						<select name="" id="input" onchange="window.location = $(this).val()">
							<?php $url = site_url('filter/'.$marketplace->slug.'/year') ?>
							<?php for($i = 1960; $i<=2019; $i++): ?>
								<option value="<?=$url.'/'.$i ?>"><?=$i ?></option>
							<?php endfor ?>
						</select>

					</ul>
				</div>
			</div> -->

			<div class="block-filter">
				<div class="block-filter-inner">
					<ul class="tree-menu">
						<label for="country_id">Country</label>
						<select name="country_id" id="country_id">
							<option value="">--select--</option>
							<?php foreach(\CI::Locations()->get_countries_menu() as $id => $name): ?>
								<option value="<?=$id ?>"><?=$name ?></option>
							<?php endforeach; ?>
						</select>
						
						<label for="">State</label>
						<select onchange="window.location = $(this).val()" id="zone_id">
							<option value="">--select--</option>
							<?php foreach(\CI::Locations()->get_zones_menu() as $row): ?>
								<option value="<?=$url.'/'.strtolower($row) ?>"><?=$row ?></option>
							<?php endforeach; ?>
						</select>

					</ul>
				</div>
			</div>

		</div>
	</div>

</div>

<script>
	$(function(){

		$('#country_id').change(function(){

			$('#zone_id').load('<?=site_url('addresses/get-zone-options');?>/'+$('#country_id').val());
		});

	})
</script>