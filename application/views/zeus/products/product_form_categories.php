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

<script type="text/javascript">
    $(function(){

        $('body').on('click', '.heading', function(){

            id      = $(this).data('id');
            body    = $('.body-'+id);

            if(!$.trim(body.html()).length){

              body.load('<?=site_url('zeus/category-children') ?>/'+id);
            }

        })

    })
</script>