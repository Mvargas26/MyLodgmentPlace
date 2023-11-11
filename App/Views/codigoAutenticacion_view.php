<?php
include './templates/Header.php';
?>
<!-- ==============================================Fin header ======= -->
<main id="main">

<div id="CajaCodigoAutenticacion">
            <h2>Código de Autenticación</h2>
            <div>
                <form action="codigoAutenticacion_process.php" method="post" id="codigoAutenticacionForm">
                    <p>Se ha enviado un código de autenticación a tu correo electrónico.</p>
                    <label for="codigo">Código:</label>
                    <input type="text" name="codigo" required>
                    <input type="submit" value="Verificar Código">
            </form>
            </div>
    </div>

</main>


  

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->

