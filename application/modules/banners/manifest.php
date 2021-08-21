<?php

$routes[] = ['GET', '/zeus/banners', 'GoCart\Controller\ZeusBanners#index'];
$routes[] = ['GET|POST', '/zeus/banners/banner_collection_form/[i:id]?', 'GoCart\Controller\ZeusBanners#banner_collection_form'];
$routes[] = ['GET|POST', '/zeus/banners/delete_banner_collection/[i:id]', 'GoCart\Controller\ZeusBanners#delete_banner_collection'];
$routes[] = ['GET|POST', '/zeus/banners/banner_collection/[i:id]', 'GoCart\Controller\ZeusBanners#banner_collection'];
$routes[] = ['GET|POST', '/zeus/banners/banner_form/[i:banner_collection_id]/[i:id]?', 'GoCart\Controller\ZeusBanners#banner_form'];
$routes[] = ['GET|POST', '/zeus/banners/delete_banner/[i:id]', 'GoCart\Controller\ZeusBanners#delete_banner'];
$routes[] = ['GET|POST', '/zeus/banners/organize', 'GoCart\Controller\ZeusBanners#organize'];
$routes[] = ['GET|POST', '/zeus/adverts/orders', 'GoCart\Controller\ZeusBanners#banner_orders'];
$routes[] = ['POST|PUT', '/banners/add', 'GoCart\Controller\Banners#addadvert'];

$themeShortcodes[] = ['shortcode'=>'banner', 'method'=>['Banners', 'show_collection']];