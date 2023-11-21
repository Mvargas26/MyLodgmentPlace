<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();

if (isset($_POST["crearCupon"])) {
    try {
        $nombreCupon = $_POST["nombreCupon"];
        $montoDescuento = $_POST["montoDescuento"];
        $cantidadCupones = $_POST["cantidadCupones"];
        $fechaVencimiento = $_POST["fechaVencimiento"];
        $tipoDescuento = $_POST["tipoDescuento"];
        $idInmueble = $_POST["idInmueble"]; // Obtener el ID del inmueble

        // Llamada a la función correspondiente en Master_Class para crear el cupón con el ID del inmueble
        $resultado = $ObjMaster->crearCupon($nombreCupon, $montoDescuento, $cantidadCupones, $fechaVencimiento, $tipoDescuento, $idInmueble);

        echo json_encode($resultado);
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}
?>