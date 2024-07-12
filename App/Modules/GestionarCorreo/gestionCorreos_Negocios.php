<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class(); 

if (isset($_POST['Accion'], $_POST['datos'])) {
    $accion = $_POST['Accion'];
    $datos = json_decode($_POST['datos'], true); 

    $mensajeDB = $ObjMaster->gestionarCorreo($accion, $datos);
    $data = array("exito" => $mensajeDB);
    echo json_encode($data);
} else {
    echo json_encode(array('Vacio' => 'No entro al If'));
}
?>
