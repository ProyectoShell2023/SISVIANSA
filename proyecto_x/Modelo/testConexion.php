<?php

// Importa la clase Conexion
require_once 'conexion.php';

// Crea una instancia de la clase Conexion
$conexion = Conexion::getInstancia();

// Intenta conectar con la base de datos
try {
    $conexion->conectar();
    echo "La conexión se realizó correctamente.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cierra la conexión
    $conexion->cerrar();
}

?>
