<?php

$cel_reg = $_POST['cel_reg_validado'];
$email_reg = $_POST['email_reg_validado'];
$pass_reg = $_POST['pass_reg_validado'];
$direccion_reg = $_POST['direccion_reg_validado'];

if ($cel_reg === '' || $email_reg === '' || $pass_reg === '') {
    echo json_encode('error');
} else {
    // Aquí puedes realizar cualquier procesamiento adicional que necesites con los datos
    echo json_encode('Datos recibidos: Celular=' . $cel_reg . ', Email=' . $email_reg . ', Contraseña=' . $pass_reg);
}

?>
