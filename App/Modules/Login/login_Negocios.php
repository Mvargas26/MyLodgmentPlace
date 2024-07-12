<?php

require_once('../Master_Class.php');

$ObjMaster = new Master_Class();


if (isset($_POST["formData"])) {

    $identificacion = $_POST['formData']['identificacion'];
    $password = $_POST['formData']['password'];
    

    try {

        $resultadoConsulta = $ObjMaster->ConsultarUsuario($identificacion,$password);

        if ($resultadoConsulta) {
            $usuario = $resultadoConsulta->fetch_assoc();
        
            // Inicia la sesión y guarda la información deseada
            session_start();
            $_SESSION['Identificacion'] = $usuario['idUser'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['Rol'] = $usuario['idRol'];

            $data = array("exito"=>true,"nombre" =>  $_SESSION['nombre']);
        echo json_encode($data);
        } else {
            $response = array("message" => "Error en Iniciar Sesion");
        }

        

    } catch (\Throwable $th) {
        $response = array("message" => "Error en Negocios");
    }
}
?>
