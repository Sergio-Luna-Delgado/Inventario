<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    /* Proteger Rutas */
    public function comprobarRutas()
    {
        session_start();

        // $currentUrl = $_SERVER['PATH_INFO'] ?? '/'; para local
        $currentUrl = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        /* Dividimos la URL actual cada vez que exista un '?' eso indica que se están pasando variables por la url */
        $splitURL = explode('?', $currentUrl);

        if ($method === 'GET') {
            $fn = $this->getRoutes[$splitURL[0]] ?? null;
        } else {
            $fn = $this->postRoutes[$splitURL[0]] ?? null;
        }

        if ($fn) {
            /* Call user fn va a llamar una función cuando no sabemos cual sera */
            call_user_func($fn, $this);
        } else {
            // echo "Página No Encontrada o Ruta no válida";
            /* Almacenamiento en memoria durante un momento */
            ob_start();
            /* Por defecto yo incluyo una vista 404 para mostrar un mensaje de error personalizado */
            include_once __DIR__ . "/views/404.php";
            /* Limpia el Buffer */
            $contenido = ob_get_clean();
            include_once __DIR__ . '/views/layout-login.php';
        }
    }

    public function render($view, $datos = [])
    {
        /* Leer lo que le pasamos  a la vista */
        foreach ($datos as $key => $value) {
            /* Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente */
            $$key = $value;
        }

        /* Almacenamiento en memoria durante un momento */
        ob_start();
        /* Entonces incluimos la vista en el layout */
        include_once __DIR__ . "/views/$view.php";
        /* Limpia el Buffer */
        $contenido = ob_get_clean();

        /* Utilizar el layout de acuerdo a la URL */
        $url_actual = $_SERVER['PATH_INFO'] ?? '/';
        if(str_contains($url_actual, 'reports/print')) {
            include_once __DIR__ . '/views/layout-report.php';
            die();
        }
        if (strcmp($url_actual, '/')) {
            include_once __DIR__ . '/views/layout.php';
        } else {
            include_once __DIR__ . '/views/layout-login.php';
        }
    }
}
