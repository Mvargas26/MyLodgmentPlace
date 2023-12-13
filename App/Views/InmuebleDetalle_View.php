<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');

include('../Modules/fullCalendar/config.php');

session_start();

if (isset($_SESSION['Identificacion'])) {
  $idUsuario = $_SESSION['Identificacion'];
}

if (isset($_GET['id'])) {
  $idInmueble = $_GET['id'];

  $SqlEventos = "SELECT * FROM tbreserva WHERE idInmueble = $idInmueble";

  $resulEventos = mysqli_query($con, $SqlEventos);

  $fechaInicio = date('Y-m-d');
  $fechaFin = date('Y-m-d');
}

if (1 === 1) {
  $query = "SELECT `Propietario` FROM `tbinmueble` WHERE id = $idInmueble";

  $resultadoConsulta = mysqli_query($con, $query);

  if ($resultadoConsulta) {
    $fila = mysqli_fetch_assoc($resultadoConsulta);
    $propietario = $fila['Propietario'];
    // Usar $propietario según sea necesario
  } else {
    // Manejar el caso en que la consulta falle
  }
}

if (isset($_GET['id'])) {
  $idInmueble = $_GET['id'];

  // Obtener la fecha actual en el formato de MySQL (YYYY-MM-DD)
  $fechaActual = date('Y-m-d');

  $consultaCupon = "SELECT tbdescuento.idCupon, tbdescuento.Monto 
                    FROM tbinmueblecupon 
                    INNER JOIN tbdescuento ON tbinmueblecupon.idCupon = tbdescuento.idCupon 
                    WHERE tbinmueblecupon.idInmueble = $idInmueble 
                    AND tbinmueblecupon.fechaVencimiento > '$fechaActual' 
                    LIMIT 1";

  $resultadoConsulta = mysqli_query($con, $consultaCupon);

  if ($resultadoConsulta && mysqli_num_rows($resultadoConsulta) > 0) {
    $fila = mysqli_fetch_assoc($resultadoConsulta);
    $nombreCupon = $fila['idCupon'];
    $descuentoCupon = $fila['Monto'];
    // Usar $nombreCupon y $descuentoCupon según sea necesario
  } else {
    // Manejar el caso en que la consulta no devuelve datos
  }
}


