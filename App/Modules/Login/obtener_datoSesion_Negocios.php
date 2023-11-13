<?php
session_start();

// Verifica si la sesión está iniciada
if (isset($_SESSION['Identificacion'])) {
    $sesionData = array(
        'cedula' => $_SESSION['Identificacion'],
        // Agrega más datos de la sesión según sea necesario
    );

    // Devuelve los datos de la sesión como respuesta JSON
    echo json_encode($sesionData);
} else {
    // Devuelve un mensaje de error si la sesión no está iniciada
    echo json_encode(array('error' => 'Sesión no iniciada'));
}
?>
