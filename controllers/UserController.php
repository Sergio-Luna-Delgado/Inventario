<?php

namespace Controllers;

use MVC\Router;

class UserController
{
    public static function index(Router $router)
    {
        if(isAuth()) {
            header('location: /');
        }

        $router->render('users/index', [
            'titulo' => 'Sistema de Usuarios',
        ]);
    }
}
