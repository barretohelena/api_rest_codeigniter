<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('api/login', 'Auth::login');

$routes->group('api', ['filter' => 'auth'], function($routes) {
    /*
     * CLIENTES
     * */
    $routes->get('clientes', 'Clientes::index');
    $routes->get('clientes/(:num)', 'Clientes::show/$1');
    $routes->post('clientes', 'Clientes::create');
    $routes->put('clientes/(:num)', 'Clientes::update/$1');
    $routes->delete('clientes/(:num)', 'Clientes::delete/$1');

    /*
     * PRODUTOS
     * */
    $routes->get('produtos', 'Produtos::index');
    $routes->get('produtos/(:num)', 'Produtos::show/$1');
    $routes->post('produtos', 'Produtos::create');
    $routes->put('produtos/(:num)', 'Produtos::update/$1');
    $routes->delete('produtos/(:num)', 'Produtos::delete/$1');

    /*
     * PEDIDOS
     * */
    $routes->get('pedidos', 'Pedidos::index');
    $routes->get('pedidos/(:num)', 'Pedidos::show/$1');
    $routes->post('pedidos', 'Pedidos::create');
    $routes->put('pedidos/(:num)', 'Pedidos::update/$1');
    $routes->delete('pedidos/(:num)', 'Pedidos::delete/$1');
});
