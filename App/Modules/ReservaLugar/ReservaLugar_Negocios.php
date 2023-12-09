<?php
    require_once('../Master_Class.php');
    $ObjMaster = new Master_Class();


      try {

                $idUsuario =  $_POST['idUsuario'];
                $idPropietario =  $_POST['idPropietario'];
                $idInmueble = $_POST['idInmueble'];
                $cantidadPersonas = $_POST['cantidadPersonas'];
                $cantidadPersonasExtra = $_POST['cantidadPersonasExtra'];
                $fechaInicio = $_POST['fechaInicio'];
                $fechaFin = $_POST['fechaFin'];
                $Cupon = $_POST['Cupon'];
                $valorTotal = $_POST['valorTotal'];
                $valorTotalImpuestos =  $_POST['valorTotalImpuestos']; 

                $usuario = intval($idUsuario);
                $propietario = intval($idPropietario);
                $monto = floatval($valorTotal);
                
                $resultado = consumirEndpointPOST($propietario, $usuario, $monto);

                if ($resultado) {
                    echo json_encode(array('exito' => true, 'mensaje' => $resultado));
                } else {
                    echo json_encode(array('error' => true, 'mensaje' => $resultado));
                }
        

                
                
                //     if (isset($_POST['data'])) {


    //         // $ReservaCalificar = $_POST['formData']['ReservaCalificar'];
    //         // $comentarioCalificacion = $_POST['formData']['comentarioCalificacion'];
    //         // $estrellasSeleccionadas = $_POST['formData']['estrellasSeleccionadas'];
    //         // $cedAnfitrionCalifica = $_POST['formData']['cedAnfitrionCalifica'];
    //         // //calificar Huesped es 1
    //         // if ($_POST['formData']['Rol']==2) {
    //         //     $tipoCalificacion = 1;
    //         // }else{
    //         //     $tipoCalificacion = 3;
    //         // }
            
    //         //  $resultadoConsulta = $ObjMaster->InsertarCalificacion( $ReservaCalificar, $comentarioCalificacion,
    //         //  $estrellasSeleccionadas,$cedAnfitrionCalifica,$tipoCalificacion);

    //         //  $notificacion_Huesped_y_Anfitrion = $ObjMaster->InsertarNotificacion_CuandoCalificaElAnfitrion($cedAnfitrionCalifica , $ReservaCalificar);
             
    //         //  if ($resultadoConsulta && $notificacion_Huesped_y_Anfitrion) {

                
    //         //     echo json_encode(array('exito' => true));
    //         // } else {
    //         //     echo json_encode(array('exito' => false));
    //         // }
    //     }else{
    //        echo json_encode(array('Vacio' =>'No entro al If'));
    //     }
        
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }

    function consumirEndpointPOST($cedulasumar, $cedularestar, $monto) {
        $endpoint = 'https://tiusr29pl.cuc-carrera-ti.ac.cr/Mybanco/api/Cuentas/cobros/'. $cedulasumar .','. $cedularestar .','. $monto;
        $data = []; // Aquí puedes definir los datos que desees enviar en el cuerpo de la solicitud
    
        $options = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ],
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => json_encode($data)
            ]
        ];
    
        $context = stream_context_create($options);
        $response = file_get_contents($endpoint, false, $context);
    
        if ($response === false) {
            return 'Error en la solicitud';
        } else {
            return $response;
        }
    }//fin consumirEndpointPOST

?>


















//<?php
// require_once('../Master_Class.php');

// $ObjMaster = new Master_Class();

// if (isset($_POST["crearReserva"])) {
//     try {
//         $idUsuario = $_POST["idUsuario"];
//         $idInmueble = $_POST["idInmueble"];
//         $fechaInicio = $_POST["fechaInicio"];
//         $fechaFin = $_POST["fechaFin"];
//         $Cupon = $_POST["Cupon"];
//         $valorTotal = $_POST["valorTotal"];
//         $valorTotalImpuestos = $_POST["valorTotalImpuestos"];
//         $cantidadPersonasExtra = $_POST["cantidadPersonasExtra"];
//         $cantidadPersonas = $_POST["cantidadPersonas"];
        

//         $respuestaReserva = $ObjMaster->ReservaLugar($idUsuario, $idInmueble, $fechaInicio, $fechaFin, $Cupon, $valorTotal, $valorTotalImpuestos, $cantidadPersonasExtra, $cantidadPersonas);

//         $notificacionReserva = $ObjMaster->InsertarNotificacion_Reserva($idInmueble , $idUsuario);
//         if ($respuestaReserva) {

//             echo json_encode($respuestaReserva);
//         }
//     } catch (Exception $e) {
//         echo json_encode(array('error' => $e->getMessage()));
//     }
// }
?>