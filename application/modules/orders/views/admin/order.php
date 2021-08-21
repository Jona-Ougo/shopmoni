<div class="page-header">
    <h1><?=lang('order');?>: <?=$order->order_number;?></h1>
</div>
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-primary" href="<?=site_url('admin/orders/packing_slip/'.$order->order_number);?>" target="_blank"><i class="icon-file"></i> <?=lang('packing_slip');?></a>
    </div>
    <div class="col-md-6 text-right">
        <a class="btn btn-danger" onclick="if(!confirm('<?=lang('confirm_delete_order');?>')) { return false; }" href="<?=site_url('admin/orders/delete/'.$order->id);?>" target="_blank"><i class="icon-cancel"></i> <?=lang('delete');?></a>
    </div>
</div>

<div style="margin:10px 0px;">
    <div class="row">

        <div class="col-md-3">
            <h3><?=lang('shipping_address');?></h3>
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
            </div>
            <div class="col-md-3">
                <h3><?=lang('billing_address');?></h3>
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
                </div>
                <div class="col-md-3">
                    <h3><?=lang('payment_method');?></h3>
                    <?php foreach($order->payments as $payment):?>
                        <div><?=$payment->description;?></div>
                    <?php endforeach;?>
                </div>
                <div class="col-md-3">
                    <?=form_open('admin/orders/order/'.$order->order_number);?>
                     <?php 
                        $customer       = \CI::Login()->customer();
                        $status         = 'Order Placed';
                        $notes          = ' ';
                        $where          = ['order_id'=>$order->id, 'customer_id'=>$customer->id];
                        $notes          = $status->status_notes;
                        $status         = \DB\DB::getRow('order_items', $where);
                        
                        ?>
                    <div class="form-group">
                        <label><?=lang('admin_notes');?></label>
                        <?=form_textarea(['name'=>'notes', 'class'=>'form-control', 'rows'=>2, 'value'=>set_value('notes', $notes)]);?>
                    </div>
                    <div class="form-group">
                       
                        <label><?=lang('status');?></label>
                        <div class="input-group">
                            <?=form_input(['id'=>'status_form_'.$order->id, 'name'=>'status', 'class'=>'form-control', 'value'=>set_value('status',$status)]);?>
                            <div class="input-group-btn">
                               <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                  <?php foreach(config_item('order_statuses') as $os):?>
                                     <li><a onclick="$('#status_form_<?=$order->id;?>').val('<?=$os;?>'); return false;"><?=$os;?></a></li>
                                 <?php endforeach;?>
                             </ul>
                         </div>
                     </div>
                 </div>

                 <input type="submit" class="btn btn-primary" value="<?=lang('update_order');?>"/>

             </form>
         </div>
     </div>
 </div>

 <h3><?=lang('order_items');?></h3>
 <?php
 $charges = [];
 $charges['giftCards'] = [];
 $charges['coupons'] = [];
 $charges['tax'] = [];
 $charges['shipping'] = [];
 $charges['products'] = [];
 $subTotal   = $grandTotal = 0.00;
 foreach ($order->items as $item)
 {
    $subTotal+= ($item->quantity * $item->total_price);
    if($item->type == 'gift card')
    {
        $charges['giftCards'][] = $item;
        continue;
    }
    elseif($item->type == 'coupon')
    {
        $charges['coupons'][] = $item;
        continue;
    }
    elseif($item->type == 'tax')
    {
        $charges['tax'][] = $item;
        continue;
    }
    elseif($item->type == 'shipping')
    {
        $charges['shipping'][] = $item;
        continue;
    }
    elseif($item->type == 'product')
    {
        $charges['products'][] = $item;
    }
}
?>

<table class="table">
    <tbody class="orderItems">
        <?php foreach($charges['products'] as $product):?>
            <tr>
                <td>
                    <strong><?=$product->name; ?></strong> <br>
                    <?=(!empty($product->sku))?'<small>'.lang('sku').': '.$product->sku.'</small>':''?>
                </td>
                <td>
                    <?php if(isset($order->options[$product->id])):
                    foreach($order->options[$product->id] as $option):?>
                    <div><strong><?=($product->is_giftcard) ? lang('gift_card_'.$option->option_name) : $option->option_name;?></strong> : <?php echo($option->price > 0)?'['.format_currency($option->price).']':'';?> <?=$option->value;?></div>
                <?php endforeach;
                endif;?>
            </td>
            <td>
                <div style="font-size:11px; color:#bbb;">
                    (<?=$product->quantity.'  &times; '.format_currency($product->total_price);?>)
                </div>
                <?php if(!empty($product->coupon_code)):?>
                    <div style="color:#990000; font-size:11px;">
                        <?=lang('coupon');?>: 
                        <?='-'.format_currency(($product->coupon_discount * $product->coupon_discount_quantity));?>
                    </div>
                <?php endif;?>
                <?=format_currency( ($product->total_price * $product->quantity) - ($product->coupon_discount * $product->coupon_discount_quantity) ); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
<tbody class="orderTotals">
    <tr>
        <td colspan="2"><?=lang('subtotal');?></td>
        <td><?=format_currency($subTotal); ?></td>
    </tr>

    <?php foreach($charges['shipping'] as $shipping):?>
        <tr>
            <td colspan="2">
                <?=lang('shipping');?>: <?=$shipping->name; ?>
            </td>
            <td colspan="2">
                <?=format_currency($shipping->total_price); ?>
            </td>
        </tr>
    <?php endforeach;?>

    <?php foreach($charges['tax'] as $tax):?>
        <tr>
            <td colspan="2">
                <?=$tax->name; ?>
            </td>
            <td colspan="2">
                <?=format_currency($tax->total_price); ?>
            </td>
        </tr>
    <?php endforeach;?>

    <?php foreach($charges['giftCards'] as $giftCard):?>
        <tr>
            <td colspan="2">
                <?=$giftCard->name; ?><br>
                <small>
                    <?=$giftCard->description; ?><br>
                    <?=$giftCard->excerpt; ?>
                </small>
            </td>

            <td colspan="2">
                <?=format_currency($giftCard->total_price); ?>
            </td>
        </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="2">
            <div style="font-size:17px;"><?=lang('total');?></div>
        </td>
        <td colspan="2">
            <div style="font-size:17px;"><?=format_currency($subTotal); ?></div>
        </td>
    </tr>
</tbody>
</table>