// Verificar si se proporcionó un nombre de inmueble en la URL
if (isset($_GET['id'])) {
  $idInmuebleDetalle = $_GET['id'];

?>

  <link rel="stylesheet" type="text/css" href="../assets/css/fullcalendar.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/home.css">

  <!-- ==============================================Fin header ======= -->

  <main id="main">

    <h1 hidden>
      <?php echo $idInmuebleDetalle ?>
    </h1>
    <!-- <input id='saldo' type="text" value="<?php echo $saldo ?>" hidden></input> -->
    <input id='idUsuario' type="text" value="<?php echo $idUsuario ?>" hidden></input>
    <input id='cedulaDuenno' type="text" value="<?php echo $propietario ?>" hidden></input>

    <input id='nombreCupon' type="text" value="<?php echo isset($nombreCupon) ? $nombreCupon : ''; ?>" hidden></input>
    <input id='descuentoCupon' type="text" value="<?php echo isset($descuentoCupon) ? $descuentoCupon : ''; ?>" hidden></input>

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
                <button class="botonesListaFavoritos" id="btnAgregarLista" name="btnAgregarFavoritos" type="submit">+ Nueva
                  Lista <i class="fa-solid fa-list" style="color: #ffffff;"></i></button>
                <button class="botonesListaFavoritos" id="btnAgregarFavoritos" name="btnAgregarFavoritos" type="submit">Agregar favorito <i class="fa-duotone fa-star" style="--fa-primary-color: #e14a09; --fa-secondary-color: #fafafa; --fa-secondary-opacity: 0.4;"></i>
                </button>
                <!-- <button id="btnAgregarFavoritos" name="btnAgregarFavoritos" class="custom-button" type="submit">Agregar a Favoritos</button> -->
              <?php } ?>
            </div>
          </div>

          <div class="col-lg-4">
            <div id="divFixed" class="position-fixed">
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

                  <strong>Capacidad de Personas Maxima:</strong>
                  <?php
                  foreach ($datos as $dato) {
                    $nuevoValor = $dato['capacidadPersonas'] - 4;

                    echo $nuevoValor; ?>
                    <input id='capacidadPersonas' type="text" value="<?php echo $nuevoValor ?>" hidden></input>
                  <?php
                    break;
                  }
                  ?><br>

                  <!-- ----------------------------------------------------- -->

                  <strong>Capacidad de Personas Extra: 4</strong>
                  <br>
                  <!-- ----------------------------------------------------- -->

                  <strong>Costo x Persona Extra:</strong>
                  <?php
                  foreach ($datos as $dato) {

                    echo $dato['costoPersonaExtra'];
                    break;
                  }
                  ?><br>

                  <!-- ----------------------------------------------------- -->

                  <strong>Costo x Noche:</strong>
                  <?php
                  foreach ($datos as $dato) {

                    echo $dato['valorDiario'];
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

                    if ($dato['disponibilidad'] == 1) {
                      echo "Disponible";
                    } else {
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
                  <strong>Cantidad de Baños: </strong>
                  <?php

                  foreach ($datos as $dato) {

                    echo $dato['cantidadBanos'];
                    break;
                  }
                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Cantidad de Camas: </strong>
                  <?php

                  foreach ($datos as $dato) {

                    echo $dato['cantidadCamas'];
                    break;
                  }
                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Cantidad de Cuartos: </strong>
                  <?php
                  foreach ($datos as $dato) {

                    echo $dato['cantidadCuartos'];
                    break;
                  }

                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Cocheras: </strong>
                  <?php
                  foreach ($datos as $dato) {

                    echo $dato['cantidadVehiculos'];
                    break;
                  }

                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Patios: </strong>
                  <?php
                  foreach ($datos as $dato) {

                    echo $dato['cantidadPatios'];
                    break;
                  }

                  ?><br>

                  <!-- ----------------------------------------------------- -->
                  <strong>Plantas: </strong>
                  <?php
                  foreach ($datos as $dato) {

                    echo $dato['cantidadPlantas'];
                    break;
                  }

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
                        while ($dataEvento = mysqli_fetch_array($resulEventos)) { ?> {
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

    <?php if (isset($_SESSION["Rol"])) {  ?>
      <div class="container">
        <div id="CardTarifaEspecial">
          <h4><i class="fas fa-tree" style="color: #045400"></i> Tarifa Especial: Descuento del 5% por fecha navideña</h4>
        </div>


        <div class="container">
          <div class="" id="" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Reservar espacio</h5>
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> -->
                </div>
                <form name="formEvento" id="formEvento" class="form-horizontal" method="POST">
                  <div class="form-group">
                    <div class="col-sm-10">
                      <h3>Valor por dia del inmueble: <span id="valorColones">
                          <?php echo $dato['valorDiario'] ?>
                        </span> colones</h1>
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
                      <?php
                      // Obtener la fecha actual y sumarle 4 días
                      $fechaMas1Dia = date('Y-m-d', strtotime('+1 days'));
                      ?>
                      <!-- <input type="date" class="form-control" name="fechaInicio" id="fechaInicio" placeholder="Fecha Inicio"> -->
                      <input type="date" id="fechaInicio" name="fechaInicio" value="<?php echo $fechaMas1Dia; ?>" hidden>
                      <input type="date" id="fechaInicioBC" name="fechaInicioBC" value="<?php echo $fechaMas1Dia; ?>">

                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fechaFin" class="col-sm-12 control-label">Fecha Salida</label>
                    <div class="col-sm-10">
                      <?php
                      // Obtener la fecha actual y sumarle 4 días
                      $fechaMas4Dias = date('Y-m-d', strtotime('+4 days'));
                      ?>
                      <input type="date" id="fechaFin" name="fechaFin" value="<?php echo $fechaMas4Dias; ?>" hidden>
                      <input type="date" id="fechaFinBC" name="fechaFinBC" value="<?php echo $fechaMas4Dias; ?>">
                      <!-- <input type="date" class="form-control" name="fechaFin" id="fechaFin" placeholder="Fecha Final"> -->
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="Cupon" class="col-sm-12 control-label">Cupon de descuento</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="Cupon" id="Cupon" placeholder="Cupon de descuento">
                    </div>
                    <?php if (isset($nombreCupon) && isset($descuentoCupon) && $nombreCupon !== '' && $descuentoCupon !== '') { ?>
                      <div class="col-sm-12">
                        <?php echo "Ingresa  " . $nombreCupon . " para obtener un descuento del " . intval($descuentoCupon) . "% en tu reserva."; ?>
                      </div>
                    <?php } ?>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-10">
                      <!-- inicio campos hidden para el calculo previo -->
                      <input type="hidden" id="idInmueble" value="<?php echo $dato['id']; ?>">
                      <input type="hidden" id="valorDiario" value="<?php echo $dato['valorDiario']; ?>">
                      <input type="hidden" id="capacidadMaxima" value="<?php echo $dato['capacidadPersonas']; ?>">
                      <input type="hidden" id="costoPersonaExtra" value="<?php echo $dato['costoPersonaExtra']; ?>">
                      <input type="hidden" id="idUsuario" value="<?php echo $Session['Identificacion']; ?>">
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
                    <button type="submit" id="crearReserva" class="btn btn-success" hidden>Reservar lugar</button>
                    <button type="button" id="calcularReserva" name="calcularReserva" class="btn btn-info">Calcular <i class="fa-solid fa-calculator"></i> </button>
                    <button type="button" id="crearReserva2" class="btn btn-success">Reservar <i class="fa-solid fa-check"></i> </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        </section>
      </div>

    <?php } ?>

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
      <!-- <section id="DejaTuResenia">

        <div id="reseniasDiv">
          <form id="resenaForm" action="" method="post">
            <i class="bi bi-star estrellas" data-index="0"></i>
            <i class="bi bi-star estrellas" data-index="1"></i>
            <i class="bi bi-star estrellas" data-index="2"></i>
            <i class="bi bi-star estrellas" data-index="3"></i>
            <i class="bi bi-star estrellas" data-index="4"></i>

            <br />

            <textarea id="resenaTextarea" name="resena" rows="3" placeholder="Escribe tu reseña aquí..." maxlength="100"></textarea> -->

      <!--  -->
      <?php
      // if (isset($_SESSION["nombre"])) {
      ?>
      <!-- <button class="custom-button" type="button">Publicar Reseña</button> -->
      <?php

      // } else {
      ?>
      <!-- <p style="font-family: inherit;">Debes tener una cuenta para comentar!
                <a class="nav-link scrollto" style="color: #f4572c;" href="Login_View.php">Iniciar Sesion</a>
                <a class="nav-link scrollto" style="color: #f4572c;" href="registro_View.php">Registrarse</a>
              </p> -->
      <?php

      // }
      ?>



      <!-- </form>
        </div>
        <input type="hidden" id="estrellasSeleccionadas" value="1">
      </section> end section deja tu resena -->




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
                      <h3>
                        <?php echo $item["NombreUsuarioResena"] ?>
                      </h3>
                      <h3>
                        <?php echo $item["fechaResena"] ?>
                      </h3>
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

    <!-- consumo de api -->


    <!-- //ASD -->


    <!-- <script>alert(<?php echo $saldo ?>);</script> -->


    <!-- //ASD -->


    <!-- -->

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
        var fixedDiv = document.getElementById('divFixed');
        if (!fixedDiv) {
          console.error("El elemento 'divFixed' no se encontró.");
          return;
        }

        // Obtén la posición inicial del elemento fijo
        var initialOffset = fixedDiv.offsetTop;

        // Define el límite máximo permitido para el desplazamiento hacia abajo
        var maxScroll = initialOffset + 525; // Puedes ajustar este valor según tus necesidades

        // Agrega el evento de desplazamiento
        window.addEventListener('scroll', function() {
          // Obtén la posición actual del desplazamiento
          var scrollPosition = window.scrollY;
          // Ajusta el estilo del elemento fijo
          if (scrollPosition > maxScroll) {
            fixedDiv.style.position = 'fixed';
            fixedDiv.style.top = initialOffset - (scrollPosition - maxScroll) + 'px';
          } else {
            fixedDiv.style.position = 'static';
          }
        });
      });

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
  <script>
    var fechaInicio1 = <?php echo json_encode($fechaMas1Dia); ?>;
    // var fechaFin = <?php echo json_encode($_SESSION["Identificacion"]); ?>;
  </script>
  <script src="../assets/js/ReservarLugar/realizarReserva.js"></script>
  <!-- <script src="../assets/js/FechaReservaDefault/script.js"></script> -->
  <!-- <script src="../assets/js/calculoPrevioReserva/script.js"></script> -->
  <!-- <script src="../assets/js/calculoPrevioReserva/calculoPrevioJS.js"></script> -->



<?php
} else {
  echo "Nombre del inmueble no proporcionado en la URL.";
}
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->