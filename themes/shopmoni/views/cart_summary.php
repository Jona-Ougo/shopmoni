<div class="st-default main-wrapper clearfix">
	<div class="block block-breadcrumbs clearfix">
		<ul>
			<li class="home">
				<a href="<?=site_url() ?>"><i class="fa fa-home"></i></a>
				<span></span>
			</li>
			<li>Cart Summary</li>
		</ul>
	</div>
	<div class="main-page">
		<h1 class="page-title">Shopping Cart Summary</h1>
		<div class="page-content page-order">
			<ul class="step">
				<li class="current-step"><span>01. Summary</span></li>
				<li><span>02. Sign in</span></li>
				<li><span>03. Address</span></li>
				<li><span>04. Shipping</span></li>
				<li><span>05. Payment</span></li>
			</ul>

			<?php 
			$cartItems 	= GC::getCartItems();
			$options	= CI::Orders()->getItemOptions(GC::getCart()->id);
			$charges	= [];

			$charges['giftCards'] 	= [];
			$charges['coupons'] 	= [];
			$charges['tax'] 		= [];
			$charges['shipping'] 	= [];
			$charges['products'] 	= [];

			foreach ($cartItems as $item){
				if($item->type == 'gift card'){
					$charges['giftCards'][] = $item;
					continue;
				}elseif($item->type == 'coupon'){
					$charges['coupons'][] = $item;
					continue;
				}elseif($item->type == 'tax'){
					$charges['tax'][] = $item;
					continue;
				}elseif($item->type == 'shipping'){
					$charges['shipping'][] = $item;
					continue;
				}elseif($item->type == 'product'){
					$charges['products'][] = $item;
				}
			}

			if(count($charges['products']) == 0){
				echo '<script>location.reload();</script>';
			}

			?>
			<div class="heading-counter warning">Your shopping cart contains
				<?php $count = GC::totalItems();?>
				<span><?=$count ?> <?=$count > 1 ? 'Products' : 'Product' ?></span>
			</div>

			<div class="order-detail-content table-responsive">
				<table class="cart_summary table">
					<thead>
						<tr>
							<th class="cart_product">Product</th>
							<th>Description</th>
							<th>status</th>
							<th>Unit price</th>
							<th>Qty</th>
							<th>Total</th>
							<th class="action"><i class="fa fa-trash-o"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($charges['products'] as $product): ?>
							<tr>

								<!-- image -->
								<td class="cart_product">
									<?php 
									$photo = base_url('uploads/images/thumbnails/no_picture.png');
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
									<img class="img-responsive" src="<?=$photo; ?>">
								</td>
								<!-- end of image -->


								<!-- description -->
								<td class="cart_description">
									<p class="product-name">
										<a href="<?=site_url('product/'.$product->slug) ?>">
											<?=$product->name ?>
										</a>
									</p>

									<?php if(!empty($product->sku)): ?>
										<small class="cart_ref">SKU : <?=$product->sku ?></small><br>
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

								</td>
								<!-- end of description -->



								<!-- status-->
								<td class="cart_avail">
									<?php 
									if((bool)$product->track_stock && $product->quantity < 1 && config_item('inventory_enabled')){
										$text = lang('out_of_stock');
										$class = 'danger';
									}elseif($product->saleprice > 0){
										$text = lang('on_sale');
										$class = 'success';
									}
									?>
									<span class="label label-<?=$class ?>"><?=$text ?></span>
								</td>
								<!-- end status -->

								<!-- price -->
								<td class="price"><span><?=productPrice($product) ?></span></td>
								<!-- end price -->

								<!-- quantity -->
								<td class="qty">
									<?php if($product->fixed_quantity == 0): ?>

										<input class="form-control input-sm" type="text" value="<?=$product->quantity ?>" id="qtyInput<?=$product->id ?>" readonly>
										<a href="javascript:void(0);" onclick="plus(<?=$product->id ?>)">
											<i class="fa fa-caret-up"></i>
										</a>
										<a href="javascript:void(0);" onclick="minus(<?=$product->id ?>)">
											<i class="fa fa-caret-down"></i>
										</a>
									<?php else: ?>
										<?=$product->quantity ?>
									<?php endif; ?>
								</td>
								<!-- end quantity -->

								<!-- total -->
								<td class="price">
									<span><?=format_currency($product->total_price * $product->quantity) ?></span>
								</td>
								<!-- end total -->

								<!-- delete -->
								<td class="action" onclick="updateItem(<?=$product->id ?>, 0)" style="cursor:pointer">
									<a href="javascript:void(0);">Delete item</a>
								</td>
								<!-- end delete -->

							</tr>
						<?php endforeach; ?>
					</tbody>

					<tfoot>
						<!-- cart totals -->
						<tr>
							<td colspan="2" ></td>
							<td colspan="2">Cart Totals </td>
							<td colspan="3"><?=format_currency(GC::getSubtotal()) ?></td>
						</tr>
						<!-- end cart totals -->

						<!-- cart shipping -->
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
						<!-- end  cart shipping -->

						<!-- tax -->
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
						<!-- end tax -->

						<!-- giftcards -->
						<?php foreach($charges['giftCards'] as $giftCard): ?>
							<tr>
								<td colspan="2" ></td>
								<td colspan="2"><?=lang('giftcards') ?></td>
								<td colspan="3">
									<?=$giftCard->name ?> - <small>(<?=$giftCard->description ?>)</small> 
									<?=format_currency($giftCard->total_price) ?> 
									<i class="fa fa-window-close" onclick="updateItem(<?=$giftCard->id;?>, 0);" style="cursor:pointer; font-color:red"></i>
								</td>
							</tr>
						<?php endforeach; ?>
						<!-- end gift cards -->


						<!-- coupons -->
						<?php foreach($charges['coupons'] as $coupon): ?>
							<tr>
								<td colspan="2" ></td>
								<td colspan="2"><?=lang('coupon') ?></td>
								<td colspan="3">
									<?=$coupon->description ?>&nbsp;
									<i class="fa fa-window-close" onclick="updateItem(<?=$coupon->id;?>, 0);" style="cursor:pointer; font-color:red"></i>
								</td>
							</tr>
						<?php endforeach; ?>
						<!-- end coupons -->

						<!-- grand total -->
						<tr>
							<td colspan="2">&nbsp;</td>
							<td colspan="2"><strong><?=lang('grand_total') ?></strong></td>
							<td colspan="3"><strong><?=format_currency(GC::getGrandTotal()) ?></strong></td>
						</tr>
						<!-- end grand total -->

						<!-- submit coupon -->
						<tr>
							<td colspan="3">&nbsp;</td>
							<td colspan="4">
								<div class="input-group">
									<input type="text" id="coupon" class="form-control" placeholder="<?=lang('coupon_label') ?>">
									<a type="button" style="cursor:pointer" onclick="submitCoupon()" class="input-group-addon"><i class="fa fa-plus"></i></a>
								</div>
							</td>
						</tr>
						<!-- end submit coupone -->

						<!-- submit giftcard -->
						<tr>
							<td colspan="3">&nbsp;</td>
							<td colspan="4">
								<div class="input-group">
									<input type="text" id="giftcard" class="form-control" placeholder="<?=lang('gift_card_label') ?>">
									<a type="button" style="cursor:pointer" onclick="submitGiftCard()" class="input-group-addon"><i class="fa fa-plus"></i></a>
								</div>
							</td>
						</tr>
						<!-- end submit giftcard -->

					</tfoot>    
				</table>


				<div class="cart_navigation">
					<a class="button" href="<?=site_url() ?>"><i class="fa fa-angle-left"></i> Continue shopping </a>
					<a class="button pull-right" href="<?=site_url('checkout/login') ?>">Proceed to checkout <i class="fa fa-angle-right"></i></a>
				</div>


			</div>
		</div>
	</div>
</div>	
<?php include(__DIR__.'/includes/checkout_js.php') ?>