<?php
include './templates/Header.php';
session_start();
// if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=2) {
//     header('Location: ../../');
//     exit();
// }
?>
<!-- ==============================================Fin header ======= -->


<div id="divGridAnunciosMultiples">
<h1>Detalle de Sus Espacios registrados:</h1>

    <table id="GridAnunciosMultiples">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Inmueble</th>
                <th>Estado del Inmueble</th>
                <th>Disponibilidad</th>
                <!-- Agrega más encabezados según tus datos -->
            </tr>
        </thead>
        <tbody>
            <!-- Llenado Dinamicamente en JS -->
        </tbody>
    </table>
</div>



<script>var identificacion = <?php echo json_encode($_SESSION["Identificacion"]); ?>; </script>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->