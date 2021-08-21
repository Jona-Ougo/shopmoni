    <div class="container">
        <div class="st-default main-wrapper clearfix">
            <?=CI::breadcrumbs()->generate(); ?>
            <div class="row">
            <?php include(__DIR__.'/categories/sidebar.php') ?>
                <div class="col-xs-12 col-sm-8 col-md-9">

                    <h3 class="page-title">
                        <span>My WishList</span>
                        <!-- <a href="#" class="button-radius compare-link">Compare<span class="icon"></span></a> -->
                    </h3>
                    <?php if(count($products) < 1): ?>
                        <h2>There are currently no products in your wish list <i class="fa fa-frown-o"></i></h2>
                    <?php else: ?>
                        <div class="sortPagiBar">
                        <!-- <ul class="display-product-option">
                            <li class="view-as-grid selected">
                                <span>grid</span>
                            </li>
                            <li class="view-as-list">
                                <span>list</span>
                            </li>
                        </ul> -->
                        <?php 
                        $config['first_link']       = '1';  
                        $config['first_tag_open']   = '<li>';
                        $config['first_tag_close']  = '</li>';   
                        $config['last_link']        = 'Last';   
                        $config['last_tag_open']    = '<li>';    
                        $config['last_tag_close']   = '</li>';
                        $config['full_tag_open']    = '<ul class="pagination">';
                        $config['full_tag_close']   = '</ul>'; 
                        $config['cur_tag_open']     = '<li class="active"><a href="#">';
                        $config['cur_tag_close']    = '</a></li>';

                        $config['num_tag_open']     = '<li>';    
                        $config['num_tag_close']    = '</li>';

                        $config['prev_link']        = '<i class="fa fa-angle-double-left"></i>';
                        $config['prev_tag_open']    = '<li>';
                        $config['prev_tag_close']   = '</li>';    
                        $config['next_link']        = '<i class="fa fa-angle-double-right"></i>';
                        $config['next_tag_open']    = '<li>';   
                        $config['next_tag_close']   = '</li>';
                        \CI::pagination()->initialize($config);
                        $pagination = CI::pagination()->create_links();
                        ?>
                        <div class="sortPagiBar-inner">
                            <nav><?=$pagination ?></nav>
                            <!-- <div class="show-product-item">
                                <select class="">
                                    <option value="1">Show 6</option>
                                    <option value="1">Show 12</option>
                                </select>
                            </div>
                        -->
                        <div class="sort-product">
                            <select id="sort" onchange="window.location=this.value">
                                <?php $selected = $sort == 'name' && $dir == 'ASC' ? 'selected' : '' ?>
                                <?php $value    = site_url('category/'.$slug.'/name/ASC/'.$page) ?>
                                <?php $text     = lang('sort_by_name_asc') ?>
                                <option value="<?=$value ?>"  <?=$selected ?>><?=$text ?></option>

                                <?php $selected = $sort == 'name' && $dir == 'DESC' ? 'selected' : '' ?>
                                <?php $value    = site_url('category/'.$slug.'/name/DESC/'.$page) ?>
                                <?php $text     = lang('sort_by_name_desc') ?>
                                <option value="<?=$value ?>"  <?=$selected ?>><?=$text ?></option>

                                <?php $selected = $sort == 'price' && $dir == 'ASC' ? 'selected' : '' ?>
                                <?php $value    = site_url('category/'.$slug.'/price/ASC/'.$page) ?>
                                <?php $text     = lang('sort_by_price_asc') ?>
                                <option value="<?=$value ?>"  <?=$selected ?>><?=$text ?></option>

                                <?php $selected = $sort == 'price' && $dir == 'DESC' ? 'selected' : '' ?>
                                <?php $value    = site_url('category/'.$slug.'/price/DESC/'.$page) ?>
                                <?php $text     = lang('sort_by_price_desc') ?>
                                <option value="<?=$value ?>"  <?=$selected ?>><?=$text ?></option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="category-products">
                    <?php include(__DIR__.'/categories/wishlist_products.php') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
