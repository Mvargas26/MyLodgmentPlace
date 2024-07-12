<?php
require_once('../Master_Class.php');

$ObjMaster = new Master_Class();

try {
    if (isset($_POST['identificacion'])) {
        $idAnfitrion = $_POST['identificacion'];
        $resultadoConsulta = $ObjMaster->ConsultarInmuebles_ConResenias($idAnfitrion);

        if ($resultadoConsulta) {
            header('Content-Type: application/json; charset=utf-8');
            
            // Construir la respuesta como un array asociativo
            // $respuesta = array('data' => $resultadoConsulta);           
            echo json_encode($resultadoConsulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array('error' => 'No hay datos disponibles'));
        }
    }
    // } else {
    //     echo json_encode(array('error' => 'Falta el parámetro identificacion en la solicitud!!!!!'));
    // }
    if (isset($_POST['lugarSeleccionado'])) {
        try {

            $lugarSeleccionado = $_POST['lugarSeleccionado'];
            $resultadoConsulta2 = $ObjMaster->ConsultarResenas_porID($lugarSeleccionado);
            // Decodificar el string JSON a un array de PHP
            // header('Content-Type: application/json; charset=utf-8');
            if ($resultadoConsulta2) {

                // $data = json_encode($resultadoConsulta2, JSON_UNESCAPED_UNICODE);
            
                // header('Content-Type: application/json; charset=utf-8');
                echo $resultadoConsulta2;
        
            } else {
                echo json_encode(array('error' => 'No hay datos disponibles'));
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }  

    if (isset($_POST['idInmueble'])) {

        $idInmueble = $_POST['idInmueble'];
        try {

            // $lugarSeleccionado = $_POST['lugarSeleccionado'];
            $resenasData = $ObjMaster->CalcularTotalDeResenasYPromedio_PorInmueble($idInmueble);

            // Decodificar el string JSON a un array de PHP
            // header('Content-Type: application/json; charset=utf-8');
            if ($resenasData) {

                // $data = json_encode($resultadoConsulta2, JSON_UNESCAPED_UNICODE);
            
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($resenasData);
        
            } else {
                echo json_encode(array('error' => 'No hay datos disponibles'));
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }  
    
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}


// try {
    
//     if (isset($_POST['lugarSeleccionado'])) {
//         try {

//             $lugarSeleccionado = $_POST['lugarSeleccionado'];
//             $resultadoConsulta2 = $ObjMaster->ConsultarResenas_porID($lugarSeleccionado);
//             // Decodificar el string JSON a un array de PHP
//             // header('Content-Type: application/json; charset=utf-8');
//             if ($resultadoConsulta2) {

//                 $data = json_encode($resultadoConsulta2, JSON_UNESCAPED_UNICODE);
            
//                 header('Content-Type: application/json; charset=utf-8');
//                 return $data;
        
//             } else {
//                 echo json_encode(array('error' => 'No hay datos disponibles'));
//             }
//         } catch (Exception $e) {
//             echo 'Error: ' . $e->getMessage();
//         }
//     }   
// } catch (Exception $e) {
//     echo json_encode(array('error' => $e->getMessage()));
// }
?>