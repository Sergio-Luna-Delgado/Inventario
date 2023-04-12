<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\CategoryController;
use Controllers\LoginController;
use Controllers\DashboardController;
use Controllers\ProductController;
use Controllers\SaleController;
use Controllers\UserController;
use MVC\Router;

$router = new Router();

/* Iniciar Sesion */
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

/* Cerrar Sesión */
$router->post('/logout', [LoginController::class, 'logout']);

/* Dashboard */
$router->get('/dashboard', [DashboardController::class, 'index']);

/* Usuarios */
$router->get('/users', [UserController::class, 'index']);
$router->get('/users/create', [UserController::class, 'create']);
$router->post('/users/create', [UserController::class, 'create']);
$router->get('/users/update', [UserController::class, 'update']);
$router->post('/users/update', [UserController::class, 'update']);
$router->post('/users/password', [UserController::class, 'password']);
$router->post('/users/delete', [UserController::class, 'delete']);

/* Categorias */
$router->get('/categories', [CategoryController::class, 'index']);
$router->post('/categories', [CategoryController::class, 'index']);
$router->post('/categories/update', [CategoryController::class, 'update']);
$router->post('/categories/delete', [CategoryController::class, 'delete']);

/* Productos */
$router->get('/products', [ProductController::class, 'index']);
$router->get('/products/create', [ProductController::class, 'create']);
$router->post('/products/create', [ProductController::class, 'create']);
$router->get('/products/update', [ProductController::class, 'update']);
$router->post('/products/update', [ProductController::class, 'update']);
$router->post('/products/delete', [ProductController::class, 'delete']);

/* Ventas */
$router->get('/sales', [SaleController::class, 'index']);
$router->get('/sales/create', [SaleController::class, 'create']);
$router->post('/sales/create', [SaleController::class, 'create']);
$router->post('/sales/delete', [SaleController::class, 'delete']);
$router->get('/reports', [SaleController::class, 'report']);
$router->get('/reports/print', [SaleController::class, 'print']);


/* general, usuarios, categorias, productos y ventas */


/* Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador */
$router->comprobarRutas();