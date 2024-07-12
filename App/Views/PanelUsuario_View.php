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
<link href="../assets/css/panelHuesped.css" rel="stylesheet">

<body>
    <br>
        <div class="cards-container">
            <div class="card">
                <a href="mi_banco_View.php">Mi Banco</a>
            </div>
            <div class="card">
                <a href="perfilHuesped_View.php">Datos Personales</a>
            </div>
            <div class="card">
                <a href="validar_identidadHuesped_View.php">Validar Identidad</a>
            </div>
            <div class="card">
                <a href="notificacionesHuesped_View.php">Notificaciones</a>
            </div>
            <div class="card">
                <a href="reservasHuesped_View.php">Historial de Reservas</a>
            </div>
        </div>
            </div>
                <div class="image-container">
                <img src="../assets/img/logo/logo2.png" alt="Imagen Central">
            </div>
        <div class="cards-container">
            <div class="card">
                <a href="admin_seguridadHuesped_View.php">Administración de Seguridad</a>
            </div>
            <!-- <div class="card">
            <a href="cupones_View.php">Cupones y tarjetas de regalo</a>
            </div> -->
            <div class="card">
                <a href="denunciasHuesped_View.php">Denuncias</a>
            </div>
            <div class="card">
                <a href="mensajesHuesped_View.php">Mensajes</a>
            </div>
            <div class="card">
                <a href="mis_resenasHuesped_View.php">Vista de Reseñas y Calificaciones de anfitriones </a>
            </div>
            <div class="card">
                <a href="calificarHuespedes_View.php">Calificar Anfitrion</a>
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
