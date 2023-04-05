<?php

namespace Controllers;

use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {
        if(isAuth()) {
            header('location: /');
        }

        $router->render('dashboard/index', [
            'titulo' => 'Dashboard',
        ]);
    }
}
