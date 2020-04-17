<?php
session_start();

require 'vendor/autoload.php';
//include 'laodEnv.php';

use App\Tools\Helper;

$router = new AltoRouter();
//$router->setBasePath('/celine-fafin.projet4/');
//$router->setBasePath('/');

require_once "app/helper.php";
require_once "app/routes.php";

// match current request url
$match = $router->match();

// call closure or throw 404 status
if(is_array($match) && is_callable($match['target'])) {
		call_user_func_array( $match['target'], $match['params'] ); 
} else {
  	die('nothing found...');
	// no route was 
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
