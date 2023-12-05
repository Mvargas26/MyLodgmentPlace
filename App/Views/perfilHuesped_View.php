<?php
require_once('../Modules/Master_Class.php');
include './templates/Header.php';
session_start();


$ObjMaster = new Master_Class();

$idUser = $_SESSION['Identificacion'];
$informacionUsuario = $ObjMaster->informacionUsuarios($idUser);

if ($informacionUsuario) {
     "<div>";
     "<p><strong>Cédula: </strong>{$informacionUsuario['idUser']}</p>";
     "<p><strong>Nombre: </strong>{$informacionUsuario['nombre']}</p>";
     "<p><strong>Primer Apellido: </strong>{$informacionUsuario['apellido1']}</p>";
     "<p><strong>Segundo Apellido: </strong>{$informacionUsuario['apellido2']}</p>";
     "<p><strong>Dirección de Residencia: </strong>{$informacionUsuario['direccion']}</p>";
     "<p><strong>Número de Teléfono: </strong>{$informacionUsuario['telefono']}</p>";
     "<p><strong>Correo Electrónico: </strong>{$informacionUsuario['correo']}</p>";
     "</div>";
} else {
    echo "Error al obtener los datos del usuario.";
}

?>
<!-- ==============================================Fin header ======= -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Personales</title>
    <!-- Incluye jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Incluye Bootstrap (para el modal) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link  href="../assets/css/perfilHuesped.css" rel="stylesheet">
</head>
<body>

<main id="main">
<br>
        <br>
    <div class="container ">
        <h2>Datos Personales</h2>

        <div>
            <p><strong>Cédula: </strong><?php echo $informacionUsuario['idUser']; ?></p>
            <p><strong>Nombre: </strong><?php echo $informacionUsuario['nombre']; ?></p>
            <p><strong>Primer Apellido: </strong><?php echo $informacionUsuario['apellido1']; ?></p>
            <p><strong>Segundo Apellido: </strong><?php echo $informacionUsuario['apellido2']; ?></p>
            <p><strong>Dirección de Residencia:</strong> <?php echo $informacionUsuario['direccion']; ?></p>
            <p><strong>Número de Teléfono:</strong> <?php echo $informacionUsuario['telefono']; ?></p>
            <p><strong>Correo Electrónico:</strong> <?php echo $informacionUsuario['correo']; ?></p>
        </div>

        <!-- Botón para activar el modal -->
        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#updateModal">
            Actualizar Datos
        </button>

        <!-- <div class="banner_img">
            <img src="../assets/img/logo/logo.png" alt="">
        </div>  -->

    </div>

    <!-- Modal para actualizar datos -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Actualizar Datos Personales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="ActualizarDatos">
                        <div class="form-group">
                            <label for="nameFromDatabase">Nombre:</label>
                            <input type="text" class="form-control" id="nameFromDatabase" value="<?php echo $informacionUsuario['nombre']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="apellido1">Primer apellido:</label>
                            <input type="text" class="form-control" id="apellido1" value="<?php echo $informacionUsuario['apellido1']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="apellido2">Segundo apellido:</label>
                            <input type="text" class="form-control" id="apellido2" value="<?php echo $informacionUsuario['apellido2']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="updatedAddress">Dirección de Residencia:</label>
                            <input type="text" class="form-control" id="updatedAddress" value="<?php echo $informacionUsuario['direccion']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="updatedPhoneNumber">Número de Teléfono:</label>
                            <input type="text" class="form-control" id="updatedPhoneNumber" value="<?php echo $informacionUsuario['telefono']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="updatedEmail">Correo Electrónico:</label>
                            <input type="text" class="form-control" id="updatedEmail" value="<?php echo $informacionUsuario['correo']; ?>">
                        </div>

                        <button type="button" id="btnGuardarDatos" class="btn btn-primary">Guardar Datos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="../assets/js/actualizarDatosUsuarios/actualizarDatos.js"></script>

</body>
<br>
        <br>

</html>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->