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
            // session_start();
            // $_SESSION['Identificacion'] = $usuario['idUser'];
            // $_SESSION['nombre'] = $usuario['nombre'];
            // $_SESSION['Rol'] = $usuario['idRol'];
            // $_SESSION['Correo'] = $usuario['correo'];
            

            $codigoAutenticacion = $ObjMaster->generarCodigoAleatorio(5);

            // Almacenar el código en la base de datos
            $ObjMaster->almacenarCodigoAutenticacion($usuario['idUser'], $codigoAutenticacion);

            $correoEnviado = $ObjMaster->enviarCodigoAutenticacionCorreo($usuario['correo'], $codigoAutenticacion);

            if ($correoEnviado) {
                $data = array("exito"=>true);
 
                echo json_encode($data);
                // echo json_encode(array('exito' => true, 'nombre' => $usuario['nombre']));
            } else {
                $data = array("exito"=>false);
 
                echo json_encode($data);
                // echo json_encode(array('exito' => false, 'response' => 'Error al enviar el correo.'));
            } 
        }

    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}
?>
