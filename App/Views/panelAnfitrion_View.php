<?php
include './templates/Header.php';
?>
<!-- ==============================================Fin header ======= -->
<main id="main">
    <link href="../assets/css/panelHuesped.css" rel="stylesheet">

    <body>
        <br>
        <div class="cards-container">
            <div class="card">
                <a href="PublicarInmueble_View.php">Publicar Espacio</a>
            </div>
            <div class="card">
                <a href="denunciasAnfitrion_View.php">Recepcion de Denuncias</a>
            </div>
            <div class="card">
                <a href="validar_identidadHuesped_View.php">Validacion Segura del Perfil</a>
            </div>
            <div class="card">
                <a href="notificacionesAnfitrion_View.php">Notificaciones</a>
            </div>
            <!-- <div class="card">
                <a href="mis_resenasAnfitrion_View.php">Historial de Reseñas</a>
            </div> -->
            <div class="card">
                <a href="Administracion_View.php">Administracion</a>
            </div>

        </div>
        </div>
        <div class="image-container">
            <img src="../assets/img/logo/logo2.png" alt="Imagen Central">
        </div>
        <div class="cards-container">
            <div class="card">
                <a href="mis_resenasAnfitrion_View.php">Reseñas y Calificacion de Huesped</a>
            </div>
            <div class="card">
                <a href="mi_banco_View.php">Mi Banco</a>
            </div>
            <div class="card">
                <a href="calificarHuespedes_View.php">Calificacion a Huespedes</a>
            </div>
            <div class="card">
                <a href="mensajesAnfitrion_View.php">Mensajeria</a>
            </div>  
            <div class="card">
                <a href="creacion_descuentos_View.php">Creacion de Descuentos</a>
            </div>
        </div>
        <br>
    </body>
</main>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->