<?php
include './templates/Header.php';
session_start();
?>
<!-- ==============================================Fin header ======= -->
<!-- Contenido de tu página -->
<main id="main">

    <h1>Valor por dia del inmueble: <span id="valorColones">20,000</span> colones</h1>

    <label for="cantidadDias">Seleccionar cantidad de días:</label>
    <input type="number" id="cantidadDias" min="1" value="1">
    <h2>Total: <span id="valorTotal">20,000</span> colones</h2>

</main>


<script src="../assets/js/calculoPrevioReserva/script.js"></script>
<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->