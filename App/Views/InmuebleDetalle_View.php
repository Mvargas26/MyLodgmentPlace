<?php
include './templates/Header.php';
// Verificar si se proporcionó un nombre de inmueble en la URL
if (isset($_GET['nombre'])) {
  $nombreInmueble = $_GET['nombre'];
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
              <button id="btnAgregarFavoritos" name="btnAgregarFavoritos" class="custom-button" type="submit">Agregar a
                Favoritos</button>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <!-- <h3>Cabaña El Sueño</h3>
              <ul>
                <li><strong>Precio:</strong>: Web design</li>
                <li><strong>Ubicacion:</strong>: ASU Company</li>
                <li><strong>Servicios:</strong>: 01 March, 2020</li>
                <li><strong>Otros:</strong>: <a href="#">www.example.com</a></li>
              </ul>
            </div> -->
              <div class="portfolio-description">
                <h2>Características del espacio:</h2>
                <p>
                  <strong>Nombre del Inmueble:</strong>
                  <?php echo $data['Nombre_Inmueble']; ?><br>
                  <strong>Capacidad de Personas:</strong>
                  <?php echo $data['capacidadPersonas']; ?><br>
                  <strong>Dirección:</strong>
                  <?php echo $data['direccion']; ?><br>
                  <strong>Disponibilidad:</strong>
                  <?php echo $data['disponibilidad']; ?><br>
                  <strong>Estrellas:</strong>
                  <?php echo $data['estrellas']; ?><br>
                  <strong>Fecha Límite de Disponibilidad:</strong>
                  <?php echo $data['fechaLimiteDisponibilidad']; ?><br>
                  <strong>Propietario:</strong>
                  <?php echo $data['nombre_propietario']; ?><br>
                  <strong>Característica 1:</strong>
                  <?php echo $data['caracteristica1']; ?><br>
                  <strong>Característica 2:</strong>
                  <?php echo $data['caracteristica2']; ?><br>
                  <strong>Característica 3:</strong>
                  <?php echo $data['caracteristica3']; ?><br>
                </p>
              </div>
            </div>

          </div>

        </div>
    </section><!-- End Portfolio Details Section -->

    <p>Calendario</p>

    <!-- <div id="reseniasDiv">
      <i class="bi bi-star"></i>
      <i class="bi bi-star"></i>
      <i class="bi bi-star"></i>
      <i class="bi bi-star"></i>
      <i class="bi bi-star"></i>

    </div> -->

    <!-- =============================================================================================== -->
    <!-- RESEÑAS
        RESEÑAS -->
    <div id="ContenedorResenias">
      <!-- <div id="iconoContenedor">
            <i class="bi bi-chat-square-quote-fill" id="iconoR"></i>
          </div> -->
      <section id="DejaTuResenia">


        <div id="reseniasDiv">
          <form id="resenaForm" action="" method="post">
            <i class="bi bi-star estrellas" data-index="0"></i>
            <i class="bi bi-star estrellas" data-index="1"></i>
            <i class="bi bi-star estrellas" data-index="2"></i>
            <i class="bi bi-star estrellas" data-index="3"></i>
            <i class="bi bi-star estrellas" data-index="4"></i>

            <br />

            <textarea id="resenaTextarea" name="resena" rows="3" placeholder="Escribe tu reseña aquí..."
              maxlength="100"></textarea>

            <button class="custom-button" type="button">Publicar Reseña</button>

          </form>
        </div>

        <!-- <div id="reseniasDiv">


          
            </div> -->





        <input type="hidden" id="estrellasSeleccionadas" value="1">
      </section> <!--end section deja tu resena -->


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
                  <h3>John Ruiz</h3>

                </div>
              </div><!-- End testimonial item -->

            </div>
            <div class="swiper-pagination"></div>
          </div>

        </div>

      </section><!-- End Testimonials Section -->

    </div>


    <!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        var estrellas = document.querySelectorAll('.estrellas');
        var inputEstrellas = document.getElementById('estrellasSeleccionadas');
        
        // Inicializar la primera estrella como llena
        estrellas[0].classList.add('bi-star-fill');

        estrellas.forEach(function (estrella) {
            estrella.addEventListener('click', function () {
                var index = parseInt(this.dataset.index, 10);

                // Marcar las estrellas hasta la actual
                for (var i = 0; i <= index; i++) {
                    estrellas[i].classList.add('bi-star-fill');
                    estrellas[i].classList.remove('bi-star');
                }

                // Desmarcar las estrellas después de la actual
                for (var i = index + 1; i < estrellas.length; i++) {
                    estrellas[i].classList.remove('bi-star-fill');
                    estrellas[i].classList.add('bi-star');
                }

                inputEstrellas.value = index + 1;
            });
        });
    });
</script> -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        var estrellas = document.querySelectorAll('.estrellas');
        var inputEstrellas = document.getElementById('estrellasSeleccionadas');

        // Inicializar la primera estrella como llena
        marcarEstrellas(0);

        estrellas.forEach(function (estrella) {
          estrella.addEventListener('click', function () {
            var index = parseInt(this.dataset.index, 10);
            marcarEstrellas(index);
            inputEstrellas.value = index + 1;
          });
        });

        function marcarEstrellas(index) {
          // Marcar las estrellas hasta la actual
          for (var i = 0; i <= index; i++) {
            estrellas[i].classList.add('bi-star-fill');
            estrellas[i].classList.remove('bi-star');
          }

          // Desmarcar las estrellas después de la actual
          for (var i = index + 1; i < estrellas.length; i++) {
            estrellas[i].classList.remove('bi-star-fill');
            estrellas[i].classList.add('bi-star');
          }
        }
      });
    </script>

    <!-- =============================================================================================== -->
    <!-- END RESENAS  -->
    <!-- =============================================================================================== -->



  </main><!-- End #main -->

  <!-- ==============================================Inicio Footer ======= -->

  <?php
} else {
  echo "Nombre del inmueble no proporcionado en la URL.";
}
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->