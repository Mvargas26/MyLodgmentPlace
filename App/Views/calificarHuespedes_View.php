<?php
include './templates/Header.php';
session_start();
require_once('../Modules/Master_Class.php');
?>

<link href="../assets/css/Anfitrion/styleCalificarHuesped.css" rel="stylesheet">
<!-- ==============================================Fin header ======= -->
<main>
    <div class="divImagen">
        <img  id="imgLogo" src="../assets/img/logo/logo2.png" alt="">
    </div>

<div id="contenedorTablaResenas">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div >
                            <h4 class="title">Usuarios con reserva en sus Espacios</span></h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th># Reserva</th>
                                <th>Inmueble Reservado</th>
                                <th>Cedula Huesped</th>
                                <th>Nombre Huesped</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                              try {
                                $resultadoConsulta = $ObjMaster->consultaInfoparaCalificarHuesped(888888888);
                                $datos = json_decode($resultadoConsulta, true);
                                if ($datos) {
                                  foreach ($datos as $dato) {
                    ?>
                             <tr>
                                <td><?php echo $dato['reserva'] ?></td>
                                <td><?php echo $dato['inmueble_reservado'] ?></td>
                                <td><?php echo $dato['ced_huesped'] ?></td>
                                <td><?php echo $dato['nombre_huesped'] ?></td>
                                <td>
                                </td>
                            </tr>    
                    <?php
                                  }
                                } else {
                                  echo 'Error al decodificar el JSON';
                                }
                              } catch (Exception $e) {
                                echo 'Error: ' . $e->getMessage();
                              }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="contenedorEnviarresena">

      <section id="DejaTuResenia">
        <div id="reseniasDiv">
          <form id="formCalificarHuesped" action="" method="post">
            <div >
                    <h6>Seleccione el Usuario:</h6>
                        <select id="ReservaCalificar" name="ReservaCalificar">
                          
                        <?php
                              try {
                                $resultadoConsulta = $ObjMaster->consultaInfoparaCalificarHuesped(888888888);
                                $datos = json_decode($resultadoConsulta, true);
                                if ($datos) {
                                  foreach ($datos as $dato) {
                    ?>    
                               <option value="<?php echo $dato['reserva'] ?>">Reserva: <?php echo $dato['reserva']?> - <?php echo $dato['nombre_huesped'] ?> </option>
                    <?php
                                  }
                                } else {
                                  echo 'Error al decodificar el JSON';
                                }
                              } catch (Exception $e) {
                                echo 'Error: ' . $e->getMessage();
                              }
                    ?>
                     </select>
          </div>
            <i class="bi bi-star estrellas" data-index="0"></i>
            <i class="bi bi-star estrellas" data-index="1"></i>
            <i class="bi bi-star estrellas" data-index="2"></i>
            <i class="bi bi-star estrellas" data-index="3"></i>
            <i class="bi bi-star estrellas" data-index="4"></i>
            <br />
            <textarea id="resenaTextarea" name="resena" rows="3" placeholder="Escribe tu comentario aquí..." maxlength="100"></textarea>

              <button class="custom-button" type="submit">Enviar Calificación</button>
          </form>
        </div>
        <input type="hidden" id="estrellasSeleccionadas" value="1">
      </section> <!--end section deja tu resena -->

    </div>
</div>

<!-- este script llena las estrillitas -->

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
      var identificacion = <?php echo json_encode($_SESSION["Identificacion"]); ?>;
    </script>
<!-- ==============================================Inicio Footer ======= -->
<script src="../assets/js/Calificacion/scriptCalificarhuesped.js"></script>
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->