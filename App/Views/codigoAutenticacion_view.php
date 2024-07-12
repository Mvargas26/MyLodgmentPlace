<?php
include './templates/Header.php';
$identificacion = $_POST['identificacion'];
$password = $_POST['password'];
session_start();
// if (!isset($identificacion) || !isset($password) || empty($identificacion) || empty($password)) {
//     header('Location: ../../');
//     exit();
// }
?>
<!-- ==============================================Fin header ======= -->
<main id="main">

<link href="../assets/css/codigoAutenticacion.css" rel="stylesheet">

    <div id="CajaCodigoAutenticacion">
        <h2>Código de Autenticación</h2>
        <div>
            <form action="codigoAutenticacion_Negocios.php" method="post" id="codigoAutenticacionForm">
                <p>Se ha enviado un código de autenticación a tu correo electrónico.</p>
                <label for="codigo">Código:</label>
                <input type="text" name="codigo" required>
                <input type="hidden" name="cedula" value="<?= $identificacion ?>">
                <input type="hidden" name="password" value="<?= $password ?>">
                <input type="submit" value="Verificar Código">
            </form>
        </div>
    </div>

</main>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->