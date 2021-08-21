<?php

$routes[] = ['GET|POST', '/admin/dhl/form', 'GoCart\Controller\AdminDhl#form'];
$routes[] = ['GET|POST', '/admin/dhl/install', 'GoCart\Controller\AdminDhl#install'];
$routes[] = ['GET|POST', '/admin/dhl/uninstall', 'GoCart\Controller\AdminDhl#uninstall'];

$shippingModules[] = ['name'=>'DHL', 'key'=>'dhl', 'class'=>'Dhl'];