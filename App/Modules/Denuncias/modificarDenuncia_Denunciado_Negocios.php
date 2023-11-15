<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();
session_start();

try {
    if (isset($_POST['respuesta'])) {
        $idDenuncia = $_POST['idDenuncia'];
        $respuestaDenunciado = $_POST['respuesta']; 

        $mensajeDB = $ObjMaster->modificarDenuncia($idDenuncia, $respuestaDenunciado);
        $data = array("exito" => $mensajeDB);
        echo json_encode($data);
    } else {
        echo json_encode(array('Vacio' => 'No entro al If'));
    }
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
?>