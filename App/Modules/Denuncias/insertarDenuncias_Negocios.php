<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();
session_start();

try {
    if (isset($_POST['denuncia'])) {
        $idUsuario = $_POST['idUsuario'];
        $idPropietario = $_POST['idPropietario'];
        $tipoDenuncia = $_POST['tipoDenuncia'];
        $detallesDenuncia = $_POST['detallesDenuncia'];
        $estado = "Proceso";
        //Mandar mensaje al correo
        $correo = ($_POST["Correo"]);
        $resultado = $ObjMaster->enviarMensajesCorreo($correo, 'denunciaHu');

        // Llama al método para enviar mensajes de correos
        if ($resultado) {
            $data = array("exito" => true);
            echo json_encode($data);
        } else {
            $data = array("exito" => false, "error" => "Error al enviar el correo electrónico.");
            echo json_encode($data);
        }

        $mensajeDB = $ObjMaster->insertarDenuncia($idUsuario, $detallesDenuncia, $idPropietario, $estado, $tipoDenuncia);
        $data = array("exito" => $mensajeDB);
        echo json_encode($data);
    } else {
        echo json_encode(array('Vacio' => 'No entro al If'));
    }
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
?>