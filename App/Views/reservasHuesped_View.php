<?php
include './templates/Header.php';

?>
<!-- ==============================================Fin header ======= -->
<main id="main">
    <div class="reservas-historial">
        <h2>Historial de Reservas</h2>
        <table class="historial-table">
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
            <tbody id="tablaReservas">
                <!-- Aquí se llenarán las filas con los datos de las reservas -->
            </tbody>
        </table>
        <button onclick="window.history.back()">Volver</button>
    </div>
</main>

<!-- ==============================================Inicio Footer ======= -->
<script src="../assets/js/historialReservasUsuario/script.js"></script>
<?php
//include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->