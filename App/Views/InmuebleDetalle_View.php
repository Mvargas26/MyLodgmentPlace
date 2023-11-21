<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');

include('../Modules/fullCalendar/config.php');

$SqlEventos   = ("SELECT * FROM tbreserva");
$resulEventos = mysqli_query($con, $SqlEventos);

session_start();
// if (!isset($_SESSION['id']) || !isset($_SESSION['rol']) || empty($_SESSION['id']) || empty($_SESSION['rol'])|| $_SESSION['rol']!=1) {
//     header('Location: ../../');
//     exit();
// }



// Verificar si se proporcionó un nombre de inmueble en la URL
if (isset($_GET['id'])) {
  $idInmuebleDetalle = $_GET['id'];
?>

  <link rel="stylesheet" type="text/css" href="../assets/css/fullcalendar.min.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/home.css">

  <!-- ==============================================Fin header ======= -->
  <main id="main">


    <h1 hidden><?php echo $idInmuebleDetalle ?></h1>
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
    <br>
    <br>
    <br>
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

                  } //end for 
                } //end if
                else {
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
            <div class="text-center mt-3" id="bodyDivButton">
              <?php
              if (isset($_SESSION["Rol"])) {
              ?>
                <button class="botonesListaFavoritos" id="btnAgregarLista" name="btnAgregarFavoritos" type="submit">+ Nueva Lista <i class="fa-solid fa-list" style="color: #ffffff;"></i></button>
                <button class="botonesListaFavoritos" id="btnAgregarFavoritos" name="btnAgregarFavoritos" type="submit">Agregar favorito <i class="fa-duotone fa-star" style="--fa-primary-color: #e14a09; --fa-secondary-color: #fafafa; --fa-secondary-opacity: 0.4;"></i> </button>
                <!-- <button id="btnAgregarFavoritos" name="btnAgregarFavoritos" class="custom-button" type="submit">Agregar a Favoritos</button> -->
              <?php } ?>
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
                <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-<?php //echo $dato['Categoria_Inmueble'] 
                                                                          ?>">
                        <div class="portfolio-img"><img src="./App/assets/img/ImagenesInmuebles/<?php //echo $dato['nameImagen'] 
                                                                                                ?>" class="img-fluid" alt=""></div>
                        <div class="portfolio-info">
                          <h4><?php  //echo $dato['Nombre_Inmueble'] 
                              ?></h4>
                          <p> ₡ <?php //echo $dato['valorDiario'] 
                                ?></p>
                          <a href="./App/assets/img/ImagenesInmuebles/<?php //echo $dato['nameImagen'] 
                                                                      ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="// $dato['Nombre_Inmueble'] ?>"><i class="bx bx-plus"></i></a>
                          <a href="./App/Views/InmuebleDetalle_View.php?nombre=<?php //echo urlencode($dato['Nombre_Inmueble']); 
                                                                                ?>" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
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

                    if($dato['disponibilidad'] == 1){
                      echo "Disponible";
                    }
                    else{
                      echo "No Disponible"; 
                    }
                    // echo $dato['disponibilidad'];
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
                  <strong>Cantidad de Baños: 3</strong>
                  <?php

                  // foreach ($datos as $dato) {

                  //   echo $dato['caracteristica1'];
                  //   break;
                  // } 
                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Cantidad de Camas: 8</strong>
                  <?php

                  
                  // foreach ($datos as $dato) {

                  //   echo $dato['caracteristica2'];
                  //   break;
                  // } 
                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Cantidad de Cuartos: 5</strong>
                  <?php
                  // foreach ($datos as $dato) {

                  //   echo $dato['caracteristica3'];
                  //   break;
                  // } 

                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Cocheras: 2</strong>
                  <?php
                  // foreach ($datos as $dato) {

                  //   echo $dato['caracteristica3'];
                  //   break;
                  // } 

                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Patios: 2</strong>
                  <?php
                  // foreach ($datos as $dato) {

                  //   echo $dato['caracteristica3'];
                  //   break;
                  // } 

                  ?><br>

                   <!-- ----------------------------------------------------- -->
                   <strong>Plantas: 2</strong>
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

    <!-- ================================================================================== -->
    <!-- CALENDARIO -->
    <!-- ================================================================================== -->
    <div id="CalendarioDiv">
      <section>
        <div class="container">
          <div class="row gy-4">
            <div class="col-lg-8">
              <div class="portfolio-details-slider swiper">
                <div class="col msjs">
                  <?php
                  include('./msjs.php');
                  ?>
                </div>

                <div id="calendar"></div>

                <?php
                include('./modalNuevoEvento.php');
                include('./modalUpdateEvento.php');
                ?>

                <script src="../assets/js/FullCalendar/jquery-3.0.0.min.js"></script>
                <script src="../assets/js/FullCalendar/popper.min.js"></script>
                <script src="../assets/js/FullCalendar/bootstrap.min.js"></script>

                <script type="text/javascript" src="../assets/js/FullCalendar/moment.min.js"></script>
                <script type="text/javascript" src="../assets/js/FullCalendar/fullcalendar.min.js"></script>
                <script src='../assets/locales/es.js'></script>

                <script type="text/javascript">
                  $(document).ready(function() {
                    $("#calendar").fullCalendar({
                      header: {
                        left: "prev,next today",
                        center: "title",
                        right: "month"
                      },

                      locale: 'es',

                      defaultView: "month",
                      navLinks: true,
                      editable: true,
                      eventLimit: true,
                      selectable: true,
                      selectHelper: false,

                      // Nuevo Evento
                      select: function(start, end) {
                        $("#exampleModal").modal();
                        $("input[name=fechaInicio]").val(start.format('DD-MM-YYYY'));

                        var valorFechaFin = end.format("DD-MM-YYYY");
                        var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); //Le resto 1 dia
                        $('input[name=fechaFin]').val(F_final);

                      },

                      events: [
                        <?php
                        while ($dataEvento = mysqli_fetch_array($resulEventos)) { ?>
                         {
                          _id: '<?php echo $dataEvento['idReserva']; ?>',
                          title: '<?php echo 'Reservado'; ?>',
                          start: '<?php echo $dataEvento['fechaInicio']; ?>',
                          end: '<?php echo $dataEvento['fechaFin']; ?>',
                          color: '<?php echo $dataEvento['colorEvento']; ?>'
                        },

                        <?php } ?>
                      ],

                      // Modificar Evento
                      eventClick: function(event) {
                        var idEvento = event._id;
                        console.log("Abriendo modal para el evento con ID:", idEvento);
                        $('input[name=idEvento]').val(idEvento);
                        $('input[name=fechaInicio]').val(event.start.format('DD-MM-YYYY'));
                        $('input[name=fechaFin]').val(event.end.format("DD-MM-YYYY"));
                        $("#modalUpdateEvento").modal();
                      },
                    });

                    // Oculta mensajes de Notificacion
                    setTimeout(function() {
                      $(".alert").slideUp(300);
                    }, 3000);

                  });
                </script>
              </div>
            </div>

          </div>

        </div>
    </div>
    
    <div class="container">
      <div class="" id="" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Reservar espacio</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form name="formEvento" id="formEvento" action="nuevoEvento.php" class="form-horizontal" method="POST">
              <div class="form-group">
                <div class="col-sm-10">
                  <h3>Valor por dia del inmueble: <span id="valorColones"><?php echo $dato['valorDiario']?></span> colones</h1>
                </div>
              </div>
              <div class="form-group">
                <label for="cantidadPersonas" class="col-sm-12 control-label">Cantidad de personas</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="cantidadPersonas" id="cantidadPersonas" min="0" value="0" placeholder="Cantidad de Personas">
                </div>
              </div>
              <div class="form-group">
                <label for="cantidadPersonasExtra" class="col-sm-12 control-label">Cantidad de personas extra</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="cantidadPersonasExtra" id="cantidadPersonasExtra" min="0" value="0" max="5" placeholder="Cantidad de Personas">
                </div>
              </div>
              <div class="form-group">
                <label for="fechaInicio" class="col-sm-12 control-label">Fecha Ingreso</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="fechaInicio" id="fechaInicio" placeholder="Fecha Inicio">
                </div>
              </div>
              <div class="form-group">
                <label for="fechaFin" class="col-sm-12 control-label">Fecha Salida</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="fechaFin" id="fechaFin" placeholder="Fecha Final">
                </div>
              </div>
              <div class="form-group">
                <label for="Cupon" class="col-sm-12 control-label">Cupon de descuento</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="Cupon" id="Cupon" placeholder="Cupon de descuento">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-10">
                  <!-- inicio campos hidden para el calculo previo -->
                  <input type="hidden" id="idInmueble" value="<?php echo $dato['id']; ?>">
                  <input type="hidden" id="valorDiario" value="<?php echo $dato['valorDiario']; ?>">
                  <input type="hidden" id="capacidadMaxima" value="<?php echo $dato['capacidadPersonas']; ?>">
                  <input type="hidden" id="costoPersonaExtra" value="<?php echo $dato['costoPersonaExtra']; ?>">
                  <!-- fin campos hidden para el calculo previo -->
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                  <h5>Total sin impuestos: <span id="valorTotal">0</span> colones</h5>
                  <h5>Total con impuestos: <span id="valorTotalImpuestos">0</span> colones</h5>
                </div>
              </div>



              <!-- Nuevo contenedor para mostrar el valor total -->

              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Guardar Evento</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </section>
    </div>

    <!-- colores -->
    <!-- <div class="col-md-12" id="grupoRadio">

              <input type="radio" name="color_evento" id="orange" value="#FF5722" checked>
              <label for="orange" class="circu" style="background-color: #FF5722;"> </label>

              <input type="radio" name="color_evento" id="amber" value="#FFC107">
              <label for="amber" class="circu" style="background-color: #FFC107;"> </label>

              <input type="radio" name="color_evento" id="lime" value="#8BC34A">
              <label for="lime" class="circu" style="background-color: #8BC34A;"> </label>

              <input type="radio" name="color_evento" id="teal" value="#009688">
              <label for="teal" class="circu" style="background-color: #009688;"> </label>

              <input type="radio" name="color_evento" id="blue" value="#2196F3">
              <label for="blue" class="circu" style="background-color: #2196F3;"> </label>

              <input type="radio" name="color_evento" id="indigo" value="#9c27b0">
              <label for="indigo" class="circu" style="background-color: #9c27b0;"> </label>

</div> -->





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

            <textarea id="resenaTextarea" name="resena" rows="3" placeholder="Escribe tu reseña aquí..." maxlength="100"></textarea>

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
              if ($datosResenas) {

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
                } //end FOR 
                ?>
              <?php
              } else {
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
      document.addEventListener("DOMContentLoaded", function() {
        var estrellas = document.querySelectorAll('.estrellas');
        var inputEstrellas = document.getElementById('estrellasSeleccionadas');

        // Inicializar la primera estrella como llena
        marcarEstrellas(0);

        estrellas.forEach(function(estrella) {
          estrella.addEventListener('click', function() {
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
  <script>
    var identificacion = <?php echo json_encode($_SESSION["Identificacion"]); ?>;
  </script>
  <script src="../assets/js/calculoPrevioReserva/script.js"></script>

<?php
} else {
  echo "Nombre del inmueble no proporcionado en la URL.";
}
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
