<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/install', 'Install::index');
$routes->post('/install', 'Install::index'); // Para lidar com submissões de formulário