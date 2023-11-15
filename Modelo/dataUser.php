
<?php

// Clase para interactuar con la base de datos de clientes
class dataUser {

    // Instancia de la conexión a la base de datos
    private $pdo;

    // Constructor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Valida que el correo electrónico no exista
    public function validarCorreoExistente($email) {

        // Consulta para verificar si el correo electrónico existe
        $sql = "SELECT * FROM cliente WHERE Correo = ?";

        // Prepara la consulta
        $stmt = $this->pdo->prepare($sql);

        // Ejecuta la consulta
        $stmt->execute([$email]);

        // Devuelve true si el correo electrónico no existe
        return $stmt->rowCount() == 0;
    }

    // Genera un hash de la contraseña
    public function generarHashContraseña($pass) {
        return password_hash($pass, PASSWORD_BCRYPT);
    }

    

    // Agrega un cliente nuevo a la base de datos
    public function agregarNewCliente($cel, $email, $hashPass) {

        // Consulta para agregar el cliente a la base de datos
        $sql = "INSERT INTO pri_reg (Cel, Correo, Pass) VALUES (?, ?, ?)";

        // Prepara la consulta
        $stmt = $this->pdo->prepare($sql);

        // Ejecuta la consulta
        $stmt->execute([$cel, $email, $hashPass]);

        // Devuelve true si el cliente se agregó correctamente
        return $stmt->rowCount() == 1;
    }




    // Agrega un cliente_Emp a la base de datos
   
    
        public function agregarCliente_Emp($telefono, $email, $hashPass, $nombre, $rut, $ci, $direccion) {
            try {
                // Comienza una transacción para asegurar la consistencia de los datos
                $this->pdo->beginTransaction();
    
                // Inserta el cliente principal
                $stmt = $this->pdo->prepare("INSERT INTO cliente (Correo, Pass, Direccion, Cel, Habilitado, Fecha_Ing, Foto_Perfil) VALUES (?, ?, ?, ?, 1, NOW(), '')");
                $stmt->execute([$email, $hashPass, $direccion, $telefono]);
    
                // Recupera el ID_Cliente generado en la inserción anterior
                $idCliente = $this->pdo->lastInsertId();
    
                // Inserta los datos específicos de la empresa
                $stmt = $this->pdo->prepare("INSERT INTO empresa (RUT, Nombre, CI_Enca, ID_Cliente) VALUES (?, ?, ?, ?)");
                $stmt->execute([$rut, $nombre, $ci, $idCliente]);
    
                // Confirma la transacción
                $this->pdo->commit();
    
                return true; // Registro exitoso
            } catch (PDOException $e) {
                // Manejo de errores, revierte la transacción en caso de error
                $this->pdo->rollBack();
                error_log("Error al agregar cliente empresarial: " . $e->getMessage());
                return false;
            }
        }

        // Agrega un cliente_Nor a la base de datos
    
        public function agregarCliente_Nor($telefono, $email, $hashPass, $nombre, $ci, $direccion) {
            try {
                // Comienza una transacción para asegurar la consistencia de los datos
                $this->pdo->beginTransaction();
    
                // Inserta el cliente principal
                $stmt = $this->pdo->prepare("INSERT INTO cliente (Correo, Pass, Direccion, Cel, Habilitado, Fecha_Ing, Foto_Perfil) VALUES (?, ?, ?, ?, 1, NOW(), '')");
                $stmt->execute([$email, $hashPass, $direccion, $telefono]);
    
                // Recupera el ID_Cliente generado en la inserción anterior
                $idCliente = $this->pdo->lastInsertId();
    
                // Inserta los datos específicos del cliente normal
                $stmt = $this->pdo->prepare("INSERT INTO normal (CI, Nombre, ID_Cliente) VALUES (?, ?, ?)");
                $stmt->execute([$ci, $nombre, $idCliente]);
    
                // Confirma la transacción
                $this->pdo->commit();
    
                return true; // Registro exitoso
            } catch (PDOException $e) {
                // Manejo de errores, revierte la transacción en caso de error
                $this->pdo->rollBack();
                error_log("Error al agregar cliente normal: " . $e->getMessage());
                return false;
            }
        }
 

    // ...

public function validarCredenciales($email, $password, ) {
    // Consulta para verificar las credenciales
    $sql = "SELECT ID_Cliente, Pass FROM cliente WHERE Correo = ?";

    // Prepara la consulta
    $stmt = $this->pdo->prepare($sql);

    // Ejecuta la consulta
    $stmt->execute([$email]);

    // Obtiene el registro del usuario (si existe)
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Pass'])) {
        // Las credenciales son válidas
        return array('success' => true, 'ID_Cliente' => $user['ID_Cliente']);
    } else {
        // Las credenciales son incorrectas
        return array('success' => false);
    }
}



}

