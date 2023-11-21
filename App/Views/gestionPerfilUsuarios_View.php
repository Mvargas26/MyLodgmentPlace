<?php include './templates/Header.php'; 
session_start(); //tengo duda
if (!isset($_SESSION['id']) || !isset($_SESSION['rol']) || empty($_SESSION['id']) || empty($_SESSION['rol'])|| $_SESSION['rol']!=1) {
    header('Location: ../../');
    exit();
}
?>

<main id="main">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/gestionPerfilUsuarios.css">

    <div>
        <br>
        <h2>Gestión de Perfiles de Usuario</h2>
        <br>
        <hr>
        <div class="contiene">
            <div class="user-list">
                        

            </div>

        </div>
            
    </div>
</main>

<script src="../assets/js/GestionPerfilUsuarios/gestionPerfilUsuario.js"></script>

<?php include './templates/Footer.php'; ?>
