<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['seller'] = 'seller/home';
$route['admin'] = 'admin/dashboard';
$route['buyer'] = 'buyer/dashboard';
$route['404_override'] = '';

//--------------Web Pages---------------------//
$route['about-us'] = "home/index/about-us";
$route['contact-us'] = "home/index/contact-us";
$route['shipping'] = "home/index/shipping";
$route['warrantee'] = "home/index/warrantee";
$route['services'] = "home/index/services";
$route['support'] = "home/index/support";
$route['cancellation-and-return'] = "home/index/cancellation-and-return";
$route['payment-method'] = "home/index/payment-method";
$route['buyer-faq'] = "home/index/buyer-faq";
$route['terms-of-use'] = "home/index/terms-of-use";
$route['privacy-policy'] = "home/index/privacy-policy";
$route['our-team'] = "home/index/our-team";
$route['seller/seller-benefits'] = "seller/home/index/seller-benefits";
$route['seller/seller-contact'] = "seller/home/index/seller-contact";
$route['seller/seller-faq'] = "seller/home/index/seller-faq";
$route['seller/seller-policy-and-rule'] = "seller/home/index/seller-policy-and-rule";
$route['seller/seller-privacy-policy'] = "seller/home/index/seller-privacy-policy";
$route['seller/seller-agreement'] = "seller/home/index/seller-agreement";


/* End of file routes.php */
/* Location: ./application/config/routes.php */