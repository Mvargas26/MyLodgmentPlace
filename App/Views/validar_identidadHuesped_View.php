<?php
include './templates/Header.php';
session_start();
?>
<!-- ==============================================Fin header ======= -->
<main id="main">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Identidad</title>
    <!-- Incluye Bootstrap (CSS y JS) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="../assets/css/validarIdentidad.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 
</head>
<body>
<!-- Contenido principal -->
<main id="main">
    <div class="container mt-5">
        <h2>Validación de Identidad</h2>
        <!-- Muestra la cédula desde la base de datos -->
        <p>Cédula: <span id="cedulaFromDatabase"></span></p>
        <p>Nombre: <span id="nameFromDatabase"></span></p>
        <br>
        <br>
        <!-- Contenedor para mostrar la imagen -->
        <div id="imageContainer"></div>
        <!-- Botón para abrir el modal de subir foto -->
        <br>
        <br>
        <button type="button" id="uploadButton" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
            Subir Foto
        </button>
    </div>
</main>

<!-- Modal para subir foto -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Subir Foto</h5>
                <button type="button" class="close" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>
            </div>
            <div class="modal-body">
                <!-- Contenedor para subir foto -->
                <div id="uploadContainer">
                    <p>Haz clic para subir una foto</p>
                    <input type="file" id="fileInput" style="display: none">
                    <label for="fileInput" class="btn btn-primary" id="uploadLabel">Seleccionar Foto</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="uploadButton" class="btn btn-primary" onclick="guardarDatos()">Guardar Datos</button>
            </div>
        </div>
    </div>
</div> 
<script>var identificacion = <?php echo json_encode($_SESSION["Identificacion"]); ?>; </script>
<script>var nombreUsu = <?php echo json_encode($_SESSION["nombre"]); ?>; </script>
</body>
<br>
<br>
<br>
</main>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->