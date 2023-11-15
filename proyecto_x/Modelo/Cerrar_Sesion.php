<?php
require_once 'sesion.php'; 

cerrarSesion();




// Redirige a la página de inicio de sesión o a cualquier otra página después de cerrar sesión
header("Location: index.html");
exit();
