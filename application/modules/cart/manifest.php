<?php
$routes[] = ['GET|POST', '/cart/summary', 'GoCart\Controller\Cart#summary'];
$routes[] = ['GET|POST', '/cart/add-to-cart', 'GoCart\Controller\Cart#addToCart'];
$routes[] = ['GET|POST', '/cart/update-cart', 'GoCart\Controller\Cart#updateCart'];
$routes[] = ['GET|POST', '/cart/submit-coupon', 'GoCart\Controller\Cart#submitCoupon'];
$routes[] = ['GET|POST', '/cart/submit-gift-card', 'GoCart\Controller\Cart#submitGiftCard'];
$routes[] = ['GET|POST', '/cart/add-to-wish-list/[:productId]', 'GoCart\Controller\Cart#addToWishList'];
$routes[] = ['GET|POST', '/cart/wishlist', 'GoCart\Controller\Cart#myWishList'];