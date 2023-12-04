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

} catch (Exception $e) {
    echo json_encode(array('errortry' => $e->getMessage()));
}

?>