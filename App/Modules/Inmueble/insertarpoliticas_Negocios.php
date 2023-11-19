<?php

    require_once('../Master_Class.php');
    $ObjMaster = new Master_Class();


    try{

        $ArrayServicios = json_decode($_POST['ArrayServicios']);
    
        $resultadoConsulta = $ObjMaster->Insertar_ServiciosInmueble($ArrayServicios);
    
        if ($resultadoConsulta) {
            echo json_encode(array('exito' => true, 'mensaje' => 'Servicios de inmueble agregados correctamente'));
        } else {
            echo json_encode(array('exito' => false, 'mensaje' => 'Error al agregar los servicios del inmueble'));
        }
        
        
        
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }

?>