<?php

    require_once('../Master_Class.php');
    $ObjMaster = new Master_Class();


    try{
        $cancelacion = $_POST['Cancelacion'];
        $reembolso = $_POST['reembolso'];
        $horario = $_POST['horario'];
        $cargos = $_POST['cargos'];
           
        $resultadoConsulta = $ObjMaster->Insertar_PoliticasInmueble($cancelacion , $reembolso , $horario , $cargos);
    
        if ($resultadoConsulta) {
            echo json_encode(array('exito' => true, 'mensaje' => 'Politicas agregadas correctamente'));
        } else {
            echo json_encode(array('exito' => false, 'mensaje' => 'Error al agregar las Politicas del inmueble'));
        }
        
        
        
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }

?>