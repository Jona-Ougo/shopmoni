<div class="page-header">
    <h1><?=lang('orders');?></h1>
</div>
<?php
    //set "code" for searches
    if(!$code)
    {
        $code = '';
    }
    else
    {
        $code = '/'.$code;
    }
    function sort_url($lang, $by, $sort, $sorder, $code)
    {
        if ($sort == $by)
        {
            if ($sorder == 'asc')
            {
                $sort = 'desc';
                $icon = ' <i class="icon-chevron-up"></i>';
            }
            else
            {
                $sort = 'asc';
                $icon = ' <i class="icon-chevron-down"></i>';
            }
        }
        else
        {
            $sort = 'asc';
            $icon = '';
        }


        $return = site_url('admin/orders/index/'.$by.'/'.$sort.'/'.$code);

        echo '<a href="'.$return.'">'.lang($lang).$icon.'</a>';

    }

if ($term):?>

<div class="alert alert-info">
    <?=sprintf(lang('search_returned'), intval($total));?>
</div>
<?php endif;?>

<style type="text/css">
    .pagination {
        margin:0px;
        margin-top:-3px;
    }
</style>
<div class="row">
    <div class="col-md-4">
        <?=CI::pagination()->create_links();?>&nbsp;
    </div>
    <div class="col-md-8">
        <?=form_open('admin/orders', 'class="form-inline" style="float:right"');?>
            <div class="form-group">
                <label class="sr-only" for="start_date"><?=lang('start_date');?></label>
                <input name="start_date" value="" class="datepicker form-control" type="text" placeholder="<?=lang('start_date');?>"/>
            </div>
            <div class="form-group">
                <input name="end_date" value="" class="datepicker form-control" type="text"  placeholder="<?=lang('end_date');?>"/>
            </div>
            <div class="form-group">
                <input id="top" type="text" class="form-control" name="term" placeholder="<?=lang('term')?>" />
            </div>
                <button class="btn btn-default" name="submit" value="search"><i class="icon-search"></i></button>
                <button class="btn btn-default" name="submit" value="export"><i class="icon-download"></i></button>
        </form>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th><?=sort_url('order', 'order_number', $sort_by, $sort_order, $code); ?></th>
            <th><?=lang('bill_to');?></th>
            <th><?=lang('ship_to');?></th>
            <th><?=sort_url('status','status', $sort_by, $sort_order, $code); ?></th>
            <th><?=sort_url('total','total', $sort_by, $sort_order, $code); ?></th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    <?=(count($orders) < 1)?'<tr><td style="text-align:center;">'.lang('no_orders') .'</td></tr>':''?>
    <?php foreach($orders as $order): ?>
       
        
    <tr>
        <td style="white-space:nowrap">
            <strong><a href="<?=site_url('admin/orders/order/'.$order->order_number);?>"><?=$order->order_number; ?></a></strong>
            <div style="font-size:11px;">@ <?=date('m/d/y h:i a', strtotime($order->ordered_on)); ?></div>
        </td>
        <td style="white-space:nowrap">
            <?=format_address([
                'company'=>$order->billing_company,
                'firstname'=>$order->billing_firstname,
                'lastname'=>$order->billing_lastname,
                'phone'=>$order->billing_phone,
                'email'=>$order->billing_email,
                'address1'=>$order->billing_address1,
                'address2'=>$order->billing_address2,
                'city'=>$order->billing_city,
                'zone'=>$order->billing_zone,
                'zip'=>$order->billing_zip,
                'country_id'=>$order->billing_country_id
                ]);?>
        </td>
        <td style="white-space:nowrap">
            <?=format_address([
                'company'=>$order->shipping_company,
                'firstname'=>$order->shipping_firstname,
                'lastname'=>$order->shipping_lastname,
                'phone'=>$order->shipping_phone,
                'email'=>$order->shipping_email,
                'address1'=>$order->shipping_address1,
                'address2'=>$order->shipping_address2,
                'city'=>$order->shipping_city,
                'zone'=>$order->shipping_zone,
                'zip'=>$order->shipping_zip,
                'country_id'=>$order->shipping_country_id
                ]);?>
        </td>
        <td style="max-width:200px;">
            <div class="input-group">
                <?=form_input(['id'=>'status_form_'.$order->id, 'data-original'=>set_value('status',$order->item_status), 'class'=>'form-control', 'value'=>set_value('status',$order->item_status)]);?>
                <div class="input-group-btn">

                    <button type="button" class="btn btn-success" onclick="save_status(<?=$order->id.' ,'.$order->merchant_id ?>)"><i class="icon-check"></i></button>

                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php foreach(config_item('order_statuses') as $os):?>
                            <li><a onclick="$('#status_form_<?=$order->id;?>').val('<?=$os;?>'); return false;"><?=$os;?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </td>
        <td><div class="MainTableNotes"><?=format_currency($order->customer_total); ?></div></td>
        <td>

        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">

function do_search(val)
{
    $('#search_term').val($('#'+val).val());
    $('#start_date').val($('#start_'+val+'_alt').val());
    $('#end_date').val($('#end_'+val+'_alt').val());
    $('#search_form').submit();
}

function do_export(val)
{
    $('#export_search_term').val($('#'+val).val());
    $('#export_start_date').val($('#start_'+val+'_alt').val());
    $('#export_end_date').val($('#end_'+val+'_alt').val());
    $('#export_form').submit();
}

function submit_form()
{
    if($(".gc_check:checked").length > 0)
    {
        return confirm('<?=lang('confirm_delete_order') ?>');
    }
    else
    {
        alert('<?=lang('error_no_orders_selected') ?>');
        return false;
    }
}

function save_status(id, customer_id)
{
    var status = $('#status_form_'+id).val();


    if($.trim(status.toLowerCase()) == 'cart'){
        alert('<?=lang('cart_status_error');?>');
        $('#status_form_'+id).val($('#status_form_'+id).attr('data-original'));
    }else{
        $('#status_form_'+id).attr('data-original', $('#status_form_'+id).val());
        data = {id: id, customer_id: customer_id, status: $('#status_form_'+id).val()};
        $.post("<?=site_url('admin/orders/edit_status_for_customer'); ?>", data, function(data){
            setTimeout(function(){
                message('success', status, 'Order Status Changed Succesfully.')
            }, 500);
        });
    }
}
</script>

<div id="saving_container" style="display:none;">
    <div id="saving" style="background-color:#000; position:fixed; width:100%; height:100%; top:0px; left:0px;z-index:100000"></div>
    <img id="saving_animation" src="<?=base_url('assets/img/storing_animation.gif');?>" alt="saving" style="z-index:100001; margin-left:-32px; margin-top:-32px; position:fixed; left:50%; top:50%"/>
    <div id="saving_text" style="text-align:center; width:100%; position:fixed; left:0px; top:50%; margin-top:40px; color:#fff; z-index:100001"><?=lang('saving');?></div>
</div>
