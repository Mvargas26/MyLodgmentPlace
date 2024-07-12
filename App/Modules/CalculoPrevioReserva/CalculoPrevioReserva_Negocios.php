<?php
require_once('../Master_Class.php');

//Obtener la cantidad de días desde la solicitud POST
$cantidadDias = isset($_POST['cantidadDias']) ? intval($_POST['cantidadDias']) : 1;

// Crear una instancia de la clase Master_Class
$ObjMaster = new Master_Class();

// Calcular el valor total utilizando la función en la clase Master_Class
$valorTotal = $ObjMaster->calcularValorTotal($cantidadDias);

// Devolver el valor total como respuesta JSON
$data = array('valorTotal' => $valorTotal,'cantidadDias' => $cantidadDias);
echo json_encode($data);
?>