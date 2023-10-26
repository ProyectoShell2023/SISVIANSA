<?php
// Importa la clase Conexion
require_once 'conexion.php';

// Incluye el archivo que contiene la definición de la clase dataUser
require_once 'val_primer_cliente.php';

// Obtén una instancia de la clase Conexion
$conexion = Conexion::getInstancia();

// Obtiene la conexión a la base de datos
$pdo = $conexion->conectar();

// Crea una instancia de la clase dataUser
$dataUser = new dataUser($pdo);

// Datos ficticios
$cel = "123456789";
$email = "prueba@example.com";
$pass = "password123";

// Insertar datos ficticios
$dataUser->agregarCliente($cel, $email, $pass);
