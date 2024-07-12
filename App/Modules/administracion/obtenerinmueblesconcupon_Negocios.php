<?php
require_once('../Master_Class.php');
session_start();

$idPropietario = $_SESSION['Identificacion'];
// Crear una instancia de la clase principal
$ObjMaster = new Master_Class();



// Obtener los inmuebles con cupones desde la base de datos utilizando la Master_Class
$inmuebles = $ObjMaster->obtenerInmueblesConCupon($idPropietario);

// Si la función devuelve el nombre y el id del inmueble
$resultado = array();
foreach ($inmuebles as $inmueble) {
    $resultado[] = array(
        'id' => $inmueble['id'],
        'nombre' => $inmueble['nombre']
    );
}

echo json_encode($resultado); // Devolver los inmuebles en formato JSON con los campos 'id' y 'nombre'
?>