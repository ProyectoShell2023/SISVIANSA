<?php

class Conexion {
    private $host = "localhost"; // Host de la base de datos
    private $usuario = "root"; // Usuario de la base de datos
    private $contrasena = ""; // Contraseña de la base de datos
    private $baseDatos = "sisviansa"; // Nombre de la base de datos
    private $charset = "utf8mb4"; // Conjunto de caracteres

    private $conexion;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->baseDatos};charset={$this->charset}";
            $opciones = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            $this->conexion = new PDO($dsn, $this->usuario, $this->contrasena, $opciones);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            die();
        }
    }

    public function conectar() {
        return $this->conexion;
    }

    public function ejecutarConsulta($sql, $parametros = array()) {
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute($parametros);
            return $stmt;
        } catch (PDOException $e) {
            echo "Error de consulta: " . $e->getMessage();
            return false;
        }
    }

    public function desconectar() {
        $this->conexion = null;
    }
}

?>
