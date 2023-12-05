<?php
// Header.php
include './templates/Header.php';
require_once '../Modules/Master_Class.php';

session_start();


$idUser = isset($_GET['idUser']) ? $_GET['idUser'] : null;

$masterClass = new Master_Class();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idValidacionPerfil"])) {
        $idUser = $_POST["idValidacionPerfil"];

        if ($masterClass->validarIdentidad($idUser)) {
           
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
    <link rel="stylesheet" href="../assets/css/validarIdentidad/validaridentidad.css">

    <body>
    <br>
            <a href="gestionPerfilUsuarios_View.php" style="margin-left: 10px;">
                <i class="fa-solid fa-caret-left fa-beat-fade fa-2xl" style="color: #443745;"></i>
            </a>
        <br>

        <h2>Validacion de Perfil</h2>

        <div class="contiene">

            <div class="contiene2">
                <img id="userProfileImage" src="" alt="User Profile Image" style="border-radius: 15px;">
            </div>

            <div class="contiene">
                <ul>
                    <div class="card__title">Usuario</div>
                    <br>
                    <p>Cedula del Usuario: <?php echo $idUser; ?></p>

                    <p id="estado-usuario">Estado: <?php echo $estadoUsuario; ?></p>

                    <form method="post" action="">
                        <input type="hidden" name="idValidacionPerfil" value="<?php echo $idUser; ?>">
                        <button type="submit">Validar Identidad</button>
                    </form>
                </ul>
            </div>

        </div>
        <!-- Incluye tu archivo JavaScript si es necesario -->
        <script src="../assets/js/VistaPerfilUsuarios/vistaPerfilUsuario.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </body>
</main>

<!-- Footer.php -->
<?php include './templates/Footer.php'; ?>
