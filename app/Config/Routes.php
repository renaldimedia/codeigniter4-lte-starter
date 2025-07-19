<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/parent/child-1', 'Home::child1');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'group:admin,superadmin'], static function ($routes) {
    $routes->group('user', static function($routes){
        $routes->get('', 'UserController::index');
        $routes->get('(:num)', 'UserController::detail/$1');
        $routes->get('add', 'UserController::form');
        $routes->post('', 'UserController::create');
        $routes->get('edit/(:num)', 'UserController::form/$1');
        $routes->put('(:num)', 'UserController::update/$1');
        $routes->delete('(:num)', 'UserController::update/$1');
    });
});
// $_COOKIE['user::index'];
// $
service('auth')->routes($routes);
