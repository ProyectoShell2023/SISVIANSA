<?php
include 'conexion.php';

// Obtener la instancia de la conexión a la base de datos
$conexion = Conexion::getInstancia();

// Consulta para obtener los datos del menú
$sql = "SELECT * FROM menu";
$resultado = $conexion->ejecutarConsulta($sql);

// Convertir los datos a formato JSON
$datosJson = json_encode($resultado->fetchAll());

// Depurar el código
var_dump($resultado->fetchAll());


echo $datosJson;
