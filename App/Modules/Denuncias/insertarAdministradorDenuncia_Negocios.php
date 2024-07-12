<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();
session_start(); 
if (isset($_POST['idDenuncia'])) {
    $idDenuncia = $_POST['idDenuncia'];
    $identificacion = $_POST['identificacionAdm'];
    $respuestaDenunciaAdm = $_POST['RespuestaDenunciaAdmin'];
    $estadoNuevo = $_POST['estadoNuevo'];
    $veredicto = $_POST['veredicto'];

    $mensajeDB = $ObjMaster->modificarDenunciaAdm($idDenuncia, $identificacion, $respuestaDenunciaAdm, $estadoNuevo, $veredicto);
    $data = array("exito" => $mensajeDB);
    echo json_encode($data);
} else {
    echo json_encode(array('Vacio' => 'No entro al If'));
}
?>