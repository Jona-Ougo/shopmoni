<?php

$routes[] = ['GET|POST', '/admin/users', 'GoCart\Controller\AdminUsers#index'];
$routes[] = ['GET|POST', '/admin/users/form/[i:id]?', 'GoCart\Controller\AdminUsers#form'];
$routes[] = ['GET|POST', '/admin/users/delete/[i:id]', 'GoCart\Controller\AdminUsers#delete'];
$routes[] = ['GET|POST', '/admin/users/groups', 'GoCart\Controller\AdminUsers#groups'];
$routes[] = ['GET|POST', '/admin/users/groups/form/[i:id]?', 'GoCart\Controller\AdminUsers#group_form'];
$routes[] = ['GET|POST', '/admin/users/groups/permissions/[i:id]?', 'GoCart\Controller\AdminUsers#group_permissions'];