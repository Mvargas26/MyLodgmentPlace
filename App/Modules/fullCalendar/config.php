<?php
$usuario  = "u538860919_sitios";
$password = "Sitios2023*";
$servidor = "localhost";
$basededatos = "u538860919_mylodgmentplac";
$con = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
$db = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");
?>
