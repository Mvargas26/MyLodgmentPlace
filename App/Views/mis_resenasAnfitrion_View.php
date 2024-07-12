<?php
include './templates/Header.php';
session_start();
// if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=2) {
//     header('Location: ../../');
//     exit();
// }
?>
<!-- ==============================================Fin header ======= -->

<?php
    //   try {
      
      //     $resultadoConsulta2 = $ObjMaster->ConsultaMultipleEspacios($idInmuebleDetalle);
      //     // Decodificar el string JSON a un array de PHP
    //     $datosResenas = json_decode($resultadoConsulta2, true);
    //   } catch (Exception $e) {
    //     echo 'Error: ' . $e->getMessage();
    //   }
    
  ?>  
  <input id="identificacion" type="hidden" value="<?php echo $_SESSION["Identificacion"] ?>" ></input>
  <input id="idInmueble" type="hidden" value=""></input>
  <!-- <input id="identificacion" type="text" value="304710908" ></input> -->
  <br>
    <br>
    <br>
    <br>
    <!-- CONTENEDOR 2 -->
    
    <div id="ContenedorResenias">
        
        <!-- <section id="DejaTuResenia">
    
          <div id="reseniasDiv">
            <form id="resenaForm" action="" method="post">
              <h2>Tus Inmuebles: </h2>
              <br />
    
              <select class="form-control" name="LUGARES" id="LUGARES" required>
                  <option value=""></option>
              </select>
    
    
            </form>
          </div>
          <input type="hidden" id="estrellasSeleccionadas" value="1">
        </section> end section deja tu resena -->
    
    
    
    
          <!-- CONSULTAR RESENAS POR ID -->
          <!-- ---------------------------------------------------------------- -->
          <!-- $datosResenas = json_decode($resultadoConsulta2, true); -->
    <!--   --------------------------------------------------------------- -->
    <?php 
    require_once '../Modules/Master_Class.php';
    try {
    $identificacion = $_SESSION["Identificacion"];
    
    $count = $ObjMaster->CalcularTotalDeResenas_Anfitrion($identificacion);
    $promedio = $ObjMaster->CalcularCalificacion_totalResenias_Anfitrion($identificacion);
    
    } catch (Exception $e) {
    echo 'Error1: ' . $e->getMessage();
    }
    
    ?>
    <!--   --------------------------------------------------------------- -->
    <section id="testimonials" class="testimonials section-bg">
    
    
    <div class="container">
    
    <!-- <div class="section-title">
      <h2>Tus Estadisticas</h2>
    </div>
    <hr> -->
    
    <div id="contenedorEstadisticas">
    
      <section id="counts" class="counts">
        <div class="container">
    
          <div class="row counters">
              <div class="col-lg-3 col-6 text-center">
                <input type="hidden" id="CantidadDeResenastotales" value= "<?php echo  $count ?> ">
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $count; ?>" id="ResenasTotales" data-purecounter-duration="2" class="purecounter"></span>
                <p id="p">Reseñas Totales</p>
              </div>
    
              <div class="col-lg-3 col-6 text-center">
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $promedio; ?>" data-purecounter-duration="2" class="purecounter"></span>
                <p id="p">Calificación General (Todos los inmuebles)</p>
              </div>
          
              <div class="col-lg-3 col-6 text-center">
                <span data-purecounter-start="0" id="CalifficacionPorInmueble">0</span>
                <p id="p">Calificacion por Inmueble</p>
              </div>
              
              <div class="col-lg-3 col-6 text-center">
                <span data-purecounter-start="0" id="CantidadResenasPorInmueble">0</span>
                <p id="p">Cantidad de Reseñas por Inmueble</p>
              </div>
    
          </div>
    
        
        </div>
      </section><!-- End Counts Section -->
    
    
    </div>
    
    </div>
    
    </section>
    
  </div> <!--fin contenedor1 -->
    

  <!-- CONTENEDOR 2 -->
    
      <div id="ContenedorResenias">
          
        <section id="DejaTuResenia">

            <div id="reseniasDiv">
              <form id="resenaForm" action="" method="post">
                <h2>Tus Inmuebles: </h2>
                <br />

                <select class="form-control" name="LUGARES" id="LUGARES" required>
                    <option value=""></option>
                </select>


              </form>
            </div>
            <input type="hidden" id="estrellasSeleccionadas" value="1">
          </section> <!--end section deja tu resena -->




            <!-- CONSULTAR RESENAS POR ID -->
            <!-- ---------------------------------------------------------------- -->
            <!-- $datosResenas = json_decode($resultadoConsulta2, true); -->
<!--   --------------------------------------------------------------- -->
        <section id="testimonials" class="testimonials section-bg">


          <div class="container ajustetamanio">

            <div class="section-title">
              <h2>Reseñas</h2>
            </div>

            <div id="testimonials-slider" class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            
              <div class="swiper-wrapper flexwrap"></div>
              <div class="swiper-pagination"></div>
            </div>

          </div>

        </section>

      </div>
<br>



<br>
<br>
<br>
<br>



<!-- <script>var identificacion =; </script> -->

<script src="../assets/js/resenas/script_resenas.js"></script>
<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->