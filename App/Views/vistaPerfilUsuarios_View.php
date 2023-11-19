<?php include './templates/Header.php'; ?>

<main id="main">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/vistaPerfilUsuarios.css">
    <div class="contener">
        <br>
        <h2>Perfil de Usuario</h2>

        <div class="contiene">
            <img src="" alt="Foto de Perfil" id="userProfileImage">
            <div class="user-details" id="userDetails">
                
            </div>
            
            <div class="contiene">
                <ul>
                    <li id="validarIdentidadBtn"><span>Validar Identidad</span></li>
                    <li id="validarEspacioBtn"><span>Validar Espacio</span></li>
                    <li id="denunciasBtn"><span>Denuncias</span></li>
                    <li id="activarUsuarioBtn"><span>Activar Usuario</span></li>
                    <li id="inactivarUsuarioBtn"><span>Inactivar Usuario</span></li>
                </ul>
            </div>

        </div>
    </div>
</main>

<script src="../assets/js/VistaPerfilUsuarios/vistaPerfilUsuario.js"></script>

<?php include './templates/Footer.php'; ?>
