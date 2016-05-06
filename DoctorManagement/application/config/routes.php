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
|$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'home';
$route['404_override'] = 'home';

// Browse page
$route['directory'] = 'browse/index';
$route['directory/(:any)'] = 'browse/index/$1';
$route['directory/backend'] = 'browse/Backend';

// Clinics page
$route['clinics/(:any)'] = 'clinics/index/$1';

// Community page
$route['community/(:any)'] = 'community/index/$1';
$route['community/comment'] = 'community/Comment';
$route['community/getcomments'] = 'community/GetComments';

// Doctors page
$route['doctors/(:any)'] = 'doctors/index/$1';
$route['doctors/(:any)/(:num)'] = 'doctors/index/$1/$2';
$route['doctors/browse'] = 'doctors/Browse';
$route['doctors/browsebyname'] = 'doctors/BrowseByName';
$route['doctors/getinfo'] = 'doctors/GetInfo';
$route['doctors/getsimilardoctors'] = 'doctors/GetSimilarDoctors';
$route['doctors/editprofile'] = 'doctors/EditProfile';

// Hotels page
$route['hotels/(:any)'] = 'hotels/index/$1';

// Search page
$route['search/(:any)/(:any)/(:any)/(:any)'] = 'search/index/$1/$2/$3/$4';
$route['search/(:any)/(:any)/(:any)'] = 'search/index/$1/$2/$3';
$route['search/(:any)/(:any)'] = 'search/index/$1/$2';
$route['search/(:any)'] = 'search/index/$1';
$route['search/backend'] = 'search/Backend';
$route['search/searchhotels'] = 'search/SearchHotels';
$route['search/searchdoctors'] = 'search/SearchDoctors';
               
//procedures
$route['procedures/(:any)'] = 'procedures/index/$1';
$route['procedures/backend'] = 'procedures/Backend';
$route['procedures/getprocedures'] = 'procedures/GetProcedures';

// Sitemap 
$route['sitemap\.xml'] = 'seo';

//admin
//Authorization
$route['admin_dev'] = 'admin_dev/authorization';
$route['admin_dev/login'] = 'admin_dev/authorization/login';
$route['admin_dev/logout'] = 'admin_dev/authorization/logout';
//doctors
$route['admin_dev/doctors'] = 'admin_dev/doctors/index';
$route['admin_dev/doctors/doctorssearch/(:any)'] = 'admin_dev/doctors/doctorsSearch/$1';
$route['admin_dev/doctor/add'] = 'admin_dev/doctors/add';
$route['admin_dev/doctor/addprocess'] = 'admin_dev/doctors/addProcess';
$route['admin_dev/doctor/edit/(:any)'] = 'admin_dev/doctors/edit/$1';
$route['admin_dev/doctor/editprocess/(:any)'] = 'admin_dev/doctors/editProcess/$1';
$route['admin_dev/doctor/del/(:any)'] = 'admin_dev/doctors/deleteDoctorById/$1';
$route['admin_dev/doctor/searchprocedures'] = 'admin_dev/doctors/searchProcedures';
$route['admin_dev/doctor/deletedoctorinfo'] = 'admin_dev/doctors/deleteInfo';
$route['admin_dev/doctor/saveimage'] = 'admin_dev/doctors/saveImage';
                                                                                  
$route['admin_dev/doctors/(:any)'] = 'admin_dev/doctors/getDoctorsByField/$1';



//admin_dev/procedures
$route['admin_dev/procedures/(:any)'] = 'admin_dev/procedures/index/$1';
$route['admin_dev/procedure/add'] = 'admin_dev/procedures/add';
$route['admin_dev/procedure/addprocess'] = 'admin_dev/procedures/addProcess';
$route['admin_dev/procedure/edit/(:any)'] = 'admin_dev/procedures/edit/$1';
$route['admin_dev/procedure/editprocess/(:any)'] = 'admin_dev/procedures/editProcess/$1';
$route['admin_dev/procedure/del/(:any)'] = 'admin_dev/procedures/deleteProcedureById/$1';

$route['admin_dev/ipblock'] = 'admin_dev/ipblock';
$route['admin_dev/ipblock/add'] = 'admin_dev/ipblock/add';
$route['admin_dev/ipblock/edit'] = 'admin_dev/ipblock/edit';
$route['admin_dev/ipblock/delete'] = 'admin_dev/ipblock/delete';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
