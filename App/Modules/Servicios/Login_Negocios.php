<?php

require_once('../Master_Class.php');
$ObjMaster = new Master_Class();

if (isset($_POST["verificarCredenciales"])) {
    try {
        $identificacion = $_POST["identificacion"];
        $password = $_POST["password"];

        // Verificar las credenciales utilizando la Master Class
        $credencialesValidas = $ObjMaster->ConsultarUsuario($identificacion, $password);
        
        if ($credencialesValidas) {
            $usuario = $credencialesValidas->fetch_assoc();
        
            // Inicia la sesión y guarda la información deseada
            session_start();
            $_SESSION['Identificacion'] = $usuario['idUser'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['Rol'] = $usuario['idRol'];
            $_SESSION['Correo'] = $usuario['correo'];
        }


        // Devolver el resultado como texto ("true" o "false")
        echo $credencialesValidas ? "true" : "false";
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}
?>
