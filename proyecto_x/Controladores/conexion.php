<?php

class Conexion 
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "bd_sis";

    private $con;

    function __construct(){
        
        $conString = "mysql:host=".$this->host.
                ";dbname=".$this->db.";charset=utf8";
        try{
            $this->con = new PDO($conString,$this->user,$this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e){
            $this->con = "Error de conexión";
            echo "Error: ".$e->getMessage();
        }     
    }

    public function conectar(){
        return $this->con;
    }
}


?>