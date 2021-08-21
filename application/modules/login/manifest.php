<?php

$routes[] = ['GET|POST', '/zeus', 'GoCart\Controller\ZeusLogin#login'];
$routes[] = ['GET|POST', '/zeus/login', 'GoCart\Controller\ZeusLogin#login'];
$routes[] = ['GET|POST', '/zeus/logout', 'GoCart\Controller\ZeusLogin#logout'];
$routes[] = ['GET|POST', '/zeus/forgot-password', 'GoCart\Controller\ZeusLogin#forgotPassword'];
$routes[] = ['GET|POST', '/login/[:redirect]?', 'GoCart\Controller\Login#login'];
$routes[] = ['GET|POST', '/logout', 'GoCart\Controller\Login#logout'];
$routes[] = ['GET|POST', '/forgot-password', 'GoCart\Controller\Login#forgotPassword'];
$routes[] = ['GET|POST', '/register', 'GoCart\Controller\Login#register'];
$routes[] = ['GET|POST', '/confirm-email/[:emailconfirmcode]', 'GoCart\Controller\Login#confirm_email'];
$routes[] = ['GET|POST', '/verify_email', 'GoCart\Controller\Login#verify_email'];
$routes[] = ['GET|POST', '/verify_phone', 'GoCart\Controller\Login#verify_phone'];
$routes[] = ['GET|POST', '/resend_email', 'GoCart\Controller\Login#resend_email'];