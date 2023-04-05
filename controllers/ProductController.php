<?php

namespace Controllers;

use MVC\Router;

class ProductController
{
    public static function index(Router $router)
    {
        if(isAuth()) {
            header('location: /');
        }

        $router->render('products/index', [
            'titulo' => 'Sistema de Usuarios',
        ]);
    }
}
