
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

// Obtiene los datos del cliente
$cel = $_POST['cel_reg'];
$email = $_POST['email_reg'];
$pass = $_POST['pass_reg'];

// Valida que el correo electrónico no exista
if ($dataUser->validarCorreoExistente($email)) {
    // Genera el hash de la contraseña
    $hashPass = password_hash($pass, PASSWORD_BCRYPT);
    
    // Agrega el cliente a la base de datos
    if ($dataUser->agregarNewCliente($cel, $email, $hashPass)) {
        $response['success'] = true;
        $response['message'] = "Registro exitoso";
    } else {
        $response['success'] = false;
        $response['error'] = "Hubo un error al registrar el cliente";
    }
} else {
    $response['success'] = false;
    $response['error'] = "El correo electrónico ya existe";
}

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

