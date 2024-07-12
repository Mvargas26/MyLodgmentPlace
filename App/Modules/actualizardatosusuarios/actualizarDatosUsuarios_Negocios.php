<?php
session_start();

require_once('../Master_Class.php');

$idUser = $_SESSION['Identificacion'];

$ObjMaster = new Master_Class();

if (isset($_POST["actualizardatos"])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido1 = htmlspecialchars($_POST['apellido1']);
    $apellido2 = htmlspecialchars($_POST['apellido2']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $correo = htmlspecialchars($_POST['correo']);

    $idUser = $idUser;

    $actualizacionExitosa = $ObjMaster->actualizaNombreApellido($idUser, $nombre, $apellido1, $apellido2, $direccion, $telefono, $correo);

    if ($actualizacionExitosa) {
        echo "Datos actualizados correctamente";
        
    } else {
        echo "Error al actualizar datos";
    }
} else {
    echo "Error: Solicitud no válida";
}

?>


