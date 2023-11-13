<?php
$base_path = '../assets/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Lodgment Place</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo $base_path; ?>img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="<?php echo $base_path; ?>img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo $base_path; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $base_path; ?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo $base_path; ?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo $base_path; ?>vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo $base_path; ?>vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo $base_path; ?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo $base_path; ?>css/style.css" rel="stylesheet">
  <link href="<?php echo $base_path; ?>css/customStyle.css" rel="stylesheet">
  <link href="<?php echo $base_path; ?>css/login.css" rel="stylesheet">
  <link href="<?php echo $base_path; ?>css/panelusuario.css" rel="stylesheet">
  <link href="<?php echo $base_path; ?>css/serviciosAnfitrion.css" rel="stylesheet">
  <link href="<?php echo $base_path; ?>css/notificaciones.css" rel="stylesheet">



  <!-- FireBase -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    
</head>

 <body>
  
 

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center ">
  <div class="container-fluid d-flex align-items-center justify-content-lg-between">

<h1 class="logo me-auto me-lg-0"><a href="#">
    <img width="50" height="100" src="https://img.icons8.com/sf-black-filled/64/home.png" alt="home" />
  </a></h1>


<nav id="navbar" class="navbar order-last order-lg-0">
  <ul>
    <li><a class="nav-link scrollto active" href="#hero">Inicio</a></li>
    <li><a class="nav-link scrollto" href="#portfolio">Lugares</a></li>
    <li><a class="nav-link scrollto" href="#contact">Contactenos</a></li>
    <!-- <li><a class="nav-link scrollto" href="#about"> -->
      <?php 
          if (isset($_SESSION["nombre"])) {
             //echo  $_SESSION["nombre"];
          } else {
      ?>
            <li><a class="nav-link scrollto " href="./App/Views/Login_View.php">Iniciar Sesion</a></li>
            <li><a class="nav-link scrollto" href="./App/Views/registro_View.php">Registrarse</a></li>
            <?php

      }
          if (isset($_SESSION["Rol"])) {
            if ($_SESSION["Rol"] == 2) {
    ?>
            <li><a class="nav-link scrollto" href="./App/Views/PanelAnfitrion_View.php">Panel Anfitrion</a></li>
            <li><a class="nav-link scrollto" href="./App/Views/PublicarInmueble_View.php">Publica tu Espacio</a></li>
            <li><a class="nav-link scrollto" href="./App/Views/Anuncios_MultiplesV_View.php">Anuncios Multiples</a></li>
            <li><a class="nav-link scrollto" href="./App/Views/validar_identidadHuesped_View.php">Validar Perfil</a></li>
    <?php

    };

   if ($_SESSION["Rol"] == 3) {
    ?>
        <li><a class="nav-link scrollto" href="./App/Views/PanelUsuario_View.php">Perfil Huesped</a></li>
        <li><a class="nav-link scrollto" href="./App/Views/calificarAnfitrion_View.php">Calificar Anfitrion</a></li>

  <?php }; }; ?>



  <?php if (isset($_SESSION["nombre"])) {  ?>
  <li><a class="nav-link scrollto" href="./App/Modules/Login/cerrarSesion_Negocios.php">Cerrar Sesion</a></li>
<?php  } ?>

  </ul>
  <i class="bi bi-list mobile-nav-toggle"></i>
</nav><!-- .navbar -->
<?php
   if (isset($_SESSION["nombre"])) { ?> 
         <a  id="aDelNombreSesion" href="#" class="twitter">Bienvenido(a): <?php  echo  $_SESSION["nombre"]; ?> <i class=""></i></a>

<?php } ?>

<div class="header-social-links d-flex align-items-center">
  <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
  <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
  <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
  <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
</div>

</div>
  </header><!-- End Header -->