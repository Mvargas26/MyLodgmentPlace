<?php
include './templates/Header.php';
?>
   <!-- ==============================================Fin header ======= -->
  
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <h2>Detalle</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="../assets/img/portfolio/portfolio-1.jpg" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="../assets/img/portfolio/portfolio-2.jpg" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="../assets/img/portfolio/portfolio-3.jpg" alt="">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
            <div class="corazon">
            <a href="#" class="btn-learn-more">Agregar a favoritos</a>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Cabaña El Sueño</h3>
              <ul>
                <li><strong>Precio:</strong>: Web design</li>
                <li><strong>Ubicacion:</strong>: ASU Company</li>
                <li><strong>Servicios:</strong>: 01 March, 2020</li>
                <li><strong>Otros:</strong>: <a href="#">www.example.com</a></li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>Caracteristicas del espacio:</h2>
              <p>
                Poner aqui on lo que cuenta
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->






<!-- ==============================================Inicio Footer ======= -->
   
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
