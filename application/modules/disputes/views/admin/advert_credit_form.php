<?php pageHeader(lang('add_advert_credit')); ?>

<?php echo form_open_multipart('zeus/advert_credit/add'); ?>
    <div class="form-group">
        <label for="name"><?php echo lang('value');?> </label>
        <?php echo form_input(['name'=>'value', 'value' => assign_value('value', $value), 'class'=>'form-control']); ?>
    </div>

    <div class="form-group">
        <label for="name"><?php echo lang('amount');?> </label>
        <?php echo form_input(['name'=>'amount', 'value' => assign_value('amount', $amount), 'class'=>'form-control']); ?>
    </div>

    <input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>

</form>
<script>
    $('form').submit(function() {
        $('.btn .btn-primary').attr('disabled', true).addClass('disabled');
    });
</script>
