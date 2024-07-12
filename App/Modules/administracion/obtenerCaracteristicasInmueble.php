<?php
require_once('../Master_Class.php');

// Crear una instancia de la clase principal
$ObjMaster = new Master_Class();

// Verificar si se ha enviado el nombre del cupón
if (isset($_GET['inmueble'])) {
    $inmueble = $_GET['inmueble'];

    // Obtener los datos del cupón desde la base de datos utilizando la Master_Class
    $datosInmueble = $ObjMaster->obtenerCaracteristicasInmueble($inmueble);

    echo json_encode($datosInmueble); // Devolver los datos del cupón en formato JSON
}
?>