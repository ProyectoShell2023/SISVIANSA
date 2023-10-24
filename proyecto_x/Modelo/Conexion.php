<?php

/**
 * Clase para conectarse a la base de datos MySQL.
 */
class Conexion {
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'sisviansa';

    private static $instancia;
    private $pdo;

    public static function getInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new Conexion();
        }

        return self::$instancia;
    }

    private function __construct() {
        $this->pdo = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8', self::DB_USER, self::DB_PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function conectar() {
        return $this->pdo;
    }

    public function cerrar() {
        $this->pdo = null;
    }

    public function ejecutarConsulta($sql, $datos = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($datos);
            return $stmt;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function rowCount($stmt) {
        return (int)$stmt->rowCount();
    }

    public function fetch($stmt) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll($stmt) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar($tabla, $datos) {
        $campos = implode(", ", array_keys($datos));
        $valores = implode(", ", array_fill(0, count($datos), "?"));
        $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";

        $stmt = $this->ejecutarConsulta($sql, array_values($datos));
        return $stmt->rowCount() > 0;
    }

    public function actualizar($tabla, $datos, $condicion) {
        $campos = implode(" = ?, ", array_keys($datos)) . " = ?";
        $sql = "UPDATE $tabla SET $campos WHERE $condicion";

        $stmt = $this->ejecutarConsulta($sql, array_values($datos));
        return $stmt->rowCount() > 0;
    }

    public function escapar($cadena) {
        return $this->pdo->quote($cadena);
    }

    public function transaccion() {
        $this->pdo->beginTransaction();
        try {
            // Ejecutar las consultas
        } catch (Exception $e) {
            // Deshacer la transacción
            $this->pdo->rollBack();
            throw $e;
        }

        // Confirmar la transacción
        $this->pdo->commit();
    }

    public function __destruct() {
        $this->cerrar();
    }
}
