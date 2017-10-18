<?php
define("CATALOG", realpath(__DIR__.'/catalog') . '/');

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/system/config/db.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

define("PATH", dirname(__FILE__));

$router = new taskManager\system\core\Router();
$router->index();
