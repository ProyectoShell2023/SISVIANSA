<?php

class newUser
{
    private $cel ; 
    private $emial ; 
    private $contra ; 
    private $direccion ; 

    private object $conex;


public function __construct()
{
    $this->conex = new Conexion();
    $this->conex = $this->conex->conectar();
}


/*INGRESAR NUWVO USUARIO*/
public function ingresarUser(int $cel , string $emial , string $contra , string $direccio)
{
$this->cel = $cel ;
$this->emial = $emial ;
$this->contra = $contra ;
$this->direccion = $direccio ;

$sql = "INSERT INTO cliente(email , contra , direccion , cel) VALUES (?, ?, ?, ?)" ;
$insertar = $this->conex->prepare($sql);
$arregloDatos = array($this->emial, $this->contra, $this->direccion, $this->cel) ;
$resultado = $insertar->execute($arregloDatos);
$idInsertado = $this->conex->lastInsertId();
return $idInsertado;
}

public function getnewUser()
{
    $sql = "SELECT * FROM cliente"; 
    $consultar = $this->conex->query($sql);
    $resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
}

/*ELIMINAR CLIENTE*/
// public function eliminarUser($id)
// {
//     $sql = "DELETE FROM cliente WHERE ID_Ciente = ?";
//     $eliminar = $this->conex->prepare($sql);
//     $eliminar->execute([$id]);
// }

}


?> 