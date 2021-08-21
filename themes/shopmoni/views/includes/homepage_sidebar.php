

<div class="block block-specail3">
    <div class="block-head">
        <h4 class="widget-title">Top Searched</h4>
    </div>
    <div class="block-inner ts">
        <ul class="products kt-owl-carousel" data-margin="0" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"768":{"items":1},"autoPlay":true,"autoPlaySpeed":5000,"autoPlayTimeout":5000}'>
            <?php foreach($topsearched as $product): ?>
                <?php $url = site_url('product/'.$product->slug) ?>
                <li class="product">
                    <div class="product-container">
                        <div class="product-left">
                            <div class="product-thumb">
                                <a class="product-img" href="<?=$url ?>">
                                    <img src="<?=productPrimaryImage($product) ?>" alt="<?=$product->name ?>">
                                </a>
                                <a title="Quick View" href="<?=$url ?>" class="btn-quick-view">Quick View</a>
                            </div>
                            <?=productSaleStatus($product) ?>
                        </div>
                        <div class="product-right">
                            <div class="product-name">
                                <a href="<?=$url ?>"><?=character_limiter($product->name, 30) ?></a>
                            </div>
                            <div class="price-box">
                                <span class="product-price"><?=productPrice($product) ?></span>
                            </div>

                            <div class="product-button">
                                <a class="btn-add-wishlist" title="Add to Wishlist" href="javascript:void(0)" onclick="addToWishList(<?=$product->id ?>)">Add Wishlist</a>
                                <a class="button-radius btn-add-cart" href="<?=$url ?>">
                                    Buy<span class="icon"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<br>
<img src="<?=theme_url('data/nov/below_sidebar_homepage.gif') ?>" class="img img-responsive">

<!-- <div class="block block-top-review">
    <div class="block-head">
        <h4 class="widget-title">Top Merchants</h4>
    </div>
    <div class="block-inner">
        <div class="kt-owl-carousel" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"568":{"items":1},"768":{"items":1},"1000":{"items":1}}'>
            <ul class="list-product">
                <li class="product active">
                    <a class="product-name" href="#"><span class="order">1</span>Cotton Lycra Leggings</a>
                    <div class="product-info">
                        <div class="price-box">
                            <span class="product-price">$139.98</span>
                            <span class="product-price-old">$169.00</span>
                        </div>

                        <div class="product-img">
                            <a href="#"><img src="#" alt="Product"></a>
                        </div>
                    </div>
                </li>

                <li class="product">
                    <a class="product-name" href="#"><span class="order">3</span>Cotton Lycra Leggings</a>
                    <div class="product-info">
                        <div class="price-box">
                            <span class="product-price">$139.98</span>
                            <span class="product-price-old">$169.00</span>
                        </div>
                        <div class="product-star">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                        <div class="product-img">
                            <a href="#"><img src="#" alt="Product"></a>
                        </div>
                    </div>
                </li>


            </ul>
            <ul class="list-product"></ul>
        </div>
    </div>
</div> -->


