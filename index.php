<?php
session_start();

require 'vendor/autoload.php';

$router = new App\Router\Router($_GET['url']);
use App\Tools\Helper;

<<<<<<< HEAD
$router = new App\Router\Router($_GET['url']);
=======
>>>>>>> 9515fa21b0f68464472814abbc0e4ce9420a513b

require_once "app/helper.php";
require_once "app/routes.php";

<<<<<<< HEAD
=======

/*

// match current request url
$match = $router->match();

// call closure or throw 404 status
if(is_array($match) && is_callable($match['target'])) {
		call_user_func_array( $match['target'], $match['params'] ); 
} else {
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
*/
>>>>>>> 9515fa21b0f68464472814abbc0e4ce9420a513b
