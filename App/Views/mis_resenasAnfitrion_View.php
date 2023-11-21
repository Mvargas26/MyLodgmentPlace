<?php
include './templates/Header.php';
// session_start();
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
  <!-- <input id="identificacion" type="text" value="304710908" ></input> -->
  <br>
    <br>
    <br>
    <br>


      <div id="ContenedorResenias">
          
          <section id="DejaTuResenia">

            <div id="reseniasDiv">
              <form id="resenaForm" action="" method="post">
                <h2>Elige un espacio</h2>
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

<!-- ---------------------------------------------------------------- -->

      <section id="testimonials" class="testimonials section-bg">


        <div class="container">

          <div class="section-title">
            <h2>Reseñas</h2>
          </div>

          <div id="testimonials-slider" class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
              

            </div>
            <div class="swiper-pagination"></div>
          </div>

        </div>

      </section>

</div>
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