<?php
$routes[] = ['GET|POST', '/chat/login', 'GoCart\Controller\Chat#login'];
$routes[] = ['GET|POST', '/chat/messages', 'GoCart\Controller\Chat#messages'];
$routes[] = ['GET|POST', '/chat/messages/[:conversation_id]', 'GoCart\Controller\Chat#messages'];
$routes[] = ['GET|POST', '/chat/savemessage', 'GoCart\Controller\Chat#savemessage'];
$routes[] = ['GET|POST', '/chat/savemessage/[:id]', 'GoCart\Controller\Chat#savemessage'];