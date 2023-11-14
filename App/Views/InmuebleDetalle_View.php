<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');
session_start();
// Verificar si se proporcionó un nombre de inmueble en la URL
if (isset($_GET['id'])) {
  $idInmuebleDetalle = $_GET['id'];
  ?>
  <!-- ==============================================Fin header ======= -->
  <main id="main">

    
    <h1><?php echo $idInmuebleDetalle ?></h1>
    <!-- ----------------------------------------------------- -->
    <!-- PRIMERO HACE LA CONSULTA DE LOS DATOS DEL INMUEBLE -->
    <!-- SEGUN EL ID QUE RECIBIO POR URL -->
    <!-- ----------------------------------------------------- -->
    <?php
      try {

        $resultadoConsulta = $ObjMaster->ConsultarInmuebles_porID($idInmuebleDetalle);
        // Decodificar el string JSON a un array de PHP
        $datos = json_decode($resultadoConsulta, true);
      } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
      }
    
    ?>         
    <!-- ----------------------------------------------------- -->
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <h1>Informacion del espacio</h1>

        
      </div>
    </section><!-- End Breadcrumbs -->
    
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        
        <div class="row gy-4">
          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              
              
              <!-- CAROUSEL CON IMAGENES DEL ESPACIO -->
              <div class="swiper-wrapper align-items-center">
                
                <?php
                  
                  if ($datos) {
                    // $datosAgrupados = array();
                    foreach ($datos as $dato) {
                  ?>
                    <div class="swiper-slide">
                      <img src="../../App/assets/img/ImagenesInmuebles/<?php echo $dato['nameImagen'] ?> " alt="">
                    </div>
                    
                    <?php

                    }//end for 
                  }//end if
                  else{
                    ?>
                      <div class="swiper-slide">
                        <p>No se encontraron imagenes para este inmueble</p>
                        </div>
                    <?php
                  }
                  ?>

                <!-- <div class="swiper-slide">
                  <img src="../assets/img/portfolio/portfolio-1.jpg" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="../assets/img/portfolio/portfolio-2.jpg" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="../assets/img/portfolio/portfolio-3.jpg" alt="">
                </div> -->

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
              
              <?php

