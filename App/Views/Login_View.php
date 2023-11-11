<?php
include './templates/Header.php';
?>
<!-- ==============================================Fin header ======= -->
<main id="main">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body id="bodyLogin">
    <div class="login-reg-panel">
        <div class="login-info-box">
            <h2>Have an account?</h2>
            <p>Lorem ipsum dolor sit amet</p>
            <label id="label-register" for="log-reg-show">Login</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
        </div>

        <div class="register-info-box">
            <h2>Aun no tienes una cuenta?</h2>
            <label id="label-login" for="log-login-show">Registrate</label>
            <input type="radio" name="active-log-panel" id="log-login-show">
        </div>
<div>prueba push</div>
        <div class="white-panel">
            <div class="login-show">
                <h2>LOGIN</h2>
                <input type="text" id="identificacion" placeholder="identificacion">
                <input type="password" id="password" placeholder="Password">
                <input type="button" id="btnLogin" value="Login">
                <a href="">Forgot password?</a>
            </div>
            <div class="register-show">
            <h2>Registro</h2>
            <a href="./registro_View.php">Ir a Registro</a>


        </div>
        </div>
    </div>
</body>


</main>


  

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->