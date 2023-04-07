<?php

namespace Controllers;

use Model\User;
use MVC\Router;
// use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic as Image;

class UserController
{
    public static function index(Router $router)
    {
        if (isAuth()) {
            header('location: /');
        }

        $users = User::all('asc');

        $router->render('users/index', [
            'titulo' => 'Sistema de Usuarios',
            'users' => $users
        ]);
    }

    public static function create(Router $router)
    {
        if (isAuth()) {
            header('location: /');
        }

        $user = new User();
        $alertasInput = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isAuth()) {
                header('location: /');
            }

            /* leer imagenes */
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/build/img/users';

                /* crear la carpeta si no existe */
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true); /* 0755 nivel de permisos, creacion de subdominios */
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);
                /* no soporta avif */

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = 'no-picture';
            }

            $user->sync($_POST);
            $alertasInput = $user->validarNuevaCuenta();

            /* Revisar que alerta este vacio */
            if (empty($alertasInput)) {
                /* Verificar que el usuario no este registrado */
                $existeUsuario = User::where('username', $user->username);

                if ($existeUsuario) {
                    $alertasInput['noUsername'] = 'El Usuario ya existe';
                } else {
                    /* No esta registrado, hashear el password */
                    $user->hashPassword();

                    /* Guardar la imagen */
                    if (!empty($_FILES['imagen']['tmp_name'])) {
                        $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                        $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                    }

                    /* Crear el usuario */
                    $resultado = $user->save();

                    if ($resultado) {
                        header('location: /users');
                    }
                }
            }
        }

        $router->render('users/create', [
            'titulo' => 'Crear Usuarios',
            'alertasInput' => $alertasInput,
            'user' => $user
        ]);
    }

    public static function update(Router $router)
    {
        if (isAuth()) {
            header('location: /');
        }

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('location: /users');
        }


        $alertasInput = [];

        $user = user::find($id);
        if (!$user) {
            header('location: /users');
        }
        /* No soy el admin y no me correspone el id    */
        if (!$_SESSION['admin'] && $user->id != $_SESSION['id']) {
            header('location: /users');
        }
        $user->imagen_actual = $user->imagen;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isAuth()) {
                header('location: /');
            }

            /* leer imagenes */
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/build/img/users';

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);
                /* no soporta avif */

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $user->imagen_actual;
            }
            
            $user->sync($_POST);
            $alertasInput = $user->comprobarActualizarDatos();
            
            /* Revisar que alerta este vacio */
            if (empty($alertasInput)) {
                /* Verificar que el usuario no este registrado y que no sea el actual admin */
                $userActual = user::find($id);

                if ($user->username === $userActual->username) {
                    $existeUsuario = false;
                } else {
                    $existeUsuario = User::where('username', $user->username);
                }

                if ($existeUsuario) {
                    $alertasInput['noUsername'] = 'El Usuario ya existe';
                } else {
                    /* Guardar la imagen */
                    if (!empty($_FILES['imagen']['tmp_name'])) {
                        $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                        $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                    }

                    /* Crear el usuario */
                    $resultado = $user->save();

                    /* Cambiar la imagen del layout si es el usuario logeado */
                    if ($user->id === $_SESSION['id']) {
                        $_SESSION['imagen'] = $user->imagen;
                        $_SESSION['fullname'] = $user->fullname;
                    }

                    if ($resultado) {
                        header('location: /users');
                    }
                }
            }
        }

        $router->render('users/update', [
            'titulo' => 'Crear Usuarios',
            'alertasInput' => $alertasInput,
            'user' => $user
        ]);
    }

    /* Fetch API */
    public static function password()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isAuth()) {
                header('location: /');
            }

            $id = $_POST['id'];
            $user = user::find($id);
            $user->password = $_POST['password'];

            $alertasInput = $user->nuevo_password();

            if (empty($alertasInput)) {
                $user->hashPassword();
                $user->save();

                $data = array(
                    'status'     => 'success',
                    'code'         => 200,
                    'message'     => 'La contraseña se actualizo exitosamente'
                );
            } else {
                $data = array(
                    'status'     => 'error',
                    'code'         => 404,
                    'message'     => 'La contraseña no puede ir vacia o debe contener al menos 8 caracteres'
                );
            }

            echo json_encode($data);
        }
    }

    /* Fetch API */
    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isAuth()) {
                header('location: /');
            }
            $id = $_POST['id'];

            $user = User::find($id);

            if (!isset($user)) {
                $data = array(
                    'status'     => 'error',
                    'code'         => 404,
                    'message'     => 'No se pudo eliminar el usuario'
                );
            } else {
                $user->delete();
                $data = array(
                    'status'     => 'success',
                    'code'         => 200,
                    'message'     => 'El usuario se elimino exitosamente'
                );
            }

            echo json_encode($data);
        }
    }
}
