<?php

    require_once('../Master_Class.php');
    $ObjMaster = new Master_Class();

    if ($_POST["idInmueble"]) {

        $idInmueble = $_POST["idInmueble"];

        try {

            $resultadoConsulta = $ObjMaster->CargarImagenesInmuebles($idInmueble);
    
            if ($resultadoConsulta) {
                
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($resultadoConsulta, JSON_UNESCAPED_UNICODE);
        
            } else {
                echo json_encode(array('error' => 'No hay datos disponibles'));
            }
            
        } catch (Exception $e) {
            echo json_encode(array('error' => $e->getMessage()));
        }
    
    }

?>