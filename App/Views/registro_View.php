<?php
include './templates/Header.php';
?>
<!-- ==============================================Fin header ======= -->

<main id="main">

<div class="d-flex justify-content-center">
    <div class="custom-divRegistro">
        <form action="forms/contact.php" method="post" role="form" class="php-email-form">

            <div class="row row-spacing">
                <div class="col-md-12 form-group">
                    <label for="identificacion">Identificación:</label>
                    <input type="number" name="identificacion" class="form-control" id="identificacion" placeholder="301110222" required>
                </div>
            </div>

            <div class="row row-spacing">
                <div class="col-md-12 form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Juan" required>
                </div>
            </div>

            <div class="row row-spacing">
                <div class="col-md-12 form-group">
                    <label for="primerApellido">Primer Apellido:</label>
                    <input type="text" name="primerApellido" class="form-control" id="primerApellido" placeholder="Flores" required>
                </div>
            </div>

            <div class="row row-spacing">
                <div class="col-md-12 form-group">
                    <label for="segundoApellido">Segundo Apellido:</label>
                    <input type="text" name="segundoApellido" class="form-control" id="segundoApellido" placeholder="Flores:" required>
                </div>
            </div>

            <div class="row row-spacing">
                <div class="col-md-12 form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="correo@example.com" required>
                </div>
            </div>

            <div class="row row-spacing">
                <div class="col-md-12 form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" class ="form-control" id="telefono" placeholder="8888 8888" required>
                </div>
            </div>

            <div class="row row-spacing">
                <div class="col-md-12 form-group">
                    <label for="fotoPerfil">Subir foto de Perfil:</label>
                    <input type="file" class="form-control" name="fotoPerfil" id="fotoPerfil" required>
                </div>
            </div>

            <div class="text-center mt-3">
                <button class="custom-button" type="submit">Registrarse</button>
            </div>
        </form>
    </div>
</div>










</main>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->