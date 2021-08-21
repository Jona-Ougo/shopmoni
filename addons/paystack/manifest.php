<?php

$routes[] = ['GET|POST', '/admin/paystack/form', 'GoCart\Controller\AdminPaystack#form'];
$routes[] = ['GET|POST', '/admin/paystack/install', 'GoCart\Controller\AdminPaystack#install'];
$routes[] = ['GET|POST', '/admin/paystack/uninstall', 'GoCart\Controller\AdminPaystack#uninstall'];
$routes[] = ['GET|POST', '/paystack/process-payment', 'GoCart\Controller\Paystack#processPayment'];
$routes[] = ['GET|POST', '/paystack/response', 'GoCart\Controller\Paystack#response'];

$paymentModules[] = ['name'=>'Paystack', 'key'=>'paystack', 'class'=>'Paystack'];