<div class="page-header">
    <h2><?php echo lang('paystack');?></h2>
</div>

<?php echo form_open_multipart('admin/paystack/form'); ?>
<div class="row">
<div class="col-md-6">
<div class="form-group">
    <label for="enabled">Public Key </label>
    <?php echo form_input('public_key', assign_value('public_key', $public_key), 'class="form-control"'); ?>
</div>
<div>
    <label for="enabled">Gateway URL </label>
    <?php echo form_input('gateway_url', assign_value('gateway_url', $gateway_url), 'class="form-control"'); ?>
</div>
<div class="form-group">
    <label for="enabled"><?php echo lang('enabled');?> </label>
    <?php echo form_dropdown('enabled', array('0' => lang('disabled'), '1' => lang('enabled')), assign_value('enabled',$enabled), 'class="form-control"'); ?>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>
</div>    
</div>    
</form>

<script type="text/javascript">
$('form').submit(function() {
    $('.btn .btn-primary').attr('disabled', true).addClass('disabled');
});
</script>