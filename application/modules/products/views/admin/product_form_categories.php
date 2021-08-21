 <?php $marketPlaces = \DB\DB::get('categories', ['is_marketplace' => 1], 'name', 'ASC') ?>
 <?php $i = 0; ?>

 <div class="tab-pane" id="product_categories">
    <div id="accordion" class="panel-group">
        <?php foreach($marketPlaces as $row): ?>
            <div class="panel panel-default">
                <div class="panel-heading heading" data-id="<?=$row->id ?>">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?=$row->id ?>">
                            <?=ucwords($row->name) ?>
                            <div class="pull-right">
                                <?php $pry = $primary_category == $row->id ? 'checked="checked"' : '' ?>
                                <input type="radio" name="primary_category" value="<?=$row->id ?>" <?=$pry ?>>
                                <?php $sec = (in_array($row->id, $product_categories))?'checked="checked"':'' ?>
                                <input type="checkbox" name="categories[]" value="<?=$row->id ?>" <?=$sec ?>>
                            </div>
                        </a>
                    </h4>
                </div>
                <div id="collapse-<?=$row->id ?>" class="panel-collapse collapse">
                    <div class="panel-body body-<?=$row->id ?>">

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php $id = empty($id) ? 0 : $id ?>

<script type="text/javascript">
    $(function(){

        $('body').on('click', '.heading', function(){

            id      = $(this).data('id');
            body    = $('.body-'+id);

            if(!$.trim(body.html()).length){

              body.load('<?=site_url('admin/category-children') ?>/'+id+'/'+<?=$id ?>);
          }

      })

    })
</script>