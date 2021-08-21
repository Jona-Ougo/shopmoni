<?php

//routes
$routes[] = ['GET|POST', '/addresses', 'GoCart\Controller\Addresses#index'];
$routes[] = ['GET|POST', '/addresses/json', 'GoCart\Controller\Addresses#addressJSON'];
$routes[] = ['GET|POST', '/addresses/form/[i:id]?', 'GoCart\Controller\Addresses#form'];
$routes[] = ['GET|POST', '/addresses/address-form/[i:id]?', 'GoCart\Controller\Addresses#form_front'];
$routes[] = ['GET|POST', '/addresses/delete/[i:id]', 'GoCart\Controller\Addresses#delete'];
$routes[] = ['GET|POST', '/addresses/get-zone-options/[i:id]', 'GoCart\Controller\Addresses#getZoneOptions'];