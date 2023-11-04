<?php

require_once('../Master_Class.php');

$ObjMaster = new Master_Class();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // sacamos lo que trae
    $identificacion = $data["identificacion"];
    $nombre = $data["nombre"];
    $primerApellido = $data["primerApellido"];
    $segundoApellido = $data["segundoApellido"];
    $email = $data["email"];
    $telefono = $data["telefono"];
    $fotoPerfil =$data['fotoPerfil'];//$data["fotoPerfil"];

    // Aqui se manda a la db
   $mensajeDB= $ObjMaster->InsertarImagen($fotoPerfil, $nombre);

    //Retorno el nombre para mostrarlo en el mensaje
    $response = array("message" => "$mensajeDB", "nombre" => $fotoPerfil);
    echo json_encode($response);
}
?>
