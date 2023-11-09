<?php

// logica metodos capa de negocios


require_once('../Master_Class.php');

$ObjMaster = new Master_Class();


if (isset($_POST["imagenData"])) {

    $img = $_POST['imagenData'];
    $identificacion = $_POST['formData']['identificacion'];
    $Clave = $_POST['formData']['Clave'];
    $nombre = $_POST['formData']['nombre'];
    $primerApellido = $_POST['formData']['primerApellido'];
    $segundoApellido = $_POST['formData']['segundoApellido'];
    $email = $_POST['formData']['email'];
    $telefono = $_POST['formData']['telefono'];
    $edad = $_POST['formData']['edad'];
    $idRol = $_POST['formData']['idRol'];
    $direccion = $_POST['formData']['direccion'];

    try {

        $mensajeDB = $ObjMaster->InsertarUsuario($img,$identificacion,$Clave,$nombre,$primerApellido,$segundoApellido,
        $email,$telefono,$edad,$idRol,$direccion);


        $data = array("exito"=>$mensajeDB,"nombre" => $nombre);

        echo json_encode($data);

    } catch (\Throwable $th) {
        $response = array("message" => "Error en Negocios");
    }
}
?>

