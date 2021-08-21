<?php pageHeader('Administrators Groups') ?>

<div class="text-right">
	<a class="btn btn-primary" href="<?=site_url('admin/users/groups/form'); ?>">
		<i class="icon-plus"></i> Add New Admin Group
	</a>
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>     
			<th/>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($groups as $row):?>
			<tr>
				<td><?=$row->group_name; ?></td>
				<td><?=$row->group_description; ?></td>
				<td class="text-right">
					<div class="btn-group">
						<a class="btn btn-default" href="<?=site_url('admin/users/groups/form/'.$row->group_id);?>">
							<i class="icon-pencil"></i>
						</a> 
						<a class="btn btn-primary" href="<?=site_url('admin/users/groups/permissions/'.$row->group_id); ?>"><i class="fa fa-cogs"></i></a>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
