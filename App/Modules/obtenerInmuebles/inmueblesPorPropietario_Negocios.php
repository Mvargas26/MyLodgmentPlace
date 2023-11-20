<?php
require_once('../Master_Class.php');

$master = new Master_Class();

// Obtener el ID del usuario desde la solicitud POST
$idUser = isset($_POST['idUser']) ? $_POST['idUser'] : null;

// Verificar que se proporcionó el ID del usuario
if ($idUser !== null) {
    // Obtener los inmuebles asociados al usuario desde la Master Class
    $inmuebles = $master->GetInmueblesByPropietario($idUser);

    // Devolver los inmuebles como respuesta en formato JSON
    echo json_encode($inmuebles);
} else {
    // Devolver una respuesta de error si no se proporcionó el ID del usuario
    echo json_encode(array('error' => 'ID de usuario no proporcionado.'));
}
?>
