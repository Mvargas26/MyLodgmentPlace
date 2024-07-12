<?php

require_once('../Master_Class.php');
$ObjMaster = new Master_Class();

if (isset($_POST["verificarCredenciales"])) {
    try {
        $identificacion = $_POST["identificacion"];
        $password = $_POST["password"];

        $credencialesValidas = $ObjMaster->ConsultarUsuario($identificacion, $password);
        
        if ($credencialesValidas) {
            $usuario = $credencialesValidas->fetch_assoc();


            $codigoAutenticacion = $ObjMaster->generarCodigoAleatorio(5);

            $ObjMaster->almacenarCodigoAutenticacion($usuario['idUser'], $codigoAutenticacion);

            $correoEnviado = $ObjMaster->enviarCodigoAutenticacionCorreo($usuario['correo'], $codigoAutenticacion);

            if ($correoEnviado) {
                $data = array("exito"=>true);
 
                echo json_encode($data);
            } else {
                $data = array("exito"=>false);
 
                echo json_encode($data);
            } 
        }

    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}
?>
