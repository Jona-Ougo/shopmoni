<table class="table table-responsive table-striped">
    <?php foreach($children as $row): ?>
       <?php $subchildren = \DB\DB::getFew('categories', ['id', 'name'], ['parent_id' => $row->id]) ?>
       <tr>
        <td>
            <?php if(count($subchildren) > 0): ?>
                <a href="javascript:void(0)" class="heading" data-id="<?=$row->id ?>"><?=$row->name ?></a>
            <?php else: ?>
                <?=$row->name ?>
            <?php endif ?>
        </td>
        <td>
            <?php $pry = $primary_category == $row->id ? 'checked="checked"' : '' ?>
            <input type="radio" name="primary_category" value="<?=$row->id ?>" <?=$pry ?>/>
        </td>
        <td>
            <?php $sec = (in_array($row->id, $product_categories)) ? 'checked="checked"' : '' ?>
            <input type="checkbox" name="categories[]" value="<?=$row->id ?>" <?=$sec ?> />
        </td>
    </tr>
    <?php $subchildren = \DB\DB::getFew('categories', ['id', 'name'], ['parent_id' => $row->id]) ?>
    <?php if(count($subchildren) > 0): ?>
        <tr>
            <td colspan="3" class="body-<?=$row->id ?>"></td>
        </tr>
    <?php endif ?>
<?php endforeach; ?>
</table>