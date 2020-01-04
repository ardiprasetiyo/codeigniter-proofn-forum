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
$route['default_controller'] = 'beranda';
$route['404_override'] = 'NotFound/index';
$route['translate_uri_dashes'] = FALSE;
$route['signup'] = 'signup/index';
$route['admin/'] = 'admin/index';
$route['admin/logout'] = 'admin/logout';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/feedback'] = 'admin/feedback_view';
$route['admin/member'] = 'admin/member_view';
$route['admin/getDetailMember'] = 'admin/getDetailMember';
$route['admin/getmember/all'] = 'admin/getAllMember';
$route['admin/getMemberFeedback'] = 'admin/getFeedbackMember';
$route['admin/getMemberForum'] = 'admin/getForumMember';
$route['admin/create-category'] = 'admin/tambahKategori';
$route['admin/delete-category/id/(:num)'] = 'admin/hapusKategori/$1';
$route['admin/getCategories/all'] = 'admin/getAllKategori';
$route['admin/getSuggest/all'] = 'admin/getAllSuggest';
$route['admin/getSuggestDetail/id/(:num)'] = 'admin/getDetailSuggest/$1';
$route['admin/getReport/all'] = 'admin/getAllReport/';
$route['admin/getReportDetail'] = 'admin/getDetailReport';
$route['admin/updateSuggestResponse'] = 'admin/updateSuggestStatus/';
$route['admin/updateReportResponse'] = 'admin/updateReportStatus/';
$route['signup/daftar'] = 'signup/daftarAkun';
$route['feedback'] = 'feedback/index';
$route['logout'] = 'profile/logout';
$route['feedback/kirim'] = 'feedback/kirim';
$route['profile/'] = "profile/index";
$route['profile/updateInfo'] = "profile/updateProfile";
$route['forum/'] = 'forum/index';
$route['forum/member/id/(:num)/(:any)'] = 'forum/members/$1/$2';
$route['forum/mythread/'] = "forum/mythread/";
$route['forum/topik/id/(:num)'] = "forum/thread/$1";
$route['forum/topik/edit/id/(:num)/(:num)'] = "forum/editThread/$1/$2";
$route['forum/createthread/kategori/(:num)'] = "forum/newthread/$1";
$route['forum/createthread/post'] = "forum/makethread/$1";
$route['forum/updatethread/id/(:num)'] = "forum/updatethread/$1";
$route['forum/editprofile'] = "forum/editProfile";
$route['forum/updateProfile'] = "forum/updateProfile";
$route['forum/topik/postsubmit'] = "forum/postSent";
$route['forum/topik/submit-vote/post/(:num)/thread/(:num)'] = "forum/votepost/$1/$2";
$route['forum/topik/markAnswer/post/(:num)/thread/(:num)'] = "forum/markBestAnswer/$1/$2";
$route['forum/topik/unvote/post/(:num)/thread/(:num)'] = "forum/unvotepost/$1/$2";
$route['forum/topik/hapus-balasan/id/(:num)/(:num)'] = "forum/hapusbalasan/$1/$2";
$route['forum/topik/hapus-topik/id/(:num)'] = "forum/hapusthread/$1";
$route['app/thread/balasan/(:num)'] = "forum/appThreadBalasan/$1";
$route['app/forum/search/category/(:num)'] = "forum/appSearch/$1/$2";
$route['app/thread/test-connect'] = "forum/appThreadTest";


