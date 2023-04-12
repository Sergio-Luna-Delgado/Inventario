<?php

namespace Controllers;

use Model\Category;
use Model\Product;
use Model\Sale;
use Model\Tabla1;
use Model\User;
use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {
        if(isAuth()) {
            header('location: /');
        }

        $totales = array(
            'users' => User::total(),
            'categories' => Category::total(),
            'products' => Product::total(),
            'sales' => Sale::total(),
        );

        $tabla1 = Tabla1::SQL('SELECT c.name as categoria, p.name as nombre, sum(s.quantity) as cantidad, sum(s.total) as total FROM categories as c, sales as s, products as p WHERE s.product_ID = p.id and c.id = p.category_ID GROUP by p.name DESC LIMIT 4');

        /* tabla 2 */
        $sales = Sale::get('DESC', 4);
        foreach ($sales as $sale) {
            $sale->product = Product::find($sale->product_ID);
        }

        /* tabla 3 */
        $products = Product::get('DESC', 4);

        $router->render('dashboard/index', [
            'titulo' => 'Dashboard',
            'totales' => $totales,
            'tabla1' => $tabla1,
            'sales' => $sales,
            'products' => $products,
        ]);
    }
}
