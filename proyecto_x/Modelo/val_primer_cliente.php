<?php

// Importa la clase Conexion
require_once 'conexion.php';

// Crea una instancia de la clase Conexion
$conexion = new Conexion();

// Obtiene la conexión a la base de datos
$pdo = $conexion->conectar();

// Crea un objeto de la clase dataUser
$dataUser = new dataUser($pdo);

// Obtiene los datos del cliente
$cel = $_POST['cel'];
$email = $_POST['email'];
$pass = $_POST['pass'];

// Valida que el correo electrónico no exista
$dataUser->validarCorreoExistente($email);

// Genera el hash de la contraseña
$hashPass = $dataUser->generarHashContraseña($pass);

// Agrega el cliente a la base de datos
$dataUser->agregarCliente($cel, $email, $hashPass);

// Redirige al cliente a la página principal
header('Location: index.php');

?>
