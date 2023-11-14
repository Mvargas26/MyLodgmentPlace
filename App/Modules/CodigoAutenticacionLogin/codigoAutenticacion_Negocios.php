<?php
require_once('../Master_Class.php');

$ObjMaster = new Master_Class();

if (isset($_POST["verificarCodigo"])) {
    try {

        $codigoIngresado = $_POST["codigo"];
        $identificacion = $_POST["cedula"];
        $password = $_POST["password"];

        $codigoValido = $ObjMaster->verificarCodigoAutenticacion($identificacion, $codigoIngresado);

        if ($codigoValido) {
            $ObjMaster->eliminarCodigoAutenticacion($identificacion);

            $credencialesValidas = $ObjMaster->ConsultarUsuario($identificacion, $password);

            $usuario = $credencialesValidas->fetch_assoc();
    
            session_start();
            $_SESSION['Identificacion'] = $usuario['idUser'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['Rol'] = $usuario['idRol'];
            $_SESSION['Correo'] = $usuario['correo'];
    
            $identificacion = $_SESSION['Identificacion'];

            $data = array("exito" => true);
            echo json_encode($data);
        } else {
            $data = array("exito" => false);
            echo json_encode($data);
        }
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}
