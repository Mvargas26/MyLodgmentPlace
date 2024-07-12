<?php
include './templates/Header.php';
?>

<!-- ==============================================Fin header ======= -->
<main id="main">
    <div class="divImagen">
    <img  id="imgLogo" src="../assets/img/logo/logo2.png" alt="">
    </div>

<div class="bodyRegistro">
    <div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <form id="formRegistro">
                <h1 id="register">¡Registrese Ahora!</h1>
                <div class="all-steps" id="all-steps"> 
                  <span class="step"><i class="fa-solid fa-id-card"></i></span> 
                  <span class="step"><i class="fa-solid fa-lock"></i></span> 
                  <span class="step"><i class="fa-solid fa-lock"></i></span> 
                  <span class="step"><i class="fa fa-user"></i></span> 
                  <span class="step"><i class="fa fa-user-pen"></i></span> 
                  <span class="step"><i class="fa fa-user-pen"></i></span> 
                  <span class="step"><i class="fa fa-envelope"></i></span> 
                  <span class="step"><i class="fa fa-mobile-phone"></i></span>
                  <span class="step"><i class="fa fa-cake-candles"></i></span>
                  <span class="step"><i class="fa fa-location-dot"></i></span>
                  <span class="step"><i class="fa fa-users"></i></span>
                  <span class="step"><i class="fa fa-image"></i></span>
                </div>

                <div class="tab">
                  <h6>¿Cual es sú identificación?</h6>
                    <p>
                    <input type="number" name="identificacion" class="inputformRegistro" id="identificacion" placeholder="301110222" required>
                      <!-- <input placeholder="Name..." oninput="this.className = ''" name="fname"></p> -->
                </div>
                <div class="tab">
                  <h6 >¿Cúal será su contraseña?</h6>
                  <input type="password" name="Clave" class="inputformRegistro" id="Clave"  required>
                    <!-- <p><input placeholder="City" oninput="this.className = ''" name="dd"></p> -->
                </div>
                <div class="tab">
                  <h6 >¿Confirme su contraseña?</h6>
                  <input type="password" name="Clave" class="inputformRegistro" id="verificarClave"  required>
                    <!-- <p><input placeholder="City" oninput="this.className = ''" name="dd"></p> -->
                </div>
                <div class="tab">
                    <h6>¿Cual es sú nombre?</h6>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Juan" required>
                    <!-- <p><input placeholder="Favourite Shopping site" oninput="this.className = ''" name="email"></p> -->
                </div>
                <div class="tab">
                    <h6>¿Cual es sú primer apellido?</h6>
                    <input type="text" name="primerApellido" class="inputformRegistro" id="primerApellido" placeholder="Flores" required>
                    <!-- <p><input placeholder="Favourite car" oninput="this.className = ''" name="uname"></p> -->
                </div>
                <div class="tab">
                <h6>¿Cual es sú segundo apellido?</h6>
                <input type="text" name="segundoApellido" class="inputformRegistro" id="segundoApellido" placeholder="Flores">
                </div>


                <div class="tab">
                <h6>¿Cual es sú correo electrónico?</h6>
                <input type="email" name="email" class="inputformRegistro" id="email" placeholder="correo@example.com" require>
                </div>

                <div class="tab">
                <h6>¿Cual es sú número telefónico?</h6>
                <input type="number" name="telefono" class="inputformRegistro" id="telefono" placeholder="8888 8888">
                </div>

                <div class="tab">
                <h6>¿Cual es sú edad?</h6>
                <input type="number" name="edad" class="inputformRegistro" id="edad" placeholder="30">
                </div>
                <div class="tab">
                <h6>¿Cual es sú dirección?</h6>
                <input type="text" name="direccion" class="inputformRegistro" id="direccion" placeholder="100 norte, 50 oeste de las Ruinas, Cartago">
                </div>
                
                <div class="tab">
                <div >
                    <h6>¿Seleccione el tipo de usuario?</h6>
                        <select id="idRol" name="idRol">
                            <option value="2">Anfitrión</option>
                            <option value="3">Huésped</option>
                     </select>
                </div>
                </div>
                <div class="tab">
                <h6>Porfacor seleccione una foto de perfil</h6>
                <input type="file" class="form-control" name="fotoPerfil" id="fotoPerfil" require>
                </div>

                <div class="thanks-message text-center" id="text-message"> <img src="https://i.imgur.com/O18mJ1K.png" width="100" class="mb-4">
                    <h3>Gracias por su información!</h3> 
                </div>
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;">
                      <button type="button" id="prevBtn" onclick="nextPrev(-1)"><i class="fa fa-angle-double-left"></i></button> 
                      <button type="button" id="nextBtn" onclick="nextPrev(1)"><i class="fa fa-angle-double-right"></i></button>
                      <button id="btnRegistar" name="btnRegistar" class="custom-button" type="submit" style="display: none">Registrarse</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 
    </div>

    <!-- <div class="d-flex justify-content-center">
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
    </div> -->
</main>


<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->