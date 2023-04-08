<?php 

namespace Model;

class Product extends ActiveRecord {
    protected static $tabla = 'products';
    protected static $columnasDB = ['id', 'name', 'stock', 'sale_price', 'date', 'category_ID'];

    public $id;
    public $name;
    public $stock;
    public $sale_price;
    public $date;
    public $category_ID;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->stock = $args['stock'] ?? 1;
        $this->sale_price = $args['sale_price'] ?? '';
        $this->date = $args['date'] ?? '';
        $this->category_ID = $args['category_ID'] ?? 0;
    }

    /* Validar el nombre */
    public function validar() {
        if(!$this->name) {
            self::$alertasInput['name'] = 'El nombre del producto no debe ir vacia';
        }
        if(!$this->sale_price) {
            self::$alertasInput['sale_price'] = 'El precio no debe ir vacia';
        }
        if(!$this->stock) {
            self::$alertasInput['stock'] = 'Elige al menos una cantidad en el inventario';
        }
        if(!$this->category_ID || $this->category_ID == 'Selecciona una categoria') {
            self::$alertasInput['category_ID'] = 'Seleccione al menos una categoria';
        }

        return self::$alertasInput;
    }
}