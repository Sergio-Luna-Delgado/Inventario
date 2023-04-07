<?php 

namespace Model;

class Category extends ActiveRecord {
    protected static $tabla = 'categories';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }

    /* Validar el nombre */
    public function validarNombre() {
        if(!$this->name) {
            self::$alertasInput['name'] = 'El nombre de la categoria no debe ir vacia';
        }

        return self::$alertasInput;
    }
}