<?php
$routes[] = ['GET|POST', '/my-account', 'GoCart\Controller\MyAccount#index'];
$routes[] = ['GET|POST', '/shop-update', 'GoCart\Controller\MyAccount#shopUpdate'];
$routes[] = ['GET|POST', '/my-orders', 'GoCart\Controller\MyAccount#myOrders'];
$routes[] = ['GET|POST', '/my-account/downloads', 'GoCart\Controller\MyAccount#downloads'];
$routes[] = ['GET|POST', '/my-conversations', 'GoCart\Controller\MyAccount#conversations'];
$routes[] = ['GET|POST', '/conversation-members', 'GoCart\Controller\MyAccount#conversation_members'];
$routes[] = ['GET|POST', '/shop-update', 'GoCart\Controller\MyAccount#shopUpdate'];
$routes[] = ['GET|POST', '/dropzone/[:field]', 'GoCart\Controller\MyAccount#dropzone'];

$routes[] = ['GET|POST', '/account', 'GoCart\Controller\UserAccount#index'];
$routes[] = ['GET|POST', '/turn-on-shop', 'GoCart\Controller\UserAccount#turn_on_shop'];
$routes[] = ['GET|POST', '/check-shop-name', 'GoCart\Controller\UserAccount#check_shop_name_ajax'];


