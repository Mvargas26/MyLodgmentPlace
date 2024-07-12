<?php
require("App/Modules/Master_Class.php");
session_start();

try {
  $ObjMaster = new Master_Class(); // Crear una instancia de la clase Master_Class

  // Obtener la cantidad de reservas, espacios, anfitriones y usuarios
  $cantidadReservas = $ObjMaster->ObtenerCantidadReservas();
  $cantidadEspacios = $ObjMaster->ObtenerCantidadEspacios();
  $cantidadAnfitriones = $ObjMaster->ObtenerCantidadAnfitriones();
  $cantidadUsuarios = $ObjMaster->ObtenerCantidadUsuarios();
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}
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
  <link href="./App/assets/img/favicon.png" rel="icon">
  <link href="./App/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="./App/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./App/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./App/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="./App/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="./App/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="./App/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="./App/assets/css/nieve/nieve.css" rel="stylesheet">
  <link href="./App/assets/css/style.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">  
    

  <script src="https://kit.fontawesome.com/964c59f858.js" crossorigin="anonymous"></script>

</head>

<body>

<!-- ======= Hero Section ======= -->
<section id="hero">
  <div class="hero-container">
    <!-- <h1>My Lodgment Place</h1> -->
    <div class="divImagen">
      <img id="imgLogo" src="./App/assets/img/logo/Logo_blanco2.png" alt="">
    </div>
    <audio id="hidden-audio" controls loop style="display: none;">
      <source src="./App/assets/we.mp3" type="audio/mp3">
      Tu navegador no soporta la etiqueta de audio.
    </audio>
  </div>
</section><!-- End Hero -->

<!-- <script>

  var audio = document.getElementById("hidden-audio");

  // Establecer volumen fijo al cargar la página
  document.addEventListener("DOMContentLoaded", function() {
    audio.volume = 0.02;
    audio.play();
  });

  document.getElementById("imgLogo").addEventListener("click", function() {
    if (audio.paused) {
      audio.play();
    } else {
      audio.pause();
    }
  });
