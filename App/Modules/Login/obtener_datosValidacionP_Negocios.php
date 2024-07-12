<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();
session_start();

if (isset($_POST["Identificacion"])) {
    $identificacion = $_POST["Identificacion"];
    $resultadoConsulta = $ObjMaster->ConsultarValidacionUsuario($identificacion); 
    if ($resultadoConsulta) {
        $data = $resultadoConsulta->fetch_assoc();
        echo json_encode($data);
    } else {
        $response = array("message" => "Error al obtener el estado de la validacion del perfil");
    }
}
?>