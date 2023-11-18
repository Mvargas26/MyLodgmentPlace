<?php

require_once('../Master_Class.php');
$ObjMaster = new Master_Class();

class Negocios_CrearCupon {
    public function crearCupon($montoDescuento, $cantidadCupones, $fechaVencimiento, $tipoDescuento) {
        global $ObjMaster;

        // Validaciones adicionales aquí si es necesario

        // Llamada a la función del MasterClass para crear el cupón
        return $ObjMaster->crearCupon($montoDescuento, $cantidadCupones, $fechaVencimiento, $tipoDescuento);
    }
}

if (isset($_POST["crearCupon"])) {
    $negociosCrearCupon = new Negocios_CrearCupon();
    $resultado = $negociosCrearCupon->crearCupon(
        $_POST["montoDescuento"],
        $_POST["cantidadCupones"],
        $_POST["fechaVencimiento"],
        $_POST["tipoDescuento"]
    );

    echo json_encode($resultado);
}
?>