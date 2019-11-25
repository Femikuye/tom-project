<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//Admin Routes Starts
$route['admin'] = 'admin/adminhome';
$route['admin/setting'] = 'admin/adminhome/setting';
$route['admin/users'] = 'admin/adminhome/users';
$route['admin/new-admin'] = 'admin/adminhome/new_admin';
$route['admin/categories'] = 'admin/adminhome/categories';
$route['admin/pages'] = 'admin/adminhome/pages';
$route['admin/new-page'] = 'admin/adminhome/new_page';
$route['admin/edit-page/(:any)'] = 'admin/adminhome/edit_page/$1';
//Admin Routes Ends
// User Routes Start
$route['login'] = 'user/user';
$route['login/facebook'] = 'user/user/fb_login';
$route['login/google'] = 'user/user/google_login';
$route['register'] = 'user/user/register';
$route['account'] = 'user/account';
$route['account/confirm/(:any)'] = 'user/user/confirm/$1';
$route['account/password-recovery'] = 'user/user/pass_recovery';
$route['account/reset-password/(:any)'] = 'user/user/reset_password/$1';
$route['account/update-profile'] = 'user/account/profile_update';
$route['page/safety-tips'] = 'page/safety_tips';
$route['page/privacy-policy'] = 'page/privacy';
$route['ads/(:any)/(:any)'] = 'home/search/$1/$2';
$route['ads/(:any)/(:any)/(:num)'] = 'home/search/$1/$2/$3';
$route['ads/(:any)'] = 'home/search/$1';
$route['advert/searches'] = 'home/search_query';
$route['advert/searches/(:any)'] = 'home/search_query/$1';
$route['ads'] = 'home/search';
$route['ad/(:any)'] = 'home/ad/$1';
$route['account/post-ad'] = 'user/account/post_aid';
$route['account/edit-ad/(:any)'] = 'user/account/edit_aid/$1';
$route['account/preview-ad/(:any)'] = 'user/account/preview_aid/$1';
$route['account/my-ads'] = 'user/account/my_aids';
$route['page/(:any)'] = 'home/page/$1';
$route['account/logout'] = 'home/logout';
// User Routes Endsprivacy

// $route['login'] = 'user/login';
// $route['globe'] = 'home/globe';
// $route['register'] = 'user/login/register';
// $route['user/confirm/(:any)'] = 'user/login/confirm/$1';