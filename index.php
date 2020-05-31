<?php
session_start();

require 'vendor/autoload.php';

$router = new App\Router\Router($_GET['url']);
use App\Tools\Helper;

require_once "app/helper.php";
require_once "app/routes.php";


