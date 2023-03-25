<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/formpayment', 'Home::formpayment');
$routes->get('/formpayment/(:any)', 'Home::formpayment/$1');
$routes->get('/success', 'Home::success');
$routes->post('/success', 'Home::success');
$routes->get('/failed', 'Home::failed');
$routes->get('/callback', 'Home::callback');
$routes->post('/rekappayment', 'Home::rekappayment');
$routes->get('/rekappage/(:any)', 'Home::rekappage/$1');
$routes->get('/cancelpayment/(:any)', 'Home::cancelpayment/$1');
$routes->get('/dopayment/(:any)', 'Home::dopayment/$1');

//route admin
$routes->get('/admin', 'Admin::index');
$routes->get('/login', 'Admin::login');
$routes->post('/auth', 'Admin::auth');
$routes->get('/logout', 'Admin::logout');
$routes->get('/verification', 'Admin::verification');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
