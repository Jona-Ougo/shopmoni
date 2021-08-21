<?php pageHeader(lang('admin_form')) ?>

<?=form_open() ?>
<div class="form-group">
	<label for="">Group name</label>
	<?=form_input(['name'=>'group_name', 'class'=>'form-control', 'value'=>assign_value('group_name', $group_name)]) ?>
</div>

<div class="form-group">
	<label for="">Group Description</label>
	<?=form_textarea(['name'=>'group_description', 'class'=>'form-control', 'value'=>assign_value('group_description', $group_description)]) ?>
</div>

<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
<?=form_close() ?>

<script type="text/javascript">
$('form').submit(function() {
    $('.btn .btn-primary').attr('disabled', true).addClass('disabled');
});
</script>