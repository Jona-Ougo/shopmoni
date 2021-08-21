<?php 

$routes[] = ['GET|POST', '/shop/[:user]?', 'GoCart\Controller\ShopController#index'];
$routes[] = ['GET|POST', '/store/[:slug]/[:sort]?/[:dir]?/[:page]?', 'GoCart\Controller\ShopController#store'];
