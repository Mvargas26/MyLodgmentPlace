<?php include './templates/Header.php'; ?>

<main id="main">

    <body id="bodyLogin">
        <div class="login-reg-panel">
            <div id="divImagen">
                <img id="imgLogo" src="../assets/img/logo/logo2.png" alt="">
            </div>
            <!-- Resto de tu código HTML -->

            <div class="white-panel">
                <div class="login-show">
                    <h2>Inicio de Sesion</h2>
                    <!-- Agrega un formulario de login -->
                    <form action="" method="post" id="loginForm">
                        <input type="number" name="identificacion" placeholder="Identificación" required>
                        <input type="password" name="password" placeholder="Contraseña" required>
                        <input type="submit" value="Entrar">
                    </form>
                </div>
            </div>
        </div>
    </body>
</main>
<script>
    $(document).ready(function() {
        $('#loginForm input[type=submit]').prop('disabled', false);
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<?php include './templates/Footer.php'; ?>