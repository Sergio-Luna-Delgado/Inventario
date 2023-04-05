<?php

namespace Controllers;

use MVC\Router;

class SaleController
{
    public static function index(Router $router)
    {
        if(isAuth()) {
            header('location: /');
        }

        $router->render('sales/index', [
            'titulo' => 'Sistema de Ventas',
        ]);
    }

    public static function report(Router $router)
    {
        if(isAuth()) {
            header('location: /');
        }

        $router->render('sales/report', [
            'titulo' => 'Reporte de Ventas',
        ]);
    }
}
