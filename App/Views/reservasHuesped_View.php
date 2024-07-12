<?php
include './templates/Header.php';
session_start();
// if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=3) {
//     header('Location: ../../');
//     exit();
// }
?>
<!-- ==============================================Fin header ======= -->
<main id="main">
    <div id="reservas-historial">
        <h2>Historial de Reservas</h2>
        <table id="tablaReservas" class="historial-table">
            <thead>
                <tr>
                    <th>Lugar</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Monto Total</th>
                    <th>Monto Total con Impuestos</th>
                    <!-- Agregar más columnas según lo que se desee mostrar -->
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se llenarán las filas con los datos de las reservas -->
            </tbody>
        </table>
        <button id="volverBtn" onclick="window.history.back()">Volver</button>
    </div>
</main>

<!-- ==============================================Inicio Footer ======= -->
<script src="../assets/js/historialReservasUsuario/script.js"></script>
<?php
//include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->