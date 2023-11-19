<?php

require_once('../Master_Class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idValidacionPerfil"]) && isset($_POST["nuevoEstado"])) {
        $idValidacionPerfil = $_POST["idValidacionPerfil"];
        $nuevoEstado = $_POST["nuevoEstado"];

        // Crear una instancia de la clase Master_Class
        $masterClass = new Master_Class();

        // Llamar a la función para actualizar el estado
        if ($masterClass->actualizarEstado($idValidacionPerfil, $nuevoEstado)) {
            echo "Estado actualizado correctamente.";
        } else {
            echo "Error al actualizar el estado.";
        }
    }
}
?>
