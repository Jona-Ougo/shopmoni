<?php pageHeader(lang('coupon_form'));?>

<?=form_open('admin/coupons/form/'.$id); ?>
    <div class="row">
        <div class="col-sm-4">
            <div class="alert alert-info" style="text-align:center;">
                <strong><?=sprintf(lang('times_used'), @$num_uses);?></strong>
            </div>

            <div class="form-group">
                <label for="code">Coupon Name</label>
                <?=form_input(['name'=>'name', 'value'=>assign_value('name', $name), 'class'=>'form-control']); ?>
            </div>

            <div class="form-group">
                <label for="code"><?=lang('coupon_code');?></label>
                <?=form_input(['name'=>'code', 'value'=>assign_value('code', $code), 'class'=>'form-control']); ?>
            </div>

            <div class="form-group">
                <label for="max_uses"><?=lang('max_uses');?></label>
                <?=form_input(['name'=>'max_uses', 'value'=>assign_value('max_uses', $max_uses), 'class'=>'form-control']); ?>
            </div>


            <div class="form-group">
                <label for="max_product_instances"><?=lang('limit_per_order')?></label>
                <?=form_input(['name'=>'max_product_instances', 'value'=>assign_value('max_product_instances', $max_product_instances), 'class'=>'form-control']); ?>
            </div>

            <div class="form-group">
                <label for="start_date"><?=lang('enable_on');?></label>
                <?=form_input(['name'=>'start_date', 'data-value'=>assign_value('start_date', reverse_format($start_date)), 'class'=>'datepicker form-control']);?>
            </div>

            <div class="form-group">
                <label for="end_date"><?=lang('disable_on');?></label>
                <?=form_input(['name'=>'end_date', 'data-value'=>assign_value('end_date', reverse_format($end_date)), 'class'=>'datepicker form-control']); ?>
            </div>

            <div class="form-group">
                <label for="reduction_amount"><?=lang('reduction_amount')?></label>
                <div class="row">
                    <div class="col-md-6">
                    <?=form_dropdown('reduction_type', [ 'percent'  => lang('percentage'), 'fixed' => lang('fixed') ],  $reduction_type, 'class="form-control"'); ?>
                    </div>
                    <div class="col-md-6">
                        <?=form_input(['name'=>'reduction_amount', 'value'=>assign_value('reduction_amount', $reduction_amount), 'class'=>'form-control']);?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-1 well pull-right">
            <?php
                $options = [ '1' => lang('apply_to_whole_order'), '0' => lang('apply_to_select_items') ];
                echo form_dropdown('whole_order_coupon', $options,  assign_value(1, $whole_order_coupon), 'id="gc_coupon_appliesto_fields" class="form-control"');
            ?>
            <div id="gc_coupon_products">
                <table class="table" width="100%" border="0" style="margin-top:10px;" cellspacing="5" cellpadding="0">
                <tbody id="product_items_container"></tbody>
                </table>
                <div class="form-group">
                    <input class="form-control" type="text" id="product_search" placeholder="Product search" />
                </div>
                <div class="form-group">
                    <select class="form-control" id="product_list" size="5" style="margin:0px;"></select>
                </div>
                <div class="form-group">
                    <a href="#" onclick="add_product();return false;" class="btn btn-primary" title="Add Product">Add Product</a>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary"><?=lang('save');?></button>
    
<?=form_close() ?>
<?php

function related_items($id, $name) {
    return '
            <tr id="related_product_'.$id.'">
                <td>
                    <input type="hidden" name="product['.$id.'][id]" value="'.$id.'"/>
                    <input type="hidden" name="product['.$id.'][name]" value=\''.htmlspecialchars($name).'\'/>
                    '.$name.'</td>
                <td class="text-right">
                    <a class="btn-xs btn-default btn-danger" href="#" onclick="remove_product('.$id.'); return false;"><i class="icon-times"></i></a>
                </td>
            </tr>
        ';
}
?>
<script id="productTemplate" type="text/template">
    <?=related_items("{{id}}", "{{name}}");?>
</script>

<script type="text/javascript">
$('form').submit(function() {
    $('.btn .btn-primary').attr('disabled', true).addClass('disabled');
});

$('#product_search').keyup(function(){
    $('#product_list').html('');
    run_product_query();
});

function run_product_query()
{
    $.post("<?=site_url('zeus/products/product_autocomplete/');?>", { name: $('#product_search').val(), limit:10},
        function(data) {
    
            $('#product_list').html('');
    
            $.each(data, function(index, value){
    
                if($('#related_product_'+index).length == 0)
                {
                    $('#product_list').append('<option id="product_item_'+index+'" value="'+index+'">'+value+'</option>');
                }
            });
    
    }, 'json');
}

var productTemplate = $('#productTemplate').html();

function add_product()
{
    //if the related product is not already a related product, add it
    if($('#related_product_'+$('#product_list').val()).length == 0 && $('#product_list').val() != null)
    {

        addToProductList($('#product_list').val(), $('#product_item_'+$('#product_list').val()).html());
        run_product_query();

    }
    else
    {
        if($('#product_list').val() == null)
        {
            alert('<?=lang('alert_select_product');?>');
        }
        else
        {
            alert('<?=lang('alert_product_related');?>');
        }
    }
}

function addToProductList(id, name)
{
    var view = {
        id:id,
        name:name
    }

    var output = Mustache.render(productTemplate, view);

    $('#product_items_container').append(output);
}

function remove_product(id)
{
    if(confirm('<?=lang('confirm_remove_related');?>'))
    {
        $('#related_product_'+id).remove();
        run_product_query();
    }
}

$(document).ready(function(){

    var products = <?=json_encode($products);?>
    
    $.each(products, function(key, val){
        addToProductList(val.id, val.name);
    });

    $("#gc_tabs").tabs();

    if($('#gc_coupon_type').val() == 'shipping')
    {
        $('#gc_coupon_price_fields').hide();
    }

    $('#gc_coupon_type').bind('change keyup', function(){
        if($(this).val() == 'price')
        {
            $('#gc_coupon_price_fields').show();
        }
        else
        {
            $('#gc_coupon_price_fields').hide();
        }
    });

    if($('#gc_coupon_appliesto_fields').val() == '1')
    {
        $('#gc_coupon_products').hide();
    }

    $('#gc_coupon_appliesto_fields').bind('change keyup', function(){
        if($(this).val() == 0)
        {
            $('#gc_coupon_products').show();
        }
        else
        {
            $('#gc_coupon_products').hide();
        }
    });
});

$('#product_search').on('keyup keypress', function(e){
    var keyCode = e.keyCode || e.which;
    if(keyCode === 13){
        e.preventDefault();
        return false;
    }
})

</script>