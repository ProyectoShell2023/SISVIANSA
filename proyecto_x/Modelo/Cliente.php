<?php

include 'conexion.php';

class O_Cliente {

    private $datos;
    private $tipo;

    public function __construct($datos, $tipo) {
        $this->datos = $datos;
        $this->tipo = $tipo;

        if (!filter_var($this->datos['correo'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('El correo electrónico no es válido');
        }

        if (strlen($this->datos['pass']) < 8) {
            throw new Exception('La contraseña debe tener al menos 8 caracteres');
        }

        if (!is_numeric($this->datos['ci'])) {
            throw new Exception('La CI debe ser un número');
        }

        if (!in_array($this->tipo, ['empresa', 'normal'])) {
            throw new Exception('El tipo de cliente no es válido');
        }

        $pdo = Conexion::conectar();
        $sql = "SELECT * FROM cliente WHERE correo = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->datos['correo']]);

        if ($stmt->rowCount() > 0) {
            throw new Exception('El cliente ya existe');
        }
    }

    public function generarHashContraseña() {
        if (isset($this->datos['pass'])) {
            return password_hash($this->datos['pass'], PASSWORD_BCRYPT);
        } else {
            throw new Exception('La contraseña no está definida.');
        }
    }

    public function enviarCorreoConfirmacion($id) {
        $enlace = 'https://www.example.com/activar-cuenta?id=' . $id;

        return mail($this->datos['correo'], 'Confirmación de cuenta', '
Hola ' . $this->datos['nombre'] . ',

Para activar tu cuenta, haz clic en el siguiente enlace:

' . $enlace . '

Gracias,

El equipo de [nombre de la aplicación]
');
    }

    public function crearCliente() {
        $hash = $this->generarHashContraseña();
        $this->datos['pass'] = $hash;

        $pdo = Conexion::conectar();
        $sql = "INSERT INTO cliente (nombre, correo, contraseña, tipo, ci) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->datos['nombre'], $this->datos['correo'], $this->datos['pass'], $this->tipo, $this->datos['ci']]);

        if ($stmt->rowCount() > 0) {
            $this->enviarCorreoConfirmacion($pdo->lastInsertId());
            return new Cliente($this->datos, $this->tipo);
        } else {
            throw new Exception('No se pudo crear el cliente');
        }
    }
}
