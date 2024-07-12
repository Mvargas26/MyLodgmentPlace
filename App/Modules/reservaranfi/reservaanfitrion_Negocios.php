<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idUsuario = $_POST['idUsuario'];
    $idInmueble = $_POST['idInmueble'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $tipoReserva = $_POST['tipoReserva'];


    if (empty($idUsuario) || empty($idInmueble) || empty($fechaInicio) || empty($fechaFin) || empty($tipoReserva)) {
        $response = array('success' => false, 'message' => 'Todos los campos son obligatorios.');
    } else {
       
        $conn = new mysqli("185.211.7.52", "u538860919_sitios", "Sitios2023", "u538860919_mylodgmentplac");

      
        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        // Realiza la inserción en la tabla de reservas
        $sql = $sql = "INSERT INTO tbreserva (idUsuario, idInmueble, fechaInicio, fechaFin, tipoReserva) 
        VALUES ('$idUsuario', '$idInmueble', '$fechaInicio', '$fechaFin', 'anfitrión $tipoReserva')";
;

        if ($conn->query($sql) === TRUE) {
            $response = array('success' => true, 'message' => 'Reserva guardada exitosamente.');
        } else {
            $response = array('success' => false, 'message' => 'Error al guardar la reserva: ' . $conn->error);
        }

        // Cierra la conexión a la base de datos
        $conn->close();
    }
} else {
    $response = array('success' => false, 'message' => 'Solicitud no válida.');
}

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
