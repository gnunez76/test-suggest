<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
 |--------------------------------------------------------------------------
| Constantes definidas para el desarrollo
|--------------------------------------------------------------------------
|
| 
|
*/
// Numero de votos posibles de 1 a 10
define ('SI_ITEM_RATING_AVAILABE', 10);

// Comentario tipo REVIEW
define ('SI_REVIEW_COMMENT', 1);
// Comentario tipo REVIEW
define ('SI_COMMENT_COMMENT', 2);

// Numero de letras para el sumary
define ('SI_REVIEW_SUMMARY', 300);
define ('SI_COMMENT_SUMMARY', 300);


// HTML Permitido para la REVIEW y los COMENTARIOS
define ('SI_REVIEW_HTML_AVAILABLE', 'a');
define ('SI_COMMENT_HTML_AVAILABLE', 'p');


/* End of file constants.php */
/* Location: ./application/config/constants.php */

