<?php
require_once('../Master_Class.php');

$ObjMaster = new Master_Class();

try {

    if (isset($_POST['identificacion_cargalistaContactos'])) {
        
        $idAnfitrion = $_POST['identificacion_cargalistaContactos'];

        $resultadoConsulta = $ObjMaster->ConsultarlistaDeContactosDisponible_Anfitrion($idAnfitrion);

        if ($resultadoConsulta) {
            
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($resultadoConsulta);
            
            // Construir la respuesta como un array asociativo
            // $respuesta = array('data' => $resultadoConsulta);           
        } else {
            echo json_encode(array('error' => 'No hay datos disponibles'));
        }
    }

    if (isset($_POST['idEmisor']) && isset($_POST['idReceptor']) && isset($_POST['mensaje'])) {
    
        $idEmisor = $_POST['idEmisor'];
        $idReceptor = $_POST['idReceptor'];
        $mensaje = $_POST['mensaje'];
    
        
        $resultadoConsulta = $ObjMaster->InsertarMensajes($idAnfitrion);
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