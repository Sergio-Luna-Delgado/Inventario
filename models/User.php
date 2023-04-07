<?php 

namespace Model;

class User extends ActiveRecord {
    protected static $tabla = 'users';
    protected static $columnasDB = ['id', 'fullname', 'username', 'password', 'imagen', 'active', 'admin'];

    public $id;
    public $fullname;
    public $username;
    public $password;
    public $imagen;
    public $active;
    public $admin;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fullname = $args['fullname'] ?? '';
        $this->username = $args['username'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->imagen = $args['imagen'] ?? 'no-picture';
        $this->active = $args['active'] ?? 1;
        $this->admin = $args['admin'] ?? 0;
    }

    /* Mensajes de validacion para la cracion de la cuenta */
    public function validarNuevaCuenta()
    {
        if (!$this->fullname) {
            self::$alertasInput['fullname'] = 'El nombre es obligatorio';
        }
        
        if (!$this->username) {
            self::$alertasInput['username'] = 'Nombre de usuario es obligatorio';
        }

        if (!$this->password) {
            self::$alertasInput['password'] = 'El password es obligatorio';
        }

        if (strlen($this->password) < 8) {
            self::$alertasInput['noPassword'] = 'El password debe contener al menos 8 caracteres';
        }
        
        return self::$alertasInput;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // public function validarUsername()
    // {
    //     if (!$this->username) {
    //         self::$alertasInput['noUsername'] = 'El correo es obligatorio';
    //     }

    //     return self::$alertasInput;
    // }

    public function validarLogin()
    {
        if (!$this->username) {
            self::$alertasInput['username'] = 'El username es obligatorio';
        }

        if (!$this->password) {
            self::$alertasInput['password'] = 'El password es obligatorio';
        }

        return self::$alertasInput;
    }

    public function comprobarPasswordAndVerificado($password)
    {
        $resultado = password_verify($password, $this->password);

        if (!$resultado || !$this->active) {
            self::$alertas['error'][] = 'Password incorrecto o tu cuenta no esta activa';
        } else {
            return true;
        }
    }

    public function comprobarActualizarDatos() {
        if (!$this->fullname) {
            self::$alertasInput['fullname'] = 'El nombre es obligatorio';
        }
        
        if (!$this->username) {
            self::$alertasInput['username'] = 'Nombre de usuario es obligatorio';
        }

        return self::$alertasInput;
    }

    public function nuevo_password(): array
    {
        if (!$this->password) {
            self::$alertasInput['password'] = 'El password es obligatorio';
        }

        if (strlen($this->password) < 8) {
            self::$alertasInput['noPassword'] = 'El password debe contener al menos 8 caracteres';
        }

        return self::$alertasInput;
    }
}