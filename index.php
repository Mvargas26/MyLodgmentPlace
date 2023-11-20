<?php
require("App/Modules/Master_Class.php");
session_start();
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

  <link href="./App/assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <h1>My Lodgment Place</h1>
    </div>
  </section><!-- End Hero -->

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center ">
    <div class="container-fluid d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="#">
      <i class="bi bi-house-door-fill" style="font-size: 1.5em; color:#ffff;"></i>
        </a></h1>


      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#">Inicio</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Lugares</a></li>
          <!-- <li><a class="nav-link scrollto" href="#contact">Contactenos</a></li> -->
          <!-- <li><a class="nav-link scrollto" href="#about"> -->
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

  <main id="main">

    <!-- ======= About Section ======= -->
    <!-- <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>Acerca de Nosotros</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
              Somos una empresa Costarricense que nos preocupamos por que cualquier extranjero tenga una visita:
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Segura</li>
              <li><i class="ri-check-double-line"></i> Cómoda</li>
              <li><i class="ri-check-double-line"></i> Tranquila</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              A su vez, para la persona nacional tenemos excelentes recomendaciones para que termine de conocer nuestra hermosa Tierra.
            </p>
            <a href="#" class="btn-learn-more">Leer Más</a>
          </div>
        </div>

      </div>
    </section>End About Section -->

    <!-- ======= Counts Section ======= -->
    <!-- <section id="counts" class="counts">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
            <p>Clientes Registrados</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
            <p>Lugares Publicados</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
            <p>Horas de Soporte</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
            <p>Reseñas</p>
          </div>

        </div>

      </div>
    </section>End Counts Section -->


    <!-- ======= Clients Section ======= -->
    <!-- <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="row">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section>End Clients Section -->

    <!-- ======= Services Section ======= -->
    <!-- <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Servicios de Nuestros Espacios</h2>
          <p>Nuestros Espacios estan equipados con distintos servicios los cuales brindaran una experiencia unica en cada lugar que tú elijas.</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-briefcase" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="">Giras de Trabajo</a></h4>
              <p class="description">Algunos espacios cuentan con Oficinas para esas reuniones en las provincias fuera del Area Metropolitana</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-card-checklist" style="color: #e9bf06;"></i></div>
              <h4 class="title"><a href="">Internet de Alta Velocidad</a></h4>
              <p class="description">La mayoria de nuestor sespacios cuentan con una buena conexion a Internet</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-bar-chart" style="color: #3fcdc7;"></i></div>
              <h4 class="title"><a href="">Alto Estandar de Limpieza</a></h4>
              <p class="description">Nuestros espacios cumplen con un Aklto estandar en medidas de Higiene</p>
            </div>
          </div>

    </section>End Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <!-- <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Reseñas</h2>
          <p>Nos intereza mucho saber tu opinion y que la comunidad de My Lodgment Place tambien la conozca</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Disfrute mucho en una cabaña de montaña.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="./App/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Gomez</h3>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Estuvimos el fin de semana en una hermasa casa con acceso privado a la Playa.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="./App/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Rodriguez</h3>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Alquilamos la Hacienda con Rancho para nuestra boda y todo salio de Maravilla
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="./App/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  La mejor opcion en alojamientos para los diferentes gustos de cada persona.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="./App/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
              </div>
            </div>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section> -->


    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>Espacios</h2>
          <?php  if(!isset($_SESSION["nombre"])){           ?>
          <p>¡Para una Experiencia Mas Personalizada inicia Sesion !</p>
          <?php } ?>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-center">
          <li data-filter="*" class="filter-active">TODAS</li>
          <?php
             try {
              $resultadoConsulta = $ObjMaster->ConsultarCategorias();
              // Decodificar el string JSON a un array de PHP
              $datos = json_decode($resultadoConsulta, true);

              if ($datos) {
                foreach ($datos as $dato) {
          ?>
              <li data-filter=".filter-<?php echo $dato['Nombre_Cat'] ?>"> <?php echo $dato['Nombre_Cat'] ?> </li>
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
                      <h4><?php  echo $dato['Nombre_Inmueble'] ?></h4>
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

</body>

</html>