
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-3 col-lg-3">

            <div class="block block-vertical-menu">
                <div class="vertical-head">
                    <h5 class="vertical-title">Categories</h5>
                </div>
                <div class="vertical-menu-content">
                    <ul class="vertical-menu-list">
                        <?php
                        \CI::load()->helper('text');

                        $i = 0;

                        foreach($categories as $row):
                            $query = \CI::db()->where('parent_id', $row['id']);
                            $query = \CI::db()->order_by('sequence', 'ASC');
                            $query = \CI::db()->get('categories');
                            $subcat = $query->result_array();

                            ?>
                            <li class="vertical-menu<?=++$i ?>">
                                <a class="parent" href="<?=site_url('category/'.$row['slug']) ?>">
                                    <?=$row['name'] ?>
                                </a>
                                <div class="vertical-dropdown-menu">
                                    <div class="vertical-groups col-sm-12">
                                        <?=subcategory_loop($subcat); ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <li class="vertical-menu4">
                            <a class="parent" href="<?=site_url('category/general-marketplace') ?>">
                                Click here to see more...
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <br>
            <a href="<?=site_url('login') ?>" style="border: 1px solid red; border-radius:10px; padding:5px; margin-left:60px; text-align:center">
                <strong>SELL FOR FREE</strong>
            </a>

        </div>
        <div class="col-sm-8 col-md-9 col-lg-7">

            <div class="block-slider">
                <?php if (count($homeSlider) > 0) { ?>
                <ul id="lightSlider">

                    <?php foreach($homeSlider as $row): ?>
                        <li data-thumb="<?=base_url('uploads/'.$row->image) ?>">
                            <?php $blank = $row->new_window == 1 ? 'target="_blank"' : '' ?>
                            <a href="<?=$row->link ?>"  <?=$blank ?>>
                                <img src="<?=base_url('uploads/'.$row->image) ?>" alt="<?=$row->name ?>">
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php } else { ?>
                <div class="owl-carousel owl-theme">
                    <div class="item-video" style="height:300px;" data-merge="3">
                        <a class="owl-video" href="https://youtu.be/YVEX2Ydx8Iw"></a>
                    </div>
                    <div class="item-video" data-merge="3">
                        <a class="owl-video" href="https://youtu.be/AhgtoQIfuQ4"></a>
                    </div>

                </div>
                <?php } ?>

            </div>

        </div>
        <div class="col-sm-8 col-md-12 col-lg-2">
            <div class="block block-banner-owl kt-owl-carousel" data-margin="0" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":1},"1000":{"items":1}}'>

                <div class="page-banner">
                    <ul class="list-banner">
                        <?php foreach($homeSliderSide as $row): ?>
                            <?php $blank = $row->new_window == 1 ? 'target="_blank"' : '' ?>
                            <li>
                                <a href="<?=$row->link ?>" <?=$blank ?>>
                                    <img src="<?=base_url('uploads/'.$row->image) ?>" alt="<?=$row->name ?>">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="page-banner">
                    <ul class="list-banner">
                        <?php foreach($homeSliderSide as $row): ?>
                            <?php $blank = $row->new_window == 1 ? 'target="_blank"' : '' ?>
                            <li>
                                <a href="<?=$row->link ?>" <?=$blank ?>>
                                    <img src="<?=base_url('uploads/'.$row->image) ?>" alt="<?=$row->name ?>">
                                </a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-3">
            <?php include(__DIR__.'/includes/homepage_sidebar.php') ?>
        </div>
        <div class="col-sm-8 col-md-9">

            <div class="block3 block-new-arrivals">
                <div class="block-head clearfix">
                    <h3 class="block-title bt">Trending</h3>
                    <ul class="nav-tab default dt">
                        <li class="active"><a data-toggle="tab" href="#tab-1" data-tit="Trending">Trending Now</a></li>
                        <li><a data-toggle="tab" href="#tab-2" data-tit="Best Sellers">Bestsellers </a></li>
                        <li><a data-toggle="tab" href="#tab-3" data-tit="Sales/Promos">Sales/Promos</a></li>
                    </ul>
                </div>
                <div class="block-inner bi">
                    <div class="tab-container">
                        <div id="tab-1" class="tab-panel active">
                            <ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"768":{"items":2},"1000":{"items":3},"1200":{"items":4},"loop":true}'>
                                <?php $products = $trending; ?>
                                <?php include(__DIR__.'/includes/homepage_products.php') ?>
                            </ul>
                        </div>
                        <div id="tab-2" class="tab-panel">
                            <ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"768":{"items":2},"1000":{"items":3},"1200":{"items":4}}'>
                                <?php $products = $topsearched; //Todo ?>
                                <?php include(__DIR__.'/includes/homepage_products.php') ?>
                            </ul>
                        </div>
                        <div id="tab-3" class="tab-panel">
                            <ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"768":{"items":2},"1000":{"items":3},"1200":{"items":4}}'>
                                <?php $products = $trending; ?>
                                <?php include(__DIR__.'/includes/homepage_products.php') ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="block-footer">
                    <div class="slidebox" style="margin: 2%;width: 96%;">
                        <iframe width="100%" height="415" src="https://www.youtube.com/embed/U6V9GpanvGc?showinfo=0&loop=1&autoplay=1&mute=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
            </div>



            <div class="group-banner3 banner-hover">

                <?php if(count($homeBannerCol12) > 0): ?>
                    <div class="row slidebox">
                        <ul>
                            <?php foreach($homeBannerCol12 as $row): ?>
                                <?php $blank = $row->new_window == 1 ? 'target="_blank"' : '' ?>
                                <li>
                                    <div>
                                        <a href="<?=$row->link ?>" <?=$blank ?>>
                                            <img src="<?= base_url('uploads/'.$row->image) ?>" alt="<?=$row->name ?>">
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php
                    if(count($homeBannerColX) > 0):
                        $count = count($homeBannerColX);
                        if($count <= 2){
                            $class = 6;
                        }elseif($count <=3){
                            $class = 4;
                        }elseif($count <=4){
                            $class = 3;
                        }elseif($count <= 6){
                            $class = 2;
                        }else{
                            $class = 12;
                        }
                        ?>
                        <ul>
                            <?php foreach($homeBannerColX as $row): ?>
                                <?php $blank = $row->new_window == 1 ? 'target="_blank"' : '' ?>
                                <li>
                                    <div class="col-md<?=$class ?> col-sm<?=$class ?> col-xs-<?=$class ?>" <?=$blank ?>">
                                        <a href="<?=$row->link ?>" <?=$blank ?>>
                                            <img src="<?= base_url('uploads/'.$row->image) ?>" alt="<?=$row->name ?>">
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </div>
            </div>


        </div>
    </div>
</div>
