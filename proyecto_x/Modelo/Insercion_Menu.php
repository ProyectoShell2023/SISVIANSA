<?php

// Incluir el archivo de conexión
require_once('Conexion.php');

// Obtener una instancia de la clase de conexión
$conexion = Conexion::getInstancia();

// Inicializar el array de respuesta
$response = array();

// Verificar si se reciben datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtener datos del formulario
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $tipo = $_POST['tipo'];
        $stock = $_POST['stock'];
        $stock_max = $_POST['stock_max'];
        $stock_min = $_POST['stock_min'];
        $vencimiento = $_POST['vencimiento'];
        $tiempo = $_POST['tiempo'];
        $tamanio = $_POST['tamanio'];
        $precio = $_POST['precio'];

        // Validar datos

        // Validación: Imagen seleccionada
        if (empty($_FILES['img_menu'])) {
            $response['success'] = false;
            $response['message'] = 'Por favor, seleccione una imagen.';
        } else {
            // Otras validaciones...

            // Validación: Precio mayor a 0
            if (!is_numeric($stock) || $stock <= 0) {
                $response['success'] = false;
                $response['message'] = 'Por favor, ingrese un stock válido mayor a 0.';
            } 
            // Validación: Stock, stock mínimo y stock máximo mayores a 0
            elseif (!is_numeric($stock) || $stock <= 0 || !is_numeric($stock_min) || $stock_min <= 0 || !is_numeric($stock_max) || $stock_max <= 0) {
                $response['success'] = false;
                $response['message'] = 'Por favor, ingrese valores de stock, stock mínimo y stock máximo mayores a 0.';
            } 
            // Validación: Stock mínimo menor que stock máximo
            elseif ($stock_min >= $stock_max) {
                $response['success'] = false;
                $response['message'] = 'El stock mínimo debe ser menor que el stock máximo.';
            } 
            // Validación: Stock no inferior al stock mínimo
            elseif ($stock < $stock_min) {
                $response['success'] = false;
                $response['message'] = 'El stock no puede ser inferior al stock mínimo.';
            } 
            // Validación: Stock no supera el stock máximo
            elseif ($stock > $stock_max) {
                $response['success'] = false;
                $response['message'] = 'Ha superado el stock máximo permitido.';
            } 
            // Validación: Fecha de vencimiento posterior a la fecha actual
            elseif (strtotime($vencimiento) <= time()) {
                $response['success'] = false;
                $response['message'] = 'La fecha de vencimiento debe ser posterior a la fecha actual.';
            } 
            // Validación: Tiempo mayor a un minuto
            elseif (empty($tiempo) || strlen($tiempo) < 2) {
                $response['success'] = false;
                $response['message'] = 'Por favor, ingrese un tiempo válido mayor a un minuto.';
            } 
            // Todas las validaciones pasaron, insertar en la tabla 'menu'
            else {
                // Manejo de la imagen
                $img_menu = $_FILES['img_menu'];
                $img_temp = $img_menu['tmp_name'];
                $img_name = $img_menu['name'];
                $img_path = '' . $img_name;

                // Mover la imagen al directorio de almacenamiento
                move_uploaded_file($img_temp, $img_path);

                // Datos del menú
                $datosMenu = array(
                    'Nombre' => $nombre,
                    'Descripcion' => $descripcion,
                    'Tipo' => $tipo,
                    'Stock' => $stock,
                    'Stock_Max' => $stock_max,
                    'Stock_Min' => $stock_min,
                    'Tiempo_Pro' => $tiempo,
                    'Tamanio' => $tamanio,
                    'Imagen' => $img_path,
                    'Precio' => $precio,
                );

                // Insertar en la tabla 'menu'
                $insertado = $conexion->insertar('menu', $datosMenu);

                if ($insertado) {
                    $response['success'] = true;
                    $response['message'] = 'Menú insertado correctamente.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Error al insertar el menú.';
                }
            }
        }
    } catch (Exception $e) {
        $response['success'] = false;
        $response['message'] = 'Error en la solicitud: ' . $e->getMessage();
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Método no permitido.';
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
