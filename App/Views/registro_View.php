<?php
include './templates/Header.php';
?>
<!-- ==============================================Fin header ======= -->

<main id="main">

    <div class="d-flex justify-content-center">
        <div class="custom-divRegistro">
            <form id="formRegistro" name="formRegistro" method="post" role="form">

                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="identificacion">*Identificación:</label>
                        <input type="number" name="identificacion" class="form-control" id="identificacion" placeholder="301110222" required>
                    </div>
                </div>
                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="Clave">*Clave:</label>
                        <input type="password" name="Clave" class="form-control" id="Clave"  required>
                    </div>
                </div>

                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="nombre">*Nombre:</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Juan" required>
                    </div>
                </div>

                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="primerApellido">*Primer Apellido:</label>
                        <input type="text" name="primerApellido" class="form-control" id="primerApellido" placeholder="Flores" required>
                    </div>
                </div>

                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="segundoApellido">Segundo Apellido:</label>
                        <input type="text" name="segundoApellido" class="form-control" id="segundoApellido" placeholder="Flores">
                    </div>
                </div>

                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="correo@example.com">
                    </div>
                </div>

                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" class="form-control" id="telefono" placeholder="8888 8888">
                    </div>
                </div>

                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="edad">Edad:</label>
                        <input type="text" name="edad" class="form-control" id="edad" placeholder="30">
                    </div>
                </div>

                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="direccion">Direccion:</label>
                        <input type="text" name="direccion" class="form-control" id="direccion" placeholder="100 norte, 50 oeste de las Ruinas, Cartago">
                    </div>
                </div>

                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="idRol">Seleccione el tipo de Usuario:</label>
                        <select id="idRol" name="idRol">
                            <option value="2">Anfitrión</option>
                            <option value="3">Huésped</option>
                        </select>
                    </div>
                </div>

                <div class="row row-spacing">
                    <div class="col-md-12 form-group">
                        <label for="fotoPerfil">Subir foto de Perfil:</label>
                        <input type="file" class="form-control" name="fotoPerfil" id="fotoPerfil">
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button id="btnRegistar" name="btnRegistar" class="custom-button" type="submit">Registrarse</button>
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