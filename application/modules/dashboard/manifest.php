<?php

$routes[] = ['GET', '/admin/dashboard', 'GoCart\Controller\AdminDashboard#dashboard'];
$routes[] = ['GET', '/admin', 'GoCart\Controller\AdminDashboard#index'];
$routes[] = ['GET', '/admin/setup', 'GoCart\Controller\AdminDashboard#setup'];
