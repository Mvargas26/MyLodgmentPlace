<?php include './templates/Header.php'; 
session_start();

?>

<main id="main">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/vistaPerfilUsuarios.css">
    <div class="contener">
        <br>
            <a href="gestionPerfilUsuarios_View.php" style="margin-left: 10px;">
                <i class="fa-solid fa-caret-left fa-beat-fade fa-2xl" style="color: #443745;"></i>
            </a>
        <br>
        <h2>Perfil de Usuario</h2>
       
        <div class="contiene">

                <div class="contiene2">
                <img src="" alt="Foto de Perfil" id="userProfileImage">
                </div>
                
            <div class="user-details" id="userDetails">
                
            </div>
            
            <div class="contiene">
                <ul>
                    <li class="li" id="validarIdentidadBtn"><span>Validar Identidad</span></li>
                    <li class="li" id="validarEspacioBtn"><span>Validar Espacio</span></li>
                    <li class="li" id="denunciasBtn"><span>Denuncias</span></li>
                    <!-- <li class="li" id="activarUsuarioBtn"><span>Activar Usuario</span></li>
                    <li class="li" id="inactivarUsuarioBtn"><span>Inactivar Usuario</span></li> -->
                </ul>
            </div>

        </div>
    </div>
</main>

<script src="../assets/js/VistaPerfilUsuarios/vistaPerfilUsuario.js"></script>

<?php include './templates/Footer.php'; ?>
