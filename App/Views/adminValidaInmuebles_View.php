<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');

session_start();
// if (!isset($_SESSION['Rol']) || $_SESSION['Rol']!=1 ) {
//        header('Location: ../../');
// }
?>
<link href="../assets/css/Anfitrion/styleCalificarHuesped.css" rel="stylesheet">
<!-- ==============================================Fin header ======= -->
<body>
<div class="divImagen">
    <img id="imgLogo" src="../assets/img/logo/logo2.png" alt="">
</div>


  <section id="DejaTuResenia">
    <div id="reseniasDiv">
      <form id="formCalificarHuesped" action="" method="post">
        <div>
          <h6>Seleccione el Inmueble que desea Validar:</h6>
          <select id="ReservaCalificar" name="ReservaCalificar">

            <?php
            try {
              if (isset($_SESSION["Rol"])) {
                $resultadoConsulta = $ObjMaster->ConsultarInmueblesSinValidar();
            }
              $datos = json_decode($resultadoConsulta, true);
              if ($datos) {
                foreach ($datos as $dato) {
                ?>
                    <option value="<?php echo $dato['id'] ?>"><?php echo $dato['id'] ?> : <?php echo $dato['nombreInm'] ?> </option>
                  <?php
                }
              } else {
                ?>
                <option value="0">vacio</option>
            <?php
              }
            } catch (Exception $e) {
              echo 'Error: ' . $e->getMessage();
            }
            ?>
          </select>
        </div>
        <br>
        <button id="btnEnviarCalificacion" class="custom-button" type="submit">Validar</button>
      </form>
    </div>
  </section> <!--end section deja tu resena -->








</body>
<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->