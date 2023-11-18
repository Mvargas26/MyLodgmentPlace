<?php
include './templates/Header.php';
session_start();
?>
<link href="../assets/css/Anfitrion/styleCalificarHuesped.css" rel="stylesheet">
<!-- ==============================================Fin header ======= -->


<main>
    <div class="divImagen">
        <img  id="imgLogo" src="../assets/img/logo/logo2.png" alt="">
    </div>

<div class="tablareservaron">
<h2>Tabla de Reservas</h2>
<table>
    <thead>
        <tr>
            <th>Reserva</th>
            <th>Inmueble</th>
            <th>Cédula Huésped</th>
            <th>Nombre Huésped</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Casa 101</td>
            <td>123456789</td>
            <td>Juan Pérez</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Apartamento 202</td>
            <td>987654321</td>
            <td>María Rodríguez</td>
        </tr>
        <!-- Puedes agregar más filas según sea necesario -->
    </tbody>
</table>
</div>

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
            <?php if (isset($_SESSION["nombre"])) { ?>
              <button class="custom-button" type="button">Enviar Calificación</button>
        <?php } else { ?>
              <p style="font-family: inherit;">Debes tener una cuenta para Calificar!
                <a class="nav-link scrollto" style="color: #f4572c;" href="Login_View.php">Iniciar Sesion</a>
                <a class="nav-link scrollto" style="color: #f4572c;" href="registro_View.php">Registrarse</a>
              </p>
         <?php } ?>
          </form>
        </div>
        <input type="hidden" id="estrellasSeleccionadas" value="1">
      </section> 




</main>


<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->