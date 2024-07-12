<?php
require_once('../Master_Class.php');

$ObjMaster = new Master_Class();


if (isset($_POST["imagenData"])) {

    $img = $_POST['imagenData'];
    $identificacion = $_POST['formData']['identificacion'];
    $Clave = $_POST['formData']['Clave'];
    $nombre = $_POST['formData']['nombre'];
    $primerApellido = $_POST['formData']['primerApellido'];
    $segundoApellido = $_POST['formData']['segundoApellido'];
    $email = $_POST['formData']['email'];
    $telefono = $_POST['formData']['telefono'];
    $edad = $_POST['formData']['edad'];
    $idRol = $_POST['formData']['idRol'];
    $direccion = $_POST['formData']['direccion'];

    try {

        $mensajeDB = $ObjMaster->InsertarUsuario($img,$identificacion,$Clave,$nombre,$primerApellido,$segundoApellido,
        $email,$telefono,$edad,$idRol,$direccion);

         $resultado = $ObjMaster->enviarMensajesCorreo($email, 'registro');
         $notificacion = $ObjMaster->InsertarNotificacion_Registro($identificacion);

        // Llama al método para enviar mensajes de correoss
        if ($notificacion) {
            echo json_encode(array('exito' => true, 'mensaje' => $notificacion));
        } else {
            echo json_encode(array('exito' => true, 'mensaje' => $notificacion));
        }
    } catch (Throwable $th) {
        echo json_encode(array('error' => false, 'mensaje' => $th));
    }
}
?>

