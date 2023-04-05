<?php

/* Escapa / Sanitizar el HTML */
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

/* Funcion que revisa si el usuario esta autenticado */
function isAuth(): void
{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

/* Funcion que revisa que el usuario sea admin */
function isAdmin() : void {
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}

function pagina_actual($path) : bool {
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}