<?php 

$routes[]	= ['GET', '/zeus/dashboard', 'GoCart\Controller\ZeusDashboard#index'];
$routes[] 	= ['GET', '/zeus/admin-login-audit', 'GoCart\Controller\ZeusDashboard#loginAudit'];
//$themeShortcodes[] = ['shortcode'=>'featured', 'method'=>['GoCart\Controller\Development', 'featuredProducts']];

//Zeus Orders
$routes[] = ['GET|POST', '/zeus/orders/form/[i:id]?', 'GoCart\Controller\ZeusOrders#form'];
$routes[] = ['GET|POST', '/zeus/orders/export', 'GoCart\Controller\ZeusOrders#export'];
$routes[] = ['GET|POST', '/zeus/orders/bulk_delete', 'GoCart\Controller\ZeusOrders#bulk_delete'];
$routes[] = ['GET|POST', '/zeus/orders/order/[:orderNumber]', 'GoCart\Controller\ZeusOrders#order'];
$routes[] = ['GET|POST', '/zeus/orders/sendNotification/[:orderNumber]', 'GoCart\Controller\ZeusOrders#sendNotification'];
$routes[] = ['GET|POST', '/zeus/orders/packing_slip/[:orderNumber]', 'GoCart\Controller\ZeusOrders#packing_slip'];
$routes[] = ['GET|POST', '/zeus/orders/edit_status', 'GoCart\Controller\ZeusOrders#edit_status'];
$routes[] = ['GET|POST', '/zeus/orders/edit_status_for_customer', 'GoCart\Controller\ZeusOrders#edit_status_for_customer'];
$routes[] = ['GET|POST', '/zeus/orders/delete/[i:id]', 'GoCart\Controller\ZeusOrders#delete'];
$routes[] = ['GET|POST', '/zeus/orders', 'GoCart\Controller\ZeusOrders#index'];
$routes[] = ['GET|POST', '/zeus/orders/index/[:orderBy]?/[:orderDir]?/[:code]?/[i:page]?', 'GoCart\Controller\ZeusOrders#index'];
$routes[] = ['GET|POST', '/digital-products/download/[i:fileId]/[i:orderId]', 'GoCart\Controller\DigitalProducts#download'];


//Zeus Products
$routes[] = ['GET|POST', '/zeus/products/product_autocomplete', 'GoCart\Controller\ZeusProducts#product_autocomplete'];
$routes[] = ['GET|POST', '/zeus/products/bulk_save', 'GoCart\Controller\ZeusProducts#bulk_save'];
$routes[] = ['GET|POST', '/zeus/products/product_image_form', 'GoCart\Controller\ZeusProducts#product_image_form'];
$routes[] = ['GET|POST', '/zeus/products/product_image_upload', 'GoCart\Controller\ZeusProducts#product_image_upload'];
$routes[] = ['GET|POST', '/zeus/products/form/[i:id]?/[i:copy]?', 'GoCart\Controller\ZeusProducts#form'];
$routes[] = ['GET|POST', '/zeus/products/gift-card-form/[i:id]?/[i:copy]?', 'GoCart\Controller\ZeusProducts#giftCardForm'];
$routes[] = ['GET|POST', '/zeus/products/delete/[i:id]', 'GoCart\Controller\ZeusProducts#delete'];
$routes[] = ['GET|POST', '/zeus/products/[i:rows]?/[:order_by]?/[:sort_order]?/[:code]?/[i:page]?', 'GoCart\Controller\ZeusProducts#index'];
$routes[] = ['GET|POST', '/zeus/category-children/[i:id]?/[i:product_id]?', 'GoCart\Controller\ZeusProducts#CategoryChildren'];



//Zeus Customers
$routes[] = ['GET|POST', '/zeus/customers/export', 'GoCart\Controller\ZeusCustomers#export'];
$routes[] = ['GET|POST', '/zeus/customers/get_subscriber_list', 'GoCart\Controller\ZeusCustomers#getSubscriberList'];
$routes[] = ['GET|POST', '/zeus/customers/form/[i:id]?', 'GoCart\Controller\ZeusCustomers#form'];
$routes[] = ['GET|POST', '/zeus/customers/addresses/[i:id]', 'GoCart\Controller\ZeusCustomers#addresses'];
$routes[] = ['GET|POST', '/zeus/customers/delete/[i:id]?', 'GoCart\Controller\ZeusCustomers#delete'];
$routes[] = ['GET|POST', '/zeus/customers/groups', 'GoCart\Controller\ZeusCustomers#groups'];
$routes[] = ['GET|POST', '/zeus/customers/group_form/[i:id]?', 'GoCart\Controller\ZeusCustomers#groupForm'];
$routes[] = ['GET|POST', '/zeus/customers/delete_group/[i:id]?', 'GoCart\Controller\ZeusCustomers#deleteGroup'];
$routes[] = ['GET|POST', '/zeus/customers/address_list/[i:id]?', 'GoCart\Controller\ZeusCustomers#addressList'];
$routes[] = ['GET|POST', '/zeus/customers/address_form/[i:customer_id]/[i:id]?', 'GoCart\Controller\ZeusCustomers#addressForm'];
$routes[] = ['GET|POST', '/zeus/customers/delete_address/[i:customer_id]/[i:id]', 'GoCart\Controller\ZeusCustomers#deleteAddress'];
$routes[] = ['GET|POST', '/zeus/customers/[:order_by]?/[:direction]?/[i:page]?', 'GoCart\Controller\ZeusCustomers#index'];
$routes[] = ['GET|POST', '/zeus/my-customers/[:order_by]?/[:direction]?/[i:page]?', 'GoCart\Controller\ZeusCustomers#shopCustomers'];
$routes[] = ['GET|POST', '/zeus/customers-login-audit', 'GoCart\Controller\ZeusCustomers#loginAudit'];

//Customers
$classMap['GoCart\Controller\ZeusCustomers'] = 'controllers/ZeusCustomers.php';

//Reports
$routes[] = ['GET|POST', '/zeus/reports', 'GoCart\Controller\ZeusReports#index'];
$routes[] = ['GET|POST', '/zeus/reports/best_sellers', 'GoCart\Controller\ZeusReports#best_sellers'];
$routes[] = ['GET|POST', '/zeus/reports/sales', 'GoCart\Controller\ZeusReports#sales'];
