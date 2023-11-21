<?php include './templates/Header.php'; 
session_start();
if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=1) {
    header('Location: ../../');
    exit();
}
?>

<main id="main">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/ImueblesPorUsuario/imueblesporusuario.css">

    <div>
    <br>
            <a href="gestionPerfilUsuarios_View.php" style="margin-left: 10px;">
                <i class="fa-solid fa-caret-left fa-beat-fade fa-2xl" style="color: #443745;"></i>
            </a>
        <br>
        <h2>Inmuebles del usuario</h2>
        <br>
        <hr>
        <div class="contiene">
            <div class="inmueble-list">

            </div>
        </div>
    </div>
</main>

<script src="../assets/js/GestionImuebles/gestionInmuebles.js"></script>

<?php include './templates/Footer.php'; ?>
