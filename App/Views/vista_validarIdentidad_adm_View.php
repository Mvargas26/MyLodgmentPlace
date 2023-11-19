<?php
// Header.php
include './templates/Header.php';
require_once '../Modules/Master_Class.php';

$idUser = isset($_GET['idUser']) ? $_GET['idUser'] : null;
$masterClass = new Master_Class();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idValidacionPerfil"])) {
        $idUser = $_POST["idValidacionPerfil"];

        if ($masterClass->validarIdentidad($idUser)) {
            echo "Identidad validada correctamente.";
        } else {
            echo "Error al validar la identidad.";
        }
    } else {
        echo "Error: No se recibió el idUser.";
    }
}

// Obtener el estado actual del usuario desde la base de datos
$estadoUsuario = $masterClass->obtenerEstadoUsuario($idUser);

?>

<main id="main">
    <body>
        <div class="profile-validation">
            <p>ID del Usuario: <?php echo $idUser; ?></p>
            <p id="estado-usuario">Estado: <?php echo $estadoUsuario; ?></p>

            <!-- Formulario para enviar la solicitud de validación -->
            <form method="post" action="">
                <input type="hidden" name="idValidacionPerfil" value="<?php echo $idUser; ?>">
                <button type="submit">Validar Identidad</button>
            </form>
        </div>

        <!-- Incluye tu archivo JavaScript si es necesario -->
        <script src="../assets/js/VistaPerfilUsuarios/vistaPerfilUsuario.js"></script>
    </body>
</main>

<!-- Footer.php -->
<?php include './templates/Footer.php'; ?>
