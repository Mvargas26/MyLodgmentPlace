<?php

$apiUrl = 'https://tipodecambio.paginasweb.cr/api';
$apiResponse = file_get_contents($apiUrl);

$exchangeRateData = json_decode($apiResponse, true);

$compra = 'No disponible';
$venta = 'No disponible';
$fecha = 'No disponible';

if ($exchangeRateData && isset($exchangeRateData['compra'], $exchangeRateData['venta'], $exchangeRateData['fecha'])) {
    $compra = $exchangeRateData['compra'];
    $venta = $exchangeRateData['venta'];
    $fecha = $exchangeRateData['fecha'];
}

// Puedes obtener otros valores dinámicamente desde tu aplicación PHP
$nombre = "Juan";
$apellidos = "Pérez Gómez";
$cedula = "123456789";
$direccion = "Calle 123, Ciudad";
$saldo = "$5,000.00";

?>
