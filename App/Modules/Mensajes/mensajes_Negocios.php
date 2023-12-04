<?php
require_once('../Master_Class.php');
session_start();

$ObjMaster = new Master_Class();



try {

    if (isset($_POST['incoming_id']) && isset($_POST['idUsuarioLogueado'])) {
        
        $idUsuarioElegido = $_POST['incoming_id'];
        $idUsuarioLogueadovar = $_POST['idUsuarioLogueado'];

        // echo json_encode(array('respuesta' =>  $idUsuarioLogueadovar , $idUsuarioElegido ));

        if(isset($_SESSION['Rol'])) {
            $rolUsuario = $_SESSION['Rol'];
        
            if($rolUsuario == 3) {
                $output = $ObjMaster->ObtenerChatsHuesped($idUsuarioElegido, $idUsuarioLogueadovar);
            } else {
                $output = $ObjMaster->ObtenerChatsAnfitrion($idUsuarioElegido, $idUsuarioLogueadovar);
            }
        }
        if ($output) {            
            // header('Content-Type: application/json; charset=utf-8');
            echo $output;         
        } else {
            echo json_encode(array('error' => 'No hay datos disponibles'));
        }
    }

    
    if (isset($_POST['idEmisor']) && isset($_POST['idReceptor']) && isset($_POST['mensaje'])) {
        $idEmisor = $_POST['idEmisor'];
        $idReceptor = $_POST['idReceptor'];
        $mensaje = $_POST['mensaje'];
    
        $resultadoConsulta = $ObjMaster->InsertarMensajes($idEmisor, $idReceptor, $mensaje);
        
        if ($resultadoConsulta !== false) {
            // Operación exitosa
            echo json_encode(array('exito' => true));
        } else {
            // Error o fallo en la operación
            echo json_encode(array('exito' => false, 'error' => 'Error al insertar mensaje en la base de datos.'));
        }
    } 
    // else {
    //     // Faltan parámetros en la solicitud
    //     echo json_encode(array('exito' => false, 'error' => 'Faltan parametros en la solicitud.'));
    // }




} catch (Exception $e) {
    echo json_encode(array('errortry' => $e->getMessage()));
}

?>