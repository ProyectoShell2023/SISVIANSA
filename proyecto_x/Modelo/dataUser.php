<?php

// Clase para interactuar con la base de datos de clientes
class dataUser {

    // Instancia de la conexión a la base de datos
    private $pdo;

    // Constructor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Valida que el correo electrónico no exista
    public function validarCorreoExistente($email) {

        // Consulta para verificar si el correo electrónico existe
        $sql = "SELECT * FROM cliente WHERE Correo = ?";

        // Prepara la consulta
        $stmt = $this->pdo->prepare($sql);

        // Ejecuta la consulta
        $stmt->execute([$email]);

        // Devuelve true si el correo electrónico no existe
        return $stmt->rowCount() == 0;
    }

    // Genera un hash de la contraseña
    public function generarHashContraseña($pass) {
        return password_hash($pass, PASSWORD_BCRYPT);
    }

    // Agrega un cliente a la base de datos
    public function agregarCliente($cel, $email, $hashPass) {

        // Consulta para agregar el cliente a la base de datos
        $sql = "INSERT INTO pri_reg (Cel, Correo, Pass) VALUES (?, ?, ?)";

        // Prepara la consulta
        $stmt = $this->pdo->prepare($sql);

        // Ejecuta la consulta
        $stmt->execute([$cel, $email, $hashPass]);

        // Devuelve true si el cliente se agregó correctamente
        return $stmt->rowCount() == 1;
    }
}

