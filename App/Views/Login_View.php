<?php include './templates/Header.php'; ?>

<link href="<?php echo $base_path; ?>css/loginNuevo.css" rel="stylesheet">

<main id="main">
    <body>
       <!DOCTYPE html>
        <html lang="en">
        <head>
            <!-- Design by foolishdeveloper.com -->
            <title>Login My Lodgment Place</title>

            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
   
        </head>
        <body>
            <div class="background">
                <div class="shape"></div>
                <div class="shape"></div>
            </div>
            <form action="" method="post" id="loginForm">
                <img src="<?php echo $base_path; ?>img/logo/Logo_blanco2.png" alt="Logo" class="form-logo">
                <h6>Ingresa tus credenciales:</h6>

                <label for="identificacion">identificación</label>
                <input type="number" name="identificacion" placeholder="Identificación" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Contraseña" required>

                <input type="submit" value="Entrar" class="btnLogin">
            </form>
        </body>

        </html>
    </body>
</main>
<script>
    $(document).ready(function() {
        $('#loginForm input[type=submit]').prop('disabled', false);
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Vendor JS Files -->
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/script_personalizado.js"></script>
<script src="../assets/js/script_validarIdentidad.js"></script>
<script src="../assets/js/VistaDetalle/scriptVistaDetalle.js"></script>
<script src="../assets/js/Registro/registroScript.js"></script>
<script src="../assets/js/loginNuevo.js"></script>
</body>

</html>