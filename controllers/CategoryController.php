<?php

namespace Controllers;

use Model\Category;
use MVC\Router;

class CategoryController
{
    public static function index(Router $router)
    {
        if (isAuth()) {
            header('location: /');
        }

        $category = new Category();
        $alertasInput = [];

        $categories = Category::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isAuth()) {
                header('location: /');
            }

            $category->sync($_POST);
            $alertasInput = $category->validarNombre();

            if (empty($alertasInput)) {
                $existeCategoria = Category::where('name', $category->name);

                if ($existeCategoria) {
                    $alertasInput['existeName'] = 'Ya existe una categoria con ese nombre';
                } else {
                    $resultado = $category->save();

                    if ($resultado) {
                        header('location: /categories');
                    }
                }
            }
        }

        $router->render('categories/index', [
            'titulo' => 'Sistema de Categorias',
            'category' => $category,
            'categories' => $categories,
            'alertasInput' => $alertasInput,
        ]);
    }

    /* Fetch API */
    public static function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isAuth()) {
                header('location: /');
            }

            $id = $_POST['id'];
            $category = Category::find($id);
            $category->name = $_POST['name'];

            $alertasInput = $category->validarNombre();

            if (empty($alertasInput)) {
                $category->save();

                $data = array(
                    'status'     => 'success',
                    'code'         => 200,
                    'message'     => 'La categoria se actualizo exitosamente'
                );
            } else {
                $data = array(
                    'status'     => 'error',
                    'code'         => 404,
                    'message'     => 'La categoria no puede ir vacia'
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

            $category = Category::find($id);

            if (!isset($category)) {
                $data = array(
                    'status'     => 'error',
                    'code'         => 404,
                    'message'     => 'No se pudo eliminar la categoria'
                );
            } else {
                $category->delete();
                $data = array(
                    'status'     => 'success',
                    'code'         => 200,
                    'message'     => 'La categoria se elimino exitosamente'
                );
            }

            echo json_encode($data);
        }
    }
}
