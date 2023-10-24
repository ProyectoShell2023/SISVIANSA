<?php

class dataUser {

    public $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function validarCorreoExistente($email) {
        $sql = "SELECT * FROM cliente WHERE correo = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            throw new Exception('El cliente ya existe');
        }
    }

    public function generarHashContraseña($pass) {
        return password_hash($pass, PASSWORD_BCRYPT);
    }

    public function agregarCliente($cel, $email, $hashPass) {
        $sql = "INSERT INTO cliente (cel, email, pass) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cel, $email, $hashPass]);

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>
