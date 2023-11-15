<?php
require_once 'conexion.php'; // Importa la clase Conexion
require_once 'dataUser.php'; // Importa la clase dataUser

// Obtiene una instancia de la clase Conexion utilizando el método estático
$conexion = Conexion::getInstancia();
// Obtiene la conexión a la base de datos
$pdo = $conexion->conectar();

// Crea un objeto de la clase dataUser
$dataUser = new dataUser($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar si se enviaron los datos esperados
    if (isset($_POST["nombre_cb"], $_POST["rut_cb"], $_POST["ci_en_cb"], $_POST["ubi_reg_cb"], $_POST["email_reg"], $_POST["pass_reg"], $_POST["cel_reg"])) {
        // Obtener los datos del formulario
        $nombreCB = $_POST["nombre_cb"];
        $rutCB = $_POST["rut_cb"];
        $ciEnCB = $_POST["ci_en_cb"];
        $direccionCB = $_POST["ubi_reg_cb"];
        $email = $_POST["email_reg"];
        $password = $_POST["pass_reg"];
        $cel = $_POST["cel_reg"];

        // Realiza validaciones específicas de Cliente Business
        if (!empty($nombreCB) && !empty($rutCB) && !empty($ciEnCB) && !empty($direccionCB)) {
            // Valida que el correo electrónico no exista
            if ($dataUser->validarCorreoExistente($email)) {
                // Genera el hash de la contraseña
                $hashPass = password_hash($password, PASSWORD_BCRYPT);

                // Agrega el cliente empresa a la base de datos
                if ($dataUser->agregarCliente_Emp($cel, $email, $hashPass, $nombreCB, $rutCB, $ciEnCB, $direccionCB)) {
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
        } else {
            $response['success'] = false;
            $response['error'] = "Completa todos los campos obligatorios para Cliente Business";
        }
    } else {
        // Datos incompletos
        $response = ["success" => false, "error" => "Completa todos los campos obligatorios"];
    }
} else {
    // Método no permitido
    $response = ["success" => false, "error" => "Método no permitido"];
}

// Enviar una respuesta JSON
echo json_encode($response);
?>
