<?php
require_once('../Master_Class.php');

$ObjMaster = new Master_Class();

try {

    // ejecuto el ajax de cargar los nombres de los inmuebles
    if (isset($_POST['identificacion_Filtro'])) {
        $idHuesped = $_POST['identificacion_Filtro'];
        $resultadoConsulta = $ObjMaster->ConsultarInmuebles_ConResenias_Huesped($idHuesped);

        if ($resultadoConsulta) {
            header('Content-Type: application/json; charset=utf-8');
            
            // Construir la respuesta como un array asociativo
            // $respuesta = array('data' => $resultadoConsulta);           
            echo json_encode($resultadoConsulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array('error' => 'No hay datos disponibles'));
        }
    }


    if (isset($_POST['promedioCalificacionRecibida'])) {
        $idHuesped = $_POST['idHuesped'];
        $resultadoConsulta = $ObjMaster->CalcularPromedioCalificacionRecibida_Huesped($idHuesped);
    
        header('Content-Type: application/json; charset=utf-8');
    
        if ($resultadoConsulta !== null) {
            echo json_encode($resultadoConsulta);
        } else {
            echo json_encode(array('error' => 'No hay datos disponibles'));
        }
    }

    // if (isset($_POST['identificacion_ResenasRecibidas'])) {
    if (isset($_POST['identificacion'])) {
        try {

            // CONSULTA TODAS LAS RESENAS REALIZADAS BAJO ESTE ID
            $idHuesped = $_POST['identificacion'];
            $resultadoConsulta2 = $ObjMaster->ConsultarTUSResenas_porID_Huesped($idHuesped);
            if ($resultadoConsulta2) {

                // header('Content-Type: application/json; charset=utf-8');
                echo $resultadoConsulta2;
        
            } else {
                echo json_encode(array('error' => 'No hay datos disponibles'));
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }  

    if (isset($_POST['identificacion_ResenasRecibidas'])) {
        try {

            // CONSULTA TODAS LAS RESENAS REALIZADAS BAJO ESTE ID
            $idHuesped = $_POST['identificacion_ResenasRecibidas'];

            $resultadoConsulta3 = $ObjMaster->ConsultarTUSResenasRecibidas_porID_Huesped($idHuesped);
            if ($resultadoConsulta3) {

                // header('Content-Type: application/json; charset=utf-8');
                echo $resultadoConsulta3;
        
            } else {
                echo json_encode(array('error' => 'No hay datos disponibles'));
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } 


    //     if (isset($_POST['idInmueble'])) {

    //         $idInmueble = $_POST['idInmueble'];
    //         try {

    //             // $lugarSeleccionado = $_POST['lugarSeleccionado'];
    //             $resenasData = $ObjMaster->CalcularTotalDeResenasYPromedio_PorInmueble($idInmueble);

    //             // Decodificar el string JSON a un array de PHP
    //             // header('Content-Type: application/json; charset=utf-8');
    //             if ($resenasData) {

    //                 // $data = json_encode($resultadoConsulta2, JSON_UNESCAPED_UNICODE);
                
    //                 header('Content-Type: application/json; charset=utf-8');
    //                 echo json_encode($resenasData);
            
    //             } else {
    //                 echo json_encode(array('error' => 'No hay datos disponibles'));
    //             }
    //         } catch (Exception $e) {
    //             echo 'Error: ' . $e->getMessage();
    //         }
    //     }  
    
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}


try {
    
    if (isset($_POST['lugarSeleccionado_FiltrarInmueble'])) {
        try {

            $lugarSeleccionado = $_POST['lugarSeleccionado_FiltrarInmueble'];
            $idHuesped = $_POST['idHuesped'];


                // $resultadoConsulta2 = $ObjMaster->VERTODAS_RESENAS($idHuesped);    
                $resultadoConsulta2 = $ObjMaster->ConsultarResenas_porID_Huesped($lugarSeleccionado ,$idHuesped);
                
                // header('Content-Type: application/json; charset=utf-8');
                // echo json_encode($resultadoConsulta2, JSON_UNESCAPED_UNICODE);
                

            if ($resultadoConsulta2) {
                // echo json_encode(array('exito' => 'Si funciona correctamente'));               
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($resultadoConsulta2, JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array('error' => 'No hay datos disponibles')); 
            }

            // if ($resultadoConsulta2 && isset($resultadoConsulta2[0])) {
            //     header('Content-Type: application/json; charset=utf-8');
            //     echo json_encode($resultadoConsulta2[0], JSON_UNESCAPED_UNICODE);
            // } else {
            //     echo json_encode(array('exito' => false, 'error' => 'No hay datos disponibles'));
            // }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }   
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
?>