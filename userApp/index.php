<?php

use Illuminate\Http\Request;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../../../../laraveles/firstUserApp/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
//require __DIR__.'/../vendor/autoload.php';
require '/var/laraveles/firstUserApp/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../../../../laraveles/firstUserApp/bootstrap/app.php')
    ->handleRequest(Request::capture());