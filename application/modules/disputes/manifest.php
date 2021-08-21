<?php

$routes[] = ['POST|PUT', '/dispute/add', 'GoCart\Controller\Dispute#log_dispute'];
$routes[] = ['POST|PUT', '/dispute/logconversation', 'GoCart\Controller\Dispute#log_conversations'];
$routes[] = ['GET|POST', '/dispute-conversations/[:order_id]', 'GoCart\Controller\Dispute#disputeConversations'];
$routes[] = ['GET|POST', '/dispute/fetchconversations/[:order_id]', 'GoCart\Controller\Dispute#fetch_conversations'];

$routes[] = ['GET|POST', '/zeus/logconversation', 'GoCart\Controller\ZeusDispute#log_conversations'];
$routes[] = ['GET|POST', '/zeus/fetchconversations/[:order_id]', 'GoCart\Controller\ZeusDispute#fetch_conversations'];
$routes[] = ['GET|POST', '/zeus/fetchcustomer/[:user_id]', 'GoCart\Controller\ZeusDispute#fetchCustomer'];

$routes[] = ['GET|POST', '/admin/logconversation', 'GoCart\Controller\AdminDispute#log_conversations'];
$routes[] = ['GET|POST', '/admin/fetchconversations/[:order_id]', 'GoCart\Controller\AdminDispute#fetch_conversations'];