// try {
                //   $resultadoConsulta = $ObjMaster->ConsultarInmuebles();
                //   // Decodificar el string JSON a un array de PHP
                //   $datos = json_decode($resultadoConsulta, true);
                
                //   if ($datos) {
                  //     // $datosAgrupados = array();
                  
                  
                  //     foreach ($datos as $dato) {
                    ?>
                      <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-<?php //echo $dato['Categoria_Inmueble'] ?>">
                        <div class="portfolio-img"><img src="./App/assets/img/ImagenesInmuebles/<?php //echo $dato['nameImagen'] ?>" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                          <h4><?php  //echo $dato['Nombre_Inmueble'] ?></h4>
                          <p> ₡ <?php //echo $dato['valorDiario'] ?></p>
                          <a href="./App/assets/img/ImagenesInmuebles/<?php //echo $dato['nameImagen'] ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?php// $dato['Nombre_Inmueble'] ?>"><i class="bx bx-plus"></i></a>
                          <a href="./App/Views/InmuebleDetalle_View.php?nombre=<?php //echo urlencode($dato['Nombre_Inmueble']); ?>" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                      </div> -->
                <?php
                  // function obtenerPrimerValorUnico($columna) {
                  //   return reset(array_unique(array_column($datos, $columna)));
                  // }
                  
                  ?>

                <h2>Características del espacio:</h2>
                <p>
                  <strong>Nombre del Inmueble:</strong>
                  <?php 
                  foreach ($datos as $dato) {
                    
                    echo $dato['Nombre_Inmueble'];
                    break;
                  }               
                  ?><br>
                  <!-- ----------------------------------------------------- -->
                  
                  <strong>Capacidad de Personas:</strong>
                  <?php 
                    foreach ($datos as $dato) {
                      
                      echo $dato['capacidadPersonas'];
                      break;
                    }             
                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Dirección:</strong>
                  <?php 
                    foreach ($datos as $dato) {

                      echo $dato['direccion'];
                      break;
                    }   
                  
                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Disponibilidad:</strong>
                  <?php 
                  foreach ($datos as $dato) {

                    echo $dato['disponibilidad'];
                    break;
                  } 
                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Estrellas:</strong>
                  <?php
                  foreach ($datos as $dato) {

                    echo $dato['estrellas'];
                    break;
                  } 
                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Fecha Límite de Disponibilidad:</strong>
                  <?php 
                  foreach ($datos as $dato) {

                    echo $dato['fechaLimiteDisponibilidad'];
                    break;
                  } 
                  
                  ?><br>


                  <!-- ----------------------------------------------------- -->
                  <strong>Propietario:</strong>
                  <?php 
                  foreach ($datos as $dato) {

                    echo $dato['nombre_propietario'];
                    break;
                  } 

                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Característica 1:</strong>
                  <?php 

                  // foreach ($datos as $dato) {

                  //   echo $dato['caracteristica1'];
                  //   break;
                  // } 
                  ?><br>

                    <!-- ----------------------------------------------------- -->
                  <strong>Característica 2:</strong>
                  <?php 
                  // foreach ($datos as $dato) {

                  //   echo $dato['caracteristica2'];
                  //   break;
                  // } 
                  ?><br>

                    <!-- ----------------------------------------------------- -->
                  <strong>Característica 3:</strong>
                  <?php 
                    // foreach ($datos as $dato) {

                    //   echo $dato['caracteristica3'];
                    //   break;
                    // } 

                  ?><br>
                </p>
              </div>
            </div>

          </div>

        </div>
    </section><!-- End Portfolio Details Section -->

    <br/>
    <br/>
    <br/>
    <p>Calendario</p>
    <br/>
    <br/>
    <br/>
    <br/>

    <!-- =============================================================================================== -->
    <!-- RESEÑAS
        RESEÑAS -->
    <div id="ContenedorResenias">
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

              <!--  -->
              <?php 
                if (isset($_SESSION["nombre"])) {
                  ?>
                    <button class="custom-button" type="button">Publicar Reseña</button>
                  <?php 

                } else {
            ?>
                  <p style="font-family: inherit;">Debes tener una cuenta para comentar! 
                    <a class="nav-link scrollto" style="color: #f4572c;" href="Login_View.php">Iniciar Sesion</a> 
                    <a class="nav-link scrollto" style="color: #f4572c;" href="registro_View.php">Registrarse</a>
                  </p>
            <?php

            }
          ?>
              


          </form>
        </div>
        <input type="hidden" id="estrellasSeleccionadas" value="1">
      </section> <!--end section deja tu resena -->




            <!-- CONSULTAR RESENAS POR ID -->
<!-- ---------------------------------------------------------------- -->

<?php
      try {

        $resultadoConsulta2 = $ObjMaster->ConsultarResenas_porID($idInmuebleDetalle);
        // Decodificar el string JSON a un array de PHP
        $datosResenas = json_decode($resultadoConsulta2, true);
      } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
      }
    
  ?>  
<!-- ---------------------------------------------------------------- -->
      <section id="testimonials" class="testimonials section-bg">


        <div class="container">

          <div class="section-title">
            <h2>Reseñas</h2>
            <p>Nos intereza mucho saber tu opinion y que la comunidad de My Lodgment Place tambien la conozca</p>
          </div>

          <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">

              <?php
                if($datosResenas){

                  foreach ($datosResenas as $item) {
                    ?>
                      <div class="swiper-slide">
                        <div class="testimonial-item">
                          <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            <?php echo $item["Descripcion"] ?>
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                          </p>
                          <img src="<?php echo $item["fotoperfil"] ?>" class="testimonial-img" alt="">
                          <h3><?php echo $item["NombreUsuarioResena"] ?></h3>
                          <h3><?php echo $item["fechaResena"] ?></h3>
                        </div>
                      </div><!-- End testimonial item -->
                      <?php
                  }//end FOR 
                  ?>
                  <?php
                }else{
                  ?>
                    <p style="margin-top:10%; margin-left:40%">Aún no hay reseñas para este lugar</p>
                  <?php

                }
                  ?>
            </div> <!-- end RESENIAS TARJETA -->
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