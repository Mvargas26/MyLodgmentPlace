<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();

if (isset($_POST["crearReserva"])) {
    try {
        $cedulaDuenno = $_POST["cedulaDuenno"];
        $idUsuario = $_POST["idUsuario"];
        $idInmueble = $_POST["idInmueble"];
        $valorTotal = $_POST["valorTotal"];
        $CuponDescuento = $_POST["Cupon"];
        $fechInicio = $_POST["fechaInicio"];
        $fechaFin = $_POST["fechaFin"];
        $valorTotalImpuestos = $_POST["valorTotalImpuestos"];
        $cantidadPersonasExtra = $_POST["cantidadPersonasExtra"];
        $cantidadPersonas = $_POST["cantidadPersonas"];

        // Llamada a la función correspondiente en Master_Class para crear el cupón con el ID del inmueble
        // $idDuenno = $ObjMaster->obteneridDuenno($idInmueble);

        $a = intval($idUsuario);
        $B = intval($cedulaDuenno);
        $c = floatval($valorTotal);
        
        // if ($CuponDescuento != "") {

        //     $Cupon = $ObjMaster->VerificarCupon($idInmueble, $CuponDescuento, $fechInicio);

        //     if ($Cupon === false) {
        //         echo json_encode(array('error' => 'Cupón no válido'));
        //     } else {
        //         $valorTotal = $valorTotal - ($valorTotal * (($Cupon + 5) / 100));
        //     }
        // }

        // $valorTotal = $valorTotal - ($valorTotal * ((5)/100));

        $resultado = consumirEndpointPOST($a, $B, $c);

        // $resultado2 = $ObjMaster->InsertarReserva($idUsuario, $idInmueble,$fechInicio, $fechaFin, $valorTotal, $valorTotalImpuestos, $cantidadPersonasExtra, $cantidadPersonas);

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado) {
            echo json_encode(array('exito' => true, 'mensaje' => $notificacion));
        } else {
            echo json_encode(array('error' => true, 'mensaje' => $notificacion));
        }

    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}

function consumirEndpointPOST($cedulasumar, $cedularestar, $monto) {
    $endpoint = 'https://localhost:44384/api/Cuentas/cobros/'. $cedulasumar .','. $cedularestar .','. $monto;
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
}
?>