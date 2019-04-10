<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
