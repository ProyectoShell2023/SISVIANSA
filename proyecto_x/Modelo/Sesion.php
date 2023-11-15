<?php

session_start();

// Generar un identificador de sesión aleatorio y único
$id_sesion = random_int(1, 10000000);
session_id($id_sesion);

// Establecer las cookies de sesión seguras y con el atributo `HttpOnly` activado
session_set_cookie_params(0, '/', 'localhost', true, true);

// Verificar si el usuario está autenticado
function verificarAutenticacion() {
    return isset($_SESSION['ID_Cliente']);
}

// Iniciar sesión
function iniciarSesion($usuario_id) {
    $_SESSION['ID_Cliente'] = $usuario_id;
}

// Cerrar sesión
function cerrarSesion() {
    session_unset();
    session_destroy();
}

// Verificar la autenticación al recibir una solicitud AJAX
if (isset($_POST['accion']) && $_POST['accion'] === 'verificarSesion') {
    header('Content-Type: application/json');

    $respuesta = array('autenticado' => verificarAutenticacion());

    echo json_encode($respuesta);
}







?>