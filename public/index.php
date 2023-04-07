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

/* Productos */
$router->get('/products', [ProductController::class, 'index']);

/* Ventas */
$router->get('/sales', [SaleController::class, 'index']);
$router->get('/reports', [SaleController::class, 'report']);


/* general, usuarios, categorias, productos y ventas */


/* Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador */
$router->comprobarRutas();