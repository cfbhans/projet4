<?php
session_start();

require 'vendor/autoload.php';

use App\Tools\Helper;

$router = new App\Router\Router($_GET['url']);

require_once "app/helper.php";
require_once "app/routes.php";

