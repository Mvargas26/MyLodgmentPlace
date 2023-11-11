<?php include './templates/Header.php'; ?>

<main id="main">
    <body id="bodyLogin">
        <div class="login-reg-panel">
            <!-- Resto de tu código HTML -->

            <div class="white-panel">
                <div class="login-show">
                    <h2>LOGIN</h2>
                    <!-- Agrega un formulario de login -->
                    <form action="" method="post" id="loginForm">
                        <input type="text" name="identificacion" placeholder="Identificación" required>
                        <input type="password" name="password" placeholder="Contraseña" required>
                        <input type="submit" value="Login">
                        <a href="#">Forgot password?</a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</main>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="js/script.js"></script>

<?php include './templates/Footer.php'; ?>