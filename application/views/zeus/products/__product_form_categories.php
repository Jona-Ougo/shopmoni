 <div class="tab-pane" id="product_categories" style="height:500px; overflow: auto">
    <?php if(isset($categories[0])):?>
        <label>
            <strong>
                <?=lang('select_a_category');?>
            </strong>
        </label>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><i class="icon-eye-slash"></i></th>
                    <th><?=lang('name')?></th>
                    <?php foreach ($groups as $group):?>
                        <th><?=$group->name;?></th>
                    <?php endforeach;?>
                    <th class="text-center">Primary Category</th>
                    <th class="text-center">Secondary Category</th>
                </tr>
            </thead>
            <?php
            function list_categories($parent_id, $cats, $sub='', $product_categories, $primary_category, $groups, $hidden)
            {
                if(isset($cats[$parent_id]))
                {
                    foreach ($cats[$parent_id] as $cat):?>
                    <tr>
                        <td><?=($hidden)?'<i class="icon-eye-slash">':'';?></i></td>
                        <td><?= $sub.$cat->name; ?></td>
                        <?php foreach ($groups as $group):?>
                            <td><?=($cat->{'enabled_'.$group->id})?'<i class="icon-check"></i>':'';?></td>
                        <?php endforeach;?>
                        <td>
                            <?php $primary = $primary_category == $cat->id?'checked="checked"':'' ?>
                            <input type="radio" name="primary_category" value="<?=$cat->id?>" <?=$primary ?>/>
                        </td>
                        <td>
                            <?php $sec = (in_array($cat->id, $product_categories))?'checked="checked"':'' ?>
                            <input type="checkbox" name="categories[]" value="<?=$cat->id ?>" <?=$sec ?>/>
                        </td>

                    </tr>
                    <?php
                    if (isset($cats[$cat->id]) && sizeof($cats[$cat->id]) > 0)
                    {
                        $sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
                        $sub2 .=  '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
                        list_categories($cat->id, $cats, $sub2, $product_categories, $primary_category, $groups, $hidden);
                    }
                endforeach;
            }
        }

        list_categories(-1, $categories, '', $product_categories, $primary_category, $groups, true);
        list_categories(0, $categories, '', $product_categories, $primary_category, $groups, false);
        ?>

    </table>
<?php else:?>
    <div class="alert"><?=lang('no_available_categories');?></div>
<?php endif;?>

</div>