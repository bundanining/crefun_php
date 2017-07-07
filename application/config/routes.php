<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'user';
$route['board'] = 'board_c/list';
$route['/board/list/:num'] = 'board_c/detail/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

?>
