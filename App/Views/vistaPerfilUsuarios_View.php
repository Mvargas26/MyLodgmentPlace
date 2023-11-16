<?php include './templates/Header.php'; ?>

<main id="main">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/vistaPerfilUsuarios.css">
    <div class="contener">
        <h2>Perfil de Usuario</h2>

        <div class="user-profile">
            <img src="" alt="Foto de Perfil" id="userProfileImage">
            <div class="user-details" id="userDetails">
                <!-- Aquí se llenarán dinámicamente los detalles del usuario -->
            </div>
            
            <div class="admin-options">
                <!-- Opciones de administrador: Validar Identidad, Validar Espacio, Revisar Denuncias, Revisar Reseñas -->
            </div>
            
            <div class="user-options">
                <button id="activateUser">Activar Usuario</button>
                <button id="deactivateUser">Desactivar Usuario</button>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../assets/js/VistaPerfilUsuarios/vistaPerfilUsuario.js"></script>

<?php include './templates/Footer.php'; ?>
