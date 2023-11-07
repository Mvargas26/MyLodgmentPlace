<?php

// logica metodos capa de negocios


require_once('../Master_Class.php');

$ObjMaster = new Master_Class();


if (isset($_POST["imagenData"])) {

    $img = $_POST['imagenData'];
    $nombre = $_POST['formData']['nombre'];

    try {

        $mensajeDB = $ObjMaster->InsertarImagen($img, $nombre);

        

        $data = array("exito"=>$mensajeDB,"nombre" => $nombre);

        echo json_encode($data);

    } catch (\Throwable $th) {
        $response = array("message" => "Error en Negocios");
    }
}
?>

