<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['products/check_out'] = 'products/check_out';
$route['products/delete_cart/$1'] = 'products/delete_cart/$1';
$route['products/cart_view'] = 'products/cart_view';
$route['products/insert_cart'] = 'products/insert_cart';
$route['users/admin_view/'] = 'users/admin_view/';
$route['products/product_update'] = 'products/product_update';
$route['products/edit_product/$1'] = 'products/edit_product/$1';
$route['products/admin_view'] = 'products/admin_view';
$route['users/admin_home'] = 'users/admin_home';
$route['users/admin_login'] = 'users/admin_login';
$route['products/insert_cart/(:any)'] = 'products/insert_cart/$1';
$route['cart_view/(:any)'] = 'products/cart_view/$1';
$route['products/product_view'] = 'products/product_view';
$route['products/index'] = 'products/index';
$route['products/create'] = 'products/create';
$route['products/(:any)'] = 'products/view/$1';
$route['products'] = 'products/index';

$route['default_controller'] = 'pages/view';

$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
