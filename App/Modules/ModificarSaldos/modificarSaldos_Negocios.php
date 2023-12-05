<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();

if (isset($_POST["crearReserva"])) {
    try {
        $idUsuario = $_POST["idUsuario"];
        $idInmueble = $_POST["idInmueble"];
        $valorTotal = $_POST["valorTotal"];

        // Llamada a la función correspondiente en Master_Class para crear el cupón con el ID del inmueble
        // $resultado = $ObjMaster->ModificarSaldos($idUsuario, $idInmueble, $valorTotal);
        
        
        $resultado = consumirEndpointPOST($idUsuario, 305420603, $valorTotal);

        echo json_encode($resultado);
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