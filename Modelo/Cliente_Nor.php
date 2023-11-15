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
    if (isset($_POST["nombre_cn"], $_POST["ci_cn"], $_POST["ubi_reg_cn"], $_POST["email_reg"], $_POST["pass_reg"], $_POST["cel_reg"])) {
        // Obtener los datos del formulario
        $nombreCN = $_POST["nombre_cn"];
        $ciCN = $_POST["ci_cn"];
        $direccionCN = $_POST["ubi_reg_cn"];
        $email = $_POST["email_reg"];
        $password = $_POST["pass_reg"];
        $cel = $_POST["cel_reg"];

        // Realiza validaciones específicas de Cliente normal
        if (!empty($nombreCN) && !empty($ciCN) && !empty($direccionCN)) {
            // Valida que el correo electrónico no exista
            if ($dataUser->validarCorreoExistente($email)) {
                // Genera el hash de la contraseña
                $hashPass = password_hash($password, PASSWORD_BCRYPT);

                // Agrega el Cliente normal a la base de datos
                if ($dataUser->agregarCliente_Nor($cel, $email, $hashPass, $nombreCN, $ciCN, $direccionCN)) {
                    $response['success'] = true;
                    $response['message'] = "Registro exitoso";
                } else {
                    $response['success'] = false;
                    $response['error'] = "Hubo un error al registrar el Cliente normal";
                }
            } else {
                $response['success'] = false;
                $response['error'] = "El correo electrónico ya existe";
            }
        } else {
            $response['success'] = false;
            $response['error'] = "Completa todos los campos obligatorios para Cliente normal";
        }

        // Enviar una respuesta JSON
        echo json_encode($response);
    } else {
        // Datos incompletos
        $response = ["success" => false, "error" => "Completa todos los campos obligatorios"];
        echo json_encode($response);
    }
} else {
    // Método no permitido
    $response = ["success" => false, "error" => "Método no permitido"];
    echo json_encode($response);
}
?>
