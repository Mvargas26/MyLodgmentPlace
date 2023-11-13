<?php
session_start();

// Verifica si la sesión está iniciada
if (isset($_SESSION['Identificacion'])) {
    $identificacion = $_SESSION['Identificacion'];

    // Directorio donde se almacenan las imágenes (ajusta según tu estructura)
    $rutaDirectorio = '../App/assets/img/usuarios/';

    // Construye la ruta completa de la imagen
    $rutaImagen = $rutaDirectorio . $identificacion . '.png';  // Suponiendo que las imágenes están en formato JPG

    // Verifica si la imagen existe
    if (file_exists($rutaImagen)) {
        // Devuelve la ruta de la imagen como respuesta JSON
        echo json_encode(array('rutaImagen' => $rutaImagen));
    } else {
        // Devuelve un mensaje si la imagen no existe
        echo json_encode(array('error' => 'Imagen no encontrada'));
    }
} else {
    // Devuelve un mensaje de error si la sesión no está iniciada
    echo json_encode(array('error' => 'Sesión no iniciada'));
}
?>
