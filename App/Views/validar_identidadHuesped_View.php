<?php
include './templates/Header.php';
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

</head>
<body>
<!-- Contenido principal -->
<main id="main">
    <div class="container mt-5">
        <h2>Validación de Identidad</h2>
        <!-- Muestra la cédula desde la base de datos -->
        <p>Cédula: <span id="cedulaFromDatabase">304560852</span></p>
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
                    <label for="fileInput" class="btn btn-primary" id="uploadButton">Seleccionar Foto</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="uploadButton" class="btn btn-primary" onclick="guardarDatos()">Guardar Datos</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para mostrar el nombre del archivo seleccionado
    $('#fileInput').on('change', function () {
        var fileName = $(this).val().split('\\').pop();
        $('#uploadButton').text('Archivo Seleccionado: ' + fileName);
    });

    function guardarDatos() {
        // Obtener la URL de la imagen
        var imageUrl = URL.createObjectURL($("#fileInput")[0].files[0]);

        // Crear un elemento de imagen y establecer la fuente
        var img = document.createElement('img');
        img.src = imageUrl;

        // Agregar la imagen al contenedor
        $('#imageContainer').html(img);

        // Mostrar la alerta
        alert("Se subió la foto correctamente. En proceso de validación.");

        // Cierra el modal después de guardar datos
        $('#uploadModal').modal('hide');

        // Agregar AJAX para cerrar el modal sin mostrar transición
        $.ajax({
            url: 'validar_identidad.php', // Ruta a tu script PHP para validar la imagen
            type: 'POST',
            data: { imagen: imageUrl },
            success: function(response) {
                console.log(response); // Puedes manejar la respuesta del servidor aquí
            }
        });
    }
</script>

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
