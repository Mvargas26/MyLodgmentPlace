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

                //obtenemos el numero de cuenta del huesped
                $numCuentaCliente = obtenerCuenta($usuario);

                //obtenemos el saldo en su cuenta
                $saldoEnCuentaCliente = obtenerSaldo($numCuentaCliente);

                if ($numCuentaCliente == null || $saldoEnCuentaCliente ==null ||  $saldoEnCuentaCliente < $valorTotal ) {
                    echo json_encode(array("saldoEsMenor"));
                    return;
                }        

                //metodo para validar el cupon
                

                //rebaja la plata
                $resultado = consumirEndpointPOST($propietario, $usuario, $monto);
                $resultadoApiDecodificado =json_encode( $resultado);

                //Inserta la reserva
                $resultadoInsert = $ObjMaster->InsertarReserva($idUsuario, $idInmueble,$fechaInicio, $fechaFin, $valorTotal, $valorTotalImpuestos, $cantidadPersonasExtra, $cantidadPersonas);


       
                if ($resultado ||   $resultadoInsert ) {
                    // echo json_encode(array("exito" => true, "resultadoAPI" => $resultadoApiDecodificado,"resultadoInsert"=>$resultadoInsert));
                    echo json_encode(array("exito" => true, "numCuentaCliente" => $numCuentaCliente,"saldoEnCuentaCliente"=>$saldoEnCuentaCliente));

                } else {
                    echo json_encode(array(""));
                }

    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    };



    function obtenerCuenta($idUsuario)
    {

        $numeroCuentaAPIurl = 'https://tiusr29pl.cuc-carrera-ti.ac.cr/Mybanco/api/Cuentas/GetNumeroCuenta/' . $idUsuario;

        $numeroCuentaAPI = curl_init($numeroCuentaAPIurl);
        curl_setopt($numeroCuentaAPI, CURLOPT_RETURNTRANSFER, true);

        // Deshabilita la verificación del certificado SSL (para desarrollo local)
        curl_setopt($numeroCuentaAPI, CURLOPT_SSL_VERIFYPEER, false);

        $numeroCuenta = curl_exec($numeroCuentaAPI);

        if (curl_errno($numeroCuentaAPI)) {
            echo 'Error cURL: ' . curl_error($numeroCuentaAPI);
        }

        $httpCode = curl_getinfo($numeroCuentaAPI, CURLINFO_HTTP_CODE);

        if ($httpCode == 200) {
            return $numeroCuenta;
        } else {
            return null;
        }
    };//fin obtenerCuenta


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
    }; //fin consumirEndpointPOST


    function obtenerSaldo($idUsuario)
    {
        $saldoApiUrl = 'https://tiusr29pl.cuc-carrera-ti.ac.cr/Mybanco/api/Saldos/' . $idUsuario;

        $chSaldo = curl_init($saldoApiUrl);
        curl_setopt($chSaldo, CURLOPT_RETURNTRANSFER, true);

        // Deshabilita la verificación del certificado SSL (para desarrollo local)
        curl_setopt($chSaldo, CURLOPT_SSL_VERIFYPEER, false);

        $saldoApiResponse = curl_exec($chSaldo);

        if (curl_errno($chSaldo)) {
            echo 'Error cURL: ' . curl_error($chSaldo);
            return null; 
        }

        $httpCode = curl_getinfo($chSaldo, CURLINFO_HTTP_CODE);

        if ($httpCode == 200) {
            $saldoData = json_decode($saldoApiResponse, true);

            if ($saldoData === null) {
                echo 'Error decodificando JSON para los datos del saldo';
                return null; 
            } else {
                $saldo = isset($saldoData['saldo']) ? $saldoData['saldo'] : 'No disponible';
                return $saldo;
            }
        } else {
           
            return null; 
        }
    };//fin obtenerSaldo

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