<?php

namespace Controllers;

use Model\Product;
use Model\Sale;
use MVC\Router;

class SaleController
{
    public static function index(Router $router)
    {
        if (isAuth()) {
            header('location: /');
        }

        $sales = Sale::all();
        foreach ($sales as $sale) {
            $sale->product = Product::find($sale->product_ID);
        }

        $router->render('sales/index', [
            'titulo' => 'Sistema de Ventas',
            'sales' => $sales
        ]);
    }

    public static function create(Router $router)
    {
        if (isAuth()) {
            header('location: /');
        }

        $sale = new Sale();
        $products = Product::all('asc');
        $alertasInput = [];

        if (isset($_GET['product'])) {
            $id = $_GET['product'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if (!$id) {
                header('location: /sales');
            }

            $product_search = Product::find($id);
            if (!$product_search) {
                header('location: /sales');
            }
            $sale->product_ID = $product_search->id;

            if (isset($_GET['quantity'])) {
                $quantity = $_GET['quantity'];
                $quantity = filter_var($quantity, FILTER_VALIDATE_INT);

                if (!$quantity) {
                    header('location: /sales');
                }
                $sale->quantity = $quantity;
                $sale->total = $product_search->sale_price * $quantity;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isAuth()) {
                header('location: /');
            }

            $sale->sync($_POST);
            $alertasInput = $sale->validarProducto();

            if ($product_search->stock < $quantity) {
                $alertasInput['quantity'] = "La cantidad elegida excede el inventario";
            }

            /* Revisar que alerta este vacio */
            if (empty($alertasInput)) {
                date_default_timezone_set('America/Monterrey');
                $sale->date = date('Y-m-d H:i:s');

                /* Crear la venta */
                $resultado = $sale->save();

                if ($resultado) {
                    $product_search->stock = $product_search->stock - $quantity;
                    $product_search->save();

                    header('location: /sales');
                }
            }
        }


        $router->render('sales/create', [
            'titulo' => 'Crear Venta',
            'sale' => $sale,
            'products' => $products,
            'product_search' => $product_search ?? [],
            'id' => $id ?? '',
            'alertasInput' => $alertasInput,
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

            $sale = Sale::find($id);

            if (!isset($sale)) {
                $data = array(
                    'status'     => 'error',
                    'code'         => 404,
                    'message'     => 'No se pudo eliminar la venta'
                );
            } else {
                $sale->delete();
                $data = array(
                    'status'     => 'success',
                    'code'         => 200,
                    'message'     => 'La venta se elimino exitosamente'
                );
            }

            echo json_encode($data);
        }
    }

    public static function report(Router $router)
    {
        if (isAuth()) {
            header('location: /');
        }

        $router->render('sales/report', [
            'titulo' => 'Reporte de Ventas',
        ]);
    }
}
