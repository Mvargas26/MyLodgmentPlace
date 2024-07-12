<?php
require_once('../Master_Class.php');

$master = new Master_Class();

$users = $master->GetUsuarios();

// Configurar el encabezado para indicar que la respuesta es JSON
header('Content-Type: application/json');

echo json_encode($users);
?>