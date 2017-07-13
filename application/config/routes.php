<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'user';
$route['board'] = 'board_c';
$route['board/:num'] = 'board_c';
$route['board/write'] = 'board_c/write';
$route['board/delete/:num'] = 'board_c/delete/$1';
$route['board/list/:num'] = 'board_c/detail/$1';
$route['board/insert'] = 'board_c/insert';
$route['board/update/:num'] = 'board_c/update_view';
$route['board/update_post/:num'] = 'board_c/update_post';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

?>
