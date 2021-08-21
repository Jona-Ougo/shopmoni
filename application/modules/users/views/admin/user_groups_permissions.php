<?php pageHeader($page_title) ?>

<?=form_open() ?>
<div class="row">
	<label>
	<input type="checkbox" id="all">
		Select All 
	</label>
	<br>
	<?php $permissions = \DB\DB::getArray('admin_user_permissions') ?>
	<?php $_permissions = array_chunk($permissions, 7) ?>
	<?php foreach($_permissions as $permissionArray): ?>
		<?php foreach($permissionArray as $row): ?>
			<div class="col-md-4">
				<label>
					<input type="checkbox" name="<?=$row['permission'] ?>" value="<?=$row['permission'] ?>">
					<?=strtoupper($row['permission']) ?>
				</label>
			</div>
		<?php endforeach; ?>
	<?php endforeach; ?>
</div>
<br>
<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
<?=form_close() ?>

<script type="text/javascript">
	$('form').submit(function() {
		$('.btn .btn-primary').attr('disabled', true).addClass('disabled');
	});

	$(function(){
		gpermissions = "<?=$group_permissions ?>";
		permissions = gpermissions.split(',');
		for(i = 0; i<permissions.length; i++){
			$('input[name='+permissions[i]+']').prop('checked', true);
		}
	})

	$('#all').click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	})
</script>