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
            <div class="text-center mt-3">
                    <button id="btnAgregarFavoritos" name="btnAgregarFavoritos" class="custom-button" type="submit">Agregar a Favoritos</button>
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

    <p>Calendario</p>

    <section id="testimonials" class="testimonials section-bg">
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
                <img src="../App/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Gomez</h3>
              </div>
            </div><!-- End testimonial item -->

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
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Alquilamos la Hacienda con Rancho para nuestra boda y todo salio de Maravilla
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="../App/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
              </div>
            </div><!-- End testimonial item -->

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
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->




  </main><!-- End #main -->






<!-- ==============================================Inicio Footer ======= -->
   
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
