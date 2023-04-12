<?php

namespace Model;

class Tabla1 extends ActiveRecord
{
    protected static $tabla = 'categories';
    protected static $columnasDB = ['categoria', 'nombre', 'cantidad', 'total'];

    public $categoria;
    public $nombre;
    public $cantidad;
    public $total;

    public function __construct($args = [])
    {
        $this->categoria = $args['categoria'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->total = $args['total'] ?? '';
    }
}
