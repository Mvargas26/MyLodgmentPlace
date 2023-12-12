<?php

    require_once('../Master_Class.php');
    $ObjMaster = new Master_Class();


    try {
        $ArrayServicios = json_decode($_POST['ArrayServicios']);
    
        if ($ArrayServicios === null) {
            throw new Exception('Error al decodificar la información de servicios.');
        }
    
        $resultadoConsulta = $ObjMaster->Insertar_ServiciosInmueble($ArrayServicios , $idInmueble);
    
        if ($resultadoConsulta) {
            echo json_encode(array('exito' => true, 'mensaje' => 'Servicios de inmueble agregados correctamente'));
        } else {
            throw new Exception('Error al agregar los servicios del inmueble.');
        }
    } catch (Exception $e) {
        echo json_encode(array('exito' => false, 'mensaje' => $e->getMessage()));
    }

?>