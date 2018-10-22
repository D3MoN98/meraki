<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['sign_in'] = 'view/view/sign_in';
$route['sign_up'] = 'view/view/sign_up';
$route['forget_password'] = 'view/view/forget_password';
$route['change_password'] = 'view/view/change_password';
$route['checkout'] = 'view/view/checkout';
$route['buynow/(:num)/(:any)'] = 'product/buynow/$1/$2';
$route['user/profile'] = 'view/view/profile';
$route['order_history'] = 'view/view/order_history';
$route['contact_us'] = 'view/view/contact_us';
$route['about_us'] = 'view/view/about_us';
$route['terms_and_conditions'] = 'view/view/terms_and_conditions';
$route['privacy_policy'] = 'view/view/privacy_policy';
$route['campaign_directory'] = 'view/view/campaign_directory';
$route['dmca_notice'] = 'view/view/dmca_notice';
$route['interest_based_ads'] = 'view/view/interest_based_ads';
$route['admin/sign_in'] = 'admin/view/sign_in';
$route['admin/sign_up'] = 'admin/view/sign_up';
$route['admin/profile'] = 'admin/view/profile';
$route['seller/sign_in'] = 'seller/view/sign_in';
$route['seller/sign_up'] = 'seller/view/sign_up';
$route['seller/profile'] = 'seller/view/profile';
$route['seller/add_items'] = 'seller/view/add_items';
$route['seller/edit_items/(:num)'] = 'seller/view/edit_items/$1';
$route['product/(:num)'] = 'View/view/product/$1';
$route['products'] = 'view/products';
$route['order_details/(:num)'] = 'user/order_details/$1';
$route['invoice/(:num)'] = 'user/invoice/$1';

