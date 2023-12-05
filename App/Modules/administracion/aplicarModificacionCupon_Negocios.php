<?php
require_once('../Master_Class.php');

// Crear una instancia de la clase principal
$ObjMaster = new Master_Class();

// Verificar si se han enviado los datos para modificar el cupón
if (isset($_POST['idInmueble'],$_POST['nombreCupon'], $_POST['nuevoNombreCupon'], $_POST['montoDescuento'], $_POST['cantidadCupones'], $_POST['fechaVencimiento'])) {
    $idInmueble = $_POST['idInmueble'];
    $nombreCupon = $_POST['nombreCupon'];
    $nuevoNombreCupon = $_POST['nuevoNombreCupon']; // Nuevo nombre del cupón
    $montoDescuento = $_POST['montoDescuento'];
    $cantidadCupones = $_POST['cantidadCupones'];
    $fechaVencimiento = $_POST['fechaVencimiento'];

    // Aplicar la modificación del cupón utilizando la Master_Class
    $modificado = $ObjMaster->modificarDatosCupon($idInmueble, $nombreCupon, $nuevoNombreCupon, $montoDescuento, $cantidadCupones, $fechaVencimiento);

    // Devolver una respuesta al cliente (puede ser un objeto JSON)
    echo json_encode(['modificado' => $modificado]);
}
?>