<?php include './templates/Header.php';

session_start();

$idPropietario = $_SESSION['Identificacion'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mantenimiento</title>
    <link rel="stylesheet" href="../assets/css/Administracion/administracion.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="mantenimiento-container">
        <h1>Mantenimiento</h1>
        <div id="tabs">
            <button id="cuponesBtn" onclick="mostrarTab('cupones')">Cupones</button>
            <button id="caracteristicasBtn" onclick="mostrarTab('caracteristicas')">Caracteristicas</button>
        </div>
        <div id="cupones" style="display: none;">
            <button id="modificarCuponBtn" onclick="mostrarModificarCupon()">Modificar Cupón</button>
            <button id="eliminarCuponBtn" onclick="mostrarEliminarCupon()">Eliminar Cupón</button>
            <div id="modificarForm" style="display: none;">
                <label for="lugaresList">Selecciona un lugar:</label>
                <select id="lugaresList"></select>
                <label for="cuponesList">Selecciona un cupón:</label>
                <select id="cuponesList"></select>
                <label for="nuevoNombreCupon">Nuevo nombre del cupón:</label>
                <input type="text" id="nuevoNombreCupon" maxlength="20">
                <label for="montoDescuento">Monto de descuento:</label>
                <input type="number" id="montoDescuento" max="30" min="0">
                <label for="cantidadCupones">Cantidad de cupones:</label>
                <input type="number" id="cantidadCupones" max="200" min="0">
                <label for="fechaVencimiento">Fecha de vencimiento:</label>
                <input type="date" id="fechaVencimiento">
                <button id="aplicarModificacionBtn">Aplicar Modificación</button>
            </div>
            <div id="eliminarForm" style="display: none;">
                <label for="eliminarLugaresList">Selecciona un lugar:</label>
                <select id="eliminarLugaresList"></select>
                <label for="eliminarCuponesList">Selecciona un cupón:</label>
                <select id="eliminarCuponesList"></select>
                <button id="confirmarEliminarBtn">Confirmar Eliminación</button>
            </div>
        </div>
        <div id="caracteristicas"  onclick="mostrarCaracteristicas()" style="display: none;">
            <label for="inmueblesList">Selecciona un inmueble:</label>
            <select id="inmueblesList"></select>
            <label for="cantidadCuartos">Cantidad de cuartos:</label>
            <input type="number" id="cantidadCuartos" max="20" min="0">
            <label for="cantidadCamas">Cantidad de camas:</label>
            <input type="number" id="cantidadCamas" max="50" min="0">
            <label for="cantidadBanos">Cantidad de banos:</label>
            <input type="number" id="cantidadBanos" max="50" min="0">
            <label for="cantidadPatios">Cantidad de patios:</label>
            <input type="number" id="cantidadPatios" max="50" min="0">
            <label for="cantidadVehiculos">Cantidad de vehiculos:</label>
            <input type="number" id="cantidadVehiculos" max="50" min="0">
            <label for="cantidadPlantas">Cantidad de plantas:</label>
            <input type="number" id="cantidadPlantas" max="50" min="0">
            <!-- Repite los campos para las otras características -->
            <button id="guardarCambiosBtn">Guardar Cambios</button>
        </div>
    </div>

    <script src="../assets/js/Administracion/modificarCupon.js"></script>

</body>

</html>
<?php include './templates/Footer.php'; ?>