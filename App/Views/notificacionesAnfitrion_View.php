<?php
include './templates/Header.php';
session_start();
?>
<!-- ==============================================Fin header ======= -->


<div id="divGridNotificaciones">
<h1>Notificaciones</h1>

    <table id="GridNotificaciones">
        <thead>
            <tr>
                <th></th>
                <th></th>
                
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