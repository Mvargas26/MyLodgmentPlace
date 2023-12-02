<?php
    require_once('../Master_Class.php');
    $ObjMaster = new Master_Class();

     try {
        if (isset($_POST['formData'])) {

            $ReservaCalificar = $_POST['formData']['ReservaCalificar'];
            $comentarioCalificacion = $_POST['formData']['comentarioCalificacion'];
            $estrellasSeleccionadas = $_POST['formData']['estrellasSeleccionadas'];
            $cedAnfitrionCalifica = $_POST['formData']['cedAnfitrionCalifica'];
            //calificar Huesped es 1
            if ($_POST['formData']['Rol']==2) {
                $tipoCalificacion = 1;
            }else{
                $tipoCalificacion = 3;
            }
            
             $resultadoConsulta = $ObjMaster->InsertarCalificacion( $ReservaCalificar, $comentarioCalificacion,
             $estrellasSeleccionadas,$cedAnfitrionCalifica,$tipoCalificacion);

             $notificacion_Huesped_y_Anfitrion = $ObjMaster->InsertarNotificacion_CuandoCalificaElAnfitrion($cedAnfitrionCalifica , $ReservaCalificar);
             
             if ($resultadoConsulta && $notificacion_Huesped_y_Anfitrion) {

                
                echo json_encode(array('exito' => true));
            } else {
                echo json_encode(array('exito' => false));
            }
        }else{
           echo json_encode(array('Vacio' =>'No entro al If'));
        }
        
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }

?>