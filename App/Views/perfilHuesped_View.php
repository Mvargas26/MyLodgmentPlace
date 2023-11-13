<?php
include './templates/Header.php';
session_start();
?>
<!-- ==============================================Fin header ======= -->
<main id="main">
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
<div class="container mt-5">
    <h2>Datos Personales</h2>
    <div>
        <p><strong>Cédula: </strong><span id="cedulaFromDatabase"></span></p>
        <p><strong>Nombre: </strong><span id="nameFromDatabase"></span></p>
        <p><strong>Primer Apellido: </strong><span id="apellidoFromDatabase"></span></p>
        <p><strong>Primer Apellido: </strong><span id="apellidoFromDatabase"></span></p>
        <p><strong>Dirección de Residencia:</strong> <span id="currentAddress"></span></p>
        <p><strong>Número de Teléfono:</strong> <span id="currentPhoneNumber">123456789</span></p>
        <p><strong>Cédula:</strong> <span id="currentCedula">1234567890</span></p>
        <p><strong>Correo Electrónico:</strong> <span id="currentEmail">correo@example.com</span></p>
        <p><strong>Número de Contacto de Emergencia:</strong> <span id="currentEmergencyContactNumber">987654321</span></p>
        <p><strong>Nombre de Contacto en Caso de Emergencia:</strong> <span id="currentEmergencyContactName">Nombre Contacto</span></p>
    </div>
    <!-- Botón para activar el modal -->
    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#updateModal">
        Actualizar Datos
    </button>
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
              
                <form id="updateForm">
                    <div class="form-group">
                        <label for="nameFromDatabase">Nombre:</label>
                        <input type="text" class="form-control" id="nameFromDatabase" placeholder="Nuevo Nombre">
                    </div>
                    <div class="form-group">
                        <label for="updatedAddress">Dirección de Residencia:</label>
                        <input type="text" class="form-control" id="updatedAddress" placeholder="Nueva Dirección">
                    </div>
                    <div class="form-group">
                        <label for="updatedPhoneNumber">Número de Teléfono:</label>
                        <input type="text" class="form-control" id="updatedPhoneNumber" placeholder="Nuevo Número de Teléfono">
                    </div>
                    <div class="form-group">
                        <label for="updatedCedula">Cédula:</label>
                        <input type="text" class="form-control" id="updatedCedula" placeholder="Nueva Cédula">
                    </div>
                    <div class="form-group">
                        <label for="updatedEmail">Correo Electrónico:</label>
                        <input type="text" class="form-control" id="updatedEmail" placeholder="Nuevo Correo Electrónico">
                    </div>
                    <div class="form-group">
                        <label for="updatedEmergencyContactNumber">Número de Contacto de Emergencia:</label>
                        <input type="text" class="form-control" id="updatedEmergencyContactNumber" placeholder="Nuevo Número de Contacto de Emergencia">
                    </div>
                    <div class="form-group">
                        <label for="updatedEmergencyContactName">Nombre de Contacto en Caso de Emergencia:</label>
                        <input type="text" class="form-control" id="updatedEmergencyContactName" placeholder="Nuevo Nombre de Contacto en Caso de Emergencia">
                    </div>
                    <!-- Botón para guardar datos -->
                    <button type="button" class="btn btn-primary" onclick="guardarDatos()">Guardar Datos</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Llena el modal con los datos actuales al abrirlo
    $('#updateModal').on('show.bs.modal', function () {
        $('#nameFromDatabase').val($('#currentName').text());
        $('#updatedAddress').val($('#currentAddress').text());
        $('#updatedPhoneNumber').val($('#currentPhoneNumber').text());
        $('#updatedCedula').val($('#currentCedula').text());
        $('#updatedEmail').val($('#currentEmail').text());
        $('#updatedEmergencyContactNumber').val($('#currentEmergencyContactNumber').text());
        $('#updatedEmergencyContactName').val($('#currentEmergencyContactName').text());
    });

    function guardarDatos() {
        // Puedes agregar lógica aquí para enviar los datos al servidor
        // En este ejemplo, simplemente mostramos una alerta
        alert("Datos guardados correctamente.");
        // Cierra el modal después de guardar datos
        $('#updateModal').modal('hide');
    }
</script>

<script>var identificacion = <?php echo json_encode($_SESSION["Identificacion"]); ?>; </script>
<script>var nombreUsu = <?php echo json_encode($_SESSION["nombre"]); ?>; </script>

</body>
</main>


  

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->