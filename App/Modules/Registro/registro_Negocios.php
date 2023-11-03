<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Accede a los datos
    $identificacion = $data["identificacion"];
    $nombre = $data["nombre"];
    $primerApellido = $data["primerApellido"];
    $segundoApellido = $data["segundoApellido"];
    $email = $data["email"];
    $telefono = $data["telefono"];

    // Realiza el procesamiento necesario con los datos

    // Devuelve una respuesta si es necesario
    echo "Datos recibidos correctamente";
}
?>
