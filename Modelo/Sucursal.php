<?php

// Importar la clase Conexion
require_once "conexion.php";

// Obtener la instancia de la clase Conexion
$conexion = Conexion::getInstancia();

// Obtener los datos del formulario
$datos = json_decode(file_get_contents("php://input"));

// Insertar los datos en la base de datos
$sql = "INSERT INTO sucursal (Cant_Cocina, Cant_Turnos) VALUES ({$datos->Cant_Cocina}, {$datos->Cant_Turnos})";
$resultado = $conexion->ejecutarConsulta($sql);

// Cerrar la conexión a la base de datos
$conexion->cerrar();

// Redirigir a la página de resultados
header("Location: resultados.php");

?>
