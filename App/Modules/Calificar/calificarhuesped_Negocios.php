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
            $tipoCalificacion = 1;
            
             $resultadoConsulta = $ObjMaster->InsertarCalificacion( $ReservaCalificar, $comentarioCalificacion,
             $estrellasSeleccionadas,$cedAnfitrionCalifica,$tipoCalificacion);
            
            if ($resultadoConsulta) {
            
                echo json_encode(array('exito' => $resultadoConsulta));

            
                } else {
                    echo json_encode(array('error' => 'No hay datos disponibles'));
                }
        }else{
           echo json_encode(array('Vacio' =>'No entro al If'));
        }
        
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }

?>