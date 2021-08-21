<div class="container product-page">
    
    <div class="st-default main-wrapper clearfix">
        <?=CI::breadcrumbs()->generate(); ?>
        <div class="row">
            <div class="col-sm-5">
                <?php $primaryLarge     = productPrimaryImage($product, 'full') ?>
                <?php $primaryMedium    = productPrimaryImage($product, 'medium') ?>
                <?php $primaryThumb     = productPrimaryImage($product, 'thumbnails') ?>
                <div class="block block-product-image">
                    <div class="product-image easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                        <a href="<?=$primaryLarge ?>">
                            <img src="<?=$primaryMedium ?>" alt="Product" width="450" height="450" />
                        </a>
                    </div>
                    <div class="text">Hover on the image to zoom</div>
                    <div class="product-list-thumb">
                        <ul class="thumbnails kt-owl-carousel" data-margin="10" data-nav="true" data-responsive='{"0":{"items":2},"600":{"items":2},"1000":{"items":3}}'>
                            <li>
                                <a class="selected" href="<?=$primaryLarge ?>" data-standard="<?=$primaryLarge ?>">
                                    <img src="<?=$primaryThumb ?>" alt="<?=$product->name ?>" />
                                </a>
                            </li>
                            <?php foreach($product->images as $image): ?>
                                <?php if($image['filename'] == $primaryLarge) continue; ?>
                                <?php $large    = base_url('uploads/images/full/'.$image['filename']) ?>
                                <?php $thumb    = base_url('uploads/images/thumbnails/'.$image['filename']) ?>
                                <?php $caption  = htmlentities(nl2br($image['caption'])); ?>
                                <li>
                                    <a href="<?=$large ?>" data-standard="<?=$large ?>">
                                        <img src="<?=$thumb ?>" alt="<?=$caption ?>" />
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-12 col-md-7">
                        <div class="block-product-info">
                            <h2 class="product-name"><?=$product->name ?></h2>
                            <?=productSaleStatus($product) ?>
                            <div class="price-box">
                                <span class="product-price"><?=productPrice($product) ?></span>
                                <?php if(!empty($customer['shop_info']->shop_slug)): ?>
                                <a href="<?=site_url('shop/'.$customer['shop_info']->shop_slug) ?>" class="pull-right" target="_blank">
                                    <i class="fa fa-globe"></i> Visit Merchant Store
                                </a>
                                <?php endif ?>
                            </div>
                            <div class="product-star">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                            <div class="desc">
                                <?=(new content_filter($product->excerpt))->display(); ?>
                            </div>

                            <?=form_open('cart/add-to-cart', 'id="add-to-cart"') ?>
                            <div class="variations-box">
                                <table class="variations-table">
                                    <?=productOptionsHtml($options, $posted_options) ?>
                                    <!-- some checks exists here. not done. check the electron theme -->
                                    <?php 
                                    if($product->fixed_quantity  == 1)
                                        $readonly = 'readonly';
                                    else
                                        $readonly = '';
                                    ?>
                                    <tr>
                                        <td class="table-label">Qty</td>
                                        <td class="table-value">
                                            <div class="box-qty">
                                                <?php  if($product->fixed_quantity  != 1): ?>
                                                    <a href="javascript:void(0);" class="quantity-minus" id="minus">-</a>
                                                <?php endif; ?>

                                                <input type="text" class="quantity" id="quantity" value="1" name="quantity" <?=$readonly ?>>
                                                <?php  if($product->fixed_quantity  != 1): ?>
                                                    <a href="javascript:void(0);" id="plus" class="quantity-plus">+</a>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <button class="button-radius btn-add-cart" onclick="addToCart($(this))">
                                                Buy
                                                <span class="icon"></span>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <input type="hidden" name="cartkey" value="<?=\CI::session()->flashdata('cartkey');?>" />
                            <input type="hidden" name="id" value="<?=$product->id?>"/>
                            <?=form_close() ?>
                            <div class="box-control-button">
                                <a class="link-wishlist" href="#">wishlist</a>
                                <a class="link-compare" href="#">Compare</a>
                                <a class="link-sendmail" href="#">Email to a Friend</a>
                                <a class="link-print" href="#">Print</a>
                            </div>
                        </div>
                    </div>
                    <?php //include(__DIR__.'/includes/product_sidebar.php') ?>
                </div>
            </div>
        </div>

        <!-- Product tab -->
        <div class="block block-tabs tab-left">
            <div class="block-head">
                <ul class="nav-tab clearfix">                                   
                    <li class="active"><a data-toggle="tab" href="#tab-1">description</a></li>
                    <!-- <li><a data-toggle="tab" href="#tab-2">Additional</a></li> -->
                    <li><a data-toggle="tab" href="#tab-3">Reviews</a></li>
                </ul>
            </div>
            <div class="block-inner">
                <div class="tab-container">
                    <div id="tab-1" class="tab-panel active">
                        <p><?=(new content_filter($product->description))->display();?></p>
                    </div>
                    <!-- <div id="tab-2" class="tab-panel">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Compositions</td>
                                    <td>Cotton</td>
                                </tr>
                                <tr>
                                    <td>Styles</td>
                                    <td>Girly</td>
                                </tr>
                                <tr>
                                    <td>Properties</td>
                                    <td>Colorful Dress</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->
                    <div id="tab-3" class="tab-panel">
                        <div id="reviews">
                            <h4 class="comments-title">1 review for "Cotton Lycra Leggings"</h4>
                            <ol class="comment-list">
                                <li class="comment">
                                    <div class="comment-avatar">
                                        <img src="<?=theme_url('data/avatar.jpg') ?>" alt="Avatar">
                                    </div>
                                    <div class="comment-content">
                                        <div class="comment-meta">
                                            <a href="#" class="comment-author">jon Conner</a>
                                            <span class="comment-date">March 14, 2013 at 8:03 am</span>
                                            <div class="review-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                        <div class="comment-entry">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                                        </div>
                                        <div class="comment-actions">
                                            <a class="comment-reply-link" href="#"><i class="fa fa-share"></i> Reply</a>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                            <div class="comment-form">
                                <h3 class="comment-reply-title">Leave a Review</h3>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <div class="rating">
                                    <label class="required">Your rating</label>
                                    <div class="form-rating">
                                        <label class="radio-inline">
                                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5"> 5
                                        </label>
                                    </div>
                                </div>
                                <p>
                                    <label class="required">Name</label>
                                    <input type="text">
                                </p>
                                <p>
                                    <label class="required">Email</label>
                                    <input type="text">
                                </p>
                                
                                <p>
                                    <label class="required">Comment</label>
                                    <textarea rows="5"></textarea>  
                                </p>
                                <p>
                                    <button class="button">Post review</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product tab -->


        <!-- Related Products -->
        <?php if(!empty($product->related_products)):?>
            <?php
            $relatedProducts = [];
            foreach($product->related_products as $related)
            {
                $related->images    = json_decode($related->images, true);
                $relatedProducts[] = $related;
            }

            \GoCart\Libraries\View::getInstance()->show('categories/related', ['products'=>$relatedProducts]); ?>

        <?php endif;?>
        <!-- ./Related Products -->
    </div>
    
</div>


<script>
    function addToCart(btn){
        btn.attr('disabled', true);
        var cart = $('#add-to-cart');
        $.post(cart.attr('action'), cart.serialize(), function(data){
            if(data.message != undefined){
                var link = "<a href='<?=site_url('checkout') ?>' style='color:#fff !important; text-decoration:underline'>View Cart</a>";
                if(data.message == 'This item is already in your cart!'){
                    message('warning', data.message+' '+link);
                }else{
                    message('success', data.message+' '+link);
                }
                updateItemCount(data.itemCount, data.subtotal);
                cart[0].reset();
            }
            else if(data.error != undefined){
                message('error', data.error);
            }

            btn.attr('disabled', false);
        }, 'json');
    }

    <?php  if($product->fixed_quantity  != 1): ?>
    $('#minus').click(function(){
        qty = $('#quantity').val();
        if(qty <= 1)
            return;

        $('#quantity').val(qty-1);
    })

    $('#plus').click(function(){
        qty = $('#quantity').val();
        $('#quantity').val(parseInt(qty)+1);
    })
<?php endif; ?>


</script>
