<?php pageHeader(lang('banner_collection_form')); ?>

<?=form_open_multipart('zeus/banners/banner_collection_form/'.$banner_collection_id); ?>
    <div class="form-group">
        <label for="title"><?=lang('name');?> </label>
        <?=form_input(['name'=>'name', 'value' => assign_value('name', $name), 'class' =>'form-control']); ?>
    </div>

    <div class="form-group">
    	<label for="">Description</label>
    	 <?=form_input(['name'=>'description', 'value' => assign_value('description', $description), 'class' =>'form-control']); ?>
    </div>

    <div class="form-group">
        <label for="">Advert Credit</label>
        <?=form_dropdown('advert_credit_id',$advert_credit_ids, assign_value('advert_credit_id',$advert_credit_id), 'class="form-control"'); ?>
    </div>

    <input class="btn btn-primary" type="submit" value="<?=lang('save');?>"/>
</form>