<?php

namespace Controllers;

use Model\User;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alertasInput = [];
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->sync($_POST);

            /* Verificar que no dejo campos vacios */
            $alertasInput = $user->validarLogin();

            if (empty($alertasInput)) {
                /* Verificar que el usuario exista */
                $user = User::where('username', $user->username);

                if (!$user || !$user->active) {
                    $alertasInput['noUsername'] = 'El usuario no existe o no esta activo';
                } else {
                    /* El usuario si existe y reviso que su contraseña sea correcta */
                    if (password_verify($_POST['password'], $user->password)) {
                        if ($user->admin) {
                            if (!isset($_SESSION)) {
                                session_start();
                            }
                            $_SESSION['admin'] = true;
                        }
                        if (!isset($_SESSION)) {
                            session_start();
                        }
                        $_SESSION['login'] = true;
                        $_SESSION['id'] = $user->id;
                        $_SESSION['fullname'] = $user->fullname;
                        header('Location: /dashboard');
                    } else {
                        $alertasInput['noPassword'] = 'Password incorrecto';
                    }
                }
            }
        }

        $router->render('auth/login', [
            'titulo' => 'Inicia Sesión',
            'user' => $user,
            'alertasInput' => $alertasInput
        ]);
    }

    public static function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION = [];
            header('location: /');
        }
    }
}
