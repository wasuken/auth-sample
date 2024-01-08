<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('api', function($routes){
  $routes->get('/', 'Home::index', ['filter' => 'auth']);
  $routes->post('register', 'Register::index');
  $routes->post('login', 'Login::index');
});
