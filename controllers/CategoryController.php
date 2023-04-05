<?php

namespace Controllers;

use MVC\Router;

class CategoryController
{
    public static function index(Router $router)
    {
        if(isAuth()) {
            header('location: /');
        }

        $router->render('categories/index', [
            'titulo' => 'Sistema de Categorias',
        ]);
    }
}
