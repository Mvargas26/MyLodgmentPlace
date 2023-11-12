<?php
include './templates/Header.php';
?>
<!-- ==============================================Fin header ======= -->
<main id="main">

    <link href="../assets/css/cupones.css" rel="stylesheet">

    <body id="body">
    <div class="contener">   
        <!-- Sección para cambiar la contraseña -->
        <div id="seccionCupon">
            <h2>Cupon de descuento</h2>
            <form>
                <label for="contrasenaAnterior">Codigo del cupon:</label>
                <input type="password" id="contrasenaAnterior" name="contrasenaAnterior" required><br>

                <label for="contrasenaNueva">Contraseña Nueva:</label>
                <input type="password" id="contrasenaNueva" name="contrasenaNueva" required><br>

                <label for="confirmarContrasenaNueva">Confirmar Contraseña Nueva:</label>
                <input type="password" id="confirmarContrasenaNueva" name="confirmarContrasenaNueva" required><br>

                <button type="submit">Cambiar Contraseña</button>
            </form>


        </div>

        <!-- Sección para cambiar el correo electrónico -->
        <div id="seccionTarjeta">
            <h2>Tarjeta de regalo</h2>
            <form>
                <label for="correoActual">Codigo de la tarejeta de regalo:</label>
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