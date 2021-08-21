<?php pageHeader('Category Filter Form'); ?>

<?=form_open('admin/category_filter/'.$filter->filter_id); ?>

<div class="row">
    <div class="col-md-8">

        <div class="form-group">
            <label for="name">Category</label>

            <?php $selected = $filter->category_id < 1 ? set_value('category_id') : $filter->category_id; ?>
            <select name="category_id" class="form-control">
              <?php foreach(\DB\DB::get('categories', ['is_marketplace'=>1]) as $row): ?>
                <?php if($row->id == $selected): ?>
                    <option value="<?=$row->id ?>" selected><?=$row->name ?></option>
                <?php else: ?>
                   <option value="<?=$row->id ?>"><?=$row->name ?></option>
               <?php endif; ?>
           <?php endforeach; ?>
       </select>
   </div>

   <div class="form-group">
    <label for="name">Category Filter Name</label>
    <?=form_input(['name'=>'name', 'value'=>assign_value('name', $filter->name), 'class'=>'form-control']); ?>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <?=form_textarea(['name'=>'description', 'class'=>'redactor', 'value'=>assign_value('description', $filter->description)]); ?>
</div>

</div>

</div>


<button type="submit" class="btn btn-primary"><?=lang('save');?></button>

</form>

<script type="text/javascript">
    $('form').submit(function() {
        $('.btn .btn-primary').attr('disabled', true).addClass('disabled');
    });
</script>