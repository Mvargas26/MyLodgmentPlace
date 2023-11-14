<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();

class Negocios_Reservas {
    public function obtenerHistorialReservas($idUser) {
        global $ObjMaster;
        return $ObjMaster->obtenerHistorialReservasUsuario($idUser);
    }
}

if (isset($_POST["obtenerHistorial"])) {
    session_start();
    $idUser = $_SESSION['Identificacion'];
    $negociosReservas = new Negocios_Reservas();
    $historialReservas = $negociosReservas->obtenerHistorialReservas($idUser);
    echo json_encode($historialReservas);
}
?>