<?php

    require_once('../Master_Class.php');
    $ObjMaster = new Master_Class();

     try {

        $resultadoConsulta = $ObjMaster->ConsultarInmuebles();

        if ($resultadoConsulta) {
            
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($resultadoConsulta, JSON_UNESCAPED_UNICODE);
    
        } else {
            echo json_encode(array('error' => 'No hay datos disponibles'));
        }
        
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }


?>