<?php

include 'conexion.php';

class O_Menu {

    private $datos;

    public function __construct($datos) {
        $this->datos = $datos;

        if (strlen($this->datos['Nombre']) > 20) {
            throw new Exception('El nombre no debe exceder los 20 caracteres');
        }

        if (strlen($this->datos['Descripcion']) > 100) {
            throw aException('La descripción no debe exceder los 100 caracteres');
        }

        // Puedes agregar más validaciones según tus necesidades.

        $pdo = Conexion::getInstancia()->conectar();
        $sql = "SELECT * FROM menu WHERE Nombre = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->datos['Nombre']]);

        if ($stmt->rowCount() > 0) {
            throw new Exception('El menú ya existe');
        }
    }

    public function crearMenu() {
        $pdo = Conexion::getInstancia()->conectar();
        $sql = "INSERT INTO menu (Nombre, Descripcion, Tipo, Stock, Stock_Max, Stock_Min, Costo, Tiempo_Pro, Imagen, Vencimiento, Tamanio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->datos['Nombre'], $this->datos['Descripcion'], $this->datos['Tipo'], $this->datos['Stock'], $this->datos['Stock_Max'], $this->datos['Stock_Min'], $this->datos['Costo'], $this->datos['Tiempo_Pro'], $this->datos['Imagen'], $this->datos['Vencimiento'], $this->datos['Tamanio']]);

        if ($stmt->rowCount() > 0) {
            return $pdo->lastInsertId();
        } else {
            throw new Exception('No se pudo crear el menú');
        }
    }
}

// Ejemplo de uso:
$datosMenu = [
    'Nombre' => 'Nombre del Menú',
    'Descripcion' => 'Descripción del Menú',
    'Tipo' => 1,
    'Stock' => 50,
    'Stock_Max' => 100,
    'Stock_Min' => 10,
    'Costo' => 100,
    'Tiempo_Pro' => '02:30:00',
    'Imagen' => 'ruta_de_la_imagen.jpg',
    'Vencimiento' => '2023-12-31',
    'Tamanio' => 2,
];

try {
    $menu = new O_Menu($datosMenu);
    $menuId = $menu->crearMenu();
    echo "Menú creado con ID: $menuId";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
