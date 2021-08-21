<div class="container">

    <div class="st-default main-wrapper clearfix">
        <div class="block block-breadcrumbs clearfix">
            <ul>
                <li class="home">
                    <a href="<?=site_url() ?>"><i class="fa fa-home"></i></a>
                    <span></span>
                </li>
                <li>Order Complete</li>
            </ul>
        </div>
        <div class="main-page">
            <h1 class="page-title">Order Summary</h1>
            <div class="page-content page-order">
                <?php 
                $charges    = [];

                $charges['giftCards']   = [];
                $charges['coupons']     = [];
                $charges['tax']         = [];
                $charges['shipping']    = [];
                $charges['products']    = [];

                foreach ($order->items as $item)
                {
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

                <div class="order-detail-content table-responsive">
                    <table class="cart_summary table">
                        <thead>
                            <tr>
                                <th class="cart_product">Product</th>
                                <th>Description</th>
                                <th>Unit price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($charges['products'] as $product): ?>
                                <tr>
                                    <td class="cart_product">
                                        <?php 
                                        $photo = base_url('uploads/images/thumbnails/no_picture.png');
                                        //dd($product->images);
                                        $images = json_decode($product->images);
                                        
                                        if(!empty($images)){
                                            foreach($images as $image){
                                                if(isset($image->primary)){
                                                    $primary = $image->filename;
                                                    continue;
                                                }
                                                $primary = $image->filename;
                                            }
                                            $photo = base_url('uploads/images/thumbnails/'.$primary);
                                        }
                                        ?>
                                        <a href="#">
                                            <img class="img-responsive" src="<?=$photo; ?>" width="40" height="40">
                                        </a>
                                    </td>
                                    <td class="cart_description">
                                        <p class="product-name"><a href="#"><?=$product->name ?></a></p>
                                        <?php if(!empty($product->sku)): ?>
                                            <small class="cart_ref">SKU : #<?=$product->sku ?></small><br>
                                        <?php endif ?>
                                        <?php if(!empty($product->coupon_code)): ?>
                                            <small class="cart_ref">
                                                <?=lang('coupon') ?> : 
                                                #<?=$product->coupon_code ?>
                                                <span style="color:red">-<?=format_currency($product->coupon_discount*$product->coupon_discount_quantity) ?></span>
                                            </small><br>
                                        <?php endif; ?>
                                        <?php if(isset($options[$product->id])): ?>
                                            <?php foreach($options[$product->id] as $option): ?>
                                                <small class="cart_ref"><?=$product->is_giftcard ? lang('gift_card_'.$option->option_name) : $option->option_name ?> : <?=$option->price > 0 ? '['.format_currency($option->price).']' : '' ?> <?=$option->value ?></small>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php 
                                        if(isset($order->files[$product->id]))
                                        {
                                            foreach($order->files[$product->id] as $file)
                                            {
                                                if($file->max_downloads == 0 || $file->downloads_used < $file->max_downloads)
                                                {
                                                    echo '<div class="well">'.anchor('digital-products/download/'.$file->id.'/'.$file->order_id, '<i class="icon-chevron-down"></i>', 'class="btn input-xs"');
                                                    echo ' '.$file->title.' <small>';
                                                    if($file->max_downloads > 0)
                                                    {
                                                        echo ' '.str_replace('{quantity}', ($file->max_downloads - $file->downloads_used), lang('downloads_remaining'));
                                                    }
                                                    else
                                                    {
                                                        echo ' '.str_replace('{quantity}', '&infin;', lang('downloads_remaining'));
                                                    }
                                                    echo '</small></div>';
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td class="price">
                                        <span><?=productPrice($product) ?></span>
                                    </td>
                                    <td class="qty">
                                        <?=$product->quantity ?>
                                    </td>
                                    <td class="price">
                                        <span>
                                            <?php 
                                            if(!empty($product->coupon_code)){
                                                echo lang('coupon').' ';
                                                echo '-'.format_currency($product->coupon_discount * $product->coupon_discount_quantity);
                                            }

                                            echo format_currency(($product->total_price * $product->quantity) - $product->coupon_discount * $product->coupon_discount_quantity);

                                            ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" ></td>
                                <td colspan="2"><?=lang('subtotal') ?></td>
                                <td colspan="3"><?=format_currency($order->subtotal) ?></td>
                            </tr>
                            <?php if(count($charges['shipping']) > 0 || count($charges['tax']) > 0): ?>
                                <?php foreach($charges['shipping'] as $shipping): ?>
                                    <tr>
                                        <td colspan="2" >&nbsp;</td>
                                        <td colspan="2"><?=lang('shipping') ?></td>
                                        <td colspan="3">
                                            <?=$shipping->name ?> - 
                                            <?=format_currency($shipping->total_price) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php foreach($charges['tax'] as $tax): ?>
                                <tr>
                                    <td colspan="2" ></td>
                                    <td colspan="2"><?=lang('taxes') ?></td>
                                    <td colspan="3">
                                        <?=$tax->name ?> - 
                                        <?=format_currency($tax->total_price) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php foreach($charges['giftCards'] as $giftCard): ?>
                                <tr>
                                    <td colspan="2" ></td>
                                    <td colspan="2"><?=lang('giftcards') ?></td>
                                    <td colspan="3">
                                        <?=$giftCard->name ?> - <small>(<?=$giftCard->description ?>)</small> 
                                        <?=format_currency($giftCard->total_price) ?> 
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <tr>
                                <td colspan="2">&nbsp;</td>
                                <td colspan="2"><strong><?=lang('grand_total') ?></strong></td>
                                <td colspan="3"><strong><?=format_currency($order->total) ?></strong></td>
                            </tr>
                        </tfoot>    
                    </table>
                    
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?=lang('shipping_address');?></h3>
                        </div>
                        <div class="panel-body">
                            <?php echo format_address([
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
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?=lang('billing_address');?></h3>
                            </div>
                            <div class="panel-body">
                                <?php echo format_address([
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
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?=lang('payment_information');?></h3>
                                </div>
                                <div class="panel-body">
                                 <?php foreach($order->payments as $payment):?>
                                    <div><?php echo $payment->description;?></div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="cart_navigation">
                    <a class="button" href="<?=site_url() ?>">
                        <i class="fa fa-angle-left"></i> 
                        Return to ShopMoni 
                    </a>
                </div>
                
            </div>
        </div>  
    </div>
