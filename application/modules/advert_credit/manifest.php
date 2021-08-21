<?php
/**
 * Created by PhpStorm.
 * User: kayode.oguntimehin
 * Date: 05/12/2017
 * Time: 11:15 PM
 */

$routes[] = ['GET', '/zeus/advert_credits', 'GoCart\Controller\ZeusAdvertCredits#index'];
$routes[] = ['GET|POST', '/zeus/advert_credit/add', 'GoCart\Controller\ZeusAdvertCredits#advert_credit_form'];
$routes[] = ['POST|PUT', '/zeus/advert_credit/edit', 'GoCart\Controller\ZeusAdvertCredits#edit_advert_credit'];
$routes[] = ['GET|POST', '/zeus/advert_credit/remove/[i:id]', 'GoCart\Controller\ZeusAdvertCredits#delete_advert_credit'];
