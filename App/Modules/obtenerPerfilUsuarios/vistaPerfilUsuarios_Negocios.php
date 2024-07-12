<?php
require_once('../Master_Class.php');

$master = new Master_Class();

// Obtener el ID del usuario desde la solicitud POST
$idUser = isset($_GET['idUser']) ? $_GET['idUser'] : null;

// Obtener los detalles del usuario desde la Master Class
$userDetails = $idUser ? $master->GetUsuarioDetails($idUser) : null;

// Devolver los detalles del usuario como respuesta en formato JSON
echo json_encode($userDetails);

?>
