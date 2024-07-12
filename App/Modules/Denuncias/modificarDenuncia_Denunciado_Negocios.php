<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();

try {
    if (isset($_POST['respuesta'])) {
        $idDenuncia = $_POST['idDenuncia'];
        $respuestaDenunciado = $_POST['respuesta']; 

        //Mandar mensaje al correo
        $correo = ($_POST["Correo"]); 
        $resultado = $ObjMaster->enviarMensajesCorreo($correo, 'denunciaAn');

        // Llama al método para enviar mensajes de correos
        if ($resultado) {
            $data = array("exito" => true);
            echo json_encode($data);
        } else {
            $data = array("exito" => false, "error" => "Error al enviar el correo electrónico.");
            echo json_encode($data);
        }

        $mensajeDB = $ObjMaster->modificarDenuncia($idDenuncia, $respuestaDenunciado);
    } else {
        echo json_encode(array('Vacio' => 'No entro al If'));
    }
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
?>