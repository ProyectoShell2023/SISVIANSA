<?php
// Importa la clase Conexion
require_once 'conexion.php';

// Importa la clase dataUser
require_once 'dataUser.php';

// Obtén una instancia de la clase Conexion utilizando el método estático
$conexion = Conexion::getInstancia();

// Obtiene la conexión a la base de datos
$pdo = $conexion->conectar();

// Crea un objeto de la clase dataUser
$dataUser = new dataUser($pdo);

// Inicializa una respuesta
$response = array();

// Obtiene los datos del inicio de sesión
$email = $_POST['email_log'];
$password = $_POST['pass_log'];

/*// Inicia la sesión y almacena el ID del usuario
    session_start();

    iniciarSesion($user['ID_Cliente']); */


// Valida las credenciales del usuario
$validationResult = $dataUser->validarCredenciales($email, $password);

if ($validationResult['success']) {
    $response['success'] = true;
    $response['message'] = "Inicio de sesión exitoso";

    // Accede al ID del usuario
     $userId = $validationResult['ID_Cliente'];

    // Inicia la sesión y almacena el ID del usuario
    session_start();
  //  iniciarSesion($userId);


} else {
    $response['success'] = false;
    $response['error'] = "Credenciales incorrectas";
}

// ...


// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
