<?php
    
    require_once('../Master_Class.php');
    
    $ObjMaster = new Master_Class();
    
    try {
        $resultadoConsulta = $ObjMaster->CargarServicios();
        
        if (is_array($resultadoConsulta)) {
            
            echo json_encode($resultadoConsulta);

        } else {
            
            echo json_encode(array('error' => $resultadoConsulta));
        }
    } catch (Exception $e) {
       
        echo json_encode(array('error' => $e->getMessage()));
    }


?>