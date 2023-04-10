<?php 

namespace Model;

class Sale extends ActiveRecord {
    protected static $tabla = 'sales';
    protected static $columnasDB = ['id', 'product_ID', 'quantity', 'total', 'date'];

    public $id;
    public $product_ID;
    public $quantity;
    public $total;
    public $date;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->product_ID = $args['product_ID'] ?? 0;
        $this->quantity = $args['quantity'] ?? '';
        $this->total = $args['total'] ?? '';
        $this->date = $args['date'] ?? '';
    }

    /* Validar el nombre */
    public function validarProducto() {
        if(!$this->quantity) {
            self::$alertasInput['product_ID'] = 'Elige al menos un producto';
        }

        return self::$alertasInput;
    }
}