</script> -->



  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center ">
    <div class="container-fluid d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="#">
          <i class="bi bi-house-door-fill" style="font-size: 1.5em; color:#ffff;"></i>
        </a></h1>


      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#">Inicio</a></li>
          <?php
          if (isset($_SESSION["Rol"])) {
            if($_SESSION["Rol"] != 1){
              ?>
              <li><a class="nav-link scrollto active" href="#counts">Estadísticas</a></li>
              <li><a class="nav-link scrollto" href="#portfolio">Inmuebles</a></li>
              <?php
            };
          }
          ?>
          <!-- <li><a class="nav-link scrollto" href="#contact">Contactenos</a></li> -->
          <li><a class="nav-link scrollto" href="./App/Views/acerca_de_View.php">Acerca de</a></li>
          <?php
          if (isset($_SESSION["nombre"])) {
            //echo  $_SESSION["nombre"];
          } else {
          ?>
            <li><a class="nav-link scrollto " href="./App/Views/Login_View.php">Iniciar Sesión</a></li>
            <li><a class="nav-link scrollto" href="./App/Views/registro_View.php">Registrarse</a></li>
            <?php

          }
          if (isset($_SESSION["Rol"])) {
            if ($_SESSION["Rol"] == 2) {
            ?>
              <li><a class="nav-link scrollto" href="./App/Views/PanelAnfitrion_View.php">Panel Anfitrión</a></li>

            <?php

            };

            if ($_SESSION["Rol"] == 3) {
            ?>
              <li><a class="nav-link scrollto" href="./App/Views/PanelUsuario_View.php">Panel Huésped</a></li>

            <?php };

            if ($_SESSION["Rol"] == 1) {
            ?>
              <li><a class="nav-link scrollto" href="./App/Views/gestionPerfilUsuarios_View.php">Panel Administrador</a></li>
                <li><a class="nav-link scrollto" href="./App/Views/gestionCorreos_View.php">Mantenimiento Correo</a></li>
                <li><a class="nav-link scrollto" href="./App/Views/gestionarMensajes_View.php">Mantenimiento Mensajes</a></li>

            <?php };
          }; ?>



            <?php if (isset($_SESSION["nombre"])) {  ?>
              <li><a class="nav-link scrollto" href="./App/Modules/Login/cerrarSesion_Negocios.php">Cerrar Sesion</a></li>
            <?php  } ?>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <?php
      if (isset($_SESSION["nombre"])) { ?>
        <a id="aDelNombreSesion" href="#" class="twitter">Bienvenido(a): <?php echo  $_SESSION["nombre"]; ?> <i class=""></i></a>

      <?php } ?>

      <div class="header-social-links d-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>

    </div>
  </header><!-- End Header -->

  <main id="main">
    
    <br>
    <br>
    <br>
    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">
        <div class="section-title">
          <h2>¡Nuestras Estadísticas!</h2>
            <div id="ContenedorResenias">
              <section id="testimonials" class="testimonials section-bg">
                <div class="container">
                  <div id="contenedorEstadisticas">

                    <section id="counts" class="counts">
                      <div class="container">
                        <div class="row counters">
                          <div class="col-lg-3 col-6 text-center">
                            <input type="hidden" id="CantidadDeResenastotales" value="<?php echo $cantidadReservas; ?>">
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo $cantidadReservas; ?>" id="ResenasTotales" data-purecounter-duration="2" class="purecounter"></span>
                            <p id="p">Reseñas Totales</p>
                          </div>

                          <div class="col-lg-3 col-6 text-center">
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo $cantidadEspacios; ?>" data-purecounter-duration="2" class="purecounter"></span>
                            <p id="p">Espacios Totales</p>
                          </div>

                          <div class="col-lg-3 col-6 text-center">
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo $cantidadAnfitriones; ?>" data-purecounter-duration="2" class="purecounter"></span>
                            <p id="p">Anfitriones Totales</p>
                          </div>

                          <div class="col-lg-3 col-6 text-center">
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo $cantidadUsuarios; ?>" data-purecounter-duration="2" class="purecounter"></span>
                            <p id="p">Huespedes Totales</p>
                          </div>
                        </div>
                      </div>
                    </section><!-- End Counts Section -->
                  </div>
                </div>
              </section>
            </div> <!--fin contenedor1 -->
        </div>
      </div>
    </section> <!--End Counts Section -->


    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>Inmuebles</h2>
          <?php if (!isset($_SESSION["nombre"])) {           ?>
            <p>¡Para una Experiencia Mas Personalizada inicia Sesion !</p>
          <?php } ?>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-center">
          <li data-filter="*" class="filter-active">TODAS <i class="fa-solid fa-layer-group"></i></li>
          <?php
          try {
            $resultadoConsulta = $ObjMaster->ConsultarCategorias();
            // Decodificar el string JSON a un array de PHP
            $datos = json_decode($resultadoConsulta, true);

            if ($datos) {
              foreach ($datos as $dato) {
          ?>
                <li data-filter=".filter-<?php echo $dato['Nombre_Cat'] ?>"> <?php echo $dato['Nombre_Cat'] ?> <?php echo $dato['icono'] ?> </li>
          <?php
              }
            } else {
              echo 'Error al decodificar el JSON';
            }
          } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
          }

          ?>
          <!-- <li data-filter=".filter-app">Cabañas</li>
          <li data-filter=".filter-card">Frente a la Playa</li>
          <li data-filter=".filter-web">Zona Rural</li> -->
        </ul>

        <div class="row portfolio-container" id="portfolioContainer">

          <?php

          try {
            $resultadoConsulta = $ObjMaster->ConsultarInmuebles();
            // Decodificar el string JSON a un array de PHP
            $datos = json_decode($resultadoConsulta, true);

            if ($datos) {
              // $datosAgrupados = array();


              foreach ($datos as $dato) {
          ?>
                <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $dato['Categoria_Inmueble'] ?>">
                  <div class="portfolio-img"><img src="./App/assets/img/ImagenesInmuebles/<?php echo $dato['nameImagen'] ?>" class="img-fluid" alt=""></div>
                  <div class="portfolio-info">
                    <h4><?php echo $dato['Nombre_Inmueble'] ?></h4>
                    <p> ₡ <?php echo $dato['valorDiario'] ?></p>
                    <a href="./App/assets/img/ImagenesInmuebles/<?php echo $dato['nameImagen'] ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?php $dato['Nombre_Inmueble'] ?>"><i class="bx bx-plus"></i></a>
                    <a href="./App/Views/InmuebleDetalle_View.php?id=<?php echo urlencode($dato['id']); ?>" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                  </div>
                </div>
          <?php
              }
            } else {
              echo 'Error al decodificar el JSON';
            }
          } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
          }
          ?>
        </div>

      </div>
    </section>
    <!-- End Portfolio Section -->

    <br>





  </main><!-- End #main -->



  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">

      <div class="container">



        <div class="social-links">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>

      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Sitios Grupo#1</span></strong>. Derechos Reservados
      </div>
      <div class="credits">
        Designed by <a href="https://www.cuc.ac.cr/">Colegio Universitario de Cartago</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="./App/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="./App/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./App/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="./App/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="./App/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="./App/assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Template Main JS File -->
  <script src="./App/assets/js/main.js"></script>
  <script src="./App/assets/js/script_Index.js"></script>
 <!--  <script src="./App/assets/js/nieve/nieve.js"></script> -->


  <!-- vistaIndicadores -->


</body>

</html>
