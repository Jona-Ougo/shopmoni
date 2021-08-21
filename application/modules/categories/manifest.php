<?php

$routes[] = ['GET', '/admin/categories', 'GoCart\Controller\AdminCategories#index'];
$routes[] = ['GET|POST', '/admin/categories/form/[i:id]?', 'GoCart\Controller\AdminCategories#form'];
$routes[] = ['GET|POST', '/admin/categories/delete/[i:id]', 'GoCart\Controller\AdminCategories#delete'];
$routes[] = ['GET|POST', '/category/[:slug]/[:sort]?/[:dir]?/[:page]?', 'GoCart\Controller\Category#index'];
$routes[] = ['GET|POST', '/filter/[:type]/[:value]/[:sort]?/[:dir]?/[:page]?','GoCart\Controller\Category#filter'];

$routes[] = ['GET', '/admin/category_filters', 'GoCart\Controller\AdminCategories#category_filters'];
$routes[] = ['GET|POST', '/admin/category_filter/[:id]?', 'GoCart\Controller\AdminCategories#category_filter'];
$routes[] = ['GET|POST', '/admin/category_filter_form/[:id]?', 'GoCart\Controller\AdminCategories#category_filter_form'];
$routes[] = ['GET|POST', '/admin/categories/bulk', 'GoCart\Controller\AdminCategories#bulk'];
$routes[] = ['GET|POST', '/admin/categories/process_bulk', 'GoCart\Controller\AdminCategories#process_bulk'];


$themeShortcodes[] = ['shortcode'=>'category', 'method'=>['GoCart\Controller\Category', 'shortcode']];