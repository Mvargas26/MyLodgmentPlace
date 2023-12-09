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

                //rebaja la plata
                $resultado = consumirEndpointPOST($propietario, $usuario, $monto);

                //Inserta la reserva
                $resultadoInsert = $ObjMaster->InsertarReserva($idUsuario, $idInmueble,$fechaInicio, $fechaFin, $valorTotal, $valorTotalImpuestos, $cantidadPersonasExtra, $cantidadPersonas);



                if ($resultado) {
                    echo json_encode(array('exito' => true, 'mensajeAPI' => $resultado,'mensajeReserva' => $resultadoInsert));
                } else {
                    echo json_encode(array('error' => true, 'mensajeAPI' => $resultado,'mensajeReserva' => $resultadoInsert));
                }

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