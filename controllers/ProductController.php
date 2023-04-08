<?php

namespace Controllers;

use Model\Product;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Category;

class ProductController
{
    public static function index(Router $router)
    {
        if (isAuth()) {
            header('location: /');
        }

        $products = Product::all('asc');
        foreach($products as $product) {
            $product->category = Category::find($product->category_ID);
        }

        $router->render('products/index', [
            'titulo' => 'Sistema de Productos',
            'products' => $products
        ]);
    }

    public static function create(Router $router)
    {
        if (isAuth()) {
            header('location: /');
        }

        $product = new Product();
        $alertasInput = [];

        $categories = Category::all('asc');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isAuth()) {
                header('location: /');
            }

            $product->sync($_POST);
            $alertasInput = $product->validar();

            date_default_timezone_set('America/Monterrey');
            $product->date = date('Y-m-d H:i:s');

            /* Revisar que alerta este vacio */
            if (empty($alertasInput)) {
                /* Crear el usuario */
                $resultado = $product->save();

                if ($resultado) {
                    header('location: /products');
                }
            }
        }

        $router->render('products/create', [
            'titulo' => 'Crear Producto',
            'alertasInput' => $alertasInput,
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public static function update(Router $router)
    {
        if (isAuth()) {
            header('location: /');
        }

        if (isAuth()) {
            header('location: /');
        }

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('location: /products');
        }

        $alertasInput = [];

        $product = Product::find($id);
        if (!$product) {
            header('location: /products');
        }

        $categories = Category::all('asc');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isAuth()) {
                header('location: /');
            }

            $product->sync($_POST);
            $alertasInput = $product->validar();

            /* Revisar que alerta este vacio */
            if (empty($alertasInput)) {
                /* Crear el usuario */
                $resultado = $product->save();

                if ($resultado) {
                    header('location: /products');
                }
            }
        }

        $router->render('products/update', [
            'titulo' => 'Actualizar Producto',
            'alertasInput' => $alertasInput,
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /* Fetch API */
    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isAuth()) {
                header('location: /');
            }
            $id = $_POST['id'];

            $product = Product::find($id);

            if (!isset($product)) {
                $data = array(
                    'status'     => 'error',
                    'code'         => 404,
                    'message'     => 'No se pudo eliminar el producto'
                );
            } else {
                $product->delete();
                $data = array(
                    'status'     => 'success',
                    'code'         => 200,
                    'message'     => 'El producto se elimino exitosamente'
                );
            }

            echo json_encode($data);
        }
    }
}
