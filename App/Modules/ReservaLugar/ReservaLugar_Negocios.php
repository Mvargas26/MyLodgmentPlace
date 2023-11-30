<?php
require_once('../Master_Class.php');

$ObjMaster = new Master_Class();

if (isset($_POST["crearReserva"])) {
    try {
        $idUsuario = $_POST["idUsuario"];
        $idInmueble = $_POST["idInmueble"];
        $fechaInicio = $_POST["fechaInicio"];
        $fechaFin = $_POST["fechaFin"];
        $Cupon = $_POST["Cupon"];
        $valorTotal = $_POST["valorTotal"];
        $valorTotalImpuestos = $_POST["valorTotalImpuestos"];
        $cantidadPersonasExtra = $_POST["cantidadPersonasExtra"];
        $cantidadPersonas = $_POST["cantidadPersonas"];
        

        $respuestaReserva = $ObjMaster->ReservaLugar($idUsuario, $idInmueble, $fechaInicio, $fechaFin, $Cupon, $valorTotal, $valorTotalImpuestos, $cantidadPersonasExtra, $cantidadPersonas);

        $notificacionReserva = $ObjMaster->InsertarNotificacion_Reserva($idInmueble , $idUsuario);
        if ($respuestaReserva) {

            echo json_encode($respuestaReserva);
        }
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}
