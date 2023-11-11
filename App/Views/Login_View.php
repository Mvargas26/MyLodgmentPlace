<?php
include './templates/Header.php';
include '../modules/Master_Class.php';  // Asegúrate de incluir la Master Class

// Crea una instancia de la Master Class
$ObjMaster = new Master_Class();

// Verifica si se ha enviado el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge las credenciales ingresadas (ajusta los nombres de los campos según tu formulario)
    $identificacion = $_POST["identificacion"];
    $password = $_POST["password"];

    // Verifica las credenciales
    if ($ObjMaster->verificarCredenciales($identificacion, $password)) {
        // Genera y almacena el código aleatorio
        $codigo_autenticacion = $ObjMaster->generarCodigoAleatorio(5);
        if ($ObjMaster->almacenarCodigoAutenticacion($identificacion, $codigo_autenticacion)) {
            // Envia el código al correo electrónico
            $destinatario = "nesler.16@hotmail.com";

            // Utiliza la función de prueba para enviar correos
            $ObjMaster->enviarCodigoAutenticacionCorreo($destinatario, $codigo_autenticacion);

            // Redirige a la página de código de autenticación
            header("Location: codigoAutenticacion_view.php");
            exit();
        } else {
            // Manejo de errores si falla al almacenar el código
            $error_message = "Error al almacenar el código de autenticación.";
        }
    } else {
        // Manejo de errores si las credenciales son incorrectas
        $error_message = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }
}

// Resto de tu código HTML
?>
<!-- Resto de tu código HTML -->
<main id="main">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <body id="bodyLogin">
        <div class="login-reg-panel">
            <!-- Resto de tu código HTML -->
            <div class="login-info-box">
            <h2>Have an account?</h2>
            <p>Lorem ipsum dolor sit amet</p>
            <label id="label-register" for="log-reg-show">Login</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
                </div>
            <div class="white-panel">
                <div class="login-show">
                    <h2>LOGIN</h2>
                    <!-- Agrega un formulario de login -->
                    <form action="codigoAutenticacion_view.php" method="post" id="loginForm">
                        <input type="text" name="identificacion" placeholder="Identificación" required>
                        <input type="password" name="password" placeholder="Contraseña" required>
                        <input type="submit" value="Login">
                        <a href="#">Forgot password?</a>
                    </form>
                </div>
            </div>

            <!-- Resto de tu código HTML -->

            <?php
            // Muestra mensajes de error si existen
            if (isset($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
            ?>
        </div>
    </body>
</main>

<?php
include './templates/Footer.php';
?>