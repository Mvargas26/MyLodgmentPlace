<?php
include './templates/Header.php';
session_start();
?>
<!-- ==============================================Fin header ======= -->

<section id="notificacionSection">

    <h1 id="tituloN">
    <i class="bi bi-bell-fill"></i>
    Notificaciones</h1>
    <hr/>
    
    <div id="divGridNotificacionesAnfitrion">
        <!-- =============================================== -->
        <!-- se llena dinamicamente con JS -->
        <!-- =============================================== -->
    </div>
    
</section>


<script>var identificacion = <?php echo json_encode($_SESSION["Identificacion"]); ?>; </script>

<!-- ==============================================Inicio Footer ======= -->
<script src="../assets/js/notificaciones/script_notificaciones.js"></script>
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->