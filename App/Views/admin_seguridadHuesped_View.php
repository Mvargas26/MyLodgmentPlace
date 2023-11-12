<?php
include './templates/Header.php';
?>
<!-- ==============================================Fin header ======= -->
<main id="main">
    <link href="../assets/css/admSeguridad.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <body id="body">

    <p>Panel Administrativo de Seguridad </p>   

        <div class="contener">   
        <!-- Sección para cambiar la contraseña -->
        <div id="seccionCambiarContrasena">
            <h2>Cambiar Contraseña</h2>
            <form>
                <label for="contrasenaAnterior">Contraseña Anterior:</label>
                <input type="password" id="contrasenaAnterior" name="contrasenaAnterior" required><br>

                <label for="contrasenaNueva">Contraseña Nueva:</label>
                <input type="password" id="contrasenaNueva" name="contrasenaNueva" required><br>

                <label for="confirmarContrasenaNueva">Confirmar Contraseña Nueva:</label>
                <input type="password" id="confirmarContrasenaNueva" name="confirmarContrasenaNueva" required><br>

                <button type="submit">Cambiar Contraseña</button>
            </form>
        </div>

        <!-- Sección para cambiar el correo electrónico -->
        <div id="seccionCambiarCorreo">
            <h2>Cambiar Correo Electrónico</h2>
            <form>
                <label for="correoActual">Correo Actual:</label>
                <input type="email" id="correoActual" name="correoActual" required><br>

                <label for="correoNuevo">Correo Nuevo:</label>
                <input type="email" id="correoNuevo" name="correoNuevo" required><br>

                <label for="confirmarCorreoNuevo">Confirmar Correo Nuevo:</label>
                <input type="email" id="confirmarCorreoNuevo" name="confirmarCorreoNuevo" required><br>

                <button type="submit">Cambiar Correo Electrónico</button>
            </form>
        </div>
        <br>
        <br>
        </div>

    </body>
</main>

  

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->