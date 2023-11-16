<?php
require_once('../Master_Class.php');

$master = new Master_Class();

// Obtener la lista de usuarios desde la Master Class
$users = $master->GetUsuarios();

// Devolver los usuarios como respuesta en formato JSON
echo json_encode($users);
?>
