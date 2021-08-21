<?php

$routes[] = ['GET|POST', '/admin/customers/export', 'GoCart\Controller\AdminCustomers#export'];
$routes[] = ['GET|POST', '/admin/my-customers/[:order_by]?/[:direction]?/[i:page]?', 'GoCart\Controller\AdminCustomers#index'];

//manifest
$classMap['GoCart\Controller\AdminCustomers'] = 'controllers/AdminCustomers.php';