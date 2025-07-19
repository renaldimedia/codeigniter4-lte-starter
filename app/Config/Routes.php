<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/parent/child-1', 'Home::child1');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'group:admin,superadmin'], static function ($routes) {
    $routes->get('/', 'User::index');
});

service('auth')->routes($routes);
