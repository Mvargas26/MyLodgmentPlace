<?php
require_once('../Master_Class.php');

// Crear una instancia de la clase principal
$ObjMaster = new Master_Class();

if (isset($_GET['lugar'])) {
    $lugarSeleccionado = $_GET['lugar'];

    // Obtener los cupones del inmueble seleccionado desde la base de datos utilizando la Master_Class
    $cupones = $ObjMaster->obtenerCuponesPorInmueble($lugarSeleccionado);

    echo json_encode($cupones); // Devolver los cupones en formato JSON
} else {
    echo json_encode(array()); // Si no se proporciona un lugar, devolver un array vacío
}
?>