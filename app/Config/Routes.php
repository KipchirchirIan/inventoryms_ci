<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->match(['get', 'post'], 'superadmin/login', 'Superadmin\Dashboard::login');
$routes->get('superadmin', 'Superadmin\Dashboard::index');
$routes->get('superadmin/index', 'Superadmin\Dashboard::index');
$routes->get('superadmin/dashboard', 'Superadmin\Dashboard::index');
$routes->get('superadmin/admin', 'Superadmin\Admin::index');
$routes->get('superadmin/logout', 'Superadmin\Dashboard::logout');

$routes->get('/', 'Employee\Dashboard::index');
$routes->match(['get', 'post'], 'employee/login', 'Employee\Dashboard::login');
$routes->get('employee/', 'Employee\Dashboard::index');
$routes->get('employee/dashboard', 'Employee\Dashboard::index');
$routes->get('employee/index', 'Employee\Dashboard::index');
$routes->get('employee/employee/show/(:num)', 'Employee\Employee::show/$1');
$routes->get('employee/logout', 'Employee\Dashboard::logout');

$routes->match(['get', 'post'],'admin/login', 'Admin\Dashboard::login');
$routes->get('admin/', 'Admin\Dashboard::index');
$routes->get('admin/index', 'Admin\Dashboard::index');
$routes->get('admin/dashboard', 'Admin\Dashboard::index');
$routes->get('admin/employee/', 'Admin\Employee::index');
$routes->get('admin/employee/index', 'Admin\Employee::index');
$routes->get('admin/superadmin/index', 'Admin\Dashboard::index');
$routes->match(['get', 'post'], 'admin/employee/create', 'Admin\Employee::create');
$routes->get('admin/employee/edit/(:num)', 'Admin\Employee::edit/$1');
$routes->get('admin/employee/update/(:num)', 'Admin\Employee::update/$1');
$routes->get('admin/item/edit/(:num)', 'Admin\Item::edit/$1');
$routes->post('admin/item/update/(:num)', 'Admin\Item::update/$1');
$routes->get('admin/logout', 'Admin\Dashboard::logout');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
