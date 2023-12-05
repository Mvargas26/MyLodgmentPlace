<?php
require_once('../Master_Class.php');

// Crear una instancia de la clase principal
$ObjMaster = new Master_Class();

// Verificar si se han enviado los datos para eliminar el cupón
if (isset($_POST['idInmueble'], $_POST['idCupon'])) {
    $idInmueble = $_POST['idInmueble'];
    $idCupon = $_POST['idCupon'];

    // Eliminar el cupón utilizando la Master_Class
    $eliminado = $ObjMaster->eliminarCupon($idInmueble, $idCupon);

    // Devolver una respuesta al cliente (puede ser un objeto JSON)
    echo json_encode(['eliminado' => $eliminado]);
}
?>