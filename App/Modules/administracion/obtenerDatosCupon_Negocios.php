<?php
require_once('../Master_Class.php');

// Crear una instancia de la clase principal
$ObjMaster = new Master_Class();

// Verificar si se ha enviado el nombre del cupón
if (isset($_GET['cupon'])) {
    $nombreCupon = $_GET['cupon'];

    // Obtener los datos del cupón desde la base de datos utilizando la Master_Class
    $datosCupon = $ObjMaster->obtenerDatosCupon($nombreCupon);

    echo json_encode($datosCupon); // Devolver los datos del cupón en formato JSON
}
?>