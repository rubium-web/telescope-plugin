<?php

use Illuminate\Routing\Router;
use Rubium\Telescope\Classes\Controllers\TelescopeFileController;

/** @var Router $router */
$router = resolve(Router::class);

$router->group([
    'prefix' => 'vendor/telescope',
], static function() use ($router) {
    $router->get('app.js', [TelescopeFileController::class, 'appJs']);

    $router->get('app.css', [TelescopeFileController::class, 'appCss']);
    
    $router->get('app-dark.css', [TelescopeFileController::class, 'appDarkCss']);

    $router->get('favicon.ico', [TelescopeFileController::class, 'favicon']);
});
