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

$route['default_controller'] = 'suggestit';




/*
$route['bgg_user_interface/(:any)/(:any)'] = 'bgg_user_interface/index/$1/$2';
$route['bgg_user_interface'] = 'bgg_user_interface';
$route['bgg_connect/(:any)/(:any)'] = 'bgg_connect/index/$1/$2';
$route['bgg_connect'] = 'bgg_connect';
$route['demogrocery/(:any)'] = 'demogrocery/$1';
$route['hauth/(:any)/(:any)/(:any)'] = 'hauth/$1/$2/$3';
$route['hauth/(:any)/(:any)'] = 'hauth/$1/$2';
$route['hauth/(:any)'] = 'hauth/$1';
$route['hauth'] = 'hauth';
*/


$route['(en|es|ca)/juego/getuserrating/(:any)'] = 'item/getuserrating/$2';
$route['(en|es|ca)/juego/rateitem/(:any)/(:any)'] = 'item/rateitem/$2/$3';
$route['(en|es|ca)/juego/autor'] = 'item/autor';
$route['(en|es|ca)/juego/buscador'] = 'item/buscador';

/*
$route['juego/getuserrating/(:any)'] = 'item/getuserrating/$1';
$route['juego/rateitem/(:any)/(:any)'] = 'item/rateitem/$1/$2';
$route['juego/autor'] = 'item/autor';
$route['juego/buscador'] = 'item/buscador';
*/

$route['(en|es|ca)/juego/(:any)/(:any)'] = 'item/index/$3';
$route['(en|es|ca)/juego/(:any)'] = 'item/index/$2';


$route['^(en|es|ca)/(.+)$'] = "$2";
$route['^(en|es|ca)$'] = $route['default_controller'];

/* No parece necesario 
$route['comments/getItemComments/(:any)'] = 'comments/getitemcomments/$1';
$route['comments/insertItemComment'] = 'comments/insertItemComment';
*/

$route['bgg_connect/(:any)/(:any)'] = 'bgg_connect/index/$1/$2';
$route['bgg_connect'] = 'bgg_connect';




/* End of file routes.php */
/* Location: ./application/config/routes.php */
