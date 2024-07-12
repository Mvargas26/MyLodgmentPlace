<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();

session_start();

// Verifica si la sesión está iniciada
if (isset($_POST['imagen'])) {
    try {
        // Obtén el ID de la sesión
        $identificacion = $_SESSION['Identificacion'];

        // Obtiene el nombre de la imagen
        $nombreImagen = $_POST['imagen'];

        // Llama al método para insertar la información en la base de datos
        $ObjMaster->insertarImagenPerfil($nombreImagen);

        // Devuelve una respuesta exitosa
        echo json_encode(array('exito' => true, 'mensaje' => 'Imagen registrada correctamente.'));
    } catch (Exception $e) {
        // Maneja cualquier excepción ocurrida durante el proceso
        echo json_encode(array('error' => $e->getMessage()));
    }
} else {
    // Devuelve un mensaje de error si no se recibió una imagen válida
    echo json_encode(array('error' => 'No se recibió una imagen válida.'));
}
?>