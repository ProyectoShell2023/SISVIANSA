<?php

include 'Cliente.php';

class Cliente {

    private $datos;
    private $tipo;

    public function __construct($datos, $tipo) {
        $this->datos = $datos;
        $this->tipo = $tipo;
    }

    public function guardar() {
        $pdo = Conexion::conectar();

        $sql = "INSERT INTO cliente (correo, pass, direccion, cel, fecha_ing, foto_perfil) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->datos['correo'], $this->datos['pass'], $this->datos['direccion'], $this->datos['cel'], $this->datos['fecha_ing'], $this->datos['foto_perfil']]);

        $id_cliente = $pdo->lastInsertId();

        if ($this->tipo === 'empresa') {
            $sql = "INSERT INTO empresa (rut, nombre, ci_enca, id_cliente) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$this->datos['rut'], $this->datos['nombre'], $this->datos['ci_enca'], $id_cliente]);
        } else {
            $sql = "INSERT INTO normal (ci, nombre, id_cliente) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$this->datos['ci'], $this->datos['nombre'], $id_cliente]);
        }

        return $stmt->rowCount() > 0;
    }
}
