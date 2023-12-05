<?php
require_once('../../Master_Class.php');
$ObjMaster = new Master_Class();

// Lógica para modificar el cupón
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nombreCupon = $_POST['nombreCupon'];
        $montoDescuento = $_POST['montoDescuento'];
        $cantidadCupones = $_POST['cantidadCupones'];
        $fechaVencimiento = $_POST['fechaVencimiento'];
        $tipoDescuento = $_POST['tipoDescuento'];
        $idInmueble = $_POST['idInmueble'];

        // Llamada a la función correspondiente en Master_Class para modificar el cupón
        $resultado = $ObjMaster->modificarCupon($nombreCupon, $montoDescuento, $cantidadCupones, $fechaVencimiento, $tipoDescuento, $idInmueble);

        echo json_encode($resultado);
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}
?>