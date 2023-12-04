<?php
require_once('../Master_Class.php');

$ObjMaster = new Master_Class();

try {

    if (isset($_POST['identificacion_cargalistaContactos'])) {
        
        $idHuesped = $_POST['identificacion_cargalistaContactos'];

        $resultadoConsulta = $ObjMaster->ConsultarlistaDeContactosDisponible_Huesped($idHuesped);

        if ($resultadoConsulta) {
            
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($resultadoConsulta);
            
            // Construir la respuesta como un array asociativo
            // $respuesta = array('data' => $resultadoConsulta);           
        } else {
            echo json_encode(array('error' => 'No hay datos disponibles'));
        }
    }

} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
?>